CREATE TABLE `users` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `username` varchar(50) NOT NULL,
                         `password` varchar(255) NOT NULL,
                         `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
                         PRIMARY KEY (`id`)
);

CREATE TABLE `products` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(100) NOT NULL,
                            `price` decimal(10,2) NOT NULL,
                            PRIMARY KEY (`id`)
);

CREATE TABLE `cart` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `user_id` int(11) NOT NULL,
                        `product_id` int(11) NOT NULL,
                        PRIMARY KEY (`id`),
                        FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
                        FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
);
