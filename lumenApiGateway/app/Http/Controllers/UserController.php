<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponse;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return users list
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $this->validResponse($users);
    }

    /**
     * Create an instance of User
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];
        $this->validate($request, $rules);

        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);

        $user = User::create($fields);

        return $this->validResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Return an specific User
     * @return Illuminate\Http\Response
     */
    public function show($userId)
    {
        $user = User::findOrFail($userId);

        return $this->validResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Update thejinformation of an existing User
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $userId)
    {
        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:users,email,' . $userId,
            'password' => 'min:8|confirmed',
        ];
        $this->validate($request, $rules);
        
        $user = User::findOrFail($userId);
        $user->fill($request->all());
        
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();
        return $this->validResponse($user);
    }

    /**
     * Remove an existing User
     * @return Illuminate\Http\Response
     */
    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return $this->validResponse($user);
    }
}
