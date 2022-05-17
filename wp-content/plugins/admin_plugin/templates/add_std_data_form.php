
<?php

include_once 'class/std_data_class.php';

$ncrud = new crud_std_data_manager();

?>

<?php

if(isset($_POST['btn-save']))
   
{
        $verification_no  = $_POST['p_verification_no'];
        $surname = $_POST['p_surname'];
        $othername = $_POST['p_othername'];
        $sex = $_POST['p_sex'];
        $level = $_POST['p_level'];
        $faculty = $_POST['p_faculty'];
        $dept = $_POST['p_dept'];
        $email = $_POST['p_email'];
        $phone = $_POST['p_phone'];
       
	

if ($ncrud->create($verification_no, $surname, $othername, $sex, $level, $faculty, $dept,$email,$phone))
        { 	
            wp_redirect("?inserted");
        }
	 else
        {
              wp_redirect("?failure");
           
        }
}
 ?>

<?php if ( is_user_logged_in() ) 
    {
    get_header('logout'); 
    }
   else{
 get_header('login'); 
    }
?>

<div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
	?>
    <div class="container">
	<div class="alert alert-info">
    <strong>WOW!</strong> Record was inserted successfully <a href="<?php echo site_url(); ?>/view-std-data/">HOME</a>!
	</div>
	</div>
    <?php
}
else if(isset($_GET['failure']))
{
	?>
    <div class="container">
	<div class="alert alert-warning">
    <strong>SORRY!</strong> ERROR while inserting record !
	</div>
	</div>
    <?php
}

?>

<div class="clearfix"></div><br />

<div class="container">

 	
	 <form method='post'>
 
    <table class='table table-bordered table-responsive'>
 
        <tr>
            <td>Verification No.</td>
            <td><input type='text' name='p_verification_no' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Surname</td>
            <td><input type='text' name='p_surname' class='form-control' required></td>
        </tr>
        
         <tr>
            <td>Other Names</td>
            <td><input type='text' name='p_othername' class='form-control' required></td>
        </tr>
        
        <tr>
            <td>Sex</td>
            <td><input type='text' name='p_sex' class='form-control' required></td>
        </tr>
        
        <tr>
            <td>Level</td>
            <td><input type='text' name='p_level' class='form-control' required></td>
        </tr>
        
         <tr>
            <td>Faculty.</td>
            <td><input type='text' name='p_faculty' class='form-control' required></td>
        </tr>
        
         <tr>
            <td>Department</td>
            <td><input type='text' name='p_dept' class='form-control' required></td>
        </tr>
        
         <tr>
            <td>Email</td>
            <td><input type='text' name='p_email' class='form-control' required></td>
        </tr>
        
        <tr>
            <td>Mobile No.</td>
            <td><input type='text' name='p_phone' class='form-control' required></td>
        </tr>
        
       
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Create New Record
			</button>  
            <a href="<?php echo site_url(); ?>/view-std-data/" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

