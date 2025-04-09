@extends('layouts.layout')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">To-Do List</h2>

        <!-- Add Task Form (Admin Only) -->
        <form action="{{ route('todos.store') }}" method="POST" class="mb-4">
            @csrf
            <input type="text" name="task" placeholder="New Task" required class="p-2 border rounded">
            <button type="submit" class="p-2 bg-blue-500 text-white rounded">Add Task</button>
        </form>

        <!-- Task List -->
        <ul class="list-none">
            @foreach ($todos as $todo)
                <li class="p-2 border-b flex justify-between">
                    <span class="{{ $todo->status == 'completed' ? 'line-through text-gray-500' : '' }}">
                        {{ $todo->task }}
                    </span>

                    <div>
                        @if ($todo->status == 'pending')
                            <form action="{{ route('todos.update', $todo->id) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <button type="submit" class="text-green-500">✔ Mark as Done</button>
                            </form>
                        @endif

                        <!-- Delete Button (Admin Only) -->
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500">❌ Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
