<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rayon extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("username") == NULL || $this->session->userdata("level") == NULL) {
            $this->session->set_flashdata('ci_password_flash_message', "Akses ditolak, silahkan login terlebih dahulu !!!");
            $this->session->set_flashdata('ci_password_flash_message_type', 'text-danger');
            return redirect("Welcome/login");
        }
        $this->load->model('Rayon_model');
        $this->load->library('form_validation');
        set_timezone("Asia/Jakarta");
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Rayon/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Rayon/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Rayon/index';
            $config['first_url'] = base_url() . 'admin/Rayon/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Rayon_model->total_rows($q);
        $rayon = $this->Rayon_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'rayon_data' => $rayon,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'judul' => 'Data Rayon',
            'konten' => 'admin/rayon/rayon_list',
            'start' => $start,
        );
        $this->load->view('admin/container', $data);
    }

    public function create()
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('admin/Rayon/create_action'),
            'id' => set_value('id'),
            'rayon' => set_value('rayon'),
            'judul' => 'Tambah Data Rayon',
            'konten' => 'admin/rayon/rayon_form',
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
                'rayon' => $this->input->post('rayon', TRUE),
            );

            $this->Rayon_model->insert($data);
            $this->session->set_flashdata('message', 'Rayon berhasil ditambahkan');
            redirect(site_url('admin/Rayon'));
        }
    }

    public function update($id)
    {
        $row = $this->Rayon_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/Rayon/update_action'),
                'id' => set_value('id', $row->id),
                'rayon' => set_value('rayon', $row->rayon),
                'judul' => 'Ubah Data Rayon',
                'konten' => 'admin/rayon/rayon_form',
            );
            $this->load->view('admin/container', $data);
        } else {
            $this->session->set_flashdata('message', 'Upss... Data tidak ditemukan !');
            redirect(site_url('rayon'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'rayon' => $this->input->post('rayon', TRUE),
            );

            $this->Rayon_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Rayon berhasil diperbarui');
            redirect(site_url('admin/Rayon'));
        }
    }

    public function delete($id)
    {
        $row = $this->Rayon_model->get_by_id($id);

        if ($row) {
            $this->Rayon_model->delete($id);
            $this->session->set_flashdata('message', 'Rayon berhasil dihapus');
            redirect(site_url('admin/Rayon'));
        } else {
            $this->session->set_flashdata('message', 'Upss... Data tidak ditemukan !');
            redirect(site_url('admin/Rayon'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('rayon', 'rayon', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "rayon.xls";
        $judul = "rayon";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Rayon");

        foreach ($this->Rayon_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->rayon);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=rayon.doc");

        $data = array(
            'rayon_data' => $this->Rayon_model->get_all(),
            'start' => 0
        );

        $this->load->view('rayon/rayon_doc', $data);
    }
}

/* End of file Rayon.php */
/* Location: ./application/controllers/Rayon.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-08 19:53:08 */
/* http://harviacode.com */