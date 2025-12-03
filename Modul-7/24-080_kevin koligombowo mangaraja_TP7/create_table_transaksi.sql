CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tanggal DATE NOT NULL,
    pelanggan_id INT NOT NULL,
    total INT NOT NULL
);

INSERT INTO transaksi (tanggal, pelanggan_id, total) VALUES
('2025-01-01', 1, 50000),
('2025-01-01', 2, 75000),
('2025-01-02', 1, 65000),
('2025-01-03', 3, 90000);
