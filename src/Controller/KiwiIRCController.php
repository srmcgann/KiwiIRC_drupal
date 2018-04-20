<?php
/**
 * @file
 */
namespace Drupal\KiwiIRC\Controller;
class KiwiIRCController {
  public function content() {
    $config = \Drupal::config('KiwiIRC.settings');
    $server = $config->get('Server');
    $channel = $config->get('Channel');
    if($config->get('Nick')){
      $nick = $config->get('Nick');
    } else {
      $nick = $config->get('Superman');
    }
    $nick = substr($nick, 0, 12) . '_' . rand(100,999);
    $theme = $config->get('Theme');
    if(substr($channel, 0, 1) !== '&' &&
       substr($channel, 0, 1) !== '#' &&
       substr($channel, 0, 1) !== '+' &&
       substr($channel, 0, 1) !== '!') $channel = '#' . $channel;
    return array(
      '#type' => 'markup',
      '#markup' => t("<iframe src='https://kiwiirc.com/client/$server/?nick=$nick&theme=$theme$channel' style='border:0; width:100%; height:450px;'></iframe>"),
    );
  }
}
