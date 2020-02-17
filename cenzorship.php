<?php
/*
Plugin Name: СenZorship
Description: Автоматическая фильтрация нецензурных выражений.
Version:  1.0
Author: Moroz Zhenia
*/

define('CENZORSHIP_DIR', plugin_dir_path(__FILE__));

function cenzorship_filter_the_content($the_content)
{
  static $badwords = array();

  if ( empty($badwords)) {
    $badwords = explode(',', file_get_contents(CENZORSHIP_DIR . 'badwords.txt'));
  }

  for ($i=0, $c = count($badwords) ; $i< $c; $i++) {
    $the_content = preg_replace('#'.$badwords[$i].'#iu', '{плохое слово}', $the_content);
  }
  return $the_content;
}

add_filter('the_content', 'cenzorship_filter_the_content');
