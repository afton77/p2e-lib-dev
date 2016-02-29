<?php

class Datastatistik extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('datastatistik_model', 'ds_model', TRUE);
  }

  /**
   * Index
   */
  function index() {
    $this->load->view('v_datastatistic');
  }

  /**
   * Index for Admin
   */
  function manage() {
    $this->load->library('neologin');
    $this->neologin->login();
    $this->load->view('v_datastatistic_admin');
  }

  /**
   * FORM INPUT & EDIT
   */
  function post() {
    $this->load->library('neologin');
    $this->neologin->login();

    $id = ($this->uri->segment(3)) ? $this->uri->segment(3) : NULL;
    $this->load->library('neologin');
    $cek_login = $this->neologin->login();
    $this->config->load('config', TRUE);
    $uploaddir = $this->config->item('diruploadfile');

    $this->load->view('v_datastatistic_post');
  }

  /**
   * CRUD : Create + Update
   */
  function save_data() {
    $this->load->library('neologin');
    $this->neologin->login();
    
    $post = "";
    $filename = "";
    $data = json_decode($this->input->post('data', TRUE));
    $file = isset($_FILES['file']['name']) ? $_FILES['file'] : FALSE;

    /**
     * Upload File
     */
    if ($file) {
      $filename = $_FILES['file']['name'];
      $temp_filename = $_FILES['file']['tmp_name'];
      $post["upload"] = $this->upload_file($temp_filename, $filename);
    }

    /**
     * Save Data (Insert + Update)
     */
    if (($data->id)) {
      if ($filename) {
        $fields = array('kategori' => $data->category, 'tahun' => $data->year, 'judul' => $data->title, 'sumber' => $data->source, 'file' => $filename);
      } else {
        $fields = array('kategori' => $data->category, 'tahun' => $data->year, 'judul' => $data->title, 'sumber' => $data->source);
      }
      if ($this->ds_model->updateData('datastatistik', $fields, $data->id)) {
        $post['save'] = 'Data Anda berhasil dirubah';
      }
      $post["act"] = $fields;
    } else {
      $fields = array('kategori' => $data->category, 'tahun' => $data->year, 'judul' => $data->title, 'sumber' => $data->source, 'file' => $filename);
      if ($this->ds_model->saveData('datastatistik', $fields)) {
        $post['save'] = 'Data Anda berhasil disimpan';
      }
      $post["act"] = $fields;
    }
    echo json_encode($post);
  }

  /**
   * CRUD : Read -> Get data (Edit)
   * @param type $id
   */
  function getData($id = null) {
    $this->load->library('neologin');
    $this->neologin->login();
    
    $data = "";
    $this->data['json'] = $this->ds_model->getData($id);
    $this->data['id'] = $id;
    echo json_encode($this->data);
  }

  /**
   * Upload File
   * @param string $tmpfile
   * @param string $filename
   * @return string
   */
  function upload_file($tmpfile, $filename) {
    $this->config->load('config', TRUE);
    $uploaddir = $this->config->item('diruploadfile');
    $uploadfile = $uploaddir . basename($filename);

    if (move_uploaded_file($tmpfile, $uploadfile)) {
      return "Selamat, file berhasil diunggah (upload)";
    } else {
      return "Maaf, tidak dapat mengunggah file";
    }
  }


  /**
   * Delete Data
   */
  function delete() {

    $this->load->library('neologin');
    $this->neologin->login();

    $id = "";
    $post = "";
    if ($this->input->raw_input_stream) {
      $post = json_decode($this->input->raw_input_stream);
      $id = $post->id;
      $doc = $post->title;

      if ($this->ds_model->delete($id)) {
        $this->delete_file($doc); // delete file 
      }
    }
    $this->data['id'] = $id;
    echo json_encode($this->data);
  }

  /**
   * Delete File
   * @param varchar $doc
   */
  function delete_file($doc) {

    $this->load->library('neologin');
    $this->neologin->login();

    if (file_exists(FCPATH . '/uploads/' . $doc)) {
      unlink(FCPATH . '/uploads/' . $doc);
    }
  }

}

/* End of file datastatistik.php */
/* Location: ./system/application/controllers/datastatistik.php */