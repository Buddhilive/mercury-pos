CREATE TABLE
    `mp_users` (
        `id` INT (11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL,
        `username` VARCHAR(50) UNIQUE NOT NULL,
        `password` VARCHAR(255) NOT NULL,
        `profile` TEXT,
        `photo` VARCHAR(255),
        `status` TINYINT (1) NOT NULL DEFAULT '0',
        `last_login` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

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
        '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly',
        'administrator',
        '',
        '1',
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

CREATE TABLE
    `mp_sales` (
        `id` int (11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `code` int (11) NOT NULL,
        `idCustomer` int (11) NOT NULL,
        `idSeller` int (11) NOT NULL,
        `products` text NOT NULL,
        `tax` int (11) NOT NULL,
        `netPrice` float NOT NULL,
        `totalPrice` float NOT NULL,
        `paymentMethod` text NOT NULL,
        `saledate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );