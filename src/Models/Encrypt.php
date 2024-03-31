<?php

namespace App\Models;

use Exception;

class Encrypt_Class
{
    private $secretKey;
    private $iv;

    public function __construct($secretKey = null, $iv = null)
    {
        // Generate a random key and IV if not provided
        if ($secretKey === null) {
            $this->secretKey = $this->generateRandomKey();
        } else {
            $this->secretKey = $this->generateKeyFromPassword($secretKey);
        }

        if ($iv === null) {
            $this->iv = $this->generateRandomIV();
        } else {
            $this->iv = $iv;
        }
    }

    public function encryptData($data)
    {
        $cipherMethod = 'AES-256-CBC';
        $options = 0;
        $encryptedData = openssl_encrypt($data, $cipherMethod, $this->secretKey, $options, $this->iv);

        if ($encryptedData === false) {
            throw new Exception('Encryption failed');
        }

        // Encode the data using base64 encoding
        $encodedData = base64_encode($encryptedData);

        return $encodedData;
    }

    public function decryptData($encodedData)
    {
        // Decode the data using base64 decoding
        $decodedData = base64_decode($encodedData);

        $cipherMethod = 'AES-256-CBC';
        $options = 0;
        $decryptedData = openssl_decrypt($decodedData, $cipherMethod, $this->secretKey, $options, $this->iv);

        if ($decryptedData === false) {
            throw new Exception('Decryption failed');
        }

        return $decryptedData;
    }

    private function generateRandomKey()
    {
        return openssl_random_pseudo_bytes(32);
    }

    private function generateRandomIV()
    {
        return openssl_random_pseudo_bytes(16);
    }

    public function generateKeyFromPassword($password)
    {
        $algorithm = "sha256";

        $key = openssl_digest($password, $algorithm, true);

        return $key;
    }
}
