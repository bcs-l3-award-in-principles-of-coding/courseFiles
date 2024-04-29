-- Create a new user
CREATE USER 'contact_user'@'localhost' IDENTIFIED BY 'password123';

-- Create a new database
CREATE DATABASE contact_database;

-- Grant privileges to the user for the new database
GRANT ALL PRIVILEGES ON contact_database.* TO 'contact_user'@'localhost';

-- Switch to the new database
USE contact_database;

-- Create a table for storing contacts
CREATE TABLE contacts (
    contact_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100),
    phone_number VARCHAR(20)
);

-- Create a table for storing categories
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50)
);

-- Create a linking table to establish a many-to-many relationship between contacts and categories
CREATE TABLE contact_category (
    contact_id INT,
    category_id INT,
    FOREIGN KEY (contact_id) REFERENCES contacts(contact_id),
    FOREIGN KEY (category_id) REFERENCES categories(category_id),
    PRIMARY KEY (contact_id, category_id)
);
