<?php

class Fgd extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('codegen_model', '', TRUE);
    $this->load->model('fgd_model', '', TRUE);
  }

  function index() {
    $this->load->view('v_fgd');
  }

  function manage() {
    $this->load->library('neologin');
    $this->neologin->login();

    $this->load->view('v_fgd_admin');
  }

  function post() {
    $this->load->library('neologin');
    $this->neologin->login();

    $id = ($this->uri->segment(3)) ? $this->uri->segment(3) : NULL;
    $this->config->load('config', TRUE);
    $uploaddir = $this->config->item('diruploadfile');

    $this->load->view('v_fgd_post');
  }

  /**
   * Save Data
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
        $fields = array('judul' => $data->title, 'bagian' => $data->category, 'tahun' => $data->year, 'file' => $filename);
      } else {
        $fields = array('judul' => $data->title, 'bagian' => $data->category, 'tahun' => $data->year);
      }
      if ($this->fgd_model->updateData('fgd', $fields, $data->id)) {
        $post['save'] = 'Data Anda berhasil dirubah';
      }
      $post["act"] = $fields;
    } else {
      $fields = array('judul' => $data->title, 'bagian' => $data->category, 'tahun' => $data->year, 'file' => $filename);
      if ($this->fgd_model->saveData('fgd', $fields)) {
        $post['save'] = 'Data Anda berhasil disimpan';
      }
      $post["act"] = $fields;
    }
    echo json_encode($post);
  }

  /**
   * Upload File
   * @return string
   */
  function upload_file() {
    $this->load->library('neologin');
    $this->neologin->login();

    $this->config->load('config', TRUE);
    $uploaddir = $this->config->item('diruploadfile');
    $uploadfile = $uploaddir . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
      return "File is valid, and was successfully uploaded.\n";
    } else {
      return "Possible file upload attack!\n";
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

      if ($this->fgd_model->delete($id)) {
        $this->delete_file($doc); // delete file 
      }
    }
    $this->data['id'] = $id;
    echo json_encode($this->data);
  }

  /**
   * Delete file
   * @param String $doc
   */
  function delete_file($doc) {

    $this->load->library('neologin');
    $this->neologin->login();

    if (file_exists(FCPATH . '/uploads/' . $doc)) {
      unlink(FCPATH . '/uploads/' . $doc);
    }
  }

}

/* End of file fgd.php */
/* Location: ./system/application/controllers/fgd.php */