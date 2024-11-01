-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 01, 2024 lúc 09:04 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quan_ly_thiet_bi`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhap_xuat`
--

CREATE TABLE `nhap_xuat` (
  `id` int(11) NOT NULL,
  `thiet_bi_id` int(11) DEFAULT NULL,
  `ngay` date DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `loai_giao_dich` enum('nhap','xuat') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thiet_bi`
--

CREATE TABLE `thiet_bi` (
  `id` int(11) NOT NULL,
  `ten_thiet_bi` varchar(255) NOT NULL,
  `loai_thiet_bi` enum('day hoc','van phong') NOT NULL,
  `so_luong` int(11) NOT NULL,
  `tinh_trang` enum('moi','da su dung','can sua chua') NOT NULL,
  `ghi_chu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `nhap_xuat`
--
ALTER TABLE `nhap_xuat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thiet_bi_id` (`thiet_bi_id`);

--
-- Chỉ mục cho bảng `thiet_bi`
--
ALTER TABLE `thiet_bi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `nhap_xuat`
--
ALTER TABLE `nhap_xuat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thiet_bi`
--
ALTER TABLE `thiet_bi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `nhap_xuat`
--
ALTER TABLE `nhap_xuat`
  ADD CONSTRAINT `nhap_xuat_ibfk_1` FOREIGN KEY (`thiet_bi_id`) REFERENCES `thiet_bi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
