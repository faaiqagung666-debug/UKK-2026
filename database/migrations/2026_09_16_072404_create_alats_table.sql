-- create_alats_table

CREATE TABLE IF NOT EXISTS `alat` (
    id_alat        INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_alat      VARCHAR(255) NOT NULL,
    kode_alat       VARCHAR(255) NOT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL

    id_kategori INT UNSIGNED,
    CONSTRAINT fk_alat_kategori
    FOREIGN KEY (id_kategori)
    REFERENCES kategori(id_kategori)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
