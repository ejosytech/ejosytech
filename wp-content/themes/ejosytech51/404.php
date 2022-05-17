
<?php
/*
  Template Name: Error 404 Page 
 */
?>
<?php if ( is_user_logged_in() ) 
    {
    get_header('logout'); 
    }
   else{
 get_header('login'); 
    }
?>

<div class= "container">
    
  <img src="<?php echo site_url();?>\wp-content\themes\ejosyConsult4\uploads\images\error_page\img1.jpeg" alt="Site Under Construction">

</div>