<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all()
    {
        return Category::where('user_id', auth()->id())->latest()->paginate(6);
    }

    public function find($id)
    {
        return Category::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    }

    public function create(array $data)
    {
        $data['user_id'] = auth()->id();
        return Category::create($data);
    }

    public function update($id, array $data)
    {
        $category = $this->find($id);
        if ($category) {
            $category->update($data);
            return $category;
        }
        return null;
    }

    public function delete($id)
    {
        $category = $this->find($id);
        if ($category) {
            $category->delete();
            return true;
        }
        return false;
    }
}