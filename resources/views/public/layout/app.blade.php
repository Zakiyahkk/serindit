<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Serindit — Perpustakaan Digital Balai Bahasa Provinsi Riau')</title>
    <meta name="description" content="@yield('description', 'Serindit adalah platform literasi digital dari Balai Bahasa Provinsi Riau. Ribuan buku berkualitas untuk semua kalangan, gratis dan mudah diakses.')">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['"Inter"', 'sans-serif'],
                        'serif': ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        brand: {
                            blue:   '#1e7b1c', // Changed to green scheme
                            sky:    '#66ea80', // Changed to green scheme
                            green:  '#27AE60',
                            yellow: '#F5A623',
                            yellow2: '#ffd500ff',
                            orange: '#E8621E',
                            purple: '#7C3AED',
                            pink:   '#E91E8C',
                            navy: '#0b3d0a', // Changed to dark green
                            darkblue: '#115410', // Changed to dark green
                            gray: '#94A3B8',
                            white: '#ffffff',
                        }
                    },
                    animation: {
                        'float':  'float 4s ease-in-out infinite',
                        'wiggle': 'wiggle 1s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%':      { transform: 'translateY(-12px)' },
                        },
                        wiggle: {
                            '0%, 100%': { transform: 'rotate(-3deg)' },
                            '50%':      { transform: 'rotate(3deg)' },
                        },
                        'slide-in': {
                            '0%': { transform: 'translateX(100%)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>

    {{-- Google Fonts: Inter + Playfair Display & Bootstrap Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    {{-- AOS Animation --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        * { font-family: 'Inter', sans-serif; }
        .font-serif, h1.display, .heading-serif { font-family: 'Playfair Display', serif; }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f0fdf4; }
        ::-webkit-scrollbar-thumb { background: #1e7b1c; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #0b3d0a; }

        /* ── Hero Background ── */
        .hero-bg {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 50%, #bbf7d0 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-bg::before {
            content: '';
            position: absolute;
            top: -120px; right: -120px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(30,123,28,0.06) 0%, transparent 65%);
            border-radius: 50%;
            pointer-events: none;
        }
        .hero-bg::after {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(30,123,28,0.08) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0.4;
            pointer-events: none;
        }

        /* ── Wave Divider ── */
        .wave-divider { overflow: hidden; line-height: 0; }
        .wave-divider svg { display: block; width: 100%; }

        /* ── Navbar Glow ── */
        .navbar-glow {
            box-shadow: 0 1px 0 rgba(255,255,255,0.05), 0 8px 32px rgba(11,61,10,0.3);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* ── Book Card ── */
        .book-card { transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
        .book-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(30,123,28,0.12); }

        /* ── Star ── */
        .star { color: #F5A623; }

        /* ── Badge Pulse ── */
        @keyframes pulseBadge {
            0%, 100% { box-shadow: 0 0 0 0 rgba(245,166,35,0.5); }
            50%       { box-shadow: 0 0 0 10px rgba(245,166,35,0); }
        }
        .badge-pulse { animation: pulseBadge 2.5s infinite; }

        /* ── Section Alt ── */
        .section-alt { background: linear-gradient(to bottom, #F0F7FF, #EEF6FF); }

        /* ── Category Pill ── */
        .cat-pill { transition: all 0.25s ease; }
        .cat-pill:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.10); }

        /* ── Toast Notification ── */
        .toast-animate {
            animation: slide-in 0.5s cubic-bezier(0.18, 0.89, 0.32, 1.28) forwards;
        }

        /* ── PRELOADER — Elegant ── */
        #preloader {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: linear-gradient(135deg, #0b3d0a 0%, #1e7b1c 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 99999;
            transition: opacity 0.5s ease, visibility 0.5s;
        }

        .preloader-logo-ring {
            width: 80px; height: 80px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.15);
            border-top-color: #F5A623;
            animation: spin-ring 1.2s linear infinite;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .preloader-logo-ring-inner {
            width: 60px; height: 60px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.1);
            border-bottom-color: rgba(255,255,255,0.6);
            animation: spin-ring 1.8s linear infinite reverse;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .preloader-icon {
            color: #ffffff;
            font-size: 22px;
            opacity: 0.9;
        }

        @keyframes spin-ring {
            to { transform: rotate(360deg); }
        }

        .preloader-brand {
            margin-top: 28px;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #ffffff;
            font-size: 22px;
            letter-spacing: 0.06em;
            opacity: 0.95;
        }
        .preloader-sub {
            margin-top: 8px;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            color: rgba(255,255,255,0.5);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.25em;
        }
        .preloader-dots {
            display: flex; gap: 6px; margin-top: 20px;
        }
        .preloader-dots span {
            width: 5px; height: 5px;
            background: rgba(255,255,255,0.4);
            border-radius: 50%;
            animation: dot-pulse 1.4s ease-in-out infinite;
        }
        .preloader-dots span:nth-child(2) { animation-delay: 0.2s; }
        .preloader-dots span:nth-child(3) { animation-delay: 0.4s; }
        @keyframes dot-pulse {
            0%, 80%, 100% { transform: scale(0.8); opacity: 0.4; }
            40% { transform: scale(1.2); opacity: 1; }
        }
        .preloader-hidden { opacity: 0; visibility: hidden; }

        /* ── Section Heading Style ── */
        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            padding: 6px 16px;
            border-radius: 999px;
            margin-bottom: 14px;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #0b3d0a;
            line-height: 1.25;
        }
        .section-divider {
            width: 48px; height: 3px;
            background: linear-gradient(90deg, #1e7b1c, #F5A623);
            border-radius: 2px;
            margin: 14px auto 0;
        }
    </style>

    @yield('styles')
</head>
<body class="bg-white text-gray-800">
    {{-- ══ PRELOADER — Elegant ══ --}}
    <div id="preloader">
        <div class="preloader-logo-ring">
            <div class="preloader-logo-ring-inner">
                <i class="bi bi-book preloader-icon"></i>
            </div>
        </div>
        <div class="preloader-brand">Serindit</div>
        <div class="preloader-sub">Balai Bahasa Provinsi Riau</div>
        <div class="preloader-dots">
            <span></span><span></span><span></span>
        </div>
    </div>

    @include('public.layout.header')

    @yield('content')

    {{-- Global Toast --}}
    @if(session('success_like'))
    <div id="toast-notif" class="fixed bottom-6 right-6 z-[9999] toast-animate">
        <div class="bg-brand-navy border-l-4 border-brand-yellow text-white p-4 rounded-2xl shadow-2xl flex items-center gap-4 min-w-[300px]">
            <div class="bg-brand-yellow/20 p-2.5 rounded-xl">
                <i class="bi bi-heart-fill text-brand-yellow text-xl"></i>
            </div>
            <div>
                <h4 class="font-black text-sm tracking-tight">Sangat Suka!</h4>
                <p class="text-xs font-bold text-gray-400">{{ session('success_like') }}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-gray-500 hover:text-white transition">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast-notif');
            if(toast) {
                toast.style.transition = 'all 0.6s cubic-bezier(0.68, -0.55, 0.27, 1.55)';
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(50px) scale(0.9)';
                setTimeout(() => toast.remove(), 600);
            }
        }, 4000);
    </script>
    @endif

    @include('public.layout.footer')

    @yield('scripts')

    {{-- AOS Init --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init({
        duration: 1000,
        once: true,
        offset: 100,
        easing: 'ease-out-cubic'
      });

      // ── PRELOADER LOGIC ──
      window.addEventListener('load', function() {
          const preloader = document.getElementById('preloader');
          setTimeout(() => {
              preloader.classList.add('preloader-hidden');
          }, 800); // Minimum delay to see the animation
      });

      // Show loader on navigation
      window.addEventListener('beforeunload', function() {
          document.getElementById('preloader').classList.remove('preloader-hidden');
      });
    </script>

</body>
</html>
