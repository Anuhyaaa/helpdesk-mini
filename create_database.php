<?php
// Automatic database creator for Helpdesk Mini
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Creating Database - Helpdesk Mini</title>
    <style>
        body { font-family: Arial, sans-serif; background: #1a1a1a; color: #e0e0e0; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        .step { background: #2d2d2d; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .success { background: #4CAF50; color: white; }
        .error { background: #f44336; color: white; }
        .progress { background: #2196F3; color: white; }
        .button { background: #4CAF50; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 10px 5px; }
        code { background: #404040; padding: 2px 6px; border-radius: 3px; }
    </style>
</head>
<body>
    <div class='container'>
        <h1>🚀 Auto-Creating Helpdesk Database</h1>";

try {
    echo "<div class='step progress'>🔌 Step 1: Connecting to MySQL server...</div>";
    
    // Connect to MySQL server (without specific database)
    $conn = mysqli_connect('localhost', 'root', '', '', 3306);
    
    if (!$conn) {
        throw new Exception("Cannot connect to MySQL: " . mysqli_connect_error());
    }
    
    echo "<div class='step success'>✅ MySQL connection successful!</div>";
    
    echo "<div class='step progress'>🗄️ Step 2: Creating database 'helpdesk_db'...</div>";
    
    // Create database
    if (mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS helpdesk_db")) {
        echo "<div class='step success'>✅ Database 'helpdesk_db' created successfully!</div>";
    } else {
        throw new Exception("Error creating database: " . mysqli_error($conn));
    }
    
    // Select the database
    mysqli_select_db($conn, 'helpdesk_db');
    
    echo "<div class='step progress'>📋 Step 3: Creating tables...</div>";
    
    // Read and execute schema.sql
    $schema_file = 'schema.sql';
    if (!file_exists($schema_file)) {
        throw new Exception("Schema file not found: $schema_file");
    }
    
    $sql_content = file_get_contents($schema_file);
    
    // Split SQL into individual statements
    $statements = array_filter(array_map('trim', explode(';', $sql_content)));
    
    $success_count = 0;
    foreach ($statements as $sql) {
        if (!empty($sql) && !preg_match('/^(--|DROP DATABASE|CREATE DATABASE|USE)/i', $sql)) {
            if (mysqli_query($conn, $sql)) {
                $success_count++;
            } else {
                echo "<div class='step error'>❌ Error executing: " . substr($sql, 0, 50) . "...<br>Error: " . mysqli_error($conn) . "</div>";
            }
        }
    }
    
    echo "<div class='step success'>✅ Tables created successfully! ($success_count statements executed)</div>";
    
    echo "<div class='step progress'>🎯 Step 4: Verifying setup...</div>";
    
    // Verify tables exist
    $tables_result = mysqli_query($conn, "SHOW TABLES");
    $table_count = mysqli_num_rows($tables_result);
    
    if ($table_count >= 2) {
        echo "<div class='step success'>✅ Found $table_count tables in database</div>";
        
        // Count sample data
        $ticket_result = mysqli_query($conn, "SELECT COUNT(*) as count FROM tickets");
        $ticket_count = mysqli_fetch_assoc($ticket_result)['count'];
        
        $comment_result = mysqli_query($conn, "SELECT COUNT(*) as count FROM comments");
        $comment_count = mysqli_fetch_assoc($comment_result)['count'];
        
        echo "<div class='step success'>
            ✅ Sample data loaded:
            <ul>
                <li>$ticket_count tickets</li>
                <li>$comment_count comments</li>
            </ul>
        </div>";
        
        echo "<div class='step success'>
            <h2>🎉 Database Setup Complete!</h2>
            <p>Your helpdesk system is now ready to use.</p>
            <a href='index.php' class='button'>🚀 Launch Helpdesk Application</a>
            <a href='test_db.php' class='button'>🧪 Test Connection</a>
        </div>";
        
    } else {
        throw new Exception("Tables were not created properly. Found only $table_count tables.");
    }
    
    mysqli_close($conn);
    
} catch (Exception $e) {
    echo "<div class='step error'>
        <h3>❌ Setup Failed</h3>
        <p><strong>Error:</strong> " . $e->getMessage() . "</p>
        <h4>🔧 Manual Setup Options:</h4>
        <ul>
            <li><a href='http://localhost/phpmyadmin' target='_blank' style='color: #ffeb3b;'>Use phpMyAdmin</a> to import schema.sql</li>
            <li><a href='setup_database.php' style='color: #ffeb3b;'>View detailed setup instructions</a></li>
        </ul>
    </div>";
}

echo "
    </div>
</body>
</html>";
?>