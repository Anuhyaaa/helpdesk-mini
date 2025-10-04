<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XAMPP Setup Diagnostic - Helpdesk Mini</title>
    <style>
        body { font-family: Arial, sans-serif; background: #1a1a1a; color: #e0e0e0; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { background: #2d2d2d; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .status { padding: 15px; margin: 10px 0; border-radius: 5px; }
        .success { background: #4CAF50; color: white; }
        .error { background: #f44336; color: white; }
        .warning { background: #ff9800; color: white; }
        .info { background: #2196F3; color: white; }
        .step { background: #2d2d2d; padding: 15px; margin: 10px 0; border-radius: 5px; border-left: 4px solid #4CAF50; }
        .code { background: #404040; padding: 10px; border-radius: 3px; font-family: monospace; }
        a { color: #4CAF50; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔧 XAMPP Setup Diagnostic</h1>
            <p>Let's check your XAMPP configuration and set up the database</p>
        </div>

        <?php
        // Check 1: PHP Extensions
        echo "<h2>📋 System Check</h2>";
        
        if (extension_loaded('mysqli')) {
            echo "<div class='status success'>✅ MySQLi extension is loaded</div>";
        } else {
            echo "<div class='status error'>❌ MySQLi extension not found</div>";
        }

        // Check 2: MySQL Connection (without database)
        echo "<h3>🔌 MySQL Connection Test</h3>";
        try {
            $test_conn = new mysqli('localhost', 'root', '', '', 3306);
            if ($test_conn->connect_error) {
                echo "<div class='status error'>❌ Cannot connect to MySQL: " . $test_conn->connect_error . "</div>";
                echo "<div class='status warning'>
                    <strong>Fix this by:</strong><br>
                    1. Open XAMPP Control Panel: <code>C:\\xampp\\xampp-control.exe</code><br>
                    2. Start the <strong>MySQL</strong> service<br>
                    3. Make sure the status shows 'Running' (green)
                </div>";
            } else {
                echo "<div class='status success'>✅ MySQL server is running</div>";
                echo "<div class='status info'>Server: " . $test_conn->server_info . "</div>";
                
                // Check if database exists
                $db_check = $test_conn->query("SHOW DATABASES LIKE 'helpdesk_db'");
                if ($db_check && $db_check->num_rows > 0) {
                    echo "<div class='status success'>✅ Database 'helpdesk_db' exists</div>";
                    
                    // Check tables
                    $test_conn->select_db('helpdesk_db');
                    $table_check = $test_conn->query("SHOW TABLES");
                    if ($table_check && $table_check->num_rows > 0) {
                        echo "<div class='status success'>✅ Database tables are created</div>";
                        
                        // Count tickets
                        $ticket_count = $test_conn->query("SELECT COUNT(*) as count FROM tickets");
                        if ($ticket_count) {
                            $count = $ticket_count->fetch_assoc()['count'];
                            echo "<div class='status info'>📊 Found $count ticket(s) in database</div>";
                        }
                        
                        echo "<div class='status success'>
                            <strong>🎉 Everything is set up correctly!</strong><br>
                            <a href='index.php' style='color: #ffeb3b; font-weight: bold;'>→ Go to Helpdesk Application</a>
                        </div>";
                    } else {
                        echo "<div class='status error'>❌ Database tables not found</div>";
                        show_import_instructions();
                    }
                } else {
                    echo "<div class='status error'>❌ Database 'helpdesk_db' not found</div>";
                    show_import_instructions();
                }
                $test_conn->close();
            }
        } catch (Exception $e) {
            echo "<div class='status error'>❌ Error: " . $e->getMessage() . "</div>";
        }

        function show_import_instructions() {
            echo "
            <h3>🔧 Database Setup Required</h3>
            <div class='step'>
                <h4>Step 1: Access phpMyAdmin</h4>
                <p>Open: <a href='http://localhost/phpmyadmin' target='_blank'><strong>http://localhost/phpmyadmin</strong></a></p>
            </div>
            
            <div class='step'>
                <h4>Step 2: Import Database</h4>
                <ol>
                    <li>Click the <strong>'Import'</strong> tab</li>
                    <li>Click <strong>'Choose File'</strong></li>
                    <li>Select: <div class='code'>C:\\xampp\\htdocs\\helpdesk-mini\\schema.sql</div></li>
                    <li>Click <strong>'Go'</strong> button</li>
                </ol>
            </div>
            
            <div class='step'>
                <h4>Step 3: Verify</h4>
                <p>After import, refresh this page to verify the setup</p>
            </div>";
        }
        ?>

        <h3>🔗 Quick Links</h3>
        <div class="step">
            <ul>
                <li><a href="http://localhost/phpmyadmin" target="_blank">📊 phpMyAdmin</a></li>
                <li><a href="index.php">🎫 Helpdesk Application</a></li>
                <li><a href="C:/xampp/xampp-control.exe">🎛️ XAMPP Control Panel</a></li>
            </ul>
        </div>

        <div class="step">
            <h4>📝 Next Steps</h4>
            <ol>
                <li>Make sure XAMPP MySQL is running</li>
                <li>Import the database using phpMyAdmin</li>
                <li>Access the helpdesk application</li>
            </ol>
        </div>
    </div>
</body>
</html>