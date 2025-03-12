<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property User_model $User_model
 */
class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['form_validation', 'session']);
    }

    public function index() {
        if($this->session->userdata('logged_in')) {
            redirect('home');
        }
        $this->load->view('auth/login');
    }

    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        // Debug input
        error_log("Username: " . $username);
        error_log("Password: " . $password);
        
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('auth');
        } else {
            $user = $this->User_model->get_user_by_username($username);
            
            // Debug database result
            error_log("User found: " . ($user ? "yes" : "no"));
            if ($user) {
                error_log("DB Password: " . $user->password);
            }
            
            // Debug
            if (!$user) {
                $this->session->set_flashdata('error', 'Username tidak ditemukan');
                redirect('auth');
            }
            
            // Use password_verify
            if (password_verify($password, $user->password)) {
                $data = [
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role,
                    'logged_in' => TRUE
                ];
                
                $this->User_model->update_last_login($user->id);
                $this->session->set_userdata($data);
                redirect('home');
            } else {
                $this->session->set_flashdata('error', 'Password salah!');
                redirect('auth');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
} 