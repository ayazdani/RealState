# Real Estate Website Project

A modern real estate website built with PHP and MySQL, featuring property listings, search functionality, and category browsing.

## Quick Start Guide

### Installation


1. **Get Repository Access**
   - Get the repository URL from your team lead
   - The URL will look like: 
     - HTTPS: `https://github.com/username/RealState.git`
     - or SSH: `git@github.com:username/RealState.git`

2. **Clone the Repository**
   ```bash
   # Using HTTPS
   git clone https://github.com/username/RealState.git
   # OR using SSH
   git clone git@github.com:username/RealState.git

   # Enter the project directory
   cd RealState
   ```

3. **Database Setup**
   ```bash
   mysql -u your_username -p real_estate < real_estate.sql
   ```

4. **Configure Database**
   Edit `includes/config.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'your_username');
   define('DB_PASS', 'your_password');
   define('DB_NAME', 'real_estate');
   ```


5. **Access the Website**
   - Open: `http://localhost/RealState/`

For detailed setup and development guidelines, see [GUIDELINES.md](GUIDELINES.md)

## Project Structure

## Project Overview
This project is part of a larger real estate listing service, with the current implementation focusing on the homepage, search interface, and foundational features.

## Current Features
✅ Implemented:
- Responsive homepage with search interface
- Featured properties section
- Category browsing (display only)
- Mobile-first design
- SEO optimization
- Database structure for properties and categories


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

## Development Guidelines

1. **CSS Changes**
   - Core styles are in `assets/css/main.css`
   - Homepage specific styles in `assets/css/home.css`
   - Global variables in `assets/css/variables.css`
   - Responsive designs in `assets/css/responsive.css`

2. **PHP Components**
   - All database queries should go through `includes/database.php`
   - Common functions are in `includes/functions.php`
   - Reusable header/footer in respective files

3. **SEO**
   - Update `seo/robots.txt` for search engine crawling rules
   - Maintain `seo/sitemap.xml` when adding new pages

## Contributing
1. Create a new branch for your feature
   ```bash
   git checkout -b feature/your-feature-name
   ```
2. Make your changes
3. Commit with clear messages
4. Push the code

## Troubleshooting
- If you encounter database connection issues, verify your credentials in `config.php`
- For permission issues, ensure proper file permissions (usually 755 for directories, 644 for files)
- Check PHP error logs if the site isn't loading properly

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


