<?php
// Test database connection
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Database Test - Helpdesk Mini</title>
    <style>
        body { font-family: Arial, sans-serif; background: #1a1a1a; color: #e0e0e0; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        .result { padding: 20px; border-radius: 8px; margin: 20px 0; }
        .success { background: #4CAF50; color: white; }
        .error { background: #f44336; color: white; }
        .info { background: #2196F3; color: white; }
        .button { background: #4CAF50; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 10px 5px; }
        code { background: #404040; padding: 2px 6px; border-radius: 3px; }
    </style>
</head>
<body>
    <div class='container'>
        <h1>🧪 Database Connection Test</h1>";

try {
    // Test MySQL connection without specific database
    $test_conn = mysqli_connect('localhost', 'root', '', '', 3306);
    
    if (!$test_conn) {
        echo "<div class='result error'>
            <h3>❌ MySQL Server Connection Failed</h3>
            <p><strong>Error:</strong> " . mysqli_connect_error() . "</p>
            <p><strong>Solution:</strong></p>
            <ul>
                <li>Open XAMPP Control Panel</li>
                <li>Start the MySQL service</li>
                <li>Make sure it shows 'Running' status</li>
            </ul>
        </div>";
    } else {
        echo "<div class='result success'>
            <h3>✅ MySQL Server Connection: OK</h3>
            <p>Server Version: " . mysqli_get_server_info($test_conn) . "</p>
        </div>";
        
        // Check if helpdesk_db database exists
        $db_check = mysqli_query($test_conn, "SHOW DATABASES LIKE 'helpdesk_db'");
        
        if (mysqli_num_rows($db_check) > 0) {
            echo "<div class='result success'>
                <h3>✅ Database 'helpdesk_db' EXISTS</h3>
                <p>Database found successfully!</p>
            </div>";
            
            // Test connection to helpdesk_db
            mysqli_close($test_conn);
            $app_conn = mysqli_connect('localhost', 'root', '', 'helpdesk_db', 3306);
            
            if ($app_conn) {
                echo "<div class='result success'>
                    <h3>✅ Application Database Connection: OK</h3>
                </div>";
                
                // Check tables
                $tables = mysqli_query($app_conn, "SHOW TABLES");
                $table_count = mysqli_num_rows($tables);
                
                if ($table_count > 0) {
                    echo "<div class='result info'>
                        <h3>📊 Database Tables: $table_count found</h3>
                        <ul>";
                    while ($table = mysqli_fetch_array($tables)) {
                        echo "<li>" . $table[0] . "</li>";
                    }
                    echo "</ul></div>";
                    
                    // Count tickets
                    $ticket_count = mysqli_query($app_conn, "SELECT COUNT(*) as count FROM tickets");
                    $count = mysqli_fetch_assoc($ticket_count)['count'];
                    
                    echo "<div class='result info'>
                        <h3>🎫 Sample Data: $count tickets found</h3>
                    </div>";
                    
                    echo "<div class='result success'>
                        <h3>🎉 Everything is Working!</h3>
                        <p>Your helpdesk system is ready to use.</p>
                        <a href='index.php' class='button'>🚀 Launch Helpdesk App</a>
                    </div>";
                } else {
                    echo "<div class='result error'>
                        <h3>❌ No Tables Found</h3>
                        <p>Database exists but tables are missing.</p>
                        <p><strong>Solution:</strong> Import the schema.sql file via phpMyAdmin</p>
                        <a href='setup_database.php' class='button'>📋 Setup Instructions</a>
                    </div>";
                }
                
                mysqli_close($app_conn);
            }
        } else {
            echo "<div class='result error'>
                <h3>❌ Database 'helpdesk_db' NOT FOUND</h3>
                <p>The database needs to be created.</p>
                <a href='setup_database.php' class='button'>📋 Setup Instructions</a>
                <a href='http://localhost/phpmyadmin' target='_blank' class='button'>🔗 Open phpMyAdmin</a>
            </div>";
        }
        
        mysqli_close($test_conn);
    }
} catch (Exception $e) {
    echo "<div class='result error'>
        <h3>❌ Error</h3>
        <p>" . $e->getMessage() . "</p>
    </div>";
}

echo "
        <div class='result info'>
            <h3>📋 Quick Actions</h3>
            <a href='setup_database.php' class='button'>📋 Setup Guide</a>
            <a href='http://localhost/phpmyadmin' target='_blank' class='button'>🔗 phpMyAdmin</a>
            <a href='index.php' class='button'>🎫 Helpdesk App</a>
        </div>
    </div>
</body>
</html>";
?>