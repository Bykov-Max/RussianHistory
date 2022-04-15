<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'user_name' => $this->user->name,
            'element_id' => $this->element->id,
            'status' => $this->status,
            'user_id' => $this->user->id
        ];
    }
}
