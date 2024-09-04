<?php

namespace App\DTO;

use App\Http\DTO\Abstracts\UserDTOAbstract;

class UserCreateDTO {

    public function __construct(
        public string $name,
        public string $email,
        public string $password
    )
    {
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

}
