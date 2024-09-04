<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function returnResponse($status, $message)
    {
        return [
            'status' => $status,
            'message' => $message,
        ];
    }
}
