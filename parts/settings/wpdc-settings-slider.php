<?php
/*
 Title: Slider Settings
 Setting: wpdc_settings
 Order: 1
 */

//orientation
piklist('field', array(
	'type'     => 'select',
	'field'    => 'orientation',
	'value'    => 'horiz',
	'label'    => 'Slider Orientation',
	'help'     => 'Select whether the slider scrolls horizontally or vertically.',
	'choices'  => array(
		'horizontal'   => 'Horizontal',
		'vertical'    => 'Vertical'
	)
));

//speed
piklist('field', array(
	'type'         => 'text',
	'field'        => 'speed',
	'label'        => 'Transition Speed',
	'columns'      => 1,
	'help'         => 'Set the speed (in ms) for the slide transitions.  Ex. for 500ms simply enter 500.',
	'attributes'   => array(
		'class'       => 'text'
	)
));

//easing
piklist('field', array(
	'type'     => 'select',
	'field'    => 'easing',
	'value'    => 'ease-in-out',
	'label'    => 'Slider Easing Type',
	'help'     => 'Select what type of easing should be used for the slide transitions.',
	'choices'  => array(
		'ease'        => 'Standard Easing',
		'linear'      => 'Linear Easing',
		'ease-in'     => 'Slow Start',
		'ease-out'    => 'Slow End',
		'ease-in-out' => 'Slow Start/End'
	)
));


//minItems
piklist('field', array(
	'type'     => 'select',
	'field'    => 'min_vis',
	'value'    => '2',
	'label'    => 'Minimum Number of Visible Items',
	'help'     => 'Select the minimum number of items that should be visible when the slider is displayed on the smallest screen size (usually 320px wide).',
	'choices'  => array(
		'1'   => '1',
		'2'   => '2',
		'3'   => '3',
		'4'   => '4',
		'5'   => '5'
	)
));