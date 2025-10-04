# 🎫 Helpdesk Mini

A simple PHP + MySQL helpdesk system for managing support tickets. Built with a clean dark theme and responsive design.

**Created by Anuhya**

## � Features

- **Ticket Management**: Create, view, update, and delete support tickets
- **Priority System**: Low, Medium, High priority levels with color-coded badges
- **Status Tracking**: Open, In Progress, Closed status with visual indicators
- **Due Date Support**: Set due dates and automatic overdue detection
- **Comments System**: Add comments to tickets for collaboration
- **Responsive Design**: Clean dark theme that works on all devices
- **XAMPP Ready**: Designed to work seamlessly with XAMPP setup

## � Installation

### Prerequisites
- XAMPP (Apache + MySQL)
- PHP 7.4 or higher
- MySQL 5.7 or higher

### Quick Setup

1. **Clone the repository**:
   ```bash
   git clone https://github.com/Anuhyaaa/helpdesk-mini.git
   cd helpdesk-mini
   ```

2. **Place in XAMPP directory**:
   ```
   Copy files to: c:\xampp\htdocs\helpdesk-mini\
   ```

3. **Start XAMPP services**:
   - Start Apache
   - Start MySQL

4. **Create database**:
   - Visit: `http://localhost/helpdesk-mini/create_database.php`
   - Or import `schema.sql` via phpMyAdmin

5. **Access application**:
   ```
   http://localhost/helpdesk-mini/
   ```

## �️ Database Schema

### Tickets Table
- `id` - Primary key
- `title` - Ticket title
- `description` - Detailed description
- `priority` - Low/Medium/High
- `status` - Open/In Progress/Closed
- `created_by` - Creator name
- `created_at` - Creation timestamp
- `updated_at` - Last update timestamp
- `due_at` - Due date (optional)

### Comments Table
- `id` - Primary key
- `ticket_id` - Foreign key to tickets
- `author` - Comment author
- `body` - Comment text
- `created_at` - Creation timestamp

## 🎨 Screenshots

The application features a modern dark theme with:
- Color-coded priority badges
- Status indicators
- Overdue alerts
- Responsive design

## 🔧 Configuration

Database connection settings in `db_connect.php`:
- Host: localhost
- Username: root
- Password: (empty)
- Database: helpdesk_db
- Port: 3306

## � Usage

1. **Create Tickets**: Use the "New Ticket" form
2. **Manage Status**: Update ticket status in ticket details
3. **Add Comments**: Collaborate using the comment system
4. **Track Progress**: Monitor tickets with priority and due date alerts

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## � License

This project is open source and available under the MIT License.

## 👤 Author

**Anuhya**

---

⭐ If you find this project helpful, please give it a star!