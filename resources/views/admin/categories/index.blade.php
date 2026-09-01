<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - Event Planner</title>
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
            text-align: center;
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            align-items: center;
        }

        .category-actions a,
        .category-actions button {
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

        .category-actions a {
            background: #2563eb;
            color: white;
        }

        .category-actions a:hover {
            background: #1d4ed8;
            transform: scale(1.05);
        }

        .category-actions button {
            background: #dc2626;
            color: white;
        }

        .category-actions button:hover {
            background: #b91c1c;
            transform: scale(1.05);
        }

        .category-actions form {
            display: inline;
            margin: 0;
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

        /* Modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.35);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.25s ease, visibility 0.25s ease;
            padding: 20px;
            z-index: 1000;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            width: 100%;
            max-width: 480px;
            background: #fff;
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 20px 70px rgba(0, 0, 0, 0.18);
        }

        .modal-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #111827;
        }

        .modal-form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
        }

        .modal-form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        .modal-form-group input {
            padding: 12px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .modal-form-group input:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.15);
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn-modal-cancel,
        .btn-modal-create {
            padding: 12px 18px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.2s ease;
        }

        .btn-modal-cancel {
            background: #e5e7eb;
            color: #111827;
        }

        .btn-modal-cancel:hover {
            background: #d1d5db;
            transform: translateY(-1px);
        }

        .btn-modal-create {
            background: #7c3aed;
            color: #fff;
            box-shadow: 0 10px 30px rgba(124, 58, 237, 0.3);
        }

        .btn-modal-create:hover {
            background: #6d28d9;
            transform: translateY(-1px);
        }

        .error {
            color: #dc2626;
            font-size: 13px;
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
                <a href="{{ route('admin.categories.index') }}" class="active">Categories</a>
                <a href="{{ route('admin.events.index') }}">Events</a>
                <a href="{{ route('admin.registrations.index') }}">Registrations</a>
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
                <button onclick="openCreateCategoryModal()" class="btn-create-category">Create category</button>
            </div>

            <div class="category-list-header">
                Category
            </div>

            @forelse($categories ?? [] as $category)
            <div class="category-item">
                <span class="category-name">{{ $category->mb_cat_name ?? 'Lorem Ipsum' }}</span>
                <div class="category-actions">
                    <a href="{{ route('admin.categories.edit', $category->mb_cat_id ?? 1) }}" title="Edit">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category->mb_cat_id ?? 1) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
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
                </div>
            </div>
            @empty
            <!-- Default 7 Lorem Ipsum items if no categories -->
            @for($i = 0; $i < 7; $i++)
            <div class="category-item">
                <span class="category-name">Lorem Ipsum</span>
                <div class="category-actions">
                    <a href="#" title="Edit">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </a>
                    <button type="button" title="Delete">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                        </svg>
                    </button>
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
            
            <form action="{{ route('admin.categories.store') }}" method="POST" id="createCategoryForm">
                @csrf
                
                <div class="modal-form-group">
                    <label for="mb_cat_name">Category name</label>
                    <input 
                        type="text" 
                        id="mb_cat_name" 
                        name="mb_cat_name" 
                        placeholder="Enter category name"
                        required
                    >
                    @error('mb_cat_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

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

        // Prevent menu from closing when clicking inside
        document.querySelectorAll('.actions-menu').forEach(menu => {
            menu.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });

        // Open modal
        function openCreateCategoryModal() {
            const modal = document.getElementById('createCategoryModal');
            if (modal) {
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        // Close modal
        function closeModal() {
            const modal = document.getElementById('createCategoryModal');
            if (modal) {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto';
                const form = document.getElementById('createCategoryForm');
                if (form) form.reset();
            }
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('createCategoryModal');
            if (modal && e.target === modal) {
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
