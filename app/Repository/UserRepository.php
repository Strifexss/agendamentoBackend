<?php

namespace App\Repository;

use App\DTO\Abstracts\UserDTOAbstract;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function store($data)
    {
        DB::beginTransaction();
        try {
            $query = $this->model::create($data);

            DB::commit();
            return $query->id;
        }
        catch(\Exception $e) {
          DB::rollBack();
          dd($e->getMessage());
        }
    }

    public function find($userId)
    {
        $user = $this->model::find($userId);
        if (!$user) {
            throw new \Exception('User not found');
        }

        $userArray = $user->toArray();

        $userDTO = new UserDTOAbstract($userArray['name'], $userArray['email'], $userArray['id']);

        return $userDTO->toArray();
    }

    public function findByEmail($userEmail)
    {
        $user = $this->model->where("email", "=", $userEmail)->first();

        $userDto = new UserDTOAbstract($user->name, $user->email, $user->id);

        return $userDto->toArray();

    }

    public function getToken($userId)
    {
        $user = $this->model::find($userId);

        $token = $user->createToken("token");

        return $token->plainTextToken;
    }
}
