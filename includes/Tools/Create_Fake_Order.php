<?php


/**
 * --------------------------------------------------
 * MOCK PAYLOAD
 * --------------------------------------------------
 */
function ecb_get_mock_payload() {
    return [
        'customer' => [
            'first_name' => 'Test',
            'last_name'  => 'User',
            'email'      => 'test@gmail.com',
            'phone'      => '0123456789',
        ],
        'items' => [
            [
                'product_id' => 133, // đổi ID cho đúng
                'qty'        => 1,
            ],
        ],
        'meta' => [
            'source' => 'cli_mock',
        ],
    ];
}

/**
 * --------------------------------------------------
 * CREATE ORDER FROM ARRAY
 * --------------------------------------------------
 */
function ecb_create_order_from_array( array $data ) {

    if ( ! class_exists('WooCommerce') ) {
        return new WP_Error( 'no_woocommerce', 'WooCommerce is not active' );
    }

    $order = wc_create_order();

    // Add products
    foreach ( $data['items'] as $item ) {
        $product = wc_get_product( $item['product_id'] );

        if ( ! $product ) {
            return new WP_Error( 'invalid_product', 'Invalid product ID: ' . $item['product_id'] );
        }

        $order->add_product( $product, $item['qty'] );
    }

    // Billing info
    $order->set_billing_first_name( $data['customer']['first_name'] );
    $order->set_billing_last_name( $data['customer']['last_name'] );
    $order->set_billing_email( $data['customer']['email'] );
    $order->set_billing_phone( $data['customer']['phone'] );

    // Meta
    if ( ! empty( $data['meta'] ) ) {
        foreach ( $data['meta'] as $key => $value ) {
            $order->update_meta_data( $key, $value );
        }
    }

    $order->calculate_totals();
    $order->update_status( 'processing', 'Mock checkout via WP-CLI' );

    return $order;
}


if ( defined('WP_CLI') && WP_CLI ) {

    WP_CLI::add_command( 'ecb mock-checkout', function () {

        $payload = ecb_get_mock_payload();
        $order   = ecb_create_order_from_array( $payload );

        if ( is_wp_error( $order ) ) {
            WP_CLI::error( $order->get_error_message() );
        }

        WP_CLI::success( 'Mock order created successfully. Order ID: #' . $order->get_id() );
    });
}


