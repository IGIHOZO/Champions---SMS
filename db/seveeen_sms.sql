-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2022 at 02:28 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seveeen_sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `BranchId` int(11) NOT NULL,
  `BranchName` varchar(50) NOT NULL,
  `BranchStatus` tinyint(1) NOT NULL DEFAULT 1,
  `BranchDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`BranchId`, `BranchName`, `BranchStatus`, `BranchDate`) VALUES
(8, 'Stock1/furmiture', 1, '2022-09-24 00:12:07'),
(9, 'stock2/Brian', 1, '2022-10-03 13:34:05'),
(10, 'shop1', 1, '2022-10-11 17:22:51');

-- --------------------------------------------------------

--
-- Table structure for table `branchstock`
--

CREATE TABLE `branchstock` (
  `BranchStockId` int(11) NOT NULL,
  `BranchId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `IsProductBox` tinyint(1) NOT NULL,
  `ProductPrice` int(11) NOT NULL,
  `QuantityBefore` int(11) NOT NULL,
  `QuantityAdded` int(11) NOT NULL,
  `QuantityAfter` int(11) NOT NULL,
  `EmployeeUpdated` int(11) DEFAULT NULL,
  `DateUpdated` datetime DEFAULT NULL,
  `StockStatus` int(11) NOT NULL DEFAULT 1,
  `DateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `InitialStock` int(11) NOT NULL,
  `AllIn` int(11) DEFAULT 0,
  `AllOut` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branchstock`
--

INSERT INTO `branchstock` (`BranchStockId`, `BranchId`, `ProductId`, `IsProductBox`, `ProductPrice`, `QuantityBefore`, `QuantityAdded`, `QuantityAfter`, `EmployeeUpdated`, `DateUpdated`, `StockStatus`, `DateCreated`, `InitialStock`, `AllIn`, `AllOut`) VALUES
(13, 8, 13, 0, 100, 5, -1, 4, 1, '2022-09-24 09:19:03', 1, '2022-09-24 00:15:25', 8, 0, 4),
(14, 8, 14, 0, 100, 4, -2, 2, 1, NULL, 1, '2022-09-24 00:30:50', 3, 2, 3),
(15, 9, 15, 0, 100, 4, 1, 5, 1, NULL, 1, '2022-10-03 13:37:55', 5, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `EmployeesId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `EmployeeNames` varchar(50) NOT NULL,
  `EmployeePhone` varchar(30) NOT NULL,
  `EmployeeBranch` int(11) DEFAULT NULL,
  `EmployeesType` int(11) NOT NULL,
  `EmployeeStatus` int(11) NOT NULL DEFAULT 1,
  `EmployeeDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmployeesId`, `UserId`, `EmployeeNames`, `EmployeePhone`, `EmployeeBranch`, `EmployeesType`, `EmployeeStatus`, `EmployeeDate`) VALUES
(1, 1, 'DUSHIMIMANA Alex', '0784424020', NULL, 0, 1, '2022-09-15 16:07:48'),
(11, 11, '0782013955', '0782013955', 8, 1, 1, '2022-09-24 00:12:44'),
(12, 12, 'Brian', '0782013958', 8, 1, 1, '2022-10-03 13:34:47'),
(13, 13, 'Alex', '0788407016', 9, 1, 1, '2022-10-10 08:51:13'),
(14, 14, 'emmy', '0782013957', 10, 1, 1, '2022-10-11 17:23:37');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `ExpenseId` int(11) NOT NULL,
  `ExpenseName` varchar(30) NOT NULL,
  `ExpensePrice` float NOT NULL,
  `ExpenseQuantity` int(11) NOT NULL,
  `ExpenseMethod` varchar(10) NOT NULL,
  `ExpenseStatus` int(11) NOT NULL DEFAULT 1,
  `ExpenseDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `headstock`
--

CREATE TABLE `headstock` (
  `HeadStockId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `IsProductBox` tinyint(1) NOT NULL,
  `QuantityBefore` int(11) NOT NULL,
  `QuantityAdded` int(11) NOT NULL,
  `QuantityAfter` int(11) NOT NULL,
  `DateUpdated` datetime DEFAULT NULL,
  `StockStatus` int(11) NOT NULL DEFAULT 1,
  `DateCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `headstock`
--

INSERT INTO `headstock` (`HeadStockId`, `ProductId`, `IsProductBox`, `QuantityBefore`, `QuantityAdded`, `QuantityAfter`, `DateUpdated`, `StockStatus`, `DateCreated`) VALUES
(8, 13, 0, 6, 4, 10, '2022-09-24 09:39:55', 1, '2022-09-24 00:14:27'),
(9, 14, 0, 8, -2, 6, '2022-09-24 09:32:53', 1, '2022-09-24 00:24:19'),
(10, 15, 0, 3, -1, 2, NULL, 1, '2022-10-03 13:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `imports`
--

CREATE TABLE `imports` (
  `ImportId` int(11) NOT NULL,
  `CustomStation` varchar(30) NOT NULL,
  `CustomDeclarationNo` varchar(30) NOT NULL,
  `CustomDeclarationDate` varchar(30) NOT NULL,
  `ItemName` varchar(50) NOT NULL,
  `CustomValue` float NOT NULL,
  `VATPaid` float NOT NULL,
  `ImportStatus` int(11) NOT NULL DEFAULT 1,
  `ImportDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mainstock`
--

CREATE TABLE `mainstock` (
  `MainStockId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `IsProductBox` tinyint(1) NOT NULL,
  `QuantityBefore` int(11) NOT NULL,
  `QuantityAdded` int(11) NOT NULL,
  `QuantityAfter` int(11) NOT NULL,
  `DateUpdated` datetime DEFAULT NULL,
  `StockStatus` int(11) NOT NULL DEFAULT 1,
  `DateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `WarehouseId` int(11) NOT NULL,
  `InitialStock` int(11) NOT NULL,
  `AllIn` int(11) NOT NULL DEFAULT 0,
  `AllOut` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mainstock`
--

INSERT INTO `mainstock` (`MainStockId`, `ProductId`, `IsProductBox`, `QuantityBefore`, `QuantityAdded`, `QuantityAfter`, `DateUpdated`, `StockStatus`, `DateCreated`, `WarehouseId`, `InitialStock`, `AllIn`, `AllOut`) VALUES
(12, 13, 0, 9, -4, 5, '2022-09-24 09:39:55', 1, '2022-09-24 00:13:42', 4, 20, 0, 15),
(13, 14, 0, 3, -2, 1, '2022-09-24 09:32:53', 1, '2022-09-24 00:23:36', 5, 10, 2, 11),
(14, 15, 0, 20, -10, 10, '2022-10-03 10:37:33', 1, '2022-10-03 13:37:09', 5, 20, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `productcategories`
--

CREATE TABLE `productcategories` (
  `CategoryId` int(11) NOT NULL,
  `CategoryName` varchar(30) NOT NULL,
  `CategoryStatus` int(11) NOT NULL DEFAULT 1,
  `CategoryDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productcategories`
--

INSERT INTO `productcategories` (`CategoryId`, `CategoryName`, `CategoryStatus`, `CategoryDate`) VALUES
(1, 'Electronics', 1, '2022-07-16 17:29:36'),
(2, 'Furnitures', 1, '2022-07-16 17:29:36'),
(3, 'Others', 1, '2022-07-16 17:29:47'),
(4, 'IT', 1, '2022-08-09 15:42:07'),
(5, 'Networking', 1, '2022-08-09 15:42:07'),
(6, 'Stetioneries', 1, '2022-08-09 15:42:43'),
(7, 'Hardware', 1, '2022-08-09 15:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductId` int(11) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `ProductCategory` int(11) NOT NULL,
  `IsProductBox` tinyint(1) NOT NULL,
  `ProductBoxPieces` int(11) DEFAULT NULL,
  `ProductSatatus` int(11) NOT NULL DEFAULT 1,
  `ProductDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductId`, `ProductName`, `ProductCategory`, `IsProductBox`, `ProductBoxPieces`, `ProductSatatus`, `ProductDate`) VALUES
(13, 'VGA Cable', 4, 0, NULL, 1, '2022-09-24 00:13:19'),
(14, 'MDF Table', 2, 0, NULL, 1, '2022-09-24 00:21:44'),
(15, 'Router', 1, 0, NULL, 1, '2022-10-03 13:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `PurchaseId` int(11) NOT NULL,
  `SupplierTin` varchar(30) NOT NULL,
  `SupplierName` varchar(50) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `InvoiceNumber` varchar(50) NOT NULL,
  `InvoiceDate` varchar(20) NOT NULL,
  `TotalAmountTaxInclusive` float NOT NULL,
  `VATAmount` float NOT NULL,
  `PurchaseStatus` int(11) NOT NULL DEFAULT 1,
  `InsertDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stockout`
--

CREATE TABLE `stockout` (
  `StockOutId` int(11) NOT NULL,
  `EmployeeId` int(11) NOT NULL,
  `BranchId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `IsProductBox` int(11) NOT NULL,
  `ExpectedPrice` int(11) NOT NULL,
  `SoldPrice` int(11) NOT NULL,
  `QuantityBefore` int(11) NOT NULL,
  `QuantitySold` int(11) NOT NULL,
  `QuantityRemaining` int(11) NOT NULL,
  `ClientName` varchar(50) NOT NULL,
  `CompanyName` varchar(30) DEFAULT NULL,
  `ClientPhone` varchar(15) NOT NULL,
  `PaymentMethod` tinyint(1) NOT NULL,
  `PaymentWay` varchar(15) NOT NULL,
  `StockOutStatus` int(11) NOT NULL DEFAULT 1,
  `StockOutDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockout`
--

INSERT INTO `stockout` (`StockOutId`, `EmployeeId`, `BranchId`, `ProductId`, `IsProductBox`, `ExpectedPrice`, `SoldPrice`, `QuantityBefore`, `QuantitySold`, `QuantityRemaining`, `ClientName`, `CompanyName`, `ClientPhone`, `PaymentMethod`, `PaymentWay`, `StockOutStatus`, `StockOutDate`) VALUES
(5, 11, 8, 13, 0, 100, 20000, 5, 2, 3, 'rutikanga', 'E-Gura Store', '0788407016', 1, 'By Cash', 1, '2022-09-24 00:17:00'),
(6, 11, 8, 14, 0, 100, 150000, 5, 1, 4, 'alice', 'E-Gura Store', '0788407016', 1, 'By Momo', 1, '2022-09-24 00:35:56'),
(7, 12, 8, 13, 0, 100, 10000, 5, 1, 4, 'phocas', 'E-Gura Store', '0782013955', 1, 'By Cash', 1, '2022-10-03 13:39:12'),
(8, 12, 8, 14, 0, 100, 2000, 4, 2, 2, 'Kello', 'Norseken', '078205254565', 1, 'By Cash', 1, '2022-10-10 08:49:38'),
(9, 13, 9, 15, 0, 100, 50000, 5, 1, 4, 'Murisa', 'ELI RWANDA', '0782013954', 1, 'By Momo', 1, '2022-10-10 08:52:30'),
(10, 13, 9, 15, 0, 100, 20000, 6, 2, 4, 'KALISA', 'EQUITY BANK', '0788407018', 1, 'By Cash', 1, '2022-10-10 08:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `stocktransactions`
--

CREATE TABLE `stocktransactions` (
  `TransactionId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `FromStock` int(11) NOT NULL,
  `ToStock` int(11) NOT NULL,
  `IsProductBox` tinyint(1) NOT NULL,
  `QuantityBefore` int(11) NOT NULL,
  `QuantityAdded` int(11) NOT NULL,
  `QuantityAfter` int(11) NOT NULL,
  `DateUpdated` datetime DEFAULT NULL,
  `StockStatus` int(11) NOT NULL DEFAULT 1,
  `DateCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocktransactions`
--

INSERT INTO `stocktransactions` (`TransactionId`, `ProductId`, `UserId`, `FromStock`, `ToStock`, `IsProductBox`, `QuantityBefore`, `QuantityAdded`, `QuantityAfter`, `DateUpdated`, `StockStatus`, `DateCreated`) VALUES
(63, 13, 1, 0, 1, 0, 0, 20, 20, NULL, 1, '2022-09-24 00:13:42'),
(64, 13, 1, 0, 1, 0, 20, -10, 10, NULL, 1, '2022-09-24 00:14:27'),
(65, 13, 1, 1, 2, 0, 0, 10, 10, NULL, 1, '2022-09-24 00:14:27'),
(66, 13, 1, 1, 2, 0, 10, -5, 5, NULL, 1, '2022-09-24 00:15:25'),
(67, 13, 1, 2, 3, 0, 0, 5, 5, NULL, 1, '2022-09-24 00:15:25'),
(68, 13, 11, 2, 3, 0, 5, -2, 3, NULL, 1, '2022-09-24 00:17:00'),
(69, 14, 1, 0, 1, 0, 0, 10, 10, NULL, 1, '2022-09-24 00:23:36'),
(70, 14, 1, 0, 1, 0, 10, -2, 8, NULL, 1, '2022-09-24 00:24:19'),
(71, 14, 1, 1, 2, 0, 0, 2, 2, NULL, 1, '2022-09-24 00:24:19'),
(72, 14, 1, 0, 1, 0, 8, 2, 10, NULL, 1, '2022-09-24 00:25:51'),
(73, 14, 1, 0, 1, 0, 2, -3, 7, NULL, 1, '2022-09-24 00:26:05'),
(74, 14, 1, 1, 2, 0, 10, 3, 5, NULL, 1, '2022-09-24 00:26:05'),
(75, 14, 1, 0, 1, 0, 5, -4, 3, NULL, 1, '2022-09-24 00:30:10'),
(76, 14, 1, 1, 2, 0, 7, 4, 9, NULL, 1, '2022-09-24 00:30:10'),
(77, 14, 1, 1, 2, 0, 9, -3, 6, NULL, 1, '2022-09-24 00:30:50'),
(78, 14, 1, 2, 3, 0, 0, 3, 3, NULL, 1, '2022-09-24 00:30:50'),
(79, 14, 1, 0, 1, 0, 6, -2, 1, NULL, 1, '2022-09-24 00:32:53'),
(80, 14, 1, 1, 2, 0, 3, 2, 8, NULL, 1, '2022-09-24 00:32:53'),
(81, 14, 1, 1, 2, 0, 8, -2, 6, NULL, 1, '2022-09-24 00:34:00'),
(82, 14, 1, 2, 3, 0, 3, 2, 5, NULL, 1, '2022-09-24 00:34:00'),
(83, 14, 11, 2, 3, 0, 5, -1, 4, NULL, 1, '2022-09-24 00:35:56'),
(84, 13, 1, 0, 1, 0, 5, -1, 9, NULL, 1, '2022-09-24 00:37:28'),
(85, 13, 1, 1, 2, 0, 10, 1, 6, NULL, 1, '2022-09-24 00:37:28'),
(86, 13, 1, 0, 1, 0, 6, -4, 5, NULL, 1, '2022-09-24 00:39:56'),
(87, 13, 1, 1, 2, 0, 9, 4, 10, NULL, 1, '2022-09-24 00:39:56'),
(88, 15, 1, 0, 1, 0, 0, 20, 20, NULL, 1, '2022-10-03 13:37:09'),
(89, 15, 1, 0, 1, 0, 20, -10, 10, NULL, 1, '2022-10-03 13:37:33'),
(90, 15, 1, 1, 2, 0, 0, 10, 10, NULL, 1, '2022-10-03 13:37:33'),
(91, 15, 1, 1, 2, 0, 10, -5, 5, NULL, 1, '2022-10-03 13:37:55'),
(92, 15, 1, 2, 3, 0, 0, 5, 5, NULL, 1, '2022-10-03 13:37:55'),
(93, 13, 12, 2, 3, 0, 5, -1, 4, NULL, 1, '2022-10-03 13:39:12'),
(94, 14, 12, 2, 3, 0, 4, -2, 2, NULL, 1, '2022-10-10 08:49:39'),
(95, 15, 13, 2, 3, 0, 5, -1, 4, NULL, 1, '2022-10-10 08:52:30'),
(96, 15, 1, 1, 2, 0, 5, -2, 3, NULL, 1, '2022-10-10 08:57:49'),
(97, 15, 1, 2, 3, 0, 4, 2, 6, NULL, 1, '2022-10-10 08:57:49'),
(98, 15, 13, 2, 3, 0, 6, -2, 4, NULL, 1, '2022-10-10 08:59:59'),
(99, 15, 1, 1, 2, 0, 3, -1, 2, NULL, 1, '2022-10-10 09:01:01'),
(100, 15, 1, 2, 3, 0, 4, 1, 5, NULL, 1, '2022-10-10 09:01:01');

-- --------------------------------------------------------

--
-- Table structure for table `systemusers`
--

CREATE TABLE `systemusers` (
  `UserId` int(11) NOT NULL,
  `UserNames` varchar(50) NOT NULL,
  `UserPhone` varchar(30) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `systemusers`
--

INSERT INTO `systemusers` (`UserId`, `UserNames`, `UserPhone`, `UserPassword`, `Status`, `Date`) VALUES
(1, 'DUSHIMIMANA Alex', '0784424020', '42f749ade7f9e195bf475f37a44cafcb', 1, '2022-07-16 18:39:08'),
(11, '0782013955', '0782013955', '202cb962ac59075b964b07152d234b70', 1, '2022-09-24 00:12:44'),
(12, 'Brian', '0782013958', '202cb962ac59075b964b07152d234b70', 1, '2022-10-03 13:34:47'),
(13, 'Alex', '0788407016', '202cb962ac59075b964b07152d234b70', 1, '2022-10-10 08:51:13'),
(14, 'emmy', '0782013957', '202cb962ac59075b964b07152d234b70', 1, '2022-10-11 17:23:37');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `WarehouseId` int(11) NOT NULL,
  `WarehouseName` varchar(50) NOT NULL,
  `WarehouseStatus` int(11) NOT NULL DEFAULT 1,
  `WarehouseDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`WarehouseId`, `WarehouseName`, `WarehouseStatus`, `WarehouseDate`) VALUES
(1, 'Kigali', 2, '2022-09-21 09:32:05'),
(2, 'Huye', 2, '2022-09-21 09:32:13'),
(3, 'Musanze', 2, '2022-09-21 09:32:27'),
(4, 'Warehouse1', 1, '2022-09-24 00:11:39'),
(5, 'warehouse2/Furniture', 1, '2022-09-24 00:22:19'),
(6, 'Warehouse3', 1, '2022-10-03 13:33:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`BranchId`);

--
-- Indexes for table `branchstock`
--
ALTER TABLE `branchstock`
  ADD PRIMARY KEY (`BranchStockId`),
  ADD KEY `UpdatedEmployee` (`EmployeeUpdated`),
  ADD KEY `BranchId` (`BranchId`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeesId`),
  ADD KEY `EmployeeBranch` (`EmployeeBranch`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`ExpenseId`);

--
-- Indexes for table `headstock`
--
ALTER TABLE `headstock`
  ADD PRIMARY KEY (`HeadStockId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Indexes for table `imports`
--
ALTER TABLE `imports`
  ADD PRIMARY KEY (`ImportId`);

--
-- Indexes for table `mainstock`
--
ALTER TABLE `mainstock`
  ADD PRIMARY KEY (`MainStockId`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `WarehouseId` (`WarehouseId`);

--
-- Indexes for table `productcategories`
--
ALTER TABLE `productcategories`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductId`),
  ADD KEY `ProductCategory` (`ProductCategory`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`PurchaseId`);

--
-- Indexes for table `stockout`
--
ALTER TABLE `stockout`
  ADD PRIMARY KEY (`StockOutId`),
  ADD KEY `EmployeeId` (`EmployeeId`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `BranchId` (`BranchId`);

--
-- Indexes for table `stocktransactions`
--
ALTER TABLE `stocktransactions`
  ADD PRIMARY KEY (`TransactionId`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `systemusers`
--
ALTER TABLE `systemusers`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`WarehouseId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `BranchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `branchstock`
--
ALTER TABLE `branchstock`
  MODIFY `BranchStockId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EmployeesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `ExpenseId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `headstock`
--
ALTER TABLE `headstock`
  MODIFY `HeadStockId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `imports`
--
ALTER TABLE `imports`
  MODIFY `ImportId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mainstock`
--
ALTER TABLE `mainstock`
  MODIFY `MainStockId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `productcategories`
--
ALTER TABLE `productcategories`
  MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `PurchaseId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stockout`
--
ALTER TABLE `stockout`
  MODIFY `StockOutId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stocktransactions`
--
ALTER TABLE `stocktransactions`
  MODIFY `TransactionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `systemusers`
--
ALTER TABLE `systemusers`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `WarehouseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branchstock`
--
ALTER TABLE `branchstock`
  ADD CONSTRAINT `branchstock_ibfk_1` FOREIGN KEY (`EmployeeUpdated`) REFERENCES `employees` (`EmployeesId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `branchstock_ibfk_2` FOREIGN KEY (`BranchId`) REFERENCES `branches` (`BranchId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`EmployeeBranch`) REFERENCES `branches` (`BranchId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `systemusers` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `headstock`
--
ALTER TABLE `headstock`
  ADD CONSTRAINT `headstock_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mainstock`
--
ALTER TABLE `mainstock`
  ADD CONSTRAINT `mainstock_ibfk_1` FOREIGN KEY (`WarehouseId`) REFERENCES `warehouses` (`WarehouseId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`ProductCategory`) REFERENCES `productcategories` (`CategoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stockout`
--
ALTER TABLE `stockout`
  ADD CONSTRAINT `stockout_ibfk_1` FOREIGN KEY (`EmployeeId`) REFERENCES `employees` (`EmployeesId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stockout_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stockout_ibfk_3` FOREIGN KEY (`BranchId`) REFERENCES `branches` (`BranchId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stocktransactions`
--
ALTER TABLE `stocktransactions`
  ADD CONSTRAINT `stocktransactions_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stocktransactions_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `systemusers` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
