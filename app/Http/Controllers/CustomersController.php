<?php

namespace App\Http\Controllers;

use App\Models\customers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomersController extends Controller
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
        return view('admin.createCustomer');
    }

    /**
     * Store new customer
     */
    public function store(Request $request)
    {
        $request->validate([
            // user
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone' => 'required|string|max:20',
            'gender' => 'required',
            'date_of_birth' => 'required|date',

            // customer
            'medical_history' => 'nullable|string',
            'address' => 'required|string',
        ]);

        return DB::transaction(function () use ($request) {

            // create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'customer',
                'phone' => $request->phone,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
            ]);

            // create customer
            customers::create([
                'user_id' => $user->id,
                'medical_history' => $request->medical_history,
                'address' => $request->address,
            ]);

            return redirect()->route('allCustomers')
                ->with('success', 'Customer created successfully');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(customers $customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(customers $customer)
    {
        $customer->load('user');

        return view('admin.editCustomer', compact('customer'));
    }

    /**
     * Update customer
     */
    public function update(Request $request, customers $customer)
    {
        $request->validate([
            // user
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'gender' => 'required',
            'date_of_birth' => 'required|date',

            // customer
            'medical_history' => 'nullable|string',
            'address' => 'required|string',
        ]);

        DB::transaction(function () use ($request, $customer) {

            // update user
            $customer->user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
            ]);

            // update customer
            $customer->update([
                'medical_history' => $request->medical_history,
                'address' => $request->address,
            ]);
        });

        return redirect()->route('allCustomers')
            ->with('success', 'Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(customers $customers)
    // {
    //     //
    // }
    public function allCustomers()
    {
        $customers = customers::with('user')->get();

        return view('Admin/allCustomers', compact('customers'));
    }

    public function destroy($id)
    {
        $customer = customers::findOrFail($id);

        // delete related user (this will also delete customer if cascade is set)
        $customer->user()->delete();

        return redirect()->back()->with('success', 'Customer deleted successfully!');
    }
    public function updateStatus(Request $request, Booking $booking)
{
    $request->validate([
        'health_status' => 'required|in:normal,moderate,critical',
        'health_notes' => 'nullable|string|max:2000',
    ]);

    $customerProfile = $booking->customer->customer;

    $customerProfile->update([
        'health_status' => $request->health_status,
        'health_notes' => $request->health_notes,
    ]);

    return back()->with('success', 'Customer health updated successfully.');
}
}
