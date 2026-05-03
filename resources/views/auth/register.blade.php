<x-guest-layout>


<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-lg bg-white p-8 rounded-2xl shadow-xl">

        <!-- LOGO / TITLE -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-blue-600">
                <a href="{{ url('/') }}">Maak Care</a>
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Create your account
            </p>
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div x-data="{ role: 'customer', showPassword: false, showConfirm: false }">

                <!-- ROLE SELECTION -->
                <div class="grid grid-cols-2 gap-4 mb-6">

                    <button type="button"
                        @click="role = 'customer'"
                        :class="role === 'customer'
                        ? 'bg-green-500 text-white border-green-500 shadow-lg scale-105'
                        : 'bg-white text-gray-700 border-gray-300'"
                        class="p-4 border-2 rounded-xl transition transform hover:scale-105">

                        <div class="font-bold">👤 Customer</div>
                        <p class="text-xs mt-1">Book caregivers</p>
                    </button>

                    <button type="button"
                        @click="role = 'caregiver'"
                        :class="role === 'caregiver'
                        ? 'bg-blue-500 text-white border-blue-500 shadow-lg scale-105'
                        : 'bg-white text-gray-700 border-gray-300'"
                        class="p-4 border-2 rounded-xl transition transform hover:scale-105">

                        <div class="font-bold">🩺 Caregiver</div>
                        <p class="text-xs mt-1">Provide services</p>
                    </button>

                </div>

                <input type="hidden" name="role" :value="role">

                <!-- NAME -->
                <div class="mb-4">
                    <x-label value="Full Name" />
                    <x-input name="name" :value="old('name')" class="block w-full mt-1" required />
                </div>

                <!-- EMAIL -->
                <div class="mb-4">
                    <x-label value="Email" />
                    <x-input name="email" type="email" :value="old('email')" class="block w-full mt-1" required />
                </div>

                <!-- PASSWORD -->
                <div class="mb-4 relative">
                    <x-label value="Password" />
                    <input :type="showPassword ? 'text' : 'password'" name="password"
                        class="w-full mt-1 border rounded-lg p-2 pr-10" required>

                    <span @click="showPassword = !showPassword"
                        class="absolute right-3 top-9 cursor-pointer text-gray-500">
                        👁
                    </span>
                </div>

                <!-- CONFIRM PASSWORD -->
                <div class="mb-4 relative">
                    <x-label value="Confirm Password" />
                    <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation"
                        class="w-full mt-1 border rounded-lg p-2 pr-10" required>

                    <span @click="showConfirm = !showConfirm"
                        class="absolute right-3 top-9 cursor-pointer text-gray-500">
                        👁
                    </span>
                </div>

                <!-- PHONE -->
                <div class="mb-4">
                    <x-label value="Phone" />
                    <x-input name="phone" :value="old('phone')" class="block w-full mt-1" />
                </div>

                <!-- GENDER -->
                <div class="mb-4">
                    <x-label value="Gender" />
                    <select name="gender" class="w-full border rounded mt-1 p-2">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <!-- DOB -->
                <div class="mb-4">
                    <x-label value="Date of Birth" />
                    <x-input name="date_of_birth" type="date" class="block w-full mt-1" />
                </div>

                <!-- CUSTOMER -->
                <template x-if="role === 'customer'">
                    <div class="mt-4 border-t pt-4">

                        <div class="mb-3">
                            <x-label value="Medical History" />
                            <textarea name="medical_history"
                                class="w-full border rounded mt-1 p-2"></textarea>
                        </div>

                        <div>
                            <x-label value="Address" />
                            <x-input name="address" class="block w-full mt-1" />
                        </div>

                    </div>
                </template>

                <!-- CAREGIVER -->
                <template x-if="role === 'caregiver'">
                    <div class="mt-4 border-t pt-4">

                        <div class="mb-3">
                            <x-label value="Experience (years)" />
                            <x-input name="experience" type="number" class="block w-full mt-1" />
                        </div>

                        <div class="mb-3">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="medical_background" value="1">
                                Medical Background
                            </label>
                        </div>

                        <div class="mb-3">
                            <x-label value="Skills" />
                            <x-input name="skills" class="block w-full mt-1" />
                        </div>

                        <div>
                            <x-label value="Profile Image" />
                            <input type="file" name="image"
                                class="w-full border rounded mt-1 p-2">
                        </div>

                    </div>
                </template>

            </div>

            <!-- TERMS -->
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4 text-sm">
                    <label class="flex items-center">
                        <x-checkbox name="terms" required />
                        <span class="ml-2">
                            I agree to the
                            <a href="{{ route('terms.show') }}" class="text-blue-600 underline">Terms</a>
                            and
                            <a href="{{ route('policy.show') }}" class="text-blue-600 underline">Privacy Policy</a>
                        </span>
                    </label>
                </div>
            @endif

            <!-- ACTIONS -->
            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">
                    Already have an account?
                </a>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow transition">
                    Register
                </button>
            </div>

        </form>

    </div>
</div>
```

</x-guest-layout>
