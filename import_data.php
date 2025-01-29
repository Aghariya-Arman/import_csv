<?php
include_once 'connect.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['upload_submit'])) {
  if ($_FILES['apartment_data']['error'] === UPLOAD_ERR_OK) {
    try {

      $csvData = file_get_contents($_FILES['apartment_data']['tmp_name']);
      $rows = array_map('str_getcsv', explode("\n", $csvData));


      $header = array_shift($rows);

      $requiredFields = [
        'Apartment Name',
        'Apartment Code',
        'First Name',
        'Promoter Code'
      ];

      if ($header !== $requiredFields) {
        echo '<script>alert("Invalid CSV header format");</script>';
        echo '<script>window.location.href = "add_promoter.php";</script>';
        exit;
      }

      $successCount = 0;
      $errorCount = 0;

      foreach ($rows as $row) {
        // Skip empty rows
        if (empty(array_filter($row))) {
          continue;
        }

        // Validate row data
        if (count($row) !== count($requiredFields)) {
          $errorCount++;
          continue;
        }

        list(
          $apartment_name,
          $apartment_code,
          $first_name,
          $promoter_code,
        ) = $row;

        $insert = $con->query("
            INSERT INTO tbl_btl_coded_apartment_rm_modal (
              apartment_name, apartment_code, promoter_name, promoter_code
            ) VALUES (
              '$apartment_name', '$apartment_code', '$first_name', '$promoter_code'
            )
          ");
        if ($insert) {
          $successCount++;
        } else {
          $errorCount++;
        }
      }


      echo '<script>alert("' . $successCount . ' records processed successfully. ' . $errorCount . ' errors occurred.");</script>';
      echo '<script>window.location.href = "add_promoter.php";</script>';
    } catch (Exception $e) {
      echo '<script>alert("An error occurred: ' . $e->getMessage() . '");</script>';
      echo '<script>window.location.href = "add_promoter.php";</script>';
    }
  } else {
    echo '<script>alert("File upload error. Please try again.");</script>';
    echo '<script>window.location.href = "add_promoter.php";</script>';
  }
}
