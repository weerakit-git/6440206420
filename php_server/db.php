<?php
class db
{
    private $host = "158.108.110.35";
    private $user = "6440206420";
    private $pass = "1qazxsw2";
    private $dbname = "data22565_6440206420";
    public function connect()
    {
        try {
            $pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            // แสดงข้อผิดพลาด
            echo "Connection failed: " . $e->getMessage();
            // สามารถ log ข้อผิดพลาดไปยังไฟล์ log ได้หากต้องการ
            // error_log($e->getMessage(), 3, '/path/to/your/error.log');
            return null;
        }
    }
}
?>
