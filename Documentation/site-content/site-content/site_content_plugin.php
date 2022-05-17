<?php

/**
 * Plugin Name:       site-content-plugin
 * Description:       A plugin that haandles site content.
 * Version:           1.0.0
 * Author:            Eronu E.M
 * License: 
 * 
 */
class site_content_manager
{

    function __construct() 
    {   //add_shortcode   
        
        add_shortcode('contact_page', array($this, 'render_contact_form'));
        add_shortcode('calender_page', array($this, 'render_calender_form'));
        add_shortcode('team_page', array($this, 'render_team_form'));
        add_shortcode('about_page', array($this, 'render_about_form'));
        add_shortcode('services_consult_page', array($this, 'render_services_consult_form'));
        add_shortcode('services_train_page', array($this, 'render_services_train_form'));
        add_shortcode('services_estore_page', array($this, 'render_services_estore_form'));
        add_shortcode('product_sites_page', array($this, 'render_product_sites_form'));
        add_shortcode('product_siim_page', array($this, 'render_product_siim_form'));
        add_shortcode('product_eapm_page', array($this, 'render_product_eapm_form'));
      
    }
    
    
   /**
	 * Plugin activation hook.
	 *
	 * Creates all WordPress pages needed by the plugin.
	 */
	public static function plugin_activated() {
		// Information needed for creating the plugin's pages
		$page_definitions = array(
                        'contact_page' => array(
				'title' => __( 'site Contact page', 'site_content_plugin' ),
				'content' => '[contact_page]'
			),
                        'calender_page' => array(
				'title' => __( 'site calender page', 'site_content_plugin' ),
				'content' => '[calender_page]'
			),
                        'team_page' => array(
				'title' => __( 'site team page', 'site_content_plugin' ),
				'content' => '[team_page]'
                            ),
                        'about_page' => array(
				'title' => __( 'site about page', 'site_content_plugin' ),
				'content' => '[about_page]'
                            ),
                        'services_estore_page' => array(
				'title' => __( 'site services estore page', 'site_content_plugin' ),
				'content' => '[services_estore_page]'
                            ),
                        'services_consult_page' => array(
				'title' => __( 'site services consultation page', 'site_content_plugin' ),
				'content' => '[services_consult_page]'
                            ),
                        'services_train_page' => array(
				'title' => __( 'site services training page', 'site_content_plugin' ),
				'content' => '[services_train_page]'
                            ),
                        'product_sites_page' => array(
				'title' => __( 'site product sites page', 'site_content_plugin' ),
				'content' => '[product_sites_page]'
                            ),
                        'product_siim_page' => array(
				'title' => __( 'site product siim page', 'site_content_plugin' ),
				'content' => '[product_siim_page]'
                             ),
                        'product_eapm_page' => array(
				'title' => __( 'site product eAPM page', 'site_content_plugin' ),
				'content' => '[product_eapm_page]'
			)
                    
		);

		foreach ( $page_definitions as $slug => $page ) {
			// Check that the page doesn't exist already
			$query = new WP_Query( 'pagename=' . $slug );
			if ( ! $query->have_posts() ) {
				// Add the page using the data from the array above
				wp_insert_post(
					array(
						'post_content'   => $page['content'],
						'post_name'      => $slug,
						'post_title'     => $page['title'],
						'post_status'    => 'publish',
						'post_type'      => 'page',
						'ping_status'    => 'closed',
						'comment_status' => 'closed',
					)
				);
			}
		}
	}
 
    
    public function render_contact_form($attributes, $content = null)
      {
        // Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
                
        return $this->get_template_html('contact', $attributes);
    }
    
    public function render_calender_form($attributes, $content = null)
      {
        // Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
                
        return $this->get_template_html('calender', $attributes);
    }
    
     public function render_team_form($attributes, $content = null)
      {
        // Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
                
        return $this->get_template_html('team', $attributes);
    }
     public function render_about_form($attributes, $content = null)
      {
        // Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
                
        return $this->get_template_html('about', $attributes);
    }
    public function render_services_estore_form($attributes, $content = null)
      {
        // Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
                
        return $this->get_template_html('services_estore', $attributes);
    }
       public function render_services_consult_form($attributes, $content = null)
      {
        // Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
                
        return $this->get_template_html('services_consult', $attributes);
    } 
  public function render_services_train_form($attributes, $content = null)
      {
        // Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
                
        return $this->get_template_html('services_train', $attributes);
    }
    
     public function render_product_sites_form($attributes, $content = null)
      {
        // Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
                
        return $this->get_template_html('product_sites', $attributes);
    }
     public function render_product_siim_form($attributes, $content = null)
      {
        // Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
                
        return $this->get_template_html('product_siim', $attributes);
    }
     public function render_product_eapm_form($attributes, $content = null)
      {
        // Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
                
        return $this->get_template_html('product_eapm', $attributes);
    }
    
    /**
     * Renders the contents of the given template to a string and returns it.
     *
     * @param string $template_name The name of the template to render (without .php)
     * @param array  $attributes    The PHP variables for the template
     *
     * @return string               The contents of the template.
     */
    private function get_template_html($template_name, $attributes = null)
    {
        if (!$attributes) 
        {
            $attributes = array();
        }

        ob_start();

       // do_action('crud_before_' . $template_name);

        require( 'templates/' . $template_name . '.php');

        //do_action('crud_after_' . $template_name);

        $html = ob_get_contents();
        
        ob_end_clean();
        
        ob_flush(); //output the data in the buffer

        return $html;
    }

   

  } 



// Initialize the plugin
$site_content_plugin = new site_content_manager();

// Create the custom pages at plugin activation
register_activation_hook(__FILE__, array('site_content_manager', 'plugin_activated'));



