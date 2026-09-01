<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Event Planner</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f5f5;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 80px;
            background: #f5f5f5;
            border-bottom: 1px solid #e0e0e0;
        }

        .logo h1 {
            font-size: 28px;
            font-weight: 700;
            color: #000;
        }

        .logo span {
            color: #7c3aed;
        }

        .nav-section {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-links {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .nav-links a {
            color: #333;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #7c3aed;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: #7c3aed;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: #000;
        }

        .user-email {
            font-size: 12px;
            color: #666;
        }

        .container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .welcome-section {
            background: white;
            padding: 40px;
            border-radius: 12px;
            margin-bottom: 40px;
            text-align: center;
        }

        .profile-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            margin-top: 20px;
        }

        .profile-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
            text-align: left;
        }

        .profile-label {
            font-size: 13px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            font-weight: 600;
        }

        .profile-value {
            font-size: 16px;
            color: #111827;
            font-weight: 600;
            word-break: break-word;
        }

        .welcome-section h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #000;
        }

        .welcome-section p {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
        }

        .btn-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s;
        }

        .btn-primary {
            background: #7c3aed;
            color: white;
        }

        .btn-primary:hover {
            background: #6d28d9;
        }

        .btn-secondary {
            background: #e0e0e0;
            color: #333;
        }

        .btn-secondary:hover {
            background: #d0d0d0;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
        }

        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #7c3aed;
        }

        .stat-label {
            color: #666;
            margin-top: 10px;
        }

        .logout-btn {
            background: white;
            color: #333;
            border: 1px solid #e0e0e0;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .logout-btn:hover {
            background: #f5f5f5;
        }

        @media (max-width: 768px) {
            header {
                padding: 20px;
            }

            .nav-links {
                gap: 15px;
            }

            .container {
                margin: 20px auto;
            }

            .welcome-section h1 {
                font-size: 24px;
            }

            .btn-container {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1>Event <span>Planner</span></h1>
        </div>
        <div class="nav-section">
            <nav class="nav-links">
                <a href="{{ route('events.index') }}">Events</a>
                @if(!Auth::user()->isAdmin())
                    <a href="{{ route('events.my-registrations') }}">My Registrations</a>
                @endif
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.events.index') }}">Admin Panel</a>
                @endif
            </nav>
            <div class="user-profile">
                <div class="user-avatar">
                    {{ substr(Auth::user()->mb_name, 0, 1) }}
                </div>
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->mb_name }}</span>
                    <span class="user-email">{{ Auth::user()->mb_email }}</span>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </header>

    <div class="container">
        <div class="welcome-section">
            <h1>Welcome to Event Planner!</h1>
            <p>Discover and join amazing events in your area</p>

            <div class="profile-card">
                <div class="profile-item">
                    <span class="profile-label">Name</span>
                    <span class="profile-value">{{ Auth::user()->mb_name }}</span>
                </div>
                <div class="profile-item">
                    <span class="profile-label">Email</span>
                    <span class="profile-value">{{ Auth::user()->mb_email }}</span>
                </div>
            </div>

            <div class="stats">
                @if(!Auth::user()->isAdmin())
                    <div class="stat-card">
                        <div class="stat-number">{{ Auth::user()->countRegistrations() }}</div>
                        <div class="stat-label">Events Attending</div>
                    </div>
                @endif
                @if(Auth::user()->isAdmin())
                    <div class="stat-card">
                        <div class="stat-number">{{ \App\Models\mb_Event::where('mb_created_by', Auth::id())->count() }}</div>
                        <div class="stat-label">Events Created</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
