<?php

/**
 * Plugin Name:       Ajax Shop Loop Quantity for WooCommerce
 * Plugin URI:        https://applemahmood.com
 * Description:       A WordPress plugin to enable ajax quantity field in shop loop items for woocommerce.
 * Version:           1.0
 * Author:            Apple Mahmood
 * Author URI:        https://applemahmood.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ajax-shop-loop-qty
 * Domain Path:       /languages
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Main class for the plugin
 */
final class Ajax_Shop_Loop_Qty
{

  const version = 1.0;
  /**
   * Class Constructor
   */
  private function __construct()
  {
    $this->define_constants();
  }

  /**
   * Defining necessary constants
   *
   * @return void
   */
  public function define_constants()
  {
    define('ASLQ_VERSION', self::version);
    define('ASLQ_FILE', __FILE__);
    define('ASLQ_PATH', __DIR__);
    define('ASLQ_URL', plugins_url('', ASLQ_FILE));
    define('ASLQ_ASSETS', ASLQ_URL . '/assets');
  }
}
