<?php

namespace App\Http\Resources\user;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\organizacao\OrganizacaoResource;
use App\Http\Resources\user\UserResource;
use App\Http\Resources\role\RoleResourceCollection;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "last_name" => $this->last_name,
            "email" => $this->email,
            "login" => $this->login,
            "documento" => $this->documento,
            "data_nascimento" => $this->data_nascimento,
            "sexo" => $this->sexo,
            "status" => $this->status,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at,
            "create_user_id" => $this->create_user_id,
            "update_user_id" => $this->update_user_id,
            "delete_user_id" => $this->delete_user_id,
            "organizacao_id" => $this->organizacao_id,
            "roles" => new RoleResourceCollection($this->whenLoaded('roles')),
            "organizacao_origem" => new OrganizacaoResource($this->whenLoaded('organizacao_origem')),
            "organizacao_visivel" => OrganizacaoResource::collection($this->whenLoaded('organizacao_visivel')),
            "create_user" => new UserResource($this->whenLoaded("usuario_criacao")),
            "update_user" => new UserResource($this->whenLoaded("usuario_update")),
            "delete_user" => new UserResource($this->whenLoaded("usuario_delete")),
            "links" => $this->when($this->id != null, function () {
                return [
                    "self"  =>  route("user.show_api", $this->id),
                    "self-form" =>  route("user.edit", $this->id),
                ];
            })
        ];
    }
}
