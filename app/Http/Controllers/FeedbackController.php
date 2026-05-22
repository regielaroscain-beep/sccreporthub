<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // ─── Show Feedback Form ───────────────────────────────────────────────────

    public function create(Ticket $ticket)
    {
        // Only the ticket owner can submit feedback
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        // Only completed tickets can receive feedback
        if ($ticket->status !== Ticket::STATUS_COMPLETED) {
            return back()->with('error', 'Feedback can only be submitted for completed tickets.');
        }

        // Check if feedback already submitted
        if ($ticket->feedback) {
            return back()->with('info', 'You have already submitted feedback for this ticket.');
        }

        return view('faculty.feedback.create', compact('ticket'));
    }

    // ─── Store Feedback ───────────────────────────────────────────────────────

    public function store(Request $request, Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        if ($ticket->status !== Ticket::STATUS_COMPLETED) {
            return back()->with('error', 'Feedback can only be submitted for completed tickets.');
        }

        if ($ticket->feedback) {
            return back()->with('info', 'Feedback already submitted.');
        }

        $request->validate([
            'rating'  => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        Feedback::create([
            'ticket_id' => $ticket->id,
            'user_id'   => Auth::id(),
            'rating'    => $request->rating,
            'comment'   => $request->comment,
        ]);

        return redirect()->route('faculty.tickets.show', $ticket)
            ->with('success', 'Thank you for your feedback!');
    }

    // ─── Admin: View All Feedback ─────────────────────────────────────────────

    public function adminIndex()
    {
        $feedbacks = Feedback::with(['ticket', 'user'])
            ->latest()
            ->paginate(15);

        $avgRating = Feedback::avg('rating');
        $ratingCounts = Feedback::selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating');

        return view('admin.feedback.index', compact('feedbacks', 'avgRating', 'ratingCounts'));
    }
}
