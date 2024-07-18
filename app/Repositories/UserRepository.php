<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository 
{
    private $user;
    
    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getAll() {
        return $this->user->all();
    }

    public function getById($id) {
        return $this->user->find($id);
    }

    public function create($data) {
        return $this->user->create($data);
    }
    
    public function update($id, $data) {
        $user = $this->user->find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }
    
    public function delete($id) {
        $user = $this->user->find($id);
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }
}