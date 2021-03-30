<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {



	 function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->helper('form', 'url');
        $this->load->library('session');
        $this->load->helper('download');
		$this->load->library('form_validation');
		$this->load->library('pagination');

    }

    // This handles the pages
	public function view ($page = 'Ndudim')
	{
		if( !file_exists('application/views/'.$page.'.php'))
		{
			show_404();
		}
        elseif ($page == 'welcome_message') {
                    

            $this->load->view($page);

        }
        else {
            
            $this->load->view($page);
        }
		       
	}

	public function register(){

		// PHP Should accept these html entities 
		$data['fname'] = $this->input->post('fname');
		$data['mname'] = $this->input->post('mname');
		$data['lname'] = $this->input->post('lname');
		$data['address'] = $this->input->post('address');
		$data['phone'] = $this->input->post('phone');
		$data['state'] = $this->input->post('state');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');

		/*8$data['fnmae']
		$data = array(
			'fname' => $this->input->post('fname'),

		);*/



		// validate double entires 

		$query = $this->Home_model->Validate($data);

		if($query == false){
			// submit the form to the db 

			$query2 = $this->Home_model->register($data);

			$response['error'] = false;
<<<<<<< Updated upstream
			$response['message'] = 'Your Registration was Successful';
=======
			$response['message'] = 'Submitted';
>>>>>>> Stashed changes
		}
		else{
			$response['error'] = true;
			$response['message'] = 'User Already EXist';
		}

		echo json_encode($data);
	}

}