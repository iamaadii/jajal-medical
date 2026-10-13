<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Medical Case Management') - Jajal Medical</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0284c7;
            --primary-hover: #0369a1;
            --primary-light: #f0f9ff;
            --primary-glow: rgba(2, 132, 199, 0.15);
            --secondary: #0f172a;
            --bg-page: #f8fafc;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
            --border-hover: #cbd5e1;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --danger: #ef4444;
            --danger-hover: #dc2626;
            --danger-light: #fef2f2;
            --success: #10b981;
            --success-light: #ecfdf5;
            --warning: #f59e0b;
            --warning-light: #fffbeb;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -4px rgba(0, 0, 0, 0.04);
            --shadow-hover: 0 12px 24px -4px rgba(2, 132, 199, 0.12), 0 4px 8px -2px rgba(0, 0, 0, 0.04);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-pill: 9999px;
            --transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        body {
            background: linear-gradient(180deg, #f0f6fc 0%, #f8fafc 180px, #f8fafc 100%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.96); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(2, 132, 199, 0.4); }
            50% { box-shadow: 0 0 0 6px rgba(2, 132, 199, 0); }
        }

        .navbar {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            padding: 0.85rem 1.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            animation: fadeInDown 0.4s ease-out;
            transition: var(--transition);
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--secondary);
            font-weight: 800;
            font-size: 1.2rem;
            letter-spacing: -0.025em;
            transition: var(--transition);
        }

        .brand-logo:hover {
            transform: translateY(-1px);
        }

        .brand-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.3rem;
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.3);
            transition: var(--transition);
        }

        .brand-logo:hover .brand-icon {
            transform: rotate(6deg) scale(1.05);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.5rem 0.95rem;
            border-radius: var(--radius-sm);
            transition: var(--transition);
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary);
            background: var(--primary-light);
            transform: translateY(-1px);
        }

        .nav-link.active {
            color: var(--primary);
            background: var(--primary-light);
            font-weight: 700;
        }

        .user-badge {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.4rem 0.9rem;
            background: #f1f5f9;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-pill);
            font-size: 0.85rem;
            font-weight: 600;
            color: #334155;
            transition: var(--transition);
        }

        .role-pill {
            padding: 0.2rem 0.6rem;
            border-radius: var(--radius-pill);
            font-size: 0.725rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .role-pill.admin {
            background: #dbeafe;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }

        .role-pill.viewer {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        .main-container {
            max-width: 1400px;
            width: 100%;
            margin: 2rem auto;
            padding: 0 1.75rem;
            flex: 1;
            animation: fadeInUp 0.45s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .alert-toast {
            padding: 0.95rem 1.35rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.75rem;
            font-size: 0.925rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: var(--shadow-sm);
            animation: fadeInDown 0.35s ease;
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

        .card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-md);
            padding: 1.75rem;
            transition: var(--transition);
        }

        .card:hover {
            border-color: var(--border-hover);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            padding: 0.65rem 1.25rem;
            border-radius: var(--radius-sm);
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: var(--transition);
            outline: none;
        }

        .btn:hover {
            transform: translateY(-1.5px);
            box-shadow: var(--shadow-md);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-primary {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: white;
            box-shadow: 0 2px 4px rgba(2, 132, 199, 0.25);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0369a1 0%, #075985 100%);
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.35);
        }

        .btn-secondary {
            background: #ffffff;
            border-color: var(--border-color);
            color: #334155;
            box-shadow: var(--shadow-sm);
        }

        .btn-secondary:hover {
            background: #f8fafc;
            border-color: var(--border-hover);
            color: var(--text-main);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 2px 4px rgba(239, 68, 68, 0.25);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.35);
        }

        .btn-sm {
            padding: 0.42rem 0.85rem;
            font-size: 0.825rem;
            border-radius: 6px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.35rem 0.75rem;
            border-radius: var(--radius-pill);
            font-size: 0.775rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            transition: var(--transition);
        }

        .badge-Draft { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
        .badge-Planning { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
        .badge-In-Review { background: #fefce8; color: #a16207; border: 1px solid #fef08a; }
        .badge-Approved { background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; }
        .badge-Completed { background: #f0fdfa; color: #0f766e; border: 1px solid #99f6e4; }
        .badge-Cancelled { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

        .priority-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-weight: 700;
            font-size: 0.875rem;
        }

        .priority-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .priority-High { color: #dc2626; }
        .priority-High .priority-dot { background: #ef4444; box-shadow: 0 0 6px rgba(239, 68, 68, 0.6); }

        .priority-Medium { color: #d97706; }
        .priority-Medium .priority-dot { background: #f59e0b; }

        .priority-Low { color: #16a34a; }
        .priority-Low .priority-dot { background: #22c55e; }

        .input-control {
            width: 100%;
            padding: 0.7rem 0.95rem;
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-size: 0.925rem;
            color: var(--text-main);
            background: #ffffff;
            transition: var(--transition);
            outline: none;
        }

        .input-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-glow);
        }

        .input-error {
            border-color: var(--danger) !important;
        }

        .input-error:focus {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15) !important;
        }

        .table-container {
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            background: #ffffff;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.9rem;
        }

        .data-table thead th {
            background: #f8fafc;
            padding: 0.95rem 1.25rem;
            font-size: 0.775rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            border-bottom: 1px solid var(--border-color);
            white-space: nowrap;
        }

        .data-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: var(--transition);
        }

        .data-table tbody tr:hover {
            background-color: #f8fafc;
            transform: scale([1.002]);
        }

        .data-table td {
            padding: 1rem 1.25rem;
            color: #334155;
            vertical-align: middle;
        }

        .code-pill {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            font-weight: 600;
            background: #f1f5f9;
            padding: 0.2rem 0.5rem;
            border-radius: 6px;
            color: #1e293b;
        }

        .pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            list-style: none;
            padding: 0;
            margin: 0;
            flex-wrap: wrap;
        }

        .pagination li .page-link,
        .pagination li a,
        .pagination li span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 0.75rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            text-decoration: none;
            transition: var(--transition);
        }

        .pagination li a:hover {
            background: var(--primary-light);
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-1px);
        }

        .pagination li.active .page-link,
        .pagination li.active span {
            background: var(--primary);
            border-color: var(--primary);
            color: #ffffff;
            box-shadow: 0 2px 4px rgba(2, 132, 199, 0.3);
        }

        .pagination li.disabled .page-link,
        .pagination li.disabled span {
            background: #f8fafc;
            border-color: #e2e8f0;
            color: #94a3b8;
            cursor: not-allowed;
        }

        nav[role="navigation"] svg {
            width: 18px !important;
            height: 18px !important;
            max-width: 18px !important;
            max-height: 18px !important;
        }

        nav[role="navigation"] .flex.justify-between {
            display: none !important;
        }

        @media (max-width: 900px) {
            .navbar {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }
            .nav-links {
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 0.6rem;
            }
            .main-container {
                padding: 0 1rem;
                margin: 1.25rem auto;
            }
            .table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
        }

        @media (max-width: 600px) {
            .nav-links {
                flex-direction: column;
                align-items: stretch;
            }
            .user-badge {
                justify-content: center;
            }
            .btn {
                width: 100%;
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
                <a href="{{ route('cases.index') }}" class="nav-link {{ request()->routeIs('cases.*') ? 'active' : '' }}">Case Directory</a>
                <div class="user-badge">
                    <span>{{ Auth::user()->name }}</span>
                    <span class="role-pill {{ strtolower(Auth::user()->role) }}">{{ Auth::user()->role }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-sm">Log out</button>
                </form>
            </nav>
        @endauth
    </header>

    <main class="main-container">
        @if (session('success'))
            <div class="alert-toast alert-success">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-toast alert-danger">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <span>Please correct the errors in the form below.</span>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
