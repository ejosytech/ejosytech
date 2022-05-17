
<?php if ( is_user_logged_in() ) 
    {
    get_header('logout'); 
    }
   else{
 get_header('login'); 
    }
?>

<div class="login-form-container">
	<?php if ( $attributes['show_title'] ) : ?>
		<h2><?php _e( 'Sign In', 'personalize-login' ); ?></h2>
	<?php endif; ?>

	
	<!--  PHP enclose opens here
        
	//	wp_login_form(
	//		array(
	//			'label_username' => __( 'Email', 'personalize-login' ),
	//			'label_log_in' => __( 'Sign In', 'personalize-login' ),
	//			'redirect' => $attributes['redirect'],
	//		)
	//	);
        
        // PHP enclose closes here  -->
        


    <div class="login-clean">
        <form method="post" action="<?php echo wp_login_url(); ?>" >
           
            <!--  DISPLAY MESSAGES/COMMENTS/WARNING BEGIN  --->
            <div class="form-group row">
            
                        <!-- Show errors if there are any -->
                <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
		<?php foreach ( $attributes['errors'] as $error ) : ?>
			  <div class="alert alert-info" role="alert">
				<?php echo $error; ?>
			</div>
		<?php endforeach; ?>
                <?php endif; ?>

                <!-- Show logged out message if user just logged out -->
                <?php if ( $attributes['logged_out'] ) : ?>
                <div class="alert alert-info" role="alert">
                <strong>Hi !</strong> <?php _e( 'You have signed out. Would you like to sign in again?', 'personalize-login' ); ?>
                </div>
		
                <?php endif; ?>
        
                <!-- Show successfully registered -->
                <?php if ( $attributes['registered'] ) : ?>
		<div class="alert alert-info" role="alert">
			<?php
                        
                             //printf(
			     // 	__( 'You have successfully registered to <strong>%s</strong>. We have emailed your password to the email address you entered.', 'personalize-login' ),
			     //  	get_bloginfo( 'name' )
			     //     );
				printf(
					__( 'You have successfully registered to <strong>%s</strong>. We have provided a link to the email address you entered. This is to enable you enter your password', 'personalize-login' ),
					get_bloginfo( 'name' )
				);
			?>
		  </div>
                <?php endif; ?>
        
                <!-- Show Check your email for a link to reset your password -->
        
                <?php if ( $attributes['lost_password_sent'] ) : ?>
                <div class="alert alert-info" role="alert">
                <?php _e( 'Check your email for a link to enter new password or reset your password.', 'personalize-login' ); ?>
                </div>
                <?php endif; ?>
        
                <!-- Show password has been changed-->
                <?php if ( $attributes['password_updated'] ) : ?>
                <div class="alert alert-info" role="alert">
                    <?php _e( 'Your password has been changed. You can sign in now.', 'personalize-login' ); ?>
                </div>
                <?php endif; ?>

                </div>   
            <!--  DISPLAY MESSAGES/COMMENTS/WARNING END  --->
            
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
           <!--  <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" /></div>-->
            <div class="form-group"><input class="form-control" type="text" name="log" placeholder="Email" /></div>
            <div class="form-group"><input class="form-control" type="password" name="pwd" placeholder="Password" /></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div><a class="forgot" href="<?php echo wp_lostpassword_url(); ?>">Forgot your email or password?</a>
        </form>
    </div>

</div>