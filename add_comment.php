<?php
require_once 'db_connect.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticket_id = isset($_POST['ticket_id']) ? (int)$_POST['ticket_id'] : 0;
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    // Validate input
    if ($ticket_id <= 0 || empty($author) || empty($body)) {
        if ($ticket_id > 0) {
            header("Location: ticket.php?id=" . $ticket_id);
        } else {
            header("Location: index.php");
        }
        exit();
    }

    // Verify ticket exists
    $check_sql = "SELECT id FROM tickets WHERE id = ?";
    $check_stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "i", $ticket_id);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);
    
    if (mysqli_num_rows($check_result) === 0) {
        mysqli_stmt_close($check_stmt);
        mysqli_close($conn);
        header("Location: index.php");
        exit();
    }
    mysqli_stmt_close($check_stmt);

    // Insert comment
    $sql = "INSERT INTO comments (ticket_id, author, body) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iss", $ticket_id, $author, $body);
        
        if (mysqli_stmt_execute($stmt)) {
            // Update ticket's updated_at timestamp
            $update_sql = "UPDATE tickets SET updated_at = CURRENT_TIMESTAMP WHERE id = ?";
            $update_stmt = mysqli_prepare($conn, $update_sql);
            mysqli_stmt_bind_param($update_stmt, "i", $ticket_id);
            mysqli_stmt_execute($update_stmt);
            mysqli_stmt_close($update_stmt);
            
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: ticket.php?id=" . $ticket_id . "&msg=comment_added");
            exit();
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: ticket.php?id=" . $ticket_id);
            exit();
        }
    } else {
        mysqli_close($conn);
        header("Location: ticket.php?id=" . $ticket_id);
        exit();
    }
} else {
    // If not POST request, redirect to index
    header("Location: index.php");
    exit();
}
?>