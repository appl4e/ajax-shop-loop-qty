<?php

add_action("wp_ajax_prod_cart_update", "prod_cart_update");
add_action("wp_ajax_nopriv_prod_cart_update", "prod_cart_update");

/**
 * updating card on product quantity change
 */
function prod_cart_update()
{
  if (!wp_verify_nonce($_POST['nonce'], "wc_product_id")) {
    exit("No naughty business please");
  }

  $product_id = $_POST["product_id"];
  $qty_value = $_POST["qty_value"];
  
  foreach (WC()->cart->get_cart() as $existing_cart_item_key => $existing_cart_item) {
    if ($product_id == $existing_cart_item['product_id']) {
      $our_product_values = $existing_cart_item;
      $our_product_quantity = $existing_cart_item['quantity'];
      $cart_item_key = $existing_cart_item_key;
    };
  }

  // Update cart validation
  $passed_validation  = apply_filters('woocommerce_update_cart_validation', true, $cart_item_key, $our_product_values, $our_product_quantity);

  // Update the quantity of the item in the cart
  if ($passed_validation) {
    $new_quantity = $qty_value;
    WC()->cart->set_quantity($cart_item_key, $new_quantity, true);
  }


  if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    echo $product_id;
  } else {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
  }
  die();
}