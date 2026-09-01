<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Events - Event Planner</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #1a1a1a;
            background-color: #ffffff;
            line-height: 1.6;
        }

        /* Header Styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 5%;
            background-color: #ffffff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a1a;
        }

        .logo span {
            color: #7c3aed;
        }

        .header-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .btn-login {
            background: transparent;
            color: #1a1a1a;
        }

        .btn-login:hover {
            color: #7c3aed;
        }

        .btn-signup {
            background: #7c3aed;
            color: white;
        }

        .btn-signup:hover {
            background: #6d28d9;
            transform: translateY(-1px);
        }

        /* Events Section */
        .events-section {
            padding: 3rem 5%;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
        }

        .section-title span {
            color: #7c3aed;
        }

        .filters {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-box {
            padding: 0.75rem 1.25rem;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 0.95rem;
            width: 250px;
        }

        .filter-select {
            padding: 0.75rem 1.25rem;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 0.95rem;
            background: white;
            cursor: pointer;
        }

        /* Events Grid */
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .event-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .event-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .event-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: white;
            color: #1a1a1a;
            padding: 0.4rem 0.9rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .event-badge.free {
            background: #10b981;
            color: white;
        }

        .event-content {
            padding: 1.5rem;
        }

        .event-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: #1a1a1a;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .event-meta {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            color: #6b7280;
            font-size: 0.9rem;
        }

        .event-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .event-type {
            display: inline-block;
            background: #f3f4f6;
            color: #4b5563;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 500;
            margin-top: 0.5rem;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 3rem;
        }

        .pagination a, .pagination span {
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            text-decoration: none;
            color: #1a1a1a;
            transition: all 0.3s;
        }

        .pagination a:hover {
            background: #7c3aed;
            color: white;
            border-color: #7c3aed;
        }

        .pagination .active {
            background: #7c3aed;
            color: white;
            border-color: #7c3aed;
        }

        .pagination .disabled {
            color: #9ca3af;
            cursor: not-allowed;
        }

        /* Footer */
        .footer {
            background: #0a0a23;
            color: white;
            padding: 3rem 5% 2rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
        }

        .footer-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            flex-wrap: wrap;
            gap: 2rem;
        }

        .footer-logo {
            font-size: 1.75rem;
            font-weight: 700;
        }

        .footer-logo span {
            color: #7c3aed;
        }

        .newsletter {
            display: flex;
            gap: 0.75rem;
        }

        .newsletter-input {
            padding: 0.75rem 1.25rem;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 6px;
            background: rgba(255,255,255,0.1);
            color: white;
            font-size: 0.95rem;
            width: 280px;
        }

        .newsletter-input::placeholder {
            color: rgba(255,255,255,0.5);
        }

        .btn-subscribe {
            background: #7c3aed;
            color: white;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-links {
            display: flex;
            gap: 2rem;
        }

        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: white;
        }

        .copyright {
            color: rgba(255,255,255,0.5);
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .events-grid {
                grid-template-columns: 1fr;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .filters {
                width: 100%;
            }

            .search-box {
                width: 100%;
            }

            .footer-top {
                flex-direction: column;
                align-items: flex-start;
            }

            .newsletter {
                width: 100%;
                flex-direction: column;
            }

            .newsletter-input {
                width: 100%;
            }
        }

        .no-events {
            text-align: center;
            padding: 4rem 2rem;
            color: #6b7280;
            grid-column: 1/-1;
        }

        .no-events h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #1a1a1a;
        }

        .image-wrapper {
            position: relative;
        }

    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            Event <span>Planner</span>
        </div>
        <div class="header-buttons">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-login">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-signup">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                <a href="{{ route('register') }}" class="btn btn-signup">Signup</a>
            @endauth
        </div>
    </header>

    <!-- Events Section -->
    <section class="events-section">
        <div class="section-header">
            <h2 class="section-title">Upcoming <span>Events</span></h2>
            <div class="filters">
                <form method="GET" action="{{ route('events.index') }}" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                    <input type="text" class="search-box" name="search" placeholder="Search" value="{{ $search ?? '' }}">
                    <select class="filter-select" name="category_id" onchange="this.form.submit()">
                        <option value="">Any category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->mb_cat_id }}" {{ ($categoryId ?? '') == $category->mb_cat_id ? 'selected' : '' }}>
                                {{ $category->mb_cat_name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-signup" style="padding: 0.75rem 1.5rem;">Search</button>
                </form>
            </div>
        </div>

        <div class="events-grid">
            @forelse($events as $event)
                <div style="position: relative;">
                    <a href="{{ route('events.show', $event->mb_event_id) }}" class="event-card">
                        <div class="image-wrapper">
                            @if($event->mb_image)
                                <img src="{{ asset('storage/' . $event->mb_image) }}" alt="{{ $event->mb_title }}" class="event-image">
                            @else
                                <div class="event-image" style="background: linear-gradient(135deg, {{ ['#667eea 0%, #764ba2', '#f093fb 0%, #f5576c', '#4facfe 0%, #00f2fe', '#43e97b 0%, #38f9d7'][array_rand(['#667eea 0%, #764ba2', '#f093fb 0%, #f5576c', '#4facfe 0%, #00f2fe', '#43e97b 0%, #38f9d7'])] }} 100%);"></div>
                            @endif
                            <span class="event-badge {{ $event->mb_is_free ? 'free' : '' }}">
                                {{ $event->mb_is_free ? 'FREE' : 'PAID' }}
                            </span>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title">{{ $event->mb_title }}</h3>
                            <div class="event-meta">
                                <div class="event-meta-item">
                                    <span>📅</span>
                                    <span>{{ $event->mb_start_date->format('D, M d, Y H:i') }}</span>
                                </div>
                                <div class="event-meta-item">
                                    <span></span>
                                    <span>{{ $event->mb_place }}</span>
                                </div>
                            </div>
                            @if($event->category)
                                <span class="event-type">{{ $event->category->mb_cat_name }}</span>
                            @endif
                        </div>
                    </a>
                    @if(Auth::check() && Auth::user()->mb_user_id === $event->mb_created_by)
                        <div style="position: absolute; top: 1rem; right: 1rem; display: flex; gap: 0.5rem;">
                            <a href="{{ route('events.edit', $event->mb_event_id) }}" style="display: flex; align-items: center; justify-content: center; width: 2.5rem; height: 2.5rem; background: #2563eb; color: white; border-radius: 6px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;" title="Edit">
                                ✏️
                            </a>
                            <form action="{{ route('events.destroy', $event->mb_event_id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="display: flex; align-items: center; justify-content: center; width: 2.5rem; height: 2.5rem; background: #dc2626; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;" title="Delete">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <div class="no-events">
                    <h3>No upcoming events</h3>
                    <p>Check back soon for new events!</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($events->count() > 0)
        <div class="pagination">
            {{ $events->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-top">
                <div class="footer-logo">
                    Event <span>Planner</span>
                </div>
                <div class="copyright">
                    Non Copyrighted © {{ date('Y') }} Event Planner
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
