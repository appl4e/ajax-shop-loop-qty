jQuery(document).ready(function ($) {
	$(document).on(
		"click",
		".woocommerce .product-buttons .quantity_input_wrapper .aslq-qty input.plus, .woocommerce .product-buttons .quantity_input_wrapper .aslq-qty input.minus",
		function () {
			// Get current quantity values
			var qty = $(this).closest(".aslq-qty").find(".qty");
			var val = parseFloat(qty.val());
			var max = parseFloat(qty.attr("max"));
			var min = parseFloat(qty.attr("min"));
			var step = parseFloat(qty.attr("step"));
			// Change the value if plus or minus
			if ($(this).is(".plus")) {
				if (max && max <= val) {
					qty.val(max);
				} else {
					qty.val(val + step).trigger("change");
				}
			} else {
				if (min && min >= val) {
					qty.val(min);
				} else if (val > 0) {
					qty.val(val - step).trigger("change");
				}
			}
		}
	);
	$(document).on("click", ".woocommerce .product-buttons .quantity_input_wrapper .aslq-qty input.qty", function () {
		return false;
	});
	$(document).on("keypress", ".woocommerce .product-buttons .quantity_input_wrapper .aslq-qty input.qty", function (e) {
		if ((e.which || e.keyCode) === 13) {
			e.preventDefault;
			retrun;
		}
	});
	$(document).on("click", ".woocommerce .product-buttons.aslq-product-buttons .add_to_cart_button", function () {
		$(this).siblings(".quantity_input_wrapper").removeClass("d-none");
		$(this).siblings(".quantity_input_wrapper").find(".qty").val(1);
		$(this).parents(".product-buttons-container").addClass("hide-add-to-cart");
		$(this).parents(".aslq-product-buttons").siblings(".product-cart-loading").addClass("show");
		var product_id = $(this).data("product_id");
		$(document.body).on("added_to_cart", function () {
			setTimeout(() => {
				$(".product.post-" + product_id + " .product-cart-loading").removeClass("show");
			}, 700);
		});
	});
	$(document).on("change input", ".woocommerce .product-buttons .quantity_input_wrapper .aslq-qty input.qty", function (e) {
		e.preventDefault();
		// alert("test");
		var product_id = $(this).parents(".quantity_input_wrapper").attr("data-product-id");
		var cart_item_key = $(this).parents(".quantity_input_wrapper").attr("data-cart-item-key");
		var nonce = $(this).parents(".quantity_input_wrapper").attr("data-nonce");
		var qty_value = $(this).val();

		if (qty_value < 1) {
			$(this).parents(".product-buttons-container").removeClass("hide-add-to-cart");
			$(this).parents(".quantity_input_wrapper").addClass("d-none");
		} else if (qty_value == 1) {
			$(this).parents(".quantity_input_wrapper").removeClass("d-none");
			$(this).parents(".product-buttons-container").addClass("hide-add-to-cart");
		}

		$(this).parents(".aslq-product-buttons").siblings(".product-cart-loading").addClass("show");

		$.ajax({
			type: "POST",
			url: wc_product_id_obj.ajaxurl,
			data: {
				nonce: nonce,
				action: "prod_cart_update",
				product_id: product_id,
				cart_item_key: cart_item_key,
				qty_value: qty_value,
			},
			success: function (data) {
				$(document.body).trigger("wc_fragment_refresh");
				setTimeout(() => {
					$(".post-" + data + " .product-cart-loading").removeClass("show");
				}, 1000);
			},
		});
	});
});
