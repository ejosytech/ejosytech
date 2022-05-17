
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



<div class="clearfix"></div><br />
   <?php
    if(isset($_SESSION['verification_no_stored'])) {
        $verification_no = $_SESSION['verification_no_stored'];
       
            } else {
        $verification_no = '';
        
            }
		
        global $wpdb;
        
        $user = wp_get_current_user();
             
        $setrow = $wpdb->get_row($wpdb->prepare("select *  FROM $npersonalize->personalize_table_name WHERE verification_no = %s",$user->user_login));
        
         $_SESSION['verification_no_stored'] =  $setrow->verification_no;

?>
<div class="container">
	 
     <form>
 
    <table class='table table-bordered table-responsive'>
 
        <tr>
            <td>Verification No.</td>
            <td><input type='text' name='p_verification_no' class='form-control' value="<?php echo $setrow->verification_no; ?>" readonly required></td>
        </tr>
 
        <tr>
            <td>Surname</td>
            <td><input type='text' name='p_surname' class='form-control' value="<?php echo $setrow->surname; ?>" readonly  required></td>
        </tr>
 
        <tr>
            <td>Other Name</td>
            <td><input type='text' name='p_othername' class='form-control' value="<?php echo $setrow->othername; ?>" readonly  required></td>
        </tr>
 
         <tr>
            <td>Other Name</td>
            <td><input type='text' name='p_course_code' class='form-control' value="<?php echo $setrow->course_code; ?>" readonly  required></td>
        </tr>
        
        <tr>
            <td>Sex</td>
            <td><input type='text' name='p_sex' class='form-control' value="<?php echo $setrow->sex; ?>" readonly  required></td>
        </tr>
        
         <tr>
            <td>Level</td>
            <td><input type='text' name='p_level' class='form-control' value="<?php echo $setrow->level; ?>" required></td>
        </tr>
        <tr>
            <td>Faculty</td>
            <td><input type='text' name='p_faculty' class='form-control' value="<?php echo $setrow->faculty; ?>"  required></td>
        </tr>
        
         <tr>
            <td>Department</td>
            <td><input type='text' name='p_dept' class='form-control' value="<?php echo $setrow->dept; ?>" required></td>
        </tr>
        
         <tr>
            <td>Email</td>
            <td><input type='date' name='p_email' class='form-control' value="<?php echo $setrow->email; ?>" required></td>
        </tr>
        
         <tr>
            <td>Mobile Contact</td>
            <td><input type='time' name='p_phone' class='form-control' value="<?php echo $setrow->phone; ?>" required ></td>
        </tr>
        
        
 
        <tr>
            <td colspan="2">
                
               <!-- <a href="<?php echo wp_logout_url( home_url() ); ?>" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp;Exit</a> -->
                  <a href="<?php echo site_url(); ?>/confirm-availability-of-space/" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp;Accomodation</a> 
                
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

