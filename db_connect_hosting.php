<?php
// Database connection for hosting services
// Update these values with your hosting provider's database credentials

// For 000webhost or similar hosting
$servername = "localhost";  // Usually "localhost" for most hosts
$username = "id21234567_helpdesk_user";  // Your hosting database username
$password = "YourDatabasePassword123!";   // Your hosting database password
$dbname = "id21234567_helpdesk_db";      // Your hosting database name
$port = 3306;

// Alternative configuration for different hosts:
// 
// For InfinityFree:
// $servername = "sqlXXX.infinityfree.com";
// 
// For Heroku with ClearDB:
// Parse DATABASE_URL environment variable
// $db_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
// $servername = $db_url["host"];
// $username = $db_url["user"];
// $password = $db_url["pass"];
// $dbname = substr($db_url["path"], 1);

$test_conn = mysqli_connect($servername, $username, $password, "", $port);

if (!$test_conn) {
    die("
    <div style='background: #f44336; color: white; padding: 20px; margin: 20px; border-radius: 8px; font-family: Arial, sans-serif;'>
        <h2>❌ Database Server Connection Failed</h2>
        <p><strong>Error:</strong> " . mysqli_connect_error() . "</p>
        <h3>🔧 Check these settings:</h3>
        <ol>
            <li>Database server hostname is correct</li>
            <li>Database username is correct</li>
            <li>Database password is correct</li>
            <li>Database exists on the hosting server</li>
        </ol>
        <p><strong>Contact your hosting provider</strong> if the issue persists.</p>
    </div>");
}

$db_check = mysqli_query($test_conn, "SHOW DATABASES LIKE '$dbname'");

if (mysqli_num_rows($db_check) == 0) {
    mysqli_close($test_conn);
    die("
    <div style='background: #ff9800; color: white; padding: 20px; margin: 20px; border-radius: 8px; font-family: Arial, sans-serif;'>
        <h2>🗄️ Database '$dbname' Not Found</h2>
        <p>The database needs to be created on your hosting service.</p>
        
        <h3>📋 Setup Steps:</h3>
        <ol>
            <li>Log into your hosting control panel</li>
            <li>Go to <strong>Database</strong> or <strong>MySQL</strong> section</li>
            <li>Create a new database named: <code>$dbname</code></li>
            <li>Go to <strong>phpMyAdmin</strong></li>
            <li>Import the <code>schema.sql</code> file</li>
            <li>Refresh this page</li>
        </ol>
        
        <p><strong>Current settings:</strong></p>
        <ul>
            <li>Server: $servername</li>
            <li>Username: $username</li>
            <li>Database: $dbname</li>
        </ul>
    </div>");
}

mysqli_close($test_conn);
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

if (!$conn) {
    die("Connection to $dbname failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>