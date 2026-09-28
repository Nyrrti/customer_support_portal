<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "subject" => $this->subject,
            "description" => $this->description,
            "status" => $this->status,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "category_id" => $this->category_id,
            "created_by" => new UserResource($this->whenLoaded("createdBy")),
            "assigned_to" => new UserResource($this->whenLoaded("assignedTo")),
            "category" => new CategoryResource($this->whenLoaded("category")), 
        ];
    }
}
