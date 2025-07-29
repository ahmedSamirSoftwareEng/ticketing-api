<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\ShowTicketRequest;
use App\Http\Requests\DeleteTicketRequest;
use App\Http\Requests\UpdateTicketStatusRequest;
use App\Http\Resources\TicketResource;
use App\Traits\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\TicketService;

class TicketController extends Controller
{
    use ApiResponse;

    public function __construct(
        private TicketService $ticketService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $tickets = $this->ticketService->get(Auth::id());
        return $this->successResponse(TicketResource::collection($tickets));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest  $request): JsonResponse
    {
        $ticket =  $this->ticketService->create($request->validated());
        return $this->successResponse(TicketResource::make($ticket->refresh() ), code: Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowTicketRequest $request, Ticket $ticket): JsonResponse
    {
        $ticket = $this->ticketService->show($ticket->id, Auth::id());
        return $this->successResponse(TicketResource::make($ticket));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteTicketRequest $request, Ticket $ticket): JsonResponse
    {
        $this->ticketService->delete($ticket);
        return $this->successResponse(null, code: Response::HTTP_NO_CONTENT);
    }
}
