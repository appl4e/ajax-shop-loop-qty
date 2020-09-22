<?php

namespace ASLQ;

/**
 * The Frontend Class
 */
class Frontend
{

  /**
   * Initializing the frontend Class
   */
  public function __construct()
  {
    new Frontend\WC_Hooks();
    add_action('wp_enqueue_scripts', [$this, 'aslq_enqueues']);
  }

  public function aslq_enqueues()
  {
    wp_enqueue_style('aslq_styles', ASLQ_ASSETS.'/css/style.css');
    wp_enqueue_script('aslq_script', ASLQ_ASSETS.'/js/script.js', array('jquery'), '1.0', true);

  }
}
