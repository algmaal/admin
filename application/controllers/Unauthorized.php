<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unauthorized extends CI_Controller {

   /**
    * Index page for this controller
    */
   public function index()
	{
      // Data to be passed to views
      $data['page_title'] = 'Unauthorized';
      $data['menu_item'] = 'Home';

      // Loading views
      $this->load->view('template/header', $data);
      $this->load->view('unauthorized');
      $this->load->view('template/footer');
   }

}
