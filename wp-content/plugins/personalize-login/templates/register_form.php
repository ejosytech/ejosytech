
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


  <section class="register-photo" style="background-color: transparent;">
      
    <div class="form-container" style="margin-top: 40px;">
        
        <div class="image-holder" style="background: url('<?php bloginfo("template_directory");?>/img/register_form/meeting.jpg') left / cover no-repeat;"></div>
        
        
      
        <form method="post" action="<?php echo wp_registration_url(); ?>"  style="height: 525px;">
             <div class="form-group row">
            
                        <?php if ( $attributes['show_title'] ) : ?>
                        <h3><?php _e( 'Register', 'personalize-login' ); ?></h3>
                        <?php endif; ?>

                        <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
                        <?php foreach ( $attributes['errors'] as $error ) : ?>
			
                        <div class="alert alert-danger" role="alert">
                        <h5><strong>Hi !</strong> <?php echo $error; ?></h5>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
            
                </div>
                
                <h2 class="text-center"><strong>Create an account.</strong></h2>
                
                
                    
            
            <div class="form-group mb-3"><input class="form-control" type="email" name="email" placeholder="Email" /></div>
            <div></div>
            <div class="form-group mb-3"><input class="form-control" type="text" name="last_name" placeholder="Surname" /></div>
            <div class="form-group mb-3"><input class="form-control" type="text" name="other_name" placeholder="Other Names"  /></div>
            
            
            <div class="form-group mb-3">
                <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" />I agree to the license terms.</label></div>
                          
            </div>
            
            <div class="form-group row">
            
               <div class="alert alert-info" role="alert">
                     <?php _e( 'Note: A link will be  emailed to the address you specified above. This is to enable you provide your password', 'personalize-login' ); ?>
                </div>
            </div>
            
            <?php if ( $attributes['recaptcha_site_key'] ) : ?>
			<div class="recaptcha-container">
				<div class="g-recaptcha" data-sitekey="<?php echo $attributes['recaptcha_site_key']; ?>"></div>
			</div>
		<?php endif; ?>
            
            <div class="form-group mb-3"><button id="submitButton" class="btn btn-primary d-block w-100" type="submit" style="color: rgb(255,255,255);background-color: #00b5a8;">Sign Up</button></div><a class="already" href="<?php echo site_url(); ?>/member-login/">You already have an account? Login here.</a>
        
          
        
        
        </form>
    </div>
</section>

   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   