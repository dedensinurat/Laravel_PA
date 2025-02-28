<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\UserWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data user
        $users = UserWeb::all();

        // Mengirim data user ke view users.index
        return view('admin_contents.user.user_login_index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = UserWeb::getEnumValues('role'); // Replace 'role' with your enum column name
        return view('admin_contents.user.user_login_create', ['roles' => $roles]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:user_web', // Ensure username uniqueness in 'users' table
            'email' => 'required|email|max:255|unique:user_web', // Ensure email uniqueness in 'users' table
            'password' => 'required|string|min:6',
            'alamat' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'role' => 'required|in:admin,guru,staf', // Ensure role is one of the specified values
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'username.required' => 'Username is required.',
            'username.string' => 'Username must be a string.',
            'username.max' => 'Username may not be greater than 255 characters.',
            'username.unique' => 'This username has already been taken.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.max' => 'Email may not be greater than 255 characters.',
            'email.unique' => 'This email has already been taken.',
            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a string.',
            'password.min' => 'Password must be at least 6 characters long.',
            'alamat.string' => 'Address must be a string.',
            'alamat.max' => 'Address may not be greater than 255 characters.',
            'no_telepon.string' => 'Phone must be a string.',
            'no_telepon.max' => 'Phone may not be greater than 20 characters.',
            'role.required' => 'Role is required.',
            'role.in' => 'Invalid role.',
            'image.image' => 'The image must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2048 kilobytes in size.',
        ]);

        // Hash the password before saving it to the database
        $validatedData['password'] = Hash::make($validatedData['password']);


        // Handle file upload for image
        if ($request->hasFile('image')) {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            $validatedData['image'] = 'images/' . $fileNameToStore; // Update the column name
        }

        // Create a new user record with the validated data
        UserWeb::create($validatedData);

        // Redirect to a success page or return a success response
        return redirect()->route('admin.home')->with('success', 'User successfully added.');
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
         // Validate the incoming request data
         $validatedData = $request->validate([
             'username' => 'required|string|max:255|unique:user_web,username,' . $id . ',id_user',
             'email' => 'required|email|max:255',
             'alamat' => 'nullable|string|max:255',
             'no_telepon' => 'nullable|string|max:20',
             'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
         ]);
     
         try {
             // Find the user by 'id_user'
             $user = UserWeb::where('id_user', $id)->firstOrFail();
     
             if ($user->role === 'guru') {
                 $teacher = Teacher::where('nama', $user->username)->firstOrFail();
     
                 // Update teacher data with validated data
                 $teacher->nama = $validatedData['username'];
                 $teacher->alamat = $validatedData['alamat'];
     
                 // Handle file upload for foto_profil
                 if ($request->hasFile('image')) {
                     $fileNameWithExt = $request->file('image')->getClientOriginalName();
                     $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                     $extension = $request->file('image')->getClientOriginalExtension();
                     $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                     $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
     
                     // Delete the old profile picture if exists
                     if ($teacher->foto_profil) {
                         Storage::delete('public/images/' . basename($teacher->foto_profil));
                     }
     
                     $teacher->foto_profil = 'images/' . $fileNameToStore;
                 }
     
                 $teacher->save();
             }
     
             // Update user data with validated data
             $user->username = $validatedData['username'];
             $user->email = $validatedData['email'];
             $user->alamat = $validatedData['alamat'];
             $user->no_telepon = $validatedData['no_telepon'] ?? null;
     
             // Handle file upload for image only if a new image is uploaded
             if ($request->hasFile('image')) {
                 $fileNameWithExt = $request->file('image')->getClientOriginalName();
                 $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                 $extension = $request->file('image')->getClientOriginalExtension();
                 $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                 $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
                 $user->image = 'images/' . $fileNameToStore;
             }
     
             $user->save();
     
             return redirect()->route('admin.home')->with('success', 'User successfully updated.');
     
         } catch (\Exception $e) {
             session()->flash('error', 'An error occurred while updating the user: ' . $e->getMessage());
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
        // Find the user by ID
        $user = UserWeb::find($id);

        // Check if the user exists
        if ($user) {
            // Check the role of the user
            if ($user->role === 'guru') {
                // Find the associated teacher
                $teacher = Teacher::where('nama', $user->username)->first();

                // Check if the teacher exists
                if ($teacher) {
                    // Delete the teacher
                    $teacher->delete();
                }
            }

            // Delete the user
            $user->delete();

            // Redirect with success message
            return redirect()->route('admin.home')->with('success', 'User and associated data successfully deleted.');
        }

        // Redirect with error message if user not found
        return redirect()->route('admin.home')->with('error', 'User not found.');
    }
}
