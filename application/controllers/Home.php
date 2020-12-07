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
	public function view ($page = 'Home')
	{
		if( !file_exists('application/views/'.$page.'.php'))
		{
			show_404();
		}
        elseif ($page == 'login') {
                    

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

		// validate double entires 

		$query = $this->Home_model->Validate($data);

		if($query == false){
			// submit the form to the db 

			$query2 = $this->Home_model->register($data);

			$response['error'] = false;
			$response['message'] = 'Your Registerations was Successful';
		}
		else{
			$response['error'] = true;
			$response['message'] = 'User Already Exist';
		}

		echo json_encode($response);
	}



		

}
