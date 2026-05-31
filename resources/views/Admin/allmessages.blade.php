@extends('admin.layouts.layout')
@section('body')
<div class="container py-5">

    <div class="container py-4">

    <h2 class="mb-4 fw-bold">
        Complaints Management
    </h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow border-0 rounded-4">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Subject</th>
                            <th>Complaint</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th width="220">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($messages as $message)

                        <tr>

                            <td>
                                {{ $message->id }}
                            </td>

                            <td>
                                <div class="fw-bold">
                                    {{ $message->name }}
                                </div>

                                <small class="text-muted">
                                    {{ $message->email }}
                                </small>
                            </td>

                            <td>
                                {{ $message->subject }}
                            </td>

                            <td style="max-width:300px;">
                                {{ Str::limit($message->message, 80) }}
                            </td>

                            <td>
                                {{ $message->created_at->format('d M Y') }}
                            </td>

                            <td>

                                @if($message->status == 'pending')
                                    <span class="badge bg-danger">
                                        Pending
                                    </span>

                                @elseif($message->status == 'in_progress')
                                    <span class="badge bg-warning text-dark">
                                        In Progress
                                    </span>

                                @else
                                    <span class="badge bg-success">
                                        Resolved
                                    </span>
                                @endif

                            </td>

                            <td>

                                <form action="{{ route('admin.messages.status', $message) }}"
                                      method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <div class="d-flex gap-2">

                                        <select name="status"
                                                class="form-select form-select-sm">

                                            <option value="pending"
                                                {{ $message->status == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>

                                            <option value="in_progress"
                                                {{ $message->status == 'in_progress' ? 'selected' : '' }}>
                                                In Progress
                                            </option>

                                            <option value="resolved"
                                                {{ $message->status == 'resolved' ? 'selected' : '' }}>
                                                Resolved
                                            </option>

                                        </select>

                                        <button type="submit"
                                                class="btn btn-primary btn-sm">
                                            Save
                                        </button>

                                    </div>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center py-4">
                                No complaints found.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
@endsection