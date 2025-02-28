<?php

namespace App\Http\Controllers;

use App\Models\Sejarah;
use Illuminate\Http\Request;

class SejarahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sejarah = Sejarah::all();;

        return view('admin_contents.sejarah.sejarah_index', compact('sejarah'));
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
        //
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
        // Validate the incoming request
        $validatedData = $request->validate([
            'tahun' => 'required|numeric',
            'deskripsi' => 'required|string',
            'sumber' => 'nullable|string',
        ]);
    
        try {
            // Find the history record by its ID
            $history = Sejarah::findOrFail($id);
    
            // Update the history record with the validated data
            $history->update([
                'tahun' => $validatedData['tahun'],
                'deskripsi' => $validatedData['deskripsi'],
                'sumber' => $validatedData['sumber'],
            ]);
    
            // Flash a success message and redirect to the index page
            session()->flash('success', 'Sejarah berhasil diperbarui.');
            return redirect()->route('sejarah.index');
        } catch (\Exception $e) {
            // Flash an error message and redirect back with input
            session()->flash('error', 'Terjadi kesalahan saat memperbarui sejarah: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
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
