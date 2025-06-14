<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    /**
     * Display a listing of the notifications for the authenticated user.
     */
    public function index(): JsonResponse
    {
        $notifications = Notification::with(['user', 'event'])
            ->where('user_id', Auth::id())
            ->orderBy('reminder_time', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $notifications
        ]);
    }
    
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'reminder_time' => 'required|date',
            'event_id' => 'required|exists:events,id'
        ]);
        
        $notification = Notification::create([
            'message' => $validated['message'],
            'reminder_time' => $validated['reminder_time'],
            'event_id' => $validated['event_id'],
            'user_id' => Auth::id(),
            'is_read' => false
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Notificación creada exitosamente',
            'data' => $notification
        ], 201);
    }

    public function show(Notification $notification): JsonResponse
    {
        if ($notification->user_id !== Auth::id()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No tienes permiso para ver esta notificación'
            ], 403);
        }
        $notification->load(['user', 'event']);
        return response()->json([
            'status' => 'success',
            'data' => $notification
        ]);
    }

    public function update(Request $request, Notification $notification): JsonResponse
    {

        if ($notification->user_id !== Auth::id()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No tienes permiso para actualizar esta notificación'
            ], 403);
        }

        $validated = $request->validate([
            'message' => 'sometimes|string',
            'reminder_time' => 'sometimes|date',
            'is_read' => 'sometimes|boolean'
        ]);

        $notification->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Notificación actualizada exitosamente',
            'data' => $notification
        ]);
    }

    /**
     * Remove the specified notification.
     */
    public function destroy(Notification $notification): JsonResponse
    {
        if ($notification->user_id !== Auth::id()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No tienes permiso para eliminar esta notificación'
            ], 403);
        }

        $notification->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Notificación eliminada exitosamente'
        ]);
    }
}
