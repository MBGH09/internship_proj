<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Events - Event Planner</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
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

        /* Modal Styles */
        [x-cloak] {
            display: none !important;
        }

        .fixed {
            position: fixed;
        }

        .inset-0 {
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .z-50 {
            z-index: 50;
        }

        .bg-black.bg-opacity-50 {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-center {
            justify-content: center;
        }

        .rounded-2xl {
            border-radius: 1rem;
        }

        .max-w-4xl {
            max-width: 56rem;
        }

        .w-full {
            width: 100%;
        }

        .overflow-y-auto {
            overflow-y: auto;
        }

        .relative {
            position: relative;
        }

        .h-64 {
            height: 16rem;
        }

        .object-cover {
            object-fit: cover;
        }

        .rounded-t-2xl {
            border-radius: 1rem 1rem 0 0;
        }

        .absolute {
            position: absolute;
        }

        .top-4 {
            top: 1rem;
        }

        .left-4 {
            left: 1rem;
        }

        .right-4 {
            right: 1rem;
        }

        .bg-purple-600 {
            background-color: #7c3aed;
        }

        .text-white {
            color: white;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .rounded-lg {
            border-radius: 0.5rem;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .hover\:bg-purple-700:hover {
            background-color: #6d28d9;
        }

        .bg-white {
            background-color: white;
        }

        .rounded-full {
            border-radius: 9999px;
        }

        .p-2 {
            padding: 0.5rem;
        }

        .w-10 {
            width: 2.5rem;
        }

        .h-10 {
            height: 2.5rem;
        }

        .p-6 {
            padding: 1.5rem;
        }

        .mb-6 {
            margin-bottom: 1.5rem;
        }

        .text-3xl {
            font-size: 1.875rem;
        }

        .font-bold {
            font-weight: 700;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .text-gray-600 {
            color: #4b5563;
        }

        .font-medium {
            font-weight: 500;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .text-xs {
            font-size: 0.75rem;
        }

        .bg-purple-100 {
            background-color: #ede9fe;
        }

        .text-purple-700 {
            color: #7c3aed;
        }

        .px-3 {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        .py-1 {
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
        }

        .font-semibold {
            font-weight: 600;
        }

        .mb-8 {
            margin-bottom: 2rem;
        }

        .text-xl {
            font-size: 1.25rem;
        }

        .mb-3 {
            margin-bottom: 0.75rem;
        }

        .text-gray-700 {
            color: #374151;
        }

        .leading-relaxed {
            line-height: 1.625;
        }

        .space-y-2 > * + * {
            margin-top: 0.5rem;
        }

        .text-purple-600 {
            color: #7c3aed;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .text-gray-500 {
            color: #6b7280;
        }

        .grid {
            display: grid;
        }

        .gap-6 {
            gap: 1.5rem;
        }

        .grid-cols-1 {
            grid-template-columns: 1fr;
        }

        .grid-cols-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .gap-4 {
            gap: 1rem;
        }

        .shadow-sm {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .border {
            border: 1px solid;
        }

        .border-gray-200 {
            border-color: #e5e7eb;
        }

        .overflow-hidden {
            overflow: hidden;
        }

        .h-32 {
            height: 8rem;
        }

        .h-80 {
            height: 20rem;
        }

        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        @media (max-width: 768px) {
            .md\:h-80 {
                height: 16rem;
            }

            .md\:p-8 {
                padding: 2rem;
            }

            .md\:grid-cols-2 {
                grid-template-columns: 1fr 1fr;
            }

            .md\:grid-cols-3 {
                grid-template-columns: 1fr;
            }

            .md\:w-auto {
                width: auto;
            }

            .md\:text-4xl {
                font-size: 2.25rem;
            }
        }

        /* Modal Book Confirmation */
        .confirmation-modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
            z-index: 100;
        }

        .confirmation-modal h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
            color: #1a1a1a;
        }

        .confirmation-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .confirmation-btn {
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            border: 2px solid;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 1rem;
        }

        .confirmation-btn-cancel {
            background: transparent;
            color: #7c3aed;
            border-color: #7c3aed;
        }

        .confirmation-btn-cancel:hover {
            background: #7c3aed;
            color: white;
        }

        .confirmation-btn-confirm {
            background: #7c3aed;
            color: white;
            border-color: #7c3aed;
        }

        .confirmation-btn-confirm:hover {
            background: #6d28d9;
            border-color: #6d28d9;
        }
    

    </style>
</head>
<body>
    <div x-data="{ 
        selectedEvent: null, 
        showConfirmation: false, 
        selectedEventForBook: null,
        registeredEvents: {!! auth()->check() ? json_encode(auth()->user()->eventAttending()->pluck('mb_event_id')->toArray()) : '[]' !!}
    }">
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
                    <form method="GET" action="{{ route('home') }}" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
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
                    <div class="event-card" @click="selectedEvent = {{ $event->mb_event_id }}" style="cursor: pointer;">
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

        <!-- Modal Event Details -->
        <div x-show="selectedEvent !== null" 
             x-cloak
             @click.self="selectedEvent = null"
             class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50"
             style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; padding: 1rem; z-index: 50;">
            <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto" @click.stop style="background: white; border-radius: 1rem; max-width: 64rem; width: 100%; max-height: 90vh; overflow-y: auto;">
                @foreach($events as $event)
                    <div x-show="selectedEvent === {{ $event->mb_event_id }}" class="relative">
                        <!-- Header with image -->
                        <div class="relative h-64 md:h-80" style="position: relative; height: 16rem;">
                            @if($event->mb_image)
                                <img src="{{ asset('storage/' . $event->mb_image) }}" alt="{{ $event->mb_title }}" class="w-full h-full object-cover rounded-t-2xl" style="width: 100%; height: 100%; object-fit: cover; border-radius: 1rem 1rem 0 0;">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-purple-400 to-pink-400 rounded-t-2xl" style="width: 100%; height: 100%; background: linear-gradient(to bottom right, #a78bfa, #ec4899); border-radius: 1rem 1rem 0 0;"></div>
                            @endif
                            <button @click="selectedEvent = null" class="absolute top-4 left-4 bg-purple-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-purple-700" style="position: absolute; top: 1rem; left: 1rem; background: #7c3aed; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; display: flex; align-items: center; gap: 0.5rem; border: none; cursor: pointer;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 1rem; height: 1rem;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Back
                            </button>
                        </div>

                        <!-- Content -->
                        <div class="p-6 md:p-8" style="padding: 1.5rem;">
                            <!-- Title and category -->
                            <div class="mb-6" style="margin-bottom: 1.5rem;">
                                <h2 class="text-3xl md:text-4xl font-bold mb-2" style="font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $event->mb_title }}</h2>
                                <p class="text-lg text-gray-600 font-medium" style="font-size: 1.125rem; color: #4b5563; font-weight: 500;">{{ $event->mb_place }}</p>
                                @if((int)($event->mb_price ?? 0) === 0)
                                    <span class="inline-block mt-2 text-xs bg-purple-100 text-purple-700 px-3 py-1 rounded-full font-semibold" style="display: inline-block; margin-top: 0.5rem; font-size: 0.75rem; background: #ede9fe; color: #7c3aed; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 600;">FREE</span>
                                @endif
                            </div>

                            <!-- Book now button -->
                            @auth
                                <button @click="showConfirmation = true; selectedEventForBook = {{ $event->mb_event_id }}" class="w-full md:w-auto hover:bg-purple-700 text-white font-semibold px-8 py-3 rounded-lg" :class="registeredEvents.includes({{ $event->mb_event_id }}) ? 'bg-red-500 hover:bg-red-600' : 'bg-purple-600 hover:bg-purple-700'" style="width: 100%; color: white; font-weight: 600; padding: 0.75rem 2rem; border-radius: 0.5rem; border: none; cursor: pointer; margin-bottom: 1.5rem; transition: background 0.3s;">
                                    <span x-show="!registeredEvents.includes({{ $event->mb_event_id }})">Book now</span>
                                    <span x-show="registeredEvents.includes({{ $event->mb_event_id }})">Cancel Registration</span>
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="inline-block mb-6 w-full md:w-auto text-center bg-purple-600 hover:bg-purple-700 text-white font-semibold px-8 py-3 rounded-lg" style="display: inline-block; margin-bottom: 1.5rem; width: 100%; text-align: center; background: #7c3aed; color: white; font-weight: 600; padding: 0.75rem 2rem; border-radius: 0.5rem; text-decoration: none;">
                                    Login to Book
                                </a>
                            @endauth

                            <!-- Description -->
                            <div class="mb-8" style="margin-bottom: 2rem;">
                                <h3 class="text-xl font-bold mb-3" style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem;">Description</h3>
                                <div class="text-gray-700 leading-relaxed space-y-2" style="color: #374151; line-height: 1.5;">
                                    {!! nl2br(e($event->mb_description)) !!}
                                </div>
                            </div>

                            <!-- Details Grid -->
                            <div class="grid md:grid-cols-2 gap-6 mb-8" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                                <!-- Hours -->
                                <div>
                                    <h3 class="text-xl font-bold mb-3" style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem;">Hours</h3>
                                    <div class="space-y-2" style="display: flex; flex-direction: column; gap: 0.5rem;">
                                        <p class="text-sm text-gray-500" style="font-size: 0.875rem; color: #6b7280;">{{ optional($event->mb_start_date)->format('l, F j, Y') }}</p>
                                    </div>
                                </div>

                                <!-- Capacity -->
                                <div>
                                    <h3 class="text-xl font-bold mb-3" style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem;">Capacity</h3>
                                    <p class="text-gray-700" style="color: #374151;">
                                        <span class="font-medium" style="font-weight: 500;">Seats available:</span> 
                                        <span class="text-purple-600 font-semibold text-xl" style="color: #7c3aed; font-weight: 600; font-size: 1.25rem;">{{ $event->mb_capacity }}</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Other events recommendation -->
                            <div>
                                <h3 class="text-xl font-bold mb-4" style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem;">Other events you may like</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                                    @foreach($events->where('mb_event_id', '!=', $event->mb_event_id)->take(3) as $otherEvent)
                                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden cursor-pointer" @click="selectedEvent = {{ $otherEvent->mb_event_id }}" style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; overflow: hidden; cursor: pointer;">
                                            <div class="relative">
                                                @if($otherEvent->mb_image)
                                                    <img src="{{ asset('storage/' . $otherEvent->mb_image) }}" alt="{{ $otherEvent->mb_title }}" class="w-full h-32 object-cover" style="width: 100%; height: 8rem; object-fit: cover;">
                                                @else
                                                    <div class="w-full h-32 bg-gray-100" style="width: 100%; height: 8rem; background: #f3f4f6;"></div>
                                                @endif
                                                @if((int)($otherEvent->mb_price ?? 0) === 0)
                                                    <span class="absolute top-2 left-2 text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded" style="position: absolute; top: 0.5rem; left: 0.5rem; font-size: 0.75rem; background: #ede9fe; color: #7c3aed; padding: 0.25rem 0.5rem; border-radius: 0.25rem;">FREE</span>
                                                @endif
                                            </div>
                                            <div class="p-3" style="padding: 0.75rem;">
                                                <h4 class="font-semibold text-sm mb-1 line-clamp-2" style="font-weight: 600; font-size: 0.875rem; margin-bottom: 0.25rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{ $otherEvent->mb_title }}</h4>
                                                <p class="text-xs text-gray-600 mb-1" style="font-size: 0.75rem; color: #4b5563; margin-bottom: 0.25rem;">{{ optional($otherEvent->mb_start_date)->format('D, M d, Y') }}</p>
                                                <p class="text-xs text-gray-500" style="font-size: 0.75rem; color: #6b7280;">{{ $otherEvent->category->mb_cat_name ?? '—' }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Book Confirmation Modal -->
        <div x-show="showConfirmation" 
             x-cloak
             @click.self="showConfirmation = false"
             class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50"
             style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; padding: 1rem; z-index: 50;">
            <div class="confirmation-modal" @click.stop>
                <h2 x-show="!registeredEvents.includes(selectedEventForBook)">Book Event</h2>
                <h2 x-show="registeredEvents.includes(selectedEventForBook)">Cancel Registration</h2>
                <div class="confirmation-buttons">
                    <button type="button" @click="showConfirmation = false" class="confirmation-btn confirmation-btn-cancel">
                        Cancel
                    </button>
                    <form x-show="!registeredEvents.includes(selectedEventForBook)" :action="'/events/' + selectedEventForBook + '/register'" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="confirmation-btn confirmation-btn-confirm">
                            Book now
                        </button>
                    </form>
                    <form x-show="registeredEvents.includes(selectedEventForBook)" :action="'/events/' + selectedEventForBook + '/unregister'" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="confirmation-btn confirmation-btn-confirm" style="background: #ef4444; border-color: #ef4444;">
                            Cancel Registration
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-top">
                    <div class="footer-logo">
                        Event <span>Planner</span>
                    </div>
                </div>
                
                    <div class="copyright">
                        Non Copyrighted © {{ date('Y') }} Event Planner
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
           