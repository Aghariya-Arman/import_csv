<?php

date_default_timezone_set("Asia/Kolkata");
ob_start();
ini_set('display_errors', 0);
set_time_limit(0);

include('connect.php');
include_once('/var/www/html/lms/common/connection.php'); // con_ak_activity_db con_ak_master_db con_ak_orders_db

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=ApartmentUpload_Demo.csv');
$output = fopen("php://output", "w");


fputcsv($output, array('Apartment Name', 'Apartment Code', 'First Name', 'Promoter Code'));

// Get Apartment data
$apartments = $con->query("
    SELECT apartment_name, apartment_code 
    FROM tbl_apartments_master 
    WHERE apartment_code NOT IN (
        SELECT apartment_code 
        FROM tbl_btl_coded_apartment_rm_modal
    )
")->fetch_all(MYSQLI_ASSOC);

// Get Promoter data
$promoters = $con->query("
    SELECT first_name, promoter_code 
    FROM btl_promoter_login 
    WHERE active_deactive = '1'
")->fetch_all(MYSQLI_ASSOC);


$max_rows = max(count($apartments), count($promoters));


for ($i = 0; $i < $max_rows; $i++) {
  $apartment_name = $apartments[$i]['apartment_name'] ?? '';
  $apartment_code = $apartments[$i]['apartment_code'] ?? '';
  $first_name = $promoters[$i]['first_name'] ?? '';
  $promoter_code = $promoters[$i]['promoter_code'] ?? '';

  fputcsv($output, [$apartment_name, $apartment_code, $first_name, $promoter_code]);
}

fclose($output);
