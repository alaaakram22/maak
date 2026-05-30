<x-guest-layout>

<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl">

        <!-- LOGO / TITLE -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-blue-600">
                <a href="{{ url('/') }}">Maak Care</a>
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Set a new password
            </p>
        </div>

        <x-validation-errors class="mb-4" />

        <!-- FORM -->
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- TOKEN -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- EMAIL -->
            <div class="mb-4">
                <x-label for="email" value="Email" />
                <x-input id="email"
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
                    :value="old('email', $request->email)"
                    required autofocus />
            </div>

            <!-- PASSWORD -->
            <div class="mb-4 relative" x-data="{ showPassword: false }">
                <x-label for="password" value="New Password" />

                <input :type="showPassword ? 'text' : 'password'"
                    id="password"
                    name="password"
                    class="w-full mt-1 border rounded-lg p-2 pr-10"
                    required />

                <span @click="showPassword = !showPassword"
                    class="absolute right-3 top-9 cursor-pointer text-gray-500">
                    👁
                </span>
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="mb-4 relative" x-data="{ showConfirm: false }">
                <x-label for="password_confirmation" value="Confirm Password" />

                <input :type="showConfirm ? 'text' : 'password'"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="w-full mt-1 border rounded-lg p-2 pr-10"
                    required />

                <span @click="showConfirm = !showConfirm"
                    class="absolute right-3 top-9 cursor-pointer text-gray-500">
                    👁
                </span>
            </div>

            <!-- ACTIONS -->
            <div class="flex items-center justify-between mt-6">

                <a href="{{ route('login') }}"
                    class="text-sm text-blue-600 hover:underline">
                    Back to login
                </a>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow transition">
                    Reset Password
                </button>
                

            </div>

        </form>

    </div>
</div>


</x-guest-layout>
