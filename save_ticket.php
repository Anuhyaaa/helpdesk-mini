<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $priority = $_POST['priority'];
    $created_by = trim($_POST['created_by']);
    $due_at = !empty($_POST['due_at']) ? $_POST['due_at'] : null;

    if (empty($title) || empty($description) || empty($priority) || empty($created_by)) {
        header("Location: new_ticket.php?error=missing_fields");
        exit();
    }

    $valid_priorities = ['Low', 'Medium', 'High'];
    if (!in_array($priority, $valid_priorities)) {
        header("Location: new_ticket.php?error=invalid_priority");
        exit();
    }

    $sql = "INSERT INTO tickets (title, description, priority, created_by, due_at) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $title, $description, $priority, $created_by, $due_at);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: index.php?msg=created");
            exit();
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: new_ticket.php?error=db_error");
            exit();
        }
    } else {
        mysqli_close($conn);
        header("Location: new_ticket.php?error=db_error");
        exit();
    }
} else {
    header("Location: new_ticket.php");
    exit();
}
?>