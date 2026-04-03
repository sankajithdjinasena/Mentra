@extends('layouts.web')

@section('content')
    <title>Mentra | To Do List</title>

    <link rel="stylesheet" href="{{ asset('css/subpage.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css">

       <style>
        canvas {
            margin-top: 30px;
            width: 800px !important;
            height: 400px !important;
            border-radius: 10px;
            margin: 0 auto;
        }
    </style>
    
    <style>
        :root {
            --primary: #28a745;
            --primary-hover: #4caf50;
            --dark: #043504;
            --surface: #ffffff;
            --surface-soft: #f4fff4;
            --text: #113011;
            --text-muted: #4f6d4f;
            --border: #d9efd9;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .page-shell {
            width: min(1150px, 92%);
            margin: 28px auto 40px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 22px;
            padding: 14px 18px;
            border-radius: 14px;
            background: var(--dark);
            color: #fff;
        }

        .topbar h1 {
            font-family: "Merienda", serif;
            font-size: 1.3rem;
            font-weight: 700;
        }

        .topbar a {
            text-decoration: none;
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.45);
            border-radius: 999px;
            padding: 8px 14px;
            font-size: 0.92rem;
            transition: 0.2s ease;
        }

        .topbar a:hover {
            background: #fff;
            color: var(--dark);
        }

        .section {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 8px 28px rgba(4, 53, 4, 0.08);
            padding: 22px;
        }

        .section + .section {
            margin-top: 22px;
        }

        .section h2 {
            font-family: "Merienda", serif;
            color: var(--dark);
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .section p.desc {
            color: var(--text-muted);
            margin-bottom: 18px;
        }

        .calendar-shell {
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }

        .calendar-head {
            background: var(--dark);
            color: #fff;
            padding: 12px 16px;
            font-weight: 700;
            display: flex;
            justify-content: space-between;
        }

        .calendar-week,
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
        }

        .calendar-week div {
            background: #eef8ee;
            text-align: center;
            padding: 10px;
            font-weight: 700;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
        }

        .calendar-grid div {
            height: 82px;
            border-right: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            background: #fff;
        }

        .calendar-grid div:nth-child(7n) {
            border-right: none;
        }

        .stats-layout {
            display: grid;
            grid-template-columns: 1.15fr 1fr;
            gap: 14px;
        }

        .panel {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 14px;
            background: #fff;
        }

        .panel h4 {
            margin-bottom: 12px;
            color: var(--dark);
        }

        .fake-bars {
            display: flex;
            align-items: flex-end;
            gap: 8px;
            height: 160px;
        }

        .fake-bars div {
            flex: 1;
            border-radius: 8px 8px 0 0;
            background: linear-gradient(180deg, var(--primary-hover), var(--primary));
        }

        .line-chart {
            height: 160px;
            border-radius: 12px;
            border: 1px dashed #b9dbbb;
            background:
                linear-gradient(135deg, rgba(40, 167, 69, 0.14), rgba(4, 53, 4, 0.06));
        }

        .todo-expand {
            display: none;
            width: 100%;
        }

        .todo-card.active .todo-expand {
            display: block;
        }

        .todo-card.add {
            justify-content: stretch;
            align-items: stretch;
            text-align: left;
            flex-direction: row;
            min-height: 80px;
        }

        .todo-card.add .todo-quick-add {
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: stretch;
            flex-wrap: nowrap;
            gap: 10px;
            margin: 0;
        }

        .todo-card.add .todo-quick-add input[type="text"] {
            flex: 1 1 auto;
            width: auto;
            min-width: 0;
            height: 42px;
            border: 1px solid var(--border);
            border-radius: 999px;
            padding: 0 14px;
            font-size: 0.95rem;
            color: var(--text);
            background: #fff;
        }

        .todo-card.add .todo-quick-add input[type="text"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.15);
        }

        .todo-card.add .todo-quick-add .plus {
            border: 0;
            padding: 0;
            cursor: pointer;
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
        }

        

    </style>

    <section class="container sec">

    <div class="content-wrapper row wow fadeInDown"> 
        <section class="section">
            <h2>To-Do</h2>
            <div class="todo-grid">
                @forelse ($todolists as $todolist)
                    @foreach ($todolist->listTodos as $todo)
                        <article class="todo-card" data-todo-card>
                            <div class="todo-main">
                                <strong class="{{ $todo->active_status ? 'done' : '' }}">{{ $todo->todo }}</strong>
                                <small>{{ $todolist->date }}</small>
                            </div>


                            <div class="todo-actions">

                                

                                <input type="checkbox"
                                    class="todo-check mark-as-read"
                                    data-id="{{ $todo->id }}"
                                    {{ $todo->active_status ? 'checked' : '' }}
                                    aria-label="Mark todo as done">

                                <button type="button" class="action-pill primary" data-toggle-do>Start</button>
<!-- 
                                <button type="button" class="action-pill todo-pill" aria-label="Edit todo" title="Edit">
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zm2.92 2.33H5v-.92l9.06-9.06.92.92-9.06 9.06zM20.71 7.04a1.004 1.004 0 0 0 0-1.42l-2.34-2.34a1.004 1.004 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"></path></svg>
                                </button> -->

                                <form class="todo-delete-form" action="{{ route('todolist.delete', $todo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="todo-delete-btn" aria-label="Delete todo" title="Delete">
                                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 7h12l-1 14H7L6 7zm3-3h6l1 2H8l1-2z"></path></svg>
                                    </button>
                                </form>
                            </div>

                            <div class="todo-expand">
                                <div class="todo-expand-row">
                                    <div class="todo-timer-row">
                                        <div class="timer">
                                            <span data-timer-hr>00</span>
                                            <span class="timer-label">Hr</span>
                                            <span data-timer-min>00</span>
                                            <span class="timer-label">Min</span>
                                            <span data-timer-sec>00</span>
                                            <span class="timer-label">Sec</span>
                                            <span data-timer-count>00</span>
                                        </div>
                                        <div class="timer-actions">
                                            <button type="button" class="timer-btn start" data-timer-start aria-label="Start timer" title="Start">
                                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"></path></svg>
                                            </button>
                                            <button type="button" class="timer-btn stop" data-timer-stop aria-label="Stop timer" title="Stop">
                                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 6h12v12H6z"></path></svg>
                                            </button>
                                            <button type="button" class="timer-btn reset" data-timer-reset aria-label="Reset timer" title="Reset">
                                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M17.65 6.35A7.95 7.95 0 0 0 12 4V1L7 6l5 5V7a5 5 0 1 1-5 5H5a7 7 0 1 0 12.65-5.65z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="todo-expand-row">
                                    <label class="music-label" for="music-{{ $todo->id }}">Choose music</label>
                                    <select id="music-{{ $todo->id }}" class="music-select" data-music-select>
                                        <option value="https://open.spotify.com/embed/playlist/37i9dQZF1DX4sWSpwq3LiO">🎹 Study Piano</option>
                                        <option value="https://open.spotify.com/embed/playlist/37i9dQZF1DX7EF8wVxBVhG?utm_source=generator">🎧 Binaural Beats</option>
                                        <option value="https://open.spotify.com/embed/playlist/37i9dQZF1DXdLK5wjKyhVm?utm_source=generator">☁️ ChillHop</option>
                                        <option value="https://open.spotify.com/embed/playlist/6zCID88oNjNv9zx6puDHKj?utm_source=generator">☕ Lofi Hip-Hop</option>
                                        <option value="https://open.spotify.com/embed/playlist/5cwPclg5ZtafoBPWgZMHMb?utm_source=generator">🎻 Classics</option>
                                        <option value="https://open.spotify.com/embed/playlist/25u3wuY2IcmOSaq1FTPLg5?utm_source=generator">🟫 Brown Noise</option>
                                        <option value="https://open.spotify.com/embed/playlist/37i9dQZF1DWWb1L5n1gkOJ?utm_source=generator">🕯️ Ambient Study</option>
                                        <option value="https://open.spotify.com/embed/playlist/36XD4lwp7BiEHZhMpLFRjv?utm_source=generator">🎵 Sinhala Lo-FI</option>
                                        <option value="https://open.spotify.com/embed/playlist/37i9dQZF1DWX5ZkTCLvHmi?utm_source=generator">🎶 Tamil Lo-Fi</option>
                                    </select>
                                </div>
                                <div class="todo-expand-row">
                                    <iframe data-spotify-frame data-testid="embed-iframe" class="spotify-embed"
                                        src="https://open.spotify.com/embed/playlist/6zCID88oNjNv9zx6puDHKj?utm_source=generator"
                                        width="100%" height="352" frameBorder="0" allowfullscreen=""
                                        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                                        loading="lazy">
                                    </iframe>
                                </div>
                            </div>
                        </article>
                    @endforeach
                @empty
                    <div class="todo-empty">No to-do items for this date.</div>
                @endforelse

                <article class="todo-card add">
                    <form class="todo-quick-add" action="{{ route('todolist.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="date" value="{{ $date ?? now()->toDateString() }}">
                        <input type="text" name="todos[]" placeholder="Add a new to-do item" maxlength="255" required aria-label="New to-do item">
                        <button type="submit" class="plus" aria-label="Add to-do">+</button>
                    </form>
                </article>
            </div>
        </section>

        <section class="section">
            <h2>Reminders Calendar</h2>
            <p class="desc">Your upcoming reminders are shown here.</p>
            <div id="remindersCalendar"></div>

            <div class="reminder-form-wrap">
                <h3>Add New Reminder</h3>
                <form id="reminderForm" action="{{ route('reminders.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="reminder-form-grid">
                        <div>
                            <label for="reminder-date">Date</label>
                            <input id="reminder-date" type="date" name="date"
                                min="{{ now()->toDateString() }}" value="{{ now()->toDateString() }}" required>
                        </div>

                        <div>
                            <label for="reminder-time">Time</label>
                            <input id="reminder-time" type="time" name="time" required>
                        </div>

                        <div class="full">
                            <label for="reminder-text">Reminder</label>
                            <input id="reminder-text" type="text" name="reminder" maxlength="255"
                                placeholder="e.g. Submit assignment at 6 PM" required>
                        </div>
                    </div>

                    <div id="reminderFormErrors" class="reminder-errors" role="alert" aria-live="polite"></div>
                    <button type="submit" id="reminderSubmitBtn" class="reminder-submit">Save Reminder</button>
                </form>
            </div>
        </section>


        
                <br>
                <br>
                <form id="studyInfoForm" action="{{ route('studyinfo.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="studyInfoDate" name="date" value="">
                    <input type="hidden" id="studyInfoHours" name="hours" value="">
                </form>





    <!-- <section class="wow fadeInDown">
        <div class="row">
            <div class="col-md-6">
                <h2>Add To-Do List</h2>
                <form action="{{ route('todolist.store') }}" method="POST">
                    @csrf
                    <label>Date:</label>
                    <input type="date" name="date" required min="{{ now()->toDateString() }}"
                        value="{{ $date }}">

                    <label>To-Do Items:</label>
                    <div id="todoItems">
                        <input type="text" name="todos[]" required class="form-control">
                    </div>
                    <button type="button" onclick="addTodoItem()">+ Add More</button>
                    <button type="button" onclick="removeTodoItem()">- Remove</button>
                    <button type="submit">Save To-Do List</button>
                </form>
            </div>
            <div class="col-md-6">
                <h3>Today To-Do List</h3>
                <form method="GET" action="{{ route('todolist.index') }}">
                    <label>Filter by Date:</label>
                    <input type="date" name="date" value="{{ $date }}" onchange="this.form.submit()">
                    {{-- max="{{ now()->toDateString() }}" --}}
                </form>
                @foreach ($todolists as $todolist)
                    <ul>
                        @foreach ($todolist->listTodos as $todo)
                            <li class="mt-3">
                                <label>
                                    <form action="{{ route('todolist.delete', $todo->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger"
                                            style="background-color: #bc0a0a; margin-right: 20px;">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    <input type="checkbox" class="mark-as-read large-checkbox" data-id="{{ $todo->id }}"
                                        {{ $todo->active_status ? 'checked' : '' }} style="    margin-right: 20px;">
                                    <span class="{{ $todo->active_status ? 'done' : '' }}">{{ $todo->todo }}</span>
                                </label>


                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
        </div> -->



         <script>
        document.addEventListener('DOMContentLoaded', function() {
            const labels = {!! json_encode($dates->keys()) !!};
            const data = {!! json_encode($dates->values()) !!};

            const ctx = document.getElementById('studyChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Study Hours',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>






    @if (session('badge'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var badgeModal = new bootstrap.Modal(document.getElementById('badgeModal'));
                badgeModal.show();
            });
        </script>
    @else
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
    @endif


    <!-- Badge Modal -->
    <div class="modal fade" id="badgeModal" tabindex="-1" role="dialog" aria-labelledby="badgeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title" id="badgeModalLabel">🎉 Congratulations!</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (session('badge'))
                        <p>You have earned a new badge:</p>
                        <h4><strong>{{ session('badge')->badge_name }}</strong></h4>
                        <p>{{ session('badge')->type }}</p>
                        <p>You've achieved the {{ session('badge')->hours }}-hour study target!</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Awesome!</button>
                </div>
            </div>
        </div>
    </div>





@if (session('success') || session('motivation'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Stay Motivated!',
                html: `
                    <p>{{ session('success') }}</p>
                    @if (session('motivation'))
                        <hr>
                        <p style="color:#3f9610; font-weight:bold; font-size:25px;">
                            {{ session('motivation') }}
                        </p>
                    @endif
                `,
                confirmButtonColor: '#28a745',
                timer: 6000
            });
        });
    </script>
@endif



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

    </section>

    <script>
        function addTodoItem() {
            let container = document.getElementById('todoItems');
            let input = document.createElement('input');
            input.type = 'text';
            input.name = 'todos[]';
            input.classList.add('form-control');
            input.classList.add('mt-1');
            input.required = true;
            container.appendChild(input);
        }


        function removeTodoItem() {
            let container = document.getElementById('todoItems');
            let inputs = container.getElementsByTagName('input');

            if (inputs.length > 0) {
                container.removeChild(inputs[inputs.length - 1]);
            }
        }
    </script>




    <script>
        document.querySelectorAll('.mark-as-read').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var todoId = this.getAttribute('data-id');
                var isChecked = this.checked;
                var listItem = this.closest('.todo-card').querySelector('.todo-main strong');

                fetch(`/todolist/${todoId}/markdone`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            is_done: isChecked
                        })
                    })
                    .then(response => response.json())
                    .then(data => {

                        if (data.success) {
                            if (isChecked) {
                                listItem.classList.add('done');
                            } else {
                                listItem.classList.remove('done');
                            }
                        }

                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        const todoCards = Array.from(document.querySelectorAll('[data-todo-card]'));

        function formatTimerValue(value) {
            return value < 10 ? `0${value}` : `${value}`;
        }

        function renderTimer(state) {
            state.hrEl.textContent = formatTimerValue(state.hour);
            state.minEl.textContent = formatTimerValue(state.minute);
            state.secEl.textContent = formatTimerValue(state.second);
            state.countEl.textContent = formatTimerValue(state.count);
        }

        function stopTimer(state) {
            state.running = false;
            if (state.timeoutId) {
                clearTimeout(state.timeoutId);
                state.timeoutId = null;
            }
        }

        function resetTimer(state) {
            stopTimer(state);
            state.hour = 0;
            state.minute = 0;
            state.second = 0;
            state.count = 0;
            renderTimer(state);
        }

        function tickTimer(state) {
            if (!state.running) {
                return;
            }

            state.count += 1;

            if (state.count === 100) {
                state.second += 1;
                state.count = 0;
            }

            if (state.second === 60) {
                state.minute += 1;
                state.second = 0;
            }

            if (state.minute === 60) {
                state.hour += 1;
                state.minute = 0;
                state.second = 0;
            }

            renderTimer(state);
            state.timeoutId = setTimeout(() => tickTimer(state), 10);
        }

        function startTimer(state) {
            if (state.running) {
                return;
            }
            state.running = true;
            tickTimer(state);
        }

        function pauseTimer(state) {
            stopTimer(state);
        }

        function getElapsedHoursDecimal(state) {
            const totalHours =
                state.hour +
                (state.minute / 60) +
                (state.second / 3600) +
                (state.count / 360000);

            return Number(totalHours.toFixed(4)).toString();
        }

        function printElapsedTime(card, state, reason) {
            const titleEl = card.querySelector('.todo-main strong');
            const title = titleEl ? titleEl.textContent.trim() : 'Task';
            const elapsedHours = getElapsedHoursDecimal(state);

            console.log(`[Todo Session Closed] ${title} | Elapsed: ${elapsedHours} hrs | Reason: ${reason}`);

            if (reason !== 'toggle-pause') {
                return;
            }

            const form = document.getElementById('studyInfoForm');
            const dateInput = document.getElementById('studyInfoDate');
            const hoursInput = document.getElementById('studyInfoHours');

            if (!form || !dateInput || !hoursInput) {
                return;
            }

            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');

            dateInput.value = `${yyyy}-${mm}-${dd}`;
            hoursInput.value = elapsedHours;

            form.submit();
        }

        function closeCardPanel(card, reason = 'manual') {
            const state = card.__todoTimerState;
            if (!card.classList.contains('active')) {
                return;
            }

            card.classList.remove('active');
            if (state) {
                pauseTimer(state);
                printElapsedTime(card, state, reason);
                if (reason === 'toggle-pause') {
                    resetTimer(state);
                }
            }

            const toggleButton = card.querySelector('[data-toggle-do]');
            if (toggleButton) {
                toggleButton.textContent = 'Start';
            }
        }

        function activateCard(card) {
            todoCards.forEach((otherCard) => {
                if (otherCard !== card && otherCard.classList.contains('active')) {
                    closeCardPanel(otherCard, 'switch-card');
                }
            });

            card.classList.add('active');
            const toggleButton = card.querySelector('[data-toggle-do]');
            if (toggleButton) {
                toggleButton.textContent = 'Stop';
            }
        }

        todoCards.forEach((card) => {
            const doToggle = card.querySelector('[data-toggle-do]');
            const startBtn = card.querySelector('[data-timer-start]');
            const stopBtn = card.querySelector('[data-timer-stop]');
            const resetBtn = card.querySelector('[data-timer-reset]');
            const musicSelect = card.querySelector('[data-music-select]');
            const spotifyFrame = card.querySelector('[data-spotify-frame]');

            const state = {
                running: false,
                hour: 0,
                minute: 0,
                second: 0,
                count: 0,
                timeoutId: null,
                hrEl: card.querySelector('[data-timer-hr]'),
                minEl: card.querySelector('[data-timer-min]'),
                secEl: card.querySelector('[data-timer-sec]'),
                countEl: card.querySelector('[data-timer-count]'),
            };

            card.__todoTimerState = state;
            renderTimer(state);

            if (musicSelect && spotifyFrame) {
                spotifyFrame.src = musicSelect.value;
                musicSelect.addEventListener('change', function() {
                    spotifyFrame.src = this.value;
                });
            }

            if (doToggle) {
                doToggle.addEventListener('click', function() {
                    if (card.classList.contains('active')) {
                        closeCardPanel(card, 'toggle-pause');
                    } else {
                        activateCard(card);
                        startTimer(state);
                    }
                });
            }

            if (startBtn) {
                startBtn.addEventListener('click', function() {
                    activateCard(card);
                    startTimer(state);
                });
            }

            if (stopBtn) {
                stopBtn.addEventListener('click', function() {
                    pauseTimer(state);
                });
            }

            if (resetBtn) {
                resetBtn.addEventListener('click', function() {
                    resetTimer(state);
                });
            }
        });
    </script>

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


