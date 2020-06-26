<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class M_barang extends CI_Model {

	function read($id = null) {
		return $this->db->query("SELECT * FROM barang");
	}

	function transaksi($data) {
		$this->db->insert('transaksi', $data);
		return $this->db->affected_rows();
	}
}