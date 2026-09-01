<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - Event Planner</title>
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

        .form-section {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
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

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            background: #fff;
            font-size: 14px;
            color: #333;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #7c3aed;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-submit {
            flex: 1;
            padding: 14px;
            background: #7c3aed;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background: #6d28d9;
        }

        .btn-cancel {
            flex: 1;
            padding: 14px;
            background: white;
            color: #7c3aed;
            border: 2px solid #7c3aed;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-cancel:hover {
            background: #f0e7ff;
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
    <header>
        <div class="logo">
            <h1>Event <span>Planner</span></h1>
        </div>
        <div class="nav-section">
            <nav class="nav-links">
                <a href="{{ route('events.index') }}">Home</a>
                <a href="{{ route('admin.categories.index') }}">Categories</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-submit" style="width: auto; padding: 10px 30px;">Logout</button>
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
        <h1 class="page-title">Edit Category</h1>

        <div class="form-section">
            <form action="{{ route('admin.categories.update', $category->mb_cat_id) }}" method="POST" novalidate onsubmit="return true">
                @csrf
                @method('PUT')

                <x-form.input 
                    label="Category Name"
                    name="mb_cat_name"
                    placeholder="Enter category name"
                    :value="$category->mb_cat_name"
                />

                <div class="form-actions">
                    <a href="{{ route('admin.categories.index') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">Update Category</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Disable HTML5 form validation on page load
        window.addEventListener('load', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                // Remove required attribute from all inputs
                const inputs = form.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.removeAttribute('required');
                    input.removeAttribute('aria-required');
                    
                    // Prevent invalid event
                    input.addEventListener('invalid', function(e) {
                        e.preventDefault();
                        return false;
                    }, true);
                    
                    // Also prevent on blur
                    input.addEventListener('blur', function(e) {
                        if (this.hasAttribute('required')) {
                            this.removeAttribute('required');
                        }
                    }, true);
                });
                
                // Prevent the form's invalid event
                form.addEventListener('invalid', function(e) {
                    e.preventDefault();
                    return false;
                }, true);
            });
        });
    </script>
</body>
</html>
