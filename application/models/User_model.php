<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    private $table = 'users';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Create
    public function create_dosen($data) {
        return $this->db->insert($this->table, $data);
    }
    
    // Read
    public function get_all_dosen() {
        $this->db->where('role', 'dosen');
        return $this->db->get($this->table)->result();
    }
    
    public function get_dosen($id) {
        $this->db->where('id', $id);
        $this->db->where('role', 'dosen');
        return $this->db->get($this->table)->row();
    }

    public function get_user_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }
    
    // Update
    public function update_profile($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function update_dosen($id, $data) {
        $this->db->where('id', $id);
        $this->db->where('role', 'dosen');
        return $this->db->update($this->table, $data);
    }
    
    // Delete
    public function delete_dosen($id) {
        $this->db->where('id', $id);
        $this->db->where('role', 'dosen');
        return $this->db->delete($this->table);
    }
    
    // Check if username exists
    public function is_username_exists($username, $exclude_id = null) {
        $this->db->where('username', $username);
        if($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->get($this->table)->num_rows() > 0;
    }

    // Check if email exists
    public function is_email_exists($email, $exclude_id = null) {
        $this->db->where('email', $email);
        if($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->get($this->table)->num_rows() > 0;
    }

    public function get_user_by_username($username) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('username', $username);
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        
        // Debug query
        error_log("SQL Query: " . $this->db->last_query());
        $result = $query->row();
        error_log("Query result: " . print_r($result, true));
        
        return $result;
    }

    public function update_last_login($user_id) {
        $this->db->where('id', $user_id);
        $this->db->update($this->table, ['last_login' => date('Y-m-d H:i:s')]);
    }

    // Seed default users
    public function seed_default_users() {
        $default_users = [
            [
                'username' => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'email' => 'admin@dosenku.com',
                'role' => 'admin',
                'is_active' => 1
            ],
            [
                'username' => 'dosen',
                'password' => password_hash('dosen123', PASSWORD_DEFAULT),
                'email' => 'dosen@dosenku.com',
                'role' => 'dosen',
                'is_active' => 1
            ],
            [
                'username' => 'mahasiswa',
                'password' => password_hash('mhs123', PASSWORD_DEFAULT),
                'email' => 'mhs@dosenku.com',
                'role' => 'mahasiswa',
                'is_active' => 1
            ]
        ];

        // Hapus data user lama jika ada
        $this->db->where_in('username', ['admin', 'dosen', 'mahasiswa']);
        $this->db->delete($this->table);

        // Insert user baru
        foreach ($default_users as $user) {
            $this->db->insert($this->table, $user);
        }
    }
} 