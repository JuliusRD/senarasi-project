<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function getevents(Request $request)
    {
        $events = Booking::with(['user', 'guests.user', 'externalGuests'])
            ->where('room_id', $request->room_id)
            ->whereDate('start', '>=', $request->start)
            ->whereDate('end', '<=', $request->end)
            ->get(['id', 'desc as title', 'start', 'end', 'employee_id']);

        $events = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
                'employee_id' => $event->employee_id,
                'extendedProps' => [
                    'user' => $event->user,

                    'guests' => $event->guests->map(function ($guest) {
                        return $guest->user->full_name;
                    })->toArray(),

                    'externalGuests' => $event->externalGuests->map(function ($externalGuest) {
                    return $externalGuest->email;
                    })->toArray(),
                ],
            ];
        });

        return response()->json(['events' => $events]);
    }
}
