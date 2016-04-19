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

CREATE TABLE admin(
  username varchar(80) NOT NULL,
  password_hash varchar(80) NOT NULL,
  PRIMARY Key (username)
);



CREATE TABLE account (
    username varchar(80) NOT NULL,
    email_address varchar(80) NOT NULL,
    password_hash char(40) NOT NULL,
    p_number int(20) NOT NULL,
    f_name varchar(80) NOT NULL,
    l_name varchar(80) NOT NULL,
    PRIMARY Key (username, email_address)
);



CREATE TABLE cart (
  cart_id char(40) not null,
  date_created int(8) NOT NULL,
  total_price float(50) NOT Null,
  PRIMARY KEY(cart_id)
);


CREATE TABLE orders (
  order_id char(40) not null,
  order_date date NOT NULL,
  delivery_date date NOT NULL,
  order_status varchar(20) NOT NULL,
  order_total float(40) NOT NULL,
  Primary Key(order_id)
);


CREATE TABLE product (
  product_id char(40) not null,
  product_name varchar(80) NOT NULL,
  image varchar(80) NOT NULL,
  price float(40) NOT NULL,
  quantity_left int(11) NOT NULL,
  Primary Key(product_id)
);

CREATE TABLE address (
  address_id char(40) not null,
  street_address varchar(80) NOT NULL,
  city varchar(80) NOT NULL,
  parish varchar(50) NOT NULL,
  postal_code char(7) NOT NULL,
  Primary Key (address_id)
);

-- Table structure for table `creditCard`

CREATE TABLE credit_card (
  cc_number char(40) not null,
  cardholder_name varchar(80) NOT NULL,
  Primary Key (cc_number)
);


CREATE TABLE bank_account (
  acc_id char(40) not null,
  bank_name varchar(80) NOT NULL,
  acc_type varchar(30)  NOT NULL,
  acc_number int(25) not null,
  Primary Key (acc_id)
);


CREATE TABLE paypal (
  email varchar(80) NOT NULL,
  password varchar(80) NOT NULL,
  Primary Key (email)
);


CREATE TABLE order_product (
    order_id char(40) not null,
    product_id char(40) not null,
    quantity int(3) not null,
    PRIMARY KEY(order_id,product_id),
    foreign key (order_id) references orders(order_id) on update cascade on delete cascade,
    foreign key (product_id) references product(product_id) on update cascade on delete cascade
);


CREATE TABLE cart_product (
    cart_id char(40) not null,
    product_id char(40) not null,
    quantity int(3) not null,
    PRIMARY Key(cart_id,product_id),
    foreign key (cart_id) references cart(cart_id) on update cascade on delete cascade,
    foreign key (product_id) references product(product_id) on update cascade on delete cascade
);

CREATE TABLE account_cart (
  username varchar(80) NOT NULL,
  cart_id char(40) not null,
  Primary Key (username,cart_id),
  foreign key (username) references account(username) on update cascade on delete cascade,
  foreign key (cart_id) references cart(cart_id) on update cascade on delete cascade
);



CREATE TABLE account_order (
  username varchar(80) NOT NULL,
  order_id char(40) not null,
  Primary Key (username,order_id),
  foreign key (username) references account(username) on update cascade on delete cascade,
  foreign key (order_id) references orders(order_id) on update cascade on delete cascade
);


CREATE TABLE shipping_address (
  username varchar(80) NOT NULL,
  address_id char(40) not null,
  Primary Key (username),
  foreign key (username) references account(username) on update cascade on delete cascade,
  foreign key (address_id) references address(address_id) on update cascade on delete cascade
);

CREATE TABLE cc_billing_address (
  cc_number char(40) not null,
  address_id char(40) not null,
  Primary Key (cc_number),
  foreign key (cc_number) references credit_card(cc_number) on update cascade on delete cascade,
  foreign key (address_id) references address(address_id) on update cascade on delete cascade
);

CREATE TABLE ba_billing_address (
  acc_id char(40) not null,
  address_id char(40) not null,
  Primary Key (acc_id),
  foreign key (acc_id) references bank_account(acc_id) on update cascade on delete cascade,
  foreign key (address_id) references address(address_id) on update cascade on delete cascade
);

CREATE TABLE account_payment (
  username varchar(80) NOT NULL,
  payment_id varchar(80) not null,
  Primary Key (username),
  foreign key (username) references account(username) on update cascade on delete cascade
);

CREATE TABLE product_description (
  product_id char(40) not null,
  description_no char(40) not null,
  description varchar(80) NOT NULL,
  Primary Key (product_id,description_no),
  foreign key (product_id) references product(product_id) on update cascade on delete cascade
);



insert into product values('a98704cd1bee6608772b6458e7d9e06a7add59b2', 'G1 Engine', '', 600.00, 21);
insert into product values('95819786d71397569d39fd668c65b95003ee37e0', 'G2 Engine', '', 600.00, 21);
insert into product values('bd52d850ed04432d978984c9ed66bdd4b27c9499', 'G3 Engine', '', 600.00, 21);
insert into product values('0beb966c593579ae1a7cd7eaf6827c560a6dfcb7', 'G4 Engine', '', 600.00, 21);
insert into product values('0f352d1add9f11f05c34adbe843c9250f5321824', 'G5 Engine', '', 600.00, 21);
insert into product values('07ac93aec58e44ac803e4a0736f9e336677f4f4a', 'G6 Engine', '', 600.00, 21);
insert into product values('dd6c9e88d90241cb733be473f2fceff1da902f85', 'G7 Engine', '', 600.00, 21);
insert into product values('12e296235e4267c93832a365624e99fb656ea39b', 'G8 Engine', '', 600.00, 21);
insert into product values('545c2be1837e49fb3bed1aa4c9a34c5a6d55d6c8', 'G9 Engine', '', 600.00, 21);
insert into product values('b3bd3d4e85aeafd063b6982dc5a235c37031b7b9', 'G10 Engine', '', 600.00, 21);
insert into product values('610371dba973f103d235fd213c381052cd43aee3', 'G11 Engine', '', 600.00, 21);
insert into product values('ab743453d5d9988978b3d94068d909e2ec99f33f', 'G12 Engine', '', 600.00, 21);