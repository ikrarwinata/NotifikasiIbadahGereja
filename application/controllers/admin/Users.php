<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("username") == NULL || $this->session->userdata("level") != "superadmin") {
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
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Users/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Users/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Users/index';
            $config['first_url'] = base_url() . 'admin/Users/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Users_model->total_rows($q);
        $users = $this->Users_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'users_data' => $users,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul' => 'Akun Pengguna',
            'konten' => 'admin/users/users_list',
        );
        $this->load->view('admin/container', $data);
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/Users/create_action'),
            'username' => set_value('username'),
            'password' => set_value('password'),
            'nama' => set_value('nama'),
            'level' => set_value('level'),
        );
        $this->load->view('users/users_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'password' => $this->input->post('password', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'level' => $this->input->post('level', TRUE),
            );

            $this->Users_model->insert($data);
            $this->session->set_flashdata('message', 'Akun berhasil ditambahkan');
            redirect(site_url('admin/Users'));
        }
    }

    public function update($id)
    {
        $id = urldecode($id);
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/Users/update_action'),
                'username' => set_value('username', $row->username),
                'oldusername' => set_value('oldusername', $row->username),
                'password' => set_value('password', $row->password),
                'nama' => set_value('nama', $row->nama),
                'level' => set_value('level', $row->level),
                'judul' => 'Ubah Akun Pengguna',
                'konten' => 'admin/users/users_form',
            );
            $this->load->view('admin/container', $data);
        } else {
            $this->session->set_flashdata('message', 'Upss... Data tidak ditemukan !');
            redirect(site_url('admin/Users'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update(urlencode($this->input->post('oldusername', TRUE)));
        } else {
            $u =  $this->input->post("username", TRUE);
            $p = $this->input->post("password", TRUE);

            $data = array(
                'nama' => $this->input->post('nama', TRUE),
                'level' => $this->input->post('level', TRUE),
            );

            if($u != $this->input->post('oldusername', TRUE)){
                if($this->db->where("username", $u)->get("users")->row()) {
                    $this->session->set_flashdata('err_username', '<span class="text-danger">Username ini telah digunakan</span>');
                    $this->update(urlencode($this->input->post('oldusername', TRUE)));
                    return FALSE;
                }else{
                    $data["username"] = $u;
                }
            }

            if($p != NULL){
                $p = md5($p);
                $data["password"] = $p;
            }

            $this->Users_model->update($this->input->post('oldusername', TRUE), $data);

            if($this->session->userdata('username') == $this->input->post('oldusername', TRUE)) {
                $this->session->set_userdata($data);
            }

            $this->session->set_flashdata('message', 'Akun berhasil diperbarui');
            redirect(site_url('admin/Users'));
        }
    }

    public function delete($id)
    {
        $id = urldecode($id);
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $this->Users_model->delete($id);
            $this->session->set_flashdata('message', 'Akun berhasil dihapus');
            redirect(site_url('admin/Users'));
        } else {
            $this->session->set_flashdata('message', 'Upss... Data tidak ditemukan !');
            redirect(site_url('admin/Users'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('level', 'level', 'trim|required');

        $this->form_validation->set_rules('username', 'username', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "users.xls";
        $judul = "users";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Password");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Level");

        foreach ($this->Users_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->password);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->level);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function cetak()
    {
        $data = array(
            'users_data' => $this->Users_model->get_all(),
            'start' => 0,
            'app_name' => $this->db->where("nama", "nama_aplikasi")->get("tentang")->row()->nilai
        );

        $this->load->view('admin/users/users_doc', $data);
    }
}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-08 19:53:08 */
/* http://harviacode.com */