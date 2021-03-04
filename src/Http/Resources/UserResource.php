<?php

namespace Wantp\Neat\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'nickname' => $this->nickname,
            'avatar' => $this->avatar,
            'last_login_ip' => $this->last_login_ip,
            'last_login_time' => $this->last_login_time,
            'created_at' => $this->created_at->toDatetimeString(),
            'updated_at' => $this->updated_at->toDatetimeString(),
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
        ];
    }
}