<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        /* تنسيق الصفحة بالكامل عشان تتوسط الشاشة */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* تنسيق الكرت الأبيض */
        .form-container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 { text-align: center; color: #333; margin-bottom: 1.5rem; }

        /* تنسيق الحقول */
        .form-group { margin-bottom: 1rem; }
        
        label { display: block; margin-bottom: 0.5rem; color: #4b5563; font-weight: 500;}

        input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            box-sizing: border-box; /* عشان الـ padding ما يخرب العرض */
            transition: border-color 0.2s;
        }

        input:focus { border-color: #4f46e5; outline: none; }

        /* زر التسجيل */
        button {
            width: 100%;
            background-color: #4f46e5;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover { background-color: #4338ca; }

        /* رسائل الخطأ */
        .error-msg { color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem; display: block; }

        .register-link { text-align: center; margin-top: 1rem; font-size: 0.9rem; }
        .register-link a { color: #4f46e5; text-decoration: none; font-weight: bold; }
        .register-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Create Account</h2>
        
        <form action="{{ route('signup.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}">
                @error('name') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}">
                @error('email') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password">
                @error('password') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation">
                @error('password_confirmation') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <button type="submit">Sign Up</button>

            <div class="register-link">
                Already have an account? <a href="{{ route('login') }}">Login here</a>
            </div>
        </form>
    </div>

</body>
</html>