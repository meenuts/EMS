<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
    
    
    
    
     public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form','general_helper');
       
    }

   public function index()
	{
            
            $this->load->model("model_import_employee");
            $view_data['employee_details'] = $this->model_import_employee->get_employee();
           
            $this->load->library('upload'); 
           
            if($this->input->post('import')){
             
            if (empty($_FILES['employee_list_file']['name']))
            {
               
                $this->form_validation->set_rules('employee_list_file', 'Document', 'required');
            }
            
            if(!empty(($_FILES['employee_list_file']['name']))){
               
                $file = $_FILES["employee_list_file"]['tmp_name'];
                $type = $_FILES["employee_list_file"]['type'];
                $ext = strrchr($_FILES["employee_list_file"]['name'], '.');
               
                $row = 1;
                $this->load->library('Csvimport'); 
                $this->load->helper('general_helper'); 
                if($ext=='.csv' && $file ){
                if (($handle = fopen($file, "r")) !== FALSE) {
                $header = array('Employee Code','Name','Department','Date of Birth','Joining Date'); 
                $csv_head = array();
 
                $employee=array();
                $row_count =0;
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    
                  $row_count++;
                  $mismatch_list=array();
                  $col_count = count($data);
                  
                  if($col_count==5){
                       
                        if($row==1){
                            $csv_head[0]=$data[0];
                            $csv_head[1]=$data[1];
                            $csv_head[2]=$data[2];
                            $csv_head[3]=$data[3];
                            $csv_head[4]=$data[4];

                        }
                        else{
                            
                            $create_employee['employee_code']=$data[0];
                            $create_employee['employee_name'] = $data[1]; 
                            $create_employee['department'] = $data[2];
                            $create_employee['dob'] = $data[3]?to_date_format($data[3]):"";
                            $create_employee['date_of_join'] = $data[4]?to_date_format($data[4]):"";
                            $employee[]=$create_employee;
 
                   }
                   
                  }
                   $row++;
                   
                }  
                 
                if($header!=$csv_head){
                  
                    $this->session->set_flashdata('msg','header_error');
                }
                if($row_count>=20){
                     $this->session->set_flashdata('msg','row_error');
                }
                
                   
                if(isset($employee) && $row_count<20 && $header==$csv_head){
                       
                        if($employee){
                            $this->model_import_employee->create_employee($employee);
                            $this->session->set_flashdata('msg','success');
                                         
                        }
                }
                 
                }
               
                } 
            
            }
           
            $this->load->library('user_agent');
            redirect($this->agent->referrer());

	}
         $this->load->view('view_employee',$view_data);
}


}


