<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Warkop extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    // menampilkan data
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $warkop = $this->db->get('warkop')->result();
        } else {
            $this->db->where('id_warkop', $id);
            $warkop = $this->db->get('warkop')->result();
        }
        $this->response($warkop, 200);
    }

    // tambah data
    function index_post() {
        $data = array(
                    'nama_warkop'   => $this->post('nama_warkop'),
                    'alamat'        => $this->post('alamat'),
                    'sekilas'       => $this->post('sekilas'),
                );
        $insert = $this->db->insert('warkop', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data
    function index_put() {
        $id = $this->put('id_warkop');
        $data = array(
                    'nama_warkop'   => $this->put('nama_warkop'),
                    'alamat'        => $this->put('alamat'),
                    'sekilas'       => $this->put('sekilas'),
                );
        $this->db->where('id_warkop', $id);
        $update = $this->db->update('warkop', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Menghapus data
    function index_delete() {
        $id = $this->delete('id_warkop');
        $this->db->where('id_warkop', $id);
        $delete = $this->db->delete('warkop');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>