-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 09, 2025 lúc 03:42 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `fashion_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `cartId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `totalPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`cartId`, `userId`, `productId`, `quantity`, `totalPrice`) VALUES
(16, 13, 1, 1, 1200000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(2, 'Đầm'),
(3, 'Chân váy'),
(9, 'Set'),
(10, 'Quần'),
(11, 'Phụ kiện'),
(12, 'Áo');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderitems`
--

CREATE TABLE `orderitems` (
  `orderItemId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `totalPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orderitems`
--

INSERT INTO `orderitems` (`orderItemId`, `orderId`, `productId`, `quantity`, `totalPrice`) VALUES
(13, 15, 4, 1, 1600000),
(14, 16, 4, 1, 1600000),
(15, 17, 9, 1, 980000),
(16, 18, 9, 1, 980000),
(17, 19, 15, 1, 1700000),
(18, 20, 1, 1, 1200000),
(19, 21, 4, 1, 1600000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `orderTotal` double NOT NULL,
  `shippingCost` double NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `note` varchar(1000) NOT NULL,
  `paymentMethod` varchar(10) NOT NULL,
  `createdAt` date NOT NULL DEFAULT current_timestamp(),
  `updatedAt` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`orderId`, `userId`, `userName`, `status`, `orderTotal`, `shippingCost`, `city`, `district`, `ward`, `street`, `phone`, `note`, `paymentMethod`, `createdAt`, `updatedAt`) VALUES
(15, 14, 'Le Van A', 'delivering', 1600000, 30000, 'Ho Chi Minh', 'Quan 9', 'Phuong Linh Dong', 'so 12, Kha Van Can', '0123456789', '', 'cod', '2024-12-15', '2024-12-15'),
(16, 14, 'Le Van A', 'delivering', 1600000, 30000, 'Ho Chi Minh', 'Quan 9', 'Phuong Linh Dong', 'so 12, Kha Van Can', '0123456789', 'ghi chu', 'cod', '2024-12-15', '2024-12-15'),
(17, 14, 'Le Van A', 'ordered', 980000, 30000, 'Ho Chi Minh', 'Quan 9', 'Phuong Linh Dong', 'so 12, Kha Van Can', '0123456789', '', 'cod', '2025-02-23', '2025-02-23'),
(18, 14, 'Le Van A', 'completed', 980000, 30000, 'Ho Chi Minh', 'Quan 9', 'Phuong Linh Dong', 'so 12, Kha Van Can', '0123456789', '', 'cod', '2025-03-09', '2025-03-09'),
(19, 14, 'Le Van A', 'ordered', 1700000, 30000, 'Ho Chi Minh', 'Quan 9', 'Phuong Linh Dong', 'so 12, Kha Van Can', '0123456789', '', 'cod', '2025-03-09', '2025-03-09'),
(20, 14, 'Le Van A', 'ordered', 1200000, 30000, 'Ho Chi Minh', 'Quan 9', 'Phuong Linh Dong', 'so 12, Kha Van Can', '0123456789', '', 'cod', '2025-03-09', '2025-03-09'),
(21, 14, 'Le Van A', 'ordered', 1600000, 30000, 'Ho Chi Minh', 'Quan 9', 'Phuong Linh Dong', 'so 12, Kha Van Can', '0123456789', '', 'cod', '2025-03-09', '2025-03-09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `productimages`
--

CREATE TABLE `productimages` (
  `imageId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `productimages`
--

INSERT INTO `productimages` (`imageId`, `productId`, `link`) VALUES
(46, 6, 'uploads/products/675da663c89be-z6130998372611_5af32790019f39562828a52960d675ef.jpg'),
(47, 4, 'uploads/products/675da67ef2352-z6130998404742_2cccb288f334b3f03a7e86c406448056.jpg'),
(48, 1, 'uploads/products/675da6db620ab-z6130998470996_b480dda554d649fd22f78904e5c3beeb.jpg'),
(49, 9, 'uploads/products/675da702f2c9c-z6130998544062_d0d1f4b4564e3bc685f1556f390fd355.jpg'),
(50, 10, 'uploads/products/675da8689e88e-z6131019393347_ef06a3d93d3e509d12f3d0049088a3a6.jpg'),
(51, 11, 'uploads/products/675da89b705c5-z6131020647033_92e604b013c5d6ac26adb07991f96b2e.jpg'),
(52, 13, 'uploads/products/675e004d1d769-WINK-DRESS-3.jpg.webp'),
(53, 14, 'uploads/products/675e00f26b231-NEGA-SET-1.webp'),
(54, 15, 'uploads/products/675e01c7813ea-DYNA-TOP-RAINY-SKIRT-5.webp'),
(55, 16, 'uploads/products/675e0275809d5-REMY-SET-5.jpg.webp'),
(56, 17, 'uploads/products/675e02cb562b4-STACY-SET-1.webp'),
(57, 18, 'uploads/products/675e030eca88c-POISON-SET-1-scaled.webp'),
(58, 19, 'uploads/products/675e03607c62e-FAIRY-1-scaled.webp'),
(59, 20, 'uploads/products/675e03c543e65-GRACIN-TOP-1-1.webp'),
(60, 21, 'uploads/products/675e04146d9e5-FAUSTA-TOP-1.webp'),
(61, 22, 'uploads/products/675e4cd5bc908-POISON-SET-1-scaled.webp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productDesc` text NOT NULL,
  `price` double NOT NULL,
  `categoryId` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `createdAt` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`productId`, `productName`, `productDesc`, `price`, `categoryId`, `stock`, `views`, `createdAt`) VALUES
(1, 'OLAV DRESS', 'SẢN PHẨM BAO GỒM\r\n\r\nĐầm\r\n\r\nChất liệu: Thun gân\r\nCổ yếm, xẻ ngực sâu\r\nDáng váy ôm phần trên, xếp tầng xoè nhẹ phần dưới\r\nCÁC DỊP PHÙ HỢP\r\n\r\nBuổi tiệc, sự kiện hoặc dạo phố.', 1200000, 2, -1, 14, '2024-12-08'),
(4, 'LEVEL DRESS', 'SẢN PHẨM BAO GỒM\r\n\r\nĐầm\r\n\r\nChất liệu: Nỉ mêm\r\nCổ yếm, xẻ ngực sâu\r\nDây kéo phía trước\r\nDáng ôm phần trên, xoè phần dưới\r\nHoạ tiết ca rô\r\nCÁC DỊP PHÙ HỢP\r\n\r\nBuổi tiệc, sự kiện hoặc dạo phố.', 1600000, 2, 17, 168, '2024-12-08'),
(6, 'BUZZ SKIRT', 'SẢN PHẨM BAO GỒM\r\n\r\nĐầm\r\n\r\nChất liệu: Thun tăm len\r\nChi tiết nhún viền thun phân tầng.\r\nCÁC DỊP PHÙ HỢP\r\n\r\nBuổi tiệc, sự kiện hoặc dạo phố.', 820000, 3, 15, 1, '2024-12-14'),
(9, 'POLINA SKIRT', 'SẢN PHẨM BAO GỒM\r\n\r\nĐầm\r\n\r\nChất liệu: Thun tăm len\r\nDáng váy chữ A xoè tôn dáng\r\nViền ren ở thắt eo và chân váy\r\nCÁC DỊP PHÙ HỢP\r\n\r\nBuổi tiệc, sự kiện hoặc dạo phố.', 980000, 3, 21, 49, '2024-12-14'),
(10, 'CHURCHILL DRESS', 'SẢN PHẨM BAO GỒM\r\n\r\nĐầm\r\n\r\nChất liệu: Nỉ mềm\r\nĐầm cúp ngực, khoá cài phía trước\r\nHoạ tiết caro\r\nĐầm dáng ôm ở phần trên, xoè phồng hai lớp ở phía dưới\r\nCÁC DỊP PHÙ HỢP\r\n\r\nBuổi tiệc, sự kiện hoặc dạo phố.', 1900000, 2, 12, 1, '2024-12-14'),
(11, 'KAREN DRESS', 'SẢN PHẨM BAO GỒM\r\n\r\nĐầm\r\n\r\nChất liệu: Thun lưới\r\nThiết kế hai dây mảnh\r\nĐầm dáng dài, xuyên thấu.\r\nCÁC DỊP PHÙ HỢP\r\n\r\nBuổi tiệc, sự kiện.', 2500000, 2, 50, 6, '2024-12-14'),
(13, 'WINK DRESS', 'SẢN PHẨM BAO GỒM\r\n\r\nĐầm\r\n\r\nChất liệu: Kaki\r\nBề mặt phủ lớp poly mờ\r\nThiết kế dây bản to\r\nDáng váy ôm và xoè tôn thắt eo, che khuyết điểm\r\nCÁC DỊP PHÙ HỢP\r\n\r\nBuổi tiệc, sự kiện hoặc dạo phố.', 2200000, 2, 60, 1, '2024-12-15'),
(14, 'NEGA PANTS', 'SẢN PHẨM BAO GỒM\r\n\r\nQuần\r\n\r\nChất liệu: Da\r\nDáng ống thẳng\r\nPhối hoạ tiết ren mềm da beo\r\nCÁC DỊP PHÙ HỢP\r\n\r\nPhù hợp với các dịp tiệc tùng, sự kiện hoặc đi chơi cùng bạn bè.', 2500000, 10, 50, 2, '2024-12-15'),
(15, 'RAINY SKIRT', 'SẢN PHẨM BAO GỒM\r\n\r\nÁo\r\n\r\nChất liệu: Xô mềm\r\nThiết kế lệch vai, đính bèo nhúng\r\nChất liệu xô mềm, xuyên thấu.\r\nCÁC DỊP PHÙ HỢP\r\n\r\nPhù hợp với các dịp tiệc tùng, sự kiện hoặc đi chơi cùng bạn bè.', 1700000, 3, 49, 27, '2024-12-15'),
(16, 'REMY SET', 'SẢN PHẨM BAO GỒM\r\n\r\nÁo\r\nChân váy\r\nÁO\r\n\r\nChất liệu: ren lông\r\nThiết kế trễ vai, tay rộng\r\nRen lông xuyên thấu, có lớp lót\r\nCHÂN VÁY\r\n\r\nThiết kế ren mỏng xếp tầng\r\nCó lớp jeans bên trong \r\nCÁC DỊP PHÙ HỢP\r\n\r\nPhù hợp với các dịp tiệc tùng, sự kiện hoặc đi chơi cùng bạn bè.', 1400000, 9, 35, 0, '2024-12-15'),
(17, 'STACY SET', 'SẢN PHẨM BAO GỒM:\r\n• Áo\r\n• Quần váy.\r\n\r\nÁO\r\n• Chất liệu: Voan tơ\r\n• Thiết kế trễ vai\r\n• Kiểu dáng tay phồng che được khuyết điểm của tay\r\n• Dây đính hoa cách điệu ở cổ tay áo\r\n• Kiểu áo thụng\r\n• Có đệm mút ngực mỏng <1cm\r\n\r\nCHÂN VÁY\r\n• Chất liệu: Voan tơ\r\n• Quần váy ngắn mỏng nhẹ\r\n• Đuôi quần váy có điểm nhấn tua rua\r\n• Chân váy xếp tầng\r\n\r\nCÁC DỊP PHÙ HỢP:\r\n\r\n• Phù hợp với các dịp tiệc tùng, sự kiện, đi chơi cùng bạn bè.', 1500000, 9, 40, 0, '2024-12-15'),
(18, 'POISON SET', 'SẢN PHẨM BAO GỒM:\r\n\r\n• Đầm\r\n• Corset\r\n\r\nCORSET:\r\n\r\n• Chất liệu: Vải siêu len, vài ren, vải dù gân\r\n• Hai dây, cúp ngực\r\n• Dày dặn, phối ren ở ngực và hai bên hông\r\n• Dây đan để điều chỉnh kết hợp dây khóa kéo ở phía sau\r\n• Dây đan có thể điều chỉnh ở phần ngực\r\n• Có mút ngực\r\n• Găng tay đen đi kèm\r\n\r\nCHÂN VÁY:\r\n\r\n• Chất liệu: Vải siêu len, vài ren, vải dù gân\r\n• Ngắn xếp tầng, lưng thun\r\n• Dây thắt phía trước có thể điều chỉnh\r\n\r\nCÁC DỊP PHÙ HỢP:\r\n\r\n• Phù hợp với các dịp tiệc tùng, sự kiện hoặc đi chơi cùng bạn bè.', 2500000, 9, 40, 0, '2024-12-15'),
(19, 'FAIRY SET', 'SẢN PHẨM BAO GỒM:\r\n\r\nÁo\r\nChân váy\r\nÁO:\r\n\r\nChất liệu thun 2 lớp\r\nThiết kế cúp ngực và có tua rua\r\nĐính kèm phụ kiện hoa hồng đen\r\nCHÂN VÁY:\r\n\r\nChất liệu: Voan\r\nThiết kế xếp tầng quyến rũ\r\nCó phần bèo nhún ở eo tạo điểm nhấn\r\nCó lót quần bên trong\r\nCÁC DỊP PHÙ HỢP:\r\n\r\nPhù hợp với các dịp tiệc tùng, sự kiện, đi chơi cùng bạn bè.', 200000, 9, 37, 1, '2024-12-15'),
(20, 'GRACIN TOP', 'SẢN PHẨM BAO GỒM\r\n\r\nÁo\r\n\r\nChất liệu: Vải da bố \r\nCổ yếm, dây cổ\r\nThiết kể hở chân ngực, dây thắt đính đinh tán.\r\nCÁC DỊP PHÙ HỢP\r\n\r\nBuổi tiệc, sự kiện hoặc dạo phố.', 750000, 12, 45, 0, '2024-12-15'),
(21, 'FAUSTA TOP', 'SẢN PHẨM BAO GỒM\r\n\r\nÁo\r\n\r\nChất liệu: Voan sợi lụa \r\nThiết kế cổ yếm;\r\nTà trước nhọn dài.\r\n\r\nCÁC DỊP PHÙ HỢP\r\n\r\nBuổi tiệc, sự kiện hoặc dạo phố.', 850000, 12, 45, 2, '2024-12-15'),
(22, 'Sản phẩm mới', 'abc', 500000, 12, 50, 0, '2024-12-15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `birthdate` date NOT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT 0,
  `createdAt` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`userId`, `userName`, `phone`, `email`, `password`, `image`, `city`, `district`, `ward`, `street`, `gender`, `birthdate`, `isAdmin`, `createdAt`) VALUES
(5, '', '', 'admin@gmail.com', '$2y$10$i09sUKGcnPNvJu2xtwRcdeauX4CucYPGHHjpa8lZDp31ehXsfhSGa', 'uploads/users/67566a80212f7-z5907173008858_d2e57a864e46f50b58e0b7b41c1720ac.jpg', '', '', '', '', '', '0000-00-00', 1, '2024-12-07'),
(14, 'Le Van A', '0123456789', 'add@gmail.com', '$2y$10$hSxNbKzdXDb8qNYQoU03qOVK4AiC3PwXZPah5w9XpWfdIwzpu7pD.', 'uploads/users/675dde0405305-OIP (2).jpg', 'Ho Chi Minh', 'Quan 9', 'Phuong Linh Dong', 'so 12, Kha Van Can', '', '0000-00-00', 0, '2024-12-14');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cartId`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Chỉ mục cho bảng `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`orderItemId`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Chỉ mục cho bảng `productimages`
--
ALTER TABLE `productimages`
  ADD PRIMARY KEY (`imageId`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `orderItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `productimages`
--
ALTER TABLE `productimages`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
