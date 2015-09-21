<?php
if (! defined('BASEPATH')) {
	exit('Direct script access is prohibited');
}

if (! function_exists('filterDbOutput')) {
	function filterDbOutput($value)
	{
		$value = trim($value);
		$value = html_entity_decode( $value );
		$value = htmlspecialchars( $value );
		
		return $value;
	}
}

if (! function_exists('excerptize')) {
	function excerptize($text, $charLimit = 50)
	{
		if (strlen($text) < $charLimit) {
			return $text;
		}

		return (substr($text, 0, $charLimit) . '...');
	}
}
