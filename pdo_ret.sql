-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2015 at 11:56 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14



SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdo_ret`
--
drop DATABASE if exists pdo_ret;

CREATE DATABASE pdo_ret;

USE pdo_ret;
-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE user (
  uid int(11) NOT NULL ,
  username varchar(80) NOT NULL,
  password varchar(80) NOT NULL,
  PRIMARY Key (uid)
);

--
-- Dumping data for table `user`
--

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Table structure for table `userType`
--

CREATE TABLE userType (
  uid int(11) NOT NULL ,
  usertype char(1) NOT NULL,
  PRIMARY Key (uid),
  foreign key (uid) references user(uid) on update cascade on delete cascade
);

--
-- Dumping data for table `userType`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE cart (
  cid int(20) NOT NULL unique,
  date_created date NOT NULL,
  PRIMARY KEY(cid)
);

-- --------------------------------------------------------

--
<<<<<<< HEAD
=======
-- Table structure for table `product`
--

CREATE TABLE product (
  productId int(11) NOT NULL,
  Name varchar(80) NOT NULL,
  Description varchar(80) NOT NULL,
  image varchar(80) NOT NULL,
  price float NOT NULL,
  quantity int(11) NOT NULL,
  Primary Key(productId)
);

--
-- Dumping data for table `product`
--

-- --------------------------------------------------------

--
>>>>>>> master
-- Table structure for table `cartproduct`
--

CREATE TABLE cartproduct (
  cid int(20) NOT NULL ,
  productId int(20) NOT NULL,
  PRIMARY Key(cid,productId),
  foreign key (cid) references cart(cid) on update cascade on delete cascade,
  foreign key (productId) references product(productId) on update cascade on delete cascade
);

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE account (
  aid int(11) NOT NULL,
  firstName varchar(255) NOT NULL,
  lastName varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  phoneNumber int(20) NOT NULL,
  active varchar(255) NOT NULL,
  resetToken varchar(255) DEFAULT NULL,
  resetComplete varchar(3) DEFAULT 'No',
  PRIMARY KEY(aid)
);

--
-- Dumping data for table `account`
--

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE userAccount (
  uid int(11) NOT NULL,
  aid int(11) NOT NULL,
  PRIMARY Key(uid,aid),
  foreign key (uid) references user(uid) on update cascade on delete cascade,
  foreign key (aid) references account(aid) on update cascade on delete cascade
);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE orders (
  orderId int(11) NOT NULL,
  order_date date NOT NULL,
  delivery_date date NOT NULL,
  orderStatus varchar(20) NOT NULL,
  total float(40) NOT NULL,
  Primary Key(orderId)
);

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Table structure for table `product`
--

CREATE TABLE product (
  productId int(11) NOT NULL,
  Name varchar(80) NOT NULL,
  Description varchar(80) NOT NULL,
  image varchar(80) NOT NULL,
  price float NOT NULL,
  quantity int(11) NOT NULL,
  Primary Key(productId)
);

--
-- Dumping data for table `product`
--


-- --------------------------------------------------------

--
=======
>>>>>>> master
-- Table structure for table `orderItem`
--

CREATE TABLE orderItem (
  itemCode int(11) NOT NULL,
  quantity int(11) NOT NULL,
  price float NOT NULL,
  PRIMARY KEY(itemCode),
  foreign key (itemCode) references product(productId) on update cascade on delete cascade
);

--
-- Dumping data for table `orderItem`
--

--
-- Table structure for table `orderProduct`
--

CREATE TABLE orderProduct (
  orderId int(11) NOT NULL,
  itemCode int(11) NOT NULL,
  PRIMARY KEY(orderId,itemCode),
  foreign key (orderId) references orders(orderId) on update cascade on delete cascade,
  foreign key (itemCode) references orderItem(itemCode) on update cascade on delete cascade
);

--
-- Dumping data for table `orderProduct`
--



-- --------------------------------------------------------





-- --------------------------------------------------------

--
-- Table structure for table `accounrtCart`
--

CREATE TABLE accountCart (
  aid int(11) NOT NULL,
  cid int(11) NOT NULL,
  Primary Key (aid,cid),
  foreign key (aid) references account(aid) on update cascade on delete cascade,
  foreign key (cid) references cart(cid) on update cascade on delete cascade
);

--
-- Dumping data for table `accountCart`
--



-- --------------------------------------------------------

--
-- Table structure for table `accounrtOrder`

CREATE TABLE accountOrder (
  aid int(11) NOT NULL,
  orderId int(11) NOT NULL,
  Primary Key (aid,orderId),
  foreign key (aid) references account(aid) on update cascade on delete cascade,
  foreign key (orderId) references orders(orderId) on update cascade on delete cascade
);

--
-- Dumping data for table `accountOrder`
--


-- --------------------------------------------------------

--
-- Table structure for table `address`

CREATE TABLE address (
  addressId int(11) NOT NULL,
  streetAddress varchar(255) NOT NULL,
  city varchar(80) NOT NULL,
  parrish varchar(50) NOT NULL,
  postalCode varchar(20) NOT NULL,
  Primary Key (addressId)
);

--
-- Dumping data for table `address`
--
-- --------------------------------------------------------

--
-- Table structure for table `accountAddress`

CREATE TABLE accountAddress (
  aid int(11) NOT NULL,
  addressId int(11) NOT NULL,
  Primary Key (aid,addressId),
  foreign key (aid) references account(aid) on update cascade on delete cascade,
  foreign key (addressId) references address(addressId) on update cascade on delete cascade
);

--
-- Dumping data for table `accountAddress`
--







-- --------------------------------------------------------

--


--
-- Table structure for table `creditCard`

CREATE TABLE creditCard (
  cardHolder varchar(255) NOT NULL,
  cardNumber int(80) NOT NULL,
  expiryDate date  NOT NULL,
  cardVerificationCode varchar(50) NOT NULL,
  Primary Key (cardNumber)
);

--
-- Dumping data for table `creditCard`
--



-- --------------------------------------------------------

--
-- Table structure for table `bankAccount`

CREATE TABLE bankAccount (
  accountNumber int(80) NOT NULL,
  bank varchar(80) NOT NULL,
  accountType varchar(30)  NOT NULL,
  Primary Key (accountNumber)
);

--
-- Dumping data for table `bankAccount`
--



-- --------------------------------------------------------

--
-- Table structure for table `paypal`

CREATE TABLE paypal (
  email varchar(80) NOT NULL,
  password varchar(80) NOT NULL,
  Primary Key (email)
);

--
-- Dumping data for table `paypal`
--



-- --------------------------------------------------------

--
-- Table structure for table `creditAccount`

CREATE TABLE creditAccount (
  cardNumber int(11) NOT NULL,
  aid int(11) NOT NULL,
  Primary Key (cardNumber,aid),
  foreign key (aid) references account(aid) on update cascade on delete cascade,
  foreign key (cardNumber) references creditCard(cardNumber) on update cascade on delete cascade
);

--
-- Dumping data for table `creditAccount`
--



-- --------------------------------------------------------

--
-- Table structure for table `bankAcc`

CREATE TABLE bankAcc (
  accountNumber int(11) NOT NULL,
  aid int(11) NOT NULL,
  Primary Key (accountNumber,aid),
  foreign key (accountNumber) references bankAccount(accountNumber) on update cascade on delete cascade,
  foreign key (aid) references account(aid) on update cascade on delete cascade
);

--
-- Dumping data for table `bankAcc`
--



-- --------------------------------------------------------

--
-- Table structure for table `paypalAccount`

CREATE TABLE paypalAccount (
  email varchar(80) NOT NULL,
  aid int(11) NOT NULL,
  Primary Key (email,aid),
  foreign key (email) references paypal(email) on update cascade on delete cascade,
  foreign key (aid) references account(aid) on update cascade on delete cascade
);

--
-- Dumping data for table `bankAcc`
--


<<<<<<< HEAD

-- --------------------------------------------------------
=======
-- --------------------------------------------------------
>>>>>>> master
