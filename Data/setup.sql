-- Drop tables if they exist
DROP TABLE IF EXISTS journal_entries;
DROP TABLE IF EXISTS users;

-- Create users table
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    profile_picture VARCHAR(255) -- URL or file path
);

-- Create journal_entries table
CREATE TABLE journal_entries (
    entry_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Insert sample data

-- Sample users
INSERT INTO users (email, password, name, profile_picture) VALUES
('collin.kite@example.com', 'password', 'Collin Kite', 'path/to/collin_picture.jpg'),
('lisset.sadian@example.com', 'password', 'Lisset Sadian', 'path/to/lisset_picture.jpg'),
('connor.hoffman@example.com', 'password', 'Connor Hoffman', 'path/to/connor_picture.jpg');

-- Sample journal entries
INSERT INTO journal_entries (user_id, title, content) VALUES
(1, 'Day 1 at the beach', 'It was a sunny day and I enjoyed the waves...'),
(2, 'Hiking adventure', 'Today, I went hiking up the mountain...'),
(3, 'Cooking experiments', 'I tried a new recipe today and it was...');
