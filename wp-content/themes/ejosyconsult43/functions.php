<?php 

//---------------- SESSION MANAGEMENT BEGIN------------------ 
add_action('init', 'myStartSession', 1);
add_action('wp_logout', 'myEndSession');
//add_action('wp_login', 'myEndSession');

function myStartSession() {
    if(!session_id()) {
        session_start();
    }
    }

function myEndSession() {
    session_destroy ();
    }

//---------------- SESSION MANAGEMENT END------------------ 


//---------------- JAVASCRIPT INTEGRATION BEGIN ----------- 

function wpbootstrap_scripts_with_jquery()
{
  
	// De-register the built in jQuery
   	 wp_deregister_script('jquery');
    	 wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), null, false); 
    	// Load it in your theme
    	wp_enqueue_script( 'jquery' );
        
       
	// Register the script like this for a theme:
	wp_register_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'bootstrap-script' );

        // Register the script like this for a theme:
	wp_register_script( 'theme-script', get_template_directory_uri() . '/js/theme.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'theme-script' );
        
        // Register the script like this for a theme:
	wp_register_script( 'smoothproducts.min-script', get_template_directory_uri() . '/js/smoothproducts.min.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'smoothproducts.min-script' );
        
        
        wp_enqueue_script( 'cloudflare', 'https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js', array(), '1.0.0', true );
       
}
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );


//---------------- JAVASCRIPT INTEGRATION END -----------

//---------------- THEME STYLESHEETS INTEGRATION BEGIN -----------

function theme_styles()  
{ 
	// Load all of the styles that need to appear on all pages
	wp_enqueue_style( 'bootstrap43css', get_template_directory_uri() . '/css/bootstrap.min.css' );
        wp_enqueue_style( 'smoothproducts', get_template_directory_uri() . '/css/smoothproducts.css' );
        
        wp_enqueue_style( 'Login-Form-Clean', get_template_directory_uri() . '/css/Login-Form-Clean.css' );
        wp_enqueue_style( 'Registration-Form-with-Photo', get_template_directory_uri() . '/css/Registration-Form-with-Photo.css' );
         wp_enqueue_style( 'Portfolio', get_template_directory_uri() . '/css/portfolio.css' );
      
        
        wp_register_style( 'cloudflare_pikaday_css', 'https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css' );
        wp_enqueue_style('cloudflare_pikaday_css');
        
        wp_register_style( 'cloudflare_baguetteBox_css', 'https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css' );
        wp_enqueue_style('cloudflare_baguetteBox_css');
       
}
add_action('wp_enqueue_scripts', 'theme_styles');

//---------------- THEME STYLESHEETS INTEGRATION END-----------

//---------------- FONTS  INTEGRATION BEGIN -----------

  function fonts_loader() 
  {
 
wp_enqueue_style( 'font_ionicons', get_template_directory_uri() . '/fonts/ionicons.min.css' );
wp_enqueue_style( 'simple-line-icons.min', get_template_directory_uri() . '/fonts/simple-line-icons.min.css' );

wp_register_style( 'googleapis_Montserrat_css', 'https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i' );
wp_enqueue_style('googleapis_Montserrat_css');
 
} 
add_action( 'wp_enqueue_scripts', 'fonts_loader' );

//---------------- FONTS  INTEGRATION END -----------

//---------------- CUSTOMISED EMAIL NOTIFICATION BEGIN -----------
add_filter( 'wp_new_user_notification_email_admin', 'custom_wp_new_user_notification_email', 10, 3 );

function custom_wp_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {
    $wp_new_user_notification_email['subject'] = sprintf( '[%s] New user %s registered.', $blogname, $user->user_login );
    $wp_new_user_notification_email['message'] = sprintf( "%s ( %s ) has registerd to your blog %s.", $user->user_login, $user->user_email, $blogname );
    return $wp_new_user_notification_email;
}
//---------------- CUSTOMISED EMAIL NOTIFICATION END -----------

//---------------- REMOVE ADMIN BAR BEGIN -----------

show_admin_bar(false);
// add_action('after_setup_theme', 'remove_admin_bar');
 
// function remove_admin_bar() {
// if (!current_user_can('administrator') && !is_admin()) {
//  show_admin_bar(false);
//}
//}
//---------------- REMOVE ADMIN BAR END -----------