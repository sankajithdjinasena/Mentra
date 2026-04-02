@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1 class="text-center mb-5">User Feedback</h1>

    <div class="container">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Feedback Table</h3>
            </div>
            <div class="card-body">
                <table id="cusmsg" class="table table-bordered table-striped dt-tble">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Send At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->id }}</td>
                            <td>{{ $feedback->name }}</td>
                            <td>{{ $feedback->email }}</td>
                            <td>{{ $feedback->message }}</td>
                            <td>{{ $feedback->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#feedbackTable').DataTable();
    });
</script>
@endsection
