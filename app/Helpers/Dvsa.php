<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class Dvsa{
    
    public $client_id, $client_secret, $apy_key, $scope, $tenant_id;

    public function __construct(string $client_id = '', string $client_secret = '', string $apy_key = '', string $scope = '', string $tenant_id = '')
    {
        $this->client_id = !empty($client_id) ? $client_id : env('DVSA_CLIENT_ID');
        $this->client_secret = !empty($client_secret) ? $client_secret : env('DVSA_CLIENT_SECRET');
        $this->apy_key = !empty($apy_key) ? $apy_key : env('DVSA_API_KEY');
        $this->scope = !empty($scope) ? $scope : env('DVSA_SCOPE');
        $this->tenant_id = !empty($tenant_id) ? $tenant_id : env('DVSA_TENANT_ID');
    }

    private function dajToken()
    {
        $url = "https://login.microsoftonline.com/$this->tenant_id/oauth2/v2.0/token";

        return Http::acceptJson()->asForm()->timeout(15)->post($url, [
            'grant_type' => 'client_credentials',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'scope' =>$this->scope
        ]);
    }

    private function errorResponse(string $message): string
    {
        return json_encode(['errorMessage' => $message]);
    }

    public function dohvatiAutoPodatke($tablica)
    {

        $tablica = preg_replace('/\s+/', '', $tablica);

        if (empty($tablica)) {
            return $this->errorResponse('Please enter a vehicle registration.');
        }

        if (empty($this->client_id) || empty($this->client_secret) || empty($this->apy_key) || empty($this->scope) || empty($this->tenant_id)) {
            Log::warning('DVSA vehicle lookup is missing API configuration.');

            return $this->errorResponse('Vehicle lookup is not configured. Please contact us to book.');
        }

        try {
            $tokenResponse = $this->dajToken();
        } catch (Throwable $exception) {
            Log::warning('DVSA token request failed.', [
                'message' => $exception->getMessage(),
            ]);

            return $this->errorResponse('Vehicle lookup is temporarily unavailable. Please try again later.');
        }

        if (! $tokenResponse->successful()) {
            Log::warning('DVSA token request returned an error.', [
                'status' => $tokenResponse->status(),
                'body' => $tokenResponse->body(),
            ]);

            return $this->errorResponse('Vehicle lookup is temporarily unavailable. Please try again later.');
        }

        $token = $tokenResponse->object();

        if (($token->token_type ?? null) !== 'Bearer' || empty($token->access_token)) {
            Log::warning('DVSA token response did not include a bearer access token.');

            return $this->errorResponse('Vehicle lookup is temporarily unavailable. Please try again later.');
        }

        try {
            $url = "https://history.mot.api.gov.uk/v1/trade/vehicles/registration/$tablica";
            $response = Http::acceptJson()->timeout(15)->withHeaders([
                'Authorization' => "Bearer $token->access_token",
                'X-API-Key' => $this->apy_key,
            ])->get($url);
        } catch (Throwable $exception) {
            Log::warning('DVSA vehicle request failed.', [
                'message' => $exception->getMessage(),
            ]);

            return $this->errorResponse('Vehicle lookup is temporarily unavailable. Please try again later.');
        }

        if ($response->status() === 404) {
            return $this->errorResponse('Vehicle not found. Please check the registration and try again.');
        }

        if (! $response->successful()) {
            Log::warning('DVSA vehicle request returned an error.', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return $this->errorResponse('Vehicle lookup is temporarily unavailable. Please try again later.');
        }

        return $response->body();
        
    }
}
