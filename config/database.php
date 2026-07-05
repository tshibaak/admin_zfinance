<?php

return [
  'DB_USER' => $_ENV['DB_USER'] ?? 'root',
  'DB_MDP' => $_ENV['DB_MDP'] ?? 'root',
  'DB_NAME' => $_ENV['DB_NAME'] ?? 'zfinance',
  'DB_SGBD' => $_ENV['DB_SGBD'] ?? 'mysql',
  'DB_HOST' => $_ENV['DB_HOST'] ?? '127.0.0.1:3307',
];
