<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

   /**
    * Class constructor
    */
   public function __construct()
   {
      parent::__construct();

      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->load->database();

      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
   }

   /**
    * Index page for this controller
    */
   public function index()
	{
      if ($this->ion_auth->logged_in())
      {
         redirect('account/profile');
      }
      else
      {
         redirect('account/login');
      }
   }

   /**
    * Account login
    */
   public function login()
	{

      if ($this->ion_auth->logged_in())
      {
         redirect('home');
      }

      // Data to be passed to views
      $data['page_title'] = 'Login';
      $data['menu_item'] = 'Account';

      // Get current identity type and set things
      if ($this->config->item('identity', 'ion_auth') == 'email')
      {
         $data['identity_label'] = 'Email';
         $this->form_validation->set_rules('identity', 'Email', 'trim|required|valid_email');
      }
      else if ($this->config->item('identity', 'ion_auth') == 'username')
      {
         $data['identity_label'] = 'Username';
         $this->form_validation->set_rules('identity', 'Username', 'trim|required');
      }

      // Login form validation, identity is username or email
      $this->form_validation->set_rules('password', 'Password', 'trim|required');

      // Loading views or redirecting
      if ($this->form_validation->run() == FALSE)
      {
         $this->load->view('template/header', $data);
         $this->load->view('account_login_view', $data);
         $this->load->view('template/footer');
      }
      else
      {
         // Get form values
         $identity = $this->input->post('identity');
         $password = $this->input->post('password');
         $remember = (bool)$this->input->post('remember');

         // Try to login
         // login() - Logs the user into the system, returns true if the user was successfully logged
         if ($this->ion_auth->login($identity, $password, $remember))
         {
            redirect('home');
         }
         else
         {
            // errors() - Get the errors
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect('account/login');
         }
      }
	}

   /**
    * Account profile
    */
   public function profile()
   {
      if (!$this->ion_auth->logged_in())
      {
         redirect('account/login');
      }

      // Data to be passed to views
      $data['page_title'] = 'Profile';
      $data['menu_item'] = 'Account';

      // user() - get a currently logged in user, returns an object
      // row() - returns a single result row, returns an object
      $user = $this->ion_auth->user()->row();
      $data['username'] = $user->username;
      $data['email'] = $user->email;
      $data['joined'] = unix_to_human($user->created_on);

      // get_users_groups() - get a group of the currently logged in user
      $data['group'] = $this->ion_auth->get_users_groups()->row()->name;

      // Loading views
      $this->load->view('template/header', $data);
      $this->load->view('account_profile_view', $data);
      $this->load->view('template/footer');
   }

   /**
    * Account logout
    */
   public function logout()
   {
      $data['page_title'] = 'Logout';
      $data['menu_item'] = 'Account';

      $this->ion_auth->logout();
      redirect('home');
   }

   /**
    * Lost password
    */
   public function lost_password()
   {
      // Data to be passed to views
      $data['page_title'] = 'Reset your password';
      $data['menu_item'] = 'Account';

      // Login form validation
      if ($this->config->item('identity', 'ion_auth') == 'email')
      {
         $data['identity_label'] = 'Email';
         $this->form_validation->set_rules('identity', 'Email', 'trim|required|valid_email');
      }
      else if ($this->config->item('identity', 'ion_auth') == 'username')
      {
         $data['identity_label'] = 'Username';
         $this->form_validation->set_rules('identity', 'Username', 'trim|required');
      }
      else
      {
         $data['identity_label'] = '';
      }

      if ($this->form_validation->run() == FALSE)
      {
         // Loading views
         $this->load->view('template/header', $data);
         $this->load->view('account_lost_password_view', $data);
         $this->load->view('template/footer');
      }
      else
      {
         $identity = $this->input->post('identity');

         // forgotten_password() - emailing the user a reset code
         if ($this->ion_auth->forgotten_password($identity))
         {
            // messages() - Get the messages
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('account/lost-password');
         }
         else
         {
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect('account/lost-password');
         }
      }
   }

   /**
    * Reset password
    */
   public function reset_password($code = NULL)
   {
      if (!$code)
		{
			show_404();
		}

      // forgotten_password_check() - returns user profile data
		$user = $this->ion_auth->forgotten_password_check($code);

      if ($user)
		{
         // Data to be passed to views
         $data['page_title'] = 'Reset your password';
         $data['menu_item'] = 'Account';

         // Login form validation
         $this->form_validation->set_rules('password', 'Password', 'trim|required');
         $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');

         if ($this->form_validation->run() == FALSE)
         {
            // Loading views
            $this->load->view('template/header', $data);
            $this->load->view('account_reset_password_view');
            $this->load->view('template/footer');
         }
         else
         {
            // $identity = $user->email or username
            $identity = $user->{$this->config->item('identity', 'ion_auth')};
            $password = $this->input->post('password');

            // reset_password() - reset password for provided identity
            if ($this->ion_auth->reset_password($identity, $password))
            {
               $this->session->set_flashdata('message', $this->ion_auth->messages());
               redirect('account/login');
            }
            else
            {
               $this->session->set_flashdata('message', $this->ion_auth->errors());
               redirect('account/reset-password/' . $code);
            }
         }
      }
      else
      {
         $this->session->set_flashdata('message', $this->ion_auth->errors());
         redirect('account/lost-password');
      }
   }

   /**
    * Change email
    */
   public function change_email()
   {

      if (!$this->ion_auth->logged_in())
      {
         redirect('account/login');
      }

      // Data to be passed to views
      $data['page_title'] = 'Change your email';
      $data['menu_item'] = 'Account';

      // Login form validation
      $this->form_validation->set_rules('password', 'Password', 'trim|required');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

      if ($this->form_validation->run() == FALSE)
      {
         // Loading views
         $this->load->view('template/header', $data);
         $this->load->view('account_change_email_view');
         $this->load->view('template/footer');
      }
      else
      {
         // $this->session->identity - get user identity from session
         $identity = $this->session->identity;
         // Get form values
         $password = $this->input->post('password');
         $data['email'] = $this->input->post('email');
         // Get user id
         $user_id = $this->ion_auth->user()->row()->id;

         // Check if password matches
         if ($this->ion_auth->hash_password_db($user_id, $password))
         {
            // update() - Update a user
            if ($this->ion_auth->update($user_id, $data))
            {
               $this->session->set_flashdata('message', $this->ion_auth->messages());
               redirect('account/profile');
            }
            else
            {
               $this->session->set_flashdata('message', $this->ion_auth->errors());
               redirect('account/change-email');
            }
         }
         else
         {
            $this->session->set_flashdata('message', 'The password does not match your stored password.');
            redirect('account/change-email');
         }
      }
   }

   /**
    * Change password
    */
   public function change_password()
   {

      if (!$this->ion_auth->logged_in())
      {
         redirect('account/login');
      }

      // Data to be passed to views
      $data['page_title'] = 'Change your password';
      $data['menu_item'] = 'Account';

      // Login form validation
      $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
      $this->form_validation->set_rules('password', 'Password', 'trim|required');
      $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');

      if ($this->form_validation->run() == FALSE)
      {
         // Loading views
         $this->load->view('template/header', $data);
         $this->load->view('account_change_password_view');
         $this->load->view('template/footer');
      }
      else
      {
         // $this->session->identity - get user identity from session
         $identity = $this->session->identity;
         // Get form values
         $current_password = $this->input->post('current_password');
         $password = $this->input->post('password');

         // Change password for identity
         if ($this->ion_auth->change_password($identity, $current_password, $password))
         {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('account/profile');
         }
         else
         {
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect('account/change-password');
         }
      }
   }

}
