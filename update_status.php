<?php
require_once 'db_connect.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticket_id = isset($_POST['ticket_id']) ? (int)$_POST['ticket_id'] : 0;
    $status = trim($_POST['status']);

    // Validate input
    if ($ticket_id <= 0 || empty($status)) {
        header("Location: index.php");
        exit();
    }

    // Validate status
    $valid_statuses = ['Open', 'In Progress', 'Closed'];
    if (!in_array($status, $valid_statuses)) {
        header("Location: ticket.php?id=" . $ticket_id);
        exit();
    }

    // Update ticket status
    $sql = "UPDATE tickets SET status = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $status, $ticket_id);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: ticket.php?id=" . $ticket_id . "&msg=status_updated");
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