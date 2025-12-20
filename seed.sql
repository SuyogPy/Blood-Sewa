-- Sample seed data for testing
INSERT INTO users (name, email, password, phone, city, blood_group)
VALUES
('Alice Singh', 'alice@example.com', '$2y$10$abcdefghijklmnopqrstuv', '9876543210', 'Mumbai', 'A+'),
('Ravi Kumar', 'ravi@example.com', '$2y$10$abcdefghijklmnopqrstuv', '9123456780', 'Delhi', 'B+');

-- Note: passwords above are placeholders; register via UI to create working hashed passwords.
