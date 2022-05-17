<?php

/**
 * Plugin Name:       CRUD_Student_Data
 * Description:       A plugin that that implements Create, Read, Update and Delete Utilities for student data management.
 * Version:           1.0.0
 * Author:            Eronu E.M
 * License:           GPL-2.0+
 * Text Domain:       Student Data Management
 */
class CRUD_Student_Data
{

    function __construct() 
    {   //add_shortcode   
        add_shortcode('view-std-data-page', array($this, 'render_view_std_data_form'));
        add_shortcode('add-std-data-page', array($this, 'render_add_std_data_form'));
        add_shortcode('edit-std-data-page', array($this, 'render_edit_std_data_form'));
        add_shortcode('erase-std-data-page', array($this, 'render_delete_std_data_form'));
        //
      
    }

   /**
	 * Plugin activation hook.
	 *
	 * Creates all WordPress pages needed by the plugin.
	 */
	public static function plugin_activated() {
		// Information needed for creating the plugin's pages
		$page_definitions = array(
                        'delete-std-data' => array(
				'title' => __( 'Student Erase Data', 'student_data_manager' ),
				'content' => '[erase-std-data-page]'
			),
			'view-std-data' => array(
				'title' => __( 'Student View Data', 'student_data_manager' ),
				'content' => '[view-std-data-page]'
			),
                        'edit-std-data' => array(
				'title' => __( 'Student Edit Data', 'student_data_manager' ),
				'content' => '[edit-std-data-page]'
			),
			'add-std-data' => array(
				'title' => __( 'Student Add Data', 'student_data_manager' ),
				'content' => '[add-std-data-page]'
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
 
    
    
    
     public function render_view_std_data_form($attributes, $content = null)
    {
        // Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
        
        return $this->get_template_html('view_std_data_form', $attributes);
    }
    
      public function render_add_std_data_form($attributes, $content = null)
      {
        // Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
                
        return $this->get_template_html('add_std_data_form', $attributes);
    }
     public function render_delete_std_data_form($attributes, $content = null)
      {
        // Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
                
        return $this->get_template_html('erase_std_data_form', $attributes);
    }
     public function render_edit_std_data_form($attributes, $content = null)
      {
        // Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
                
        return $this->get_template_html('edit_std_data_form', $attributes);
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
$CRUD_Student_Data_plugin = new CRUD_Student_Data();

// Create the custom pages at plugin activation
register_activation_hook(__FILE__, array('CRUD_Student_Data', 'plugin_activated'));
