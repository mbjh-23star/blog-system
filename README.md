Blog Management System:
A full-stack PHP and MySQL-based blog management system with admin panel and AJAX filtering for dynamic content delivery.

Overview:
The primary goal of this system is to provide a user-friendly interface for managing and viewing blog content. The application uses AJAX to enable smooth content filtering without full-page reloads, improving user experience.

Tech Stack:-
Backend: PHP (Core)
Database: MySQL (Relational)
Frontend: HTML5, CSS3, JavaScript
Library: jQuery (AJAX for asynchronous data handling)
Hosting: InfinityFree (Apache Server environment)

Key Features:-
User-Facing Interface
Asynchronous Data Fetching: AJAX-based filtering by category and date allows users to browse content without full-page reloads.
Dynamic Search: Search functionality for content discovery.
Responsive Architecture: Built using CSS Flexbox/Grid for cross-device compatibility.

Administrative Dashboard:-
Secure Authentication: Session-based login system to protect backend operations.
Content Management: Full control over blog posts (add, edit, delete).
Image Upload System: Handles blog images with proper directory storage.

Project Structure:
/htdocs
├── index.php         # Main entry point & public listing
├── login.php         # Admin authentication logic
├── adminindex.php    # Protected administrative dashboard
├── fetchbg.php       # AJAX controller for data retrieval
├── bgcontent.php     # Single post view controller
├── addblog.php       # Create blog functionality
├── editbg.php        # Edit blog functionality
├── deletebg.php      # Delete blog functionality
└── images/           # Blog media assets

Installation & Setup

Local Environment (XAMPP)

Clone the project into the `htdocs` directory.  
Create a MySQL database named `blog_db`.  
mport the provided `blog_db.sql` file using phpMyAdmin.  
Configure the database credentials in the PHP files.

Production Deployment:-
Upload source files to the hosting server.
Create a MySQL database via the hosting control panel.
Import the blog_db.sql file into phpMyAdmin.
Update database connection parameters (Hostname, Database Name, Username, Password).

Note: Ensure the `/images` directory is properly configured for image storage.

Technical Outcomes:-
Session Management: Implements user authentication and session persistence.
Performance Optimization: Uses AJAX to reduce full-page reloads.
Database Design: Implements a relational structure for managing blog categories and posts.
