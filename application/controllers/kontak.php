<?php

//mencegah akses langsung pada file controller
defined('BASEPATH') OR exit('No direct script access allowed');

//require dengan library rest_controller
require APPPATH . '/libraries/REST_Controller.php';
//menggunakan library rest_controller
use Restserver\Libraries\REST_Controller;

// membuat class Kontak yang mewarisi sifat dari class REST_Controller
class Kontak extends REST_Controller {

    //function untuk konfigurasi rest __construct
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();    //mengambil data dari database dan mengaktifkan semua fungsi-fungsinya
    }

    //function untuk menampilkan data kontak
    function index_get() {
        $id = $this->get('id');     //menyeleksi data berdasarkan id
        if ($id == '') {
            $kontak = $this->db->get('telepon')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('telepon')->result();
        }
        //set response
        $this->response($kontak, 200);
    }

    //function untuk mengirim atau menambah data kontak baru
    function index_post() {
        //mengisi data baru dalam bentuk array
        $data = array(
                    'id'           => $this->post('id'),
                    'nama'          => $this->post('nama'),
                    'nomor'    => $this->post('nomor'));
        //menambahkan data baru ke database
        $insert = $this->db->insert('telepon', $data);
        //cek apakah data berhasil ditambahkan
        if ($insert) {
            //set response jika berhasil ditambahkan
            $this->response($data, 200);
        } else {
            //set response jika gagal ditambahkan
            $this->response(array('status' => 'fail', 502));
        }
    }

    //function untuk memperbarui atau meng-update data kontak yang telah ada
    function index_put() {
        //menyimpan data yang akan diperbarui pada server berdasarkan id
        $id = $this->put('id');
        //menyimpan data yang akan diperbarui pada server dalam bentuk array
        $data = array(
                    'id'       => $this->put('id'),
                    'nama'          => $this->put('nama'),
                    'nomor'    => $this->put('nomor'));
        $this->db->where('id', $id);
        //memperbarui data dan menambahkannya ke database
        $update = $this->db->update('telepon', $data);
        //cek apakah data berhasil diperbarui
        if ($update) {
            //set response jika berhasil diperbarui
            $this->response($data, 200);
        } else {
            //set response jika gagal diperbarui
            $this->response(array('status' => 'fail', 502));
        }
    }

    //function untuk menghapus salah satu data kontak
    function index_delete() {
        //menyeleksi data yang akan dihapus berdasarkan id
        $id = $this->delete('id');
        $this->db->where('id', $id);
        //menghapus data yang telah diseleksi dari database
        $delete = $this->db->delete('telepon');
        //cek apakah data berhasil dihapus
        if ($delete) {
            //set response jika data berhasil dihapus
            $this->response(array('status' => 'success'), 201);
        } else {
            //set response jika data gagal dihapus
            $this->response(array('status' => 'fail', 502));
        }
    }
}


?>