<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property User_model $User_model
 */
class Profile extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['session', 'form_validation']);
        
        // Cek login
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }
    
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['title'] = 'Profile Saya';
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        
        $this->load->view('templates/header', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit() {
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);

        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        if($user->username != $this->input->post('username')) {
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
        }
        if($user->email != $this->input->post('email')) {
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('profile');
        } else {
            $data = [
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email')
            ];

            if($this->User_model->update_profile($user_id, $data)) {
                // Update session data jika username berubah
                if($data['username'] != $user->username) {
                    $this->session->set_userdata('username', $data['username']);
                }
                $this->session->set_flashdata('success', 'Profile berhasil diupdate');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate profile');
            }
            redirect('profile');
        }
    }
} 