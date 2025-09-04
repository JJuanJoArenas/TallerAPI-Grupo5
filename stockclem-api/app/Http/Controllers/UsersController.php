<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersController extends Controller
{
    private $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|max:255|confirmed',
        'role_id' => 'max:99999999999999999999',
        'status' => 'required|string'
    ];

    private $traductionAttributes = [
        'name' => 'nombre',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'role_id' => 'ID del rol',
        'status' => 'estado'
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $users->load(['role']);
        return response()->json($users, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->applyValidator($request, $this->rules, $this->traductionAttributes);
        if(!empty($data))
        {
            return $data;
        }

        $user = User::create($request->all());
        $response = [
            'message' => 'Usuario creado exitosamente',
            'user' => $user
        ];
        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load(['role']);
        return response()->json($user, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        $data = $this->applyValidator($request, $this->rules, $this->traductionAttributes);
        if(!empty($data))
        {
            return $data;
        }

        $user->update($request->all());
        $response = [
            'message' => 'Usuario actualizado exitosamente',
            'user' => $user
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        $response = [
            'message' => 'Usuario eliminado exitosamente',
            'user' => $user
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
