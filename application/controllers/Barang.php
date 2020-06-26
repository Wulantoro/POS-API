<?php
defined('BASEPATH') OR exit ('NO direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Barang extends REST_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('M_barang');
	}

	public function index_get() {
		$id = $this->get('id');
		$data = $this->M_barang->read($id)->result_array();

		if ($data) {
			# code...
			$this->response([
				'status' => TRUE,
				'message' => 'Barang ditemukan',
				'data' => $data
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Barang tidak ditemukan'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_post() {

		$data = [
			'id_brg' => $this->post('id_brg'),
			'qty' => $this->post('qty')
		];

		$cek = $this->M_barang->transaksi($data);
		$id_trans = $this->db->insert_id();

		if ($cek) {
			# code...
			$this->response([
				'status' => TRUE,
				'message' => 'Transaksi berhasil',
				'data' => $data
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Transaksi gagal, coba lagi!!'
			], REST_Controller::HTTP_NOT_FOUND);
		}

	}
}