CREATE TABLE ft_table (id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL, login VARCHAR(8) NOT NULL, `group` ENUM('staff', 'student', 'other') NOT NULL, creation_date DATE NOT NULL);
