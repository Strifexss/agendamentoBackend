<?php

namespace App\Interfaces;


interface UserServiceInterface {

    public function register($data):array;
    public function find($id):array;
}
