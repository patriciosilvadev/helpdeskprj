<?php

namespace App\Http\Resources\usuario_grupo;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\user\UserResource;

class UsuarioGrupoResource extends JsonResource
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
            "nome" => $this->nome,
            "codigo" => $this->codigo,
            "status" => $this->status,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at,
            "create_user_id" => $this->create_user_id,
            "update_user_id" => $this->update_user_id,
            "delete_user_id" => $this->delete_user_id,
            "create_user" => new UserResource($this->whenLoaded("usuario_criacao")),
            "update_user" => new UserResource($this->whenLoaded("usuario_update")),
            "delete_user" => new UserResource($this->whenLoaded("usuario_delete")),
            "links" => $this->when($this->id != null, function () {
                return [
                    "self"  =>  route("usuario_grupo.show_api", $this->id),
                    "self-form" =>  route("usuario_grupo.edit", $this->id),
                ];
            })
        ];
    }
}
