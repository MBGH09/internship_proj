<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $event->mb_title }} - Event Planner</title>
    
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
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .btn-login {
            background: transparent;
            color: #1a1a1a;
            border: 1px solid #e5e7eb;
        }

        .btn-login:hover {
            border-color: #7c3aed;
            color: #7c3aed;
        }

        .btn-signup {
            background: #7c3aed;
            color: white;
        }

        .btn-signup:hover {
            background: #6d28d9;
        }

        /* Content Section */
        .content {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem 5%;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #7c3aed;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            margin-bottom: 2rem;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }

        .back-btn:hover {
            background: #6d28d9;
        }

        .hero-section {
            position: relative;
            height: 350px;
            margin-bottom: 2rem;
            border-radius: 1rem;
            overflow: hidden;
        }

        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-gradient {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #a78bfa, #ec4899);
        }

        /* Event Details */
        .event-header {
            margin-bottom: 2rem;
        }

        .event-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #1a1a1a;
        }

        .event-location {
            font-size: 1.25rem;
            color: #4b5563;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .event-badge {
            display: inline-block;
            background: #ede9fe;
            color: #7c3aed;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .book-button {
            width: 100%;
            background: #7c3aed;
            color: white;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            margin: 1.5rem 0;
            transition: background 0.3s;
        }

        .book-button:hover {
            background: #6d28d9;
        }

        .book-link {
            display: block;
            width: 100%;
            text-align: center;
            background: #7c3aed;
            color: white;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            text-decoration: none;
            margin: 1.5rem 0;
            transition: background 0.3s;
        }

        .book-link:hover {
            background: #6d28d9;
        }

        .description-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: #1a1a1a;
        }

        .description-text {
            color: #374151;
            line-height: 1.625;
            white-space: pre-wrap;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .detail-box {
            padding: 1.5rem;
            background: #f9fafb;
            border-radius: 0.75rem;
        }

        .detail-label {
            font-weight: 500;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .detail-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: #7c3aed;
        }

        .detail-subtext {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        /* Related Events */
        .related-section {
            margin-bottom: 3rem;
        }

        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .event-card {
            background: white;
            border-radius: 0.75rem;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .event-card:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            transform: translateY(-5px);
        }

        /* Modal Styles */
        [x-cloak] {
            display: none !important;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
        }

        .modal-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
            color: #1a1a1a;
        }

        .modal-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .modal-btn {
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            border: 2px solid;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 1rem;
        }

        .modal-btn-cancel {
            background: transparent;
            color: #7c3aed;
            border-color: #7c3aed;
        }

        .modal-btn-cancel:hover {
            background: #7c3aed;
            color: white;
        }

        .modal-btn-confirm {
            background: #7c3aed;
            color: white;
            border-color: #7c3aed;
        }

        .modal-btn-confirm:hover {
            background: #6d28d9;
            border-color: #6d28d9;
        }

        .event-card-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
        }

        .event-image-placeholder {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
        }

        .badge {
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

        .badge.free {
            background: #10b981;
            color: white;
        }

        .event-info {
            padding: 1rem;
        }

        .event-card-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .event-card-meta {
            font-size: 0.875rem;
            color: #6b7280;
            line-height: 1.5;
        }

        /* Footer */
        .footer {
            background: #0a0a23;
            color: white;
            padding: 3rem 5% 2rem;
            margin-top: 3rem;
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
            font-size: 1.5rem;
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
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            width: 250px;
            font-family: 'Inter', sans-serif;
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

        @media (max-width: 768px) {
            .event-title {
                font-size: 1.875rem;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .hero-section {
                height: 250px;
            }

            .event-grid {
                grid-template-columns: 1fr;
            }

            .newsletter {
                flex-direction: column;
                width: 100%;
            }

            .newsletter-input {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div x-data="{ showBookModal: false, isRegistered: {{ $isRegistered ? 'true' : 'false' }} }">
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

        <!-- Content -->
        <div class="content">
            <a href="{{ route('home') }}" class="back-btn">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 1rem; height: 1rem;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>

            <!-- Hero Image -->
            <div class="hero-section">
                @if($event->mb_image)
                    <img src="{{ asset('storage/' . $event->mb_image) }}" alt="{{ $event->mb_title }}" class="hero-image">
                @else
                    <div class="hero-gradient"></div>
                @endif
            </div>

            <!-- Event Header -->
            <div class="event-header">
                <h1 class="event-title">{{ $event->mb_title }}</h1>
                <p class="event-location">{{ $event->mb_place }}</p>
                @if((int)($event->mb_price ?? 0) === 0)
                    <span class="event-badge">FREE</span>
                @endif
            </div>

            <!-- Book Button -->
            @auth
                @if(auth()->user()->mb_role !== 'admin')
                    <button @click="showBookModal = true" class="book-button" :class="isRegistered ? 'book-button-cancel' : ''" :style="isRegistered ? 'background: #ef4444;' : 'background: #7c3aed;'">
                        <span x-show="!isRegistered">Book now</span>
                        <span x-show="isRegistered">Cancel Registration</span>
                    </button>
                @endif
            @else
                <a href="{{ route('login') }}" class="book-link">Login to Book</a>
            @endauth

            <!-- Description -->
            <div class="description-section">
                <h2 class="section-title">Description</h2>
                <p class="description-text">{{ $event->mb_description }}</p>
            </div>

            <!-- Details Grid -->
            <div class="details-grid">
                <div class="detail-box">
                    <div class="detail-label">Start Date</div>
                    <div class="detail-value">{{ optional($event->mb_start_date)->format('l, F j, Y H:i') }}</div>
                </div>

                <div class="detail-box">
                    <div class="detail-label">End Date</div>
                    <div class="detail-value">{{ optional($event->mb_end_date)->format('l, F j, Y H:i') }}</div>
                </div>

                <div class="detail-box">
                    <div class="detail-label">Category</div>
                    <div class="detail-value" style="font-size: 1rem;">{{ $event->category->mb_cat_name ?? 'N/A' }}</div>
                </div>

                <div class="detail-box">
                    <div class="detail-label">Capacity</div>
                    <div class="detail-value">{{ $event->mb_capacity }}</div>
                    <div class="detail-subtext">seats available</div>
                </div>
            </div>

            <!-- Related Events -->
            @php
                $relatedEvents = App\Models\mb_Event::where('mb_is_active', true)
                    ->where('mb_event_id', '!=', $event->mb_event_id)
                    ->where('mb_start_date', '>=', now())
                    ->orderBy('mb_start_date', 'asc')
                    ->take(3)
                    ->get();
            @endphp

            @if($relatedEvents->count() > 0 && !(auth()->check() && auth()->user()->mb_role === 'admin'))
                <div class="related-section">
                    <h2 class="section-title">Other events you may like</h2>
                    <div class="event-grid">
                        @foreach($relatedEvents as $relatedEvent)
                            <a href="{{ route('events.show', $relatedEvent->mb_event_id) }}" class="event-card">
                                <div style="position: relative;">
                                    @if($relatedEvent->mb_image)
                                        <img src="{{ asset('storage/' . $relatedEvent->mb_image) }}" alt="{{ $relatedEvent->mb_title }}" class="event-card-image">
                                    @else
                                        <div class="event-image-placeholder"></div>
                                    @endif
                                    <span class="badge {{ $relatedEvent->mb_is_free ? 'free' : '' }}">
                                        {{ $relatedEvent->mb_is_free ? 'FREE' : 'PAID' }}
                                    </span>
                                </div>
                                <div class="event-info">
                                    <h3 class="event-card-title">{{ $relatedEvent->mb_title }}</h3>
                                    <div class="event-card-meta">
                                        <div>📅 {{ $relatedEvent->mb_start_date->format('D, M d, Y H:i') }}</div>
                                        <div> {{ $relatedEvent->mb_place }}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Book Event Modal -->
        <div x-show="showBookModal" 
             x-cloak
             @click.self="showBookModal = false"
             class="modal-overlay"
             style="display: none;">
            <div class="modal-content" @click.stop>
                <h2 class="modal-title" x-show="!isRegistered">Book Event</h2>
                <h2 class="modal-title" x-show="isRegistered">Cancel Registration</h2>
                <div class="modal-buttons">
                    <button type="button" @click="showBookModal = false" class="modal-btn modal-btn-cancel">
                        Cancel
                    </button>
                    <form x-show="!isRegistered" action="{{ route('events.register', $event->mb_event_id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="modal-btn modal-btn-confirm">
                            Book now
                        </button>
                    </form>
                    <form x-show="isRegistered" action="{{ route('events.unregister', $event->mb_event_id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="modal-btn modal-btn-confirm" style="background: #ef4444; border-color: #ef4444;">
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
                
                <div class="footer-bottom">
                    <div class="copyright">
                        Non Copyrighted © {{ date('Y') }} Event Planner
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
