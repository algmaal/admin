<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

   /**
    * Index page for this controller
    */
   public function index()
	{
		// Data to be passed to views
      $data['page_title'] = 'Contact';
      $data['menu_item'] = 'Contact';

      // Loading views
      $this->load->view('template/header', $data);
      $this->load->view('contact_view');
      $this->load->view('template/footer');
   }

}
