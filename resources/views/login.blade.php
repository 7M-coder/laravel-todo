<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* نفس الستايل السابق لتوحيد الشكل */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 { text-align: center; color: #333; margin-bottom: 1.5rem; }
        label { display: block; margin-bottom: 0.5rem; color: #4b5563; font-weight: 500;}
        input {
            width: 100%; padding: 0.75rem; margin-bottom: 1rem;
            border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;
        }
        button {
            width: 100%; background-color: #4f46e5; color: white;
            padding: 0.75rem; border: none; border-radius: 6px; font-weight: bold; cursor: pointer;
        }
        button:hover { background-color: #4338ca; }
        .error-msg { color: #dc2626; font-size: 0.875rem; margin-bottom: 1rem; display: block; }
        
        /* تنسيق الرابط الجديد */
        .register-link { text-align: center; margin-top: 1rem; font-size: 0.9rem; }
        .register-link a { color: #4f46e5; text-decoration: none; font-weight: bold; }
        .register-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Welcome Back</h2>
        
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            
            @error('email')
                <span class="error-msg">{{ $message }}</span>
            @enderror

            <button type="submit">Login</button>

            <div class="register-link">
                Don't have an account? <a href="{{ route('signup') }}">Register here</a>
            </div>
        </form>
    </div>

</body>
</html>