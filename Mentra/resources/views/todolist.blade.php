@extends('layouts.web')

@section('content')
    <title>Mentra | To Do List</title>

    <link rel="stylesheet" href="{{ asset('css/subpage.css') }}">

       <style>
        canvas {
            margin-top: 30px;
            width: 800px !important;
            height: 400px !important;
            border-radius: 10px;
            margin: 0 auto;
        }
    </style>

      <section class="container sec">
        
        <div class="content-wrapper row wow fadeInDown">
            <!-- Clock Section -->
           
            <div class="clock-section col-md-6">
                 <h2 class="mb-4">Log Your Study Hours</h2>
                <div id="time">
                    <span class="digit" id="hr">00</span>
                    <span class="txt">Hr</span>
                    <span class="digit" id="min">00</span>
                    <span class="txt">Min</span>
                    <span class="digit" id="sec">00</span>
                    <span class="txt">Sec</span>
                    <span class="digit" id="count">00</span>
                </div>
                <div id="buttons">
                    <button class="btn" id="start">Start</button>
                    <button class="btn" id="stop">Stop</button>
                    <button class="btn" id="reset">Reset</button>
                </div>
                <br>
                <br>
                <form action="{{ route('studyinfo.store') }}" method="POST">
                    @csrf
                    <label style="text-align: justify;">Date:</label>
                    <input type="date" name="date" value="{{ now()->toDateString() }}"
                        max="{{ now()->toDateString() }}" required>

                    <label style="text-align: justify;">Study Hours:</label>
                    <input type="number" name="hours" step="0.1" required min="0" max="24"
                        placeholder="Enter hours studied" required>

                    <button type="submit">Save Study Info</button>
                </form>
            </div>

            <!-- Study Log Section -->
          <div class="study-section col-md-6">
            <h2 class="text-center mb-4">Focus Music for Studying</h2>
            
            <div class="accordion" id="musicAccordion">

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPiano">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePiano">
                            🎹 Study Piano
                        </button>
                    </h2>
                    <div id="collapsePiano" class="accordion-collapse collapse" data-bs-parent="#musicAccordion">
                        <div class="accordion-body p-0">
                            <iframe style="border-radius:0 0 12px 12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DX4sWSpwq3LiO" width="100%" height="500" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"></iframe>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingBinaural">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBinaural">
                            🎧 Binaural Beats
                        </button>
                    </h2>
                    <div id="collapseBinaural" class="accordion-collapse collapse" data-bs-parent="#musicAccordion">
                        <div class="accordion-body p-0">
                        <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DX7EF8wVxBVhG?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingChillHop">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseChillHop">
                            ☁️ ChillHop
                        </button>
                    </h2>
                    <div id="collapseChillHop" class="accordion-collapse collapse" data-bs-parent="#musicAccordion">
                        <div class="accordion-body p-0">
                            <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DXdLK5wjKyhVm?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingLofi">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLofi">
                            ☕ Lofi Hip-Hop
                        </button>
                    </h2>
                    <div id="collapseLofi" class="accordion-collapse collapse" data-bs-parent="#musicAccordion">
                        <div class="accordion-body p-0">
                        <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/playlist/6zCID88oNjNv9zx6puDHKj?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingClassics">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseClassics">
                            🎻 Classics
                        </button>
                    </h2>
                    <div id="collapseClassics" class="accordion-collapse collapse" data-bs-parent="#musicAccordion">
                        <div class="accordion-body p-0">
                            <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/playlist/5cwPclg5ZtafoBPWgZMHMb?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>


                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingBrown">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBrown">
                            🟫 Brown Noise
                        </button>
                    </h2>
                    <div id="collapseBrown" class="accordion-collapse collapse" data-bs-parent="#musicAccordion">
                        <div class="accordion-body p-0">
        <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/playlist/25u3wuY2IcmOSaq1FTPLg5?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingAmbient">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAmbient">
                            🕯️ Ambient Study
                        </button>
                    </h2>
                    <div id="collapseAmbient" class="accordion-collapse collapse" data-bs-parent="#musicAccordion">
                        <div class="accordion-body p-0">
        <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DWWb1L5n1gkOJ?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSinhala">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSinhala">
                            🇱🇰 Sinhala Lo-FI
                        </button>
                    </h2>
                    <div id="collapseSinhala" class="accordion-collapse collapse" data-bs-parent="#musicAccordion">
                        <div class="accordion-body p-0">
        <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/playlist/36XD4lwp7BiEHZhMpLFRjv?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>                </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTamil">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTamil">
                            🇮🇳 Tamil Lo-Fi
                        </button>
                    </h2>
                    <div id="collapseTamil" class="accordion-collapse collapse" data-bs-parent="#musicAccordion">
                        <div class="accordion-body p-0">
        <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DWX5ZkTCLvHmi?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>                </div>
                    </div>
                </div>

            </div>
        </div>

        

            



            <!-- <h3 class="mt-5">Your Study Logs for {{ now()->format('F Y') }}</h3>
            <canvas id="studyChart"></canvas> -->
        </div>
    </section>



    <section class="wow fadeInDown">
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
        </div>



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
                var listItem = this.closest('li').querySelector('span');

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
    </script>
@endsection
