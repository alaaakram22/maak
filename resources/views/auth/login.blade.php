<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-gray-100">

        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">

            <!-- LOGO / TITLE -->
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-blue-600">
                    <a href="{{ url('/') }}">Maak Care</a>
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Sign in to your account
                </p>
            </div>

            <!-- ERRORS -->
            <x-validation-errors class="mb-4" />

            <!-- STATUS -->
            @if (session('status'))
            <div class="mb-4 text-sm text-green-600 text-center">
                {{ session('status') }}
            </div>
            @endif

            <!-- FORM -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- EMAIL -->
                <div>
                    <x-label for="email" value="Email" />
                    <x-input id="email" class="block mt-1 w-full"
                        type="email" name="email"
                        :value="old('email')" required autofocus />
                </div>

                <!-- PASSWORD -->
                <div class="mt-4">
                    <x-label for="password" value="Password" />

                    <div class="relative">
                        <x-input id="password"
                            class="block mt-1 w-full pr-10"
                            type="password"
                            name="password"
                            required />

                        <!-- TOGGLE ICON -->
                        <button type="button"
                            onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-blue-600">

                            <!-- EYE OPEN -->
                            <svg id="eye-open" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5
                       c4.477 0 8.268 2.943 9.542 7
                       -1.274 4.057-5.065 7-9.542 7
                       -4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            <!-- EYE CLOSED -->
                            <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 hidden"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19
                       c-4.478 0-8.268-2.943-9.543-7
                       a9.956 9.956 0 012.293-3.95M6.223 6.223
                       A9.953 9.953 0 0112 5c4.478 0
                       8.268 2.943 9.543 7
                       a9.965 9.965 0 01-4.132 5.411M15
                       12a3 3 0 00-3-3m0 0a3 3 0 00-3 3
                       m3-3v6m0 0l-3-3m3 3l3-3M3 3l18 18" />
                            </svg>

                        </button>
                    </div>
                </div>

                <!-- REMEMBER + FORGOT -->
                <div class="flex items-center justify-between mt-4 text-sm">

                    <label class="flex items-center">
                        <x-checkbox name="remember" />
                        <span class="ms-2 text-gray-600">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-blue-600 hover:text-blue-800 font-medium">
                        Forgot password?
                    </a>
                    @endif
                </div>

                <!-- LOGIN BUTTON -->
                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition">
                        Log in
                    </button>
                </div>

                <!-- SIGN UP -->
                <div class="text-center mt-6 text-sm text-gray-600">
                    Don’t have an account?
                    <a href="{{ route('register') }}"
                        class="text-blue-600 hover:text-blue-800 font-semibold">
                        Sign up
                    </a>
                </div>

            </form>

        </div>

    </div>
    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');

            if (password.type === 'password') {
                password.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                password.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }
    </script>

</x-guest-layout>