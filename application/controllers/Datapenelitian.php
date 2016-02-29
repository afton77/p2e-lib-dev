<?php

class Datapenelitian extends CI_Controller {

    var $validation_config = array(array(
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
        ));

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'codegen_helper'));
        $this->load->model('codegen_model', '', TRUE);
        $this->load->model('datapenelitian_model', 'dpn_model', TRUE);
        $this->load->model('level1_model', '', TRUE);
    }

    function index() {
        $this->home();
    }
    
    function home(){
        $this->load->library('table');
        $this->load->library('pagination');

        //paging
        $config['base_url'] = base_url() . 'datapenelitian/home/';
        $config['total_rows'] = $this->dpn_model->count('datapenelitian');
        $config['per_page'] = 10;
        
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        
        $this->pagination->initialize($config);
        $this->data['results'] = $this->dpn_model->view($config['per_page'], $this->uri->segment(3));
        $this->load->view('datapenelitian_home', $this->data);
    }

    function manage() {
        $this->load->library('neologin');
        $this->neologin->login();
        
        $this->load->library('table');
        $this->load->library('pagination');

        //paging
        $config['base_url'] = base_url() . 'datapenelitian/manage/';
        $config['total_rows'] = $this->codegen_model->count('datapenelitian');
        $config['per_page'] = 10;
        
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        // make sure to put the primarykey first when selecting , 
        //eg. 'userID,name as Name , lastname as Last_Name' , Name and Last_Name will be use as table header.
        // Last_Name will be converted into Last Name using humanize() function, under inflector helper of the CI core.
        // $this->data['results'] = $this->codegen_model->get('datapenelitian', 'id,judul,tahun,sumber,kategori,file,email,bagian', '', $config['per_page'], $this->uri->segment(3));

        $this->data['results'] = $this->dpn_model->get($config['per_page'], $this->uri->segment(3));
        
        $this->load->view('datapenelitian_list', $this->data);
        //$this->template->load('content', 'datapenelitian_list', $this->data); // if have template library , http://maestric.com/doc/php/codeigniter_template
    }

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
    
    function add() {
        $this->load->library('neologin');
        $this->neologin->login();
        
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules($this->validation_config);
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'judul' => set_value('judul'),
                'tahun' => set_value('tahun'),
                'sumber' => set_value('sumber'),
                'kategori' => set_value('kategori'),
                'file' => $_FILES['file']['name'],
                'email' => set_value('email'),
                'bagian' => set_value('bagian')
            );

            if ($this->codegen_model->add('datapenelitian', $data) == TRUE) {
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    $this->upload_file();
                }
                //$this->data['custom_error'] = '<div class="form_ok"><p>Added</p></div>';
                // or redirect
                redirect(base_url() . 'datapenelitian/manage/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->data['combolevel'] = $this->level1_model->getcombo(3);
        $this->load->view('datapenelitian_add', $this->data);
        //$this->template->load('content', 'datapenelitian_add', $this->data);
    }

    function edit() {
        $this->load->library('neologin');
        $this->neologin->login();
        
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules($this->validation_config);
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                 
            $data = array(
                'judul' => $this->input->post('judul'),
                'tahun' => $this->input->post('tahun'),
                'sumber' => $this->input->post('sumber'),
                'kategori' => $this->input->post('kategori'),
                'file' => $_FILES['file']['name'],
                'email' => $this->input->post('email'),
                'bagian' => $this->input->post('bagian')
            );
            } else {
            $data = array(
                'judul' => $this->input->post('judul'),
                'tahun' => $this->input->post('tahun'),
                'sumber' => $this->input->post('sumber'),
                'kategori' => $this->input->post('kategori'),
                'email' => $this->input->post('email'),
                'bagian' => $this->input->post('bagian')
            );   
            }

            if ($this->codegen_model->edit('datapenelitian', $data, 'id', $this->input->post('id')) == TRUE) {
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    $this->upload_file();
                }
                redirect(base_url() . 'datapenelitian/manage/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
            }
        }

        $this->data['result'] = $this->codegen_model->get('datapenelitian', 'id,judul,tahun,sumber,kategori,file,email,bagian', 'id = ' . $this->uri->segment(3), 1, NULL, true);
        $this->data['combolevel'] = $this->level1_model->getcombo(3);
        $this->load->view('datapenelitian_edit', $this->data);
        //$this->template->load('content', 'datapenelitian_edit', $this->data);
    }

    function delete() {
        $this->load->library('neologin');
        $this->neologin->login();
        
        $ID = $this->uri->segment(3);
        $this->codegen_model->delete('datapenelitian', 'id', $ID);
        redirect(base_url() . 'datapenelitian/manage/');
    }

}

/* End of file datapenelitian.php */
/* Location: ./system/application/controllers/datapenelitian.php */