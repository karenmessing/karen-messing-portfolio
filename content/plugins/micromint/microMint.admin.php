<?php
// MicroMint Admin Page

// Business Logic
if (isset($_POST['action'])) {
	if (!isset($_POST['_wpnonce'])) die("There was a problem authenticating. Please log out and log back in");
	if (!check_admin_referer('mm-update_options')) die("There was a problem authenticating. Please log out and log back in");
	if ($_POST['action'] == 'update') {
		if (isset($_POST['mm_track'])) {
			update_option('mm_track','true');
		} else {
			update_option('mm_track','false');
		}
		if(isset($_POST['mm_api_key']) && ($_POST['mm_api_key'] != "")) {
			update_option('mm_api_key',$_POST['mm_api_key']);
		}
		update_option('mm_api_url',$_POST['mm_api_url']);
		update_option('mm_mint_location',$_POST['mm_mint_location']);
		update_option('mm_integration_technique',$_POST['mm_integration_technique']);	
		if (isset($_POST['mm_integrate_stats'])) {
			// If we are enabling stats, retrieve the stats
			if (get_option('mm_integrate_stats') == 'false') {
				update_option('mm_integrate_stats','true');
				mm_get_xml();
			}
			update_option('mm_integrate_stats','true');
		} else {
			update_option('mm_integrate_stats','false');
		}
		if (isset($_POST['mm_show_dashboard'])) {
			update_option('mm_show_dashboard','true');
		} else {
			update_option('mm_show_dashboard','false');
		}
		?><div class="updated"><p><strong>Options Updated</strong></p></div><?php
	}
}


?>
<div class="wrap">
	<h2><img style="vertical-align: middle" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/micromint/images/Mint.gif" />&micro;Mint Management Page</h2>
    <p>Hey, it's "zero config" turn it on or not, m'kay?</p>
    <?php if (isset($_GET['debug'])) { 
			mm_get_xml();
	?>
    <p><strong>Debug Info</strong></p>
    <ul>
    	<li>Last Request: <?php echo get_option('mm_last_get'); ?></li>
        <li>Parse Error: <?php echo get_option('mm_last_parse_error'); ?></li>
        <li>Totals: All Time <?php echo get_option('mm_all_time_total'); ?> | Today <?php echo get_option('mm_today_total'); ?> | This Week <?php echo get_option('mm_this_week_total'); ?></li>
        <li>Stats Retrieved: <?php echo date("F j, Y, g:i a",strtotime(get_option('mm_updated_stats'))); ?></li>
        <li>Stats Calculated: <?php echo date("F j, Y, g:i a",strtotime(get_option('mm_stats_calculated'))); ?></li>
        <li>Stats Offset: <?php echo date("F j, Y, g:i a",strtotime("now -10 minutes")); ?></li>
        <li>Debug Data: <br /><?php echo get_option('mm_debug_data'); ?></li>
        <li>API URL: <?php echo get_option('mm_last_get_url'); ?></li>
    </ul>
    <?php } //Debug?>
    <?php if (get_option('mm_integrate_stats') == 'true') {
		if (get_option('mm_last_get') != 'ok') {
			?><div class="updated" style="background:#FF667F; border-color:#990000"><p><strong>Error Retriving Stats: </strong><?php echo get_option('mm_last_get'); ?></p></div><?php
		}
		if (get_option('mm_last_parse_error') != 'ok') {
			?><div class="updated" style="background:#FF667F; border-color:#990000"><p><strong>Error Parsing Stats: </strong><?php echo get_option('mm_last_parse_error'); ?></p></div><?php
		}
	} // Error Messages ?>		
    <p>&micro;Mint Version: <em><?php echo get_option('mm_version'); ?></em></p>
    <form id="ma_options" name="ma_options" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="post">
    <h3>Basic Configuration</h3>
    <p>Unless you want to get jiggy, this is all you need</p>
    <table class="form-table" id="ma_basic_config">
    	<tbody>
        	<tr valign="top">
            	<th scope="row">Track Stats</th>
                <td>
                	<input type="checkbox" name="mm_track" id="mm_track" <?php if (get_option('mm_track') == 'true') echo "checked"; ?> />
                    <label for="mm_track">Track stats using mint?</label>
                    <br />
                    <span class="explanatory-text">Whether or not to include the tracking code for mint.</span>
                </td>
            </tr>
            <tr valign="top">
            	<th scope="row">Mint Location</th>
                <td>
                	<input type="textbox" name="mm_mint_location" id="mm_mint_location" size="50" value="<?php echo get_option('mm_mint_location'); ?>" />
                    <label for="mm_mint_location">Mint Installation Location</label>
                    <br />
                    <span class="explanatory-text">Where mint is installed, absolute path. Thus, the "default location" is <?php echo get_option('siteurl'); ?>/mint</span>
                </td>
         	</tr>
        </tbody>
    </table>
    <h3>Mint Integration</h3>
    <p>Do you want to show off your minty stats here in wordpress?</p>
    <table class="form-table" id="ma_mint_integration">
    	<tbody>
        	<tr valign="top">
            	<th scope="row">Integrate Stats</th>
                <td>
                	<input type="checkbox" name="mm_integrate_stats" id="mm_integrate_stats" <?php if (get_option('mm_integrate_stats') == 'true') echo "checked"; ?> />
                    <label for="mm_integrate_stats">Integrate Mint statistics into WordPress?</label>
                    <br />
                    <span class="explanatory-text">Whether or not to include the ability to call mint stats from within wordpress.</span>
                </td>
            </tr>
        </tbody>
    </table>
    <div id="mm_api_config">
    <h3>API</h3>
    <p>If you are going to be using the Expos&eacute; API or &micro;API for Mint</p>
    <div class="updated" id="mm_api_expose_warning" style="background:#FF667F; border-color:#990000"><p><strong>Warning:</strong> Current versions of Expos&eacute; have known, serious security vulnerabilities, use at your own risk. &micro;API Is the reccomended alternative.</p></div>
    <table class="form-table">
    	<tbody>
        	<tr valign="top" id="mm_show_dashboard_row">
            	<th scope="top">Show Stats on Dashboard</th>
                <td>
                <input type="checkbox" name="mm_show_dashboard" id="mm_show_dashboard" <?php if (get_option('mm_show_dashboard') == 'true') echo "checked"; ?> />
                <label for="mm_show_dashboard">Show &micro;Mint statistics on your dashboard</label>
                <br />
                <span class="explanatory-text">Whether or not to show &micro;Mint statistics on the wordpress dashboard.</span>
                </td>
            </tr>
            <tr valign="top" id="ma_integration_technique">
            	<th scope="row">Integration Technique</th>
                <td>
                <input type="radio" name="mm_integration_technique" id="mm_integration_technique_expose" value="expose" <?php if (get_option('mm_integration_technique') == 'expose') echo "checked";?> />
                <label for="mm_integration_technique">Expos&eacute;</label>
                <br />
                <input type="radio" name="mm_integration_technique" id="mm_integration_technique_micro" value="micro" <?php if (get_option('mm_integration_technique') == 'micro') echo "checked";?> />
                <label for="mm_integration_technique">&micro;API</label>
                <br />
                <input type="radio" name="mm_integration_technique" id="mm_integration_technique_local" value="local" <?php if (get_option('mm_integration_technique') == 'local') echo "checked";?> />
                <label for="mm_integration_technique">Local</label>
                <br />
                <span class="explanatory-text">How to Integrate WordPress and Mint</span>
                </td>
            </tr>
		</tbody>
	</table>
    <table class="form-table">
    	<tbody>
            <tr valign="top" id="mm_api_key_row" style="width: 980px">
            	<th scope="row" style="width: 216px">API Key</th>
                <td style="width: 724px">
                	<input type="textbox" name="mm_api_key" id="mm_api_key" value="<?php echo get_option('mm_api_key'); ?>" />
                    <label for="mm_api_key">API Key for Expos&eacute; or &micro;API</label>
                    <br />
                    <span class="explanatory-text">The key for the selected Mint API</span>
                </td>
            </tr>
            <tr valign="top" id="mm_api_local_row" style="width: 980px">
            	<th scope="row" style="width: 216px">Local Mint Options</th>
                <td style="width: 724px">
                <p style="width: 60%">There is currently an alpha version of a plugin to directly query mint stats from the database if Wordpress and Mint share the same databse. If you are interested in testing this patch, please <a href="http://compu.terlicio.us/about-contact/">send me a message</a>
                </p>
            </tr>
        </tbody>
    </table>
    </div>
    <p class="submit">
    	<input type="hidden" name="action" value="update" />
        <?php wp_nonce_field('mm-update_options'); ?>
    	<input type="submit" name="Submit" value="Mintify >" class="button" />
    </p>
    </form>
</div>
<?php
?>
<script type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/micromint/microMint.admin.js" />