CREATE TABLE
    `mp_users` (
        `id` INT (11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, -- Unique identifier
        `name` VARCHAR(255) NOT NULL, -- Name with appropriate character limit
        `username` VARCHAR(50) UNIQUE NOT NULL, -- Username for login (unique)
        `password` VARCHAR(255) NOT NULL, -- Password (hashed securely)
        `profile` TEXT, -- Profile details (consider JSON or dedicated table)
        `photo` VARCHAR(255), -- Photo URL/path (optional)
        `status` TINYINT (1) NOT NULL DEFAULT '0', -- User status (e.g., active = 1, inactive = 0)
        `last_login` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, -- Last login timestamp
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Creation timestamp with auto-updating on update
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8_general_ci;

INSERT INTO
    `mp_users` (
        `id`,
        `name`,
        `username`,
        `password`,
        `profile`,
        `photo`,
        `status`,
        `last_login`,
        `created_at`
    )
VALUES
    (
        NULL,
        'Super Admin',
        'admin',
        '123456',
        '',
        '',
        '0',
        current_timestamp(),
        current_timestamp()
    );

CREATE TABLE
    `mp_categories` (
        `id` int (11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `category` text NOT NULL,
        `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

CREATE TABLE
    `mp_products` (
        `id` int (11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `idCategory` int (11) NOT NULL,
        `code` text NOT NULL,
        `description` text NOT NULL,
        `image` text NOT NULL,
        `stock` int (11) NOT NULL,
        `buyingPrice` float NOT NULL,
        `sellingPrice` float NOT NULL,
        `sales` int (11) NOT NULL,
        `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

CREATE TABLE
    `mp_customers` (
        `id` int (11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `name` text NOT NULL,
        `idDocument` int (11) NOT NULL,
        `email` text NOT NULL,
        `phone` text NOT NULL,
        `address` text NOT NULL,
        `birthdate` date NOT NULL,
        `purchases` int (11) NOT NULL DEFAULT '0',
        `registerDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );