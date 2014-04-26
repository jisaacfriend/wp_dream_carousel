<?php
/*
 Title: Image Settings
 Setting: wpdc_settings
 Order: 0
 */

//image_width
piklist('field', array(
	'type'         => 'text',
	'field'        => 'image_width',
	'label'        => 'Image Width (in px)',
	'columns'      => 1,
	'help'         => 'Ex: to set image widths to 320px, simply enter 320.',
	'attributes'   => array(
		'class'       => 'text'
		)
));

//image_height
piklist('field', array(
	'type'         => 'text',
	'field'        => 'image_height',
	'label'        => 'Image Height (in px)',
	'columns'      => 1,
	'help'         => 'Ex: to set image heights to 180px, simply enter 180.',
	'attributes'   => array(
		'class'       => 'text'
		)
));