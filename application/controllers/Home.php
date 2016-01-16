<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

   /**
    * Index page for this controller
    */
   public function index()
	{
		// Data to be passed to views
      $data['page_title'] = 'Home';
      $data['menu_item'] = 'Home';

      // Loading views
      // --- Header
      $this->load->view('template/header', $data);

      if (!$this->ion_auth->logged_in())
      {
         // --- Content
         $this->load->view('home_logged_out_view');
      }
      else
      {
         // user() - get a currently logged in user, returns an object
         // row() - returns a single result row, returns an object
         $user = $this->ion_auth->user()->row();
         $data['username'] = $user->username;

         // --- Content
         $this->load->view('home_logged_in_view', $data);
      }

      // --- Footer
      $this->load->view('template/footer');
   }

}
