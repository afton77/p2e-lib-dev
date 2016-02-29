<?php

class Formrequest extends CI_Controller {

    var $validation_config = array(array(
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required|trim|xss_clean'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim|email|xss_clean'
        ),
        array(
            'field' => 'keterangan',
            'label' => 'Keterangan',
            'rules' => 'required|trim|xss_clean'
        ),
        array(
            'field' => 'module',
            // 'label' => 'Keterangan',
            'rules' => 'required|trim|xss_clean'
        ),
        array(
            'field' => 'module_id',
            // 'label' => 'Keterangan',
            'rules' => 'required|trim|xss_clean'
        ),
        array(
            'field' => 'instansi',
            'label' => 'Instansi',
            'rules' => 'required|trim|xss_clean'
    ));

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'codegen_helper'));
        $this->load->model('codegen_model', '', TRUE);
    }

    function index() {
        $this->manage();
    }

    function home() {
        $this->load->library('table');
        $this->load->library('pagination');

        //paging
        $config['base_url'] = base_url() . 'fgd/home/';
        $config['total_rows'] = $this->fgd_model->count('fgd');
        $config['per_page'] = 3;

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
        $this->data['results'] = $this->fgd_model->get($config['per_page'], $this->uri->segment(3));
        $this->load->view('fgd_home', $this->data);
    }

    function manage() {
        $this->load->library('table');
        $this->load->library('pagination');

        //paging
        $config['base_url'] = base_url() . 'fgd/manage/';
        $config['total_rows'] = $this->codegen_model->count('fgd');
        $config['per_page'] = 3;

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

        //paging
        $config['base_url'] = base_url() . 'formrequest/manage/';
        $config['total_rows'] = $this->codegen_model->count('formrequest');
        $config['per_page'] = 3;
        $this->pagination->initialize($config);
        // make sure to put the primarykey first when selecting , 
        //eg. 'userID,name as Name , lastname as Last_Name' , Name and Last_Name will be use as table header.
        // Last_Name will be converted into Last Name using humanize() function, under inflector helper of the CI core.
        $this->data['results'] = $this->codegen_model->get('formrequest', 'id,nama,email,instansi,keterangan,status', '', $config['per_page'], $this->uri->segment(3));

        $this->load->view('formrequest_list', $this->data);
        //$this->template->load('content', 'formrequest_list', $this->data); // if have template library , http://maestric.com/doc/php/codeigniter_template
    }

    function add() {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules($this->validation_config);
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nama' => set_value('nama'),
                'email' => set_value('email'),
                'instansi' => set_value('instansi'),
                'keterangan' => set_value('keterangan')
            );

            if ($this->codegen_model->add('formrequest', $data) == TRUE) {
                //$this->data['custom_error'] = '<div class="form_ok"><p>Added</p></div>';
                // or redirect
                redirect(base_url() . 'formrequest/manage/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->load->view('formrequest_add', $this->data);
        //$this->template->load('content', 'formrequest_add', $this->data);
    }
    
    function request() {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules($this->validation_config);
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nama' => set_value('nama'),
                'email' => set_value('email'),
                'instansi' => set_value('instansi'),
                'keterangan' => set_value('keterangan'),
                'module' => set_value('module'),
                'module_id' => set_value('module_id')
            );

            if ($this->codegen_model->add('formrequest', $data) == TRUE) {
                redirect(base_url() . 'formrequest/request_result/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->load->view('formrequest_useradd', $this->data);
        //$this->template->load('content', 'formrequest_add', $this->data);
    }
    
    function request_result(){
        $this->load->view('formrequest_result');
    }

    function edit() {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules($this->validation_config);
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'instansi' => $this->input->post('instansi'),
                'keterangan' => $this->input->post('keterangan'),
                'status' => $this->input->post('status')
            );

            if ($this->codegen_model->edit('formrequest', $data, 'id', $this->input->post('id')) == TRUE) {
                redirect(base_url() . 'formrequest/manage/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
            }
        }

        $this->data['result'] = $this->codegen_model->get('formrequest', 'id,nama,email,instansi,keterangan,status', 'id = ' . $this->uri->segment(3), NULL, NULL, true);

        $this->load->view('formrequest_edit', $this->data);
        //$this->template->load('content', 'formrequest_edit', $this->data);
    }

    function delete() {
        $ID = $this->uri->segment(3);
        $this->codegen_model->delete('formrequest', 'id', $ID);
        redirect(base_url() . 'formrequest/manage/');
    }

}

/* End of file formrequest.php */
/* Location: ./system/application/controllers/formrequest.php */