<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Matakuliah_model extends CI_Model
{
    private $table = 'matakuliah';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $this->db->select('matakuliah.*, jurusan.nama as nama_jurusan');
        $this->db->from($this->table);
        $this->db->join('jurusan', 'jurusan.id = matakuliah.jurusan_id', 'left');
        return $this->db->get()->result_array();
    }

    public function getByJurusan($jurusan_id)
    {
        $this->db->select('matakuliah.*, jurusan.nama as nama_jurusan');
        $this->db->from($this->table);
        $this->db->join('jurusan', 'jurusan.id = matakuliah.jurusan_id', 'left');
        $this->db->where('jurusan_id', $jurusan_id);
        return $this->db->get()->result_array();
    }

    public function getByNama($nama)
    {
        return $this->db->get_where($this->table, ['nama' => $nama])->row_array();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function insert($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->update($this->table, $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function search($keyword, $jurusan_id = null) {
        $this->db->select('matakuliah.*, jurusan.nama as nama_jurusan');
        $this->db->from($this->table);
        $this->db->join('jurusan', 'jurusan.id = matakuliah.jurusan_id', 'left');
        $this->db->like('matakuliah.nama', $keyword);
        
        if ($jurusan_id) {
            $this->db->where('jurusan_id', $jurusan_id);
        }
        
        return $this->db->get()->result_array();
    }
} 