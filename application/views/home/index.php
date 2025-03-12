<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Hero Section dengan background gradient -->
<section class="hero-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-4 fw-bold text-white mb-3">Belajar Lebih Mudah dengan DosenKu</h1>
                <p class="lead text-white-50 mb-4">Platform pembelajaran yang memudahkan mahasiswa dalam mengakses materi perkuliahan kapanpun dan dimanapun.</p>
                <div class="d-flex gap-3">
                    <?php if(!$this->session->userdata('logged_in')): ?>
                    <a href="<?= base_url('auth') ?>" class="btn btn-primary btn-lg px-4 rounded-pill">
                        <i class="fas fa-sign-in-alt me-2"></i> Masuk Sekarang
                    </a>
                    <?php else: ?>
                    <a href="#course-section" class="btn btn-primary btn-lg px-4 rounded-pill">
                        <i class="fas fa-book me-2"></i> Mulai Belajar
                    </a>
                    <?php endif; ?>
                    <a href="#features" class="btn btn-outline-light btn-lg px-4 rounded-pill">Pelajari Lebih Lanjut</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image-container">
                    <img src="<?= base_url('assets/images/hero-image.svg') ?>" alt="Hero Image" class="img-fluid hero-image">
                    
                    <!-- Jika ingin menggunakan gambar PNG atau JPG, gunakan kode di bawah ini -->
                    <!-- <img src="<?= base_url('assets/images/hero-image.png') ?>" alt="Hero Image" class="img-fluid hero-image"> -->
                    <!-- atau -->
                    <!-- <img src="<?= base_url('assets/images/hero-image.jpg') ?>" alt="Hero Image" class="img-fluid hero-image"> -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="search-section py-4">
    <div class="container">
<div class="row justify-content-center">
    <div class="col-md-10">
                <div class="card search-card mb-4">
            <div class="card-body p-4">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-primary"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0" 
                           placeholder="Coba cari materi belajarmu di sini"
                           aria-label="Search materials">
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center mb-4">
            <div class="me-3">
                        <label class="form-label mb-0 text-primary fw-medium">Pilih Jurusan:</label>
                    </div>
                    <button class="btn btn-light d-flex align-items-center gap-2 shadow-sm" type="button" data-bs-toggle="modal" data-bs-target="#pilihJurusanModal">
                        <span id="selected-jurusan" data-id="<?= $jurusan[0]['id'] ?>"><?= $jurusan[0]['nama_jurusan'] ?></span>
                        <i class="fas fa-chevron-right text-primary"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Pilih Jurusan -->
<div class="modal fade" id="pilihJurusanModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Pilih Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="list-group list-group-flush">
                    <?php foreach($jurusan as $j): ?>
                    <button type="button" 
                            class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-3 px-3" 
                            onclick="pilihJurusan(<?= $j['id'] ?>, '<?= htmlspecialchars($j['nama_jurusan'], ENT_QUOTES) ?>')"
                            data-bs-dismiss="modal">
                        <span><?= $j['nama_jurusan'] ?></span>
                        <i class="fas fa-chevron-right text-primary"></i>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Content area for search results -->
        <div id="search-results">
            <!-- Results will be loaded here -->
        </div>

        <!-- Course cards section -->
<section id="course-section" class="py-5">
    <div class="container">
        <div class="course-container mb-5">
            <div class="section-header mb-4">
                <h2 class="section-title">Ruang Mata Kuliah</h2>
                <p class="section-subtitle">Pilih mata kuliah yang ingin Anda pelajari</p>
            </div>
            
            <div class="course-grid">
                <div id="courses-container" class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-hand-point-up fa-4x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Silakan Pilih Jurusan Terlebih Dahulu</h4>
                    <p class="text-muted mb-4">Pilih jurusan di bagian atas untuk melihat mata kuliah yang tersedia</p>
                    
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <?php foreach($jurusan as $jrs): ?>
                                <button class="btn btn-outline-primary mb-2" onclick="pilihJurusan(<?= $jrs['id'] ?>, '<?= htmlspecialchars($jrs['nama_jurusan'], ENT_QUOTES) ?>')">
                                    <?= $jrs['nama_jurusan'] ?>
                                </button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

        <!-- Modal for All Courses -->
        <div class="modal fade" id="allCoursesModal" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0">
                <h5 class="modal-title">Semua Mata Kuliah <span id="modal-department" class="text-primary"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-4">
                            <!-- Course items will be dynamically loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Ruang Baca Section -->
<section class="blog-section py-5 bg-light">
    <div class="container">
        <div class="course-container mb-4">
            <div class="section-header mb-4">
                <h2 class="section-title">Ruang Baca</h2>
                <p class="section-subtitle">Temukan artikel-artikel menarik seputar dunia pendidikan</p>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div></div>
                <div class="navigation-buttons">
                    <?php if($this->session->userdata('role') === 'admin'): ?>
                    <a href="<?= base_url('admin/blog') ?>" class="btn btn-success btn-sm rounded-pill me-2">
                        <i class="fas fa-cog me-1"></i> Kelola Blog
                    </a>
                    <?php endif; ?>
                    <a href="<?= base_url('blog') ?>" class="btn btn-outline-primary btn-sm rounded-pill me-2">
                        <i class="fas fa-list me-1"></i> Lihat Semua Artikel
                    </a>
                    <button class="btn btn-outline-primary btn-sm rounded-circle" id="prev-blog">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="btn btn-primary btn-sm rounded-circle" id="next-blog">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            
            <div class="blog-slider">
                <div class="row flex-nowrap overflow-auto pb-3" id="blog-container">
                    <?php if(isset($blogs) && !empty($blogs)): ?>
                        <?php foreach($blogs as $blog): ?>
                            <div class="col-md-3 col-sm-6 col-10">
                                <a href="<?= base_url('blog/view/' . $blog['id']) ?>" class="text-decoration-none">
                                    <div class="card h-100 border-0 shadow-sm blog-card">
                                        <?php if($blog['gambar'] && file_exists('./uploads/blog/' . $blog['gambar'])): ?>
                                            <img src="<?= base_url('uploads/blog/' . $blog['gambar']) ?>" class="card-img-top" alt="<?= $blog['judul'] ?>" style="height: 160px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-light text-center py-5" style="height: 160px;">
                                                <i class="fas fa-book fa-3x text-primary"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h6 class="card-title text-dark"><?= $blog['judul'] ?></h6>
                                            <p class="card-text small text-muted">
                                                <i class="fas fa-calendar-alt"></i> 
                                                <?= date('d M Y', strtotime($blog['created_at'])) ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center">
                            <p class="text-muted">Belum ada artikel yang tersedia.</p>
                            <a href="<?= base_url('blog') ?>" class="btn btn-primary rounded-pill">
                                <i class="fas fa-book-reader me-1"></i> Kunjungi Ruang Baca
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Tombol Lihat Semua untuk Mobile -->
                <div class="d-flex justify-content-center mt-3 d-md-none">
                    <a href="<?= base_url('blog') ?>" class="btn btn-outline-primary rounded-pill">
                        <i class="fas fa-list me-1"></i> Lihat Semua Artikel
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="features-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Kenapa Memilih DosenKu?</h2>
            <p class="section-subtitle">Platform pembelajaran yang dirancang khusus untuk kebutuhan mahasiswa</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4 mb-4">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-book fa-3x text-primary"></i>
                    </div>
                    <h4 class="feature-title">Materi Lengkap</h4>
                    <p class="feature-text">Akses materi perkuliahan yang lengkap dan terstruktur dari berbagai jurusan.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-clock fa-3x text-primary"></i>
                    </div>
                    <h4 class="feature-title">Akses 24/7</h4>
                    <p class="feature-text">Belajar kapanpun dan dimanapun Anda berada tanpa batasan waktu.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-users fa-3x text-primary"></i>
                    </div>
                    <h4 class="feature-title">Komunitas</h4>
                    <p class="feature-text">Bergabung dengan komunitas pembelajaran yang aktif dan saling mendukung.</p>
                </div>
            </div>
        </div>
    </div>
</section>

        <style>
    :root {
        --primary: #3d348b;
        --secondary: #7678ed;
        --accent: #f7b801;
        --light: #f8f9fa;
        --dark: #212529;
    }
    
    body {
        font-family: 'Poppins', sans-serif;
        color: var(--dark);
        background-color: #f9fafc;
    }
    
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        padding: 6rem 0;
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB2aWV3Qm94PSIwIDAgMTI4MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjEpIj48cGF0aCBkPSJNMTI4MCAwTDY0MCA3MCAwIDB2MTQwbDY0MC03MCAxMjgwIDcwVjB6Ii8+PC9nPjwvc3ZnPg==');
        background-size: 100% 100%;
        z-index: 1;
        opacity: 0.3;
    }
    
    .hero-section .container {
        position: relative;
        z-index: 2;
    }
    
    .hero-image-container {
        position: relative;
        z-index: 2;
    }
    
    .hero-image {
        animation: float 6s ease-in-out infinite;
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));
    }
    
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    
    /* Search Section */
    .search-section {
        margin-top: -3rem;
        position: relative;
        z-index: 10;
    }
    
    .search-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    
    /* Section Styling */
    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .section-title {
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        display: inline-block;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background-color: var(--accent);
        border-radius: 3px;
    }
    
    .section-subtitle {
        color: #6c757d;
        font-size: 1.1rem;
    }
    
    /* Course Container */
            .course-container {
                background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            }

            .course-title {
                color: var(--primary);
                font-weight: 600;
    }
    
    /* Blog Cards */
    .blog-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .blog-slider .row {
        scroll-behavior: smooth;
    }
    
    .blog-slider::-webkit-scrollbar {
        display: none;
    }
    
    #blog-container {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    /* Feature Cards */
    .feature-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .feature-icon {
        display: inline-flex;
                align-items: center;
        justify-content: center;
        width: 80px;
        height: 80px;
        background-color: rgba(118, 120, 237, 0.1);
        border-radius: 50%;
        margin-bottom: 1.5rem;
    }
    
    .feature-title {
                color: var(--primary);
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .feature-text {
        color: #6c757d;
    }
    
    /* Buttons */
    .btn-primary {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    
    .btn-primary:hover, .btn-primary:focus {
        background-color: var(--secondary);
                border-color: var(--secondary);
            }

    .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
    }
    
    .btn-outline-primary:hover, .btn-outline-primary:focus {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    
    .btn-success {
        background-color: var(--accent);
        border-color: var(--accent);
        color: var(--dark);
    }
    
    .btn-success:hover, .btn-success:focus {
        background-color: #e0a800;
        border-color: #e0a800;
        color: var(--dark);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .hero-section {
            padding: 4rem 0;
            text-align: center;
        }
        
        .hero-image {
            margin-top: 2rem;
        }
        
        .section-header {
            margin-bottom: 2rem;
        }
        
        .course-container {
            padding: 1.5rem;
        }
            }
        </style>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Variabel untuk menyimpan data matakuliah berdasarkan jurusan
        let coursesByDepartment = {};
        
        // Fungsi untuk memuat data matakuliah
        function loadCoursesByDepartment() {
            $.ajax({
                url: '<?= base_url('home/get_all_matakuliah') ?>',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Kelompokkan matakuliah berdasarkan jurusan
                    coursesByDepartment = {};
                    data.forEach(course => {
                        if (!coursesByDepartment[course.jurusan_id]) {
                            coursesByDepartment[course.jurusan_id] = [];
                        }
                        coursesByDepartment[course.jurusan_id].push(course);
                    });
                    
                    // Tidak perlu merender matakuliah saat halaman dimuat
                    // User harus memilih jurusan terlebih dahulu
                    console.log('Data matakuliah berhasil dimuat');
                },
                error: function(xhr, status, error) {
                    console.error('Error loading courses:', error);
                    $('#courses-container').html('<div class="alert alert-danger">Terjadi kesalahan saat memuat data mata kuliah.</div>');
                }
            });
        }
        
        // Fungsi untuk merender semua jurusan
        function renderAllDepartments() {
            $('#courses-container').empty();
            
            $.each(coursesByDepartment, function(jurusanId, courses) {
                if (courses.length > 0) {
                    const jurusanName = courses[0].nama_jurusan;
                    const departmentContainer = renderDepartmentCourses(jurusanId, jurusanName);
                    $('#courses-container').append(departmentContainer);
                }
            });
        }
        
        // Fungsi untuk merender matakuliah untuk satu jurusan
        function renderDepartmentCourses(jurusanId, jurusanName) {
            const departmentCourses = coursesByDepartment[jurusanId] || [];
            const departmentContainer = $(`<div class="department-container mb-5"></div>`);
            
            // Tambahkan judul jurusan
            departmentContainer.append(`
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="section-title">${jurusanName}</h3>
                </div>
            `);
            
            // Tambahkan baris matakuliah
            const courseRow = $(`<div class="row g-4"></div>`);
            departmentContainer.append(courseRow);
            
            // Tambahkan matakuliah (batasi hingga 6)
            const displayCourses = departmentCourses.slice(0, 6);
            displayCourses.forEach(course => {
                // Pastikan icon menggunakan format yang benar (fas + icon)
                let iconClass = course.icon;
                if (iconClass && !iconClass.includes('fa-')) {
                    iconClass = 'fa-' + iconClass;
                }
                if (iconClass && !iconClass.includes('fas ')) {
                    iconClass = 'fas ' + iconClass;
                }
                
                courseRow.append(`
                    <div class="col-lg-4 col-md-6">
                        <div class="card course-card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="course-icon me-3">
                                        <i class="${iconClass}"></i>
                                    </div>
                                    <h5 class="card-title mb-0">${course.nama_matakuliah}</h5>
                                </div>
                                <p class="card-text">${course.deskripsi || 'Tidak ada deskripsi'}</p>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <a href="${course.url}" class="btn btn-sm btn-primary w-100">Lihat Materi</a>
                            </div>
                        </div>
                    </div>
                `);
            });
            
            // Tambahkan tombol "Lihat Semua" jika ada lebih dari 6 matakuliah
            if (departmentCourses.length > 6) {
                const hiddenCount = departmentCourses.length - 6;
                courseRow.append(`
                    <div class="col-12 text-center mt-3">
                        <button class="btn btn-outline-primary view-all-btn" 
                                data-jurusan-id="${jurusanId}" 
                                data-jurusan-name="${jurusanName}">
                            Lihat Semua Mata Kuliah 
                            <span class="badge bg-primary ms-2">${hiddenCount}</span>
                        </button>
                    </div>
                `);
            }
            
            return departmentContainer;
        }
        
        // Fungsi untuk menampilkan semua matakuliah dalam modal
        function showAllCourses(jurusanId, jurusanName) {
            // Kosongkan modal
            $('#allCoursesModal .modal-body .row').empty();
            
            // Dapatkan semua matakuliah untuk jurusan ini
            const allCourses = coursesByDepartment[jurusanId] || [];
            const totalCourses = allCourses.length;
            
            // Perbarui judul modal dengan jumlah total matakuliah
            $('#modal-department').html(`${jurusanName} <span class="badge bg-primary ms-2">${totalCourses}</span>`);
            
            // Tambahkan semua matakuliah ke modal
            allCourses.forEach(course => {
                // Pastikan icon menggunakan format yang benar (fas + icon)
                let iconClass = course.icon;
                if (iconClass && !iconClass.includes('fa-')) {
                    iconClass = 'fa-' + iconClass;
                }
                if (iconClass && !iconClass.includes('fas ')) {
                    iconClass = 'fas ' + iconClass;
                }
                
                $('#allCoursesModal .modal-body .row').append(`
                    <div class="col-md-4 col-sm-6">
                        <div class="card course-card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="course-icon me-3">
                                        <i class="${iconClass}"></i>
                                    </div>
                                    <h5 class="card-title mb-0">${course.nama_matakuliah}</h5>
                                </div>
                                <p class="card-text">${course.deskripsi || 'Tidak ada deskripsi'}</p>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <a href="${course.url}" class="btn btn-sm btn-primary w-100">Lihat Materi</a>
                            </div>
                        </div>
                    </div>
                `);
            });
            
            // Tampilkan modal
            $('#allCoursesModal').modal('show');
        }
        
        // Tambahkan event listener untuk tombol "Lihat Semua"
        $(document).on('click', '.view-all-btn', function() {
            const jurusanId = $(this).data('jurusan-id');
            const jurusanName = $(this).data('jurusan-name');
            showAllCourses(jurusanId, jurusanName);
        });
        
        // Muat data matakuliah saat halaman dimuat
        loadCoursesByDepartment();
        
        // Fungsi untuk memilih jurusan
        window.pilihJurusan = function(id, nama) {
            $('#selected-jurusan').text(nama).data('id', id);
            
            // Render ulang matakuliah untuk jurusan yang dipilih
            $('#courses-container').empty();
            
            if (coursesByDepartment[id] && coursesByDepartment[id].length > 0) {
                const departmentContainer = renderDepartmentCourses(id, nama);
                $('#courses-container').append(departmentContainer);
            } else {
                $('#courses-container').html(`
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-book-open fa-4x text-muted"></i>
                        </div>
                        <h4 class="text-muted mb-3">Belum ada mata kuliah untuk jurusan ${nama}</h4>
                        <?php if($this->session->userdata('role') === 'admin'): ?>
                        <a href="<?= base_url('mengelolamatakuliah') ?>" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-plus me-2"></i> Tambah Mata Kuliah
                        </a>
                        <?php endif; ?>
                    </div>
                `);
            }
            
            // Scroll ke bagian matakuliah
            $('html, body').animate({
                scrollTop: $('#course-section').offset().top - 100
            }, 500);
        };
        
        // Blog slider navigation
        const blogContainer = document.getElementById('blog-container');
        const prevBtn = document.getElementById('prev-blog');
        const nextBtn = document.getElementById('next-blog');
        
        prevBtn.addEventListener('click', function() {
            blogContainer.scrollLeft -= 300;
        });
        
        nextBtn.addEventListener('click', function() {
            blogContainer.scrollLeft += 300;
        });
        
        // Search functionality
        $('input[aria-label="Search materials"]').on('keyup', function(e) {
            if(e.keyCode === 13) {
                let keyword = $(this).val();
                if(keyword.length > 2) {
                    $.ajax({
                        url: '<?= base_url('home/search') ?>',
                        type: 'GET',
                        data: {keyword: keyword},
                        success: function(response) {
                            $('#search-results').html(response);
                            $('html, body').animate({
                                scrollTop: $('#search-results').offset().top - 100
                            }, 500);
                        }
                    });
                }
            }
        });
        });
        </script> 