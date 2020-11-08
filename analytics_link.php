<?php
/**
 * Plugin Name: Analytics button
 * Description: description
 * Author: @petro
 * Version: 1
 * Text Domain: 
 * Author URI: http://petross.pp.ua
 * License: GPL2
 *
*/

function a_shortcode( $atts , $content = null ){
   $class = $atts['class'];
   $id = $atts['id'];
   $href = $atts['href'];
   $event = $atts['event'];
   $result ="<a id=".$id." href=".$href." onclick=\"gtag('event', '".$event."', {'event_category': 'Link Click', transport: 'beacon'});\" target=\"_blank\">".$content."</a>";
   return $result;
}
add_shortcode( 'a', 'a_shortcode' );
 

function callback($buffer) {
  $pattern = '/microsoft/i';

  $buffer = preg_replace("!data-track-click=\"(.*?)\"!si","onclick=\"gtag(event, \\1, {event_category: 'Link Click', transport: 'beacon'})\"",$buffer);

  return $buffer;
}
 
 function buffer_start() { ob_start("callback"); }
 
 function buffer_end() { ob_end_flush(); }
 
 add_action('wp_head', 'buffer_start');
 add_action('wp_footer', 'buffer_end');
