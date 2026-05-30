<?php

namespace App\Http\Controllers;

use App\Models\caregivers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CaregiversController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.createCaregiver');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // User data
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'phone' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'in:Male,Female'],
            'date_of_birth' => ['required', 'date'],

            // Caregiver data
            'experience' => ['required', 'integer', 'min:0'],
            'skills' => ['required', 'string'],
            'hourly_rate' => ['nullable', 'numeric'],
            'medical_background' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        return DB::transaction(function () use ($request) {

            // 📸 Upload image
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('caregivers', 'public');
            }

            // 👤 Create User first
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'caregiver', // force role
                'phone' => $request->phone,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
            ]);

            // 🧑‍⚕️ Create Caregiver linked to user
            caregivers::create([
                'user_id' => $user->id,
                'experience' => $request->experience,
                'skills' => $request->skills,
                'hourly_rate' => $request->hourly_rate,
                'medical_background' => $request->medical_background ?? false,
                'image' => $imagePath,
                'status' => 'pending', // default from DB but explicit is better
            ]);

            return redirect()->route('allCaregivers')
                ->with('success', 'Caregiver created successfully');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $caregiver = caregivers::with('user')->findOrFail($id);

        return view('User\pages\caregiver_details', compact('caregiver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(caregivers $caregiver)
    {
        return view('admin.editCaregiver', compact('caregiver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, caregivers $caregiver)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'experience' => 'required',
            'skills' => 'required',
            'hourly_rate' => 'nullable|numeric',
            'medical_background' => 'boolean',
            'image' => 'nullable|image',
        ]);

        // update user
        $caregiver->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
        ]);

        // image upload
        $imagePath = $caregiver->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('caregivers', 'public');
        }

        // update caregiver
        $caregiver->update([
            'experience' => $request->experience,
            'skills' => $request->skills,
            'hourly_rate' => $request->hourly_rate,
            'medical_background' => $request->medical_background,
            'image' => $imagePath,
        ]);

        return redirect()->route('allCaregivers')
            ->with('success', 'Caregiver updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(caregivers $caregivers)
    {
        //
    }
    public function allCaregivers()
    {
        $caregivers = caregivers::with('user')->get();

        return view('Admin/allCaregivers', compact('caregivers'));
    }

    public function updateStatus(Request $request, $id)
    {
        $caregiver = caregivers::findOrFail($id);

        $request->validate([
            'status' => 'required|in:active,inactive,pending'
        ]);

        $caregiver->status = $request->status;
        $caregiver->save();

        return back()->with('success', 'Status updated!');
    }
    public function medical()
    {
        $caregivers = caregivers::where('medical_background', true)
            ->where('status', 'active')
            ->with('user')
            ->get();

        return view('User.pages.medicalCaregivers', compact('caregivers'));
    }
    public function caring()
    {
        $caregivers = caregivers::where('medical_background', false)
            ->where('status', 'active')
            ->with('user')
            ->get();

        return view('User.pages.caring-Caregivers', compact('caregivers'));
    }
}
