CREATE TABLE `Student`(
    `Roll_Number` VARCHAR(255) NOT NULL,
    `Student_Name` VARCHAR(255) NOT NULL,
    `Student_email` VARCHAR(255) NOT NULL,
    `Student_phone` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `DoB` DATE NOT NULL,
    `Batch` INT NOT NULL,
    `degree` VARCHAR(255) NOT NULL,
    `Branch` VARCHAR(255) NOT NULL,
    `area_of_interest` VARCHAR(200) NOT NULL,
    `marks_10` DOUBLE(8, 2) NOT NULL,
    `marks_12` DOUBLE(8, 2) NOT NULL,
    `sem1_spi` DOUBLE(8, 2) NOT NULL,
    `sem2_spi` DOUBLE(8, 2) NOT NULL,
    `sem3_spi` DOUBLE(8, 2) NOT NULL,
    `sem4_spi` DOUBLE(8, 2) NOT NULL,
    `sem5_spi` DOUBLE(8, 2) NULL,
    `sem6_spi` DOUBLE(8, 2) NULL,
    `sem7_spi` DOUBLE(8, 2) NULL,
    `sem8_spi` DOUBLE(8, 2) NULL,
    `placed_company` VARCHAR(255) NULL,
    `current_ctc` BIGINT NULL
);
ALTER TABLE
    `Student` ADD PRIMARY KEY(`Roll_Number`);
ALTER TABLE
    `Student` ADD UNIQUE `student_student_email_unique`(`Student_email`);
ALTER TABLE
    `Student` ADD UNIQUE `student_student_phone_unique`(`Student_phone`);
CREATE TABLE `Alumni`(
    `Roll_Number` VARCHAR(255) NOT NULL,
    `Alumni_Name` VARCHAR(255) NOT NULL,
    `Alumni_email` VARCHAR(255) NOT NULL,
    `Alumni_phone` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `DoB` DATE NOT NULL,
    `Batch` INT NOT NULL,
    `degree` VARCHAR(255) NOT NULL,
    `Branch` VARCHAR(255) NOT NULL,
    `area_of_interest` VARCHAR(200) NOT NULL,
    `marks_10` DOUBLE(8, 2) NOT NULL,
    `marks_12` DOUBLE(8, 2) NOT NULL,
    `sem1_spi` DOUBLE(8, 2) NOT NULL,
    `sem2_spi` DOUBLE(8, 2) NOT NULL,
    `sem3_spi` DOUBLE(8, 2) NOT NULL,
    `sem4_spi` DOUBLE(8, 2) NOT NULL,
    `sem5_spi` DOUBLE(8, 2) NULL,
    `sem6_spi` DOUBLE(8, 2) NULL,
    `sem7_spi` DOUBLE(8, 2) NULL,
    `sem8_spi` DOUBLE(8, 2) NULL,
    `placed_company` VARCHAR(255) NULL,
    `current_ctc` BIGINT NULL
);
ALTER TABLE
    `Alumni` ADD PRIMARY KEY(`Roll_Number`);
ALTER TABLE
    `Alumni` ADD UNIQUE `alumni_alumni_email_unique`(`Alumni_email`);
ALTER TABLE
    `Alumni` ADD UNIQUE `alumni_alumni_phone_unique`(`Alumni_phone`);
CREATE TABLE `users`(
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `users` ADD PRIMARY KEY(`username`);
CREATE TABLE `Offers`(
    `stud_roll_number` VARCHAR(255) NOT NULL,
    `role_id` BIGINT NOT NULL
);
CREATE TABLE `Roles`(
    `id` BIGINT NOT NULL,
    `company_name` VARCHAR(255) NOT NULL,
    `Role` VARCHAR(255) NOT NULL,
    `min_cpi` DOUBLE(8, 2) NOT NULL,
    `min_qualification` VARCHAR(255) NOT NULL,
    `description` VARCHAR(200) NOT NULL,
    `mode_of_interview` BIGINT NOT NULL,
    `ctc` BIGINT NOT NULL,
    `Sector` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `Roles` ADD PRIMARY KEY(`id`);
CREATE TABLE `Company`(
    `username` VARCHAR(255) NOT NULL,
    `company_name` VARCHAR(255) NOT NULL,
    `company_email` VARCHAR(255) NOT NULL,
    `hiring_since_when` BIGINT NOT NULL
);
ALTER TABLE
    `Company` ADD PRIMARY KEY(`company_name`);
ALTER TABLE
    `Company` ADD UNIQUE `company_company_email_unique`(`company_email`);
ALTER TABLE
    `Alumni` ADD CONSTRAINT `alumni_username_foreign` FOREIGN KEY(`username`) REFERENCES `users`(`username`);
ALTER TABLE
    `Offers` ADD CONSTRAINT `offers_stud_roll_number_foreign` FOREIGN KEY(`stud_roll_number`) REFERENCES `Student`(`Roll_Number`);
ALTER TABLE
    `Offers` ADD CONSTRAINT `offers_role_id_foreign` FOREIGN KEY(`role_id`) REFERENCES `Roles`(`id`);
ALTER TABLE
    `Roles` ADD CONSTRAINT `roles_company_name_foreign` FOREIGN KEY(`company_name`) REFERENCES `Company`(`company_name`);
ALTER TABLE
    `Student` ADD CONSTRAINT `student_username_foreign` FOREIGN KEY(`username`) REFERENCES `users`(`username`);
ALTER TABLE
    `Company` ADD CONSTRAINT `company_username_foreign` FOREIGN KEY(`username`) REFERENCES `users`(`username`);