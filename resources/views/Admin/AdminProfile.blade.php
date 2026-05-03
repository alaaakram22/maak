@extends('Admin.layouts.layout')
@section('body')


    <h2 class="text-2xl font-bold text-black mb-6">
        👤 Admin Profile
    </h2>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.profile.update') }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-6">

            <!-- NAME -->
            <div>
                <label class="block text-sm font-medium">Name</label>
                <input type="text" name="name" value="{{ auth()->user()->name }}"
                       class="w-full mt-1 border rounded-lg p-2 focus:ring focus:ring-blue-200">
            </div>

            <!-- EMAIL -->
            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ auth()->user()->email }}"
                       class="w-full mt-1 border rounded-lg p-2">
            </div>

            <!-- PHONE -->
            <div>
                <label class="block text-sm font-medium">Phone</label>
                <input type="text" name="phone" value="{{ auth()->user()->phone }}"
                       class="w-full mt-1 border rounded-lg p-2">
            </div>

            <!-- GENDER -->
            <div>
                <label class="block text-sm font-medium">Gender</label>
                <select name="gender" class="w-full mt-1 border rounded-lg p-2">
                    <option value="Male" {{ auth()->user()->gender == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ auth()->user()->gender == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <!-- DOB -->
            <div>
                <label class="block text-sm font-medium">Date of Birth</label>
                <input type="date" name="date_of_birth"
                       value="{{ auth()->user()->date_of_birth }}"
                       class="w-full mt-1 border rounded-lg p-2">
            </div>

            

        </div>

        <!-- PASSWORD CHANGE -->
        <div class="mt-6">
            <label class="block text-sm font-medium">New Password (optional)</label>
            <input type="password" name="password"
                   class="w-600 mt-1 border rounded-lg p-2">
        </div>

        <!-- SUBMIT -->
        <div class="mt-6 text-right">
            <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                💾 Update Profile
            </button>
        </div>

    </form>



@endsection