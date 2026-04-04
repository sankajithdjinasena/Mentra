@extends('layouts.web')

@section('content')
    <title>Mentra | Reminders</title>

    <link rel="stylesheet" href="{{ asset('css/subpage.css') }}">
    <section class="container sec">
        <div class="container row  wow fadeInDown">
            <div class="col-md-4">
                <h2>Reminders</h2>
                <form action="{{ route('reminders.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" name="date"  min="{{ now()->toDateString() }}" value="{{ now()->toDateString() }}" required>
                    </div>
                    <div class="form-group">
                        <label for="time">Time:</label>
                        <input type="time" class="form-control" name="time" required>
                    </div>
                    <div class="form-group">
                        <label for="reminder">Reminder:</label>
                        <input type="text" class="form-control" name="reminder" required>
                    </div>
                    <button type="submit" class=" mt-2">Add Reminder</button>
                </form>


                <ul class="list-group mt-4">
                @forelse ($reminders as $reminder)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        <strong>{{ $reminder->reminder }}</strong> - {{ $reminder->date }} at {{ $reminder->time }}
                    </span>
                    <form action="{{ route('reminders.destroy', $reminder->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reminder?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
                @empty
                    <li class="list-group-item">No upcoming reminders.</li>
                @endforelse
            </ul>
            </div>

            <div class="col-md-8">
            <section class="section">
                <h2>Reminders Calendar</h2>
                <p class="desc">Your upcoming reminders are shown here.</p>
                <div id="remindersCalendar"></div>
            </section>



            
            </div>

        </div>
    </section>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#28a745',
                    timer: 3000
                });
            });
        </script>
    @endif





     <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('remindersCalendar');
            if (!calendarEl) {
                return;
            }

            const events = @json($reminderEvents ?? []);

            window.remindersCalendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: events,
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false,
                    hour12: false
                }
            });

            window.remindersCalendar.render();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('reminderForm');
            const errorsBox = document.getElementById('reminderFormErrors');
            const submitBtn = document.getElementById('reminderSubmitBtn');
            const dateInput = document.getElementById('reminder-date');

            if (!form) {
                return;
            }

            function showErrors(errors) {
                if (!errorsBox) return;
                const lines = [];
                Object.values(errors || {}).forEach((messages) => {
                    (messages || []).forEach((message) => lines.push(`<div>${message}</div>`));
                });
                errorsBox.innerHTML = lines.join('');
            }

            function clearErrors() {
                if (!errorsBox) return;
                errorsBox.innerHTML = '';
            }

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                clearErrors();

                const formData = new FormData(form);
                const title = String(formData.get('reminder') || '').trim();
                const date = String(formData.get('date') || '').trim();
                const time = String(formData.get('time') || '').trim();

                submitBtn.disabled = true;

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    });

                    if (response.status === 422) {
                        const data = await response.json();
                        showErrors(data.errors || {});
                        return;
                    }

                    if (!response.ok) {
                        throw new Error('Failed to save reminder');
                    }

                    if (window.remindersCalendar && title && date && time) {
                        // Just use the title, time is displayed via fc-event-time
                        window.remindersCalendar.addEvent({
                            title: title,
                            start: `${date}T${time}`
                        });
                    }

                    form.reset();
                    if (dateInput) {
                        dateInput.value = '{{ now()->toDateString() }}';
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Saved',
                        text: 'Reminder added to calendar.',
                        confirmButtonColor: '#28a745',
                        timer: 2200
                    });
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Could not save reminder. Please try again.',
                        confirmButtonColor: '#dc3545'
                    });
                } finally {
                    submitBtn.disabled = false;
                }
            });
        });
    </script>

@endsection
