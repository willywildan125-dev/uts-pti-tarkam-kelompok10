-- ============================================================
-- Database Tarkam Bola (Knockout 12 Tim)
-- Sesuai skema relasi di ERD_SKEMA_BOLA.docx
-- Cara pakai: phpMyAdmin > Import > pilih file ini > Kirim/Go
-- Satu-satunya akun awal: operator@gmail.com (password: "operator123")
-- Akun manajemen tim dibuat oleh operator.
-- ============================================================

CREATE DATABASE IF NOT EXISTS `tarkam_bola` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `tarkam_bola`;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `bertanding`;
DROP TABLE IF EXISTS `staff`;
DROP TABLE IF EXISTS `pemain`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `game`;
DROP TABLE IF EXISTS `tim`;
SET FOREIGN_KEY_CHECKS = 1;

-- ---------- TABEL TIM ----------
CREATE TABLE `tim` (
  `id_tim`   INT(8)      NOT NULL AUTO_INCREMENT,
  `Nama_tim` VARCHAR(30) NOT NULL,
  `asal`     VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id_tim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------- TABEL USER ----------
CREATE TABLE `user` (
  `Id_user`   INT(8)       NOT NULL AUTO_INCREMENT,
  `Nama_user` VARCHAR(30)  NOT NULL,
  `password`  VARCHAR(255) NOT NULL,
  `email`     VARCHAR(30)  NOT NULL,
  `role`      ENUM('operator','manager') NOT NULL,
  `Id_tim`    INT(8)       NULL DEFAULT NULL,
  PRIMARY KEY (`Id_user`),
  UNIQUE KEY `user_email_unique` (`email`),
  KEY `user_id_tim_foreign` (`Id_tim`),
  CONSTRAINT `user_id_tim_foreign` FOREIGN KEY (`Id_tim`) REFERENCES `tim` (`id_tim`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------- TABEL PEMAIN ----------
CREATE TABLE `pemain` (
  `Id_pemain`   INT(8)       NOT NULL AUTO_INCREMENT,
  `Nama_pemain` VARCHAR(30)  NOT NULL,
  `Posisi`      VARCHAR(30)  NOT NULL,
  `No_punggung` INT(3)       NOT NULL,
  `Status`      ENUM('aktif','cedera','sakit') NOT NULL,
  `Sanksi`      ENUM('kartu_kuning','kartu_merah') NULL DEFAULT NULL,
  `Id_tim`      INT(8)       NULL DEFAULT NULL,
  PRIMARY KEY (`Id_pemain`),
  UNIQUE KEY `pemain_nama_pemain_unique` (`Nama_pemain`),
  KEY `pemain_id_tim_foreign` (`Id_tim`),
  CONSTRAINT `pemain_id_tim_foreign` FOREIGN KEY (`Id_tim`) REFERENCES `tim` (`id_tim`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------- TABEL GAME ----------
CREATE TABLE `game` (
  `Id_game`  INT(8)      NOT NULL AUTO_INCREMENT,
  `Ronde`    INT(2)      NOT NULL,
  `Jadwal`   DATETIME    NOT NULL,
  `lapangan` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`Id_game`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------- TABEL STAFF ----------
CREATE TABLE `staff` (
  `Id_staff`   INT(8)      NOT NULL AUTO_INCREMENT,
  `Nama_staff` VARCHAR(30) NOT NULL,
  `Jabatan`    VARCHAR(30) NOT NULL,
  `Id_tim`     INT(8)      NULL DEFAULT NULL,
  PRIMARY KEY (`Id_staff`),
  KEY `staff_id_tim_foreign` (`Id_tim`),
  CONSTRAINT `staff_id_tim_foreign` FOREIGN KEY (`Id_tim`) REFERENCES `tim` (`id_tim`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------- TABEL BERTANDING ----------
CREATE TABLE `bertanding` (
  `Id_game` INT(8) NOT NULL,
  `Id_tim`  INT(8) NOT NULL,
  `Skor`    INT(3) NULL DEFAULT NULL,
  `Penalti` INT(3) NULL DEFAULT NULL,
  PRIMARY KEY (`Id_game`,`Id_tim`),
  KEY `bertanding_id_tim_foreign` (`Id_tim`),
  CONSTRAINT `bertanding_id_game_foreign` FOREIGN KEY (`Id_game`) REFERENCES `game` (`Id_game`) ON DELETE CASCADE,
  CONSTRAINT `bertanding_id_tim_foreign` FOREIGN KEY (`Id_tim`) REFERENCES `tim` (`id_tim`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------- AKUN AWAL (operator) ----------
INSERT INTO `user` (`Id_user`, `Nama_user`, `password`, `email`, `role`, `Id_tim`) VALUES
(1, 'Operator', '$2y$10$2h6VqvO.t7r6EarIfcm6rOgc0DUV5h6kSMmRNmtMllusvVFpCPKAW', 'operator@gmail.com', 'operator', NULL);
