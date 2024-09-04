<?php

namespace App\Http\Services;

use App\DTO\UserCreateDTO;
use App\DTO\UserLoginDTO;
use App\Repository\UserRepository;
use App\Interfaces\UserServiceInterface;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    private $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function login($data)
    {
        $auth = Auth::attempt(['email' => $data['email'], 'password' => $data['password']]);

        if(!$auth) {
            return false;
        }
        
        $user = $this->findByEmail($data['email']);

        $token = $this->repository->getToken($user['id']);

        $user = new UserLoginDTO($user['id'], $user['name'], $user['email'], $token);

        return $user;
    }

    public function register($data):array
    {
        $user = new UserCreateDTO($data['name'], $data['email'], $data['password']);

        $user = $user->toArray();

        $query = $this->repository->store($user);

        $user = $this->repository->find($query);

        $token = $this->repository->getToken($query);

        $user = new UserLoginDTO($user['id'], $user['name'], $user['email'], $token);

        return $user->toArray();
    }

    public function find($userId):array
    {
        $user = $this->repository->find($userId);

        return $user;
    }

    private function findByEmail($userEmail)
    {
        $user = $this->repository->findByEmail($userEmail);

        return $user;
    }
}
