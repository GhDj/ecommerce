CREATE TABLE `ecommerce`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `fname` VARCHAR(255) NOT NULL , `lname` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `role` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;
CREATE TABLE `ecommerce`.`produits` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `ref` VARCHAR(255) NOT NULL , `prix` INT NOT NULL , `description` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;
CREATE TABLE `ecommerce`.`categories` ( `id` INT NOT NULL AUTO_INCREMENT , `nom` VARCHAR(255) NOT NULL , `description` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;

ALTER TABLE `produits` ADD `image` VARCHAR(255) NOT NULL AFTER `description`;

