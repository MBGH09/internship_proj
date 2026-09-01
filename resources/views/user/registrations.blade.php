<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Registrations - Event Planner</title>
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
            background: white;
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

        .nav-links a.active {
            color: #7c3aed;
            font-weight: 600;
        }

        .nav-links a:hover {
            color: #7c3aed;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #7c3aed;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
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
            padding: 0 80px;
        }

        .page-title {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 40px;
            color: #7c3aed;
        }

        .registrations-container {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .registrations-title {
            font-size: 24px;
            font-weight: 700;
            color: #000;
            margin-bottom: 30px;
        }

        .registrations-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .registration-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .registration-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .registration-header {
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
            padding: 20px;
            color: white;
        }

        .registration-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .registration-status {
            font-size: 12px;
            opacity: 0.9;
        }

        .registration-content {
            padding: 20px;
        }

        .registration-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f0f0f0;
        }

        .detail-label {
            font-size: 12px;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
        }

        .detail-value {
            font-size: 14px;
            color: #000;
            font-weight: 500;
        }

        .registration-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
        }

        .btn-view {
            flex: 1;
            padding: 10px;
            background: #7c3aed;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-view:hover {
            background: #6d28d9;
        }

        .btn-cancel {
            flex: 1;
            padding: 10px;
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fca5a5;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-cancel:hover {
            background: #fecaca;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .empty-state a {
            color: #7c3aed;
            text-decoration: none;
            font-weight: 600;
        }

        .empty-state a:hover {
            text-decoration: underline;
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
                <a href="{{ route('dashboard') }}" class="btn btn-login">Dashboard</a>
               
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-view" style="width: auto;">Logout</button>
                </form>
            </nav>
            <div style="display: flex; gap: 12px; align-items: center;">
                <div class="user-avatar">
                    {{ substr(Auth::user()->mb_name, 0, 1) }}
                </div>
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->mb_name }}</span>
                    <span class="user-email">{{ Auth::user()->mb_email }}</span>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <h1 class="page-title">My Registrations</h1>

        <div class="registrations-container">
            @if($events && count($events) > 0)
                <h2 class="registrations-title">Events You're Attending</h2>
                <div class="registrations-grid">
                    @foreach($events as $event)
                    <div class="registration-card">
                        <div class="registration-header">
                            <h3 class="registration-title">{{ $event->mb_title }}</h3>
                            <p class="registration-status">✓ Registered</p>
                        </div>
                        <div class="registration-content">
                            <div class="registration-detail">
                                <span class="detail-label">Start Date</span>
                                <span class="detail-value">{{ $event->mb_start_date->format('M d, Y') }}</span>
                            </div>
                            <div class="registration-detail">
                                <span class="detail-label">Time</span>
                                <span class="detail-value">{{ $event->mb_start_date->format('g:ia') }}</span>
                            </div>
                            <div class="registration-detail">
                                <span class="detail-label">Location</span>
                                <span class="detail-value">{{ $event->mb_place }}</span>
                            </div>
                            <div class="registration-detail">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">{{ $event->mb_is_free ? 'Free' : '$' . number_format($event->mb_price, 2) }}</span>
                            </div>

                            <div class="registration-actions">
                                <a href="{{ route('events.show', $event->mb_event_id) }}" class="btn-view">View Details</a>
                                <form action="{{ route('events.unregister', $event->mb_event_id) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    <button type="submit" class="btn-cancel" style="width: 100%;">Cancel Registration</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <p>You haven't registered for any events yet.</p>
                    <a href="{{ route('events.index') }}">Browse Events</a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
