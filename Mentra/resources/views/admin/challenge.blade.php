@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1 style="text-align:center;" class="mb-5">Challenges</h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Add New Challenge</h3>
                </div>
                <form action="{{ route('challenges.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Challenge Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter challenge name" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Challenge Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Enter description..." required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text" name="type" class="form-control" placeholder="e.g., daily, weekly" required>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Add Challenge</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
