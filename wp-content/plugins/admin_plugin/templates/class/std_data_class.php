<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class crud_std_data_manager {
    
    public $std_data_table_name = "wpvy_hm_verification";
    
    //
     public function create($verification_no, $surname, $othername, $sex, $level, $faculty, $dept,$email,$phone) 
     {

        global $wpdb;
               
       try {
        $wpdb->insert(
                $this->std_data_table_name, //$table_name,
                array('verification_no' => $verification_no,  'surname' => $surname, 'othername' => $othername, 'sex' => $sex, 'level'=> $level,'faculty'=> $faculty, 'dept'=>$dept, 'email'=>$email, 'phone' => $phone), //data
                array('%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s') //data format	
        );
        
        	return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
        
    }

    

    public function update($verification_no, $surname, $othername, $sex, $level, $faculty, $dept,$email,$phone) 
    {
         global $wpdb;
            
                try
                {
                    $wpdb->update(
                            $this->std_data_table_name, //$table_name,
                                   
                                array(
                                    surname =>$surname,// integer (number)
                                    othername =>$othername,
                                    sex=>$sex, 
                                    level=>$level, 
                                    faculty=>$faculty,
                                    dept=>$dept, 
                                    email=>$email, 
                                    phone=>$phone
                                      ),
                                array(verification_no=>$verification_no),
                                array(
                                    '%s', // value1
                                    '%s', // value1
                                    '%s', // value1
                                    '%d', // value1
                                    '%s',   // value1
                                    '%s',
                                    '%s',
                                    '%s'  ),
                                array( '%s' )
                                );
       			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
        
    }
    
    
   

    public function deletex($verification_no) {
         global $wpdb;
       
       try
       {
       $wpdb->delete( $this->std_data_table_name, array( verification_no => $verification_no ), array( '%s' ) );
        return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
    }

    /* paging */

   
    }  // end of Class

    