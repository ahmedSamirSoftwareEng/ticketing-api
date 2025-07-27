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
        $ticket = $this->route('ticket');
        return $this->user()->id === $ticket->user_id
            || $this->user()->is_admin;
    }

    public function rules(): array
    {
        return [];
    }
}
