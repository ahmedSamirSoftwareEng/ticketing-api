<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\TicketStatus;

class Ticket extends Model
{
    protected $fillable = ['title', 'message', 'status'];
    protected $casts = [
        'status' => TicketStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
