<?php
$page_title = "Create New Ticket";
require_once 'header.php';
?>

<h2>Create New Support Ticket</h2>

<div class="form-container">
    <form action="save_ticket.php" method="POST">
        <div class="form-group">
            <label for="title">Ticket Title *</label>
            <input type="text" id="title" name="title" required 
                   placeholder="Brief description of the issue">
        </div>

        <div class="form-group">
            <label for="created_by">Your Name *</label>
            <input type="text" id="created_by" name="created_by" required 
                   placeholder="Enter your full name">
        </div>

        <div class="form-group">
            <label for="priority">Priority *</label>
            <select id="priority" name="priority" required>
                <option value="">Select Priority</option>
                <option value="Low">Low</option>
                <option value="Medium" selected>Medium</option>
                <option value="High">High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="due_at">Due Date (Optional)</label>
            <input type="datetime-local" id="due_at" name="due_at">
            <small style="color: #888; display: block; margin-top: 5px;">
                Leave empty if no specific deadline
            </small>
        </div>

        <div class="form-group">
            <label for="description">Description *</label>
            <textarea id="description" name="description" required 
                      placeholder="Provide detailed information about the issue, including steps to reproduce, error messages, etc."></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn">Create Ticket</button>
            <a href="index.php" class="btn btn-warning" style="margin-left: 10px;">Cancel</a>
        </div>
    </form>
</div>

<script>
// Set minimum datetime to current time
document.addEventListener('DOMContentLoaded', function() {
    const dueDateInput = document.getElementById('due_at');
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    
    dueDateInput.min = `${year}-${month}-${day}T${hours}:${minutes}`;
});
</script>

<?php require_once 'footer.php'; ?>