<?php
require 'conn.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if (isset($_GET['getQr'])) {
    $getQr = $_GET['getQr'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT qrCode FROM tblstudent WHERE StudentID = ?");
    $stmt->bind_param("s", $getQr);
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize the HTML output
    $output = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
    $output .= '<style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    th, td {
                        border: 1px solid black;
                        padding: 10px;
                        font-size: 14px;
                        text-align: center; /* Center the content in the cells */
                    }
                    th {
                        background-color: #f2f2f2;
                    }
                    img {
                        display: block;
                        margin: 0 auto;
                        width: 300px; /* Increase the image size */
                    }
                </style>';

    $output .= '<table>';
    $output .= '<thead>
                    <tr>
                        <th>QrCode</th>
                    </tr>
                </thead>
                <tbody>';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Get the path from the database
            $imagePath = $row['qrCode'];

            // Encode the image to base64
            $imageData = base64_encode(file_get_contents($imagePath));
            $src = 'data:image/png;base64,' . $imageData;

            // Display the image in the PDF
            $output .= '<tr>
                           <td>
                               <img src="' . $src . '"/>
                           </td>
                        </tr>';
        }
    } else {
        $output .= '<tr><td colspan="1">No qrCode</td></tr>';
    }
    $output .= '</tbody></table>';

    // PDF generation options
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'DejaVu Sans');

    // Initialize Dompdf
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($output);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Stream the PDF to the browser
    $dompdf->stream('qr.pdf', ["Attachment" => 0]);
}
