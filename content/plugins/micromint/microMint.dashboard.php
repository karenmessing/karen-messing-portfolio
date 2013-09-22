<div style="overflow: auto;width: 100%; height: 130px; background: no-repeat center center url('<?php echo get_option('siteurl'); ?>/wp-content/plugins/micromint/images/micromintdash.png');">
    <div style="width: 50%;float: left; font-family: Georgia, 'Times New Roman', Times, serif; color:#FFECEC; font-size: 56px; font-stretch:ultra-condensed; text-align: center; padding-top: 18px;">
        <span style="padding-top: 35px;"><em>&nbsp;<?php echo get_option('mm_all_time_total'); ?></em></span>
   </div>
    <div style="width: 50% float: right; font-family: Georgia, 'Times New Roman', Times, serif; color:#FFECEC; font-size:56px; font-stretch:ultra-condensed; text-align: center; padding-top: 18px;">
        <span style="padding-top: 35px;"><em><?php echo get_option('mm_all_time_unique'); ?></em></span>
    </div>
</div>
<div style="overflow: auto;width: 100%">
    <div style="float: left">
        <h4 style="margin-bottom: 5px; margin-top: 1px;">Unique(<span class="mm_subtitle" style="font-weight: 200">"<?php echo stripslashes(get_option('mm_widget_unique_title')); ?>"</span>):</h4>
        <p class="microMint-dashboard-container" style="margin-top: 7px;">
            <span id="microMint-today"><strong>Today: </strong><?php echo get_option('mm_today_unique'); ?></span>
            <br />
            <span id="microMint-this-week"><strong>This Week: </strong><?php echo get_option('mm_this_week_unique'); ?></span>
            <br />
            <span id="microMint-all-time"><strong>All Time: </strong><?php echo get_option('mm_all_time_unique'); ?></span>
            <br />
        </p>
    </div>
    <div style="float: right; margin-right: 15%;">
        <h4 style="margin-bottom: 5px; margin-top: 1px;">Total(<span class="mm_subtitle" style="font-weight:200">"<?php echo stripslashes(get_option('mm_widget_total_title')); ?>"</span>):</h4>
        <p class="microMint-dashboard-container" style="margin-top: 7px;">
            <span id="microMint-today"><strong>Today: </strong><?php echo get_option('mm_today_total'); ?></span>
            <br />
            <span id="microMint-this-week"><strong>This Week: </strong><?php echo get_option('mm_this_week_total'); ?></span>
            <br />
            <span id="microMint-all-time"><strong>All Time: </strong><?php echo get_option('mm_all_time_total'); ?></span>
            <br />
        </p>
	</div>
</div>
<div style="overflow:auto; width: 100%; text-align: center">
	<p style="margin-bottom: 4px; margin-top: 4px; font-size:9px">Statistics last retrieved <?php echo date("F j, Y, g:i a",strtotime(get_option('mm_updated_stats'))); ?></p>
</div>
<div style="overflow: auto; width: 100%; text-align: center">
	<a href="http://compu.terlicio.us/code/plugins/mint/" title="&micro;Mint by Christopher O'Connell"><img alt="&micro;Mint" style="text-align: center" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/micromint/images/microMint.gif" /></a>
</div>