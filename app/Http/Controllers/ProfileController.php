<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\customers;
use App\Models\caregivers;
use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{
   public function update(Request $request)
{
    $user = Auth::user();

    // Validate
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string',
        'gender' => 'nullable|in:Male,Female',
        'date_of_birth' => 'nullable|date',
    ]);

    // Update user
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'gender' => $request->gender,
        'date_of_birth' => $request->date_of_birth,
    ]);

    // ROLE-BASED UPDATE
    if ($user->role == 'customer') {
        customers::updateOrCreate(
    ['user_id' => $user->id],
    [
        'medical_history' => $request->medical_history,
        'address' => $request->address,
    ]
);
       
    }

    if ($user->role == 'caregiver') {

    $caregiver = caregivers::firstOrNew(['user_id' => $user->id]);

    // 📸 Handle image upload
    if ($request->hasFile('image')) {

        // delete old image (optional but recommended)
        if ($caregiver->image) {
            Storage::disk('public')->delete($caregiver->image);
        }

        $caregiver->image = $request->file('image')->store('caregivers', 'public');
    }

    $caregiver->experience = $request->experience;
    $caregiver->skills = $request->skills;
    $caregiver->medical_background = $request->has('medical_background');

    $caregiver->user_id = $user->id;
    $caregiver->save();
}

    return back()->with('success', 'Profile updated successfully!');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = Auth::user();

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('success', 'Password updated successfully!');
}
public function updateAdminProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'nullable',
        'gender' => 'nullable',
        'date_of_birth' => 'nullable',
        'password' => 'nullable|min:8',
    ]);

    $data = $request->only(['name','email','phone','gender','date_of_birth']);

    if ($request->password) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return back()->with('success', 'Admin profile updated!');
}
}
