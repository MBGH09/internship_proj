<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - Event Planner</title>
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
            background: #f5f5f5;
            border-bottom: 1px solid #e0e0e0;
            position: relative;
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
        }

        .nav-links a.active {
            color: #000;
            font-weight: 600;
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            right: 0;
            height: 2px;
            background: #7c3aed;
        }

        .nav-links a:hover {
            color: #7c3aed;
        }

        .user-profile {
            position: relative;
        }

        .user-profile-trigger {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 5px;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .user-profile-trigger:hover {
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

        .online-indicator {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 10px;
            height: 10px;
            background: #22c55e;
            border: 2px solid #f5f5f5;
            border-radius: 50%;
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

        /* Dropdown Menu */
        .dropdown-menu {
            position: absolute;
            top: 70px;
            right: 80px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            width: 240px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s;
            z-index: 1000;
        }

        .dropdown-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-header {
            padding: 16px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dropdown-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #7c3aed;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            position: relative;
        }

        .dropdown-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .dropdown-user-info {
            flex: 1;
        }

        .dropdown-name {
            font-size: 14px;
            font-weight: 600;
            color: #000;
            display: block;
        }

        .dropdown-email {
            font-size: 12px;
            color: #666;
            display: block;
        }

        .dropdown-items {
            padding: 8px 0;
        }

        .dropdown-item {
            display: block;
            padding: 12px 16px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.3s;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background: #f5f5f5;
        }

        .dropdown-item.logout {
            color: #dc2626;
            border-top: 1px solid #e0e0e0;
        }

        /* Main Content */
        .container {
            max-width: 700px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .page-title {
            text-align: center;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 40px;
            color: #000;
        }

        /* Form */
        .form-section {
            background: white;
            padding: 40px;
            border-radius: 12px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #000;
        }

        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="number"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            background: #fff;
            font-size: 14px;
            color: #333;
            outline: none;
            transition: border-color 0.3s;
            font-family: inherit;
        }

        .form-group input::placeholder,
        .form-group select option:first-child,
        .form-group textarea::placeholder {
            color: #bbb;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #7c3aed;
        }

        .form-group select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%237c3aed' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 40px;
            cursor: pointer;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* Event Description Section */
        .description-section {
            background: white;
            padding: 40px;
            border-radius: 12px;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #000;
            text-align: center;
        }

        .image-upload {
            width: 100%;
            height: 200px;
            border: 2px dashed #e0e0e0;
            border-radius: 8px;
            background: #fafafa;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: border-color 0.3s;
            margin-bottom: 24px;
            position: relative;
        }

        .image-upload:hover {
            border-color: #7c3aed;
        }

        .image-upload input {
            display: none;
        }

        .upload-placeholder {
            text-align: center;
            color: #999;
            font-size: 48px;
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            padding: 16px;
            background: #7c3aed;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            text-transform: capitalize;
        }

        .btn-submit:hover {
            background: #6d28d9;
        }

        .error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        /* Overlay for dropdown */
        .dropdown-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: transparent;
            display: none;
            z-index: 999;
        }

        .dropdown-overlay.active {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Dropdown Overlay -->
    <div class="dropdown-overlay" id="dropdownOverlay"></div>

    <!-- Header -->
    <header>
        <div class="logo">
            <h1>Event <span>Planner</span></h1>
        </div>
        <div class="nav-section">
            <nav class="nav-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('admin.events.index') }}" class="active">Events</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-submit" style="width: auto; padding: 10px 30px;">Logout</button>
                </form>
            </nav>
            <div class="user-profile">
                <div class="user-profile-trigger" id="profileTrigger">
                    <div class="user-avatar">
                        {{ substr(Auth::user()->mb_name, 0, 1) }}
                        <span class="online-indicator"></span>
                    </div>
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->mb_name }}</span>
                        <span class="user-email">{{ Auth::user()->mb_email }}</span>
                    </div>
                </div>

                <!-- Dropdown Menu -->
                <div class="dropdown-menu" id="dropdownMenu">
                    <div class="dropdown-header">
                        <div class="dropdown-avatar">
                            {{ substr(Auth::user()->mb_name, 0, 1) }}
                            <span class="online-indicator"></span>
                        </div>
                        <div class="dropdown-user-info">
                            <span class="dropdown-name">{{ Auth::user()->mb_name }}</span>
                            <span class="dropdown-email">{{ Auth::user()->mb_email }}</span>
                        </div>
                    </div>
                    <div class="dropdown-items">
                        <a href="{{ route('home') }}" class="dropdown-item">Home</a>
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="dropdown-item logout" style="width: 100%; text-align: left; border: none; background: none; font-family: inherit;">
                                Log out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <h1 class="page-title">Edit Event</h1>

        <form action="{{ route('admin.events.update', $event->mb_event_id) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            <!-- Event Information Section -->
            <div class="form-section">
                <x-form.input 
                    label="Event Title"
                    name="mb_title"
                    placeholder="Title"
                    :value="$event->mb_title ?? ''"
                    required
                />

                <x-form.select 
                    label="Category"
                    name="mb_category_id"
                    :options="$categories ?? []"
                    optionValue="mb_cat_id"
                    optionLabel="mb_cat_name"
                    :selected="$event->mb_category_id ?? null"
                    placeholder="Select category"
                    required
                />

                <div class="form-row">
                    <x-form.input 
                        label="Start date & time"
                        name="mb_start_date"
                        type="datetime-local"
                        placeholder="date and time"
                        :value="isset($event) ? $event->mb_start_date->format('Y-m-d\TH:i') : ''"
                        required
                    />

                    <x-form.input 
                        label="End date & time"
                        name="mb_end_date"
                        type="datetime-local"
                        placeholder="date and time"
                        :value="isset($event) ? $event->mb_end_date->format('Y-m-d\TH:i') : ''"
                        required
                    />
                </div>

                <div class="form-row">
                    <x-form.input 
                        label="Place"
                        name="mb_place"
                        placeholder="Place"
                        :value="$event->mb_place ?? ''"
                        required
                    />

                    <x-form.input 
                        label="Capacity"
                        name="mb_capacity"
                        type="number"
                        placeholder="Capacity"
                        :value="$event->mb_capacity ?? ''"
                        required
                    />
                </div>

                <div class="form-row">
                    <x-form.select 
                        label="Pricing"
                        name="mb_is_free"
                        :options="[
                            ['value' => '1', 'label' => 'Free Access'],
                            ['value' => '0', 'label' => 'Paid'],
                        ]"
                        :selected="$event->mb_is_free ?? '1'"
                        onchange="togglePriceField()"
                        required
                    />

                    <x-form.input 
                        label="Price"
                        name="mb_price"
                        type="number"
                        placeholder="Price"
                        step="0.01"
                        min="0"
                        :value="$event->mb_price ?? '0'"
                    />
                </div>
            </div>

            <!-- Event Description Section -->
            <div class="description-section">
                <h2 class="section-title">Event Description</h2>

                <x-form.file 
                    label="Event Image"
                    name="mb_image"
                    id="mb_image"
                    wrapperId="imageUploadArea"
                    accept="image/*"
                    helper="📷"
                />
                @if(isset($event) && $event->mb_image)
                    <p style="font-size: 12px; color: #666;">Current image: {{ basename($event->mb_image) }}</p>
                @endif

                <x-form.textarea 
                    label="Event Description"
                    name="mb_description"
                    placeholder="Type here..."
                    :value="$event->mb_description ?? ''"
                    required
                />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-submit">Update event</button>
        </form>
    </div>

    <script>
        // Dropdown toggle
        const profileTrigger = document.getElementById('profileTrigger');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const dropdownOverlay = document.getElementById('dropdownOverlay');

        profileTrigger.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('active');
            dropdownOverlay.classList.toggle('active');
        });

        dropdownOverlay.addEventListener('click', function() {
            dropdownMenu.classList.remove('active');
            dropdownOverlay.classList.remove('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!dropdownMenu.contains(e.target) && !profileTrigger.contains(e.target)) {
                dropdownMenu.classList.remove('active');
                dropdownOverlay.classList.remove('active');
            }
        });

        // Image upload preview
        document.getElementById('mb_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const uploadArea = document.getElementById('imageUploadArea');
                    uploadArea.style.backgroundImage = `url(${e.target.result})`;
                    uploadArea.style.backgroundSize = 'cover';
                    uploadArea.style.backgroundPosition = 'center';
                    uploadArea.querySelector('.upload-placeholder').style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        });

        // Toggle price field based on free/paid selection
        function togglePriceField() {
            const isFree = document.getElementById('mb_is_free').value;
            const priceField = document.getElementById('mb_price');
            
            if (isFree === '1') {
                priceField.value = '0';
                priceField.disabled = true;
            } else {
                priceField.disabled = false;
            }
        }

        // Initialize on page load
        togglePriceField();
    </script>
</body>
</html>
