-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 15, 2021 at 09:32 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jelajahin_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `acara`
--

CREATE TABLE `acara` (
  `uuid_acara` varchar(36) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `long` varchar(200) NOT NULL,
  `lat` varchar(200) NOT NULL,
  `mulai_event` date NOT NULL,
  `berakhir_event` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `uuid_admin` varchar(36) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`uuid_admin`, `name`, `email`, `username`, `phone`, `gender`, `jabatan`, `password`) VALUES
('26', 'Savina Zahro', 'savinazahro23@gmail.com', 'savinasz', '085730762925', 'perempuan', 'Developer', '$2y$10$cI1IFkkjiLHqbLGHIyrsb.JTnX0ioV5/Py0sKDx7Pn2P73NyoIdLy'),
('d57718aa-74c7-4430-88c9-e41fe35a060b', 'Ibnu Batutah', 'ibnubatutah001@gmail.com', 'ibnu009', '081252889833', 'laki-laki', 'Manager Team', '$2y$10$bfkC42hKqMLn0fuqLkvyvuQDWIZIuadwNM2ErjZ4Mi8HkKChbjUCW');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `uuid_event` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` text NOT NULL,
  `province_id` int(4) NOT NULL,
  `province_name` varchar(255) NOT NULL,
  `city_id` int(4) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `schedule` datetime NOT NULL,
  `ticket_price` varchar(255) NOT NULL,
  `point_reward` int(4) NOT NULL,
  `xp_reward` int(5) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `longtitude` float(10,6) NOT NULL,
  `is_free` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`uuid_event`, `name`, `description`, `image_url`, `province_id`, `province_name`, `city_id`, `city_name`, `schedule`, `ticket_price`, `point_reward`, `xp_reward`, `latitude`, `longtitude`, `is_free`) VALUES
('0a9bcf3a-9315-48e8-abe1-6b3399dc5bd6', 'Konser K-POP', 'KONSER AMAL bertajuk Gendong Gandeng Dari Kita Untuk Indonesia digelar menghadirkan sederet musisi beken asal Yogya. Antara lain Shaggydog, Ndarboy Genk, Langit Sore, The Produk Gagal, Kukuh Prasetya Kudamai, Korekayu, Dagelan Mataram, Slametman, Hasoe Angels dan Annisa Hertami. Konser ini didedikasikan untuk mendorong percepatan dan pengembangan pendidikan untuk para penyandang disabilitas ganda yang tersebar dalam jaringan Rawinala Foundation.', 'https://cdn.krjogja.com/wp-content/uploads/2021/10/konser-amal.jpg', 1, 'Jawa Barat', 1, 'Jakarta Pusat', '2021-10-28 06:01:32', 'Rp 20.000 (per orang)', 500, 1500, -7.913460, 113.821449, 0),
('5f489a0e-a73c-4c77-9945-00ac42c591e5', 'Konser tes di kota Bondowoso', 'Ahab awrqxkjasfaaw', 'https://www.namastra.co.id/img?src=9fa8a5b94738aa2ba3d214d77c0aff1e.jpg&width=1200&height=860', 1000, 'Jawa Timur', 1000, 'Bondowoso', '2021-10-20 07:12:04', 'Gratis', 500, 1500, -7.913460, 113.821449, 1),
('73a3a2cc-5864-4f78-add5-85a94a16ffda', 'Konser Amal Ashiapp atta badaiii', 'Festival konser musik hingga pameran dagang sudah boleh digelar, ini syaratnya. Selasa, 05 Oktober 2021 | 11:08 WIB Reporter: Barratut Taqiyyah Rafie.', 'https://cdn1.katadata.co.id/media/images/thumb/2021/10/25/Angin_Segar_Bagi_Industri_Musik_di_Masa_Pandemi-2021_10_25-11_28_49_a3d07b695cc0ef673d7de76516047a14_620x413_thumb.jpg', 1, 'Jawa Barat', 1, 'Jakarta Pusat', '2021-10-19 06:27:48', 'Rp 150.000 (per orang)', 750, 2000, -7.913460, 113.821449, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_hotel`
--

CREATE TABLE `fasilitas_hotel` (
  `id_fasilitas_hotel` int(3) NOT NULL,
  `nama` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_ruangan`
--

CREATE TABLE `fasilitas_ruangan` (
  `id_fasilitas_ruangan` int(3) NOT NULL,
  `nama` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `uuid_menu` varchar(36) NOT NULL,
  `uuid_restaurant` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `food_category` varchar(100) NOT NULL,
  `image_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penginapan`
--

CREATE TABLE `penginapan` (
  `uuid_penginapan` varchar(36) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price_min` varchar(15) NOT NULL,
  `price_max` varchar(15) NOT NULL,
  `image` varchar(100) NOT NULL,
  `hotel_facility` varchar(100) NOT NULL,
  `language` varchar(100) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `website` varchar(50) NOT NULL,
  `provinsi_id` varchar(25) NOT NULL,
  `kabupaten_id` varchar(25) NOT NULL,
  `kecamatan_id` varchar(25) NOT NULL,
  `kelurahan_id` varchar(25) NOT NULL,
  `rating_avg` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `longitude` varchar(200) NOT NULL,
  `latitude` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `uuid_restaurant` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` text NOT NULL,
  `price_min` varchar(255) NOT NULL,
  `price_max` varchar(100) NOT NULL,
  `food_type` varchar(255) NOT NULL,
  `restaurant_type` varchar(255) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `website` varchar(100) NOT NULL,
  `business_time_open` varchar(255) NOT NULL,
  `business_time_closes` varchar(225) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `provinsi_id` varchar(225) NOT NULL,
  `kabupaten_id` varchar(225) NOT NULL,
  `kecamatan_id` varchar(225) NOT NULL,
  `kelurahan_id` varchar(225) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `longtitude` float(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`uuid_restaurant`, `name`, `description`, `address`, `price_min`, `price_max`, `food_type`, `restaurant_type`, `phone`, `website`, `business_time_open`, `business_time_closes`, `image`, `provinsi_id`, `kabupaten_id`, `kecamatan_id`, `kelurahan_id`, `latitude`, `longtitude`) VALUES
('4aa46c0b-9b16-4e49-9c70-3b22f6256419', 'rocco dessert', 'hhjjk', 'hjhjkjhk', '20000', '200000', 'Chinnes Food', 'Cafe', '085730762925', 'wwwww', '15:24', '21:30', '', '31', '3172', '3172080', '3172080003', -7.913402, 113.822800),
('acfcbd58-db7d-4748-acea-c70ff0161382', 'Maris Heath', 'Asperiores est sit', 'Tempor tempora dolor', '75', '19', 'Chinnes Food', 'Prasmanan', '082335623028', 'https://www.mopoqatida.net', '05:51', '12:44', 'lop.jpg', '13', '1302', '1302012', '1302012002', -7.913588, 113.822548),
('e5494e7e-33a5-4c4a-bde6-41c493d8f7d5', 'MCD', 'mekdi', 'kjkhjh', '20000', '60000', 'Western Food', 'Fast Food', '085730762925', 'wwwmekdi.com', '14:56', '17:56', '', '18', '1810', '1810031', '1810031018', -7.913402, 113.822800);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uuid_user` varchar(36) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uuid_user`, `full_name`, `email`, `password`) VALUES
('25437682-ca2e-4334-8917-bc5848feb056', 'Ibnu Batutah', 'ibnubatutah002@gmail.com', '$2a$10$.jYNE/Blucs.EK5S8joNseNIrNmqIV6NNzYQqX/alLbXR/elDsloC'),
('616a2d5e-ba7b-4f21-b296-1f7ee0b41325', 'Ibnu Batutah', 'ibnubatutah001@gmail.com', '$2a$10$gHCPXbWITUDhgbDB8bC1F.K9YCJabefF05OL7K0B.t.Vj5L/t2jwa'),
('a1c0b761-f755-4078-9d3c-eab59a3a4b26', 'Ibnu Batutah', 'ibnubatutah100@gmail.com', '$2a$10$TClF0Fsck/VS32noLjPLWebM6imkzgfcuy3HmkCNJ8WoWAVN6am86');

-- --------------------------------------------------------

--
-- Table structure for table `wisata`
--

CREATE TABLE `wisata` (
  `uuid_wisata` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ticket_price` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `provinsi_id` varchar(30) NOT NULL,
  `kabupaten_id` varchar(30) NOT NULL,
  `kecamatan_id` varchar(30) NOT NULL,
  `kelurahan_id` varchar(30) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wisata`
--

INSERT INTO `wisata` (`uuid_wisata`, `name`, `description`, `ticket_price`, `address`, `image_url`, `provinsi_id`, `kabupaten_id`, `kecamatan_id`, `kelurahan_id`, `latitude`, `longitude`) VALUES
('c405a0aa-9cf9-4dfa-8a8c-fc88c0225283', 'kawah ijen', 'ini kawah ijen', '-', 'disituu', '', '35', '3511', '3511151', '3511151006', -8.058573, 114.241951);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acara`
--
ALTER TABLE `acara`
  ADD PRIMARY KEY (`uuid_acara`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`uuid_event`);

--
-- Indexes for table `fasilitas_hotel`
--
ALTER TABLE `fasilitas_hotel`
  ADD PRIMARY KEY (`id_fasilitas_hotel`);

--
-- Indexes for table `fasilitas_ruangan`
--
ALTER TABLE `fasilitas_ruangan`
  ADD PRIMARY KEY (`id_fasilitas_ruangan`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`uuid_menu`),
  ADD KEY `memiliki` (`uuid_restaurant`);

--
-- Indexes for table `penginapan`
--
ALTER TABLE `penginapan`
  ADD PRIMARY KEY (`uuid_penginapan`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`uuid_restaurant`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uuid_user`);

--
-- Indexes for table `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`uuid_wisata`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fasilitas_hotel`
--
ALTER TABLE `fasilitas_hotel`
  MODIFY `id_fasilitas_hotel` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fasilitas_ruangan`
--
ALTER TABLE `fasilitas_ruangan`
  MODIFY `id_fasilitas_ruangan` int(3) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `memiliki` FOREIGN KEY (`uuid_restaurant`) REFERENCES `restaurant` (`uuid_restaurant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
