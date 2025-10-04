<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>Helpdesk Mini</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <h1>🎫 Helpdesk Mini</h1>
                <nav>
                    <ul>
                        <li><a href="index.php">All Tickets</a></li>
                        <li><a href="new_ticket.php">New Ticket</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main class="container"><?php
ob_start();
?>