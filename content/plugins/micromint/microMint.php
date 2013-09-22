<?php
/*
Plugin Name: &micro;Mint Plugin
Plugin URI: http://compu.terlicio.us/code/plugins/mint/
Description: Automatically adds the required mint tracking informatino without any fat. Requires <a href="http://haveamint.com/">Mint</a>
Version: 0.4
Author: Christopher O'Connell
Author URI: http://compu.terlicio.us/
****************************************************
This software is licensed under the creative commons 2.0 license, available at http://creativecommons.org/licenses/by-nc-sa/2.0/.

*/
?>
<?php

$MICROMINT_VERSION = "0.4 Release 1";
$MICROMINT_INTERVAL = "10 minutes";

// Hook to add scripts
add_action('admin_menu','mm_add_pages');
add_action('admin_head','mm_admin_head');
add_action('wp_head','mm_head');
add_action("plugins_loaded", "mm_init");
register_activation_hook( __FILE__, 'mm_install' );

// See if we need to install/update
if (get_option('mm_version') != $MICROMINT_VERSION) mm_setup($MICROMINT_VERSION);

// Run the plugin
if (get_option('mm_integrate_stats') == 'true') {
	if( strtotime(get_option('mm_updated_stats')) < strtotime("now -$MICROMINT_INTERVAL") ) {
		mm_get_xml();
	}
}

// PluginsLoaded Init
function mm_init() {
	if (get_option('mm_integrate_stats') == 'true') {
		register_sidebar_widget('&micro;Mint', 'mm_widget');
		register_widget_control('&micro;Mint', 'mm_widget_control', 400, 300 );
	}     
}

// Add the script
function mm_add_pages() {
	// Add a new submenu under options
	add_options_page('&micro;Mint','&micro;Mint',6,'micromint','mm_manage_page');
}
// Add Admin Header
function mm_admin_head() {
	if ($_GET['page'] == 'micromint') {
		wp_enqueue_script('jquery');
	}
}

// AAdd the page header
function mm_head() {
	if (get_option('mm_track') != 'false') {
		echo "<script src='".get_option('mm_mint_location')."/?js' type='text/javascript'></script>\n";
	}
}

// Management Page
function mm_manage_page() {
	include_once('microMint.admin.php');
}

// Install Function
function mm_install() {
	// Minimum Safe Values
	update_option('mm_mint_location',get_option('siteurl')."/mint");
	update_option('mm_integrate_stats','false');
	update_option('mm_show_dashboard','true');
	update_option('mm_track','false');
	
	update_option('mm_widget_total_title','Total Visitors:');
	update_option('mm_widget_unique_title','Unique Visitors:');
}

// Setup Function
function mm_setup($MICROMINT_VERSION) {
	update_option('mm_version',$MICROMINT_VERSION);
	update_option('mm_updated_stats',date("r",strtotime("January 1, 1971")));	// Make sure that we perform a fresh get upon updating.
}

// Call the API and get data
function mm_get_xml() {
	update_option('mm_updated_stats',(string)date("r"));
	if ( get_option('mm_integration_technique') == 'local') {
		update_option('mm_last_get','Local Integration Technique Not Supported');
		return;
	} else if ( (get_option('mm_integrate_stats') == 'true') && (get_option('mm_api_key') != false) ) {
		$api_url = get_option('mm_mint_location')."/";
		if (get_option('mm_integration_technique') == 'expose') {
			$api_url .= "pepper/84degrees/expose/api.php?api=".get_option('mm_api_key')."&method=micro:basic";
		} else if (get_option('mm_integration_technique') == 'micro') {
			$api_url .= "pepper/chrisoconnell/microapi/api.php?api=".get_option('mm_api_key')."&method=micro:basic";
		} else {
			update_option('mm_last_get','Invalid Integration Technique');
			return;
		}
		update_option('mm_last_get_url',$api_url);
		$curl = curl_init($api_url);
		$xml_log = fopen(dirname(__FILE__)."/result.xml","w");
		curl_setopt($curl,CURLOPT_FILE,$xml_log);
		$return = curl_exec($curl);
		fclose($xml_log);
		if ( $return != false ) {
			mm_parse_xml();
			update_option('mm_last_get','ok');
		} else {
			update_option('mm_last_get',curl_error($curl));
		}
		curl_close($curl);
	} else {
		update_option('mm_last_get','Invalid Configuration (is your API key blank?)');	
	}
}

// Parse the retrieved XML
function mm_parse_xml() {
	try {
		update_option('mm_last_parse_error','ok');
		$xml = new SimpleXMLElement(dirname(__FILE__)."/result.xml",NULL,TRUE);
	} catch (Exception $e) {
		update_option('mm_last_parse_error',$e->getMessage());
	}
	if (get_option('mm_last_parse_error') == 'ok') {
		if (isset($xml->head)) {
			update_option('mm_last_parse_error','Unexpected Response');
			update_option('mm_last_get',"The last response from the API was unexpected. Are you sure you have the correct api selected?");
			update_option('mm_debug_data',print_r($xml,true));
			return;
		}
		if (!isset($xml->error)) {
			update_option('mm_debug_data',print_r($xml,true));
			update_option('mm_all_time_total',(int)$xml->visits->all_time->total);
			update_option('mm_all_time_unique',(int)$xml->visits->all_time->unique);
			update_option('mm_this_week_total',(int)$xml->visits->this_week->total);
			update_option('mm_this_week_unique',(int)$xml->visits->this_week->unique);
			update_option('mm_today_total',(int)$xml->visits->today->total);
			update_option('mm_today_unique',(int)$xml->visits->today->unique);
			update_option('mm_stats_calculated',(string)$xml->visits->today->dtime);
		} else {
			update_option('mm_last_parse_error','Error Response');
			update_option('mm_last_get',(string)$xml->error);
			update_option('mm_debug_data',print_r($xml,true));
		}
	}
}

// Create the widget
function mm_widget($args) {
  extract($args);
  echo $before_widget;
  echo $before_title."<img style='vertical-align: middle' src='".get_option('siteurl')."/wp-content/plugins/micromint/images/Mint.gif' />"; echo stripslashes(get_option('mm_widget_title')); echo $after_title;
  mm_widget_body();
  echo $after_widget;
}

// Widget body
function mm_widget_body() {
	require_once('microMint.widget.php');
}

// Widget Control
function mm_widget_control() { 
	include('microMint.widgetControl.php');
}

if ( (get_option('mm_show_dashboard') == 'true') && (get_option('mm_integrate_stats') == 'true') ) {
	
	if (get_option('db_version') < 9000) {	// Pre 2.7
		// Register Dashboard
		add_action('wp_dashboard_setup', 'mm_register_dashboard_widget');
		function mm_register_dashboard_widget() {
			wp_register_sidebar_widget('dashboard_mm', __('<img style="vertical-align: middle" src="'.get_option('siteurl').'/wp-content/plugins/micromint/images/Mint.gif" />&micro;Mint Stats', 'microMint'), 'dashboard_mm',
				array(
				'all_link' => get_option('mm_mint_location'), // Example: 'index.php?page=wp-useronline/wp-useronline.php'
				//'feed_link' => 'Full URL For "RSS" link', // Example: 'index.php?page=wp-useronline/wp-useronline-rss.php'
				'width' => 'half', // OR 'fourth', 'third', 'half', 'full' (Default: 'half')
				'height' => 'single', // OR 'single', 'double' (Default: 'single')
				)
			);
		}
		 
		// Add Dashboard Widget
		add_filter('wp_dashboard_widgets', 'mm_add_dashboard_widget');
		function mm_add_dashboard_widget($widgets) {
			global $wp_registered_widgets;
			if (!isset($wp_registered_widgets['dashboard_mm'])) {
				return $widgets;
			}
			array_splice($widgets, sizeof($widgets)-4, 0, 'dashboard_mm');
			array_splice($widgets, sizeof($widgets)-1,0,NULL);
			return $widgets;
		}
		 
		// Print Dashboard Widget
		function dashboard_mm($sidebar_args) {
			global $wpdb;
			extract($sidebar_args, EXTR_SKIP);
			echo $before_widget;
			echo $before_title;
			echo $widget_name;
			echo $after_title;
			require_once('microMint.dashboard.php');
			echo $after_widget;
		}
	} else {	// 2.7 +
		add_action('wp_dashboard_setup', 'mm_register_dashboard_widget');
		function mm_register_dashboard_widget() {
			wp_register_sidebar_widget('dashboard_mm', __('<img style="vertical-align: middle" src="'.get_option('siteurl').'/wp-content/plugins/micromint/images/Mint.gif" />&micro;Mint Stats', 'microMint'), 'dashboard_mm',
				array(
				'all_link' => get_option('mm_mint_location'), // Example: 'index.php?page=wp-useronline/wp-useronline.php'
				//'feed_link' => 'Full URL For "RSS" link', // Example: 'index.php?page=wp-useronline/wp-useronline-rss.php'
				'width' => 'half', // OR 'fourth', 'third', 'half', 'full' (Default: 'half')
				'height' => 'single', // OR 'single', 'double' (Default: 'single')
				)
			);
			wp_add_dashboard_widget( 'mm_info', __('<img style="vertical-align: middle" src="'.get_option('siteurl').'/wp-content/plugins/micromint/images/Mint.gif" />&micro;Mint Stats', 'microMint'), 'mm_info_widget' );
		}		
		
		function mm_info_widget() {
			require_once('microMint.dashboardNew.php');
		}
	}
} // Dashboard