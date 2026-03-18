<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background-color: white;
            padding: 3rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }
        h1 { color: #333; margin-bottom: 0.5rem; }
        p { color: #6b7280; margin-bottom: 2rem; }
        
        .btn {
            display: inline-block;
            background-color: #4f46e5;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            margin: 5px;
            border: none;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
        }
        .btn-outline { background-color: white; color: #4f46e5; border: 2px solid #4f46e5; }
        .btn:hover { opacity: 0.9; }
    </style>
</head>
<body>
  <div class="card">
    @auth 
        <h1> Welcome, {{Auth::user()->name}} </h1>

        <a href="{{ route('todos.index') }}" class="btn" style="background-color: #10b981; margin-bottom: 10px;">Go to my Todos</a>

        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="btn" style="background-color: #dc2626;">Logout</button>
        </form>
    @endauth

    @guest
        <h1>Welcome, Guest</h1>
        <p>Please login to continue</p>
        
        <a href="{{ route('login') }}" class="btn">Login</a>
        <a href="{{ route('signup') }}" class="btn btn-outline">Signup</a>
    @endguest
  </div>
</body>
</html>