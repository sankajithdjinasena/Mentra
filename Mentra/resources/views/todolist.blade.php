@extends('layouts.web')

@section('content')
    <title>FocusZen | To Do List</title>

    <link rel="stylesheet" href="{{ asset('css/subpage.css') }}">
    <section class="container sec  wow fadeInDown">
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
