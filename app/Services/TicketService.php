<?php

namespace App\Services;

use App\Models\Ticket;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TicketService
{
    public function get(?int $userId = null): Collection
    {
        return Ticket::with('user')->when($userId, fn(Builder $builder) => $builder->where('user_id', $userId))->get();
    }

    public function show(int $ticketId, ?int $userId = null): Ticket
    {
        return Ticket::with('user')->when($userId, fn(Builder $builder) => $builder->where('user_id', $userId))->findOrFail($ticketId);
    }

    public function create(array $data): Ticket
    {
        return auth()->user()->tickets()->create($data);
    }

    public function updateStatus(Ticket $ticket, array $data): Ticket
    {
        $ticket->update($data);
        return $ticket;
    }

    public function delete(Ticket $ticket): void
    {
        $ticket->delete();
    }
}
