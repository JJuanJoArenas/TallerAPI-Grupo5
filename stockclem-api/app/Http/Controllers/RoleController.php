<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    private $rules = [
        'name' => 'required|string|max:50'
    ];

    private $traductionAttributes = [
        'name' => 'nombre'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return response()->json($roles, Response::HTTP_OK);
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

        $role = Role::create($request->all());
        $response = [
            'message' => 'Rol creado exitosamente',
            'role' => $role
        ];
        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return response()->json($role, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $data = $this->applyValidator($request, $this->rules, $this->traductionAttributes);
        if(!empty($data))
        {
            return $data;
        }

        $role->update($request->all());
        $response = [
            'message' => 'Rol actualizado exitosamente',
            'role' => $role
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        $response = [
            'message' => 'Rol eliminado exitosamente',
            'role' => $role
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
