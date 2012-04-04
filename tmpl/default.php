<?php
/**
 * @copyright	Copyright (C) 2012 Blue Flame IT Ltd / Phil Taylor. All rights reserved.
 * @copyright	Copyright (C) 2012 Cardiff University, School of Engineering. All rights reserved.
 * @license		GNU/GPL version 3 or later.
 */
?>

<div>

<?php if (is_array($list)) { ?>
	<ul style="padding:0; margin:0; list-style:none;">
	<?php foreach ($list as $item) { ?>
		<?php if ($show_icons == 1) { ?>
			<li style="background-image:url(<?php echo $item['icon']; ?>); background-repeat:no-repeat; padding-left:<?php echo $icon_padding; ?>; height:<?php echo $icon_padding; ?>; ">
		<?php } else { ?>
			<li>
		<?php } ?>
		<a href="<?php echo $params->get('path').'/'.$item['file_name']; ?>">
			<?php echo $item['file_name']; ?>
		</a> 
		<?php if ($show_file_size == 1) { ?> - [<?php echo $item['file_size']; ?>] <?php } ?>
		</li>
	<?php } ?>
	</ul>
<?php } else { ?>
	<p>No files to display.</p>
<?php } ?>

</div>