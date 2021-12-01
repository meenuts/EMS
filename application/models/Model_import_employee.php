<?php

class Model_import_employee extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    //get employee details
    function  get_employee(){
     
        $this->db->select('id,employee_code,employee_name,department,dob,date_of_join');
        $this->db->from('employee');
        $query= $this->db->get();
        $result = $query->result_array();
        return $result;
     
    }
    function create_employee($data){
        
        $this->db->insert_batch('employee',$data);
    }
}