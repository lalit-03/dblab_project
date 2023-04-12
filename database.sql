CREATE TABLE `Student`(
    `username` VARCHAR(255) NOT NULL,
    `RollNumber` VARCHAR(255) NOT NULL,
    `student_name` VARCHAR(255) NOT NULL,
    `student_phone` VARCHAR(255) NOT NULL,
    `student_email` VARCHAR(255) NOT NULL,
    `DoB` DATE NOT NULL,
    `Batch` BIGINT NOT NULL,
    `degree` VARCHAR(255) NOT NULL,
    `branch` VARCHAR(255) NOT NULL,
    `marks_10` DOUBLE NOT NULL,
    `marks_12` DOUBLE(8, 2) NOT NULL,
    `sem1_spi` DOUBLE(8, 2) NOT NULL,
    `sem2_spi` DOUBLE(8, 2) NOT NULL,
    `sem3_spi` DOUBLE(8, 2) NOT NULL,
    `sem4_spi` DOUBLE(8, 2) NOT NULL,
    `sem5_spi` DOUBLE(8, 2) NOT NULL,
    `sem6_spi` DOUBLE(8, 2) NOT NULL,
    `sem7_spi` DOUBLE(8, 2) NOT NULL,
    `sem8_spi` DOUBLE(8, 2) NOT NULL,
    `placed_company` VARCHAR(255) NOT NULL,
    `ctc` BIGINT NOT NULL,
    `password` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `Student` ADD PRIMARY KEY(`username`);
ALTER TABLE
    `Student` ADD UNIQUE `student_rollnumber_unique`(`RollNumber`);
ALTER TABLE
    `Student` ADD UNIQUE `student_student_email_unique`(`student_email`);
CREATE TABLE `Alumni`(
    `username` VARCHAR(255) NOT NULL,
    `RollNumber` VARCHAR(255) NOT NULL,
    `alumni_name` VARCHAR(255) NOT NULL,
    `alumni_phone` VARCHAR(255) NOT NULL,
    `alumni_email` VARCHAR(255) NOT NULL,
    `DoB` DATE NOT NULL,
    `batch` BIGINT NOT NULL,
    `degree` VARCHAR(255) NOT NULL,
    `branch` VARCHAR(255) NOT NULL,
    `marks_10` DOUBLE(8, 2) NOT NULL,
    `marks_12` DOUBLE(8, 2) NOT NULL,
    `sem1_spi` DOUBLE(8, 2) NOT NULL,
    `sem2_spi` DOUBLE(8, 2) NOT NULL,
    `sem3_spi` DOUBLE(8, 2) NOT NULL,
    `sem4_spi` DOUBLE(8, 2) NOT NULL,
    `sem5_spi` DOUBLE(8, 2) NOT NULL,
    `sem6_spi` DOUBLE(8, 2) NOT NULL,
    `sem7_spi` DOUBLE(8, 2) NOT NULL,
    `sem8_spi` DOUBLE(8, 2) NOT NULL,
    `placed_company` VARCHAR(255) NOT NULL,
    `ctc` BIGINT NOT NULL,
    `password` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `Alumni` ADD PRIMARY KEY(`username`);
ALTER TABLE
    `Alumni` ADD UNIQUE `alumni_rollnumber_unique`(`RollNumber`);
ALTER TABLE
    `Alumni` ADD UNIQUE `alumni_alumni_email_unique`(`alumni_email`);
CREATE TABLE `Company`(
    `company_username` VARCHAR(255) NOT NULL,
    `company_name` VARCHAR(255) NOT NULL,
    `company_email` VARCHAR(255) NOT NULL,
    `hiring_since_when` BIGINT NOT NULL
);
ALTER TABLE
    `Company` ADD PRIMARY KEY(`company_username`);
ALTER TABLE
    `Company` ADD UNIQUE `company_company_name_unique`(`company_name`);
ALTER TABLE
    `Company` ADD UNIQUE `company_company_email_unique`(`company_email`);
CREATE TABLE `admin`(
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `admin` ADD PRIMARY KEY(`username`);
CREATE TABLE `Offers`(
    `id` BIGINT NOT NULL,
    `stud_roll_number` VARCHAR(255) NOT NULL,
    `role_id` BIGINT NOT NULL,
    `selected` BIGINT NOT NULL
);
ALTER TABLE
    `Offers` ADD PRIMARY KEY(`id`);
CREATE TABLE `Roles`(
    `id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `company_username` VARCHAR(255) NOT NULL,
    `Role_Name` VARCHAR(255) NOT NULL,
    `min_cpi` DOUBLE(8, 2) NOT NULL,
    `min_qualification` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `mode_of_interview` BIGINT NOT NULL,
    `ctc` BIGINT NOT NULL,
    `Sector` VARCHAR(255) NOT NULL
);
-- ALTER TABLE
--     `Roles` ADD PRIMARY KEY(`id`);
ALTER TABLE
    `Offers` ADD CONSTRAINT `offers_stud_roll_number_foreign` FOREIGN KEY(`stud_roll_number`) REFERENCES `Student`(`RollNumber`);
ALTER TABLE
    `Roles` ADD CONSTRAINT `roles_company_username_foreign` FOREIGN KEY(`company_username`) REFERENCES `Company`(`company_username`);
ALTER TABLE
    `Offers` ADD CONSTRAINT `offers_role_id_foreign` FOREIGN KEY(`role_id`) REFERENCES `Roles`(`id`);