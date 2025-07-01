<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bappelitbangda - Portal Apps</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('logo/favicon.ico') }}">
    <style>
        .hero-section {
            background-color: #f8f9fa;
            padding: 110px 0;
            text-align: center;
        }
        .header-logo {
            width: 45px;
            height: inherit;
        }
        .card-img-top {
            width: 280px; /* Set a fixed width */
            height: 150px; /* Set a fixed height */
            object-fit: full; /* Ensure the image covers the area without distortion */
            margin: 0 auto;
            display: block;
        }
        .card {
            border: none;
            transition: transform 0.2s;
            cursor: pointer;
            margin-bottom: 35px;
        }
        .card:hover {
            transform: translateY(-10px);
            transition: transform 0.3s ease;
        }
        .card-body {
            text-align: center;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        footer {
            margin-top: auto;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="{{ asset('logo/Lambang-Kota-Pasuruan-Asli.webp'); }}" class="header-logo" alt="logo-kota-pasuruan"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link mx-2" href="#features">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link mx-2" href="#about">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link mx-2" href="#contact">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container">
            <h1 class="display-4">Portal Aplikasi Bappelitbanda Kota Pasuruan</h1>
            <p class="lead">Adaptif . Partisipatif . Inovatif . Kolaboratif</p>
            <a href="#cards" class="btn btn-dark btn-md">Selengkapnya</a>
        </div>
    </header>

    <section id="cards" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 display-6">Fitur Kami</h2>
            <div class="row">
                <div class="col-md-4">
                    <a href="https://eapik.pasuruankota.go.id/perangkat_daerah" class="text-decoration-none">
                        <div class="card h-100">
                            <img src="{{ asset('logo/eapik-logo.webp'); }}" class="card-img-top" alt="Feature 1">
                            <div class="card-body">
                                <h5 class="card-title">Perencanaan</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="http://103.165.154.47:8800" class="text-decoration-none">
                    <div class="card h-100">
                        <img src="{{ asset('logo/kajian-logo.webp'); }}" class="card-img-top" alt="Feature 2">
                        <div class="card-body">
                            <h5 class="card-title">Kajian</h5>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="{{ asset('logo/rkc-logo.webp'); }}" class="card-img-top" alt="Feature 3">
                        <div class="card-body">
                            <h5 class="card-title">Reka Karsa Cipta</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-light text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; 2025 Bappelitbanda Kota Pasuruan.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
