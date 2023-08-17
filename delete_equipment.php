<?php
require_once 'database.php';

if(isset($_GET['id'])) {
    $equipment_id = $_GET['id'];

    if(deleteEquipment($equipment_id)) {
        header("Location: view_equipments.php");
        exit();
    } else {
        // Display an error message or handle the failure
    }
}
?>

