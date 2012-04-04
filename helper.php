<?php
/**
 * @copyright	Copyright (C) 2012 Blue Flame IT Ltd / Phil Taylor. All rights reserved.
 * @copyright	Copyright (C) 2012 Cardiff University, School of Engineering. All rights reserved.
 * @license		GNU/GPL version 3 or later.
 */

// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );

class modFileBrowserHelper {
	
	/**
	 * This function gets a list of files to be displayed by module.
	 *
	 * @param 	string 	$params	The module parameters
	 * @return 	array			An array with the file list
	 */
	function getList($params) {
		
		// init
		$list = array ();
		
		// Set directory to open (absolute path)
		$dir = JPATH_SITE . '/' . $params->get ( 'path' ) . '/';
		
		// Open directory, and proceed to read its contents
		if (is_dir ( $dir )) {
			
			if ($dh = opendir ( $dir )) {
				$j = 0; // counter for directories
				$k = 0; // counter for images
				while ( ($file = readdir ( $dh )) !== false ) {
					if ($file != '.' && $file != '..' && $file != 'index.html') {
						
						// If we are not on a directory
						if (! is_dir ( $dir . $file )) {
							
							$pathinfo = pathinfo ( $dir . $file );
							
							$list [$k] ['file_name'] = $file;
							$list [$k] ['file_size'] = number_format ( (filesize ( $dir . $file ) / 1024), 2 ) . ' Kb';
							$list [$k] ['date_modified'] = date ( "d-m-y", filemtime ( $dir . $file ) );
							$list [$k] ['icon'] = modFileBrowserHelper::getIcon ( $pathinfo ['extension'], $params );
							$k ++;
						
						}
					
					}
				}
				closedir ( $dh );
			}
		}
		return $list;
	}
	
	/**
	 * This function returns the path to the icon for the specified extension according to the icon_size parameter.
	 *
	 * @param 	string 	$extension	the file extension from which to get the icon
	 * @return 	string	$params		Array of params (config)
	 */
	function getIcon($extension, $params) {
		
		$icon_size = $params->get ( 'icon_size', '16x16' );
		
		switch ($extension) {
			
			// Micrsoft Word Formats
			case 'doc' :
			case 'docx' :
				$icon = $params->get ( 'icon_word', 'ms_word.png' );
				break;
			
			// Microsoft Powerpoint Formats
			case 'ppt' :
			case 'pps' :
			case 'pptx' :
				$icon = $params->get ( 'icon_ppt', 'unknown.png' );
				break;
			
			// Microsoft Excel Formats
			case 'xls' :
			case 'xlsx' :
				$icon = $params->get ( 'icon_xls', 'spreadsheet.png' );
				break;
			
			// Adobe PDF Formats
			case 'pdf' :
				$icon = $params->get ( 'icon_pdf', 'pdf.png' );
				break;
			
			// Multiple Media formats
			case (in_array ( $extension, array ('avi', 'mkv', 'mov', 'mpg', 'mpeg', 'mp4', 'flc', 'swf', 'mwv' ) )) :
				$icon = $params->get ( 'icon_media', 'unknown.png' );
				break;
			
			// Multiple Image Formats
			case (in_array ( $extension, array ('bmp', 'png', 'jpg' ) )) :
				$icon = $params->get ( 'icon_image', 'jpeg.png' );
				break;
			
			default :
				$icon = $params->get ( 'icon_unknown', 'unknown.png' );
				break;
		}
		
		// Compose the path to the icons folder with size
		return JURI::Base () . '/modules/mod_filebrowser/images/' . $icon_size . '/' . $icon;
	}
	
	/**
	 * This function returns the padding required depending on the icon width (if any).
	 *
	 * @param 	string 	$icon_size	The icon size as 16x16 or 32x32
	 * @return 	string				Padding in pixels (including the px suffix)
	 */
	function getIconPadding($icon_size) {
		
		$icon_size_array = explode ( 'x', $icon_size );
		$icon_padding = ($icon_size_array [0] + 3) . 'px';
		return $icon_padding;
	}
}
