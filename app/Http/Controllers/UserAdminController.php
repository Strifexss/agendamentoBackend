<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Abstracts\UserControllerAbstract;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserAdminController extends UserControllerAbstract
{
protected $service;

    public function __construct()
    {
        $this->service = new UserService();

        parent::__construct($this->service);
    }


}
