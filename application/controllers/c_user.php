<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_user extends CI_Controller 
{
    var $data;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->data['user'] = $this->m_user->get_details();
    }
    
    function index(){
        if($this->session->userdata('logged_in')){
            
            $data = $this->data;
            $data['posts'] = $this->m_user->get_posts();
            
            $this->load->view('v_userheader', $data);
            $this->load->view('v_user');
            $this->load->view('v_footer');
        }
        else  
            redirect('c_index','refresh');
    }

    function create_post(){
        $this->m_user->create_post();
        redirect('/c_user/','refresh');	

    }
    
    function logout(){
		$this->session->sess_destroy();	
		redirect('/c_index/','refresh');	
	}
    
    function update_information(){
        $data = $this->data;
        
        $this->load->view('v_userheader', $data);
        $this->load->view('v_userinfo');
        $this->load->view('v_footer');
    }
    
    function add_connection(){
        $data = $this->data;

        $data['suggestions'] = $this->m_user->get_suggestions2();
        $data['smart_suggestions'] = $this->m_user->get_suggestions();
        
        $this->load->view('v_userheader', $data);
        $this->load->view('v_addconnection');
        $this->load->view('v_footer');
    }

    function add(){
        $data = $this->data;
        $stno = $this->session->userdata('student_no');
        $stno2 = $_GET['stno2'];

        $this->m_user->add_connection($stno, $stno2);

        redirect('/c_user/add_connection','refresh');
    }
    
    
}