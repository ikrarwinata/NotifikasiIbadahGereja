<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tata_ibadah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("username") == NULL || $this->session->userdata("level") == NULL) {
            $this->session->set_flashdata('ci_password_flash_message', "Akses ditolak, silahkan login terlebih dahulu !!!");
            $this->session->set_flashdata('ci_password_flash_message_type', 'text-danger');
            return redirect("Welcome/login");
        }
        $this->load->model('Tata_ibadah_model');
        $this->load->library('form_validation');
        set_timezone("Asia/Jakarta");
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Tata_ibadah/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Tata_ibadah/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Tata_ibadah/index';
            $config['first_url'] = base_url() . 'admin/Tata_ibadah/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tata_ibadah_model->total_rows($q);
        $tata_ibadah = $this->Tata_ibadah_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tata_ibadah_data' => $tata_ibadah,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul' => 'Tata Ibadah',
            'konten' => 'admin/tata_ibadah/tata_ibadah_list',
        );
        $this->load->view('admin/container', $data);
    }

    public function create()
    {
        $totalTata = $this->Tata_ibadah_model->count_all();
        $kode = "TTB" . strtotime("now") . ($totalTata + 1);
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('admin/Tata_ibadah/create_action'),
            'kode' => set_value('kode', $kode),
            'waktu' => set_value('waktu'),
            'file_path' => set_value('file_path'),
            'judul' => 'Tambah Tata Ibadah',
            'konten' => 'admin/tata_ibadah/tata_ibadah_form',
        );
        $this->load->view('admin/container', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $config['upload_path']          = './files/tata_ibadah';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 2048;
            $this->load->library('upload', $config);

            $waktu = strtotime(format_date($this->input->post('waktu', TRUE)));
            $data = array(
                'kode' => $this->input->post('kode', TRUE),
                'waktu' => $waktu,
            );

            if ($this->upload->do_upload('file')) {
                $file = $config['upload_path'] . "/" . "Tata_ibadah_" . strtotime("now") . $this->upload->data("file_ext");
                rename($this->upload->data("full_path"), $file);
                $data['file_path'] = $file;
            }

            $this->Tata_ibadah_model->insert($data);
            $this->session->set_flashdata('message', 'Data berhasil ditambah');
            redirect(site_url('admin/Tata_ibadah'));
        }
    }

    public function update($id)
    {
        $row = $this->Tata_ibadah_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/Tata_ibadah/update_action'),
                'kode' => set_value('kode', $row->kode),
                'waktu' => set_value('waktu', $row->waktu),
                'file_path' => set_value('file_path', $row->file_path),
                'judul' => 'Ubah Tata Ibadah',
                'konten' => 'admin/tata_ibadah/tata_ibadah_form',
            );
            $this->load->view('admin/container', $data);
        } else {
            $this->session->set_flashdata('message', 'Upss... Data tidak ditemukan !');
            redirect(site_url('admin/Tata_ibadah'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('oldkode', TRUE));
        } else {
            $config['upload_path']          = './files/tata_ibadah';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 2048;
            $this->load->library('upload', $config);

            $waktu = strtotime(format_date($this->input->post('waktu', TRUE)));
            $data = array(
                'kode' => $this->input->post('kode', TRUE),
                'waktu' => $waktu,
            );

            if ($this->upload->do_upload('file')) {
                $file = $config['upload_path'] . "/" . "Tata_ibadah_" . strtotime("now") . $this->upload->data("file_ext");
                rename($this->upload->data("full_path"), $file);
                $data['file_path'] = $file;
            }

            $this->Tata_ibadah_model->update($this->input->post('oldkode', TRUE), $data);
            $this->session->set_flashdata('message', 'Data berhasil diperbarui');
            redirect(site_url('admin/Tata_ibadah'));
        }
    }

    public function delete($id)
    {
        $row = $this->Tata_ibadah_model->get_by_id($id);

        if ($row) {
            if(isset($row->file_path) && $row->file_path!=NULL){
                if(file_exists($row->file_path)) unlink($row->file_path);
            }
            $this->Tata_ibadah_model->delete($id);
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
            redirect(site_url('admin/Tata_ibadah'));
        } else {
            $this->session->set_flashdata('message', 'Upss... Data tidak ditemukan !');
            redirect(site_url('admin/Tata_ibadah'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('waktu', 'waktu', 'trim|required');

        $this->form_validation->set_rules('kode', 'kode', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tata_ibadah.xls";
        $judul = "tata_ibadah";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Waktu");
        xlsWriteLabel($tablehead, $kolomhead++, "File Path");

        foreach ($this->Tata_ibadah_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->waktu);
            xlsWriteLabel($tablebody, $kolombody++, $data->file_path);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function cetak()
    {
        $data = array(
            'tata_ibadah_data' => $this->Tata_ibadah_model->get_all(),
            'start' => 0
        );

        $this->load->view('admin/tata_ibadah/tata_ibadah_doc', $data);
    }
}

/* End of file Tata_ibadah.php */
/* Location: ./application/controllers/Tata_ibadah.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-08 19:53:08 */
/* http://harviacode.com */