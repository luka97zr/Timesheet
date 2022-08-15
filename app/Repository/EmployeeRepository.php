<?php

namespace App\Repository;

use App\Events\UpdatePassword;
use App\Http\Resources\EmployeeResource;
use App\Models\User;
use App\Models\VerifyUser;

class EmployeeRepository {

    public function index()
    {
        return EmployeeResource::collection(
            User::with('role')->paginate(3)
        );
    }

    public function store($request)
    {
        $data = $request->all();
        $data['is_verified'] = false;
        $user = User::create($data);
        $token = VerifyUser::generateToken($user->id);
        event(new UpdatePassword($user, $token));
    }


    public function update($request, $id)
    {
        User::findOrFail($id)->update($request->all());
    }

    public function destroy($id)
    {
        User::destroy($id);
    }
}