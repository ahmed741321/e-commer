<?php
namespace App\Models;

use Exception;
use Firebase\JWT\JWT;

class Jwt_Class
{
    private $secretKey;
    private $alg = array();

    public function __construct($secretKey = "hwai_technology", $alg = "HS512")
    {
        $this->secretKey = $secretKey;
        array_push($this->alg, $alg);
    }

    public function encode_data_token($data = [], $time)
    {
        $issuedAt = time();
        // jwt valid for 60 days (60 seconds * 60 minutes * 24 hours * 60 days)
        $expirationTime = $issuedAt + 60 * $time;
        $payload = array(
            'iat' => $issuedAt,
            'exp' => $expirationTime,
        );
        if (count($data) > 0) {
            $keys = array_keys($data);
            // نقل الأسماء والقيم إلى المصفوفة الجديدة
            foreach ($keys as $key) {
                $payload[$key] = $data[$key];
            }
        }
        $tokens = JWT::encode($payload, $this->secretKey, $this->alg[0]);

        return $tokens;
    }

    public function decode_data($token)
    {
        try {
            // Attempt to decode the token
            $decoded = JWT::decode($token, $this->secretKey, $this->alg[0]);

            // If decoding is successful, $decoded will contain the decoded JWT data
            return $decoded;
        } catch (Exception $e) {
            // If decoding fails, an exception will be thrown

            return false;
        }
    }




}
?>
