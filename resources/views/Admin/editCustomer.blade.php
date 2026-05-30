@extends('admin.layouts.layout')

@section('body')

<div class="container py-5">

    <div class="card shadow border-0">

        <div class="card-body p-5">

            <h4 class="mb-4 font-weight-bold">Update Customer</h4>

            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <h6 class="text-primary">👤 User Info</h6>

                <input type="text" name="name"
                    value="{{ $customer->user->name }}"
                    class="form-control mb-2">

                <input type="email" name="email"
                    value="{{ $customer->user->email }}"
                    class="form-control mb-2">

                <input type="text" name="phone"
                    value="{{ $customer->user->phone }}"
                    class="form-control mb-2">

                <select name="gender" class="form-control mb-2" required>
                    <option value="Male" {{ $customer->user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $customer->user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                </select>

                <input type="date"
                    name="date_of_birth"
                    value="{{ $customer->user->date_of_birth }}"
                    class="form-control mb-2"
                    required>

                <hr>

                <h6 class="text-success">🏠 Customer Info</h6>

                <textarea name="medical_history" class="form-control mb-2">
                {{ $customer->medical_history }}
                </textarea>

                <input type="text" name="address"
                    value="{{ $customer->address }}"
                    class="form-control mb-3">

                <button class="btn btn-success btn-block">
                    Update Customer
                </button>

            </form>

        </div>

    </div>

</div>

@endsection