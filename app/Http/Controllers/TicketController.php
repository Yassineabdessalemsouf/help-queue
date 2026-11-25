<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    // TP3 ex.2 + ex.5 — queue split by status, topics eager-loaded
    public function index()
    {
        return view('tickets.index', [
            'helping' => Ticket::with('topic')->helping()->get(),
            'waiting' => Ticket::with('topic')->waiting()->get(),
            'doneCount' => Ticket::where('status', 'done')->count(),
            // TP3 bonus — number of tickets per topic
            'topics' => Topic::withCount('tickets')->orderBy('name')->get(),
        ]);
    }

    // TP2 ex.3 + TP3 ex.5.3
    public function create()
    {
        return view('tickets.create', ['topics' => Topic::orderBy('name')->get()]);
    }

    // TP2 ex.4 + TP3 ex.5.4
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'topic_id' => ['required', 'exists:topics,id'],
            'description' => ['nullable', 'string', 'max:500'],
        ], [], ['topic_id' => 'topic']); // TP3 bonus — "topic" instead of "topic id"

        Ticket::create($validated);

        return redirect()->route('tickets.index')->with('message', 'You are in the queue!');
    }

    // TP2 ex.2 + TP3 ex.3 — detail page with position in the queue
    public function show(Ticket $ticket)
    {
        $ahead = Ticket::waiting()->where('id', '<', $ticket->id)->count();

        return view('tickets.show', ['ticket' => $ticket, 'ahead' => $ahead]);
    }

    // TP3 ex.1 — change the status
    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(Ticket::STATUSES)],
        ]);

        $ticket->status = $validated['status'];
        $ticket->save();

        return redirect()->route('tickets.show', $ticket)->with('message', 'Status updated.');
    }

    // TP2 ex.6
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index')->with('message', 'Ticket removed.');
    }
}
