@include('user.partials.header')

<div class="pt-24">

    <div class="max-w-5xl mx-auto mt-10">

       

  
    <div class="max-w-5xl mx-auto mt-10">

        <!-- HEADER -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                👤 My Profile
            </h1>
            <p class="text-gray-500">
                Manage your account information
            </p>
        </div>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
        @endif

        <!-- PROFILE FORM -->
        <div class="bg-white shadow-lg rounded-xl p-8">

            <form method="POST" action="{{ route('profile.update.custom') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="flex flex-col items-center mb-6">
                    @php
                    $caregiver = auth()->user()->caregiver;
                    $image = $caregiver && $caregiver->image
                    ? asset('storage/' . $caregiver->image)
                    : asset('images/default-caregiver.png');
                    @endphp

                    <img id="preview"
                        src="{{ $image }}"
                        class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 shadow mb-3">
                    @if(auth()->user()->role == 'caregiver')
                    <input type="file" name="image" accept="image/*"
                        onchange="previewImage(event)"
                        class="text-sm">
                    @endif
                </div>
                <!-- BASIC INFO -->
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    Basic Information
                </h2>

                <div class="grid grid-cols-2 gap-6">

                    <!-- NAME -->
                    <div>
                        <label class="text-sm">Name</label>
                        <input type="text" name="name"
                            value="{{ old('name', auth()->user()->name) }}"
                            class="w-full mt-1 border rounded-lg p-2">
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="text-sm">Email</label>
                        <input type="email" name="email"
                            value="{{ old('email', auth()->user()->email) }}"
                            class="w-full mt-1 border rounded-lg p-2">
                    </div>

                    <!-- PHONE -->
                    <div>
                        <label class="text-sm">Phone</label>
                        <input type="text" name="phone"
                            value="{{ old('phone', auth()->user()->phone) }}"
                            class="w-full mt-1 border rounded-lg p-2">
                    </div>

                    <!-- GENDER -->
                    <div>
                        <label class="text-sm">Gender</label>
                        <select name="gender" class="w-full mt-1 border rounded-lg p-2">
                            <option value="Male" {{ old('gender', auth()->user()->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', auth()->user()->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <!-- DOB -->
                    <div>
                        <label class="text-sm">Date of Birth</label>
                        <input type="date" name="date_of_birth"
                            value="{{ old('date_of_birth', auth()->user()->date_of_birth) }}"
                            class="w-full mt-1 border rounded-lg p-2">
                    </div>

                    <!-- ROLE -->
                    <div>
                        <label class="text-sm">Role</label>
                        <input type="text"
                            value="{{ auth()->user()->role }}"
                            class="w-full mt-1 border rounded-lg p-2 bg-gray-100"
                            readonly>
                    </div>

                </div>

                <!-- ROLE BASED SECTION -->

                @if(auth()->user()->role == 'customer')

                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4 text-blue-600">
                        Customer Information
                    </h2>

                    <div>
                        <label class="text-sm">Medical History</label>
                        <textarea name="medical_history"
                            class="w-full mt-1 border rounded-lg p-2">{{ old('medical_history', optional(auth()->user()->customer)->medical_history) }}</textarea>
                    </div>

                    <div class="mt-4">
                        <label class="text-sm">Address</label>
                        <input type="text" name="address"
                            value="{{ old('address', optional(auth()->user()->customer)->address) }}"
                            class="w-full mt-1 border rounded-lg p-2">
                    </div>
                </div>

                @elseif(auth()->user()->role == 'caregiver')

                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4 text-green-600">
                        Caregiver Information
                    </h2>

                    <div class="grid grid-cols-2 gap-6">

                        <div>
                            <label class="text-sm">Experience (years)</label>
                            <input type="number" name="experience"
                                value="{{ old('experience', optional(auth()->user()->caregiver)->experience) }}"
                                class="w-full mt-1 border rounded-lg p-2">
                        </div>

                        <div>
                            <label class="text-sm">Skills</label>
                            <input type="text" name="skills"
                                value="{{ old('skills', optional(auth()->user()->caregiver)->skills) }}"
                                class="w-full mt-1 border rounded-lg p-2">
                        </div>

                        <div class="col-span-2">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="medical_background" value="1"
                                    {{ old('medical_background', optional(auth()->user()->caregiver)->medical_background) ? 'checked' : '' }}>
                                Has Medical Background
                            </label>
                        </div>

                    </div>
                </div>

                @endif

                <!-- SAVE BUTTON -->
                <div class="mt-6 text-right">
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        💾 Save Changes
                    </button>
                </div>

            </form>

        </div>

        <!-- PASSWORD FORM -->
        <div class="bg-white shadow-lg rounded-xl p-8 mt-6">

            <h2 class="text-xl font-semibold mb-4 text-gray-700">
                Change Password
            </h2>

            <form method="POST" action="{{ route('profile.password.update') }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-6">

                    <div>
                        <label class="text-sm">New Password</label>
                        <input type="password" name="password"
                            class="w-full mt-1 border rounded-lg p-2">
                    </div>

                    <div>
                        <label class="text-sm">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full mt-1 border rounded-lg p-2">
                    </div>

                </div>

                <div class="mt-4 text-right">
                    <button type="submit"
                        class="bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-black transition">
                        🔒 Update Password
                    </button>
                </div>

            </form>

        </div>

    </div>
    <script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

  </div>

</div>