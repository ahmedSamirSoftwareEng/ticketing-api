<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\TicketStatus;

class DeleteTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        $ticket = $this->route('ticket');

        if ($user->is_admin) {
            return  $ticket->status === TicketStatus::Pending;
        }

        return $user->id === $ticket->user_id && $ticket->status === TicketStatus::Pending;
    }

    public function rules(): array
    {
        return [];
    }
}
