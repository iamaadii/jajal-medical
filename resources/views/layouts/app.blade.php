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

        /* Enhanced Colored Select Dropdowns */
        select.input-control {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #f8fafc !important;
            border-color: #cbd5e1;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%230284c7' stroke-width='2.5'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 0.85rem center !important;
            background-size: 16px 16px !important;
            padding-right: 2.4rem !important;
            font-weight: 600;
            cursor: pointer;
            color: #1e293b;
        }

        select.input-control:hover {
            border-color: var(--primary);
            background-color: #ffffff !important;
            box-shadow: 0 2px 4px rgba(2, 132, 199, 0.08);
        }

        select.input-control:focus {
            border-color: var(--primary);
            background-color: #ffffff !important;
            box-shadow: 0 0 0 4px var(--primary-glow);
        }

        /* Color styling for options */
        select.input-control option {
            font-weight: 600;
            padding: 0.5rem 0.75rem;
            background: #ffffff;
            color: #1e293b;
        }

        select.input-control option[value="High"] {
            color: #dc2626;
            background: #fef2f2;
        }

        select.input-control option[value="Medium"] {
            color: #d97706;
            background: #fffbeb;
        }

        select.input-control option[value="Low"] {
            color: #16a34a;
            background: #f0fdf4;
        }

        select.input-control option[value="Approved"] {
            color: #047857;
            background: #ecfdf5;
        }

        select.input-control option[value="Planning"] {
            color: #1d4ed8;
            background: #eff6ff;
        }

        select.input-control option[value="In Review"] {
            color: #b45309;
            background: #fefce8;
        }

        select.input-control option[value="Completed"] {
            color: #0f766e;
            background: #f0fdfa;
        }

        select.input-control option[value="Cancelled"] {
            color: #64748b;
            background: #f8fafc;
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
            gap: 0.5rem;
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
            min-width: 40px;
            height: 40px;
            padding: 0 0.85rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 10px;
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
            box-shadow: 0 2px 6px rgba(2, 132, 199, 0.35);
        }

        .pagination li.disabled .page-link,
        .pagination li.disabled span {
            background: #f8fafc;
            border-color: #e2e8f0;
            color: #94a3b8;
            cursor: not-allowed;
        }

        /* Dedicated bootstrap pagination wrapper rules */
        nav.d-flex, nav[role="navigation"] {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            gap: 1.25rem !important;
            width: 100% !important;
            margin: 1.5rem 0 1rem !important;
        }

        /* Hide the mobile redundant previous/next stacked bar */
        nav .d-sm-none, nav > div:first-child.flex.gap-2 {
            display: none !important;
        }

        /* Show clean full pagination on all devices */
        nav .d-none.flex-sm-fill, nav > div:last-child {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            gap: 1rem !important;
            width: 100% !important;
        }

        @media (min-width: 640px) {
            nav.d-flex, nav[role="navigation"] {
                flex-direction: row !important;
                justify-content: space-between !important;
            }
            nav .d-none.flex-sm-fill, nav > div:last-child {
                flex-direction: row !important;
                justify-content: space-between !important;
            }
        }

        .small.text-muted {
            font-size: 0.875rem !important;
            color: #64748b !important;
            text-align: center !important;
            margin: 0.35rem 0 !important;
        }

        .small.text-muted .fw-semibold {
            color: #1e293b !important;
            font-weight: 700 !important;
        }

        nav[role="navigation"] {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.25rem;
            width: 100%;
            margin: 1.5rem 0;
        }

        /* Hide duplicate raw Previous/Next block in mobile Tailwind view */
        nav[role="navigation"] > div:first-child.flex.gap-2.items-center.justify-between {
            display: none !important;
        }

        /* Ensure full navigation bar is visible and nicely styled */
        nav[role="navigation"] > div:last-child {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            gap: 1rem !important;
            width: 100% !important;
        }

        @media (min-width: 640px) {
            nav[role="navigation"] > div:last-child {
                flex-direction: row !important;
                justify-content: space-between !important;
            }
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

        nav[role="navigation"] p {
            margin: 0 !important;
            font-size: 0.875rem !important;
            color: #64748b !important;
            text-align: center !important;
        }

        nav[role="navigation"] p span {
            font-weight: 700 !important;
            color: #1e293b !important;
        }

        nav[role="navigation"] span.inline-flex.shadow-sm {
            display: inline-flex !important;
            gap: 0.35rem !important;
            box-shadow: none !important;
            flex-wrap: wrap !important;
            justify-content: center !important;
        }

        nav[role="navigation"] span.inline-flex.shadow-sm > span,
        nav[role="navigation"] span.inline-flex.shadow-sm > a {
            border-radius: 8px !important;
            border: 1px solid var(--border-color) !important;
            min-width: 38px !important;
            height: 38px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0 0.75rem !important;
            font-size: 0.875rem !important;
            font-weight: 600 !important;
            color: #334155 !important;
            background: #ffffff !important;
            text-decoration: none !important;
            transition: var(--transition) !important;
            margin: 0 1px !important;
        }

        nav[role="navigation"] span.inline-flex.shadow-sm > span[aria-current="page"] > span,
        nav[role="navigation"] span.inline-flex.shadow-sm > span[aria-current="page"] {
            background: var(--primary) !important;
            color: #ffffff !important;
            border-color: var(--primary) !important;
            box-shadow: 0 2px 6px rgba(2, 132, 199, 0.3) !important;
        }

        nav[role="navigation"] span.inline-flex.shadow-sm > a:hover {
            background: var(--primary-light) !important;
            color: var(--primary) !important;
            border-color: var(--primary) !important;
            transform: translateY(-1px) !important;
        }

        .pagination-summary {
            font-size: 0.85rem;
            color: #64748b;
            text-align: center;
            margin-bottom: 0.75rem;
            font-weight: 500;
        }

        .mobile-menu-toggle {
            display: none;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0.45rem 0.65rem;
            font-size: 1.25rem;
            color: #334155;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            line-height: 1;
            transition: var(--transition);
        }

        .mobile-menu-toggle:hover {
            background: #f8fafc;
            color: var(--primary);
        }

        @media (max-width: 900px) {
            .navbar {
                padding: 0.85rem 1.25rem;
                flex-wrap: wrap;
            }
            .mobile-menu-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }
            .nav-links {
                display: none;
                width: 100%;
                flex-direction: column;
                align-items: stretch;
                gap: 0.5rem;
                margin-top: 0.85rem;
                padding-top: 0.85rem;
                border-top: 1px solid var(--border-color);
            }
            .nav-links.is-open {
                display: flex;
                animation: fadeInDown 0.25s ease-out;
            }
            .nav-links .nav-link {
                padding: 0.75rem 1rem;
                border-radius: 10px;
                background: #f8fafc;
                text-align: center;
            }
            .nav-links .nav-link.active {
                background: var(--primary-light);
            }
            .user-badge {
                justify-content: center;
                padding: 0.65rem 1rem;
                background: #f1f5f9;
                border-radius: 10px;
            }
            .logout-btn {
                width: 100%;
                padding: 0.7rem 1rem;
                font-size: 0.875rem;
                border-radius: 10px;
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
    </style>
</head>
<body>
    <header class="navbar">
        <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; max-width: 1400px; margin: 0 auto;">
            <a href="{{ route('dashboard') }}" class="brand-logo">
                <span class="brand-icon">+</span>
                <span>Jajal Medical</span>
            </a>
            @auth
                <button type="button" class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle Navigation">
                    <span id="menuIcon">☰</span>
                </button>
            @endauth
        </div>

        @auth
            <div style="width: 100%; max-width: 1400px; margin: 0 auto;">
                <nav class="nav-links" id="primaryNav">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('cases.index') }}" class="nav-link {{ request()->routeIs('cases.*') ? 'active' : '' }}">Case Directory</a>
                    <div class="user-badge">
                        <span>{{ Auth::user()->name }}</span>
                        <span class="role-pill {{ strtolower(Auth::user()->role) }}">{{ Auth::user()->role }}</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;" onsubmit="return confirm('Are you sure you want to log out of your session?');">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-sm logout-btn" title="Sign out of account">
                            <span>Log out</span>
                        </button>
                    </form>
                </nav>
            </div>
        @endauth
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Disable browser auto-scrolling restoration on refresh
            if ('scrollRestoration' in history) {
                history.scrollRestoration = 'manual';
            }

            const toggle = document.getElementById('mobileMenuToggle');
            const nav = document.getElementById('primaryNav');
            const menuIcon = document.getElementById('menuIcon');
            if (toggle && nav) {
                toggle.addEventListener('click', function () {
                    const isOpen = nav.classList.toggle('is-open');
                    menuIcon.textContent = isOpen ? '✕' : '☰';
                });
            }
        });
    </script>

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

    <!-- Global Center Delete Confirmation Modal -->
    <div id="deleteModalBackdrop" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(4px); z-index: 9999; align-items: center; justify-content: center; padding: 1rem; animation: fadeInDown 0.2s ease;">
        <div style="background: #ffffff; border-radius: 18px; max-width: 440px; width: 100%; box-shadow: var(--shadow-lg); border: 1px solid #e2e8f0; overflow: hidden; animation: scaleIn 0.25s cubic-bezier(0.16, 1, 0.3, 1);">
            <div style="padding: 1.75rem 1.5rem 1.25rem; text-align: center;">
                <div style="width: 56px; height: 56px; background: #fee2e2; color: #dc2626; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 1.6rem; margin-bottom: 1rem; border: 4px solid #fef2f2;">
                    🗑️
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 0.4rem;">Are you sure?</h3>
                <p id="deleteModalMessage" style="color: #64748b; font-size: 0.9rem; line-height: 1.5; margin: 0;">
                    Are you sure you want to delete this case? This action cannot be undone.
                </p>
            </div>
            <div style="background: #f8fafc; padding: 1rem 1.5rem; display: flex; gap: 0.75rem; border-top: 1px solid #e2e8f0;">
                <button type="button" onclick="closeDeleteModal()" class="btn btn-secondary" style="flex: 1; padding: 0.7rem;">
                    Cancel
                </button>
                <form id="deleteModalForm" method="POST" action="" style="flex: 1; margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="width: 100%; padding: 0.7rem; background: #dc2626; border-color: #b91c1c;">
                        Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(actionUrl, caseNumber) {
            const backdrop = document.getElementById('deleteModalBackdrop');
            const form = document.getElementById('deleteModalForm');
            const msg = document.getElementById('deleteModalMessage');
            if (form && backdrop && msg) {
                form.action = actionUrl;
                msg.innerHTML = `Are you sure you want to delete case <strong>${caseNumber}</strong>?<br><span style="font-size: 0.8rem; color: #ef4444;">This record will be permanently removed.</span>`;
                backdrop.style.display = 'flex';
            }
        }

        function closeDeleteModal() {
            const backdrop = document.getElementById('deleteModalBackdrop');
            if (backdrop) {
                backdrop.style.display = 'none';
            }
        }

        // Close on escape key or clicking backdrop
        window.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeDeleteModal();
        });
        document.getElementById('deleteModalBackdrop')?.addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });
    </script>
</body>
</html>
