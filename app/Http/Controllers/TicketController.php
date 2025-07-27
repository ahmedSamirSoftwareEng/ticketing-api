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

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $user = Auth::user();

        $tickets = $user->is_admin
            ? Ticket::with('user')->get()
            : $user->tickets;

        return response()->json($tickets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest  $request): JsonResponse
    {
        $ticket = $request->user()
            ->tickets()
            ->create($request->validated());

        return response()->json($ticket, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowTicketRequest $request, Ticket $ticket): JsonResponse
    {
        return response()->json($ticket);
    }

    public function updateStatus(
        UpdateTicketStatusRequest $request,
        Ticket $ticket
    ): JsonResponse {
        $ticket->update($request->validated());
        return response()->json($ticket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteTicketRequest $request, Ticket $ticket): JsonResponse
    {
        $ticket->delete();
        return response()->json(null, 204);
    }
}
