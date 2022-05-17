<?php if ( is_user_logged_in() ) 
    {
    get_header('logout'); 
    }
   else{
 get_header('login'); 
    }
?>

 <div class="login-clean">
   
      <form  name="resetpassform" id="resetpassform" action="<?php echo site_url( 'wp-login.php?action=resetpass' ); ?>" method="post" autocomplete="off">
        <input type="hidden" id="user_login" name="rp_login" value="<?php echo esc_attr( $attributes['login'] ); ?>" autocomplete="off" />
        <input type="hidden" name="rp_key" value="<?php echo esc_attr( $attributes['key'] ); ?>" />
            
            <div class="form-group row">
                <?php if ( $attributes['show_title'] ) : ?>
            <div class="row">
            <div class="alert alert-info" role="alert">
            <h3><?php _e( 'Pick a New Password', 'personalize-login' ); ?></h3>
            </div>
                </div>
            <?php endif; ?>                         
            </div>
        
        <!--  DISPLAY MESSAGES/COMMENTS/WARNING BEGIN  --->
        
        <div class="form-group row">
          <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
            <?php foreach ( $attributes['errors'] as $error ) : ?>
                <div class="alert alert-info" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>  
        </div>
            
          
        <!--  DISPLAY MESSAGES/COMMENTS/WARNING END  --->
           <!--Form Top    -->
     
        <h2 class="sr-only">Login Form</h2>
        <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
        
         <!--Form Buttom    --> 
            
           <!--  <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" /></div>-->
            <div class="form-group"><input class="form-control" type="password" name="pass1" placeholder="New password" /></div>
            <div class="form-group"><input class="form-control" type="password" name="pass2" placeholder="Repeat new password" /></div>
            
             <div class="form-group"><?php echo wp_get_password_hint(); ?></div>
             
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="submit" >Reset Password</button></div>
        </form>
    </div>