<?php
/**
* @package amicritasEpaper
*/
/*
Plugin Name:  Amicritas Epaper
Plugin URI:   https://amicritas.com/plugins
Description:  Simple Epaper Plugin
Version:      1.0.0
Author:       Team Amicritas
Author URI:   https://amicritas.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  amiepaper
Domain Path:  /languages
*/

defined( 'ABSPATH' ) or die( 'Hey! You can not access to this' );

/**
* Epaper Plugin Class
*/
class amicritas_epaper
{
	function __construct(){
		add_action('admin_menu', array($this,'epaper_creation'));
		add_action('admin_enqueue_scripts',array($this,'epaper_admin_enque_scripts'));
		//add script to frontend page
		add_action('wp_enqueue_scripts',array($this,'epaper_page_enque_script'));
		add_option( 'amicritas', 'bj3224jhgf', '', 'yes' );
		//Template fallback
		add_action("template_redirect", array($this,'my_theme_redirect'));
		add_filter('query_vars', array($this,'add_state_var') , 0, 1);
		
	}
	
	function activation(){
		//add menu to dashboard
		$this->epaper_creation();
		//add epaper page template
		$this->my_theme_redirect();
		//rewrite rules
		add_rewrite_rule('^epaper/([^/]*)/?','index.php?post_type=page&name=epaper&epaperpage=$matches[1]','top');
		//flush rewrite rules
		flush_rewrite_rules();

	}

	function deactivation(){
		delete_option( 'amicritas' );
		delete_option( 'epaper_saved' );
		//flush rewrite rules
		flush_rewrite_rules();
	}

	function uninstall(){

	}

	function epaper_creation(){
		add_menu_page('Epaper Options','Epaper','manage_options','epaper_options','epaper_create_page','dashicons-admin-page',112);
		
		$upload = wp_upload_dir();
    	$upload_dir = $upload['basedir'];
    	$upload_dir = $upload_dir . '/epaperimg';
    	if (! is_dir($upload_dir)) {
       		mkdir( $upload_dir, 0755 );
    	}
	}

	function epaper_admin_enque_scripts($hook){

	if('toplevel_page_epaper_options' != $hook){return;}

	wp_register_style( 'admin-styles',  plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css' );
	wp_enqueue_style( 'admin-styles' );

	wp_register_style( 'date-styles', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
	wp_enqueue_style( 'date-styles' );

	wp_register_script( 'jQuery-ami', 'https://code.jquery.com/jquery-1.12.4.js' );
	wp_enqueue_script('jQuery-ami');
	wp_register_script( 'jQuery-ui-ami', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js' );
	wp_enqueue_script('jQuery-ui-ami');
	wp_register_script('epaper_script', plugin_dir_url( __FILE__ ) . 'js/epaper-admin.js', array('jquery'), '1.0');
	wp_enqueue_script('epaper_script');

	wp_register_script( 'epaper_custom_script', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js' );
	wp_enqueue_script('epaper_custom_script');

	}

	function epaper_page_enque_script(){
		if (is_page('epaper')) {
			wp_register_style('epaper-style-ami', plugin_dir_url( __FILE__ ) . 'css/style.css');
			wp_enqueue_style( 'epaper-style-ami' );
			wp_register_script( 'jQuery-fancybox-ami', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js' );
			wp_enqueue_script('jQuery-fancybox-ami');
			wp_register_style( 'fancy-styles', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css' );
			wp_enqueue_style( 'fancy-styles' );
			wp_register_script( 'jQuery-fancy-ami', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js' );
			wp_enqueue_script('jQuery-fancy-ami');
			wp_register_script( 'fancy-front-ami', plugin_dir_url( __FILE__ ) . 'js/epaper.page.js');
			wp_enqueue_script('fancy-front-ami');

		}
	}

	function my_theme_redirect() {
	    global $wp;
	    $plugindir = dirname( __FILE__ );
	    if ($wp->query_vars["pagename"] == 'epaper') {
	        $templatefilename = 'page-epaper.php';
	        if (file_exists(TEMPLATEPATH . '/' . $templatefilename)) {
	            $return_template = TEMPLATEPATH . '/' . $templatefilename;
	        } else {
	            $return_template = $plugindir . '/templatefile/' . $templatefilename;
	        }
	        do_theme_redirect($return_template);
	    }
	}
	
	
	function add_state_var($vars){
    $vars[] = 'epaperpage';
    return $vars;
	}

}

if (class_exists('amicritas_epaper')) {
	# code...
	$amicritas = new amicritas_epaper();
}


function epaper_create_page(){

	echo '<h1>Upload Your Epaper</h1>';

	require_once(plugin_dir_path( __FILE__ ) . '/includes/epaper.php');

}


function do_theme_redirect($url) {
    global $post, $wp_query;
    if (have_posts()) {
        include($url);
        die();
    } else {
        $wp_query->is_404 = true;
    }
}


// Activation

register_activation_hook(__FILE__, array($amicritas, 'activation' ));

// Deactivation

register_deactivation_hook(__FILE__, array($amicritas, 'deactivation'));

// Uninstall
