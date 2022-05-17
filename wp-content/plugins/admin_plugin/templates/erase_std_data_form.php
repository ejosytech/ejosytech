<?php
include_once 'class/std_data_class.php';
$ncrud = new crud_std_data_manager();
?>

<?php

if(isset($_POST['btn-del']))
{
	$verification = $_GET['delete_id'];
	$ncrud->deletex($verification);
        ?>
<?php 
        wp_redirect("?deleted");
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

<div class="container">

	<?php
	if(isset($_GET['deleted']))
	{
		?>
        <div class="alert alert-success">
    	<strong>Success!</strong> record was deleted... 
		</div>
        <?php
	}
	else
	{
		?>
        <div class="alert alert-danger">
    	<strong>Sure !</strong> to remove the following record ? 
		</div>
        <?php
	}
	?>	
</div>



<div class="clearfix"></div>


<div class="container">
 	
	 <?php
	 if(isset($_GET['delete_id']))
	 {
             $verification = $_GET['delete_id'];
             
		 ?>
         <table class='table table-bordered'>
         <tr>
            <th>Verification No.</th>
            <th>surname</th>
            <th>Other names</th>
            <th>Sex</th>
            <th>Level</th>
            <th>Faculty</th>
            <th>Department</th>
            <th>Email</th>
            <th>Phone</th>
          </tr>
         <?php
         
         global $wpdb;
             
        $setrow = $wpdb->get_row($wpdb->prepare("select * FROM $ncrud->std_data_table_name WHERE verification_no = %s", $verification));
        
        
             ?>
             <tr>
                    <td class="manage-column ss-list-width"><?php echo  $setrow->verification_no; ?></td>
                    <td class="manage-column ss-list-width"><?php echo  $setrow->surname; ?></td>
                    <td class="manage-column ss-list-width"><?php echo  $setrow->othername; ?></td>
                    <td class="manage-column ss-list-width"><?php echo  $setrow->sex; ?></td>
                    <td class="manage-column ss-list-width"><?php echo  $setrow->level; ?></td>
                    <td class="manage-column ss-list-width"><?php echo  $setrow->faculty; ?></td>
                    <td class="manage-column ss-list-width"><?php echo  $setrow->dept; ?></td> 
                    <td class="manage-column ss-list-width"><?php echo  $setrow->email; ?></td> 
                    <td class="manage-column ss-list-width"><?php echo  $setrow->phone; ?></td>
                   
             </tr>
            
         </table>
       <?php  
                 }
                 
	 ?>
</div>

<div class="clearfix"></div>


    
<div class="container">
<p>

<?php
if(isset($_GET['delete_id']))
{
	?>
  	<form method="post">
    <input type="hidden" name="matric_no" value="<?php echo $setrow->verification_no; ?>" />
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
    <a href="<?php echo site_url(); ?>/view-std-data/" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
	<?php
}
else
{
	?>
    <a href="<?php echo site_url(); ?>/view-std-data/" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
    <?php
}
?>
</p>
</div>
    
	
    
	
