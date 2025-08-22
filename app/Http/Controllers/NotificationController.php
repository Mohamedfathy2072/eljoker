<?php

namespace App\Http\Controllers;

use App\Const\NotificationTypes;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{
    public function getForUser(): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            return ApiResponse::error('Unauthenticated.', 401);
        }

        $notifications = Notification::where(function($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->orWhere('type', 'topic');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return ApiResponse::success(
            NotificationResource::collection($notifications),
            'Notifications retrieved successfully'
        );
    }
}
