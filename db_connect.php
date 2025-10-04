<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "helpdesk_db";
$port = 3306;

$test_conn = mysqli_connect($servername, $username, $password, "", $port);

if (!$test_conn) {
    die("
    <div style='background: #f44336; color: white; padding: 20px; margin: 20px; border-radius: 8px; font-family: Arial, sans-serif;'>
        <h2>❌ MySQL Server Not Running</h2>
        <p><strong>Error:</strong> " . mysqli_connect_error() . "</p>
        <h3>🔧 Fix this by:</h3>
        <ol>
            <li>Open XAMPP Control Panel: <code>C:\\xampp\\xampp-control.exe</code></li>
            <li>Click <strong>Start</strong> next to MySQL</li>
            <li>Wait for it to show 'Running' status</li>
            <li>Refresh this page</li>
        </ol>
    </div>");
}

$db_check = mysqli_query($test_conn, "SHOW DATABASES LIKE 'helpdesk_db'");

if (mysqli_num_rows($db_check) == 0) {
    mysqli_close($test_conn);
    die("
    <div style='background: #ff9800; color: white; padding: 20px; margin: 20px; border-radius: 8px; font-family: Arial, sans-serif;'>
        <h2>🗄️ Database 'helpdesk_db' Not Found</h2>
        <p>The database needs to be created first.</p>
        
        <h3>📋 Quick Setup Options:</h3>
        
        <div style='background: rgba(255,255,255,0.1); padding: 15px; border-radius: 5px; margin: 15px 0;'>
            <h4>Option 1: Automatic Setup (Recommended)</h4>
            <a href='create_database.php' style='background: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 5px 0;'>🚀 Auto-Create Database</a>
        </div>
        
        <div style='background: rgba(255,255,255,0.1); padding: 15px; border-radius: 5px; margin: 15px 0;'>
            <h4>Option 2: Manual Setup via phpMyAdmin</h4>
            <ol>
                <li>Go to <a href='http://localhost/phpmyadmin' target='_blank' style='color: #ffeb3b;'>phpMyAdmin</a></li>
                <li>Click <strong>'Import'</strong> tab</li>
                <li>Choose file: <code>C:\\xampp\\htdocs\\helpdesk-mini\\schema.sql</code></li>
                <li>Click <strong>'Go'</strong></li>
                <li>Refresh this page</li>
            </ol>
        </div>
        
        <p><a href='setup_database.php' style='color: #ffeb3b;'>📖 Detailed Setup Instructions</a></p>
    </div>");
}

mysqli_close($test_conn);
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

if (!$conn) {
    die("Connection to helpdesk_db failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>