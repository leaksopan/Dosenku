<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi_model extends CI_Model {
    
    private $table = 'materi';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Ambil semua materi untuk sub bab tertentu
    public function getBySubBab($sub_bab_id) {
        return $this->db
            ->where('sub_bab_id', $sub_bab_id)
            ->order_by('urutan', 'ASC')
            ->get($this->table)
            ->result_array();
    }
    
    public function getById($id) {
        return $this->db
            ->where('id', $id)
            ->get($this->table)
            ->row_array();
    }
    
    // Tambah materi baru
    public function tambah($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    // Update materi
    public function ubah($id, $data) {
        return $this->db
            ->where('id', $id)
            ->update($this->table, $data);
    }
    
    // Hapus materi
    public function hapus($id) {
        return $this->db
            ->where('id', $id)
            ->delete($this->table);
    }
    
    // Update urutan materi
    public function updateUrutan($id, $urutan) {
        $this->db->where('id', $id);
        return $this->db->update('materi', ['urutan' => $urutan]);
    }
    
    // Upload file lampiran
    public function uploadLampiran($id, $file_name) {
        $this->db->where('id', $id);
        return $this->db->update('materi', ['file_lampiran' => $file_name]);
    }
} 