<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        if ($user->is_admin) {
            return true;
        }
        $ticket = $this->route('ticket');

        return $user->id === $ticket->user_id;
    }
}
