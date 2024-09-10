<?php

require __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Retrieve form data
$name = $_POST['name'] ?? 'Default Name';
$quantity = $_POST['quantity'] ?? 'Default Quantity';

// Set Dompdf options
$options = new Options();
$options->setChroot(__DIR__);  // Ensure that fonts and other files are accessible
$options->setIsRemoteEnabled(true); // Allow loading of remote files
$options->set('defaultFont', 'Khmer'); // Set default font to your Khmer font

$dompdf = new Dompdf($options);

// Set the paper size and orientation
$dompdf->setPaper("A4", "landscape");

// Load the HTML and replace placeholders with form data
$html = file_get_contents('template.html');
$html = str_replace(['{{ name }}', '{{ quantity }}'], [$name, $quantity], $html);

// Load the HTML content into Dompdf
$dompdf->loadHtml($html);

// Render the PDF
$dompdf->render();

// Add PDF metadata (optional)
$dompdf->addInfo("Title", "Product Discounts PDF");

// Stream the PDF to the browser
$dompdf->stream("product_discounts.pdf", ["Attachment" => 0]);

// Save the PDF locally
$output = $dompdf->output();
file_put_contents(__DIR__ . '/path/to/directory/product_discounts.pdf', $output);
