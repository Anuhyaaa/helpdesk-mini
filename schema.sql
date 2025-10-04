-- Helpdesk Mini Database Schema
-- Drop database if exists and create new one
DROP DATABASE IF EXISTS helpdesk_db;
CREATE DATABASE helpdesk_db;
USE helpdesk_db;

-- Create tickets table
CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    priority ENUM('Low', 'Medium', 'High') DEFAULT 'Medium',
    status ENUM('Open', 'In Progress', 'Closed') DEFAULT 'Open',
    created_by VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    due_at DATETIME NULL
);

-- Create comments table
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    author VARCHAR(100) NOT NULL,
    body TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE
);

-- Insert sample data for testing
INSERT INTO tickets (title, description, priority, status, created_by, due_at) VALUES
('Login Issue', 'Users cannot log into the system', 'High', 'Open', 'John Doe', '2025-10-10 17:00:00'),
('Slow Performance', 'Application loading slowly', 'Medium', 'In Progress', 'Jane Smith', '2025-10-08 12:00:00'),
('Feature Request', 'Add dark mode to interface', 'Low', 'Open', 'Bob Johnson', '2025-10-15 09:00:00'),
('Database Error', 'Connection timeout errors', 'High', 'Closed', 'Alice Brown', '2025-10-02 14:00:00');

INSERT INTO comments (ticket_id, author, body) VALUES
(1, 'Tech Support', 'Investigating the authentication service'),
(1, 'John Doe', 'This is affecting multiple users'),
(2, 'Dev Team', 'Optimizing database queries'),
(4, 'Alice Brown', 'Issue has been resolved with connection pool update');