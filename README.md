# 🎫 Helpdesk Mini

A simple PHP + MySQL helpdesk system for managing support tickets. Built with a clean d## 🌐 Usage

1. **Create Tickets**: Use the "New Ticket" form
2. **Manage Status**: Update ticket status in ticket details
3. **Add Comments**: Collaborate using the comment system
4. **Track Progress**: Monitor tickets with priority and due date alerts

## 📁 Project Structure

```
helpdesk-mini/
├── 📄 Core Application
│   ├── index.php              # Main ticket listing
│   ├── new_ticket.php         # Create new tickets  
│   ├── ticket.php             # Ticket details & comments
│   ├── save_ticket.php        # Process ticket creation
│   ├── update_status.php      # Update ticket status
│   ├── add_comment.php        # Add comments
│   └── delete_ticket.php      # Delete tickets
├── 🗄️ Database & Config
│   ├── schema.sql             # Database structure
│   ├── db_connect.php         # Local database connection
│   └── db_connect_hosting.php # Hosting database config
├── 🎨 Frontend & Layout
│   ├── header.php             # Common header
│   ├── footer.php             # Common footer
│   └── style.css              # Dark theme CSS
├── 🛠️ Setup & Tools
│   ├── dashboard.php          # Project overview
│   ├── create_database.php    # Auto database setup
│   ├── test_db.php           # Connection tester
│   └── setup_database.php    # Manual setup guide
└── 📚 Documentation
    ├── README.md              # This file
    ├── PUBLIC_DEPLOYMENT.md   # Hosting guide
    └── GITHUB_SETUP.md        # Git instructions
```

## 🚀 Deployment

### Ready-to-Deploy Package
A deployment-ready ZIP file is included for easy hosting upload.

### Supported Hosting Platforms
- ✅ **000webhost** (Free)
- ✅ **InfinityFree** (Free) 
- ✅ **Heroku** (Free tier)
- ✅ **Railway** (Free tier)
- ✅ **Any PHP/MySQL hosting**eme and responsive design.

**Created by Anuhya**

## 🌐 Live Demo

**🚀 [View Live Demo](https://anuhya-helpdesk.000webhostapp.com)** *(Update this URL after deployment)*

## 🚀 Featureslpdesk Mini

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

### Local Development Setup

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

### 🌐 Public Deployment

This project is deployed and accessible online at:
**[Live Demo - Update URL after deployment](https://your-domain.000webhostapp.com)**

#### Deploy Your Own Copy:
1. **Free Hosting Options**: 000webhost, InfinityFree, Heroku
2. **Upload Files**: Use the provided deployment package
3. **Database Setup**: Import `schema.sql` 
4. **Update Config**: Modify `db_connect.php` with hosting credentials

See `PUBLIC_DEPLOYMENT.md` for detailed hosting instructions.

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