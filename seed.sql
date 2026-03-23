-- =============================================
-- Sample Data for Testing
-- =============================================
-- This script inserts sample donor records
-- into the users table for testing purposes.
-- Passwords are stored as plain text.
--
-- Run this AFTER creating the database and table.
-- =============================================

USE blood_sewa;

-- Insert sample donors
INSERT INTO users (name, email, password, phone, city, blood_group) VALUES
('Demo Donor', 'demo@bloodsewa.test', 'password', '+977-000000000', 'Lainchour', 'A+'),
('Alice Singh', 'alice@example.com', 'password123', '9876543210', 'Mumbai', 'A+'),
('Ravi Kumar', 'ravi@example.com', 'password123', '9123456780', 'Delhi', 'B+'),
('Sita Sharma', 'sita@example.com', 'sita123', '9845123456', 'Kathmandu', 'O+'),
('Ram Thapa', 'ram@example.com', 'ram123', '9801234567', 'Pokhara', 'AB-');

-- Note: You can login with any of the above emails
-- using the password shown next to them.
-- Example: email = demo@bloodsewa.test, password = password
