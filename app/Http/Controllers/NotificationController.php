<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        DB::table('notifications')
            ->where('id', $id)
            ->where('student_id', session('student_id'))
            ->update(['read' => true]);

        return back();
    }
}