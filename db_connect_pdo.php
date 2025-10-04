<?php
// Database connection configuration using PDO (more compatible)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "helpdesk_db";
$port = 3306;

try {
    // Create PDO connection
    $dsn = "mysql:host=$servername;port=$port;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $username, $password);
    
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // For compatibility, create a mysqli-like object
    $conn = new stdClass();
    $conn->pdo = $pdo;
    $conn->connect_error = null;
    
    // Add helper methods
    $conn->query = function($sql) use ($pdo) {
        $stmt = $pdo->query($sql);
        $result = new stdClass();
        $result->num_rows = $stmt->rowCount();
        $result->fetch_assoc = function() use ($stmt) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        };
        return $result;
    };
    
    $conn->prepare = function($sql) use ($pdo) {
        return $pdo->prepare($sql);
    };
    
    $conn->close = function() use ($pdo) {
        $pdo = null;
    };
    
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>