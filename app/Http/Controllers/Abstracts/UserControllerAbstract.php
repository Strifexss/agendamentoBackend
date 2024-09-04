<?php

namespace App\Http\Controllers\Abstracts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

abstract class UserControllerAbstract extends Controller
{

    private $service;

    private $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required'
    ];

    public function __construct($service) {
        $this->service = $service;
    }

    public function login(Request $request)
    {
        $data = $request->only("email", "password");

        $auth = $this->service->login($data);

        if(!$auth) {
            return [
                'status' => false,
                'message' => "Email ou senha incorretos"
            ];
        }

        return [
            'status' => true,
            'message' => "Usuário logado com sucesso",
            'user' => $auth
        ];
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $validate = Validator::make($data, $this->rules);

        if($validate->fails()) {
            return [
                'status' => false,
                'validation' => $validate->errors()
            ];
        }

        $register = $this->service->register($data);

        if(!$register) {
            $this->returnResponse(false, "Houve um erro ao criar o usuário!");
        }

        return [
            "status" => true,
            "message" => "Usuário criado com sucesso",
            "user" => $register
        ];
    }
}
