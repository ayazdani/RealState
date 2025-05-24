# Development Guidelines

## Coding Standards

### PHP Guidelines
1. **Database Operations**
   - Use prepared statements for queries
   - Always validate user input
   - Handle database errors appropriately
   ```php
   // Example of proper database query
   $stmt = $conn->prepare("SELECT * FROM properties WHERE id = ?");
   $stmt->bind_param("i", $id);
   ```

2. **Function Structure**
   - Use meaningful function names
   - Document parameters and return types
   - Keep functions focused and single-purpose

### CSS Organization
1. **File Purpose**
   - `main.css`: Global styles, typography, utilities
   - `home.css`: Homepage-specific styles
   - `variables.css`: Color schemes, breakpoints, spacing
   - `responsive.css`: Mobile-first media queries

2. **Naming Conventions**
   - Use BEM methodology
   - Prefix utility classes with `u-`
   - Component-specific classes with component name

### JavaScript Best Practices
1. **Code Organization**
   - Use ES6+ features
   - Modular code structure
   - Comment complex logic

## Simple Git Workflow

### Basic Process
1. **Get Latest Code**
   ```bash
   git checkout master
   git pull origin master
   ```

2. **Create Your Feature Branch**
   ```bash
   git checkout -b feature-name
   # Example: git checkout -b add-search-filter
   ```

3. **Work on Your Feature**
   - Make your changes
   - Test your feature locally
   - Commit your changes:
   ```bash
   git add .
   git commit -m "Added [feature-name]"
   ```

4. **Merge to Master**
   ```bash
   git checkout master
   git pull origin master        # Get any updates
   git merge feature-name        # Merge your feature
   git push origin master        # Push to repository
   ```

### Good Practices
- Pull the latest master before starting new work
- Use clear branch names that describe your feature
- Test your changes before merging to master
- Let team members know when you've pushed major changes

### Branch Naming Examples
- `search-feature`
- `fix-mobile-menu`
- `add-property-page`

## Testing
1. **Before Committing**
   - Test on multiple browsers
   - Verify mobile responsiveness
   - Validate database operations

## SEO Guidelines
1. **Meta Tags**
   - Unique title per page
   - Descriptive meta descriptions
   - Proper heading hierarchy

2. **Content Guidelines**
   - Optimize image alt texts
   - Use semantic HTML
   - Maintain proper URL structure

## Troubleshooting Guide

### Common Issues
1. **Database Connection**
   - Verify credentials in config.php
   - Check MySQL service status
   - Confirm database exists

2. **Display Issues**
   - Clear browser cache
   - Check CSS specificity
   - Verify media query breakpoints


## Implementation Sections

### 1. Homepage & SEO (✅ Completed)
Currently implemented:
- Responsive header with navigation
- Hero section with property search
- Featured properties display
- Category cards display
- SEO meta tags, sitemap, robots.txt
- Mobile-responsive design

### 2. Property Listings (To Implement)
Build upon existing database structure:
- Create properties.php for:
  - Property grid/list views
  - Search results display
  - Filter implementation
  - Pagination
- Integrate with homepage search
- Maintain mobile responsiveness

### 3. New Homes Section (To Implement)
Extend properties system with:
- Dedicated new homes page
- Special filters:
  - Development stages
  - Builder information
  - Completion dates
- Integration with main search

### 4. Categories & Filtering (To Implement)
Extend current category system:
- Category detail pages
- Property listing by category
- Filter system:
  - Price ranges
  - Locations
  - Property types
  - Bedrooms/bathrooms

## Database Structure

### Current Tables
```sql
-- Properties Table
CREATE TABLE properties (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    price DECIMAL(10,2),
    location VARCHAR(255),
    bedrooms INT,
    bathrooms INT,
    area DECIMAL(10,2),
    image_url VARCHAR(255),
    featured BOOLEAN DEFAULT FALSE
);

-- Categories Table
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    image_url VARCHAR(255),
    slug VARCHAR(100)
);
```

## Style Guidelines

### CSS Organization
```css
/* Use these variables (from variables.css) */
:root {
    --primary-color: #2c5282;    /* Main blue */
    --secondary-color: #4a5568;  /* Dark gray */
    --accent-color: #E4002B;     /* Action red */
    --spacing-sm: 0.5rem;
    --spacing-md: 1rem;
    --spacing-lg: 2rem;
}

/* Follow responsive breakpoints */
@media (max-width: 768px) { /* Mobile styles */ }
@media (max-width: 1200px) { /* Tablet styles */ }
```

### Component Patterns
```html
<!-- Property Card Structure -->
<div class="property-card">
    <div class="property-image">
        <img src="..." alt="...">
    </div>
    <div class="property-content">
        <h3>Property Title</h3>
        <p class="price">$000,000</p>
        <div class="features">
            <!-- Property features -->
        </div>
    </div>
</div>
```

## Development Standards


### 1. Database Operations
```php
// Example function pattern
function get_properties_by_category($category_id) {
    global $conn;
    $sql = "SELECT * FROM properties WHERE category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$category_id]);
    return $stmt->fetchAll();
}
```

### 2. SEO Considerations
- Use semantic HTML
- Include meta descriptions
- Optimize images
- Maintain mobile responsiveness

## Integration Points

### 1. Search System
- Homepage search → Properties listing
- Advanced filters → Search results
- Categories → Filtered results

### 2. Category System
- Homepage categories → Category pages
- Category pages → Property listings
- Property listings → Property details

### 3. New Homes Integration
- Main navigation → New homes section
- Search filters → New homes results
- Featured properties → New developments

## Getting Started
1. Review existing code in index.php
2. Check functions.php for available functions
3. Follow database structure
4. Maintain mobile-first approach
5. Test features across devices

## Setup
1. Create database `real_estate` in phpMyAdmin
2. Import `real_estate.sql`
3. Update database credentials in `includes/config.php`
4. Run using XAMPP/PHP server

## Current Features
- Homepage with search functionality
- Featured properties section
- Category browsing
- Mobile responsive design
- SEO optimization

