<?php

namespace Wantp\Neat\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'path' => $this->path,
            'icon' => $this->icon,
            'order' => $this->order,
            'created_at' => $this->created_at->toDatetimeString(),
            'update_at' => $this->updated_at->toDatetimeString(),
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
        ];
    }
}