<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk Mini - Quick Start</title>
    <style>
        body { font-family: Arial, sans-serif; background: #1a1a1a; color: #e0e0e0; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { background: #2d2d2d; padding: 30px; border-radius: 8px; margin-bottom: 20px; text-align: center; }
        .option { background: #2d2d2d; padding: 20px; margin: 15px 0; border-radius: 8px; border-left: 4px solid #4CAF50; }
        .button { background: #4CAF50; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 10px 10px 10px 0; font-size: 16px; }
        .button:hover { background: #45a049; }
        .button-blue { background: #2196F3; }
        .button-blue:hover { background: #1976D2; }
        .button-orange { background: #ff9800; }
        .button-orange:hover { background: #e68900; }
        .warning { background: #ff9800; color: white; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .info { background: #2196F3; color: white; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .code { background: #404040; padding: 2px 6px; border-radius: 3px; font-family: monospace; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎫 Helpdesk Mini</h1>
            <h2>Quick Start Setup</h2>
            <p>Choose the best option to get started</p>
        </div>

        <div class="warning">
            <strong>⚠️ Database Error Detected</strong><br>
            The helpdesk_db database needs to be created. Choose an option below to fix this.
        </div>

        <div class="option">
            <h3>🚀 Option 1: Automatic Setup (Recommended)</h3>
            <p>Let the system automatically create the database and tables for you.</p>
            <a href="create_database.php" class="button">🔧 Auto-Create Database</a>
            <p><small>This will create the database, tables, and add sample data automatically.</small></p>
        </div>

        <div class="option">
            <h3>🔍 Option 2: Check Current Status</h3>
            <p>Test your current setup and see what needs to be fixed.</p>
            <a href="test_db.php" class="button button-blue">🧪 Test Database Status</a>
        </div>

        <div class="option">
            <h3>📋 Option 3: Manual Setup via phpMyAdmin</h3>
            <p>Use phpMyAdmin to import the database schema manually.</p>
            <a href="http://localhost/phpmyadmin" target="_blank" class="button button-orange">🔗 Open phpMyAdmin</a>
            <a href="setup_database.php" class="button button-orange">📖 Setup Guide</a>
            <p><small>Import the file: <span class="code">C:\xampp\htdocs\helpdesk-mini\schema.sql</span></small></p>
        </div>

        <div class="info">
            <h3>📋 Before You Start</h3>
            <p><strong>Make sure XAMPP is running:</strong></p>
            <ol>
                <li>Open XAMPP Control Panel: <span class="code">C:\xampp\xampp-control.exe</span></li>
                <li>Start <strong>Apache</strong> service</li>
                <li>Start <strong>MySQL</strong> service</li>
                <li>Both should show "Running" status</li>
            </ol>
        </div>

        <div class="option">
            <h3>🎯 What Happens Next</h3>
            <p>Once the database is set up, you'll have:</p>
            <ul>
                <li>✅ A working helpdesk ticket system</li>
                <li>✅ Sample tickets with different priorities</li>
                <li>✅ Comment system for collaboration</li>
                <li>✅ Status tracking (Open, In Progress, Closed)</li>
                <li>✅ Due date management with overdue alerts</li>
            </ul>
        </div>
    </div>
</body>
</html>