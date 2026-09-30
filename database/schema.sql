CREATE DATABASE IF NOT EXISTS zfinance;
USE zfinance;

CREATE TABLE IF NOT EXISTS contacts (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(50),
  `sujet` VARCHAR(150) NOT NULL,
  `message` TEXT NOT NULL,
  `statut` ENUM('lu','non_lu') DEFAULT 'non_lu',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Newsletter subscribers
CREATE TABLE IF NOT EXISTS subscribers (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Testimonials managed by admin
CREATE TABLE IF NOT EXISTS testimonials (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `author` VARCHAR(255) NOT NULL,
  `company` VARCHAR(255),
  `message` TEXT NOT NULL,
  `rating` TINYINT NOT NULL DEFAULT 5,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS roles(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(30) NOT NULL UNIQUE
);
-- Users table
CREATE TABLE IF NOT EXISTS users(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `role_id` INT DEFAULT 1, 
  `name` VARCHAR(30) NOT NULL,
  `email` VARCHAR(50) NOT NULL UNIQUE,
  `pass` VARCHAR(255) NOT NULL,
  `created_at` DATETIME  DEFAULT CURRENT_TIMESTAMP,

   CONSTRAINT fk_role FOREIGN KEY (role_id) REFERENCES roles(`id`) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE
);

-- Categories (avant articles pour la FK)
CREATE TABLE IF NOT EXISTS categories (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Articles table (contenu portfolio / blog)
CREATE TABLE IF NOT EXISTS articles (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT NULL,
  `status` ENUM('pending', 'published') NOT NULL DEFAULT 'pending',
  `title` VARCHAR(255) NOT NULL DEFAULT '',
  `excerpt` TEXT NULL,
  `user_id` INT NULL,
  `content` TEXT,
  `image` TEXT,
  `link` TEXT,
  `sort_order` INT NOT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_category_id FOREIGN KEY (category_id) REFERENCES categories(`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE
);