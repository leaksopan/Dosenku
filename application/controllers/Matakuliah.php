<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_Output $output
 * @property CI_Input $input
 * @property CI_Upload $upload
 * @property Bab_model $bab_model
 * @property Subbab_model $subbab_model
 * @property Materi_model $materi_model
 * @property Matakuliah_model $matakuliah_model
 */
class Matakuliah extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        // Load models
        $this->load->model('bab_model');
        $this->load->model('subbab_model');
        $this->load->model('materi_model');
        $this->load->model('matakuliah_model');
    }
    
    public function matematikadasar() {
        // Get matakuliah ID
        $matakuliah = $this->matakuliah_model->getByNama('MatematikaDasar');
        if (!$matakuliah) {
            show_404();
        }
        
        // Get all bab
        $data['bab'] = $this->bab_model->getByMatakuliah($matakuliah['id']);
        
        // Get sub bab and materi for each bab
        foreach ($data['bab'] as &$bab) {
            $bab['sub_bab'] = $this->subbab_model->getByBab($bab['id']);
        }
        
        $data['title'] = 'Matematika Dasar';
        $data['matakuliah'] = $matakuliah;
        $data['is_admin'] = $this->session->userdata('role') === 'admin';
        
        $this->load->view('templates/header', $data);
        $this->load->view('matakuliah/matematikadasar', $data);
        $this->load->view('templates/footer');
    }

    public function view($sub_bab_id) {
        // Get sub bab data
        $subbab = $this->subbab_model->getById($sub_bab_id);
        if (!$subbab) {
            show_404();
        }

        // Get bab data
        $bab = $this->bab_model->getById($subbab['bab_id']);
        if (!$bab) {
            show_404();
        }

        // Get matakuliah data
        $matakuliah = $this->matakuliah_model->getById($bab['matakuliah_id']);
        if (!$matakuliah) {
            show_404();
        }

        // Get materi for this sub bab
        $data['materi'] = $this->materi_model->getBySubBab($sub_bab_id);
        $data['sub_bab'] = $subbab;
        $data['bab'] = $bab;
        $data['matakuliah'] = $matakuliah;
        $data['title'] = $matakuliah['nama'] . ' - ' . $bab['judul'] . ' - ' . $subbab['nama_sub_bab'];
        $data['is_admin'] = $this->session->userdata('role') === 'admin';

        $this->load->view('templates/header', $data);
        $this->load->view('matakuliah/view', $data);
        $this->load->view('templates/footer');
    }
    
    // AJAX endpoints untuk admin
    public function tambah_bab() {
        if ($this->session->userdata('role') !== 'admin') {
            return $this->output->set_status_header(403)->set_output(json_encode(['error' => 'Forbidden']));
        }
        
        $data = [
            'matakuliah_id' => $this->input->post('matakuliah_id'),
            'judul' => $this->input->post('nama_bab'),
            'deskripsi' => $this->input->post('nama_bab'),
            'urutan' => $this->input->post('urutan')
        ];
        
        $id = $this->bab_model->tambah($data);
        if ($id) {
            echo json_encode(['success' => true, 'id' => $id]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan bab']);
        }
    }
    
    public function tambah_sub_bab() {
        if ($this->session->userdata('role') !== 'admin') {
            return $this->output->set_status_header(403)->set_output(json_encode(['error' => 'Forbidden']));
        }
        
        $data = [
            'bab_id' => $this->input->post('bab_id'),
            'nama_sub_bab' => $this->input->post('nama_sub_bab'),
            'urutan' => $this->input->post('urutan')
        ];
        
        $id = $this->subbab_model->tambah($data);
        echo json_encode(['success' => true, 'id' => $id]);
    }
    
    public function tambah_materi() {
        if ($this->session->userdata('role') !== 'admin') {
            return $this->output->set_status_header(403)->set_output(json_encode(['error' => 'Forbidden']));
        }
        
        $data = [
            'sub_bab_id' => $this->input->post('sub_bab_id'),
            'judul' => $this->input->post('judul'),
            'konten' => $this->input->post('konten'),
            'urutan' => $this->input->post('urutan')
        ];
        
        // Handle file upload if exists
        if (!empty($_FILES['file_lampiran']['name'])) {
            $config['upload_path'] = './uploads/materi/';
            $config['allowed_types'] = 'pdf|doc|docx|ppt|pptx';
            $config['max_size'] = 10240; // 10MB
            
            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload('file_lampiran')) {
                $data['file_lampiran'] = $this->upload->data('file_name');
            }
        }
        
        $id = $this->materi_model->tambah($data);
        echo json_encode(['success' => true, 'id' => $id]);
    }

    // Method untuk mendapatkan data bab untuk diedit
    public function get_bab($id) {
        if ($this->session->userdata('role') !== 'admin') {
            return $this->output->set_status_header(403)->set_output(json_encode(['error' => 'Forbidden']));
        }

        $bab = $this->bab_model->getById($id);
        if ($bab) {
            echo json_encode(['success' => true, 'data' => $bab]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Bab tidak ditemukan']);
        }
    }

    // Method untuk menyimpan perubahan bab
    public function edit_bab() {
        if ($this->session->userdata('role') !== 'admin') {
            return $this->output->set_status_header(403)->set_output(json_encode(['error' => 'Forbidden']));
        }

        $id = $this->input->post('id');
        $data = [
            'judul' => $this->input->post('judul'),
            'deskripsi' => $this->input->post('deskripsi'),
            'urutan' => $this->input->post('urutan')
        ];

        if ($this->bab_model->ubah($id, $data)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal mengubah bab']);
        }
    }

    // Method untuk mendapatkan data sub bab untuk diedit
    public function get_sub_bab($id) {
        if ($this->session->userdata('role') !== 'admin') {
            return $this->output->set_status_header(403)->set_output(json_encode(['error' => 'Forbidden']));
        }

        $sub_bab = $this->subbab_model->getById($id);
        if ($sub_bab) {
            echo json_encode(['success' => true, 'data' => $sub_bab]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Sub bab tidak ditemukan']);
        }
    }

    // Method untuk menyimpan perubahan sub bab
    public function edit_sub_bab() {
        if ($this->session->userdata('role') !== 'admin') {
            return $this->output->set_status_header(403)->set_output(json_encode(['error' => 'Forbidden']));
        }

        $id = $this->input->post('id');
        $data = [
            'nama_sub_bab' => $this->input->post('nama_sub_bab'),
            'urutan' => $this->input->post('urutan')
        ];

        if ($this->subbab_model->ubah($id, $data)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal mengubah sub bab']);
        }
    }

    // Method untuk mendapatkan data materi untuk diedit
    public function get_materi($id) {
        if ($this->session->userdata('role') !== 'admin') {
            return $this->output->set_status_header(403)->set_output(json_encode(['error' => 'Forbidden']));
        }

        $materi = $this->materi_model->getById($id);
        if ($materi) {
            echo json_encode(['success' => true, 'data' => $materi]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Materi tidak ditemukan']);
        }
    }

    // Method untuk menyimpan perubahan materi
    public function edit_materi() {
        if ($this->session->userdata('role') !== 'admin') {
            return $this->output->set_status_header(403)->set_output(json_encode(['error' => 'Forbidden']));
        }

        $id = $this->input->post('id');
        $data = [
            'judul' => $this->input->post('judul'),
            'konten' => $this->input->post('konten'),
            'urutan' => $this->input->post('urutan')
        ];

        // Handle file upload if exists
        if (!empty($_FILES['file_lampiran']['name'])) {
            $config['upload_path'] = './uploads/materi/';
            $config['allowed_types'] = 'pdf|doc|docx|ppt|pptx';
            $config['max_size'] = 10240; // 10MB
            
            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload('file_lampiran')) {
                // Hapus file lama jika ada
                $old_file = $this->materi_model->getById($id)['file_lampiran'];
                if ($old_file && file_exists('./uploads/materi/' . $old_file)) {
                    unlink('./uploads/materi/' . $old_file);
                }
                $data['file_lampiran'] = $this->upload->data('file_name');
            }
        }

        if ($this->materi_model->ubah($id, $data)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal mengubah materi']);
        }
    }

    // Method untuk menghapus materi
    public function hapus_materi($id) {
        if ($this->session->userdata('role') !== 'admin') {
            return $this->output->set_status_header(403)->set_output(json_encode(['error' => 'Forbidden']));
        }

        // Hapus file lampiran jika ada
        $materi = $this->materi_model->getById($id);
        if ($materi && $materi['file_lampiran'] && file_exists('./uploads/materi/' . $materi['file_lampiran'])) {
            unlink('./uploads/materi/' . $materi['file_lampiran']);
        }

        if ($this->materi_model->hapus($id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menghapus materi']);
        }
    }

    public function mekanikatanah() {
        // Get matakuliah ID
        $matakuliah = $this->matakuliah_model->getByNama('Mekanika Tanah');
        if (!$matakuliah) {
            show_404();
        }
        
        // Get all bab
        $data['bab'] = $this->bab_model->getByMatakuliah($matakuliah['id']);
        
        // Get sub bab and materi for each bab
        foreach ($data['bab'] as &$bab) {
            $bab['sub_bab'] = $this->subbab_model->getByBab($bab['id']);
        }
        
        $data['title'] = 'Mekanika Tanah';
        $data['matakuliah'] = $matakuliah;
        $data['is_admin'] = $this->session->userdata('role') === 'admin';
        
        $this->load->view('templates/header', $data);
        $this->load->view('matakuliah/mekanikatanah', $data);
        $this->load->view('templates/footer');
    }

    public function strukturbeton() {
        // Get matakuliah ID
        $matakuliah = $this->matakuliah_model->getByNama('Struktur Beton');
        if (!$matakuliah) {
            show_404();
        }
        
        // Get all bab
        $data['bab'] = $this->bab_model->getByMatakuliah($matakuliah['id']);
        
        // Get sub bab and materi for each bab
        foreach ($data['bab'] as &$bab) {
            $bab['sub_bab'] = $this->subbab_model->getByBab($bab['id']);
        }
        
        $data['title'] = 'Struktur Beton';
        $data['matakuliah'] = $matakuliah;
        $data['is_admin'] = $this->session->userdata('role') === 'admin';
        
        $this->load->view('templates/header', $data);
        $this->load->view('matakuliah/strukturbeton', $data);
        $this->load->view('templates/footer');
    }

    public function hapus_bab($id) {
        if ($this->session->userdata('role') !== 'admin') {
            return $this->output->set_status_header(403)->set_output(json_encode(['error' => 'Forbidden']));
        }

        // Get semua sub bab dari bab ini
        $sub_babs = $this->subbab_model->getByBab($id);
        
        // Hapus semua materi dari setiap sub bab
        foreach ($sub_babs as $sub_bab) {
            $materis = $this->materi_model->getBySubBab($sub_bab['id']);
            foreach ($materis as $materi) {
                // Hapus file lampiran jika ada
                if ($materi['file_lampiran'] && file_exists('./uploads/materi/' . $materi['file_lampiran'])) {
                    unlink('./uploads/materi/' . $materi['file_lampiran']);
                }
                $this->materi_model->hapus($materi['id']);
            }
            // Hapus sub bab
            $this->subbab_model->hapus($sub_bab['id']);
        }

        // Hapus bab
        if ($this->bab_model->hapus($id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menghapus bab']);
        }
    }

    public function hapus_sub_bab($id) {
        if ($this->session->userdata('role') !== 'admin') {
            return $this->output->set_status_header(403)->set_output(json_encode(['error' => 'Forbidden']));
        }

        // Get semua materi dari sub bab ini
        $materis = $this->materi_model->getBySubBab($id);
        
        // Hapus semua materi dan file lampirannya
        foreach ($materis as $materi) {
            // Hapus file lampiran jika ada
            if ($materi['file_lampiran'] && file_exists('./uploads/materi/' . $materi['file_lampiran'])) {
                unlink('./uploads/materi/' . $materi['file_lampiran']);
            }
            $this->materi_model->hapus($materi['id']);
        }

        // Hapus sub bab
        if ($this->subbab_model->hapus($id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menghapus sub bab']);
        }
    }

} 



