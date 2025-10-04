<?php
require_once 'db_connect.php';

// Get ticket ID from URL
$ticket_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($ticket_id <= 0) {
    header("Location: index.php");
    exit();
}

// Verify ticket exists
$check_sql = "SELECT id, title FROM tickets WHERE id = ?";
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

$ticket = mysqli_fetch_assoc($check_result);
mysqli_stmt_close($check_stmt);

// Delete all comments associated with the ticket first
$delete_comments_sql = "DELETE FROM comments WHERE ticket_id = ?";
$delete_comments_stmt = mysqli_prepare($conn, $delete_comments_sql);
mysqli_stmt_bind_param($delete_comments_stmt, "i", $ticket_id);
mysqli_stmt_execute($delete_comments_stmt);
mysqli_stmt_close($delete_comments_stmt);

// Delete the ticket
$delete_ticket_sql = "DELETE FROM tickets WHERE id = ?";
$delete_ticket_stmt = mysqli_prepare($conn, $delete_ticket_sql);
mysqli_stmt_bind_param($delete_ticket_stmt, "i", $ticket_id);

if (mysqli_stmt_execute($delete_ticket_stmt)) {
    mysqli_stmt_close($delete_ticket_stmt);
    mysqli_close($conn);
    header("Location: index.php?msg=deleted");
    exit();
} else {
    mysqli_stmt_close($delete_ticket_stmt);
    mysqli_close($conn);
    header("Location: index.php");
    exit();
}
?>