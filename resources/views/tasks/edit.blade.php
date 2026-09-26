<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
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
            margin-top: 50px;
        }

        .form-container {
            width: 500px;
            max-width: 90%;
            margin: 40px auto;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input,
        textarea,
        select {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 16px;
            text-align: center;
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        button,
        .action-button {
            background-color: white;
            color: black;
            border: none;
            padding: 10px 18px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 6px;
            cursor: pointer;
            display: inline-block;
        }

        button:hover,
        .action-button:hover {
            background-color: #cccccc;
        }
    </style>
</head>

<body>

    <h1>Edit Task</h1>

    <div class="form-container">

        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="task_name">Task Name</label>
            <input
                type="text"
                id="task_name"
                name="task_name"
                value="{{ $task->task_name }}"
                required
            >

            <label for="description">Description</label>
            <textarea id="description" name="description">{{ $task->description }}</textarea>

            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>
                    Completed
                </option>
            </select>

            <label for="due_date">Due Date</label>
            <input
                type="date"
                id="due_date"
                name="due_date"
                value="{{ $task->due_date }}"
                min="{{ now()->addDay()->format('Y-m-d') }}"
>

            <button type="submit">Update Task</button>
        </form>

        <br>

        <a href="{{ route('tasks.index') }}" class="action-button">
            Back to Tasks
        </a>

    </div>

</body>
</html>