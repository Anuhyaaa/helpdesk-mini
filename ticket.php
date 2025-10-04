<?php
require_once 'db_connect.php';

// Get ticket ID from URL
$ticket_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($ticket_id <= 0) {
    header("Location: index.php");
    exit();
}

// Fetch ticket details
$sql = "SELECT * FROM tickets WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $ticket_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 0) {
    header("Location: index.php");
    exit();
}

$ticket = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Fetch comments for this ticket
$sql_comments = "SELECT * FROM comments WHERE ticket_id = ? ORDER BY created_at ASC";
$stmt_comments = mysqli_prepare($conn, $sql_comments);
mysqli_stmt_bind_param($stmt_comments, "i", $ticket_id);
mysqli_stmt_execute($stmt_comments);
$comments_result = mysqli_stmt_get_result($stmt_comments);

$page_title = "Ticket #" . $ticket['id'] . " - " . $ticket['title'];
require_once 'header.php';

// Check for success/error messages
$message = '';
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'status_updated':
            $message = '<div class="alert alert-success">Ticket status updated successfully!</div>';
            break;
        case 'comment_added':
            $message = '<div class="alert alert-success">Comment added successfully!</div>';
            break;
    }
}

// Check if ticket is overdue
$is_overdue = false;
if ($ticket['due_at'] && $ticket['status'] !== 'Closed') {
    $due_date = new DateTime($ticket['due_at']);
    $current_date = new DateTime();
    $is_overdue = $current_date > $due_date;
}
?>

<div style="margin-bottom: 20px;">
    <a href="index.php" class="btn">← Back to All Tickets</a>
</div>

<?php echo $message; ?>

<div class="ticket-details">
    <h2><?php echo htmlspecialchars($ticket['title']); ?></h2>
    
    <div class="ticket-meta">
        <div class="meta-item">
            <div class="meta-label">Ticket ID</div>
            <div class="meta-value">#<?php echo $ticket['id']; ?></div>
        </div>
        
        <div class="meta-item">
            <div class="meta-label">Status</div>
            <div class="meta-value">
                <span class="status <?php echo strtolower(str_replace(' ', '-', $ticket['status'])); ?>">
                    <?php echo $ticket['status']; ?>
                </span>
            </div>
        </div>
        
        <div class="meta-item">
            <div class="meta-label">Priority</div>
            <div class="meta-value">
                <span class="priority <?php echo strtolower($ticket['priority']); ?>">
                    <?php echo $ticket['priority']; ?>
                </span>
            </div>
        </div>
        
        <div class="meta-item">
            <div class="meta-label">Created By</div>
            <div class="meta-value"><?php echo htmlspecialchars($ticket['created_by']); ?></div>
        </div>
        
        <div class="meta-item">
            <div class="meta-label">Created At</div>
            <div class="meta-value"><?php echo date('M j, Y g:i A', strtotime($ticket['created_at'])); ?></div>
        </div>
        
        <div class="meta-item">
            <div class="meta-label">Last Updated</div>
            <div class="meta-value"><?php echo date('M j, Y g:i A', strtotime($ticket['updated_at'])); ?></div>
        </div>
        
        <div class="meta-item">
            <div class="meta-label">Due Date</div>
            <div class="meta-value">
                <?php if ($ticket['due_at']): ?>
                    <?php echo date('M j, Y g:i A', strtotime($ticket['due_at'])); ?>
                    <?php if ($is_overdue): ?>
                        <br><span class="overdue">Overdue</span>
                    <?php endif; ?>
                <?php else: ?>
                    <span style="color: #888;">No due date set</span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div style="margin-top: 30px;">
        <h3>Description</h3>
        <div style="background-color: #404040; padding: 20px; border-radius: 6px; margin-top: 10px;">
            <?php echo nl2br(htmlspecialchars($ticket['description'])); ?>
        </div>
    </div>

    <!-- Status Update Form -->
    <?php if ($ticket['status'] !== 'Closed'): ?>
    <div style="margin-top: 30px;">
        <h3>Update Status</h3>
        <form action="update_status.php" method="POST" style="margin-top: 15px;">
            <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
            <div style="display: flex; gap: 10px; align-items: center;">
                <select name="status" required style="width: auto;">
                    <option value="">Change Status</option>
                    <option value="Open" <?php echo $ticket['status'] === 'Open' ? 'disabled' : ''; ?>>Open</option>
                    <option value="In Progress" <?php echo $ticket['status'] === 'In Progress' ? 'disabled' : ''; ?>>In Progress</option>
                    <option value="Closed" <?php echo $ticket['status'] === 'Closed' ? 'disabled' : ''; ?>>Closed</option>
                </select>
                <button type="submit" class="btn">Update Status</button>
            </div>
        </form>
    </div>
    <?php endif; ?>
</div>

<!-- Comments Section -->
<div class="comments-section">
    <h3>Comments (<?php echo $comments_result->num_rows; ?>)</h3>
    
    <!-- Add Comment Form -->
    <div class="form-container" style="margin-top: 20px;">
        <h4>Add Comment</h4>
        <form action="add_comment.php" method="POST">
            <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
            <div class="form-group">
                <label for="author">Your Name</label>
                <input type="text" id="author" name="author" required placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label for="body">Comment</label>
                <textarea id="body" name="body" required placeholder="Write your comment here..."></textarea>
            </div>
            <button type="submit" class="btn">Add Comment</button>
        </form>
    </div>

    <!-- Display Comments -->
    <?php if (mysqli_num_rows($comments_result) > 0): ?>
        <div style="margin-top: 30px;">
            <?php while ($comment = mysqli_fetch_assoc($comments_result)): ?>
                <div class="comment">
                    <div class="comment-author"><?php echo htmlspecialchars($comment['author']); ?></div>
                    <div class="comment-date"><?php echo date('M j, Y g:i A', strtotime($comment['created_at'])); ?></div>
                    <div class="comment-body"><?php echo nl2br(htmlspecialchars($comment['body'])); ?></div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div style="text-align: center; padding: 30px; background-color: #2d2d2d; border-radius: 8px; margin-top: 20px;">
            <p style="color: #888;">No comments yet. Be the first to comment!</p>
        </div>
    <?php endif; ?>
</div>

<?php
mysqli_stmt_close($stmt_comments);
mysqli_close($conn);
require_once 'footer.php';
?>