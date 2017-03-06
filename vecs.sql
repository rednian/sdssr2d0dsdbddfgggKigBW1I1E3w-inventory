/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : vecs

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2015-09-16 16:11:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for barcode
-- ----------------------------
DROP TABLE IF EXISTS `barcode`;
CREATE TABLE `barcode` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) NOT NULL,
  `barcode` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`b_id`),
  KEY `prod_profile_barcode` (`prod_id`),
  CONSTRAINT `barcode_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `prod_profile` (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of barcode
-- ----------------------------

-- ----------------------------
-- Table structure for customer_profile
-- ----------------------------
DROP TABLE IF EXISTS `customer_profile`;
CREATE TABLE `customer_profile` (
  `cus_id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_fullname` varchar(255) NOT NULL,
  `cus_contact_no` varchar(255) NOT NULL,
  `cus_address` varchar(255) NOT NULL,
  `cus_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customer_profile
-- ----------------------------
INSERT INTO `customer_profile` VALUES ('1', 'Josela B. Escol', '09486543179', 'Ira Subdivision, Baan Km. 3, Butuan City', 'joselaescol@gmail.com');
INSERT INTO `customer_profile` VALUES ('2', 'Chris F. Olivo', '09202082025', 'Banza, Butuan City', 'rednianred@gmail.com');

-- ----------------------------
-- Table structure for log_history
-- ----------------------------
DROP TABLE IF EXISTS `log_history`;
CREATE TABLE `log_history` (
  `lh_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date_login` varchar(255) NOT NULL,
  `date_log_out` varchar(255) NOT NULL,
  PRIMARY KEY (`lh_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `log_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_profile` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of log_history
-- ----------------------------
INSERT INTO `log_history` VALUES ('1', '1', 'September 16, 2015 / 09:09:51 AM', 'September 16, 2015 / 04:09:14 PM');

-- ----------------------------
-- Table structure for price
-- ----------------------------
DROP TABLE IF EXISTS `price`;
CREATE TABLE `price` (
  `price_id` int(11) NOT NULL AUTO_INCREMENT,
  `price` double(40,2) DEFAULT NULL,
  `b_id` int(11) NOT NULL,
  PRIMARY KEY (`price_id`),
  KEY `barcode_price` (`b_id`),
  CONSTRAINT `barcode_price` FOREIGN KEY (`b_id`) REFERENCES `barcode` (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of price
-- ----------------------------

-- ----------------------------
-- Table structure for prod_profile
-- ----------------------------
DROP TABLE IF EXISTS `prod_profile`;
CREATE TABLE `prod_profile` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `model_no` varchar(40) DEFAULT NULL,
  `supplier` varchar(40) NOT NULL,
  `expiration_date` date NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of prod_profile
-- ----------------------------

-- ----------------------------
-- Table structure for prod_total_quantity
-- ----------------------------
DROP TABLE IF EXISTS `prod_total_quantity`;
CREATE TABLE `prod_total_quantity` (
  `ptq_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `quantity` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`ptq_id`),
  KEY `barcode_prod_total_quantity` (`b_id`),
  CONSTRAINT `barcode_prod_total_quantity` FOREIGN KEY (`b_id`) REFERENCES `barcode` (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of prod_total_quantity
-- ----------------------------

-- ----------------------------
-- Table structure for reserve
-- ----------------------------
DROP TABLE IF EXISTS `reserve`;
CREATE TABLE `reserve` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `date_res` varchar(40) DEFAULT NULL,
  `date_claimed` varchar(255) DEFAULT NULL,
  `status` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`res_id`),
  KEY `barcode_reserve` (`b_id`),
  CONSTRAINT `barcode_reserve` FOREIGN KEY (`b_id`) REFERENCES `barcode` (`b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of reserve
-- ----------------------------

-- ----------------------------
-- Table structure for stock_in_history
-- ----------------------------
DROP TABLE IF EXISTS `stock_in_history`;
CREATE TABLE `stock_in_history` (
  `sih_id` int(11) NOT NULL AUTO_INCREMENT,
  `dates` date DEFAULT NULL,
  `quantity` varchar(40) DEFAULT NULL,
  `b_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`sih_id`),
  KEY `barcode_stock_in_history` (`b_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `barcode_stock_in_history` FOREIGN KEY (`b_id`) REFERENCES `barcode` (`b_id`),
  CONSTRAINT `stock_in_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_profile` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stock_in_history
-- ----------------------------

-- ----------------------------
-- Table structure for stock_out_history
-- ----------------------------
DROP TABLE IF EXISTS `stock_out_history`;
CREATE TABLE `stock_out_history` (
  `soh_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `date_out` date DEFAULT NULL,
  `quantity` int(40) DEFAULT NULL,
  `discount_percent` int(40) DEFAULT NULL,
  `raw_price` double(40,2) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`soh_id`),
  KEY `barcode_stock_out_history` (`b_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `barcode_stock_out_history` FOREIGN KEY (`b_id`) REFERENCES `barcode` (`b_id`),
  CONSTRAINT `stock_out_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_profile` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stock_out_history
-- ----------------------------

-- ----------------------------
-- Table structure for temp_purchase
-- ----------------------------
DROP TABLE IF EXISTS `temp_purchase`;
CREATE TABLE `temp_purchase` (
  `temp_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`temp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of temp_purchase
-- ----------------------------

-- ----------------------------
-- Table structure for user_profile
-- ----------------------------
DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE `user_profile` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(225) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `firstname` varchar(225) DEFAULT NULL,
  `lastname` varchar(225) DEFAULT NULL,
  `middlename` varchar(225) DEFAULT NULL,
  `date_register` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_profile
-- ----------------------------
INSERT INTO `user_profile` VALUES ('1', 'admin', 'de41b7fb99201d8334c23c014db35ecd92df81bc', 'Admin', '', null, '2015-09-03', 'user1-128x128.jpg');
