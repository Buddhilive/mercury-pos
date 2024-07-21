CREATE TABLE `mp_users` (
  `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier
  `name` VARCHAR(255) NOT NULL,                       -- Name with appropriate character limit
  `username` VARCHAR(50) UNIQUE NOT NULL,             -- Username for login (unique)
  `password` VARCHAR(255) NOT NULL,                       -- Password (hashed securely)
  `profile` TEXT,                                        -- Profile details (consider JSON or dedicated table)
  `photo` VARCHAR(255),                                 -- Photo URL/path (optional)
  `status` TINYINT(1) NOT NULL DEFAULT '0',             -- User status (e.g., active = 1, inactive = 0)
  `last_login` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, -- Last login timestamp
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  -- Creation timestamp with auto-updating on update
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
