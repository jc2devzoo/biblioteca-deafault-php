<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;


class UsersControllers extends Controller
{
   public function index()
   {
      return view('master');
   }

   public function create()
   {
      return view('users_create');
   }

   public function store(Request $request)
   {
      // Validate the request data
      $validatedData = $request->validate([
         'name' => 'required|string|max:255',
         'email' => 'required|string|email|max:255|unique:users',
         'password' => 'required|string|min:8|confirmed',
      ]);

      // Create a new user record in the database
      $user = new user();
      $user->name = $validatedData['name'];
      $user->email = $validatedData['email'];
      $user->password = bcrypt($validatedData['password']);
      $user->save();

      // Redirect or return a response
      return redirect()->route('users.index')->with('success', 'User created successfully.');
   }

   public function show($id)
   {
      // Retrieve the user by its ID
      $user = user::findOrFail($id);

      // Return a view with the user details
      return view('users_show', compact('user'));
   }

   public function edit($id)
   {
      // Retrieve the user by its ID
      $user = user::findOrFail($id);

      // Return a view with the user details for editing
      return view('users_edit', compact('user'));
   }

   public function update(Request $request, $id)
   {
      // Validate the request data
      $validatedData = $request->validate([
         'name' => 'required|string|max:255',
         'email' => 'required|string|email|max:255|unique:users,email,' . $id,
         'password' => 'nullable|string|min:8|confirmed',
      ]);

      // Retrieve the user by its ID
      $user = user::findOrFail($id);

      // Update the user attributes
      $user->name = $validatedData['name'];
      $user->email = $validatedData['email'];
      if (!empty($validatedData['password'])) {
         $user->password = bcrypt($validatedData['password']);
      }
      $user->save();

      // Redirect or return a response
      return redirect()->route('users.index')->with('success', 'User updated successfully.');
   }

   public function destroy($id)
   {
      // Retrieve the user by its ID
      $user = user::findOrFail($id);

      // Delete the user from the database
      $user->delete();

      // Redirect or return a response
      return redirect()->route('users.index')->with('success', 'User deleted successfully.');
   }
}
