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
	'value'    => 'inoutsine',
	'label'    => 'Slider Easing Type',
	'help'     => 'Select what type of easing should be used for the slide transitions. CAUTION: Although all easing types are supported, some may not be great choices for a carousel slider.',
	'choices'  => array(
		'linear'              => 'Linear',
		'swing'               => 'Swing',
		'easeInQuad'          => 'Ease In Quad',
		'easeOutQuad'         => 'Ease Out Quad',
		'easeInOutQuad'       => 'Ease In/Out Quad',
		'easeInCubic'         => 'Ease In Cubic',
		'easeOutCubic'        => 'Ease Out Cubic',
		'easeInOutCubic'      => 'Ease In/Out Cubic',
		'easeInQuart'         => 'Ease In Quart',
		'easeOutQuart'        => 'Ease Out Quart',
		'easeInOutQuart'      => 'Ease In/Out Quart',
		'easeInQuint'         => 'Ease In Quint',
		'easeOutQuint'        => 'Ease Out Quint',
		'easeInOutQuint'      => 'Ease In/Out Quint',
		'easeInExpo'          => 'Ease In Expo',
		'easeOutExpo'         => 'Ease Out Expo',
		'easeInOutExpo'       => 'Ease In/Out Expo',
		'easeInSine'          => 'Ease In Sine',
		'easeOutSine'         => 'Ease Out Sine',
		'easeInOutSine'       => 'Ease In/Out Sine',
		'easeInCirc'          => 'Ease In Circ',
		'easeOutCirc'         => 'Ease Out Circ',
		'easeInOutCirc'       => 'Ease In/Out Circ',
		'easeInElastic'       => 'Ease In Elastic',
		'easeOutElastic'      => 'Ease Out Elastic',
		'easeInOutElastic'    => 'Ease In/Out Elastic',
		'easeInBack'          => 'Ease In Back',
		'easeOutBack'         => 'Ease Out Back',
		'easeInOutBack'       => 'Ease In/Out Back',
		'easeInBounce'        => 'Ease In Bounce',
		'easeOutBounce'       => 'Ease Out Bounce',
		'easeInOutBouce'      => 'Ease In/Out Bounce',
	)
));


//minItems
piklist('field', array(
	'type'     => 'select',
	'field'    => 'min_vis',
	'value'    => 'two',
	'label'    => 'Minimum Number of Visible Items',
	'help'     => 'Select the minimum number of items that should be visible when the slider is displayed on the smallest screen size (usually 320px wide).',
	'choices'  => array(
		'one'     => '1',
		'two'     => '2',
		'three'   => '3',
		'four'    => '4',
		'five'    => '5'
	)
));

?>