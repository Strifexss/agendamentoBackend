<?php

namespace App\DTO\Abstracts;


class UserDTOAbstract {

    public function __construct(
        public string $name,
        public string $email,
        public string $id
    )
    {
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}
