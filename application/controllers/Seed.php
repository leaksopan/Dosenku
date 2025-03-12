<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property User_model $User_model
 */

class Seed extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Only allow in development
        if (ENVIRONMENT !== 'development') {
            show_404();
        }
        $this->load->model('User_model');
    }
    
    public function users() {
        $this->User_model->seed_default_users();
        echo "Default users seeded successfully!";
    }
} 