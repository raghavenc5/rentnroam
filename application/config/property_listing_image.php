<?php

if (! defined('BASEPATH')) {
    exit('Direct script access is not allowed');
}

$config['original']['upload_path'] = './public/uploads/property_image/';
$config['original']['allowed_types'] = 'jpg|png';		
$config['original']['max_size']	= '5120';
$config['original']['encrypt_name'] = true;

$config['thumb']['image_library'] = 'GD';
$config['thumb']['new_image'] = './public/uploads/property_image/thumbs/';
$config['thumb']['width'] = '150';
$config['thumb']['height'] = '250';
$config['thumb']['create_thumb'] = true;
