<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property Matakuliah_model $Matakuliah_model
 * @property Jurusan_model $Jurusan_model
 * @property CI_Input $input
 */
class Mengelolamatakuliah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Matakuliah_model');
        $this->load->model('Jurusan_model');
    }

    public function index()
    {
        $data['title'] = 'Mengelola Mata Kuliah';
        $data['user'] = $this->session->userdata();
        $data['matakuliah'] = $this->Matakuliah_model->getAll();
        $data['jurusan'] = $this->Jurusan_model->getAll();
        
        $this->load->view('templates/header', $data);
        $this->load->view('mengelolamatakuliah/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'jurusan_id' => $this->input->post('jurusan_id'),
            'icon' => $this->input->post('icon')
        ];

        $this->Matakuliah_model->insert($data);
        $this->session->set_flashdata('message', 'Mata kuliah berhasil ditambahkan');
        redirect('mengelolamatakuliah');
    }

    public function ubah()
    {
        $id = $this->input->post('id');
        $data = [
            'nama' => $this->input->post('nama'),
            'jurusan_id' => $this->input->post('jurusan_id'),
            'icon' => $this->input->post('icon')
        ];

        $this->Matakuliah_model->update($id, $data);
        $this->session->set_flashdata('message', 'Mata kuliah berhasil diubah');
        redirect('mengelolamatakuliah');
    }

    public function hapus($id)
    {
        $this->Matakuliah_model->delete($id);
        $this->session->set_flashdata('message', 'Mata kuliah berhasil dihapus');
        redirect('mengelolamatakuliah');
    }
} 