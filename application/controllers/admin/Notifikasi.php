<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("username") == NULL || $this->session->userdata("level") == NULL) {
            $this->session->set_flashdata('ci_password_flash_message', "Akses ditolak, silahkan login terlebih dahulu !!!");
            $this->session->set_flashdata('ci_password_flash_message_type', 'text-danger');
            return redirect("Welcome/login");
        }
        $this->load->model('Notifikasi_model');
        $this->load->model('Notifikasi_view_model');
        $this->load->model('Jenis_ibadah_model');
        $this->load->library('form_validation');
        set_timezone("Asia/Jakarta");
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Notifikasi/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Notifikasi/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Notifikasi/index';
            $config['first_url'] = base_url() . 'admin/Notifikasi/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Notifikasi_view_model->total_rows($q);
        $notifikasi = $this->Notifikasi_view_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'notifikasi_data' => $notifikasi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul' => 'Notifikasi',
            'konten' => 'admin/notifikasi/notifikasi_list',
        );
        $this->load->view('admin/container', $data);
    }

    public function create()
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('admin/Notifikasi/create_action'),
            'id' => set_value('id'),
            'hp' => set_value('hp'),
            'nama' => set_value('nama'),
            'jenis_ibadah' => set_value('jenis_ibadah'),
            'judul' => 'Tambah Notifikasi',
            'konten' => 'admin/notifikasi/notifikasi_form',
            'data_jenis_ibadah' => $this->Jenis_ibadah_model->get_all()
        );
        $this->load->view('admin/container', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $hp = $this->input->post('hp', TRUE);
            if(substr($hp, 0, 1) == "+"){
                $hp = substr($hp, 1);
            };
            if (substr($hp, 0, 1) == "0") {
                $hp = "62" . substr($hp, 1);
            };

            $data = array(
                'hp' => $hp,
                'nama' => $this->input->post('nama', TRUE),
                'jenis_ibadah' => $this->input->post('jenis_ibadah', TRUE),
            );

            $this->Notifikasi_model->insert($data);
            $this->session->set_flashdata('message', 'Notifikasi berhasil ditambahkan');
            redirect(site_url('admin/Notifikasi'));
        }
    }

    public function update($id)
    {
        $row = $this->Notifikasi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/Notifikasi/update_action'),
                'id' => set_value('id', $row->id),
                'hp' => set_value('hp', $row->hp),
                'nama' => set_value('nama', $row->nama),
                'jenis_ibadah' => set_value('jenis_ibadah', $row->jenis_ibadah),
                'judul' => 'Ubah Notifikasi',
                'konten' => 'admin/notifikasi/notifikasi_form',
                'data_jenis_ibadah' => $this->Jenis_ibadah_model->get_all()
            );
            $this->load->view('admin/container', $data);
        } else {
            $this->session->set_flashdata('message', 'Upss... Data tidak ditemukan !');
            redirect(site_url('admin/Notifikasi'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $hp = $this->input->post('hp', TRUE);
            if (substr($hp, 0, 1) == "+") {
                $hp = substr($hp, 1);
            };
            if (substr($hp, 0, 1) == "0") {
                $hp = "62" . substr($hp, 1);
            };

            $data = array(
                'hp' => $hp,
                'nama' => $this->input->post('nama', TRUE),
                'jenis_ibadah' => $this->input->post('jenis_ibadah', TRUE),
            );

            $this->Notifikasi_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Notifikasi berhasil diperbarui');
            redirect(site_url('admin/Notifikasi'));
        }
    }

    public function delete($id)
    {
        $row = $this->Notifikasi_model->get_by_id($id);

        if ($row) {
            $this->Notifikasi_model->delete($id);
            $this->session->set_flashdata('message', 'Notifikasi berhasil dihapus');
            redirect(site_url('admin/Notifikasi'));
        } else {
            $this->session->set_flashdata('message', 'Upss... Data tidak ditemukan !');
            redirect(site_url('admin/Notifikasi'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('hp', 'hp', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('jenis_ibadah', 'jenis ibadah', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "notifikasi.xls";
        $judul = "notifikasi";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Hp");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Ibadah");

        foreach ($this->Notifikasi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->hp);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis_ibadah);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function cetak()
    {
        $data = array(
            'notifikasi_data' => $this->Notifikasi_view_model->get_all(),
            'start' => 0
        );

        $this->load->view('admin/notifikasi/notifikasi_doc', $data);
    }
}

/* End of file Notifikasi.php */
/* Location: ./application/controllers/Notifikasi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-08 19:53:08 */
/* http://harviacode.com */