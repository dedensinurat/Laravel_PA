<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fasilitas = Fasilitas::all();;

        return view('admin_contents.fasilitas.fasilitas_index', compact('fasilitas'));
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
         try {
             // Validate data received from the form including the image file
             $validatedData = $request->validate([
                 'nama_fasilitas' => 'required|string|max:255',
                 'deskripsi_fasilitas' => 'required|string',
                 'jumlah' => 'required|integer',
                 'kondisi' => 'required|string|max:255',
                 'lokasi' => 'required|string|max:255',
                 'gambar_fasilitas' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ensure it's an image file and meets size constraints
             ]);
     
             // Get the currently authenticated user
             $user = session('id_user');
     
             // Ensure the user is authenticated and has an ID
             if ($user) {
                 // Create a new Fasilitas instance
                 $fasilitas = new Fasilitas();
                 $fasilitas->nama_fasilitas = $validatedData['nama_fasilitas'];
                 $fasilitas->deskripsi = $validatedData['deskripsi_fasilitas'];
                 $fasilitas->jumlah = $validatedData['jumlah'];
                 $fasilitas->kondisi = $validatedData['kondisi'];
                 $fasilitas->lokasi = $validatedData['lokasi'];
     
                 // Check if an image file is uploaded
                 if ($request->hasFile('gambar_fasilitas')) {
                     // Mendapatkan nama file dengan ekstensi
                     $fileNameWithExt = $request->file('gambar_fasilitas')->getClientOriginalName();
                     // Mendapatkan nama file tanpa ekstensi
                     $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                     // Mendapatkan ekstensi file
                     $extension = $request->file('gambar_fasilitas')->getClientOriginalExtension();
                     // Nama file yang akan disimpan
                     $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                     // Simpan file gambar ke folder public/images
                     $path = $request->file('gambar_fasilitas')->storeAs('public/images', $fileNameToStore);
                     // Ubah path menjadi URL
                     $imgPath = 'images/' . $fileNameToStore;
     
                     // Hapus gambar lama jika ada
                     if ($fasilitas->img_fasilitas) {
                         Storage::delete('public/images/' . $fasilitas->img_fasilitas);
                     }
     
                     // Set the image path in the Fasilitas model
                     $fasilitas->img_fasilitas = $imgPath;
                 }
     
                 // Associate the user ID with the Fasilitas record
                 $fasilitas->id_user = $user;
     
                 // Save the new Fasilitas record
                 $fasilitas->save();
     
                 // Redirect to a specific page after successfully saving the data
                 return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan.');
             }
     
             // If user is not authenticated or doesn't have an ID, handle the scenario accordingly
             return redirect()->back()->with('error', 'Gagal menyimpan fasilitas. Mohon coba lagi.');
         } catch (\Exception $e) {
             // Handle exceptions and provide error messages
             return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan fasilitas: ' . $e->getMessage());
         }
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
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi_fasilitas' => 'required|string',
            'jumlah' => 'required|integer',
            'kondisi' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'gambar_fasilitas' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Updated validation for image upload
        ]);
    
        try {
            $fasilitas = Fasilitas::findOrFail($id);
            $fasilitas->update([
                'nama_fasilitas' => $request->input('nama_fasilitas'),
                'deskripsi' => $request->input('deskripsi_fasilitas'),
                'jumlah' => $request->input('jumlah'),
                'kondisi' => $request->input('kondisi'),
                'lokasi' => $request->input('lokasi'),
            ]);
    
            // Check if an image file is uploaded
            if ($request->hasFile('gambar_fasilitas')) {
                $imgPath = $fasilitas->img_fasilitas;
                if ($imgPath) {
                    Storage::disk('public')->delete($imgPath); // Menghapus gambar lama
                }
                // Mendapatkan nama file dengan ekstensi
                $fileNameWithExt = $request->file('gambar_fasilitas')->getClientOriginalName();
                // Mendapatkan nama file tanpa ekstensi
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Mendapatkan ekstensi file
                $extension = $request->file('gambar_fasilitas')->getClientOriginalExtension();
                // Nama file yang akan disimpan
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                // Simpan file gambar ke folder public/images
                $imagePath = $request->file('gambar_fasilitas')->storeAs('public/images', $fileNameToStore);
                // Set the image path in the Fasilitas model
                $fasilitas->img_fasilitas = 'images/' . $fileNameToStore;
                $fasilitas->save();
            }
    
            session()->flash('success', 'Fasilitas berhasil diperbarui.');
            return redirect()->route('fasilitas.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat memperbarui fasilitas: ' . $e->getMessage());
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
        try {
            $fasilitas = Fasilitas::findOrFail($id);
            $fasilitas->delete();

            session()->flash('success', 'Fasilitas berhasil dihapus.');
            return redirect()->route('fasilitas.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus fasilitas: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
