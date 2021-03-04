<?php

namespace Wantp\Neat\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'method' => $this->method,
            'http_path' => $this->http_path,
            'created_at' => $this->created_at->toDatetimeString(),
            'update_at' => $this->updated_at->toDatetimeString(),
        ];
    }
}