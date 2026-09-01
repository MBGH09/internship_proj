<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - Event Planner</title>
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

        /* Header */
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
            position: relative;
            padding-bottom: 8px;
        }

        .nav-links a.active {
            color: #7c3aed;
            font-weight: 600;
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: #7c3aed;
        }

        .nav-links a:hover {
            color: #7c3aed;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 5px;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .user-profile:hover {
            background: #f0f0f0;
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
            position: relative;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
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

        /* Main Content */
        .container {
            max-width: 1400px;
            margin: 60px auto;
            padding: 0 80px;
        }

        .page-title {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 40px;
            color: #7c3aed;
        }

        /* Events Section */
        .events-container {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .events-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .events-title {
            font-size: 24px;
            font-weight: 700;
            color: #000;
        }

        .btn-create-event {
            padding: 12px 28px;
            background: #7c3aed;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-create-event:hover {
            background: #6d28d9;
        }

        /* Table */
        .events-table {
            width: 100%;
            border-collapse: collapse;
        }

        .events-table thead {
            background: #f9f9f9;
            border-bottom: 1px solid #e0e0e0;
        }

        .events-table th {
            padding: 16px 20px;
            text-align: left;
            font-size: 14px;
            font-weight: 600;
            color: #666;
        }

        .events-table td {
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
            color: #333;
        }

        .events-table tbody tr:hover {
            background: #f9f9f9;
        }

        .events-table tbody tr:last-child td {
            border-bottom: none;
        }

        .event-name {
            font-weight: 600;
            color: #000;
        }

        .actions-column {
            position: relative;
            text-align: center;
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            align-items: center;
        }

        .actions-column a,
        .actions-column button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.2rem;
            height: 2.2rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
        }

        .actions-column a {
            background: #2563eb;
            color: white;
        }

        .actions-column a:hover {
            background: #1d4ed8;
            transform: scale(1.05);
        }

        .actions-column button {
            background: #dc2626;
            color: white;
        }

        .actions-column button:hover {
            background: #b91c1c;
            transform: scale(1.05);
        }

        .actions-column form {
            display: inline;
            margin: 0;
        }
            transition: background 0.3s;
        }

        .btn-more:hover {
            background: #f0f0f0;
        }

        .actions-menu {
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            min-width: 150px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s;
            z-index: 100;
            margin-top: 5px;
        }

        .actions-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .actions-menu a,
        .actions-menu button {
            display: block;
            width: 100%;
            padding: 12px 16px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            text-align: left;
            background: none;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
            font-family: inherit;
        }

        .actions-menu a:hover,
        .actions-menu button:hover {
            background: #f5f5f5;
        }

        .actions-menu button.delete {
            color: #dc2626;
        }

        .actions-menu a:first-child {
            border-radius: 6px 6px 0 0;
        }

        .actions-menu button:last-child {
            border-radius: 0 0 6px 6px;
        }

        /* Empty State */
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
    <!-- Header -->
    <header>
        <div class="logo">
            <h1>Event <span>Planner</span></h1>
        </div>
        <div class="nav-section">
            <nav class="nav-links">
                <a href="/">Home</a>
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.categories.index') }}">Categories</a>
                <a href="{{ route('admin.events.index') }}" class="active">Events</a>
                <a href="{{ route('admin.registrations.index') }}">Registrations</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-create-event" style="width: auto;">Logout</button>
                </form>
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
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <h1 class="page-title">List of Events</h1>

        <div class="events-container">
            <div class="events-header">
                <h2 class="events-title">Events</h2>
                <a href="{{ route('admin.events.create') }}" class="btn-create-event">Create event</a>
            </div>

            @if($events && count($events) > 0)
                <table class="events-table">
                    <thead>
                        <tr>
                            <th>Event name</th>
                            <th>Start date</th>
                            <th>End Date</th>
                            <th>Pricing</th>
                            <th>Capacity</th>
                            <th>Place</th>
                            <th style="width: 50px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td class="event-name">{{ $event->mb_title }}</td>
                            <td>{{ $event->mb_start_date->format('M d, Y H:i') }}</td>
                            <td>{{ $event->mb_end_date->format('M d, Y H:i') }}</td>
                            <td>{{ $event->mb_is_free ? 'Free' : '$' . number_format($event->mb_price, 0) }}</td>
                            <td>{{ $event->mb_capacity }}</td>
                            <td>{{ $event->mb_place }}</td>
                            <td class="actions-column">
                                <a href="{{ route('admin.events.edit', $event->mb_event_id) }}" title="Edit">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.events.destroy', $event->mb_event_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <p>No events found</p>
                    <a href="{{ route('admin.events.create') }}">Create your first event</a>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Toggle actions menu
        function toggleMenu(event, index) {
            event.stopPropagation();
            const menu = document.getElementById(`menu-${index}`);
            
            // Close all other menus
            document.querySelectorAll('.actions-menu').forEach(m => {
                if (m !== menu) {
                    m.classList.remove('active');
                }
            });
            
            menu.classList.toggle('active');
        }

        // Close menus when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.actions-column')) {
                document.querySelectorAll('.actions-menu').forEach(menu => {
                    menu.classList.remove('active');
                });
            }
        });

        // Prevent menu from closing when clicking inside
        document.querySelectorAll('.actions-menu').forEach(menu => {
            menu.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>
</body>
</html>
