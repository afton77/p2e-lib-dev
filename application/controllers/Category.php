<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of category
 *
 * @author Afton
 */
class category extends CI_Controller {
  //put your code here
  
  function __construct() {
    parent::__construct();
    $this->load->model('Category_model', '', TRUE);
  }
  /**
   * Get Categories
   * @param return JSON
   */
  function get_cmb_category(){ 
    $this->data['json'] = $this->Category_model->getCmbCategory(1);
    echo json_encode($this->data);
  }
  /**
   * Get 'Data Statistic' Categories
   * @param return JSON
   */
  function get_cmb_category_datastatistic(){ 
    $this->data['json'] = $this->Category_model->getCmbCategory(7);
    echo json_encode($this->data);
  }
  /**
   * Get 'Transcript' Category
   * @param return JSON
   */
  function get_cmb_category_transcript(){ 
    $this->data['json'] = $this->Category_model->getCmbCategory(8);
    echo json_encode($this->data);
  }
  /**
   * Get 'FGD' Category
   * @param return JSON
   */
  function get_cmb_category_fgd(){ 
    $this->data['json'] = $this->Category_model->getCmbCategory(9);
    echo json_encode($this->data);
  }
  /**
   * Get 'Publik' Categories
   * @param return JSON
   */
  function get_cmb_category_ss(){
    $this->data['json'] = $this->Category_model->getCmbCategory(11);
    echo json_encode($this->data);
  }
  /**
   * Get 'Karya Peneliti' Cateories
   * @param return JSON
   */
  function get_cmb_category_kp(){
    $this->data['json'] = $this->Category_model->getCmbCategory(2);
    echo json_encode($this->data);
  }
}
