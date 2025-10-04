<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup - Helpdesk Mini</title>
    <style>
        body { font-family: Arial, sans-serif; background: #1a1a1a; color: #e0e0e0; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { background: #2d2d2d; padding: 20px; border-radius: 8px; margin-bottom: 20px; text-align: center; }
        .step { background: #2d2d2d; padding: 20px; margin: 15px 0; border-radius: 8px; border-left: 4px solid #4CAF50; }
        .error { background: #f44336; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .success { background: #4CAF50; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .code { background: #404040; padding: 10px; border-radius: 3px; font-family: monospace; display: inline-block; }
        .button { background: #4CAF50; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 10px 5px; }
        .button:hover { background: #45a049; }
        .warning { background: #ff9800; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        ol li { margin-bottom: 10px; }
        .screenshot { border: 2px solid #4CAF50; border-radius: 5px; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔧 Database Setup Required</h1>
            <p>The helpdesk_db database needs to be created</p>
        </div>

        <div class="error">
            <strong>❌ Error Found:</strong> Database 'helpdesk_db' does not exist<br>
            <strong>Solution:</strong> Follow the steps below to create the database
        </div>

        <div class="step">
            <h3>📋 Step 1: Access phpMyAdmin</h3>
            <p>Click the button below to open phpMyAdmin:</p>
            <a href="http://localhost/phpmyadmin" target="_blank" class="button">🔗 Open phpMyAdmin</a>
            <p><small>Or manually go to: <span class="code">http://localhost/phpmyadmin</span></small></p>
        </div>

        <div class="step">
            <h3>📁 Step 2: Create Database</h3>
            <p><strong>Method 1: Quick Import (Recommended)</strong></p>
            <ol>
                <li>In phpMyAdmin, click the <strong>"Import"</strong> tab at the top</li>
                <li>Click <strong>"Choose File"</strong> button</li>
                <li>Navigate to and select: <span class="code">C:\xampp\htdocs\helpdesk-mini\schema.sql</span></li>
                <li>Click <strong>"Go"</strong> button to import</li>
                <li>You should see "Import has been successfully finished"</li>
            </ol>
            
            <p><strong>Method 2: Manual Creation</strong></p>
            <ol>
                <li>Click <strong>"New"</strong> in the left sidebar</li>
                <li>Enter database name: <span class="code">helpdesk_db</span></li>
                <li>Click <strong>"Create"</strong></li>
                <li>Select the new database from the left sidebar</li>
                <li>Click <strong>"SQL"</strong> tab</li>
                <li>Copy and paste the SQL from <span class="code">schema.sql</span> file</li>
                <li>Click <strong>"Go"</strong></li>
            </ol>
        </div>

        <div class="step">
            <h3>✅ Step 3: Verify Setup</h3>
            <p>After creating the database, click below to test the connection:</p>
            <a href="test_db.php" class="button">🧪 Test Database Connection</a>
            <a href="index.php" class="button">🎫 Go to Helpdesk App</a>
        </div>

        <div class="warning">
            <strong>⚠️ Important:</strong> Make sure XAMPP's MySQL service is running before proceeding!
            <br>Check XAMPP Control Panel: <span class="code">C:\xampp\xampp-control.exe</span>
        </div>

        <div class="step">
            <h3>📄 Quick Reference</h3>
            <p><strong>Files Location:</strong></p>
            <ul>
                <li>Schema file: <span class="code">C:\xampp\htdocs\helpdesk-mini\schema.sql</span></li>
                <li>Application: <span class="code">http://localhost/helpdesk-mini/</span></li>
                <li>phpMyAdmin: <span class="code">http://localhost/phpmyadmin/</span></li>
            </ul>
        </div>
    </div>
</body>
</html>