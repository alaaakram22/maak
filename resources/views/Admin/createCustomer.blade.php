@extends('admin.layouts.layout')

@section('body')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card shadow border-0">

                <div class="card-body p-5">

                    <h4 class="mb-4 font-weight-bold text-dark">Create Customer</h4>

                    <form action="{{ route('customers.store') }}" method="POST">
                        @csrf

                        <h6 class="text-primary mb-3">👤 User Info</h6>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Name">
                            </div>

                            <div class="form-group col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>

                            <div class="form-group col-md-6">
                                <input type="text" name="phone" class="form-control" placeholder="Phone">
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <select name="gender" class="form-control">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <input type="date" name="date_of_birth" class="form-control">
                            </div>

                        </div>

                        <hr>

                        <h6 class="text-success mb-3">🏠 Customer Details</h6>

                        <div class="form-group">
                            <textarea name="medical_history" class="form-control" placeholder="Medical History"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="text" name="address" class="form-control" placeholder="Address">
                        </div>

                        <button class="btn btn-primary btn-block">
                            Create Customer
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection