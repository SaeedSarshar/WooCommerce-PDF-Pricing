<?php
add_action('wp_ajax_wc_pdf_pricing_calculate', 'wc_pdf_pricing_calculate');
add_action('wp_ajax_nopriv_wc_pdf_pricing_calculate', 'wc_pdf_pricing_calculate');

function wc_pdf_pricing_calculate() {
    if (!isset($_FILES['pdf_upload']) || $_FILES['pdf_upload']['error'] !== UPLOAD_ERR_OK) {
        wp_send_json_error(['message' => __('No file uploaded.', 'wc-pdf-pricing')]);
    }

    $file_path = $_FILES['pdf_upload']['tmp_name'];

    try {
        $page_count = wc_get_pdf_page_count($file_path);

        // Simulated pricing for demonstration
        $price_per_page = 100; // Example fixed price
        $total_price = $page_count * $price_per_page;

        wp_send_json_success([
            'page_count' => $page_count,
            'price' => $total_price,
        ]);
    } catch (Exception $e) {
        wp_send_json_error(['message' => __('Error processing PDF.', 'wc-pdf-pricing')]);
    }
}
