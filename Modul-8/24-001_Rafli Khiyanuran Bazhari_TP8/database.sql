CREATE DATABASE IF NOT EXISTS sistem_penjualan;
USE sistem_penjualan;

CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    level INT NOT NULL DEFAULT 2,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO user (username, password, nama, level) VALUES 
('admin', MD5('admin123'), 'Admin', 1),
('wati', MD5('wati123'), 'Wati', 1);

INSERT INTO user (username, password, nama, level) VALUES 
('user1', MD5('user123'), 'User Satu', 2),
('user2', MD5('user123'), 'User Dua', 2);

