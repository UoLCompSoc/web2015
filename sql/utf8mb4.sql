USE compsoc;

ALTER DATABASE compsoc CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

ALTER TABLE `point_types` CONVERT TO utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE `users` CONVERT TO utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE `transactions` CONVERT TO utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE `campaigns` CONVERT TO utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE `clothing_sizes` CONVERT TO utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE `orders` CONVERT TO utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE `batch_mails` CONVERT TO utf8mb4 COLLATE utf8mb4_unicode_ci;
