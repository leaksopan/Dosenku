<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('blog_model');
    }
    
    public function index() {
        // Konfigurasi pagination
        $config['base_url'] = base_url('blog/index');
        $config['total_rows'] = $this->blog_model->countAll();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        
        // Style pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['blogs'] = $this->blog_model->getAll($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        $data['is_admin'] = $this->session->userdata('role') === 'admin';
        
        $this->load->view('templates/header', $data);
        $this->load->view('blog/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function view($id) {
        $data['blog'] = $this->blog_model->getById($id);
        if (!$data['blog']) {
            show_404();
        }
        
        $data['is_admin'] = $this->session->userdata('role') === 'admin';
        
        $this->load->view('templates/header', $data);
        $this->load->view('blog/view', $data);
        $this->load->view('templates/footer');
    }
    
    public function tambah() {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('blog');
        }
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('blog/tambah');
            $this->load->view('templates/footer');
        } else {
            // Upload gambar jika ada
            $gambar = '';
            if (!empty($_FILES['gambar']['name'])) {
                $config['upload_path'] = './uploads/blog/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048; // 2MB
                
                $this->load->library('upload', $config);
                
                if ($this->upload->do_upload('gambar')) {
                    $gambar = $this->upload->data('file_name');
                }
            }
            
            $data = [
                'judul' => $this->input->post('judul'),
                'konten' => $this->input->post('konten'),
                'gambar' => $gambar
            ];
            
            $this->blog_model->tambah($data);
            redirect('blog');
        }
    }
    
    public function edit($id) {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('blog');
        }
        
        $data['blog'] = $this->blog_model->getById($id);
        if (!$data['blog']) {
            show_404();
        }
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('blog/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'judul' => $this->input->post('judul'),
                'konten' => $this->input->post('konten')
            ];
            
            // Upload gambar baru jika ada
            if (!empty($_FILES['gambar']['name'])) {
                $config['upload_path'] = './uploads/blog/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048; // 2MB
                
                $this->load->library('upload', $config);
                
                if ($this->upload->do_upload('gambar')) {
                    // Hapus gambar lama jika ada
                    if ($data['blog']['gambar'] && file_exists('./uploads/blog/' . $data['blog']['gambar'])) {
                        unlink('./uploads/blog/' . $data['blog']['gambar']);
                    }
                    $data['gambar'] = $this->upload->data('file_name');
                }
            }
            
            $this->blog_model->ubah($id, $data);
            redirect('blog');
        }
    }
    
    public function hapus($id) {
        if ($this->session->userdata('role') !== 'admin') {
            return $this->output->set_status_header(403)->set_output(json_encode(['error' => 'Forbidden']));
        }
        
        $blog = $this->blog_model->getById($id);
        if (!$blog) {
            return $this->output->set_status_header(404)->set_output(json_encode(['error' => 'Blog tidak ditemukan']));
        }
        
        // Hapus gambar jika ada
        if ($blog['gambar'] && file_exists('./uploads/blog/' . $blog['gambar'])) {
            unlink('./uploads/blog/' . $blog['gambar']);
        }
        
        if ($this->blog_model->hapus($id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menghapus blog']);
        }
    }
    
    public function search() {
        $keyword = $this->input->get('keyword');
        $data['blogs'] = $this->blog_model->search($keyword);
        $data['is_admin'] = $this->session->userdata('role') === 'admin';
        
        $this->load->view('templates/header', $data);
        $this->load->view('blog/index', $data);
        $this->load->view('templates/footer');
    }
} 