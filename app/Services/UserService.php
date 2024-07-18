<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService {
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getAll() {
        return $this->userRepository->getAll();
    }

    public function getById($id) {
        return $this->userRepository->getById($id);
    }

    public function create(array $data) {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }

    public function update($id, $data) {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->userRepository->update($id, $data);
    }

    public function delete($id) {
        return $this->userRepository->delete($id);
    }
}