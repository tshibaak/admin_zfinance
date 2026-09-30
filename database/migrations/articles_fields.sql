USE `zfinance`;

-- Enrichit la table articles pour le CMS portfolio (titre, résumé, ordre, dates)
-- À exécuter une seule fois après categories.sql

ALTER TABLE `articles` ADD COLUMN `title` VARCHAR(255) NOT NULL DEFAULT '' AFTER `status`;
ALTER TABLE `articles` ADD COLUMN `excerpt` TEXT NULL AFTER `title`;
ALTER TABLE `articles` ADD COLUMN `sort_order` INT NOT NULL DEFAULT 0 AFTER `link`;
ALTER TABLE `articles` ADD COLUMN `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `sort_order`;
ALTER TABLE `articles` ADD COLUMN `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `created_at`;

-- Permet un article sans catégorie (brouillon / filtre)
ALTER TABLE `articles` MODIFY COLUMN `category_id` INT(11) NULL;

-- À la suppression d'une catégorie, conserver les articles (category_id → NULL)
ALTER TABLE `articles` DROP FOREIGN KEY `fk_category_id`;
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_category_id`
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;
