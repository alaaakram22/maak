<x-guest-layout>


    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl">

            <!-- LOGO / TITLE -->
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-blue-600">
                    <a href="{{ url('/') }}">Maak Care</a>
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Reset your password
                </p>
            </div>

            <!-- DESCRIPTION -->
            <div class="mb-4 text-sm text-gray-600 text-center">
                Forgot your password? Enter your email and we’ll send you a reset link.
            </div>

            <!-- SUCCESS MESSAGE -->
            @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded text-sm">
                {{ session('status') }}
            </div>
            @endif

            <x-validation-errors class="mb-4" />

            <!-- FORM -->
            <form onsubmit="showDemoMessage(event)">

                <!-- EMAIL -->
                <div class="mb-4">
                    <x-label for="email" value="Email" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus />
                </div>

                <!-- HIDDEN WARNING -->
                <div id="demoAlert"
                    class="hidden mb-4 p-3 bg-yellow-100 border border-yellow-300 text-yellow-800 rounded text-sm">

                    Email sending is not configured in project demo.

                    <br><br>

                    In a production environment, a password reset link would be sent to the entered email address.

                </div>

                <!-- ACTIONS -->
                <div class="flex items-center justify-between mt-6">

                    <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">
                        Back to login
                    </a>

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow transition">
                        Send Link
                    </button>

                </div>

            </form>

        </div>
    </div>
    <script>
    function showDemoMessage(event) {
        event.preventDefault();

        document
            .getElementById('demoAlert')
            .classList.remove('hidden');
    }
    </script>

</x-guest-layout>