CREATE TABLE `pengguna` (
  `id_pengguna` bigint PRIMARY KEY,
  `username` varchar(15) UNIQUE NOT NULL,
  `password` varchar(128) NOT NULL COMMENT 'Hashed Password',
  `email` varchar(255) UNIQUE NOT NULL,
  `nama_depan` varchar(100) NOT NULL,
  `nama_belakang` varchar(100) NOT NULL,
  `role` ENUM ('Admin', 'Public')
);

CREATE TABLE `anggota` (
  `id_anggota` bigint PRIMARY KEY,
  `nama_depan` varchar(100) NOT NULL,
  `nama_belakang` varchar(100) NOT NULL,
  `gelar_depan` varchar(50),
  `gelar_belakang` varchar(50),
  `jabatan` ENUM ('Ketua', 'Wakil Ketua', 'Anggota'),
  `status_pernikahan` ENUM ('Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati')
);


CREATE TABLE `penggajian` (
  `id_komponen_gaji` bigint,
  `id_anggota` bigint,
  PRIMARY KEY (`id_komponen_gaji`, `id_anggota`)
);

ALTER TABLE `penggajian` ADD FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);

ALTER TABLE `penggajian` ADD FOREIGN KEY (`id_komponen_gaji`) REFERENCES `komponen_gaji` (`id_komponen_gaji`);
