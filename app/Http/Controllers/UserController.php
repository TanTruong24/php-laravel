<?php

namespace App\Http\Controllers;

use App\Services\UserService as UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;

    public function __construct(UserService $user) {
        $this->user = $user;
    }
    /**
     * show the profile for a given user
     */
    public function show($id) {
        $user = $this->user->getUserById($id);
        return response()->json($user);
    }
}
