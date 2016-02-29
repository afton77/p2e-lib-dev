<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of request_form
 *
 * @author XUPJ21AMR
 */
class request_form extends CI_Controller {
    //put your code here
    
    var $validation_config = array(array(
            'field' => 'nama',
            'label' => 'Nama/Name',
            'rules' => 'required|trim|xss_clean'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim|xss_clean|email'
        ),
        array(
            'field' => 'instansi',
            'label' => 'Instanti/University',
            'rules' => 'required|trim|xss_clean'
        ),
        array(
            'field' => 'keperlua',
            'label' => 'Keperluan',
            'rules' => 'required|trim|xss_clean'
        ),
        array(
            'field' => 'bagian',
            'label' => 'Bagian',
            'rules' => 'required|trim|xss_clean'
    ));
    
    public function __construct() {
        parent::__construct();
    }
    
    
    function insert_form(){
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules($this->validation_config);
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'judul' => set_value('judul'),
                'sumber' => set_value('sumber'),
                'kategori' => set_value('kategori'),
                'tahun' => set_value('tahun'),
                'file' => $_FILES['file']['name'],
                'bagian' => set_value('bagian')
            );
            if ($this->codegen_model->add('datastatistik', $data) == TRUE) {
                $this->upload_file();
                redirect(base_url() . 'datastatistik/manage/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->load->view('datastatistik_add', $this->data);
    }
}

?>
