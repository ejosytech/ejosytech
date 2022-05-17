<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of personalize_class
 *
 * @author Emmanuel Eronu
 */
class personalize_class 
{
    public $personalize_table_name = "friends";
    
     //
     public function create($comment,$email, $mobile, $othername, $surname, $user_image, $user_CV) 
     {
         global $wpdb;
         try {
        $wpdb->insert(
                $this->personalize_table_name, //$table_name,
                array('comment' => $comment,'email'=>$email, 'mobile' => $mobile,'othernames' => $othername, 'surname' => $surname, 'userPic' => $user_image, 'userCV' => $user_CV), //data
                array('%s', '%s', '%s', '%s','%s','%s','%s' ) //data format	
        );       
        	return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
     }
     
      public function update($email, $comment, $mobile, $othername, $surname, $user_image, $user_CV) 
    {         
          global $wpdb;
                   try               
                   {
                    $wpdb->update(
                            $this->personalize_table_name, //$table_name,
                            
                                array(
                                    'surname' =>$surname,
                                    'othernames' =>$othername,
                                    'mobile' =>$mobile,
                                    'comment' =>$comment,
                                    'userPic' => $user_image,
                                    'userCV' => $user_CV
                                    ),
                                array('email'=>$email),
                                array(
                                    '%s', // value1
                                    '%s', // value1
                                    '%s', // value1
                                    '%s', // value1
                                    '%s'
                                    ),
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
}
