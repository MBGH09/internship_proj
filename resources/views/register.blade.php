<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Event Planner</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .left-section {
            flex: 0 0 42%;
            background: url('{{ asset('images/event-background. jpg') }}') center/cover;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .left-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:  rgba(0, 0, 0, 0.3);
        }

        .welcome-content {
            position: relative;
            z-index: 1;
            text-align: center;
            color: white;
            padding: 40px;
            max-width: 400px;
        }

        . welcome-content h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 16px;
            line-height: 1.2;
        }

        .welcome-content p {
            font-size: 14px;
            font-weight: 300;
            margin-bottom: 30px;
            line-height: 1.5;
            opacity: 0.95;
        }

        .btn-signin {
            padding: 12px 60px;
            background: transparent;
            color: white;
            border: 2px solid white;
            border-radius: 25px;
            font-size:  16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: capitalize;
        }

        .btn-signin:hover {
            background: white;
            color: #333;
        }

        .right-section {
            flex: 1;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .form-container {
            width: 100%;
            max-width:  450px;
        }

        . logo {
            text-align:  center;
            margin-bottom:  20px;
        }

        . logo h2 {
            font-size:  24px;
            font-weight: 600;
            color: #000;
        }

        .logo span {
            color: #7c3aed;
        }

        .form-title {
            text-align: center;
            font-size: 28px;
            font-weight:  700;
            margin-bottom: 40px;
            color: #000;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight:  600;
            margin-bottom: 8px;
            color: #000;
            letter-spacing: 0.5px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: none;
            border-radius: 6px;
            background: #fff;
            font-size: 13px;
            color: #999;
            outline: none;
            transition: box-shadow 0.3s;
        }

        .form-group input:: placeholder {
            color: #bbb;
        }

        . form-group input:focus {
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: #7c3aed;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight:  600;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: #6d28d9;
        }

        .error {
            color: #dc2626;
            font-size:  12px;
            margin-top:  4px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Left Section -->
        <div class="left-section">
            <div class="welcome-content">
                <h1>Welcome<br>back</h1>
                <p>To keep connected with us provide us with your information</p>
                <a href="{{ route('login') }}">
                    <button class="btn-signin">Sign in</button>
                </a>
            </div>
        </div>
        
        <!-- Right Section -->
        <div class="right-section">
            <div class="form-container">
                <div class="logo">
                    <h2>Event <span>Planner</span></h2>
                </div>

                <h1 class="form-title">Sign Up to Event Planner</h1>

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">YOUR NAME</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            placeholder="Enter your name"
                            value="{{ old('name') }}"
                            required
                        >
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">YOUR EMAIL</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="Enter your email"
                            value="{{ old('email') }}"
                            required
                        >
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">YOUR PHONE</label>
                        <input 
                            type="text" 
                            id="phone" 
                            name="phone" 
                            placeholder="Enter your phone number"
                            value="{{ old('phone') }}"
                            required
                        >
                        @error('phone')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">PASSWORD</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Enter your password"
                            required
                        >
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">CONFIRM PASSWORD</label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            placeholder="Enter your password"
                            required
                        >
                    </div>

                    <button type="submit" class="btn-submit">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>