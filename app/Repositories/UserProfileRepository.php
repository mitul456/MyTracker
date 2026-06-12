<?php

namespace App\Repositories;

use App\Models\UserProfile;
use App\Repositories\Contracts\UserProfileRepositoryInterface;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    public function all()
    {
        return UserProfile::where('user_id', auth()->id())
            ->with('user')
            ->first();
    }
    public function find($id)
    {
        return UserProfile::where('user_id', auth()->id())->with('user')->findOrFail($id);
    }
    public function create(array $data)
    {
        $data['user_id'] = auth()->id();
        return UserProfile::create($data);
    }
    public function update($id, array $data)
    {
        $profile = $this->find($id);
        $profile->update($data);
        return $profile;
    }
    public function delete($id)
    {
        $profile = $this->find($id);
        $profile->delete();
        return true;
    }
}