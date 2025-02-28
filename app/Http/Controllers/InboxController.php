<?php

namespace App\Http\Controllers;

use App\Models\Inbox;
use App\Models\Pengunjung;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_admin()
    {
        // Mengambil semua pesan beserta data pengunjung dari database
        $messages = Inbox::with('pengunjung')->get();

        // Mengirim data pesan dan pengunjung ke view 'inbox.index'
        return view('admin_contents.inbox.inbox_index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation logic
        $validatedData = $request->validate([
            'nama_pengunjung' => 'required|string',
            'email' => 'required|email',
            'subjek' => 'required|string',
            'isi_pesan' => 'required|string',
        ]);

        // Create Pengunjung record if not exists, or retrieve existing record
        $pengunjung = Pengunjung::firstOrCreate(
            ['email' => $validatedData['email']],
            [
                'nama_pengunjung' => $validatedData['nama_pengunjung'],
                'tanggal' => now() // Save current date as 'tanggal'
            ]
        );

        

        // Create Inbox record
        Inbox::create([
            'id_pengunjung' => $pengunjung->id_pengunjung,
            'tanggal' => now(), // Assuming you want to use the current date/time
            'subjek' => $validatedData['subjek'],
            'isi_pesan' => $validatedData['isi_pesan'],
            'status_inbox' => 'penting', // Example default status
            'id_user' => '7',
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data has been submitted successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
