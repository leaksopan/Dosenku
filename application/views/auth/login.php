<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dosenku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #3d348b;
            --secondary: #7678ed;
            --accent: #f7b801;
        }
        
        body {
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
        }

        .split-container {
            display: flex;
            min-height: 100vh;
        }

        .login-side {
            flex: 1;
            padding: 2rem 4rem;
            background: white;
            display: flex;
            align-items: center;
        }

        .carousel-side {
            flex: 1;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
            padding: 2rem;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .login-header {
            margin-bottom: 2.5rem;
        }

        .login-header h1 {
            color: var(--primary);
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .login-header p {
            color: #666;
            font-size: 1.1rem;
        }

        .form-control {
            padding: 1rem 1.2rem;
            border-radius: 12px;
            border: 2px solid #eee;
            transition: all 0.3s;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 0.2rem rgba(118, 120, 237, 0.25);
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
            padding: 1rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--secondary);
            transform: translateY(-2px);
        }

        .form-label {
            color: var(--primary);
            font-weight: 500;
            margin-bottom: 0.8rem;
        }

        .vertical-carousel {
            height: calc(50% - 1rem);
            position: relative;
            padding: 1rem;
        }

        .carousel-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1rem;
            margin-bottom: 1rem;
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.2);
            opacity: 0;
            transform: translateY(20px);
            transition: all 1.2s cubic-bezier(0.645, 0.045, 0.355, 1);
            position: relative;
            overflow: hidden;
            will-change: transform, opacity;
        }

        .lecturer-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
        }

        .lecturer-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            color: white;
            text-align: left;
        }

        .lecturer-info h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .lecturer-info p {
            font-size: 1rem;
            margin: 0;
            opacity: 0.9;
        }

        .carousel-item.active {
            opacity: 1;
            transform: translateY(0);
        }

        .carousel-placeholder {
            text-align: center;
        }

        .carousel-placeholder i {
            font-size: 4rem;
            color: var(--accent);
            margin-bottom: 1rem;
        }

        .carousel-placeholder p {
            color: white;
            font-size: 1.2rem;
            margin: 0;
        }

        .carousel-dimensions {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        @media (max-width: 992px) {
            .carousel-side {
                display: none;
            }
            
            .login-side {
                padding: 2rem;
            }
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .google-btn {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #eee;
            border-radius: 12px;
            background: white;
            color: #333;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            transition: all 0.3s;
        }

        .google-btn:hover {
            background: #f8f9fa;
            border-color: #ddd;
        }

        .divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background: #eee;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .test-accounts {
            margin-top: 2rem;
        }

        .account-list {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1rem;
        }

        .account-item {
            display: flex;
            align-items: center;
            padding: 0.7rem;
            background: white;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            border-left: 3px solid var(--accent);
        }

        .account-item:last-child {
            margin-bottom: 0;
        }

        .account-item i {
            color: var(--accent);
            margin-right: 1rem;
            font-size: 1.1rem;
        }

        .account-item span {
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="split-container">
        <!-- Login Side -->
        <div class="login-side">
            <div class="login-container">
                <div class="login-header">
                    <h1>Selamat datang di Dosenku</h1>
                    <p>Dimana Mahasiswa/Calon Bertemu Dosen</p>
                </div>

                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= $this->session->flashdata('error') ?>
                    </div>
                <?php endif; ?>

                <button class="google-btn">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google" height="20">
                    Sign in with Google
                </button>

                <div class="divider">
                    <span>or</span>
                </div>

                <?= form_open('auth/login') ?>
                    <div class="mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                <?= form_close() ?>

                <div class="test-accounts mt-4">
                    <div class="divider">
                        <span>Test Accounts</span>
                    </div>
                    <div class="account-list">
                        <div class="account-item">
                            <i class="fas fa-user-shield"></i>
                            <span>Admin: admin/admin123</span>
                        </div>
                        <div class="account-item">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>Dosen: dosen/dosen123</span>
                        </div>
                        <div class="account-item">
                            <i class="fas fa-user-graduate"></i>
                            <span>Mahasiswa: mahasiswa/mhs123</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel Side -->
        <div class="carousel-side">
            <!-- Top Carousel -->
            <div class="vertical-carousel">
                <div class="carousel-item">
                    <img src="<?= base_url('assets/img/lecturers/dosen1.jpg') ?>?v=<?= time() ?>" 
                         alt="Dr. John Doe" 
                         class="lecturer-image"
                         onerror="this.onerror=null; handleImageError(this);">
                    <div class="lecturer-info">
                        <h3>Dr. John Doe</h3>
                        <p>Professor of Computer Science</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('assets/img/lecturers/dosen2.jpg') ?>?v=<?= time() ?>" 
                         alt="Dr. Jane Smith" 
                         class="lecturer-image"
                         onerror="this.onerror=null; handleImageError(this);">
                    <div class="lecturer-info">
                        <h3>Dr. Jane Smith</h3>
                        <p>AI & Machine Learning Expert</p>
                    </div>
                </div>
            </div>

            <!-- Bottom Carousel -->
            <div class="vertical-carousel">
                <div class="carousel-item">
                    <img src="<?= base_url('assets/img/lecturers/dosen3.jpg') ?>?v=<?= time() ?>" 
                         alt="Prof. David Wilson" 
                         class="lecturer-image"
                         onerror="this.onerror=null; handleImageError(this);">
                    <div class="lecturer-info">
                        <h3>Prof. David Wilson</h3>
                        <p>Data Science Specialist</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('assets/img/lecturers/dosen4.jpg') ?>?v=<?= time() ?>" 
                         alt="Dr. Sarah Johnson" 
                         class="lecturer-image"
                         onerror="this.onerror=null; handleImageError(this);">
                    <div class="lecturer-info">
                        <h3>Dr. Sarah Johnson</h3>
                        <p>Software Engineering Lead</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle image loading errors
        function handleImageError(img) {
            img.src = 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200">
                    <rect width="200" height="200" fill="#f0f0f0"/>
                    <text x="50%" y="50%" fill="#999" text-anchor="middle" dy=".3em" font-family="Arial" font-size="14">
                        Image not found
                    </text>
                </svg>
            `);
            img.style.objectFit = 'contain';
            console.error('Failed to load image:', img.alt);
        }

        // Vertical carousel animation for both carousels
        document.addEventListener('DOMContentLoaded', function() {
            const carousels = document.querySelectorAll('.vertical-carousel');
            
            carousels.forEach((carousel, index) => {
                const items = carousel.querySelectorAll('.carousel-item');
                let currentIndex = 0;
                let isAnimating = false;

                // Preload images
                items.forEach(item => {
                    const img = item.querySelector('img');
                    if (img) {
                        const preloadImg = new Image();
                        preloadImg.src = img.src;
                    }
                });

                // Set initial state with delay for second carousel
                setTimeout(() => {
                    items[0].style.opacity = '1';
                    items[0].style.transform = 'translateY(0)';
                }, index * 1500);

                function nextSlide() {
                    if (isAnimating) return;
                    isAnimating = true;

                    const currentItem = items[currentIndex];
                    currentIndex = (currentIndex + 1) % items.length;
                    const nextItem = items[currentIndex];

                    // Animate out current slide
                    currentItem.style.transform = 'translateY(-100%)';
                    currentItem.style.opacity = '0';

                    // Prepare next slide
                    nextItem.style.transform = 'translateY(100%)';
                    nextItem.style.opacity = '0';

                    // Small delay before bringing in next slide
                    setTimeout(() => {
                        nextItem.style.transform = 'translateY(0)';
                        nextItem.style.opacity = '1';
                        
                        // Reset animation lock after transition completes
                        setTimeout(() => {
                            isAnimating = false;
                        }, 1200);
                    }, 50);
                }

                // Style untuk animasi
                items.forEach(item => {
                    item.style.transition = 'all 1.2s cubic-bezier(0.645, 0.045, 0.355, 1)';
                    item.style.position = 'absolute';
                    item.style.top = '0';
                    item.style.left = '0';
                    item.style.right = '0';
                });

                // Mulai carousel dengan delay berbeda untuk masing-masing carousel
                setTimeout(() => {
                    setInterval(nextSlide, 5000);
                }, index * 2500);
            });
        });
    </script>
</body>
</html> 