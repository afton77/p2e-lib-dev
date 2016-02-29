<?php

class Beritaekonomi extends CI_Controller {

    var $validation_config = array(array(
            'field' => 'judul',
            'label' => 'Judul',
            'rules' => 'required|trim|xss_clean'
        ),
        array(
            'field' => 'tanggal',
            'label' => 'Tanggal',
            'rules' => 'required|trim|xss_clean'
        ),
        array(
            'field' => 'bulan',
            'label' => 'Bulan',
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
    ));

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'codegen_helper'));
        $this->load->model('codegen_model', '', TRUE);
        $this->load->model('beritaekonomi_model', 'be_model', TRUE);
    }

    function index() {
        $this->home();
    }

    function home() {
        $this->load->library('table');
        $this->load->library('pagination');

        //paging
        $config['base_url'] = base_url() . 'beritaekonomi/home/';
        $config['total_rows'] = $this->be_model->count('beritaekonomi');
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
        $this->data['results'] = $this->be_model->get($config['per_page'], $this->uri->segment(3));
        $this->load->view('beritaekonomi_home', $this->data);
    }

    function manage() {
        $this->load->library('table');
        $this->load->library('pagination');

        //paging
        $config['base_url'] = base_url() . 'beritaekonomi/manage/';
        $config['total_rows'] = $this->codegen_model->count('beritaekonomi');
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
        // make sure to put the primarykey first when selecting , 
        //eg. 'userID,name as Name , lastname as Last_Name' , Name and Last_Name will be use as table header.
        // Last_Name will be converted into Last Name using humanize() function, under inflector helper of the CI core.
        $this->data['results'] = $this->codegen_model->get('beritaekonomi', 'id,judul,tanggal,bulan,tahun,sumber,kategori,file,email,bagian', '', $config['per_page'], $this->uri->segment(3));

        $this->load->view('beritaekonomi_list', $this->data);
        //$this->template->load('content', 'beritaekonomi_list', $this->data); // if have template library , http://maestric.com/doc/php/codeigniter_template
    }

    function upload_file() {
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
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules($this->validation_config);
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'judul' => set_value('judul'),
                'tanggal' => set_value('tanggal'),
                'bulan' => set_value('bulan'),
                'tahun' => set_value('tahun'),
                'sumber' => set_value('sumber'),
                'kategori' => set_value('kategori'),
                'file' => $_FILES['file']['name'],
                'email' => set_value('email'),
                'bagian' => set_value('bagian')
            );

            if ($this->codegen_model->add('beritaekonomi', $data) == TRUE) {
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    $this->upload_file();
                }
                //$this->data['custom_error'] = '<div class="form_ok"><p>Added</p></div>';
                // or redirect
                redirect(base_url() . 'beritaekonomi/manage/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->load->view('beritaekonomi_add', $this->data);
        //$this->template->load('content', 'beritaekonomi_add', $this->data);
    }

    function edit() {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules($this->validation_config);
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {

                $data = array(
                    'judul' => $this->input->post('judul'),
                    'tanggal' => $this->input->post('tanggal'),
                    'bulan' => $this->input->post('bulan'),
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
                    'tanggal' => $this->input->post('tanggal'),
                    'bulan' => $this->input->post('bulan'),
                    'tahun' => $this->input->post('tahun'),
                    'sumber' => $this->input->post('sumber'),
                    'kategori' => $this->input->post('kategori'),
                    'email' => $this->input->post('email'),
                    'bagian' => $this->input->post('bagian')
                );
            }

            if ($this->codegen_model->edit('beritaekonomi', $data, 'id', $this->input->post('id')) == TRUE) {
                redirect(base_url() . 'beritaekonomi/manage/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
            }
        }

        $this->data['result'] = $this->codegen_model->get('beritaekonomi', 'id,judul,tanggal,bulan,tahun,sumber,kategori,file,email,bagian', 'id = ' . $this->uri->segment(3), 1, NULL, true);

        $this->load->view('beritaekonomi_edit', $this->data);
        //$this->template->load('content', 'beritaekonomi_edit', $this->data);
    }

    function delete() {
        $ID = $this->uri->segment(3);
        $this->codegen_model->delete('beritaekonomi', 'id', $ID);
        redirect(base_url() . 'beritaekonomi/manage/');
    }

}

/* End of file beritaekonomi.php */
/* Location: ./system/application/controllers/beritaekonomi.php */