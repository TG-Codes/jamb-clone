<?php

class Home_model extends CI_Model {
 
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


	public function Validate($data){
		
	  $condition = "email =" . "'" . $data['email'] . "'";
	  $this->db->select('*');
      $this->db->from('users');
      $this->db->where($condition);
      $this->db->limit(1);
      $query = $this->db->get();
      
      if ($query->num_rows() > 0) {
      return true;
      } else {
      return false;
      }
	}

	public function register($data){
		return $this->db->insert('users', $data);

	}

     // login user
    public function Login($user) {

      $condition = "email =" . "'" . $user['email'] . "' AND " . "password =" . "'" . $user['password'] . "'";
      $this->db->select('*');
      $this->db->from('users');
      $this->db->where($condition);
      $this->db->limit(1);
      $query = $this->db->get();
      
      if ($query->num_rows() == 1) {
      return true;
      } else {
      return false;
      }
      

	}
	
	// fetch  user details
	public function fetch_details($email) {

		$condition = "email =" . "'" . $email . "'";
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
		return $query->result();
		} else {
		return false;
		}
	}

   
		// check double entries for class
	public function DoubleEntriesClass($data){
		$condition = "ClassNum = " . "'" . $data['ClassNum'] . "' AND " . "ClassSection =" . "'" . $data['ClassSection'] . "' AND " . "ClassName =" . "'" . $data['ClassName'] . "'";
		$this->db->select('*');
		 $this->db->from('TblClass');
		 $this->db->where($condition);
		 $this->db->limit(1);
		 $query = $this->db->get();
		 
		 if ($query->num_rows() > 0) {
		 return true;
		 } else {
		 return false;
		 }

	 }
	public function CreateClass($data){
		return $this->db->insert('TblClass', $data);
	}
// fetch class
	public function ViewClass(){
		 $this->db->select('*');
		 $this->db->from('TblClass');
		 $this->db->order_by("ClassName, ClassNum ASC");
		 $query = $this->db->get();
		 return $query->result();
	}

	// fetch subject
	public function ViewSubjects(){
		 $this->db->select('*');
		 $this->db->from('TblSubject');
		 $query = $this->db->get();
		 return $query->result();
	}
	
	// check double entries for Subject
	public function DoubleEntriesSubject($data){
		$condition = "SubjectName=" . "'" . $data['SubjectName'] . "' AND " . "SubjectCode =" . "'" . $data['SubjectCode'] . "'";
		$this->db->select('*');
		 $this->db->from('TblSubject');
		 $this->db->where($condition);
		 $this->db->limit(1);
		 $query = $this->db->get();
		 
		 if ($query->num_rows() > 0) {
		 return true;
		 } else {
		 return false;
		 }

	 }
	public function CreateSubject($data){
		return $this->db->insert('TblSubject', $data);
	}

	public function DeleteCreatedClass($data){
		$this->db->where('class_id', $data['class_id']);
		$this->db->delete('TblClass');
	}
	 // Double check subject combination
	public function Verify($data){
		$condition = "SubjectName=" . "'" . $data['SubjectName'] . "' AND " . "ClassName =" . "'" . $data['ClassName'] . "'";
		$this->db->select('*');
		 $this->db->from('SubjectCombi');
		 $this->db->where($condition);
		 $this->db->limit(1);
		 $query = $this->db->get();
		 
		 if ($query->num_rows() > 0) {
		 return true;
		 } else {
		 return false;
		 }
	}
	// Add Subject Combination
	public function AddSubjectCombination($data){
		return $this->db->insert('SubjectCombi', $data);
	}
	
	public function SubjectCombo($data){

	     $this->db->select('*');
		 $this->db->from('SubjectCombi');
		 $this->db->where('ClassName', $data['ClassName']);
		 $query = $this->db->get();
		 return $query->result();
	}

	// Add Students
	public function AddStudents($data){
		return $this->db->insert('Students', $data);

	}
	// Verify Admin Number
	public function VerifyAdminNum($AdminNum){
		$this->db->select('*');
		 $this->db->from('Students');
		 $this->db->where('AdminNum', $AdminNum);
		 $this->db->limit(1);
		 $query = $this->db->get();
		 
		 if ($query->num_rows() > 0) {
		 return true;
		 } else {
		 return false;
		 }
	}
	 // Double check registered subject
	 public function Doublecheck($data1){
		$condition = "AdminNum=" . "'" . $data1['AdminNum'] . "' AND " . "SubjectName =" . "'" . $data1['SubjectName'] . "'";
		$this->db->select('SubjectName');
		 $this->db->from('RegSub');
		 $this->db->where($condition);
		 $this->db->limit(1);
		 $query = $this->db->get();
		 
		 if ($query->num_rows() > 0) {
		 return true;
		 } else {
		 return false;
		 }
	}

	// Register Student's Subjects
	public function RegisterSubjects($data1){
		return $this->db->insert('RegSub', $data1);
	}

	// View student based on class list
	public function ViewclassList($data) {
		$condition = "Class=" . "'" . $data['Class'] . "' AND " . "Status =" . "'" . 'active' . "'";
		$this->db->select('*');
		$this->db->from('Students');
		$this->db->where($condition);
		$query = $this->db->get();
		return $query->result();
	}

	// Update class 
	public function EditSingleClass($data) {
		$this->db->where('class_id', $data['class_id']);
		$this->db->update('TblClass', $data);
	}

	// View Subject Combination
	public function ShowSubjectCombination($data) {
		$this->db->select('*');
		$this->db->from('SubjectCombi');
		$this->db->where('ClassName', $data['ClassName']);
		$query = $this->db->get();
		return $query->result();
	}

	// Delete Specific Subject combination 
	public function DeleteSpecificSubCombination ($data){
		$this->db->where('CombId', $data['CombId']);
      	$this->db->delete('SubjectCombi');
	}

	// Reset the whole term and session 
	public function ResetOlldTerm(){
		$data = array(
			'Status' => 'Not Active',
			'Publish' => 'Not Ready'
			);
		$this->db->set($data);
		$this->db->update('Session');

	}

	// Term and Session Set
	public function SessionSet($data){
		return $this->db->insert('Session', $data);
	}

	// verify term double entries for term and sesion 
	public function VerifySession($data){
		$condition = "Term=" . "'" . $data['Term'] . "' AND " . "Session =" . "'" . $data['Session'] . "'";
		$this->db->select('*');
		 $this->db->from('Session');
		 $this->db->where($condition);
		 $this->db->limit(1);
		 $query = $this->db->get();
		 
		 if ($query->num_rows() > 0) {
		 return true;
		 } else {
		 return false;
		 }
	}

	// View Session and Semester
	public function ViewSessionAndTerm(){
		$this->db->select('*');
		$this->db->from('Session');
		$this->db->where('Status', 'Active');
		$query = $this->db->get();
		return $query->result();
	}

	public function SetActiveSesion($data){
		$this->db->where('id', $data['id']);
		$this->db->update('Session', $data);
	}

	public function DeleteSpecificSession($data){
		$this->db->where('id', $data['id']);
      	$this->db->delete('Session');
	}

	public function SessionTerm (){
		$this->db->select('*');
		$this->db->from('Session');
		$this->db->where('Status', 'Active');
		$query = $this->db->get();
		if ($query != "") 
		{
		return $query->result();
		}
		else {
		  return false;
		}
	  }

	public function FetchRegSubjects($data){

		$this->db->select('*');
		$this->db->from('RegSub');
		$this->db->where('AdminNum', $data['AdminNum']);
		$query = $this->db->get();
		if ($query != "") 
		{
		return $query->result();
		}
		else {
		  return false;
		}
	}


	// Double check added result data
	public function DoublecheckAddResult($data1){
		$condition = "AdminNum=" . "'" . $data1['AdminNum'] . "' AND " . "SubjectName =" . "'" . $data1['SubjectName'] . "'";
		$this->db->select('*');
		 $this->db->from('TblResult');
		 $this->db->where($condition);
		 $this->db->limit(1);
		 $query = $this->db->get();
		 
		 if ($query->num_rows() > 0) {
		 return true;
		 } else {
		 return false;
		 }
	}

	// Add Result
	public function AddResult($data1){
		return $this->db->insert('TblResult', $data1);
	}

	// Doublecheck Avarege
	public function  ScoresDoublecheck($data){
		$condition = "AdminNum = " . "'" . $data['AdminNum'] . "' AND " . "Term =" . "'" . $data['Term'] . "' AND " . "Session =" . "'" . $data['Session'] . "'";
		$this->db->select('*');
		 $this->db->from('TblPosition');
		 $this->db->where($condition);
		 $this->db->limit(1);
		 $query = $this->db->get();
		 
		 if ($query->num_rows() > 0) {
		 return true;
		 } else {
		 return false;
		 }
	}
	
	// Add Result
	public function AddAverage($data){
		return $this->db->insert('TblPosition', $data);
	}

	//  Avarege
	public function  FindTotal($data){
		$condition = "AdminNum = " . "'" . $data['AdminNum'] . "' AND " . "Term =" . "'" . $data['Term'] . "' AND " . "Session =" . "'" . $data['Session'] . "'";
		$this->db->select_sum('Total');
		$this->db->from('TblResult');
		$this->db->where($condition);
		$query = $this->db->get();
		return $query->result();	 
	}

	// D
	public function  NumberRows($data){
		$condition = "AdminNum = " . "'" . $data['AdminNum'] . "' AND " . "Term =" . "'" . $data['Term'] . "' AND " . "Session =" . "'" . $data['Session'] . "'";
		$this->db->select('*');
		$this->db->from('TblResult');
		$this->db->where($condition);
		$query = $this->db->get();
		return $query->num_rows();	 
	}

	public function FetchAddedResult($data){
		
		$condition = "AdminNum = " . "'" . $data['AdminNum'] . "' AND " . "Term =" . "'" . $data['Term'] . "' AND " . "Session =" . "'" . $data['Session'] . "'";
		$this->db->select('*');
		$this->db->from('TblResult');
		$this->db->where($condition);
		$query = $this->db->get();
		return $query->result();
   }

   public function EditResult($data1){
      $condition = "AdminNum = " . "'" . $data1['AdminNum'] . "' AND " . "Term =" . "'" . $data1['Term'] . "' AND " . "Session =" . "'" . $data1['Session'] . "' AND " . "SubjectName =" . "'" . $data1['SubjectName'] . "'";      
		$this->db->where($condition);
		$this->db->update('TblResult', $data1);
   }

   public function EditAvareage($data){
		$condition = "AdminNum = " . "'" . $data['AdminNum'] . "' AND " . "Term =" . "'" . $data['Term'] . "' AND " . "Session =" . "'" . $data['Session'] . "'";
		$this->db->where($condition);
		$this->db->update('TblPosition', $data);
   }

   public function DeleteResults($data){

	$condition = "AdminNum = " . "'" . $data['AdminNum'] . "' AND " . "Session =" . "'" . $data['Session'] . "' AND " . "Term =" . "'" . $data['Term'] . "'";      
    $this->db->where($condition);
    $this->db->delete('TblResult');
   }

   public function DeleteAvarage($data){

	$condition = "AdminNum = " . "'" . $data['AdminNum'] . "' AND " . "Session =" . "'" . $data['Session'] . "' AND " . "Term =" . "'" . $data['Term'] . "'";      
    $this->db->where($condition);
    $this->db->delete('TblPosition');
   }

   public function AllTermSession(){
	$this->db->select('*');
	$this->db->from('Session');
	$this->db->order_by("id desc");
	$query = $this->db->get();
	return $query->result();
   }

   public function ClassMasterResult($data){
	$condition = "Session = " . "'" . $data['Session'] . "' AND " . "Term =" . "'" . $data['Term'] . "' AND " . "Class =" . "'" . $data['Class'] . "'";
	$this->db->select('*');
	$this->db->from('TblPosition');
	$this->db->where($condition);
	$this->db->order_by("TotalScore DESC");
	$query = $this->db->get();
	return $query->result();
   }

   public function SingleStudentResult($data){
    $condition = "Session = " . "'" . $data['Session'] . "' AND " . "Term =" . "'" . $data['Term'] . "' AND " . "Class =" . "'" . $data['Class'] . "' AND " . "AdminNum =" . "'" . $data['AdminNum'] . "'";      
	$this->db->select('*');
	$this->db->from('TblResult');
	$this->db->where($condition);
	$query = $this->db->get();
	return $query->result();
   }

   public function FetchStdDetails($data){
    $condition = "Session = " . "'" . $data['Session'] . "' AND " . "Term =" . "'" . $data['Term'] . "' AND " . "Class =" . "'" . $data['Class'] . "' AND " . "AdminNum =" . "'" . $data['AdminNum'] . "'";      
	$this->db->select('*');
	$this->db->from('TblPosition');
	$this->db->where($condition);
	$query = $this->db->get();
	return $query->result();
   }
// Total Student in a class
   public function TotalClassStudent ($data) {
	$condition = "Session = " . "'" . $data['Session'] . "' AND " . "Term =" . "'" . $data['Term'] . "' AND " . "Class =" . "'" . $data['Class'] . "'";
	$this->db->select('*');
	$this->db->from('TblPosition');
	$this->db->where($condition);
	$id = $this->db->get()->num_rows();
    return $id;
}
// fetch single student details
public function FetchSingleStudent($data){
	$this->db->select('*');
	$this->db->from('Students');
	$this->db->where('AdminNum', $data['AdminNum']);
	$query = $this->db->get();
	return $query->result();

}

// Determin position 
public function StudentPosition($AdminNum, $Class, $Session, $Term){
	//$this->db->query("SET @rownum := 0");	
	$this->db->query("SELECT rank FROM ( SELECT @rownum := @rownum + 1 AS rank, TotalScore, Class, Term, `TblPosition`.`Session`, AdminNum FROM TblPosition WHERE Class = '".$Class."'  AND Term = '".$Term."'  AND `TblPosition`.`Session` = '".$Session."'  ORDER BY TotalScore DESC ) as result WHERE AdminNum = '".$AdminNum."' ")->result();

	//$query = $this->db->get('rank');

}

// Delete Student
public function DeleteStudent($data) {
	$this->db->where('AdminNum', $data['AdminNum']);
	$this->db->delete('Students');
}

//  once student records are deleted, wipe our registered subjects
public function DeleteStudentSubject($data){
	$this->db->where('AdminNum', $data['AdminNum']);
	$this->db->delete('RegSub');
}

public function MakeInactive($data){

	$this->db->set('Status', $data['Status']);
	$this->db->where('AdminNum', $data['AdminNum']);
	$this->db->update('Students');
}

public function Females(){
	$this->db->select('*');
	$this->db->from('Students');
	$this->db->where('Gender', 'Female');
	$id = $this->db->get()->num_rows();
    return $id;
}

public function Males(){
	$this->db->select('*');
	$this->db->from('Students');
	$this->db->where('Gender', 'Male');
	$id = $this->db->get()->num_rows();
    return $id;
}


}
?>
