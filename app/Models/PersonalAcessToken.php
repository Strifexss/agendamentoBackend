<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken as AccessToken;

class PersonalAcessToken extends AccessToken
{
    use HasFactory;

    protected $table = "personal_access_tokens";
}
