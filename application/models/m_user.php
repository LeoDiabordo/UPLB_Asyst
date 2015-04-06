<?php

class M_user extends CI_Model{
    
    function get_details(){
        $stno = $this->session->userdata('student_no');
        $pword = $this->session->userdata('password');
        
        $found_details = $this->db->query("SELECT * FROM graduate WHERE student_no = '$stno' AND password = '$pword'");
        return $found_details->result_array();
    }
    
    function get_posts(){
        $stno = $this->session->userdata('student_no');
        $pword = $this->session->userdata('password');

        // $found_posts = 	$this->db->query("SELECT * FROM post WHERE studentno = '$stno' ORDER BY time DESC");

        $found_posts = $this->db->query("SELECT * FROM post WHERE studentno = '$stno' or studentno IN (select student_no_2 from connection where student_no_1 = '$stno')");
        return $found_posts->result_array();

  //       SELECT t1.name, t2.salary FROM employee t1, info t2
  // WHERE t1.name = t2.name;

    }
	
	function create_post(){	
		$body = $this->input->post('post_body');
        $stno = $this->session->userdata('student_no');
        
		$post = $this->db->query("INSERT INTO `post`(`studentno`, `body`) VALUES ('$stno','$body');");
        return;
       
	} //end of function login

    function get_suggestions(){
        $stno = $this->session->userdata('student_no');

        $batch = substr($stno, 0, 4);
        $found_suggestions = $this->db->query("SELECT * FROM graduate WHERE student_no LIKE '$batch%' AND student_no NOT IN (SELECT student_no_2 FROM connection WHERE student_no_1 = '$stno')");
        return $found_suggestions->result_array();
    }

    function get_suggestions2(){
        $stno = $this->session->userdata('student_no');

        $user_details =  $this->db->query("SELECT * FROM graduate WHERE student_no = '$stno'");
        $batch = substr($stno, 0, 4);
        $found_suggestions = $this->db->query("SELECT * FROM graduate WHERE student_no LIKE '$batch%'");
        return $found_suggestions->result_array();
    }

    function add_connection($stno, $stno2){
        $query = $this->db->query("INSERT INTO connection VALUES ('','$stno', '$stno2')");
        return $query;
    }
}

?>