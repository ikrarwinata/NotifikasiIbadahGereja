<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_model');
        $this->load->model('Jadwal_view_model');
        $this->load->model('Tata_ibadah_model');
        set_timezone("Asia/Jakarta");
    }

	public function index()
	{
		$data = array(
			'judul' => "Beranda",
            'konten' => "home",
			);
		$this->load->view('container',$data);
	}
    
    public function jadwal($id_jenis)
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        if ($id_jenis == NULL) {
            if ($this->session->userdata("jenis_ibadah") != NULL) $id_jenis = $this->session->userdata("jenis_ibadah");
        }

        if ($q <> '') {
            $config['base_url'] = base_url() . 'Welcome/jadwal/' . $id_jenis . '?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'Welcome/jadwal/' . $id_jenis . '?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'Welcome/jadwal/' . $id_jenis;
            $config['first_url'] = base_url() . 'Welcome/jadwal/' . $id_jenis;
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jadwal_view_model->total_rows($id_jenis, $q);
        $jadwal = $this->Jadwal_view_model->get_limit_data($config['per_page'], $start, $q, $id_jenis);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $jenis = NULL;
        if (isset($this->Jenis_ibadah_model->get_by_id($id_jenis)->jenis)) $jenis = $this->Jenis_ibadah_model->get_by_id($id_jenis)->jenis;
        $this->session->set_userdata("jenis_ibadah", $id_jenis);
        $data = array(
            'jadwal_data' => $jadwal,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'judul' => 'Jadwal Ibadah ' . $jenis,
            'konten' => 'jadwal',
            'start' => $start,
            'id_jenis' => $id_jenis
        );
        $this->load->view('container', $data);
    }

    public function cetak_jadwal($id_jenis)
    {
        $jenis = NULL;
        if (isset($this->Jenis_ibadah_model->get_by_id($id_jenis)->jenis)) $jenis = $this->Jenis_ibadah_model->get_by_id($id_jenis)->jenis;
        
        $data = array(
            'jadwal_data' => $this->Jadwal_view_model->get_by_jenis($id_jenis),
            'jenis' => $jenis,
            'start' => 0
        );

        $this->load->view('jadwal_print', $data);
    }

    public function tata_ibadah(){

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'Welcome/tata_ibadah?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'Welcome/tata_ibadah?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'Welcome/tata_ibadah';
            $config['first_url'] = base_url() . 'Welcome/tata_ibadah';
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
            'konten' => 'tata_ibadah',
        );
        $this->load->view('container', $data);
    }

    public function tentang()
    {
        $d = $this->db->select("jenis_ibadah.*, COUNT(notifikasi.id) AS jumlah_jemaat")->join("notifikasi", "jenis_ibadah.id = notifikasi.jenis_ibadah", "LEFT")->group_by("jenis_ibadah.id")->order_by("jenis_ibadah.id", "ASC")->get("jenis_ibadah")->result();
        $data = array(
            'data_jemaat' => $d,
            'judul' => 'Tentang',
            'konten' => 'tentang',
        );
        $this->load->view('container', $data);
    }

	public function login(){
		if ($this->session->userdata("level")=="admin") {
			redirect("Admin");
		}else{
            $this->load->model("Users_model");
            $username = $this->input->post('jig_username');
            if ($username != NULL) {
                $res = $this->Users_model->get_by_id($username);
                if ($res) {
                    $this->session->set_userdata("login", $res->username);
                    $this->session->set_userdata("login_name", $res->nama);
                    return $this->load->view('login_password');
                } else {
                    $this->session->set_flashdata('ci_login_flash_message', "Username tidak ditemukan");
                    $this->session->set_flashdata('ci_login_flash_message_type', 'text-danger');
                }
            };
            return $this->load->view('login');
        }
    }

    public function login_auth()
    {
        if ($this->session->userdata("login") == NULL) return $this->login();
        $password = $this->input->post('pos_password');

        if ($password != NULL) {
            $logedIn = $this->db->where(['username' => $this->session->userdata("login"), 'password' => md5($password)])->get("users")->row();
            if ($logedIn) {
                $sessData = [];
                foreach ($logedIn as $key => $value) {
                    $sessData[$key] = $value;
                }
                $this->session->set_userdata($sessData);
                redirect("Admin");
            } else {
                $this->session->set_flashdata('ci_password_flash_message', "Password yang anda masukan tidak cocok !");
                $this->session->set_flashdata('ci_password_flash_message_type', 'text-danger');
            }
        };
        return $this->load->view('login_password');
    }

	public function logout(){
		$this->session->unset_userdata('oldusername');
        $this->session->unset_userdata('username');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('level');
		$this->index();
	}
}
