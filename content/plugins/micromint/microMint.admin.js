// JavaScript Document
function toggle_stats_input(speed) {
	if (jQuery("#mm_integrate_stats").attr("checked") == true) {
		jQuery("#mm_api_config").show(speed);
	} else {
		jQuery("#mm_api_config").hide(speed);
	}
}
function toggle_api(speed) {
	if (jQuery("#mm_integration_technique_expose").attr("checked") == true) {
		jQuery("#mm_api_expose_warning").slideDown(speed).animate({backgroundColor: 'pink'}, 2500);
	} else {
		jQuery("#mm_api_expose_warning").hide(speed).animate({backgroundColor: '#FF667F'}, 1);
	}
	if (jQuery("#mm_integration_technique_local").attr("checked") == true) {
		jQuery("#mm_api_key_row").hide(speed);
		jQuery("#mm_api_local_row").slideDown(speed);
	} else {
		jQuery("#mm_api_key_row").slideDown(speed);
		jQuery("#mm_api_local_row").hide(speed);
	}
}
jQuery(document).ready(function() {
    toggle_stats_input("fast");
	toggle_api("fast");
    jQuery("#mm_integrate_stats").mouseup(function() {
		setTimeout("toggle_stats_input('slow')",30);
	});
	jQuery("#mm_integration_technique_expose,#mm_integration_technique_micro,#mm_integration_technique_local").mouseup(function() {
		setTimeout("toggle_api('slow')",30);																															
	});
});