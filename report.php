<?php

include('config/database.php');

require_once('tcpdf/tcpdf.php');

$pdf = new TCPDF();

$pdf->SetCreator('Transportation System');

$pdf->SetAuthor('Derrick Wambua Kisuna');

$pdf->SetTitle('Shipment Report');

$pdf->AddPage();

$pdf->SetFont('helvetica', '', 12);

$html = '

<h1>Transportation & Logistics Shipment Report</h1>

<table border="1" cellpadding="5">

<tr>

    <th><b>ID</b></th>
    <th><b>Customer</b></th>
    <th><b>Destination</b></th>
    <th><b>Status</b></th>
    <th><b>Tracking</b></th>

</tr>

';

$shipments = mysqli_query($conn,
"SELECT * FROM shipments ORDER BY id DESC");

while($row = mysqli_fetch_assoc($shipments)){

$html .= '

<tr>

    <td>'.$row['id'].'</td>

    <td>'.$row['customer_name'].'</td>

    <td>'.$row['destination'].'</td>

    <td>'.$row['status'].'</td>

    <td>'.$row['tracking_number'].'</td>

</tr>

';

}

$html .= '</table>';

$pdf->writeHTML($html);

$pdf->Output('shipment_report.pdf', 'D');

?>