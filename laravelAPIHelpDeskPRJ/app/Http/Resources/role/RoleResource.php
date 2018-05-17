<?php

namespace App\Http\Resources\role;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            "id"    =>  $this->id,
            "name"  =>  $this->name,
            "guard_name"    =>  $this->guard_name,
            "created_at"    =>  $this->created_at,
            "updated_at"    =>  $this->updated_at,
            "links" => $this->when($this->id != null, function () {
                return [
                    "self"  =>  route("role.show_api", $this->id),
                    "self-form" =>  route("role.edit", $this->id),
                ];
            })
        ];
    }
}
