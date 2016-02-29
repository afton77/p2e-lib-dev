<?php

class Level0 extends CI_Controller {

    var $validation_config = array(array(
            'field' => 'nama',
            'label' => 'Nama',
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

    function manage() {
        $this->load->library('table');
        $this->load->library('pagination');

        //paging
        $config['base_url'] = base_url() . 'level0/manage/';
        $config['total_rows'] = $this->codegen_model->count('level0');
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
        $this->data['results'] = $this->codegen_model->get('level0', 'id,nama', '', $config['per_page'], $this->uri->segment(3));

        $this->load->view('level0_list', $this->data);
        //$this->template->load('content', 'level0_list', $this->data); // if have template library , http://maestric.com/doc/php/codeigniter_template
    }

    function add() {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules($this->validation_config);
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nama' => set_value('nama')
            );

            if ($this->codegen_model->add('level0', $data) == TRUE) {
                //$this->data['custom_error'] = '<div class="form_ok"><p>Added</p></div>';
                // or redirect
                redirect(base_url() . 'level0/manage/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->load->view('level0_add', $this->data);
        //$this->template->load('content', 'level0_add', $this->data);
    }

    function edit() {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules($this->validation_config);
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nama' => $this->input->post('nama')
            );

            if ($this->codegen_model->edit('level0', $data, 'id', $this->input->post('id')) == TRUE) {
                redirect(base_url() . 'level0/manage/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
            }
        }

        $this->data['result'] = $this->codegen_model->get('level0', 'id,nama,submenu,akses', 'id = ' . $this->uri->segment(3), 1, NULL, true);

        $this->load->view('level0_edit', $this->data);
        //$this->template->load('content', 'level0_edit', $this->data);
    }

    function delete() {
        $ID = $this->uri->segment(3);
        $this->codegen_model->delete('level0', 'id', $ID);
        redirect(base_url() . 'level0/manage/');
    }

}

/* End of file level0.php */
/* Location: ./system/application/controllers/level0.php */