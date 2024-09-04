<?php

namespace App\DTO;

class UserLoginDTO {

    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public string $token
    )
    {
        $this->token = $this->processToken($this->token);
    }

    private function processToken(string $token): string
    {
        if (preg_match('/^\d\|/', $token)) {
            return substr($token, 2);
        }

        return $token;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

}
