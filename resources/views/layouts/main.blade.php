<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Ciangir - Profil Desa</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
        --primary: #459749ff;
        --secondary: #388e3c;
        --light-green: #8bc34a;
        }
        body {
        font-family: 'Open Sans', sans-serif;
        color: #333;
        }
        h1, h2, h3, h4, h5 {
        font-family: 'Poppins', sans-serif;
        color: var(--primary);
        }
        .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                    url({{ asset('/images/hero-img.jpeg') }});
        background-size: cover;
        background-position: center;
        }
        .card {
        transition: transform 0.3s;
        border: none;
        }
        .card:hover {
        transform: translateY(-5px);
        }
        .feature-icon {
        font-size: 2.5rem;
        color: var(--primary);
        }
        .map-container {
        height: 400px;
        border-radius: 10px;
        overflow: hidden;
        }
        .nav-link.active {
            font-weight: 600;
            color: var(--primary) !important;
            border-bottom: 2px solid var(--primary);
        }
    </style>
    </head>
    <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
        <a class="navbar-brand fw-bold" href="#" style="color: var(--primary);">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="60" class="me-2">
            Desa Ciangir
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="/home">Profil</a></li>
            <li class="nav-item"><a class="nav-link" href="/umkm">UMKM</a></li>
            <li class="nav-item"><a class="nav-link" href="/service">Layanan</a></li>
            @auth
            <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
            @else
            <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
            @endauth
            </ul>
        </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="py-4 bg-black text-white text-center">
        <div class="container">
        <p class="mb-0">&copy; 2025 Desa Ciangir. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script untuk menangani active link -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentUrl = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                const linkUrl = link.getAttribute('href');
                
                // Cek jika URL saat ini mengandung link URL
                if (currentUrl === linkUrl || 
                    (linkUrl !== '/' && currentUrl.startsWith(linkUrl))) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>