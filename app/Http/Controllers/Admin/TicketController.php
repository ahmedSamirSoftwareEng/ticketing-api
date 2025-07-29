<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\ShowTicketRequest;
use App\Http\Requests\DeleteTicketRequest;
use App\Http\Requests\UpdateTicketStatusRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;
use App\Services\TicketService;
use App\Http\Resources\TicketResource;
use Symfony\Component\HttpFoundation\Response;

class TicketController extends Controller
{
    use ApiResponse;

    public function __construct(
        private TicketService $ticketService
    ) {}

    public function index(): JsonResponse
    {
        $tickets = $this->ticketService->get();
        return $this->successResponse(TicketResource::collection($tickets));
    }

    public function show(Ticket $ticket): JsonResponse
    {
        $ticket = $this->ticketService->show($ticket->id);
        return $this->successResponse(TicketResource::make($ticket));
    }

    public function updateStatus(UpdateTicketStatusRequest $request, Ticket $ticket): JsonResponse
    {
        $this->ticketService->updateStatus($ticket, $request->validated());
        return $this->successResponse(TicketResource::make($ticket), code: Response::HTTP_CREATED);
    }

    public function destroy(DeleteTicketRequest $request, Ticket $ticket): JsonResponse
    {
        $this->ticketService->delete($ticket);
        return $this->successResponse(null, code: Response::HTTP_NO_CONTENT);
    }
}
