<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;

    public function __construct(UserService $user) {
        $this->user = $user;
    }
    /**
     * get all users
     */
    public function index() {
        $users = $this->user->getAll();
        return response()->json($users);
    }
    /**
     * get user by id
     */
    public function show($id) {
        $user = $this->user->getById($id);
        return response()->json($user);
    }

    /**
     * update user by id
     */
    public function update(Request $request, $id) {
        $this->user->update($id, $request->all());
        return response()->json(['message' => 'User updated successfully']);
    }

    /**
     * delete user by id
     */
    public function destroy($id) {
        $this->user->delete($id);
        return response()->json(['message' => 'User deleted successfully']);
    }

    /**
     * create new user
     */
    public function create(Request $request) {
        $user = $this->user->create($request->all());
        return response()->json($user, 201);
    }
}
