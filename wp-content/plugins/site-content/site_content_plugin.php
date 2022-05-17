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
        add_shortcode('cv_page', array($this, 'render_cv_form'));
        add_shortcode('project_page', array($this, 'render_project_form'));
      
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
                        'cv_page' => array(
				'title' => __( 'site cv page', 'site_content_plugin' ),
				'content' => '[cv_page]'
			),
                        'project_page' => array(
				'title' => __( 'site project page', 'site_content_plugin' ),
				'content' => '[project_page]'
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
                
        return $this->get_template_html('ramsme_contact', $attributes);
    }
    
    public function render_cv_form($attributes, $content = null)
      {
        // Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
                
        return $this->get_template_html('ramsme_rules', $attributes);
    }
    public function render_project_form($attributes, $content = null)
      {
        // Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
                
        return $this->get_template_html('ramsme_constitution', $attributes);
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



