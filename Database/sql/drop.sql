# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases V8.1.2                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          vec.dez                                         #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database drop script                            #
# Created on:            2015-08-14 15:44                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Drop foreign key constraints                                           #
# ---------------------------------------------------------------------- #

ALTER TABLE `barcode` DROP FOREIGN KEY `prod_profile_barcode`;

ALTER TABLE `stock_in_history` DROP FOREIGN KEY `user_profile_stock_in_history`;

ALTER TABLE `stock_in_history` DROP FOREIGN KEY `barcode_stock_in_history`;

ALTER TABLE `stock_out_history` DROP FOREIGN KEY `user_profile_stock_out_history`;

ALTER TABLE `stock_out_history` DROP FOREIGN KEY `barcode_stock_out_history`;

ALTER TABLE `price` DROP FOREIGN KEY `barcode_price`;

ALTER TABLE `log_history` DROP FOREIGN KEY `user_profile_log_history`;

ALTER TABLE `prod_total_quantity` DROP FOREIGN KEY `barcode_prod_total_quantity`;

ALTER TABLE `reserve` DROP FOREIGN KEY `barcode_reserve`;

# ---------------------------------------------------------------------- #
# Drop table "reserve"                                                   #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `reserve` MODIFY `res_id` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `reserve` DROP PRIMARY KEY;

DROP TABLE `reserve`;

# ---------------------------------------------------------------------- #
# Drop table "prod_total_quantity"                                       #
# ---------------------------------------------------------------------- #

# Drop constraints #

ALTER TABLE `prod_total_quantity` DROP PRIMARY KEY;

DROP TABLE `prod_total_quantity`;

# ---------------------------------------------------------------------- #
# Drop table "price"                                                     #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `price` MODIFY `price_id` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `price` DROP PRIMARY KEY;

DROP TABLE `price`;

# ---------------------------------------------------------------------- #
# Drop table "stock_out_history"                                         #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `stock_out_history` MODIFY `soh_id` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `stock_out_history` DROP PRIMARY KEY;

DROP TABLE `stock_out_history`;

# ---------------------------------------------------------------------- #
# Drop table "stock_in_history"                                          #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `stock_in_history` MODIFY `sih_id` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `stock_in_history` DROP PRIMARY KEY;

DROP TABLE `stock_in_history`;

# ---------------------------------------------------------------------- #
# Drop table "barcode"                                                   #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `barcode` MODIFY `b_id` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `barcode` DROP PRIMARY KEY;

DROP TABLE `barcode`;

# ---------------------------------------------------------------------- #
# Drop table "prod_profile"                                              #
# ---------------------------------------------------------------------- #

# Drop constraints #

ALTER TABLE `prod_profile` DROP PRIMARY KEY;

DROP TABLE `prod_profile`;

# ---------------------------------------------------------------------- #
# Drop table "log_history"                                               #
# ---------------------------------------------------------------------- #

# Drop constraints #

ALTER TABLE `log_history` DROP PRIMARY KEY;

DROP TABLE `log_history`;

# ---------------------------------------------------------------------- #
# Drop table "user_profile"                                              #
# ---------------------------------------------------------------------- #

# Drop constraints #

ALTER TABLE `user_profile` DROP PRIMARY KEY;

DROP TABLE `user_profile`;
