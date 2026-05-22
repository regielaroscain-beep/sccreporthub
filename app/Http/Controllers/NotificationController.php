<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // ─── List Notifications ───────────────────────────────────────────────────

    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->with('ticket')
            ->latest()
            ->paginate(20);

        // Mark all as read when viewing the list
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('notifications.index', compact('notifications'));
    }

    // ─── Get Unread Count (AJAX) ──────────────────────────────────────────────

    public function unreadCount()
    {
        $count = Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }

    // ─── Get Recent Notifications (AJAX) ──────────────────────────────────────

    public function recent()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($n) => [
                'id'         => $n->id,
                'message'    => $n->message,
                'is_read'    => $n->is_read,
                'type'       => $n->type,
                'ticket_id'  => $n->ticket_id,
                'created_at' => $n->created_at->diffForHumans(),
            ]);

        return response()->json($notifications);
    }

    // ─── Mark Single as Read ──────────────────────────────────────────────────

    public function markRead(Notification $notification)
    {
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    // ─── Mark All as Read ─────────────────────────────────────────────────────

    public function markAllRead()
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return back()->with('success', 'All notifications marked as read.');
    }
}
