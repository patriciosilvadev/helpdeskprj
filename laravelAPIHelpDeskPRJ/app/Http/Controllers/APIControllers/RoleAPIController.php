<?php

namespace App\Http\Controllers\APIControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\role\RoleResourceCollection;
use App\Http\Resources\role\RoleResource;
use App\Http\Requests\role\ListRoleRequest;
use App\Http\Requests\role\StoreRoleRequest;
use App\Http\Requests\role\UpdateRoleRequest;

class RoleAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListRoleRequest $request)
    {
        $query = (new Role)->newQuery();

        if ($request->filled("name")) {
            $query->where("name", "like", "%" . $request->input("name") . "%");
        }

        if ($request->filled("search.value")) {
            $query->where("name", "like", "%" . $request->input("search.value") . "%");
        }

        if ($request->filled("order.0.column") && $request->filled("order.0.dir")) {
            $columns = $request->input('columns');

            foreach ($request->order as $order) {
                $query->orderBy($columns[$order['column']]['data'], $order['dir']);
            }
        }

        if ($request->has("length") && $request->has("start") && $request->length>=0 && $request->start>=0) {
            $query->skip($request->start);
            $query->take($request->length);
        }

        return new RoleResourceCollection($query->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $newRole = Role::create(['name' => $request->name, "guard_name" => $request->guard_name]);

        if ($request->has("permissions")) {

            $newRole->syncPermissions(Permission::whereIn("id", $request->permissions)->get());
        }

        if ($newRole) {
            return response()->json(null, 204);
        } else {
            return response()->json(["msg"=>"Houve um erro desconhecido no cadastro do registro."], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->name = $request->name;
        $role->guard_name = $request->guard_name;
        $resultado = $role->save();

        if ($request->has("permissions")) {
            // dd($request->permissions);
            $role->syncPermissions(Permission::whereIn("id",$request->permissions)->get());
        }else{
            $role->syncPermissions();
        }



        if ($resultado) {
            return response()->json(null, 204);
        } else {
            return response()->json(["msg"=>"Houve um erro desconhecido na atualização do registro."], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\Permission\Models\Role Role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(null, 204);
    }
}
