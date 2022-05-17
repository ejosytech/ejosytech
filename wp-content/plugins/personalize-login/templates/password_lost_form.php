<?php if ( is_user_logged_in() ) 
    {
    get_header('logout'); 
    }
   else{
 get_header('login'); 
    }
?>



<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
    <?php foreach ( $attributes['errors'] as $error ) : ?>
       <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
       </div>
    <?php endforeach; ?>
<?php endif; ?>


  <section class="register-photo" style="background-color: transparent;">
      
    <div class="row justify-content-center">
  
 
   
      <form  action="<?php echo wp_lostpassword_url(); ?>" method="post" autocomplete="off">
        
          <!--  DISPLAY MESSAGES/COMMENTS/WARNING END  --->  
          
             <?php if ( $attributes['show_title'] ) : ?>
                <div  class="row">
                <div class="alert alert-info" role="alert">
                    <h3><?php _e( 'Forgot Your Password?', 'personalize-login' ); ?></h3>
                </div>
                </div>
                <?php endif; ?>
    
            <div  class="form-group">
                <div class="alert alert-info" role="alert">
                    <?php
                    _e(
                "Enter your email address and we'll send you a link you can use to pick a new password.",
                'personalize_login'
                        );
                    ?>
                    </div>
             </div> 
          
     
        <!--  DISPLAY MESSAGES/COMMENTS/WARNING END  --->
           <!--Form Top    -->
             
         <!--Form Buttom    --> 
            
           <!--  <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" /></div>-->
            <div class="form-group"><input class="form-control" type="text" name="user_login" placeholder="Email" /></div>
                  
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="submit" >Reset Password</button></div>
        </form>
    
          </div>
      
      </section>