<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category - Event Planner</title>
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
            color: #000;
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

        /* Main Content */
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

        /* Categories Section */
        .categories-container {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .categories-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .categories-title {
            font-size: 24px;
            font-weight: 700;
            color: #000;
        }

        .btn-create-category {
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

        .btn-create-category:hover {
            background: #6d28d9;
        }

        /* Category List */
        .category-list-header {
            padding: 16px 20px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
            font-weight: 600;
            color: #666;
        }

        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
            transition: background 0.3s;
        }

        .category-item:hover {
            background: #f9f9f9;
        }

        .category-item:last-child {
            border-bottom: none;
        }

        .category-name {
            font-size: 16px;
            color: #000;
            font-weight: 500;
        }

        .category-actions {
            position: relative;
        }

        .btn-more {
            background: none;
            border: none;
            font-size: 20px;
            color: #666;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 4px;
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

        /* Modal Overlay */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        /* Modal Content */
        .modal-content {
            background: white;
            border-radius: 16px;
            padding: 50px 60px;
            width: 90%;
            max-width: 520px;
            transform: scale(0.9);
            transition: transform 0.3s;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .modal-overlay.active .modal-content {
            transform: scale(1);
        }

        .modal-title {
            font-size: 36px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 35px;
            color: #000;
        }

        /* Modal Form Group */
        .modal-form-group {
            margin-bottom: 35px;
        }

        .modal-form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #000;
        }

        .modal-form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: white;
            font-size: 14px;
            color: #333;
            outline: none;
            transition: border-color 0.3s;
        }

        .modal-form-group input::placeholder {
            color: #999;
        }

        .modal-form-group input:focus {
            border-color: #7c3aed;
        }

        /* Modal Actions */
        .modal-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 35px;
        }

        .btn-modal-cancel,
        .btn-modal-create {
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid #7c3aed;
        }

        .btn-modal-cancel {
            background: white;
            color: #7c3aed;
        }

        .btn-modal-cancel:hover {
            background: #f0e7ff;
        }

        .btn-modal-create {
            background: #7c3aed;
            color: white;
            border: 2px solid #7c3aed;
        }

        .btn-modal-create:hover {
            background: #6d28d9;
            border-color: #6d28d9;
        }

        .error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
            display: block;
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
                <a href="{{ route('home') }}" class="active">Categories</a>
                <a href="{{ route('events.index') }}">Events</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-create-category" style="width: auto;">Logout</button>
                </form>
            </nav>
            <div class="user-profile">
                <div class="user-avatar">
                    {{ substr(Auth::user()->mb_name, 0, 1) }}
                    <span class="online-indicator"></span>
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
        <h1 class="page-title">List of categories</h1>

        <div class="categories-container">
            <div class="categories-header">
                <h2 class="categories-title">Categories</h2>
                <button class="btn-create-category" onclick="openCreateCategoryModal()">Create category</button>
            </div>

            <div class="category-list-header">
                Category
            </div>

            @forelse($categories ?? [] as $category)
            <div class="category-item">
                <span class="category-name">{{ $category->mb_cat_name ?? 'Lorem Ipsum' }}</span>
                <div class="category-actions">
                    <button class="btn-more" onclick="toggleMenu(event, {{ $loop->index }})">⋮</button>
                    <div class="actions-menu" id="menu-{{ $loop->index }}">
                        <a href="{{ route('categories.edit', $category->mb_cat_id ?? 1) }}">Edit</a>
                        <form action="{{ route('categories.destroy', $category->mb_cat_id ?? 1) }}" method="POST" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <!-- Default 7 Lorem Ipsum items if no categories -->
            @for($i = 0; $i < 7; $i++)
            <div class="category-item">
                <span class="category-name">Lorem Ipsum</span>
                <div class="category-actions">
                    <button class="btn-more" onclick="toggleMenu(event, {{ $i }})">⋮</button>
                    <div class="actions-menu" id="menu-{{ $i }}">
                        <a href="#">Edit</a>
                        <button class="delete">Delete</button>
                    </div>
                </div>
            </div>
            @endfor
            @endforelse
        </div>
    </div>

    <!-- Create Category Modal -->
    <div class="modal-overlay" id="createCategoryModal">
        <div class="modal-content">
            <h2 class="modal-title">Create category</h2>
            
            <form action="{{ route('admin.categories.store') }}" method="POST" id="createCategoryForm" novalidate>
                @csrf
                
                <x-form.input 
                    label="Category name"
                    name="mb_cat_name"
                    placeholder="Enter category name"
                />

                <div class="modal-actions">
                    <button type="button" class="btn-modal-cancel" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn-modal-create">Create</button>
                </div>
            </form>
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
            if (!e.target.closest('.category-actions')) {
                document.querySelectorAll('.actions-menu').forEach(menu => {
                    menu.classList.remove('active');
                });
            }
        });

        // Open modal
        function openCreateCategoryModal() {
            const modal = document.getElementById('createCategoryModal');
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Disable HTML5 validation after modal opens
            disableHTML5Validation();
        }

        // Close modal
        function closeModal() {
            const modal = document.getElementById('createCategoryModal');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
            document.getElementById('createCategoryForm').reset();
        }

        // Disable HTML5 form validation
        function disableHTML5Validation() {
            const form = document.getElementById('createCategoryForm');
            if (!form) return;
            
            // Remove required attribute from all inputs
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.removeAttribute('required');
                input.removeAttribute('aria-required');
            });
            
            // Watch for any required attribute being added
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'required') {
                        mutation.target.removeAttribute('required');
                    }
                });
            });
            
            // Observe all inputs for attribute changes
            inputs.forEach(input => {
                observer.observe(input, { attributes: true });
            });
            
            // Prevent invalid event
            form.addEventListener('invalid', function(e) {
                e.preventDefault();
                return false;
            }, true);
            
            inputs.forEach(input => {
                input.addEventListener('invalid', function(e) {
                    e.preventDefault();
                    return false;
                }, true);
            });
        }

        // Initialize on page load
        window.addEventListener('load', function() {
            disableHTML5Validation();
        });

        // Handle form submission without HTML5 validation
        function submitCategoryForm() {
            const form = document.getElementById('createCategoryForm');
            form.submit();
        }

        // Close modal when clicking outside
        document.getElementById('createCategoryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>
