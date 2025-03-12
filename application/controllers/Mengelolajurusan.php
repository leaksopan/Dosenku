<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property Jurusan_model $Jurusan_model
 * @property CI_Input $input
 */
class Mengelolajurusan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Jurusan_model');
    }

    public function index()
    {
        $data['title'] = 'Mengelola Jurusan';
        $data['user'] = $this->session->userdata();
        $data['jurusan'] = $this->Jurusan_model->getAll();
        
        $this->load->view('templates/header', $data);
        $this->load->view('mengelolajurusan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data = [
            'nama' => $this->input->post('nama_jurusan')
        ];

        $this->Jurusan_model->insert($data);
        $this->session->set_flashdata('message', 'Jurusan berhasil ditambahkan');
        redirect('mengelolajurusan');
    }

    public function ubah()
    {
        $id = $this->input->post('id');
        $data = [
            'nama' => $this->input->post('nama_jurusan')
        ];

        $this->Jurusan_model->update($id, $data);
        $this->session->set_flashdata('message', 'Jurusan berhasil diubah');
        redirect('mengelolajurusan');
    }

    public function hapus($id)
    {
        $this->Jurusan_model->delete($id);
        $this->session->set_flashdata('message', 'Jurusan berhasil dihapus');
        redirect('mengelolajurusan');
    }
} 