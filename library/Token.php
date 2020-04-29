<?php

class Token
{

    protected $algos = [
        'HS256' => 'sha256',
        'HS384' => 'sha384',
        'HS512' => 'sha512',
        'RS256' => \OPENSSL_ALGO_SHA256,
        'RS384' => \OPENSSL_ALGO_SHA384,
        'RS512' => \OPENSSL_ALGO_SHA512,
    ];

    protected $key = KEY_TOKEN;
    protected $algo = ALGO_TOKEN;
    protected $maxAge = MAX_AGE_TOKEN;
    public function __construct() {
    }

    public function encode(array $payload, array $header = []): string
    {
        $header = ['typ' => 'JWT', 'alg' => $this->algo] + $header;

        if (!isset($payload['exp'])) {
            $payload['exp'] = time() + $this->maxAge;
        }
        $header    = $this->urlSafeEncode($header);
        $payload  = $this->urlSafeEncode($payload);
        $signature = $this->urlSafeEncode($this->sign($header . '.' . $payload));
        return $header . '.' . substr(base64_encode(SALT_TOKEN), 0, 10) . $payload . '.' . $signature;

    }

    public function decode(string $token): array
    {
        if (substr_count($token, '.') < 2) {
            return array();
        }

        $token = explode('.', $token, 3);
        $salt = substr(base64_encode(SALT_TOKEN), 0, 10);

        $token[1] = substr($token[1], strlen($salt));

        if (!$this->verify($token[0] . '.' . $token[1], $token[2])) {
            return array();
        }

        $payload = (array) $this->urlSafeDecode($token[1]);
        ///////////
        // check time token
        //////////
        return $payload;
    }
    protected function sign(string $input): string
    {
        // HMAC SHA.
        if (substr($this->algo, 0, 2) === 'HS') {
            return hash_hmac($this->algos[$this->algo], $input, $this->key, true);
        }

        openssl_sign($input, $signature, $this->key, $this->algos[$this->algo]);

        return $signature;
    }

    protected function verify(string $input, string $signature): bool
    {
        $algo = $this->algos[$this->algo];

        // HMAC SHA.
        if (substr($this->algo, 0, 2) === 'HS') {
            return hash_equals($this->urlSafeEncode(hash_hmac($algo, $input, $this->key, true)), $signature);
        }

        $pubKey = openssl_pkey_get_details($this->key)['key'];

        return openssl_verify($input, $this->urlSafeDecode($signature, false), $pubKey, $algo) === 1;
    }

    protected function urlSafeEncode($data): string
    {
        if (is_array($data)) {
            $data = json_encode($data, JSON_UNESCAPED_SLASHES);
        }

        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    protected function urlSafeDecode($data, bool $asJson = true)
    {
        if (!$asJson) {
            return base64_decode(strtr($data, '-_', '+/'));
        }

        $data = json_decode(base64_decode(strtr($data, '-_', '+/')));
        return $data;
    }

    public function tokenRandom() {
        $token = '';
        $strlen = random_int(3,5);
        for ($i = 0; $i < $strlen; $i++) {
            $strRandom = random_bytes(20);
            $token .= rtrim(strtr(base64_encode($strRandom), '+/', '-_'), '=');
            if($i < $strlen - 1) {
                $token.= ".";
            }
        }
        return $token;
    }
}
