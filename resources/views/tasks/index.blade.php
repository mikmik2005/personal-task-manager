<!DOCTYPE html>
<html>
<head>
    <title>Personal Task Manager</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 40px;
            margin-top: 40px;
        }

        table {
            width: 90%;
            margin: 40px auto;
            border-collapse: collapse;
            font-size: 18px;
        }

        th, td {
            border: 1px solid white;
            padding: 15px;
            text-align: center;
        }

        th {
            font-size: 20px;
        }

        .action-button,
        button {
            background-color: white;
            color: black;
            border: none;
            padding: 10px 16px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 6px;
            cursor: pointer;
            display: inline-block;
        }

        .action-button:hover,
        button:hover {
            background-color: #cccccc;
        }

        .status {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 20px;
            font-weight: bold;
        }

        .pending {
            background-color: white;
            color: black;
        }

        .completed {
            background-color: #444444;
            color: white;
        }
    </style>
</head>

<body>

    <h1>Personal Task Manager</h1>

    <a href="{{ route('tasks.create') }}" class="action-button">
        + Add New Task
    </a>

    <br><br>

<a href="{{ route('tasks.index') }}" class="action-button">All</a>

<a href="{{ route('tasks.index', ['status' => 'Pending']) }}" class="action-button">
    Pending
</a>

<a href="{{ route('tasks.index', ['status' => 'Completed']) }}" class="action-button">
    Completed
</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Task Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>{{ $task->task_name }}</td>

                    <td>{{ $task->description }}</td>

                    <td>
                        @if($task->status == 'Completed')
                            <span class="status completed">Completed</span>
                        @else
                            <span class="status pending">Pending</span>
                        @endif
                    </td>

                    <td>{{ $task->due_date }}</td>

                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}"
                           class="action-button">
                            Edit
                        </a>

                        <form action="{{ route('tasks.destroy', $task->id) }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this task?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No tasks yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>