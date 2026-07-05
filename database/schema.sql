-- Schema for Zfinances app
CREATE DATABASE IF NOT EXISTS zfinance;
USE zfinance;

-- Contacts from contact form
CREATE TABLE IF NOT EXISTS contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  telephone VARCHAR(50),
  sujet VARCHAR(150) NOT NULL,
  message TEXT NOT NULL,
  statut ENUM('lu','non_lu') DEFAULT 'non_lu',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Newsletter subscribers
CREATE TABLE IF NOT EXISTS subscribers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL UNIQUE,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Testimonials managed by admin
CREATE TABLE IF NOT EXISTS testimonials (
  id INT AUTO_INCREMENT PRIMARY KEY,
  author VARCHAR(255) NOT NULL,
  company VARCHAR(255),
  message TEXT NOT NULL,
  rating TINYINT NOT NULL DEFAULT 5,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

create table if not exists admin(
  id int AUTO_INCREMENT primary key ,
  nameAdmin VARCHAR(30) not null unique,
  passAdmin VARCHAR(25) not null,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE Table if not exists articles(
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT,
    image TEXT,
    link TEXT
);

insert ignore into admin(nameAdmin,passAdmin) values("admin","admin123");
