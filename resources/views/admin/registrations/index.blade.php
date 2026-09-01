<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrations - Event Planner</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif; background: #f5f5f5; }
        header { display: flex; justify-content: space-between; align-items: center; padding: 20px 80px; background: white; border-bottom: 1px solid #e0e0e0; }
        .logo h1 { font-size: 28px; font-weight: 700; color: #000; }
        .logo span { color: #7c3aed; }
        .nav-section { display: flex; align-items: center; gap: 30px; }
        .nav-links { display: flex; gap: 25px; align-items: center; }
        .nav-links a { color: #333; text-decoration: none; font-size: 16px; font-weight: 500; transition: color 0.3s; position: relative; padding-bottom: 8px; }
        .nav-links a.active { color: #7c3aed; font-weight: 600; }
        .nav-links a.active::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: #7c3aed; }
        .nav-links a:hover { color: #7c3aed; }
        .user-profile { display: flex; align-items: center; gap: 12px; cursor: pointer; padding: 5px; border-radius: 8px; transition: background 0.3s; }
        .user-profile:hover { background: #f0f0f0; }
        .user-avatar { width: 40px; height: 40px; border-radius: 50%; background: #7c3aed; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 16px; }
        .user-info { display: flex; flex-direction: column; }
        .user-name { font-size: 14px; font-weight: 600; color: #000; }
        .user-email { font-size: 12px; color: #666; }
        .container { max-width: 1400px; margin: 60px auto; padding: 0 80px; }
        .page-title { font-size: 42px; font-weight: 700; margin-bottom: 40px; color: #7c3aed; }
        .registrations-container { background: white; border-radius: 12px; padding: 30px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); }
        .registrations-title { font-size: 24px; font-weight: 700; color: #000; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .registrations-table { width: 100%; border-collapse: collapse; }
        .registrations-table thead { background: #f9f9f9; border-bottom: 1px solid #e0e0e0; }
        .registrations-table th { padding: 16px 20px; text-align: left; font-size: 14px; font-weight: 600; color: #666; }
        .registrations-table td { padding: 18px 20px; border-bottom: 1px solid #e0e0e0; font-size: 14px; color: #333; }
        .registrations-table tbody tr:hover { background: #f9f9f9; }
        .registrations-table tbody tr:last-child td { border-bottom: none; }
        .tag { display: inline-block; padding: 6px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; background: #eef2ff; color: #4338ca; }
        .empty-state { text-align: center; padding: 60px 20px; color: #999; }
        .empty-state p { font-size: 16px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1>Event <span>Planner</span></h1>
        </div>
        <div class="nav-section">
            <nav class="nav-links">
                <a href="/">Home</a>
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.categories.index') }}">Categories</a>
                <a href="{{ route('admin.events.index') }}">Events</a>
                <a href="{{ route('admin.registrations.index') }}" class="active">Registrations</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-create-event" style="width: auto; padding: 10px 16px; background:#7c3aed; color:#fff; border:none; border-radius:6px; font-weight:600; cursor:pointer;">Logout</button>
                </form>
            </nav>
            <div class="user-profile">
                <div class="user-avatar">{{ substr(Auth::user()->mb_name, 0, 1) }}</div>
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->mb_name }}</span>
                    <span class="user-email">{{ Auth::user()->mb_email }}</span>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <h1 class="page-title">User registrations</h1>

        <div class="registrations-container">
            <div class="registrations-title">
                <span>Registrations</span>
                <span class="tag">Total: {{ $registrations->total() }}</span>
            </div>

            @if($registrations->count())
                <table class="registrations-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Event</th>
                            <th>Event dates</th>
                            <th>Registered at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $registration)
                            <tr>
                                <td>{{ $registration->user->mb_name ?? 'Unknown user' }}</td>
                                <td>{{ $registration->user->mb_email ?? '-' }}</td>
                                <td>{{ $registration->event->mb_title ?? 'Unknown event' }}</td>
                                <td>
                                    @if($registration->event)
                                        {{ $registration->event->mb_start_date?->format('M d, Y H:i') }} - {{ $registration->event->mb_end_date?->format('M d, Y H:i') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $registration->created_at?->format('M d, Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="margin-top: 20px;">
                    {{ $registrations->links() }}
                </div>
            @else
                <div class="empty-state">
                    <p>No registrations yet.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
