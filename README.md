# Real Estate Website Project

A modern real estate listing website built with PHP and MySQL, focusing on property search, category browsing, and SEO optimization.

## Project Overview
This project is part of a larger real estate listing service, with the current implementation focusing on the homepage, search interface, and foundational features.

## Project Structure

RealState/
├── assets/ # Static assets directory
│ ├── css/ # Stylesheet files
│ │ ├── main.css # Core styles
│ │ ├── home.css # Homepage specific styles
│ │ ├── variables.css # CSS variables & theming
│ │ └── responsive.css # Mobile & responsive styles
│ ├── js/ # JavaScript files
│ │ └── main.js # Core JavaScript functionality
│ └── images/ # Image assets
│
├── includes/ # PHP components
│ ├── config.php # Database configuration
│ ├── database.php # Database connection handler
│ ├── functions.php # Helper functions
│ ├── header.php # Site header component
│ └── footer.php # Site footer component
│
├── seo/ # SEO related files
│ ├── robots.txt # Search engine rules
│ └── sitemap.xml # Site structure for SEO
│
├── index.php # Homepage file
└── real_estate.sql # Database structure & sample data

## Current Features
✅ Implemented:
- Responsive homepage with search interface
- Featured properties section
- Category browsing (display only)
- Mobile-first design
- SEO optimization
- Database structure for properties and categories

## Setup Requirements
- PHP 7.4+
- MySQL 5.7+
- Apache/XAMPP
- Web browser with JavaScript enabled

## Quick Start
1. Clone repository to XAMPP's htdocs
2. Create database 'real_estate' in phpMyAdmin
3. Import real_estate.sql
4. Configure includes/config.php with database credentials
5. Access via localhost/RealState

## Next Steps
See GUIDELINES.md for:
- Detailed development guidelines
- Feature implementation guides
- Code standards
- Integration points

## Tech Stack
- PHP (Backend)
- MySQL (Database)
- HTML5/CSS3 (Frontend)
- JavaScript (Interactivity)
- Apache (Server)

## Database Setup Instructions

## Prerequisites
- XAMPP installed
- Apache and MySQL services running

## Setup Steps

1. **Open phpMyAdmin**
   - Start XAMPP Control Panel
   - Start Apache and MySQL services
   - Click "Admin" next to MySQL or go to http://localhost/phpmyadmin

2. **Create Database**
   - Click "New" in the left sidebar
   - Enter database name: `real_estate`
   - Choose character set: `utf8mb4_general_ci`
   - Click "Create"

3. **Import Database Structure and Data**
   - Select the `real_estate` database from the left sidebar
   - Click the "Import" tab
   - Click "Choose File" and select `real_estate.sql` from this folder
   - Click "Go" at the bottom

4. **Verify Installation**
   - Check if the following tables are created:
     - properties
     - categories
     - property_features (if exists)
   - You should see sample data in these tables

## Database Configuration

Make sure your `includes/config.php` has these settings:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'real_estate');
```

## Sample Data
The imported database includes:
- Sample properties with images
- Property categories
- Featured properties for homepage

## Troubleshooting

1. **Connection Issues**
   - Verify XAMPP services are running
   - Check if database name matches in config.php
   - Default XAMPP credentials are username: 'root' with no password

2. **Import Errors**
   - Make sure you created the database first
   - Check if database name matches exactly: 'real_estate'
   - Verify the SQL file is not corrupted

3. **Missing Data**
   - After import, you should see X properties and Y categories
   - If data is missing, try re-importing the SQL file

## Database Setup
1. Create a new database named `real_estate` in phpMyAdmin
2. Import the `real_estate.sql` file from the project root
3. Update database credentials in `includes/config.php` if needed


