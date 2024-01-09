<?php

namespace App\Http\Controllers;

use App\Domain\Models\User;

class UserController extends Controller
{

    /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return User::find(1);
    }
}
