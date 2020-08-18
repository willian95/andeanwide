<?php

namespace App\Http\Controllers\User;

use App\Ticket;
use App\Traits\SaveImage;
use Illuminate\Http\Request;
use App\Events\UserSendTicketEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    use SaveImage;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $tickets = Ticket::where('user_id', $user->id)->paginate();
        return view('panel.user.support.index', [
            'tickets'   => $tickets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('panel.user.support.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'     => ['required', 'max:50'],
            'category'  => ['required'],
            'content'   => ['required'],
            'image'     => ['nullable', 'image', 'max:1024']
        ]);

        $user = Auth::user();
        $image_url = null;
        if($request->file('image')) $image_url = $this->saveImage($request->file('image'), "images/user/$user->id/tickets");


        $ticket = Ticket::create([
            'user_id'   => $user->id,
            'title'     => $request->input('title'),
            'category'  => $request->input('category'),
            'content'   => $request->input('content'),
            'image_url' => $image_url
        ]);

        event(new UserSendTicketEvent($user, $ticket));

        return redirect()->route('panel.user.support.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('panel.user.support.show', [
            'ticket'    => $ticket
        ]);
    }
}
