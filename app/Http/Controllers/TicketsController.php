<?php

namespace App\Http\Controllers;

use App\BookingRecord;
use App\Http\Requests\TicketsStoreRequest;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketsController extends Controller
{
    public function store(TicketsStoreRequest $request)
    {
        $ticket = Ticket::FindorFail(1);

        if(DB::select('select * from booking_records where email = "'. $request["email"] . '" && ticket_type = "' . $request["ticket_type"] .'"' ))
        {
            $errors['email'] = 'This email address already used to book a '. $request["ticket_type"] . ' ticket';
        }
        else
        {
            if($request['ticket_type'] == 'student' && $ticket->student <= 0 )
            {
                Session()->flash('student_ticket', 'Sorry student tickets sold out');
            }
            elseif($request['ticket_type'] == 'normal' && $ticket->normal <= 0 )
            {
                Session()->flash('normal_ticket', 'Sorry normal tickets sold out');
            }
            else
            {
                BookingRecord::create($request->all());

                if ($request['ticket_type'] == 'student')
                {
                    $new_ticket = $ticket->student - 1;

                    $ticket->update(['student' => $new_ticket]);
                }
                elseif ($request['ticket_type'] == 'normal')
                {
                    $new_ticket = $ticket->normal - 1;

                    $ticket->update(['normal' => $new_ticket]);
                }

                Session()->flash('booked_successfully', 'You have booked your ticket successfully');
            }

            return redirect()->back();
        }

        return redirect()->back()->withErrors($errors);
    }

    /*

     */
}
