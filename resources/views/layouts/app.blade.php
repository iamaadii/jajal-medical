<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Medical Case Management') - Jajal Medical</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --primary-light: #e0f2fe;
            --secondary: #0f172a;
            --bg-page: #f8fafc;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --danger: #ef4444;
            --danger-light: #fee2e2;
            --success: #10b981;
            --success-light: #d1fae5;
            --warning: #f59e0b;
            --warning-light: #fef3c7;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--bg-page);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 0.85rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
            color: var(--secondary);
            font-weight: 800;
            font-size: 1.15rem;
            letter-spacing: -0.02em;
        }

        .brand-icon {
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, #0284c7, #2563eb);
            color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.1rem;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.45rem 0.8rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary);
            background: var(--primary-light);
        }

        .user-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 0.75rem;
            background: #f1f5f9;
            border-radius: 999px;
            font-size: 0.825rem;
            font-weight: 600;
        }

        .role-pill {
            padding: 0.15rem 0.5rem;
            border-radius: 999px;
            font-size: 0.725rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .role-pill.admin {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .role-pill.viewer {
            background: #f3f4f6;
            color: #4b5563;
        }

        .main-container {
            max-width: 1200px;
            width: 100%;
            margin: 2rem auto;
            padding: 0 1.25rem;
            flex: 1;
        }

        .alert-toast {
            padding: 0.85rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .alert-success {
            background: var(--success-light);
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-danger {
            background: var(--danger-light);
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.55rem 1.1rem;
            border-radius: 7px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.15s ease-in-out;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-secondary {
            background: #ffffff;
            border-color: var(--border-color);
            color: var(--text-main);
        }

        .btn-secondary:hover {
            background: #f8fafc;
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-sm {
            padding: 0.35rem 0.7rem;
            font-size: 0.775rem;
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.65rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .badge-Draft { background: #f1f5f9; color: #475569; }
        .badge-Planning { background: #e0e7ff; color: #3730a3; }
        .badge-In-Review { background: #fef3c7; color: #92400e; }
        .badge-Approved { background: #dcfce7; color: #166534; }
        .badge-Completed { background: #ccfbf1; color: #115e59; }
        .badge-Cancelled { background: #fee2e2; color: #991b1b; }

        .priority-High { color: #dc2626; font-weight: 700; }
        .priority-Medium { color: #d97706; font-weight: 700; }
        .priority-Low { color: #16a34a; font-weight: 700; }

        .card {
            background: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 0.75rem;
                align-items: flex-start;
            }
            .nav-links {
                width: 100%;
                flex-wrap: wrap;
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <a href="{{ route('dashboard') }}" class="brand-logo">
            <span class="brand-icon">+</span>
            <span>Jajal Medical</span>
        </a>
        @auth
            <nav class="nav-links">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('cases.index') }}" class="nav-link {{ request()->routeIs('cases.*') ? 'active' : '' }}">Cases</a>
                <div class="user-badge">
                    <span>{{ Auth::user()->name }}</span>
                    <span class="role-pill {{ strtolower(Auth::user()->role) }}">{{ Auth::user()->role }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-sm">Logout</button>
                </form>
            </nav>
        @endauth
    </header>

    <main class="main-container">
        @if (session('success'))
            <div class="alert-toast alert-success">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-toast alert-danger">
                <span>Please correct the errors in the form below.</span>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
