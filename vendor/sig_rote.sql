-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Nov 2022 pada 08.07
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sig_rote`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `id_kategori_fasilitas` int(11) NOT NULL,
  `nama_fasilitas` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `id_kategori_fasilitas`, `nama_fasilitas`, `keterangan`, `created_at`, `updated_at`) VALUES
(6, 4, 'Penghijauan', '-', '2022-11-13 04:56:59', '2022-11-13 04:56:59'),
(7, 2, 'Lesehan', '-', '2022-11-13 05:29:36', '2022-11-13 05:29:36'),
(8, 3, 'Pelabuhan', '-', '2022-11-13 05:29:48', '2022-11-13 05:29:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `id_wisata` int(11) NOT NULL,
  `image_gwisata` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `id_wisata`, `image_gwisata`) VALUES
(7, 4, '2315476281.png'),
(8, 4, '3076748425.png'),
(9, 4, '88320153.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_fasilitas`
--

CREATE TABLE `kategori_fasilitas` (
  `id_kategori_fasilitas` int(11) NOT NULL,
  `nama_kfasilitas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_fasilitas`
--

INSERT INTO `kategori_fasilitas` (`id_kategori_fasilitas`, `nama_kfasilitas`) VALUES
(2, 'Pondok'),
(3, 'Rest Area'),
(4, 'Taman'),
(5, 'Ski Jet');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_wisata`
--

CREATE TABLE `kategori_wisata` (
  `id_kategori_wisata` int(11) NOT NULL,
  `nama_kwisata` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_wisata`
--

INSERT INTO `kategori_wisata` (`id_kategori_wisata`, `nama_kwisata`) VALUES
(45, 'Pantai'),
(46, 'Observation Deck'),
(47, 'Forest');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$3WPppnRHHil1VtG6wsMZO.Bp3HbPejVGUHqoVkryFmwbL3La354hC', '2022-09-09 18:25:05', '2022-09-09 18:25:05'),
(7, 'ar.code_', 'arlan270899@gmail.com', '$2y$10$QXGXTYC.ZVex47HcwLHI0Ou.7SWu8cy5OEl/C/wdeP4zRUMj97oEy', '2022-11-12 14:44:23', '2022-11-12 14:44:23'),
(8, 'aty', 'putriraki240800@gmail.com', '$2y$10$BgrVpQBVTLFov3hYUOLlDuFufKYBKcr95Xd86o3sPaI7t67cbz8va', '2022-11-12 14:44:35', '2022-11-12 14:44:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wisata`
--

CREATE TABLE `wisata` (
  `id_wisata` int(11) NOT NULL,
  `id_kategori_wisata` int(11) NOT NULL,
  `id_fasilitas` int(11) NOT NULL,
  `image` char(50) NOT NULL,
  `nama_wisata` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `longitude` char(50) NOT NULL,
  `latitude` char(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `wisata`
--

INSERT INTO `wisata` (`id_wisata`, `id_kategori_wisata`, `id_fasilitas`, `image`, `nama_wisata`, `deskripsi`, `alamat`, `longitude`, `latitude`, `created_at`, `updated_at`) VALUES
(4, 45, 8, '941850921.png', 'Dermaga Baa', 'Pelabuhan kecil di Kota Baa, Ibukota Rote Ndao Melayani pelayaran menuju Kupang dengan kapal cepat, Kapal Pelni  menuju Kalabahi, Sabu, Sumba, Ende, Bima, Surabaya. Laut di pelabuhan ini sangat jernih, masyarakat sering memancing di tempat ini. Terdapat mercusuar Kota Baa yang menambah keindahan pelabuhan ini.', '72GV+PFP, Namodale, Kec. Lobalain, Kabupaten Rote Ndao, Nusa Tenggara Tim.', '123.04490089416505', '-10.72540236827347', '2022-11-13 06:23:08', '2022-11-13 09:52:54');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`),
  ADD KEY `id_kategori_fasilitas` (`id_kategori_fasilitas`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`),
  ADD KEY `id_wisata` (`id_wisata`);

--
-- Indeks untuk tabel `kategori_fasilitas`
--
ALTER TABLE `kategori_fasilitas`
  ADD PRIMARY KEY (`id_kategori_fasilitas`);

--
-- Indeks untuk tabel `kategori_wisata`
--
ALTER TABLE `kategori_wisata`
  ADD PRIMARY KEY (`id_kategori_wisata`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id_wisata`),
  ADD KEY `id_fasilitas` (`id_fasilitas`),
  ADD KEY `id_kategori_wisata` (`id_kategori_wisata`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kategori_fasilitas`
--
ALTER TABLE `kategori_fasilitas`
  MODIFY `id_kategori_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori_wisata`
--
ALTER TABLE `kategori_wisata`
  MODIFY `id_kategori_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD CONSTRAINT `fasilitas_ibfk_1` FOREIGN KEY (`id_kategori_fasilitas`) REFERENCES `kategori_fasilitas` (`id_kategori_fasilitas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD CONSTRAINT `galeri_ibfk_1` FOREIGN KEY (`id_wisata`) REFERENCES `wisata` (`id_wisata`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `wisata`
--
ALTER TABLE `wisata`
  ADD CONSTRAINT `wisata_ibfk_1` FOREIGN KEY (`id_fasilitas`) REFERENCES `fasilitas` (`id_fasilitas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `wisata_ibfk_2` FOREIGN KEY (`id_kategori_wisata`) REFERENCES `kategori_wisata` (`id_kategori_wisata`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
