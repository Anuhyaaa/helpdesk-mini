<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk Mini - Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #1a1a1a; color: #e0e0e0; margin: 0; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; }
        .header { background: #2d2d2d; padding: 30px; border-radius: 8px; margin-bottom: 30px; text-align: center; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        .card { background: #2d2d2d; padding: 25px; border-radius: 8px; border-left: 4px solid #4CAF50; }
        .card.setup { border-left-color: #ff9800; }
        .card.test { border-left-color: #2196F3; }
        .card.app { border-left-color: #4CAF50; }
        .button { background: #4CAF50; color: white; padding: 12px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 8px 8px 8px 0; }
        .button:hover { background: #45a049; }
        .button-orange { background: #ff9800; } .button-orange:hover { background: #e68900; }
        .button-blue { background: #2196F3; } .button-blue:hover { background: #1976D2; }
        .status { padding: 10px; border-radius: 5px; margin: 10px 0; }
        .status.unknown { background: #555; }
        .code { background: #404040; padding: 2px 6px; border-radius: 3px; font-family: monospace; }
        h3 { margin-top: 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎫 Helpdesk Mini Dashboard</h1>
            <p>Complete PHP + MySQL Ticket Management System</p>
        </div>

        <div class="grid">
            <!-- Main Application -->
            <div class="card app">
                <h3>🚀 Main Application</h3>
                <p>The complete helpdesk ticket system with all features.</p>
                <a href="index.php" class="button">📋 View All Tickets</a>
                <a href="new_ticket.php" class="button">➕ Create New Ticket</a>
                <div class="status unknown">
                    Status: <?php
                    try {
                        $test_conn = @mysqli_connect('localhost', 'root', '', 'helpdesk_db', 3306);
                        if ($test_conn) {
                            $result = @mysqli_query($test_conn, "SELECT COUNT(*) as count FROM tickets");
                            if ($result) {
                                $count = mysqli_fetch_assoc($result)['count'];
                                echo "<span style='color: #4CAF50;'>✅ Ready ($count tickets)</span>";
                            } else {
                                echo "<span style='color: #ff9800;'>⚠️ Tables missing</span>";
                            }
                            mysqli_close($test_conn);
                        } else {
                            echo "<span style='color: #f44336;'>❌ Database not found</span>";
                        }
                    } catch (Exception $e) {
                        echo "<span style='color: #f44336;'>❌ Need setup</span>";
                    }
                    ?>
                </div>
            </div>

            <!-- Setup Tools -->
            <div class="card setup">
                <h3>🔧 Setup & Configuration</h3>
                <p>Tools to set up and configure the database.</p>
                <a href="start.php" class="button button-orange">🚀 Quick Start Guide</a>
                <a href="create_database.php" class="button button-orange">🔧 Auto-Create DB</a>
                <a href="setup_database.php" class="button button-orange">📋 Manual Setup</a>
            </div>

            <!-- Testing Tools -->
            <div class="card test">
                <h3>🧪 Testing & Diagnostics</h3>
                <p>Check system status and troubleshoot issues.</p>
                <a href="test_db.php" class="button button-blue">🧪 Test Database</a>
                <a href="setup_check.php" class="button button-blue">🔍 System Check</a>
            </div>

            <!-- External Tools -->
            <div class="card">
                <h3>🌐 External Tools</h3>
                <p>Access phpMyAdmin and XAMPP control panel.</p>
                <a href="http://localhost/phpmyadmin" target="_blank" class="button">🗄️ phpMyAdmin</a>
                <a href="file:///C:/xampp/xampp-control.exe" class="button">🎛️ XAMPP Control</a>
            </div>

            <!-- File Management -->
            <div class="card">
                <h3>📁 Project Files</h3>
                <p>Important files and documentation.</p>
                <div style="margin: 10px 0;">
                    <strong>Schema:</strong> <span class="code">schema.sql</span><br>
                    <strong>Config:</strong> <span class="code">db_connect.php</span><br>
                    <strong>Docs:</strong> <span class="code">README.md</span>
                </div>
                <p><strong>Project Location:</strong><br>
                <span class="code">C:\xampp\htdocs\helpdesk-mini\</span></p>
            </div>

            <!-- Features Overview -->
            <div class="card">
                <h3>⭐ Features</h3>
                <p>What's included in this helpdesk system:</p>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>✅ Ticket creation & management</li>
                    <li>✅ Priority levels (Low/Medium/High)</li>
                    <li>✅ Status tracking (Open/In Progress/Closed)</li>
                    <li>✅ Due date management with overdue alerts</li>
                    <li>✅ Comment system for collaboration</li>
                    <li>✅ Dark theme responsive design</li>
                    <li>✅ MySQL database with sample data</li>
                </ul>
            </div>
        </div>

        <div style="background: #2d2d2d; padding: 20px; border-radius: 8px; margin-top: 30px; text-align: center;">
            <h3>🎯 Quick Actions</h3>
            <p>Most common tasks:</p>
            <?php
            try {
                $test_conn = @mysqli_connect('localhost', 'root', '', 'helpdesk_db', 3306);
                if ($test_conn) {
                    echo '<a href="index.php" class="button">🚀 Launch Helpdesk</a>';
                    echo '<a href="new_ticket.php" class="button">➕ New Ticket</a>';
                    mysqli_close($test_conn);
                } else {
                    echo '<a href="create_database.php" class="button button-orange">🔧 Setup Database First</a>';
                }
            } catch (Exception $e) {
                echo '<a href="create_database.php" class="button button-orange">🔧 Setup Database First</a>';
            }
            ?>
            <a href="test_db.php" class="button button-blue">🧪 Check Status</a>
        </div>
    </div>
</body>
</html>