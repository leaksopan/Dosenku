<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Output $output
 * @property CI_Input $input
 * @property CI_Upload $upload
 * @property User_model $User_model 
 */
class Mengeloladosen extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model');
        $this->load->library('form_validation');
        
        if(!$this->session->userdata('logged_in') || 
           !in_array($this->session->userdata('role'), ['admin', 'dosen'])) {
            redirect('auth');
        }
    }
    
    public function index() {
        $data['title'] = 'Mengelola Akun Dosen';
        $data['dosen_list'] = $this->User_model->get_all_dosen();
        
        $this->load->view('templates/header', $data);
        $this->load->view('mengeloladosen/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Dosen';
            $this->load->view('templates/header', $data);
            $this->load->view('mengeloladosen/form');
            $this->load->view('templates/footer');
        } else {
            $data = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'email' => $this->input->post('email'),
                'role' => 'dosen',
                'is_active' => 1
            ];

            if($this->User_model->create_dosen($data)) {
                $this->session->set_flashdata('success', 'Data dosen berhasil ditambahkan');
                redirect('mengeloladosen');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data dosen');
                redirect('mengeloladosen/add');
            }
        }
    }

    public function edit($id) {
        $dosen = $this->User_model->get_dosen($id);
        if(!$dosen) {
            show_404();
        }

        $this->form_validation->set_rules('username', 'Username', 'required');
        if($dosen->username != $this->input->post('username')) {
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        }
        if($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
        }
        if($dosen->email != $this->input->post('email')) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        }

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Dosen';
            $data['dosen'] = $dosen;
            $this->load->view('templates/header', $data);
            $this->load->view('mengeloladosen/form', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email')
            ];

            if($this->input->post('password')) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            if($this->User_model->update_dosen($id, $data)) {
                $this->session->set_flashdata('success', 'Data dosen berhasil diupdate');
                redirect('mengeloladosen');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate data dosen');
                redirect('mengeloladosen/edit/'.$id);
            }
        }
    }

    public function delete($id) {
        $dosen = $this->User_model->get_dosen($id);
        if(!$dosen) {
            show_404();
        }

        if($this->User_model->delete_dosen($id)) {
            $this->session->set_flashdata('success', 'Data dosen berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data dosen');
        }
        redirect('mengeloladosen');
    }
} 