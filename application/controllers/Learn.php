<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Learn extends CI_Controller {



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

	
	/**
	 * This handles adding of lecture notes
	 *
	 * @return void
	 */
	public function AddLessonNote(){
		if (isset($this->session->userdata['Admin_login'])) {

			$data['class'] = $this->input->post('class');
			$data['subject'] = $this->input->post('subject');
			$data['module'] = $this->input->post('module');
			$data['topic'] = $this->input->post('topic');
			$data['writeup'] = $this->input->post('writeup');
			$data['video'] = $this->input->post('video');

		$verify = $this->Home_model->Verify($data);

		if ($verify == false) {
			
			$query = $this->Home_model->AddLessonNote($data);

			$response['error'] = false;
			$response['message'] = 'Lesson Note Added Successfully';
		}
		else {
			$response['error'] = true;
			$response['message'] = 'Course Module Exist';
		}
		
		echo json_encode($response);

		}
		else{
			redirect(base_url());
		}
	}

	/**
	 * Add Classwork for each module
	 * 
	 */

	 public function AddClassWork(){
        if (isset($this->session->userdata['Admin_login'])) {

			// Fetch the Module ID 
			$data['id'] = $this->input->post('id'); // lesson id
			$data['ClassWork'] = $this->input->post('ClassWork');
			$data['score'] = $this->input->post('score');

			$query = $this->Home_model->AddClassWork($data);

			if ($query == false) {
				$response['error'] = false;
			    $response['message'] = 'Class Work Added Successfully';
			}
			else{
				$response['error'] = true;
			    $response['message'] = 'Class Work Not Added';
			}

			echo json_encode($response);
		}
		else{
			redirect(base_url());
		}

	 }

	 /**
	  * There will be options for adding  CBT for the  modules. 
	  */
	
	  public function CbtExamTest(){
        if (isset($this->session->userdata['Admin_login'])) {

			$data['id'] = $this->input->post('id'); // lesson id
			$data['question'] = $this->input->post('question');
			$data['option1'] = $this->input->post('option1');
			$data['option2'] = $this->input->post('option2');
			$data['option3'] = $this->input->post('option3');
			$data['option4'] = $this->input->post('option4');
			$data['answer'] = $this->input->post('answer');
			
			$query = $this->Home_model->CbtExamTest($data);

			if ($query == false) {
				$response['error'] = false;
				$response['message'] = 'Exam Created Successfully';
			}
			else{
				$response['error'] = true;
				$response['message'] = 'Error Creating Exam Model';
			}

			echo json_encode($response);
			
        }
		else {
			redirect(base_url());
		}
	  }

	  /**
	   * Fetch Scores for each Module classwork
	   * in a bid not to reinvent the wheel we will pick the attendance based 
	   * on folks that did thier home work 
	   *
	   * @return void
	   */
	  public function FetchClassScore(){
        if (isset($this->session->userdata['Admin_login'])) {

			$data['classid'] = $this->input->post('classid');
			$data['moduleid'] = $this->input->post('moduleid');

			$query = $this->Home_model->FetchClassScore($data);

			if ($query == false) {
				$response['error'] = false;
				$response['message'] = $query;
			}
			else {
				$response['error'] = true;
				$response['message'] = 'No score found for this module';
			}
			
        }

	  }

	  /**
	   * Chatbox for conversations
	   * 
	   */
	  
	  public function send_message()
	  {
		  $message = $this->input->post('message', null);
		  $nickname = $this->input->post('nickname', '');
		  $guid = $this->input->post('guid', '');
		  
		  $this->Chat_model->add_message($message, $nickname, $guid);
		  
		  $this->_setOutput($message);
	  }
	  
	  
	  public function get_messages()
	  {
		  $timestamp = $this->input->get('timestamp', null);
		  
		  $messages = $this->Chat_model->get_messages($timestamp);
		  
		  $this->_setOutput($messages);
	  }
	  
	  
	  private function _setOutput($data)
	  {
		  header('Cache-Control: no-cache, must-revalidate');
		  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		  header('Content-type: application/json');
		  
		  echo json_encode($data);
	  }


}


