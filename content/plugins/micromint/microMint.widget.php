<?php if(get_option('mm_widget_unique') == 'true') { ?>
<p><strong><?php echo stripslashes(get_option('mm_widget_unique_title')); ?></strong></p>
<p id="microMint-widget-container">
	<?php if(get_option('mm_widget_today_unique') == 'true') { ?>
    <span id="microMint-today"><strong>Today: </strong><?php echo number_format(get_option('mm_today_unique')); ?></span>
    <br />
    <?php } // Today ?>
    <?php if(get_option('mm_widget_this_week_unique') == 'true') { ?>
    <span id="microMint-this-week"><strong>This Week: </strong><?php echo number_format(get_option('mm_this_week_unique')); ?></span>
    <br />
    <?php } // This Week ?>
    <?php if(get_option('mm_widget_all_time_unique') == 'true') { ?>
	<span id="microMint-all-time"><strong>All Time: </strong><?php echo number_format(get_option('mm_all_time_unique')); ?></span>
    <br />
    <?php } // All Time ?>
</p>
<br />
<?php } // Unique ?>

<?php if(get_option('mm_widget_total') == 'true') { ?>
<p><strong><?php echo stripslashes(get_option('mm_widget_total_title')); ?></strong></p>
<p id="microMint-widget-container">
	<?php if(get_option('mm_widget_today_total') == 'true') { ?>
    <span id="microMint-today"><strong>Today: </strong><?php echo number_format(get_option('mm_today_total')); ?></span>
    <br />
    <?php } // Today ?>
    <?php if(get_option('mm_widget_this_week_total') == 'true') { ?>
    <span id="microMint-this-week"><strong>This Week: </strong><?php echo number_format(get_option('mm_this_week_total')); ?></span>
    <br />
    <?php } // This Week ?>
    <?php if(get_option('mm_widget_all_time_total') == 'true') { ?>
	<span id="microMint-all-time"><strong>All Time: </strong><?php echo number_format(get_option('mm_all_time_total')); ?></span>
    <br />
    <?php } // All Time ?>
</p>
<br />
<?php } // Total ?>

<a href="http://compu.terlicio.us/code/plugins/mint/" title="&micro;Mint by Christopher O'Connell"><img alt="&micro;Mint" style="margin-left: 28%; margin-right: 72%;" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/micromint/images/microMint.gif" /></a>