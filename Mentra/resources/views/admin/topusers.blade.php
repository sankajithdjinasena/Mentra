@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1 class="text-center mb-5">Top 10 Focurzers</h1>

        <div class="container">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">User Study Time Leaderboard </h3>
                </div>
                <div class="card-body">
                    <table id="cusmsg" class="table table-bordered table-striped dt-tble">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Total Study Hours</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topUsers as $index => $entry)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $entry->user->name ?? 'Unknown' }}</td>
                                    <td>{{ $entry->user->email ?? 'N/A' }}</td>
                                    @php
                                        $hours = floor($entry->total_hours);
                                        $minutes = round(($entry->total_hours - $hours) * 60);
                                    @endphp
                                    <td>{{ $hours }}h {{ $minutes }}m</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
