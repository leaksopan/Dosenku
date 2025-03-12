<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model {
    
    private $table = 'blog';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Ambil semua blog dengan pagination
    public function getAll($limit = 10, $offset = 0) {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table, $limit, $offset)->result_array();
    }
    
    // Hitung total blog untuk pagination
    public function countAll() {
        return $this->db->count_all($this->table);
    }
    
    // Ambil blog berdasarkan ID
    public function getById($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }
    
    // Tambah blog baru
    public function tambah($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    // Update blog
    public function ubah($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    
    // Hapus blog
    public function hapus($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    
    // Cari blog
    public function search($keyword) {
        $this->db->like('judul', $keyword);
        $this->db->or_like('konten', $keyword);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result_array();
    }
} 