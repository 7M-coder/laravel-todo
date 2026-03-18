<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Todos</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .card {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px; /* عرضنا الكرت شوي عشان يكفي المهام */
        }
        h2 { color: #333; margin-top: 0; text-align: center; }
        
        /* فورم إضافة مهمة */
        .add-form { display: flex; gap: 10px; margin-bottom: 2rem; }
        .add-form input {
            flex: 1; padding: 0.75rem; border: 1px solid #d1d5db;
            border-radius: 6px; outline: none; transition: border-color 0.2s;
        }
        .add-form input:focus { border-color: #4f46e5; }
        .add-form button {
            background-color: #4f46e5; color: white; padding: 0.75rem 1.5rem;
            border: none; border-radius: 6px; cursor: pointer; font-weight: bold;
        }
        
        /* قائمة المهام */
        .todo-list { list-style: none; padding: 0; margin: 0; }
        .todo-item {
            display: flex; justify-content: space-between; align-items: center;
            padding: 1rem; border-bottom: 1px solid #f3f4f6;
        }
        .todo-item:last-child { border-bottom: none; }
        
        /* شكل المهمة المكتملة */
        .completed span { text-decoration: line-through; color: #9ca3af; }
        
        /* أزرار الأكشن (صح، حذف) */
        .actions { display: flex; gap: 5px; }
        .btn-action {
            padding: 5px 10px; border: none; border-radius: 4px;
            cursor: pointer; font-size: 0.8rem; font-weight: bold; color: white;
        }
        .btn-complete { background-color: #10b981; }
        .btn-undo { background-color: #f59e0b; }
        .btn-delete { background-color: #ef4444; }

        /* رسائل النظام */
        .alert { background-color: #d1fae5; color: #065f46; padding: 10px; border-radius: 6px; margin-bottom: 15px; text-align: center;}
        .error { color: #dc2626; font-size: 0.85rem; margin-bottom: 15px; display: block;}
        .back-link { display: block; text-align: center; margin-top: 20px; color: #4b5563; text-decoration: none; font-size: 0.9rem;}
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="card">
        <h2>My Todos 📝</h2>


        <form action="{{ route('todos.store') }}" method="POST" class="add-form">
            @csrf
            <input type="text" name="title" placeholder="What do you need to do?" required>
            <button type="submit">Add</button>
        </form>

        <ul class="todo-list">
            @forelse($todos as $todo)
                <li class="todo-item {{ $todo->is_completed ? 'completed' : '' }}">
                    <span>{{ $todo->title }}</span>
                    
                    <div class="actions">
                        <form action="{{ route('todos.update', $todo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH') @if($todo->is_completed)
                                <button type="submit" class="btn-action btn-undo">Undo</button>
                            @else
                                <button type="submit" class="btn-action btn-complete">Done</button>
                            @endif
                        </form>

                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE') <button type="submit" class="btn-action btn-delete">Delete</button>
                        </form>
                    </div>
                </li>
            @empty
                <p style="text-align: center; color: #9ca3af;">No todos yet. You're all caught up! 🎉</p>
            @endforelse
        </ul>

        <a href="{{ route('home') }}" class="back-link">← Back to Dashboard</a>
    </div>

</body>
</html>