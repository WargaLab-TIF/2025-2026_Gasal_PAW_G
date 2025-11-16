CREATE DATABASE IF NOT EXISTS `chart` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `chart`;

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `waktu_transaksi` DATE NOT NULL,
  `nama_pelanggan` VARCHAR(100) NOT NULL,
  `keterangan` VARCHAR(255) DEFAULT NULL,
  `total` DECIMAL(15,2) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `transaksi` (`waktu_transaksi`, `nama_pelanggan`, `keterangan`, `total`) VALUES
('2023-11-08', 'Irfan', 'Self pickup', 16000000.00),
('2023-11-08', 'Rina', 'Delivery Order', 15000000.00),
('2023-11-08', 'Budi', 'Delivery Order', 3000000.00),
('2023-11-09', 'Siti', 'Self pickup', 24000000.00),
('2023-11-09', 'Eko', 'Self pickup', 21000000.00),
('2023-11-09', 'Dewi', 'Delivery Order', 20000000.00),
('2023-11-10', 'Hari', 'Self pickup', 600000.00),
('2023-11-10', 'Nina', 'Self pickup', 1200000.00),
('2023-11-11', 'Ahmad', 'Delivery Order', 5000000.00),
('2023-11-11', 'Sari', 'Self pickup', 18600000.00),
('2023-11-12', 'Bambang', 'Self pickup', 15000000.00),
('2023-11-12', 'Lina', 'Delivery Order', 7500000.00),
('2023-11-13', 'Dedi', 'Self pickup', 25000000.00),
('2023-11-13', 'Maya', 'Delivery Order', 16000000.00),
('2023-11-14', 'Rudi', 'Self pickup', 25000000.00);

