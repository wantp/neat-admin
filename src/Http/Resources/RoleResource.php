<?php

namespace Wantp\Neat\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'remarks' => $this->remarks,
            'created_at' => $this->created_at->toDatetimeString(),
            'updated_at' => $this->updated_at->toDatetimeString(),
            'permissions' => PermissionResource::collection($this->whenLoaded('permissions')),
            'menus' => MenuResource::collection($this->whenLoaded('menus')),
        ];
    }
}