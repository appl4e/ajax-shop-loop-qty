<?php
?>
<div class="product-cart-loading">
  <img src="<?php echo ASLQ_ASSETS. '/img/spinner.svg' ?>" alt="loader">
</div>
<?php
global $post;
$product = wc_get_product();
?>

<div class="product-buttons aslq-product-buttons">
  <?php
  $product_id = $product->get_id();
  $cart_quantity = 1;
  $this_cart_item_key = '';
  $qty_form_class = 'd-none';
  $prod_in_card_class = '';


  if (!WC()->cart->is_empty()) {
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
      if ($product_id == $cart_item['product_id']) {
        $cart_quantity = $cart_item['quantity'];
        $this_cart_item_key = $cart_item_key;
        $qty_form_class = '';
        $prod_in_card_class = 'hide-add-to-cart';
      }
    }
  }
  $product_id_nonce = wp_create_nonce('wc_product_id');
  ?>
  
  <div class="product-buttons-container clearfix <?php _e($prod_in_card_class); ?>">
  <?php if ($product && $product->is_type('simple') && $product->is_purchasable() && $product->is_in_stock() && !$product->is_sold_individually() && 'variable' != $product->get_type()) {

  ?>

    <div class="quantity_input_wrapper <?php echo esc_attr($qty_form_class); ?>" data-product-id="<?php _e($product_id); ?>" data-cart-item-key="<?php _e($this_cart_item_key); ?>" data-nonce="<?php _e($product_id_nonce); ?>">
      <div class="aslq-qty" data-p-id="<?php _e($product_id) ?>">
        <?php
        woocommerce_quantity_input(
          array(
            'input_name'   => "cart[{$cart_item_key}][qty]",
            'input_value'  => $cart_quantity,
            'max_value'    => $product->get_max_purchase_quantity(),
            'min_value'    => '0',
            'product_name' => $product->get_name(),
          ),
          $product,
          true
        );
        ?>
      </div>
    </div>
  <?php } ?>