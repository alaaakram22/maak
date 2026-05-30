@extends('admin.layouts.layout')

@section('body')

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3 px-2">

        <h3 class="font-weight-bold text-primary">
            Customers List
        </h3>

        <a href="{{ route('customers.create') }}"
           class="btn btn-primary btn-sm">
            + Create Customer
        </a>

    </div>

    <!-- TABLE -->
    <div class="card border-0 shadow">

        <div class="card-body">

            <table class="table table-hover">

                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Address</th>
                        <th>Medical History</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($customers as $customer)
                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <!-- CLICKABLE NAME -->
                        <td>
                            <a href="{{ route('customers.edit', $customer->id) }}"
                               class="text-primary font-weight-bold">
                                {{ $customer->user->name }}
                            </a>
                        </td>

                        <td>{{ $customer->user->email }}</td>
                        <td>{{ $customer->user->phone ?? '-' }}</td>
                        <td>{{ $customer->user->gender ?? '-' }}</td>
                        <td>{{ $customer->user->date_of_birth ?? '-' }}</td>
                        <td>{{ $customer->address ?? '-' }}</td>
                        <td>{{ Str::limit($customer->medical_history, 30, '...') }}</td>

                        <!-- DELETE -->
                        <td>
                            <form method="POST"
                                  action="{{ route('customers.destroy', $customer->id) }}"
                                  onsubmit="return confirm('Delete this customer?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger">
                                    Delete
                                </button>

                            </form>
                        </td>

                    </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                No customers found
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection