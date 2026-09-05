<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    "subject",
    "description",
    "status",
    "created_by_id",
    "assigned_to_id",
    "category_id",
])]
class Ticket extends Model
{
    use HasFactory;
    /**
     * Get the user that created the ticket.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

     /**
     * Get the user that is assigned to the ticket.
     */
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

     /**
     * Get the category the ticket belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
