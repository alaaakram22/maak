@extends('admin.layouts.layout')

@section('body')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Caregivers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind (Jetstream already uses it, but this ensures it loads) -->
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <!-- Page Title -->
    <div class="flex justify-between items-center mb-4 px-4">

        <h1 class="text-2xl font-bold text-blue-600">
            Caregivers List
        </h1>

        <a href="{{ route('caregivers.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Create Caregiver
        </a>

    </div>

    <!-- Container -->
    <div class="max-w-7xl mx-auto px-4">

        <div class="bg-white shadow-lg rounded-xl p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg">

                    <!-- Table Head -->
                    <thead class="bg-gray-100 text-left-bold">
                        <tr>
                            <th class="p-3">#</th>
                            <th class="p-3">Name</th>
                            <th class="p-3">Photo</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Phone</th>
                            <th class="p-3">Gender</th>
                            <th class="p-3">Experience</th>
                            <th class="p-3">Skills</th>
                            <th class="p-3">Medical Background</th>
                            <th class="p-3">Status</th>

                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @forelse($caregivers as $caregiver)
                        <tr class="border-t hover:bg-gray-50 transition">

                            <td class="p-3">{{ $loop->iteration }}</td>

                            <td class="p-3 font-medium">
                                <a href="{{ route('caregivers.edit', $caregiver->id) }}"
                                    class="text-blue-600 hover:underline hover:text-blue-800">
                                    {{ $caregiver->user->name }}
                                </a>
                            </td>
                            
                            <td class="p-3">
                                @php
                                $image = $caregiver->image
                                ? asset('storage/' . $caregiver->image)
                                : asset('images/default-caregiver.png');
                                @endphp

                                <img src="{{ $image }}"
                                    class="w-10 h-10 rounded-full object-cover border">
                            </td>

                            <td class="p-3">
                                {{ $caregiver->user->email }}
                            </td>

                            <td class="p-3">
                                {{ $caregiver->user->phone ?? '-' }}
                            </td>

                            <td class="p-3">
                                {{ $caregiver->user->gender ?? '-' }}
                            </td>

                            <td class="p-3">
                                {{ $caregiver->experience ?? 0 }} yrs
                            </td>

                            <td class="p-3">
                                {{ $caregiver->skills ?? '-' }}
                            </td>
                            <td>
                                @if($caregiver->medical_background)
                                <span class="text-green-600 font-semibold">Medical</span>
                                @else
                                <span class="text-gray-500">Non-medical</span>
                                @endif
                            </td>

                            <td class="p-3">
                                <div class="flex gap-2">

                                    <!-- APPROVE -->
                                    <form method="POST" action="{{ route('caregivers.status', $caregiver->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="active">

                                        <button
                                            class="px-3 py-1 rounded text-white text-sm
                                      {{ $caregiver->status == 'active' ? 'bg-green-700' : 'bg-green-300 hover:bg-green-600' }}">
                                            ✔ Approve
                                        </button>
                                    </form>

                                    <!-- PENDING -->
                                    <form method="POST" action="{{ route('caregivers.status', $caregiver->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="pending">

                                        <button
                                            class="px-3 py-1 rounded text-white text-sm
                                         {{ $caregiver->status == 'pending' ? 'bg-yellow-700' : 'bg-yellow-300 hover:bg-yellow-600' }}">
                                            ⏳ Pending
                                        </button>
                                    </form>

                                    <!-- DISABLE -->
                                    <form method="POST" action="{{ route('caregivers.status', $caregiver->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="inactive">

                                        <button
                                            class="px-3 py-1 rounded text-white text-sm
                                         {{ $caregiver->status == 'inactive' ? 'bg-red-700' : 'bg-red-300 hover:bg-red-600' }}">
                                            ✖ Disable
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center p-4 text-gray-500">
                                No caregivers found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>

</body>

</html>

@endsection