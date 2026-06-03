<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\caregivers;
use App\Models\customers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'role' => ['required', 'in:customer,caregiver'],
            'phone' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'in:Male,Female'],
            'date_of_birth' => ['required', 'date'],

            
            // caregiver
            'experience' => ['required_if:role,caregiver', 'nullable', 'integer', 'min:0'],
            'skills' => ['required_if:role,caregiver', 'nullable', 'string'],
            'medical_background' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'cv' => ['required_if:role,caregiver', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'national_id' => ['required_if:role,caregiver', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],

            // customer
            'medical_history' => ['required_if:role,customer', 'nullable', 'string'],
            'address' => ['required_if:role,customer', 'nullable', 'string'],
        ],[
    // EMAIL
    'email.required' => 'Email is required.',
    'email.email' => 'Please enter a valid email address.',
    'email.unique' => 'This email is already registered.'])->validate();

        // HANDLE IMAGE
        $imagePath = null;
        if (request()->hasFile('image')) {
            $imagePath = request()->file('image')->store('caregivers', 'public');
        }

        $cvPath = null;
        if (request()->hasFile('cv')) {
            $cvPath = request()->file('cv')->store('caregivers', 'public');
        }

        $nationalIdPath = null;
        if (request()->hasFile('national_id')) {
            $nationalIdPath = request()->file('national_id')->store('caregivers', 'public');
        }

        // ✅ create user
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => $input['role'],

            'phone' => $input['phone'],
            'gender' => $input['gender'],
            'date_of_birth' => $input['date_of_birth'],
        ]);

        // ✅ create caregiver OR customer
        if ($input['role'] === 'caregiver') {
            caregivers::create([
                'user_id' => $user->id,
                'experience' => $input['experience'],
                'skills' => $input['skills'],
                'medical_background' => isset($input['medical_background']),
                'image' => $imagePath,
                'cv' => $cvPath,
                'national_id' => $nationalIdPath,
            ]);
        }

        if ($input['role'] === 'customer') {
            customers::create([
                'user_id' => $user->id,
                'medical_history' => $input['medical_history'],
                'address' => $input['address'],
            ]);
        }

        return $user;
    }
}
