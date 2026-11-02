<?php

namespace App\Support;

use App\Mail\FinishedAlertMail;
use App\Mail\FinishedMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Lunar\Models\Order;

class BookingConfirmationSender
{
    public static function send(Order $order): void
    {
        $lock = Cache::lock('booking-confirmation-'.$order->id, 20);

        if (! $lock->get()) {
            return;
        }

        try {
            $order = $order->fresh(['billingAddress', 'customer', 'digitalLines', 'shippingLines']);

            if (! $order || ! $order->placed_at) {
                return;
            }

            $meta = (array) $order->meta;
            $customerEmail = (string) ($order->billingAddress?->contact_email ?? '');

            if ($customerEmail !== '' && empty($meta['customer_confirmation_sent_at'])) {
                try {
                    Mail::to($customerEmail)->send(new FinishedMail($order));
                    $meta['customer_confirmation_sent_at'] = now()->toIso8601String();
                    $order->update(['meta' => $meta]);
                } catch (\Throwable $exception) {
                    Log::error('Booking completed but the customer confirmation email could not be sent.', [
                        'order_id' => $order->id,
                        'customer_email' => $customerEmail,
                        'error' => $exception->getMessage(),
                    ]);
                }
            }

            $adminEmail = (string) env('MAIL_TO_DEFAULT');

            if ($adminEmail !== '' && empty($meta['admin_confirmation_sent_at'])) {
                try {
                    Mail::to($adminEmail)->send(new FinishedAlertMail($order));
                    $meta['admin_confirmation_sent_at'] = now()->toIso8601String();
                    $order->update(['meta' => $meta]);
                } catch (\Throwable $exception) {
                    Log::error('Booking completed but the garage notification email could not be sent.', [
                        'order_id' => $order->id,
                        'admin_email' => $adminEmail,
                        'error' => $exception->getMessage(),
                    ]);
                }
            }
        } finally {
            $lock->release();
        }
    }
}
