<?php

namespace maze\Http\Controllers;

use Illuminate\Http\Request;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;

use Auth;

class NotificationsController extends Controller
{
    public function markAsRead($id)
    {
        $user = Auth::user();
        $user->notifications()->where('id', $id)->update('is_read', true);

        return response()->json('OK');
    }

    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->notifications()->update('is_read', true);
        return response()->json('OK');
    }
}
