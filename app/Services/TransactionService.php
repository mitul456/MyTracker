<?php

namespace App\Services;

use App\Repositories\Contracts\TransactionRepositoryInterface;

class TransactionService
{
    protected TransactionRepositoryInterface $repository;

    public function __construct(TransactionRepositoryInterface $repository)
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
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function getAccounts()
    {
        return $this->repository->getAccounts();
    }

    public function getCategories()
    {
        return $this->repository->getCategories();
    }
}