<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dosenku' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        :root {
            --primary: #3d348b;
            --secondary: #7678ed;
            --accent: #f7b801;
            --bg-main: #e2eafc;
            --bg-light: #edf2fb;
            --card-bg: rgba(255, 255, 255, 0.95);
        }
        
        body {
            background: linear-gradient(135deg, var(--bg-main) 0%, var(--bg-light) 100%);
            min-height: 100vh;
            color: #2b2d42;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            color: white !important;
            font-weight: 600;
            font-size: 1.4rem;
        }

        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--accent) !important;
            transform: translateY(-1px);
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            background: var(--card-bg);
            border-radius: 10px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            backdrop-filter: blur(10px);
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }

        /* Search styles */
        .input-group .input-group-text {
            border-radius: 8px 0 0 8px;
            border-color: #e0e0e0;
        }

        .input-group .form-control {
            border-radius: 0 8px 8px 0;
            border-color: #e0e0e0;
            font-size: 0.95rem;
        }

        .input-group .form-control:focus {
            border-color: var(--secondary);
        }

        /* Dropdown styles */
        .btn-light {
            background: white;
            border: 1px solid #e0e0e0;
            color: #2b2d42;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            border-radius: 8px;
            min-width: 200px;
            text-align: left;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btn-light:hover, .btn-light:focus {
            background: white;
            border-color: var(--secondary);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .btn-light .fa-chevron-down {
            position: absolute;
            right: 1rem;
            transition: transform 0.2s ease;
        }

        .btn-light[aria-expanded="true"] .fa-chevron-down {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 8px;
            min-width: 200px;
            margin-top: 0.5rem;
            padding: 0.5rem;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            color: #2b2d42;
            transition: all 0.2s ease;
            border-radius: 6px;
        }

        .dropdown-item:hover {
            background: var(--bg-light);
            color: var(--primary);
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            color: var(--primary);
            font-weight: 600;
            border-bottom-width: 1px;
        }

        .table td {
            color: #2b2d42;
        }

        .badge {
            padding: 0.5em 1em;
            font-weight: 500;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.15);
        }

        .btn-secondary {
            background: #8d99ae;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-secondary:hover {
            background: #7d8597;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.15);
        }

        .alert {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            backdrop-filter: blur(10px);
        }

        .form-control {
            border: 1px solid rgba(0,0,0,0.1);
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px);
            color: #2b2d42;
        }

        .form-control:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 0.25rem rgba(118, 120, 237, 0.25);
            color: #2b2d42;
        }

        .form-label {
            color: #2b2d42;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">Dosenku</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php if($this->session->userdata('logged_in')): ?>
                    <ul class="navbar-nav">
                        <?php if(in_array($this->session->userdata('role'), ['admin', 'dosen'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('admin') ?>">
                                    <i class="fas fa-cogs me-1"></i>Admin Panel
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('profile') ?>">
                                <i class="fas fa-user me-1"></i><?= $this->session->userdata('username') ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                                <i class="fas fa-sign-out-alt me-1"></i>Logout
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container mt-4"> 