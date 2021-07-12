<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenis_ibadah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("username") == NULL || $this->session->userdata("level") == NULL) {
            $this->session->set_flashdata('ci_password_flash_message', "Akses ditolak, silahkan login terlebih dahulu !!!");
            $this->session->set_flashdata('ci_password_flash_message_type', 'text-danger');
            return redirect("Welcome/login");
        }
        $this->load->library('form_validation');
        set_timezone("Asia/Jakarta");
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Jenis_ibadah/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Jenis_ibadah/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Jenis_ibadah/index';
            $config['first_url'] = base_url() . 'admin/Jenis_ibadah/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jenis_ibadah_model->total_rows($q);
        $jenis_ibadah = $this->Jenis_ibadah_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jenis_ibadah_data' => $jenis_ibadah,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'judul' => 'Jenis Ibadah',
            'konten' => 'admin/jenis_ibadah/jenis_ibadah_list',
            'start' => $start,
        );
        $this->load->view('admin/container', $data);
    }

    public function create()
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('admin/Jenis_ibadah/create_action'),
            'id' => set_value('id'),
            'jenis' => set_value('jenis'),
            'judul' => 'Tambah Jenis Ibadah',
            'konten' => 'admin/jenis_ibadah/jenis_ibadah_form',
        );
        $this->load->view('admin/container', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'jenis' => $this->input->post('jenis', TRUE),
            );

            $this->Jenis_ibadah_model->insert($data);
            $this->session->set_flashdata('message', 'Jenis Ibadah berhasil ditambahkan');
            redirect(site_url('admin/Jenis_ibadah'));
        }
    }

    public function update($id)
    {
        $row = $this->Jenis_ibadah_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/Jenis_ibadah/update_action'),
                'id' => set_value('id', $row->id),
                'jenis' => set_value('jenis', $row->jenis),
                'judul' => 'Ubah Jenis Ibadah',
                'konten' => 'admin/jenis_ibadah/jenis_ibadah_form',
            );
            $this->load->view('admin/container', $data);
        } else {
            $this->session->set_flashdata('message', 'Upss... Data tidak ditemukan !');
            redirect(site_url('admin/Jenis_ibadah'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'jenis' => $this->input->post('jenis', TRUE),
            );

            $this->Jenis_ibadah_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Jenis Ibadah berhasil diperbarui');
            redirect(site_url('admin/Jenis_ibadah'));
        }
    }

    public function delete($id)
    {
        $row = $this->Jenis_ibadah_model->get_by_id($id);

        if ($row) {
            $this->Jenis_ibadah_model->delete($id);
            $this->session->set_flashdata('message', 'Jenis Ibadah berhasil dihapus');
            redirect(site_url('admin/Jenis_ibadah'));
        } else {
            $this->session->set_flashdata('message', 'Upss... Data tidak ditemukan !');
            redirect(site_url('admin/Jenis_ibadah'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('jenis', 'jenis', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "jenis_ibadah.xls";
        $judul = "jenis_ibadah";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis");

        foreach ($this->Jenis_ibadah_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=jenis_ibadah.doc");

        $data = array(
            'jenis_ibadah_data' => $this->Jenis_ibadah_model->get_all(),
            'start' => 0
        );

        $this->load->view('jenis_ibadah/jenis_ibadah_doc', $data);
    }
}

/* End of file Jenis_ibadah.php */
/* Location: ./application/controllers/Jenis_ibadah.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-08 19:53:08 */
/* http://harviacode.com */