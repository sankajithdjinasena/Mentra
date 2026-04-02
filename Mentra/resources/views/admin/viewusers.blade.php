@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1 class="text-center mb-5">Registered Users</h1>

    <div class="container">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">User Table</h3>
            </div>
            <div class="card-body">
                <table id="cusmsg" class="table table-bordered table-striped dt-tble">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1234</td>
                            <td>user</td>
                            <td>user@example.com</td>
                           <td>2026-04-01</td>

                            {{-- <td>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            </td>
                            <td>
                                <form action="#" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td> --}}
                        </tr>
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
        $('#userTable').DataTable();
    });
</script>
@endsection
