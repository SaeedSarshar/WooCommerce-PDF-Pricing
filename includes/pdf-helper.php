<?php
use Smalot\PdfParser\Parser;

function wc_get_pdf_page_count($file_path) {
    if (!file_exists($file_path)) {
        throw new Exception(__('File not found.', 'wc-pdf-pricing'));
    }

    $parser = new Parser();
    $pdf = $parser->parseFile($file_path);
    $details = $pdf->getDetails();

    return isset($details['Pages']) ? (int) $details['Pages'] : 0;
}
