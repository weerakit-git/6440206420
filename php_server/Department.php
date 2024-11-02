<?php

include "db.php";

header('Content-Type: application/json');

try {

    // Query สำหรับดึงข้อมูลจากตาราง Department
    $sqlDepartment = "SELECT * FROM Departments";
    $stmtDepartment = $pdo->query($sqlDepartment);
    $departments = $stmtDepartment->fetchAll(PDO::FETCH_OBJ);

    // รวมข้อมูลทั้งหมดใน array
    $data = array(
        'departments' => $departments,
    );
    echo json_encode($data); // แปลงข้อมูลเป็น JSON แล้วแสดงผล
} catch (PDOException $e) {
    // แสดง error หากการเชื่อมต่อหรือ query ล้มเหลว
    $error = array('error' => $e->getMessage());
    echo json_encode($error);
}

?>
