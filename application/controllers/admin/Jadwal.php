<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("username") == NULL || $this->session->userdata("level") == NULL) {
            $this->session->set_flashdata('ci_password_flash_message', "Akses ditolak, silahkan login terlebih dahulu !!!");
            $this->session->set_flashdata('ci_password_flash_message_type', 'text-danger');
            return redirect("Welcome/login");
        }
        $this->load->model('Jadwal_model');
        $this->load->model('Jadwal_view_model');
        $this->load->model('Jenis_ibadah_model');
        $this->load->model("Rayon_model");
        $this->load->library('form_validation');
        set_timezone("Asia/Jakarta");
    }

    public function index($id_jenis = NULL)
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        if($id_jenis == NULL){
            if($this->session->userdata("jenis_ibadah")!=NULL)$id_jenis= $this->session->userdata("jenis_ibadah");
        }

        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Jadwal/index/'.$id_jenis.'?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Jadwal/index/'.$id_jenis.'?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Jadwal/index/'.$id_jenis;
            $config['first_url'] = base_url() . 'admin/Jadwal/index/'.$id_jenis;
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jadwal_view_model->total_rows($id_jenis, $q);
        $jadwal = $this->Jadwal_view_model->get_limit_data($config['per_page'], $start, $q, $id_jenis);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $jenis = NULL;
        if(isset($this->Jenis_ibadah_model->get_by_id($id_jenis)->jenis)) $jenis = $this->Jenis_ibadah_model->get_by_id($id_jenis)->jenis;
        $this->session->set_userdata("jenis_ibadah", $id_jenis);
        $data = array(
            'jadwal_data' => $jadwal,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'judul' => 'Jadwal Ibadah ' . $jenis,
            'konten' => 'admin/jadwal/jadwal_list',
            'start' => $start,
            'id_jenis' => $id_jenis
        );
        $this->load->view('admin/container', $data);
    }

    public function create()
    {
        $totalIbadah = $this->Jadwal_view_model->count_all();
        $kode = "IBD" . strtotime("now") . ($totalIbadah + 1);
        $pesanDefault = "Hai, %{nama_jemaat}\r\nIni adalah pengingat %{jenis_ibadah} pada %{tanggal_jadwal}.\r\nTempat Ibadah : %{tempat_ibadah}\r\nPemimpin Ibadah : %{pemimpin_ibadah}";

        $data = array(
            'button' => 'Simpan',
            'action' => site_url('admin/Jadwal/create_action'),
            'kode' => set_value('kode', $kode),
            'jenis' => set_value('jenis', $this->session->userdata("jenis_ibadah")),
            'rayon' => set_value('rayon'),
            'tgl' => set_value('tgl'),
            'tempat' => set_value('tempat'),
            'pemimpin' => set_value('pemimpin'),
            'pesan' => set_value('pesan', $pesanDefault),
            'judul' => 'Tambah Jadwal Ibadah',
            'konten' => 'admin/jadwal/jadwal_form',
            'data_rayon' => $this->Rayon_model->get_all(),
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
            $tgl = strtotime(format_date($this->input->post('tgl', TRUE)));

            $data = array(
                'kode' => $this->input->post('kode', TRUE),
                'jenis' => $this->input->post('jenis', TRUE),
                'rayon' => $this->input->post('rayon', TRUE),
                'tgl' => $tgl,
                'tempat' => $this->input->post('tempat', TRUE),
                'pemimpin' => $this->input->post('pemimpin', TRUE),
                'pesan' => $this->input->post('pesan', TRUE),
            );

            $this->Jadwal_model->insert($data);
            $this->session->set_flashdata('message', 'Jadwal berhasil ditambahkan');
            redirect(site_url('admin/Jadwal'));
        }
    }

    public function update($id)
    {
        $row = $this->Jadwal_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/Jadwal/update_action'),
                'kode' => set_value('kode', $row->kode),
                'jenis' => set_value('jenis', $row->jenis),
                'rayon' => set_value('rayon', $row->rayon),
                'tgl' => set_value('tgl', $row->tgl),
                'tempat' => set_value('tempat', $row->tempat),
                'pemimpin' => set_value('pemimpin', $row->pemimpin),
                'pesan' => set_value('pesan', $row->pesan),
                'judul' => 'Ubah Jadwal Ibadah',
                'konten' => 'admin/jadwal/jadwal_form',
                'data_rayon' => $this->Rayon_model->get_all(),
                'data_jenis_ibadah' => $this->Jenis_ibadah_model->get_all()
            );
            $this->load->view('admin/container', $data);
        } else {
            $this->session->set_flashdata('message', 'Upss... Data tidak ditemukan !');
            redirect(site_url('admin/Jadwal'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode', TRUE));
        } else {
            $tgl = strtotime(format_date($this->input->post('tgl', TRUE)));
            $data = array(
                'kode' => $this->input->post('kode', TRUE),
                'jenis' => $this->input->post('jenis', TRUE),
                'rayon' => $this->input->post('rayon', TRUE),
                'tgl' => $tgl,
                'tempat' => $this->input->post('tempat', TRUE),
                'pemimpin' => $this->input->post('pemimpin', TRUE),
                'pesan' => $this->input->post('pesan', TRUE),
            );

            $this->Jadwal_model->update($this->input->post('oldkode', TRUE), $data);
            $this->session->set_flashdata('message', 'Jadwal berhasil diperbari');
            redirect(site_url('admin/Jadwal'));
        }
    }

    public function delete($id)
    {
        $row = $this->Jadwal_model->get_by_id($id);

        if ($row) {
            $this->Jadwal_model->delete($id);
            $this->session->set_flashdata('message', 'Jadwal berhasil dihapus');
            redirect(site_url('admin/Jadwal'));
        } else {
            $this->session->set_flashdata('message', 'Upss... Data tidak ditemukan !');
            redirect(site_url('admin/Jadwal'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
        $this->form_validation->set_rules('rayon', 'rayon', 'trim|required');
        $this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
        $this->form_validation->set_rules('tempat', 'tempat', 'trim|required');
        $this->form_validation->set_rules('pemimpin', 'pemimpin', 'trim|required');

        $this->form_validation->set_rules('kode', 'kode', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "jadwal.xls";
        $judul = "jadwal";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Rayon");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl");
        xlsWriteLabel($tablehead, $kolomhead++, "tempat");
        xlsWriteLabel($tablehead, $kolomhead++, "Pemimpin");

        foreach ($this->Jadwal_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->jenis);
            xlsWriteNumber($tablebody, $kolombody++, $data->rayon);
            xlsWriteNumber($tablebody, $kolombody++, $data->tgl);
            xlsWriteLabel($tablebody, $kolombody++, $data->tempat);
            xlsWriteLabel($tablebody, $kolombody++, $data->pemimpin);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function cetak($id_jenis)
    {
        $jenis = NULL;
        if (isset($this->Jenis_ibadah_model->get_by_id($id_jenis)->jenis)) $jenis = $this->Jenis_ibadah_model->get_by_id($id_jenis)->jenis;

        $data = array(
            'jadwal_data' => $this->Jadwal_view_model->get_by_jenis($id_jenis),
            'jenis' => $jenis,
            'start' => 0
        );

        $this->load->view('admin/jadwal/jadwal_doc', $data);
    }

    public function cetak_semua()
    {
        $data = array(
            'jadwal_data' => $this->Jadwal_view_model->get_all(),
            'start' => 0
        );

        $this->load->view('admin/jadwal/jadwal_all_doc', $data);
    }
}

/* End of file Jadwal.php */
/* Location: ./application/controllers/Jadwal.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-08 19:53:07 */
/* http://harviacode.com */