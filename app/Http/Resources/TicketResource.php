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
            "created_by" => $this->whenLoaded("createdBy"),
            "assigned_to" => $this->whenLoaded("assignedTo"),
            "category" => $this->whenLoaded("category"),
        ];
    }
}
