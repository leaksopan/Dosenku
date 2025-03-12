<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subbab_model extends CI_Model {
    
    private $table = 'subbab';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Ambil semua sub bab untuk bab tertentu
    public function getByBab($bab_id) {
        $this->db->where('bab_id', $bab_id);
        $this->db->order_by('urutan', 'ASC');
        return $this->db->get($this->table)->result_array();
    }
    
    // Ambil sub bab berdasarkan ID
    public function getById($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }
    
    // Tambah sub bab baru
    public function tambah($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    // Update sub bab
    public function ubah($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    
    // Hapus sub bab
    public function hapus($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    
    // Update urutan sub bab
    public function updateUrutan($id, $urutan) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['urutan' => $urutan]);
    }
} 