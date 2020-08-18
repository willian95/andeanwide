<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminSendTicketResponseEvent;
use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::orderBy('created_at', 'desc')->paginate(15);
        return view('panel.admin.support.index', [
            'tickets'   => $tickets
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        if(is_null($ticket->received_at)) {
            $ticket->received_at = now();
            $ticket->save();
        }

        return view('panel.admin.support.show', [
            'ticket'    => $ticket
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'response'  => ['required'],
            'isClosed'  => ['accepted']
        ]);

        $ticket->response = $request->input('response');
        $ticket->closed_at = now();
        $ticket->save();

        event(new AdminSendTicketResponseEvent($ticket->user, $ticket));

        return redirect()->route('panel.admin.support.index');

    }
}
