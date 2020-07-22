<?php

namespace ASLQ\Frontend;

/**
 * Class to modify woocommerce hooks
 */
class WC_Hooks
{
  public function __construct()
  {
    add_action('woocommerce_after_shop_loop_item', [$this, 'before_shop_item_buttons'], 9);
  }

  public function before_shop_item_buttons()
  {
    $template = __DIR__ . '/templates/wc-before-shop-item-buttons.php';
    if (file_exists($template)) {
      include $template;
    }
  }
}
