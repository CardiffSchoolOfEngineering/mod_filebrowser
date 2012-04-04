<?php
/**
 * @copyright	Copyright (C) 2012 Blue Flame IT Ltd / Phil Taylor. All rights reserved.
 * @copyright	Copyright (C) 2012 Cardiff University, School of Engineering. All rights reserved.
 * @license		GNU/GPL version 3 or later.
 */

// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );

// Include the helper functions only once
require_once (dirname ( __FILE__ ) . DS . 'helper.php');

// Type hinting for Eclipse Editors
/* @var $params JRegistry */

// Module Class Suffix
$moduleclass_sfx = $params->get ( 'moduleclass_sfx', '' );

// Path to list files in this path
$path = $params->get ( 'path', 'images/stories' );

// Show the file size
$show_file_size = $params->get ( 'show_file_size', '1' );

// Show the icons
$show_icons = $params->get ( 'show_icons', '1' );

// Get the Icon size
$icon_size = $params->get ( 'icon_size', '16x16' );

// calculate the padding depending on the icon width (if any)
$icon_padding = modFileBrowserHelper::getIconPadding ( $icon_size );

// Load file list from our model
$list = modFileBrowserHelper::getList ( $params );

// Load output layer
require (JModuleHelper::getLayoutPath ( 'mod_filebrowser' ));