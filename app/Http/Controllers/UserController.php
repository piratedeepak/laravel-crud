<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('userDetails')->get();
        return response()->json($users,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'address' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if (isset($data['address'])) {
            UserDetails::create([
                'user_id' => $user->id,
                'address' => $data['address'],
            ]);
        }
        $user->load('userDetails');
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'sometimes|required|string|min:8',
            'address' => 'sometimes|nullable|string|max:255',
        ]);
        $user = User::find($id);
        if($user){
            $data = $request->all();
            $user->update([
                'first_name' => $data['first_name'] ?? $user->first_name,
                'last_name' => $data['last_name'] ?? $user->last_name,
                'email' => $data['email'] ?? $user->email,
                'password' => $data['password'] ? Hash::make($data['password']) : $user->password,
            ]);

            if (isset($data['address'])) {
                UserDetails::updateOrCreate(
                    ['user_id' => $user->id],
                    ['address' => $data['address']]
                );
            }
            return response()->json($user,204);
        }
        return response()->json([ "Message" => "User Not Found"],404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'Message' => 'User Not Found'
            ], 404);
        }
        $user->userDetails()->delete();
        $user->delete();
        return response()->json([
            'Message' => 'Delete Successfully'
        ], 204);
    }
}
