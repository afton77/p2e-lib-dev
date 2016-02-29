<?php

/**
 *  al-Faqr RM Allah ;
 *  .... ooooo  ooooooooooo oooooooooooooooooo    ooooooo
 *  ... /  _  \ \_   _____/\__    ___/\_____  \   \      \
 *  .. /  /_\  \ |    __)    |    |    (       )  /   |   \
 *  . /    |    \|     \     |    |   /   ( )   \/    |    \
 *  ..\____|__  /\___  /     |__  |   \_______  /\____|__  /
 *  ..........\/.....\/.........\/............\/.........\/
 * 
 */
class Datapenelitian extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'codegen_helper'));
        $this->load->model('codegen_model', '', TRUE);
    }

    function index() {
        $this->manage();
    }

    function manage() {
        $this->load->library('table');
        $this->load->library('pagination');

        //paging
        $config['base_url'] = base_url() . 'datapenelitian/datapenelitian/manage/';
        $config['total_rows'] = $this->codegen_model->count('datapenelitian');
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        // make sure to put the primarykey first when selecting , 
        //eg. 'userID,name as Name , lastname as Last_Name' , Name and Last_Name will be use as table header.
        // Last_Name will be converted into Last Name using humanize() function, under inflector helper of the CI core.
        $this->data['results'] = $this->codegen_model->get('datapenelitian', 'id,judul,tahun,sumber,kategori,file,email,bagian', '', $config['per_page'], $this->uri->segment(4));

        $this->data['tpl'] = 'datapenelitian/datapenelitian_list';
        $this->load->view('tpl', $this->data);
    }

    function add() {
        // $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        $this->data['tpl'] = 'datapenelitian/datapenelitian_add';
        $this->load->view('tpl', $this->data);
    }

    function insert() {

        $this->upload_file();

        $this->load->library('form_validation');
        $validator = array('datapenelitian' => array(array(
                    'field' => 'judul',
                    'label' => 'Judul',
                    'rules' => 'required|trim|xss_clean'
                ),
                array(
                    'field' => 'tahun',
                    'label' => 'Tahun',
                    'rules' => 'required|trim|xss_clean'
                ),
                array(
                    'field' => 'sumber',
                    'label' => 'Sumber',
                    'rules' => 'required|trim|xss_clean'
                ),
                array(
                    'field' => 'kategori',
                    'label' => 'Kategori',
                    'rules' => 'required|trim|xss_clean'
                ),
                array(
                    'field' => 'file',
                    'label' => 'File',
                    'rules' => 'trim|xss_clean'
                ),
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'required|trim|valid_email|xss_clean'
                ),
                array(
                    'field' => 'bagian',
                    'label' => 'Bagian',
                    'rules' => 'required|trim|xss_clean'
        )));
        $this->data['custom_error'] = '';
        $this->data['tpl'] = 'datapenelitian/datapenelitian_add';
        $this->load->view('tpl', $this->data);

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules($validator['datapenelitian']);
        if ($this->form_validation->run() == false) {
            echo (validation_errors() ? validation_errors() : false);
            exit();
        } else {
            $data = array(
                'judul' => set_value('judul'),
                'tahun' => set_value('tahun'),
                'sumber' => set_value('sumber'),
                'kategori' => set_value('kategori'),
                'file' => set_value('file'),
                'email' => set_value('email'),
                'bagian' => set_value('bagian')
            );

            $config['upload_path'] = '../../uploads/';

//            if ($this->codegen_model->add('datapenelitian', $data) == TRUE) {
//                echo 'Data Anda Telah Disimpan';
//                exit();
//            } else {
//                echo 'Maaf, data tidak dapat di simpan';
//                exit();
//            }
        }
    }

    function edit() {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->data['result'] = $this->codegen_model->get('datapenelitian', 'id,judul,tahun,sumber,kategori,file,email,bagian', 'id = ' . $this->uri->segment(4), 1, NULL, true);
        $this->data['tpl'] = 'datapenelitian/datapenelitian_edit';
        $this->load->view('tpl', $this->data);
    }

    /**
     * 
     */
    function update() {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('datapenelitian') == false) {
            // $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">'.validation_errors().'</div>' : false);
            echo (validation_errors() ? validation_errors() : false);
            exit;
        } else {
            $data = array(
                'judul' => $this->input->post('judul'),
                'tahun' => $this->input->post('tahun'),
                'sumber' => $this->input->post('sumber'),
                'kategori' => $this->input->post('kategori'),
                'file' => $this->input->post('file'),
                'email' => $this->input->post('email'),
                'bagian' => $this->input->post('bagian')
            );

            if ($this->codegen_model->edit('datapenelitian', $data, 'id', $this->input->post('id')) == TRUE) {
                $fileupdate = upload_file();
                echo 'Data Anda Telah DIEDIT. '.$fileupdate;
                exit();
            } else {
                echo 'Maaf, data tidak dapat DIEDIT';
                exit();
            }
        }
    }

    function delete() {
        $ID = $this->uri->segment(4);
        $this->codegen_model->delete('datapenelitian', 'id', $ID);
        redirect(base_url() . 'datapenelitian/datapenelitian/manage/');
    }
    
    function upload_file() {
        $uploaddir = $this->config->item('diruploadfile');
        $uploadfile = $uploaddir . basename($_FILES['file']['name']);
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                return "File is valid, and was successfully uploaded.";
            } else {
                return "Possible file upload attack!";
            }
        } else {
            return 'No file uploaded';
        }
    }
}

/* End of file datapenelitian.php */
/** Location: ./system/application/controllers/datapenelitian.php */