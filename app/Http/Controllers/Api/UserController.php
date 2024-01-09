<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::paginate();

        return UserResource::collection($users);
    }

    public function store(StoreUpdateUserRequest $request) {
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);

        return new UserResource($user);
    }

    public function show(string $id) {
        //$user = User::find($id);
        //$user = User::where('id', '=', $id)->first();
        //return response()->json(['message' => 'user not found'], 404);

        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    public function update(StoreUpdateUserRequest $request, string $id) {
        $data = $request->all();
        if($request->password)
            $data['password'] = bcrypt($request->password);

        $user = User::findOrFail($id);
        $user->update($data);

        return new UserResource($user);
    }

    public function destroy(Request $request, string $id) {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([], 204);
    }
}
