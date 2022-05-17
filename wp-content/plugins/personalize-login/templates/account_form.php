
<?php

include_once 'class/personalize_class.php';

$npersonalize = new personalize_class();
?>



<?php
 if ( is_user_logged_in() ) 
    {
    $current_user = wp_get_current_user();
    get_header('logout'); 
    }
    else{
    get_header('login'); 
    }
    
    ?>




 <?php   
    global $wpdb;
   
         $retreive_friend_email = $wpdb->get_var($wpdb->prepare("select email FROM $npersonalize->personalize_table_name WHERE email = %s",   $current_user->user_email));
         //echo $retreive_friend_email;
                  
    if   ($retreive_friend_email == "")  
    { 
        $email = $current_user->user_email;
        $surname = "";
        $othername = "";
        $comment = "";
        $mobile = "";
        $user_image = "";
        $user_CV = "";
        
      $npersonalize->create($comment, $email, $mobile, $othername, $surname, $user_image, $user_CV);
    }
    else 
    {
        $setrow = $wpdb->get_row($wpdb->prepare("select * FROM $npersonalize->personalize_table_name WHERE email = %s", $current_user->user_email)); 
     
    }

?>

      
<?php
if(isset($_POST['btn-save']))
   
{
     
        $email  = $_POST['v_email'];
        $surname = $_POST['v_surname'];
        $othername = $_POST['v_othername'];
        $comment = $_POST['v_comment'];
        $mobile = $_POST['v_mobile'];
        
        //// Immage File Processing Begin
        $imgFile = $_FILES['v_user_image']['name'];
        $tmp_dir = $_FILES['v_user_image']['tmp_name'];
        $imgSize = $_FILES['v_user_image']['size'];
                        
        if(empty($imgFile))
         {
            $errMSG = "Please Select Image File.";
         }
         else
        {
      
         $upload_dir = plugin_dir_path( __FILE__ ).'upload/img/'; // upload directory
        // echo $upload_dir;
         $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
        // rename uploading image
        $userpic = rand(1000,1000000).".".$imgExt;
    
        // allow valid image file formats
        if(in_array($imgExt, $valid_extensions)){   
        // Check file size '5MB'
        if($imgSize < 5000000)   
            {
             unlink($upload_dir.$setrow->userPic);
             move_uploaded_file($tmp_dir,$upload_dir.$userpic);
            
            }
            else
            {
            $errMSG = "Sorry, your file is too large.";
            }
                }
        else{
           $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
        }
        }
        
        // CV File Processing Begin
        $file = $_FILES['v_user_CV']['name'];
        $file_loc = $_FILES['v_user_CV']['tmp_name'];
        $file_size = $_FILES['v_user_CV']['size'];
        $file_type = $_FILES['v_user_CV']['type'];
        $folder = plugin_dir_path( __FILE__ ).'upload/cv/';
        
        if (empty($file))
        {
            $errMSG = "Please Select CV File.";
        }
        else 
        {
           $file = rand(1000,100000)."-".$_FILES['v_user_CV']['name'];
           move_uploaded_file($file_loc,$folder.$file); 
        }
        
 
        //
        
        if(!isset($errMSG))
          {
         // Image Processing Ending
           
             wp_redirect("?errMSGx");
               
        }
        
        // Ensure Blank isnt saved when updating either $userpic or $file
        if ($userpic=="")
        {
           $userpic = $setrow->userPic;
        }
        if ($file=="")
        {
           $file = $setrow->userCV;
        }
        
        
        if($npersonalize->update( $email,$comment, $mobile, $othername, $surname,$userpic,$file))
              { 	
            wp_redirect("?inserted");
        }
	 else
        {
              wp_redirect("?failure");
           
        }
        
         
    }
        
?>
    


<section class="register-photo" style="background-color: transparent;">
    
    <?php
if(isset($_GET['inserted']))
{
	?>
    <div class="container">
	<div class="alert alert-info">
    <strong>WOW!</strong> Record was Edited Successfully <a href="<?php echo site_url(); ?>/view-std-data/">HOME</a>!
	</div>
	</div>
    <?php
}
else if(isset($_GET['failure']))
{
	?>
    <div class="container">
	<div class="alert alert-warning">
    <strong>SORRY!</strong> ERROR while Editing record !
	</div>
	</div>
    <?php
}else if(isset($_GET['errMSGx']))
{
	?>
    <div class="container">
	<div class="alert alert-warning">
    <strong>SORRY!</strong> <?php echo $errMSG; ?> 
	</div>
	</div>
    <?php
}
?>
    
       
        <div class="container">

 	
	 <form method='post' enctype="multipart/form-data">
             
             <?php
             
             if ($retreive_friend_email <> "")
                 
             {
                 ?>
            
 
    <table class='table table-bordered table-responsive'>
 
        <tr>
            <td>Email</td>
            <td><input type='text' name='v_email' value ='<?php echo $current_user->user_email;?>' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Surname</td>
            <td><input type='text' name='v_surname' value="<?php echo $setrow->surname; ?>"  class='form-control'  required></td>
        </tr>
        
         <tr>
            <td>Other Names</td>
            <td><input type='text' name='v_othername' value="<?php echo $setrow->othernames; ?>" class='form-control'  required></td>
        </tr>
        
        <tr>
            <td>Mobile</td>
            <td><input type='text' name='v_mobile' value="<?php echo $setrow->mobile; ?>" class='form-control'  required></td>
        </tr>
        
        <tr>
            <td>Comment</td>
            <td><input type='text' name='v_comment' value="<?php echo $setrow->comment; ?>" class='form-control'   required></td>
        </tr>
        
        <tr>
            <td>Upload File</td>
            <td>
                <?php  $imagloadpath = plugin_dir_url(__FILE__).'upload/img/'.$setrow->userPic; ?>
                <img src="<?php echo $imagloadpath; ?>" class="img-rounded" width="250px" height="250px" />
                <input  type="file" name="v_user_image" accept="image/*"/>
            </td>
        </tr>
        
          <tr>
            <td>CV Upload</td>
            <td>
                <?php  $cvloadpath = plugin_dir_url(__FILE__).'upload/cv/'.$setrow->userCV; ?>
                <a href="<?php echo $cvloadpath ?>" target="_blank">view file</a>
                <input  type="file" name="v_user_CV" />
            </td>
        </tr>
        
       
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save"><span class="glyphicon glyphicon-plus"></span> Update </button>  
            <a href="<?php echo site_url(); ?>/view-std-data/" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
            </td>
        </tr>
 
    </table>
             
              <?php
             
             }
             
             else
                
             {
             ?>
             
      <table class='table table-bordered table-responsive'>
 
        <tr>
            <td>Email</td>
            <td><input type='text' name='v_email' value ='<?php echo $current_user->user_email;?>' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Surname</td>
            <td><input type='text' name='v_surname' value=" "  class='form-control'  required></td>
        </tr>
        
         <tr>
            <td>Other Names</td>
            <td><input type='text' name='v_othername' value="" class='form-control'  required></td>
        </tr>
        
        <tr>
            <td>Mobile</td>
            <td><input type='text' name='v_mobile' value="" class='form-control'  required></td>
        </tr>
        
        <tr>
            <td>Comment</td>
            <td><input type='text' name='v_comment' value="" class='form-control'   required></td>
        </tr>
        
       <tr>
            <td>Upload Image File</td>
            <td><input  type="file" name="v_user_image" accept="image/*"/></td>
        </tr>
        
        <tr>
            <td>Upload CV</td>
            <td><input  type="file" name="v_user_CV"/></td>
        </tr>
        
       
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save"><span class="glyphicon glyphicon-plus"></span> Update </button>  
            <a href="<?php echo site_url(); ?>/view-std-data/" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
            </td>
        </tr>
 
    </table>         
             
                 
            <?php
            
            
             }
             
             
                ?>
          
         
         </form>
     
     
</div>

 </section>



 

