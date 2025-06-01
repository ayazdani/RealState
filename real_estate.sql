-- Create and use the database
CREATE DATABASE IF NOT EXISTS real_estate;
USE real_estate;

-- Disable foreign key checks while dropping/creating tables
SET foreign_key_checks = 0;

-- Drop existing tables if they exist
DROP TABLE IF EXISTS `properties`;
DROP TABLE IF EXISTS `categories`;

-- Create the categories table
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert category data (including new Rural category)
INSERT INTO `categories` (`id`, `name`, `slug`, `image_url`, `description`, `parent_id`, `created_at`) VALUES
(1, 'House & Land', 'house-and-land', 'assets/images/categories/house-land.jpg', 'New house and land packages in growing Australian suburbs', NULL, '2025-05-23 02:31:26'),
(2, 'Apartments & Units', 'apartments-units', 'assets/images/categories/apartments.jpg', 'Modern apartments and units in prime urban locations', NULL, '2025-05-23 02:31:26'),
(3, 'Townhouses', 'townhouses', 'assets/images/categories/townhouses.jpg', 'Low-maintenance living with contemporary townhouse designs', NULL, '2025-05-23 02:31:26'),
(4, 'Rural', 'rural', 'assets/images/categories/rural.jpg', 'Spacious rural properties for a quiet countryside lifestyle.', NULL, '2025-06-01 12:00:00');

-- Create the properties table
CREATE TABLE `properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `property_type` varchar(50) DEFAULT NULL,
  `bedrooms` int(11) DEFAULT NULL,
  `bathrooms` int(11) DEFAULT NULL,
  `area` decimal(10,2) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT 0,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'available',
  `is_new` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample properties with assigned category_id
INSERT INTO `properties` (`id`, `title`, `description`, `price`, `location`, `property_type`, `bedrooms`, `bathrooms`, `area`, `featured`, `image_url`, `created_at`, `category_id`, `status`, `is_new`) VALUES
(1, 'Modern City Apartment', 'Beautiful modern apartment in the heart of the city.The apartment consists of a large bright bedroom with a comfy king-sized bed, a modern fully-equipped kitchen and a sunlit living room with Apple TV and free Netflix account. It is the perfect place to stay for couples looking for a romantic location in the historic centre, within walking distance of some of the most beautiful sceneries you can find in the city and all famous landmarks. The sofa in the living room can also serve as an additional bed for a 3rd guest. Located in a side street between the ___ river bank and the leafy ___ hill park, the apartment is very quiet at night. Please note, my apartment is on the 3rd floor with no elevator. I am more than happy to help you with your luggage! . Full Kitchens. Pets Allowed. Wifi. Find Your Home Away From Home. ', 250000.00, 'Downtown', 'apartment', 2, 1, 85.50, 1, 'assets/images/apartment1.jpg', '2025-05-21 12:23:41', 2, 'available', 0),
(2, 'Luxury Villa', 'Spacious luxury villa with garden', 750000.00, 'Suburbs', 'villa', 4, 3, 250.00, 1, 'assets/images/villa1.jpg', '2025-05-21 12:23:41', 1, 'available', 0),
(3, 'Family House', 'Perfect family house in quiet neighborhood', 450000.00, 'Residential Area', 'house', 3, 2, 150.00, 1, 'assets/images/house1.jpg', '2025-05-21 12:23:41', 1, 'available', 0),
(4, 'Country Farmhouse', 'Charming farmhouse with acres of land and stunning views', 600000.00, 'Outskirts', 'rural', 5, 2, 300.00, 1, 'assets/images/rural1.jpg', '2025-06-01 12:30:00', 4, 'available', 1);

-- Add foreign key constraints
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`);

ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

-- Re-enable foreign key checks
SET foreign_key_checks = 1;
