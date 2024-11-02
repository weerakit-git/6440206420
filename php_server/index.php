<?php

include "db.php";

header('Content-Type: application/json');

$sql = "SELECT
            sa.ID,
            sa.FirstName_StudentTH,
            sa.LastName_StudentTH,
            sa.Email_Student,
            f.Name_Faculty AS Faculty_Student,
            d.Name_Department AS Department_Student,
            m.Name_Major AS Major_Student,
            sa.FirstName_AdvisorTH,
            sa.LastName_AdvisorTH,
            sa.Email_Advisor,
            f.Name_Faculty AS Faculty_Advisor
        FROM
            StudentAdvisor sa
        JOIN
            Faculty f ON sa.Faculty_Student = f.ID_Faculty
        JOIN
            Departments d ON sa.Department_Student = d.ID_Department
        JOIN
            Major m ON sa.Major_Student = m.ID_Major";

try {
    $db = new db(); // สร้าง object สำหรับการเชื่อมต่อฐานข้อมูล
    $pdo = $db->connect(); // เรียกใช้ฟังก์ชันเชื่อมต่อ
    $stmt = $pdo->query($sql); // สร้าง statement สำหรับ query ข้อมูล
    $users = $stmt->fetchAll(PDO::FETCH_OBJ); // ดึงข้อมูลทั้งหมดในรูปแบบ object

    // Query สำหรับดึงข้อมูลจากตาราง Faculty
    $sqlFaculty = "SELECT * FROM Faculty";
    $stmtFaculty = $pdo->query($sqlFaculty);
    $faculties = $stmtFaculty->fetchAll(PDO::FETCH_OBJ);

    // Query สำหรับดึงข้อมูลจากตาราง Department
    $sqlDepartment = "SELECT * FROM Departments";
    $stmtDepartment = $pdo->query($sqlDepartment);
    $departments = $stmtDepartment->fetchAll(PDO::FETCH_OBJ);

    // Query สำหรับดึงข้อมูลจากตาราง Major
    $sqlMajor = "SELECT * FROM Major";
    $stmtMajor = $pdo->query($sqlMajor);
    $majors = $stmtMajor->fetchAll(PDO::FETCH_OBJ);

    // รวมข้อมูลทั้งหมดใน array
    $data = array(
        'studentAdvisors' => $users,
        'departments' => $departments,
        'faculties' => $faculties,
        'majors' => $majors
    );

    echo json_encode($data); // แปลงข้อมูลเป็น JSON แล้วแสดงผล
} catch (PDOException $e) {
    // แสดง error หากการเชื่อมต่อหรือ query ล้มเหลว
    $error = array('error' => $e->getMessage());
    echo json_encode($error);
}

?>
