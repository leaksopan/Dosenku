<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bab_model extends CI_Model {
    
    private $table = 'bab';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Ambil semua bab untuk mata kuliah tertentu
    public function getByMatakuliah($matakuliah_id) {
        $this->db->where('matakuliah_id', $matakuliah_id);
        $this->db->order_by('urutan', 'ASC');
        return $this->db->get($this->table)->result_array();
    }
    
    // Ambil bab berdasarkan ID
    public function getById($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }
    
    // Tambah bab baru
    public function tambah($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    // Update bab
    public function ubah($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    
    // Hapus bab
    public function hapus($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    
    // Update urutan bab
    public function updateUrutan($id, $urutan) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['urutan' => $urutan]);
    }
} 