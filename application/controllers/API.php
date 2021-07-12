<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller {

    function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
        parent::__construct();
        set_timezone("Asia/Jakarta");
    }

	public function index()
    {
        echo "[status: true: response: []]";
        return TRUE;
	}

    public function getNotifikasi()
    {
        $this->load->model("Notifikasi_view_model");
        $result = $this->Notifikasi_view_model->get_hari_ini();
        echo json_encode($result);
        return TRUE;
    }

    public function setTerkirim()
    {
        $this->load->model("Jadwal_model");
        $data = [
            'terkirim' => "1"
        ];
        $this->Jadwal_model->update($this->input->post("kode_jadwal"), $data);
        echo "[status: true: response: []]";
    }

}
