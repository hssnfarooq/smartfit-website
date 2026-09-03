<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use phpseclib3\Net\SFTP;

class StapletonsTyres{
    
    private $sftp = null;

    private function sftpConnect(){

        $this->sftp = new SFTP(env('SFTP_HOST'), 2222);
        if (!$this->sftp->login(env('SFTP_USERNAME'), env('SFTP_PASSWORD')))
            throw new \Exception('Login failed');

    }

    public function slikaGume(){
        

    }

}


/*
slike

Tyre Image Name - dodat .png
/Images/TyrePatterns

Label Image Name
/Images/TyreLabels-EU2020-740

*/