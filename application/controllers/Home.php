<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property Jurusan_model $Jurusan_model
 * @property Matakuliah_model $Matakuliah_model
 * @property Blog_model $Blog_model
 * @property CI_Input $input
 */
class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Jurusan_model');
        $this->load->model('Matakuliah_model');
        $this->load->model('Blog_model');
    }
    
    public function index() {
        $data['title'] = 'DosenKu - Platform Pembelajaran Online';
        $data['username'] = $this->session->userdata('username');
        $data['role'] = $this->session->userdata('role');
        $data['jurusan'] = $this->Jurusan_model->getAll();
        
        // Ambil 6 blog terbaru
        try {
            $data['blogs'] = $this->Blog_model->getAll(6, 0);
        } catch (Exception $e) {
            $data['blogs'] = [];
            error_log('Error saat mengambil data blog: ' . $e->getMessage());
        }
        
        // Default jurusan pertama
        $default_jurusan = $data['jurusan'][0]['id'];
        $data['matakuliah'] = $this->Matakuliah_model->getByJurusan($default_jurusan);
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }

    public function get_matakuliah($jurusan_id) {
        $matakuliah = $this->Matakuliah_model->getByJurusan($jurusan_id);
        
        // Debug: Log data matakuliah
        error_log('Data matakuliah untuk jurusan ' . $jurusan_id . ': ' . json_encode($matakuliah));
        
        // Format data untuk JavaScript
        $formatted_data = [];
        foreach ($matakuliah as $mk) {
            // Gunakan icon dari database jika ada, jika tidak gunakan fungsi get_icon_for_course
            $icon = !empty($mk['icon']) ? $mk['icon'] : $this->get_icon_for_course($mk['nama']);
            
            $formatted_data[] = [
                'id' => $mk['id'],
                'nama' => $mk['nama'],
                'nama_matakuliah' => $mk['nama'],
                'deskripsi' => isset($mk['deskripsi']) ? $mk['deskripsi'] : 'Pelajari materi kuliah ini sekarang.',
                'jurusan_id' => $mk['jurusan_id'],
                'nama_jurusan' => isset($mk['nama_jurusan']) ? $mk['nama_jurusan'] : '',
                'slug' => strtolower(str_replace(' ', '', $mk['nama'])),
                'icon' => $icon // Tambahkan icon ke data
            ];
        }
        
        // Debug: Log formatted data
        error_log('Formatted data: ' . json_encode($formatted_data));
        
        echo json_encode($formatted_data);
    }

    // Fungsi untuk menentukan icon berdasarkan nama matakuliah
    private function get_icon_for_course($course_name) {
        $course_name = strtolower($course_name);
        
        if (strpos($course_name, 'matematika') !== false) {
            return 'fa-calculator';
        } else if (strpos($course_name, 'tanah') !== false || strpos($course_name, 'geologi') !== false) {
            return 'fa-mountain';
        } else if (strpos($course_name, 'beton') !== false || strpos($course_name, 'struktur') !== false) {
            return 'fa-building';
        } else if (strpos($course_name, 'komputer') !== false || strpos($course_name, 'program') !== false) {
            return 'fa-laptop-code';
        } else if (strpos($course_name, 'fisika') !== false || strpos($course_name, 'mekanika') !== false) {
            return 'fa-atom';
        } else if (strpos($course_name, 'kimia') !== false) {
            return 'fa-flask';
        } else if (strpos($course_name, 'elektro') !== false || strpos($course_name, 'listrik') !== false) {
            return 'fa-bolt';
        } else if (strpos($course_name, 'biologi') !== false || strpos($course_name, 'lingkungan') !== false) {
            return 'fa-leaf';
        } else if (strpos($course_name, 'ekonomi') !== false || strpos($course_name, 'bisnis') !== false) {
            return 'fa-chart-line';
        } else if (strpos($course_name, 'hukum') !== false) {
            return 'fa-gavel';
        } else if (strpos($course_name, 'kedokteran') !== false || strpos($course_name, 'kesehatan') !== false) {
            return 'fa-heartbeat';
        } else if (strpos($course_name, 'bahasa') !== false) {
            return 'fa-language';
        } else if (strpos($course_name, 'sejarah') !== false) {
            return 'fa-landmark';
        } else if (strpos($course_name, 'seni') !== false || strpos($course_name, 'musik') !== false) {
            return 'fa-paint-brush';
        } else if (strpos($course_name, 'olahraga') !== false || strpos($course_name, 'sport') !== false) {
            return 'fa-running';
        } else if (strpos($course_name, 'psikologi') !== false) {
            return 'fa-brain';
        } else if (strpos($course_name, 'komunikasi') !== false || strpos($course_name, 'media') !== false) {
            return 'fa-comments';
        } else if (strpos($course_name, 'agama') !== false || strpos($course_name, 'islam') !== false) {
            return 'fa-pray';
        } else if (strpos($course_name, 'statistik') !== false || strpos($course_name, 'data') !== false) {
            return 'fa-chart-bar';
        } else {
            // Gunakan icon default jika tidak ada kata kunci yang cocok
            return 'fa-book';
        }
    }
    
    public function get_all_matakuliah() {
        // Ambil semua jurusan
        $jurusan = $this->Jurusan_model->getAll();
        
        // Siapkan array untuk menyimpan semua matakuliah
        $all_matakuliah = [];
        
        // Ambil matakuliah untuk setiap jurusan
        foreach ($jurusan as $jrs) {
            $matakuliah = $this->Matakuliah_model->getByJurusan($jrs['id']);
            
            // Format data untuk JavaScript
            foreach ($matakuliah as $mk) {
                // Gunakan icon dari database jika ada, jika tidak gunakan fungsi get_icon_for_course
                $icon = !empty($mk['icon']) ? $mk['icon'] : $this->get_icon_for_course($mk['nama']);
                
                $all_matakuliah[] = [
                    'id' => $mk['id'],
                    'nama_matakuliah' => $mk['nama'],
                    'deskripsi' => isset($mk['deskripsi']) ? $mk['deskripsi'] : 'Pelajari materi kuliah ini sekarang.',
                    'jurusan_id' => $mk['jurusan_id'],
                    'nama_jurusan' => $jrs['nama_jurusan'],
                    'url' => base_url('matakuliah/' . strtolower(str_replace(' ', '', $mk['nama']))),
                    'icon' => $icon // Tambahkan icon ke data
                ];
            }
        }
        
        echo json_encode($all_matakuliah);
    }

    public function search() {
        $keyword = $this->input->get('keyword');
        $jurusan_id = $this->input->get('jurusan_id');
        
        $result = $this->Matakuliah_model->search($keyword, $jurusan_id);
        echo json_encode($result);
    }
} 