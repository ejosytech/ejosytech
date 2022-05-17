<?php

include_once 'class/personalize_class.php';

$npersonalize = new personalize_class();

?>

<?php if ( is_user_logged_in() ) 
    {
    get_header('logout'); 
    }
   else{
 get_header('login'); 
    }
?>

<div class="container">
      
    <div class="row">
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
      
    <h2 class="display-3">Verification</h2>
    
    <h4>We need to confirm your Enrolment for this session's programme </h4>

    <form action="#" method ="POST">
  
      <div class="form-group row">
            
             <label for="verification-entry-text" class="col-sm-4 col-form-label col-form-label-lg"><h4>Verification Number</h4></label>   
             <input type="text" class="form-control form-control-lg" name="entry_verification_no" id="verification-entry-text"  placeholder="Fill in your Matric"  />
                
                </div>  
        
     <button class="btn  btn-primary" type="submit" name="btn-check">Verify Status</button>
    
    </form>    
           
                <?php 
            if  (isset($_POST['entry_verification_no']))
                {
                $postvalue_name = $_POST['entry_verification_no'];
                
       
              // check the database for the presence of student
                global $wpdb;
                $retreived_verification_no = $wpdb->get_var($wpdb->prepare("select verification_no FROM $npersonalize->personalize_table_name WHERE verification_no = %s",   $postvalue_name));
                //$retreived_verification_no = $wpdb->get_var($wpdb->prepare("select verification_no FROM wpvy_hm_verification WHERE verification_no = %s",   $postvalue_name));
                }
               

        //if ($postvalue_name = $retreived_verification_no)
                if ($postvalue_name = $retreived_verification_no)
        { 
           
                ?>  
            <div class="alert alert-success" role="alert">
            <strong>Hi!</strong> <?php _e( 'You are currently <strong> ENROLLED </strong> in this Session Programme' ); ?>
            </div>
    
            <?php 
        //
            $_SESSION['verification_no_stored'] =  $retreived_verification_no;
            
           
            
           wp_redirect("member-register/" );
           
            exit;
 
            }
             else
                {
                 
             ?>  
                <div class="alert alert-danger" role="alert">
                <strong>Hi!</strong> <?php _e( 'You are currently <strong>NOT ENROLLED</strong>in this Session Programme' ); ?>
                </div>
    
    
            <?php

             
                }
 
                
         ?>    
        

 
 </div>
 </div>
     </div>

