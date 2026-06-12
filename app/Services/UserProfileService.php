<?php

namespace App\Services;

use App\Repositories\Contracts\UserProfileRepositoryInterface;

class UserProfileService
{
    protected UserProfileRepositoryInterface $repository;

    public function __construct(UserProfileRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        $imageName = null;

        if (isset($data['avatar'])) {
            $imageFile = $data['avatar'];
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('avatar'), $imageName);
        }

        return $this->repository->create([
            'address' => $data['address'],
            'avatar' => $imageName,
            'currency' => $data['currency'],
        ]);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

}