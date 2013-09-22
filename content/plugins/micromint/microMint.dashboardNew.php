<div style="overflow: auto; width: 100%; height: 130px; background: #6d8a46" id="micromint-stats-outer">
	<div style="overflow: auto; height: 120px; margin-top: 5px; margin-left: 5px; margin-right: 5px; background: #84aa54;" id="micromint-stats-inner">
	    <div style="text-align: center; padding-top: 5px;">
	    	<span style="margin-top: 2px; font-family: Georgia, 'Times New Roman', Times, serif; color:#FFECEC; font-size:22px; font-stretch:ultra-condensed; text-align: center;"><em>Visitors</em></span>
	   	</div>
	    <div style="width: 50%; float: left; font-family: Georgia, 'Times New Roman', Times, serif; color:#FFECEC; font-size: 56px; font-stretch:ultra-condensed; text-align: center; padding-top: -5px;">
	        <span style="padding-top: 35px;"><em>&nbsp;<?php echo number_format(get_option('mm_all_time_total')); ?></em></span>
	        <p style="margin-top: 12px; margin-bottom: 0; font-size: .25em; color: #ffffdc">Total</p>
	   </div>
	    <div style="width: 50%; float: right; font-family: Georgia, 'Times New Roman', Times, serif; color:#FFECEC; font-size:56px; font-stretch:ultra-condensed; text-align: center; padding-top: -5px;">
	        <span style="padding-top: 35px;"><em><?php echo number_format(get_option('mm_all_time_unique')); ?></em></span>
	        <p style="margin-top: 12px; margin-bottom: 0; font-size: .25em; color: #ffffdc">Unique</p>
	    </div>
   </div>
</div>
<br />
<div style="overflow: auto;width: 100%">
    <div style="float: left">
        <h4 style="margin-bottom: 5px; margin-top: 1px;">Unique Visitors:</h4><br />
        <span class="mm_subtitle" style="font-weight: 200; font-size: .7em;">Display Title: <em><?php echo stripslashes(get_option('mm_widget_unique_title')); ?></em></span>
        <p class="microMint-dashboard-container" style="margin-top: 7px;">
            <span id="microMint-today"><strong>Today: </strong><?php echo number_format(get_option('mm_today_unique')); ?></span>
            <br />
            <span id="microMint-this-week"><strong>This Week: </strong><?php echo number_format(get_option('mm_this_week_unique')); ?></span>
            <br />
            <span id="microMint-all-time"><strong>All Time: </strong><?php echo number_format(get_option('mm_all_time_unique')); ?></span>
            <br />
        </p>
    </div>
    <div style="float: right; margin-right: 15%;">
        <h4 style="margin-bottom: 5px; margin-top: 1px;">Total Visitors:</h4><br />
        <span class="mm_subtitle" style="font-weight: 200; font-size: .7em;">Display Title: <em><?php echo stripslashes(get_option('mm_widget_total_title')); ?></em></span>
        <p class="microMint-dashboard-container" style="margin-top: 7px;">
            <span id="microMint-today"><strong>Today: </strong><?php echo number_format(get_option('mm_today_total')); ?></span>
            <br />
            <span id="microMint-this-week"><strong>This Week: </strong><?php echo number_format(get_option('mm_this_week_total')); ?></span>
            <br />
            <span id="microMint-all-time"><strong>All Time: </strong><?php echo number_format(get_option('mm_all_time_total')); ?></span>
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
<script type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/micromint/jquery.corner.js.php?ver=1.9.2" ></script>
<script>
<!--
	jQuery("#micromint-stats-outer").corner();
	jQuery("#micromint-stats-inner").corner();
-->
</script>