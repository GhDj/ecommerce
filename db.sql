CREATE TABLE `ecommerce`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `fname` VARCHAR(255) NOT NULL , `lname` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `role` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;