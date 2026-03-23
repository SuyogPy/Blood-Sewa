-- =============================================
-- blood_sewa Database Schema
-- =============================================
-- This SQL script creates the database and the
-- users table for the Blood Sewa project.
--
-- HOW TO USE:
-- 1. Open phpMyAdmin (http://localhost/phpmyadmin)
-- 2. Click on "SQL" tab
-- 3. Paste this code and click "Go"
--
-- OR run the setup script:
-- http://localhost/Blood-Sewa/api/setup_db.php
-- =============================================

-- Step 1: Create the database
CREATE DATABASE IF NOT EXISTS blood_sewa;

-- Step 2: Select the database
USE blood_sewa;

-- Step 3: Create the users table
-- This table stores all donor information
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,        -- Unique ID for each user (auto-generated)
    name VARCHAR(150) NOT NULL,               -- Full name of the donor
    email VARCHAR(200) NOT NULL UNIQUE,       -- Email address (must be unique)
    password VARCHAR(255) NOT NULL,           -- Password (stored as plain text for simplicity)
    phone VARCHAR(50),                         -- Phone number (optional)
    city VARCHAR(100),                         -- City/Location (optional)
    blood_group VARCHAR(10),                   -- Blood group like A+, B-, O+ (optional)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  -- Date and time of registration
);
