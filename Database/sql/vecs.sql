# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases V8.1.2                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          vec.dez                                         #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database creation script                        #
# Created on:            2015-08-14 15:44                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Add tables                                                             #
# ---------------------------------------------------------------------- #

# ---------------------------------------------------------------------- #
# Add table "user_profile"                                               #
# ---------------------------------------------------------------------- #

CREATE TABLE `user_profile` (
    `user_id` INTEGER NOT NULL,
    `username` VARCHAR(225),
    `password` VARCHAR(225),
    `fisrtname` VARCHAR(225),
    `lastname` VARCHAR(225),
    `middlename` VARCHAR(225),
    `date_register` DATE,
    CONSTRAINT `PK_user_profile` PRIMARY KEY (`user_id`)
);

# ---------------------------------------------------------------------- #
# Add table "log_history"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE `log_history` (
    `lh_id` INTEGER NOT NULL,
    `user_id` INTEGER NOT NULL,
    `date_login` DATE NOT NULL,
    `date_log-out` DATE NOT NULL,
    CONSTRAINT `PK_log_history` PRIMARY KEY (`lh_id`)
);

# ---------------------------------------------------------------------- #
# Add table "prod_profile"                                               #
# ---------------------------------------------------------------------- #

CREATE TABLE `prod_profile` (
    `prod_id` INTEGER NOT NULL,
    `name` VARCHAR(40),
    `model_no` VARCHAR(40),
    `supplier` VARCHAR(40),
    `expiration_date` DATE,
    CONSTRAINT `PK_prod_profile` PRIMARY KEY (`prod_id`)
);

# ---------------------------------------------------------------------- #
# Add table "barcode"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE `barcode` (
    `b_id` INTEGER NOT NULL AUTO_INCREMENT,
    `prod_id` INTEGER NOT NULL,
    `barcode` VARCHAR(150),
    CONSTRAINT `PK_barcode` PRIMARY KEY (`b_id`)
);

# ---------------------------------------------------------------------- #
# Add table "stock_in_history"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE `stock_in_history` (
    `sih_id` INTEGER NOT NULL AUTO_INCREMENT,
    `date_in` DATE,
    `quantity` VARCHAR(40),
    `b_id` INTEGER NOT NULL,
    `user_id` INTEGER NOT NULL,
    CONSTRAINT `PK_stock_in_history` PRIMARY KEY (`sih_id`)
);

# ---------------------------------------------------------------------- #
# Add table "stock_out_history"                                          #
# ---------------------------------------------------------------------- #

CREATE TABLE `stock_out_history` (
    `soh_id` INTEGER NOT NULL AUTO_INCREMENT,
    `b_id` INTEGER NOT NULL,
    `date_out` DATE,
    `quantity` VARCHAR(40),
    `discount_percent` VARCHAR(40),
    `raw_price` VARCHAR(40),
    `user_id` INTEGER NOT NULL,
    CONSTRAINT `PK_stock_out_history` PRIMARY KEY (`soh_id`)
);

# ---------------------------------------------------------------------- #
# Add table "price"                                                      #
# ---------------------------------------------------------------------- #

CREATE TABLE `price` (
    `price_id` INTEGER NOT NULL AUTO_INCREMENT,
    `price` VARCHAR(40),
    `b_id` INTEGER NOT NULL,
    CONSTRAINT `PK_price` PRIMARY KEY (`price_id`)
);

# ---------------------------------------------------------------------- #
# Add table "prod_total_quantity"                                        #
# ---------------------------------------------------------------------- #

CREATE TABLE `prod_total_quantity` (
    `ptq_id` INTEGER NOT NULL,
    `b_id` INTEGER NOT NULL,
    `quantity` VARCHAR(40),
    CONSTRAINT `PK_prod_total_quantity` PRIMARY KEY (`ptq_id`)
);

# ---------------------------------------------------------------------- #
# Add table "reserve"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE `reserve` (
    `res_id` INTEGER NOT NULL AUTO_INCREMENT,
    `b_id` INTEGER NOT NULL,
    `date_res` VARCHAR(40),
    `status` VARCHAR(40),
    CONSTRAINT `PK_reserve` PRIMARY KEY (`res_id`)
);

# ---------------------------------------------------------------------- #
# Add foreign key constraints                                            #
# ---------------------------------------------------------------------- #

ALTER TABLE `barcode` ADD CONSTRAINT `prod_profile_barcode` 
    FOREIGN KEY (`prod_id`) REFERENCES `prod_profile` (`prod_id`);

ALTER TABLE `stock_in_history` ADD CONSTRAINT `user_profile_stock_in_history` 
    FOREIGN KEY (`user_id`) REFERENCES `user_profile` (`user_id`);

ALTER TABLE `stock_in_history` ADD CONSTRAINT `barcode_stock_in_history` 
    FOREIGN KEY (`b_id`) REFERENCES `barcode` (`b_id`);

ALTER TABLE `stock_out_history` ADD CONSTRAINT `user_profile_stock_out_history` 
    FOREIGN KEY (`user_id`) REFERENCES `user_profile` (`user_id`);

ALTER TABLE `stock_out_history` ADD CONSTRAINT `barcode_stock_out_history` 
    FOREIGN KEY (`b_id`) REFERENCES `barcode` (`b_id`);

ALTER TABLE `price` ADD CONSTRAINT `barcode_price` 
    FOREIGN KEY (`b_id`) REFERENCES `barcode` (`b_id`);

ALTER TABLE `log_history` ADD CONSTRAINT `user_profile_log_history` 
    FOREIGN KEY (`user_id`) REFERENCES `user_profile` (`user_id`);

ALTER TABLE `prod_total_quantity` ADD CONSTRAINT `barcode_prod_total_quantity` 
    FOREIGN KEY (`b_id`) REFERENCES `barcode` (`b_id`);

ALTER TABLE `reserve` ADD CONSTRAINT `barcode_reserve` 
    FOREIGN KEY (`b_id`) REFERENCES `barcode` (`b_id`);
