<?php

session_start();

if (empty($_SESSION['id_admin'])) {
    header("Location: index.php");
    exit();
}

require_once("../db.php");

// Get data from database
$sql = $_SESSION['QUERY'];
$result = $conn->query($sql);

// Set headers
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=report.xls');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Write headers to file
fputcsv($output, array('Firstname', 'Email', 'Company Name', 'Role', 'CTC'));

// Write data to file
if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $data = array(
            $row['firstname'],
			$row['email'],

            $row['company_name'],
            $row['ctc']
        );
        fputcsv($output, $data);
    }
}

    

// Close the file pointer
fclose($output);
