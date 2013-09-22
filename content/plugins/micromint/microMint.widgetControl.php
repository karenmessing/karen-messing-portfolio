<?php
	if (isset($_POST['mm_widget_options_updated'])) {
		if (wp_verify_nonce($_POST['mm_widget_options_nonce'],'mm-update_widget-options')) {
			if (isset($_POST['mm_widget_title'])) update_option('mm_widget_title',$_POST['mm_widget_title']);
			if (isset($_POST['mm_widget_total_title'])) update_option('mm_widget_total_title',$_POST['mm_widget_total_title']);
			if (isset($_POST['mm_widget_total'])) {
				update_option('mm_widget_total','true');
			} else {
				update_option('mm_widget_total','false');
			}
			if (isset($_POST['mm_widget_today_total'])) {
				update_option('mm_widget_today_total','true');
			} else {
				update_option('mm_widget_today_total','false');
			}
			if (isset($_POST['mm_widget_this_week_total'])) {
				update_option('mm_widget_this_week_total','true');
			} else {
				update_option('mm_widget_this_week_total','false');
			}
			if (isset($_POST['mm_widget_all_time_total'])) {
				update_option('mm_widget_all_time_total','true');
			} else {
				update_option('mm_widget_all_time_total','false');
			}
			if (isset($_POST['mm_widget_unique_title'])) update_option('mm_widget_unique_title',$_POST['mm_widget_unique_title']);
			if (isset($_POST['mm_widget_unique'])) {
				update_option('mm_widget_unique','true');
			} else {
				update_option('mm_widget_unique','false');
			}
			if (isset($_POST['mm_widget_today_unique'])) {
				update_option('mm_widget_today_unique','true');
			} else {
				update_option('mm_widget_today_unique','false');
			}
			if (isset($_POST['mm_widget_this_week_unique'])) {
				update_option('mm_widget_this_week_unique','true');
			} else {
				update_option('mm_widget_this_week_unique','false');
			}
			if (isset($_POST['mm_widget_all_time_unique'])) {
				update_option('mm_widget_all_time_unique','true');
			} else {
				update_option('mm_widget_all_time_unique','false');
			}
		}
	}
?><p>
	<label for="mm_widget_title">
    	Title:
        <input type="text" name="mm_widget_title" id="mm_widget_title" value="<?php echo stripslashes(get_option('mm_widget_title')); ?>" />
	</label>
    <br />
    <br />
	<p><span><strong>Unique Visitors:</strong></span></p>
    <ul>
    <li><label for="mm_widget_unique">
    	Unique Stats:
        <input type="checkbox" name="mm_widget_unique" id="mm_widget_unique" <?php if (get_option('mm_widget_unique') == 'true') echo "checked"; ?> />
    </label><label for="mm_widget_unique_title">
    	Title:
        <input type="text" name="mm_widget_unique_title" id="mm_widget_unique_title" value="<?php echo stripslashes(get_option('mm_widget_unique_title')); ?>" />
    </label></li>
    <li><label for="mm_widget_today_unique">
    	Daily stats:
        <input type="checkbox" name="mm_widget_today_unique" id="mm_widget_today_unique" <?php if (get_option('mm_widget_today_unique') == 'true') echo "checked"; ?> />
    </label></li>
    <li><label for="mm_widget_this_week_unique">
    	Weekly stats:
        <input type="checkbox" name="mm_widget_this_week_unique" id="mm_widget_this_week_unique" <?php if (get_option('mm_widget_this_week_unique') == 'true') echo "checked"; ?> />
    </label></li>
    <li><label for="mm_widget_all_time_unique">
    	All-time stats:
        <input type="checkbox" name="mm_widget_all_time_unique" id="mm_widget_all_time_unique" <?php if (get_option('mm_widget_all_time_unique') == 'true') echo "checked"; ?> />
    </label></li>
    </ul>
    <br />
	<p><span><strong>Total Visitors:</strong></span></p>
    <ul>
    <li><label for="mm_widget_total">
    	Total Stats:
        <input type="checkbox" name="mm_widget_total" id="mm_widget_total" <?php if (get_option('mm_widget_total') == 'true') echo "checked"; ?> />
    </label><label for="mm_widget_total_title">
    	Title:
        <input type="text" name="mm_widget_total_title" id="mm_widget_total_title" value="<?php echo stripslashes(get_option('mm_widget_total_title')); ?>" />
    </label></li>
    <li><label for="mm_widget_today_total">
    	Daily stats:
        <input type="checkbox" name="mm_widget_today_total" id="mm_widget_today_total" <?php if (get_option('mm_widget_today_total') == 'true') echo "checked"; ?> />
    </label></li>
    <li><label for="mm_widget_this_week_total">
    	Weekly stats:
        <input type="checkbox" name="mm_widget_this_week_total" id="mm_widget_this_week_total" <?php if (get_option('mm_widget_this_week_total') == 'true') echo "checked"; ?> />
    </label></li>
    <li><label for="mm_widget_all_time_total">
    	All-time stats:
        <input type="checkbox" name="mm_widget_all_time_total" id="mm_widget_all_time_total" <?php if (get_option('mm_widget_all_time_total') == 'true') echo "checked"; ?> />
    </label></li>
    </ul>
    <input type="hidden" name="mm_widget_options_updated" value="true" />
    <input type="hidden" name="mm_widget_options_nonce" value="<?php echo wp_create_nonce('mm-update_widget-options'); ?>" />
</p>