<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            "created_at" => $this->created_at->format('F d, Y \a\t h:i A'),
            "updated_at" => $this->updated_at->format('F d, Y \a\t'),
            'user' => new UserResource($this->user),
            'group' => $this->group,
            'attachments' => $this->attachments
        ];
    }
}
