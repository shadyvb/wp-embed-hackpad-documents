<?php
/**
 * Hackpads Embedded in WordPress
 *
 * @package Hackpad-embed
 * @version 1.0.0
 */

/*
Plugin Name: Hackpad Embeds
Plugin URI: https://github.com/shadyvb/hackpad-embed
Description: Embed Hackpad documents in WordPress
Author: Shady Sharaf
Version: 1.0.0
Author URI: http://sharaf.me/
License: GPL2

Hackpad Embeds is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Hackpad Embeds is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
*/

namespace HMN\Hackpad;

function register() {
	wp_embed_register_handler( 'hackpad', '#https?://hackpad.com/([^\/]+-)?([^-\/]+)$#', __NAMESPACE__ . '\callback' );
}

add_action( 'init', __NAMESPACE__ . '\register' );

function callback( $matches ) {
	$url = $matches[0];
	$id  = $matches[2];

	if ( ! empty( $id ) ) {
		$output = sprintf( '<script src="https://hackpad.com/%1$s.js"></script><noscript>%2$s</noscript>', $id, $url );
	} else {
		$output = $matches[0];
	}

	return $output;
}
