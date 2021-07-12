<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata("username")==NULL || $this->session->userdata("level") == NULL) {
            $this->session->set_flashdata('ci_password_flash_message', "Akses ditolak, silahkan login terlebih dahulu !!!");
            $this->session->set_flashdata('ci_password_flash_message_type', 'text-danger');
            return redirect("Welcome/login");
        }
        $this->load->model('Users_model');
        $this->load->library('form_validation');
        set_timezone("Asia/Jakarta");
    }

    public function index()
    {
        $data = array(
            'judul' => "Beranda",
            'konten' => "admin/home",
        );
        $this->load->view('admin/container', $data);
    }

    public function profile()
    {
        $id = $this->session->userdata("username");
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('admin/Dashboard/profile_action'),
                'username' => set_value('username', $row->username),
                'oldusername' => set_value('oldusername', $row->username),
                'password' => set_value('password', $row->password),
                'nama' => set_value('nama', $row->nama),
                'level' => set_value('level', $row->level),
                'judul' => 'Ubah Profil',
                'konten' => 'admin/users/users_form',
            );
            $this->load->view('admin/container', $data);
        } else {
            $this->session->set_flashdata('message', 'Upss... Data tidak ditemukan !');
            redirect(site_url('Welcome/logout'));
        }
    }

    public function profile_action()
    {
        $u =  $this->input->post("username", TRUE);
        $p = $this->input->post("password", TRUE);

        $data = array(
            'nama' => $this->input->post('nama', TRUE),
            'level' => $this->input->post('level', TRUE),
        );

        if ($u != $this->input->post('oldusername', TRUE)) {
            if ($this->db->where("username", $u)->get("users")->row()) {
                $this->session->set_flashdata('err_username', '<span class="text-danger">Username ini telah digunakan</span>');
                $this->profile($this->input->post('oldusername', TRUE));
                return FALSE;
            } else {
                $data["username"] = $u;
            }
        }

        if ($p != NULL) {
            $p = md5($p);
            $data["password"] = $p;
        }

        $this->Users_model->update($this->input->post('oldusername', TRUE), $data);

        if ($this->session->userdata('username') == $this->input->post('oldusername', TRUE)) {
            $this->session->set_userdata($data);
        }

        $this->session->set_flashdata('message', 'Akun berhasil diperbarui');
        redirect(site_url('admin/Dashboard'));
    }

    public function tentang()
    {
        $d = $this->db->select("jenis_ibadah.*, COUNT(notifikasi.id) AS jumlah_jemaat")->join("notifikasi", "jenis_ibadah.id = notifikasi.jenis_ibadah", "LEFT")->group_by("jenis_ibadah.id")->order_by("jenis_ibadah.id", "ASC")->get("jenis_ibadah")->result();
        $data = array(
            'data_jemaat' => $d,
            'judul' => 'Tentang',
            'konten' => 'tentang',
        );
        $this->load->view('admin/container', $data);
    }

    public function report()
    {
        $data = array(
            'judul' => "Laporan",
            'konten' => "admin/report",
        );
        $this->load->view('admin/container', $data);
    }
}