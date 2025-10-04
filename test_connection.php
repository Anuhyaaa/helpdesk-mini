<?php
echo "Testing MySQL Connection...\n";

try {
    $conn = new mysqli('localhost', 'root', '', '', 3306);
    
    if ($conn->connect_error) {
        echo "❌ Connection FAILED: " . $conn->connect_error . "\n";
    } else {
        echo "✅ MySQL Connection SUCCESS!\n";
        echo "Server info: " . $conn->server_info . "\n";
        
        // Test if helpdesk_db exists
        $result = $conn->query("SHOW DATABASES LIKE 'helpdesk_db'");
        if ($result && $result->num_rows > 0) {
            echo "✅ Database 'helpdesk_db' exists\n";
        } else {
            echo "❌ Database 'helpdesk_db' does NOT exist\n";
            echo "📝 You need to create the database using schema.sql\n";
        }
        
        $conn->close();
    }
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
}

echo "\n📋 Troubleshooting Steps:\n";
echo "1. Make sure XAMPP is running\n";
echo "2. Start Apache and MySQL in XAMPP Control Panel\n";
echo "3. Check if phpMyAdmin works: http://localhost/phpmyadmin\n";
echo "4. Import schema.sql to create the database\n";
?>