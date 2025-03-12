<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Session $session
 */
class Admin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Blog_model');
        
        // Cek apakah user adalah admin
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth');
        }
    }
    
    public function index() {
        $data['title'] = 'Dashboard Admin';
        $data['username'] = $this->session->userdata('username');
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function blog() {
        $data['title'] = 'Kelola Blog';
        $data['username'] = $this->session->userdata('username');
        $data['blogs'] = $this->Blog_model->getAll();
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/blog', $data);
        $this->load->view('templates/footer');
    }
    
    public function tambah_blog() {
        $data['title'] = 'Tambah Blog Baru';
        $data['username'] = $this->session->userdata('username');
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/tambah_blog', $data);
            $this->load->view('templates/footer');
        } else {
            // Upload gambar jika ada
            $gambar = '';
            if (!empty($_FILES['gambar']['name'])) {
                // Pastikan folder uploads/blog ada
                if (!is_dir('./uploads/blog')) {
                    mkdir('./uploads/blog', 0777, true);
                }
                
                $config['upload_path'] = './uploads/blog/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048; // 2MB
                
                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload('gambar')) {
                    // Jika upload gagal, tampilkan error
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('admin/tambah_blog');
                    return;
                } else {
                    // Jika upload berhasil, ambil nama file
                    $upload_data = $this->upload->data();
                    $gambar = $upload_data['file_name'];
                }
            }
            
            $data = [
                'judul' => $this->input->post('judul'),
                'konten' => $this->input->post('konten'),
                'gambar' => $gambar
            ];
            
            $this->Blog_model->tambah($data);
            $this->session->set_flashdata('success', 'Blog berhasil ditambahkan');
            redirect('admin/blog');
        }
    }
    
    public function edit_blog($id) {
        $data['title'] = 'Edit Blog';
        $data['username'] = $this->session->userdata('username');
        $data['blog'] = $this->Blog_model->getById($id);
        
        if (!$data['blog']) {
            show_404();
        }
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/edit_blog', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'judul' => $this->input->post('judul'),
                'konten' => $this->input->post('konten')
            ];
            
            // Upload gambar baru jika ada
            if (!empty($_FILES['gambar']['name'])) {
                // Pastikan folder uploads/blog ada
                if (!is_dir('./uploads/blog')) {
                    mkdir('./uploads/blog', 0777, true);
                }
                
                $config['upload_path'] = './uploads/blog/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048; // 2MB
                
                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload('gambar')) {
                    // Jika upload gagal, tampilkan error
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('admin/edit_blog/' . $id);
                    return;
                } else {
                    // Hapus gambar lama jika ada
                    $blog = $this->Blog_model->getById($id);
                    if ($blog['gambar'] && file_exists('./uploads/blog/' . $blog['gambar'])) {
                        unlink('./uploads/blog/' . $blog['gambar']);
                    }
                    
                    // Jika upload berhasil, ambil nama file
                    $upload_data = $this->upload->data();
                    $data['gambar'] = $upload_data['file_name'];
                }
            }
            
            $this->Blog_model->ubah($id, $data);
            $this->session->set_flashdata('success', 'Blog berhasil diperbarui');
            redirect('admin/blog');
        }
    }
    
    public function hapus_blog($id) {
        $blog = $this->Blog_model->getById($id);
        if (!$blog) {
            $this->session->set_flashdata('error', 'Blog tidak ditemukan');
            redirect('admin/blog');
        }
        
        // Hapus gambar jika ada
        if ($blog['gambar'] && file_exists('./uploads/blog/' . $blog['gambar'])) {
            unlink('./uploads/blog/' . $blog['gambar']);
        }
        
        $this->Blog_model->hapus($id);
        $this->session->set_flashdata('success', 'Blog berhasil dihapus');
        redirect('admin/blog');
    }
} 