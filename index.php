<?php
$page_title = "All Tickets";
require_once 'db_connect.php';
require_once 'header.php';

$sql = "SELECT * FROM tickets ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

$message = '';
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'created':
            $message = '<div class="alert alert-success">Ticket created successfully!</div>';
            break;
        case 'updated':
            $message = '<div class="alert alert-success">Ticket status updated successfully!</div>';
            break;
        case 'deleted':
            $message = '<div class="alert alert-success">Ticket deleted successfully!</div>';
            break;
        case 'comment_added':
            $message = '<div class="alert alert-success">Comment added successfully!</div>';
            break;
    }
}
?>

<h2>All Support Tickets</h2>

<?php echo $message; ?>

<div style="margin-bottom: 20px;">
    <a href="new_ticket.php" class="btn">+ Create New Ticket</a>
</div>

<?php if ($result && $result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Created By</th>
                <th>Created At</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php
                // Check if ticket is overdue
                $is_overdue = false;
                if ($row['due_at'] && $row['status'] !== 'Closed') {
                    $due_date = new DateTime($row['due_at']);
                    $current_date = new DateTime();
                    $is_overdue = $current_date > $due_date;
                }
                ?>
                <tr>
                    <td>#<?php echo $row['id']; ?></td>
                    <td>
                        <a href="ticket.php?id=<?php echo $row['id']; ?>" style="color: #4CAF50; text-decoration: none;">
                            <?php echo htmlspecialchars($row['title']); ?>
                        </a>
                    </td>
                    <td>
                        <span class="priority <?php echo strtolower($row['priority']); ?>">
                            <?php echo $row['priority']; ?>
                        </span>
                    </td>
                    <td>
                        <span class="status <?php echo strtolower(str_replace(' ', '-', $row['status'])); ?>">
                            <?php echo $row['status']; ?>
                        </span>
                    </td>
                    <td><?php echo htmlspecialchars($row['created_by']); ?></td>
                    <td><?php echo date('M j, Y g:i A', strtotime($row['created_at'])); ?></td>
                    <td>
                        <?php if ($row['due_at']): ?>
                            <?php echo date('M j, Y g:i A', strtotime($row['due_at'])); ?>
                            <?php if ($is_overdue): ?>
                                <br><span class="overdue">Overdue</span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span style="color: #888;">No due date</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="ticket.php?id=<?php echo $row['id']; ?>" class="btn btn-small">View</a>
                        <a href="delete_ticket.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-danger btn-small" 
                           onclick="return confirm('Are you sure you want to delete this ticket?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <div style="text-align: center; padding: 50px; background-color: #2d2d2d; border-radius: 8px; margin-top: 20px;">
        <h3>No tickets found</h3>
        <p>Create your first support ticket to get started.</p>
        <a href="new_ticket.php" class="btn" style="margin-top: 15px;">Create New Ticket</a>
    </div>
<?php endif; ?>

<?php
mysqli_close($conn);
require_once 'footer.php';
?>