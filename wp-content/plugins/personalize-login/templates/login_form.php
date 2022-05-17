
<?php if ( is_user_logged_in() ) 
    {
    get_header('logout'); 
    }
   else{
 get_header('login'); 
    }
?>

<div id="main-wrapper" class="container">
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

     <section class="register-photo" style="background-color: transparent;"> 
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card border-0">
                <div class="card-body p-0">
                    <div class="row no-gutters">
                       
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="mb-5">
                                    <h3 class="h4 font-weight-bold text-theme">Login</h3>
                                </div>
                                <h6 class="h5 mb-0">Welcome back!</h6>
                                <p class="text-muted mt-2 mb-5">Enter your email address and password to access admin panel.</p>
                                
            <form method="post" action="<?php echo wp_login_url(); ?>">
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
            
                        
                                    <div class="form-group"><label for="exampleInputEmail1">Email address</label><input id="exampleInputEmail1" class="form-control" type="email" name="log" /></div>
                                    <div class="form-group mb-5"><label for="exampleInputPassword1">Password</label><input id="exampleInputPassword1" class="form-control" type="password" name="pwd" /></div>
                                    
                                    
                                    <button class="btn btn-theme" type="submit">Login</button><a class="forgot-link float-right text-primary" href="<?php echo wp_lostpassword_url(); ?>">Forgot password?</a>
             
            </form>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-inline-block">
                            <div class="account-block rounded-right">
                                <div class="overlay rounded-right"></div>
                                <div class="account-testimonial">
                                    <h4 class="text-white mb-4">This beautiful theme yours!</h4>
                                    <p class="lead text-white">&quot;Best investment i made for a long time. Can only recommend it for other users.&quot;</p>
                                    <p>- Admin User</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-muted text-center mt-3 mb-0">Don&#39;t have an account? <a class="text-primary ml-1" href="<?php echo site_url(); ?>/member-register/">register</a></p>
        </div>
   
</div>
         
     </section>