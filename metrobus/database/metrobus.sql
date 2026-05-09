SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `event_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `events` (`id`, `title`, `category`, `description`, `event_date`) VALUES
(1, 'MetroBus Day', 'MetroBus', 'Celebrate public transport.', '2026-06-01'),
(2, 'Community Outreach', 'Community', 'Free rides for seniors.', '2026-05-15'),
(3, 'City Transport Summit', 'City of Johannesburg', 'Annual transport conference.', '2026-07-10'),
(4, 'Senior Citizen Registration Week', 'Community', 'A dedicated week for seniors to register for their free off-peak travel smart cards at the Braamfontein depot.', '2026-05-20'),
(5, 'Soweto Derby Transport Plan', 'City of Johannesburg', 'Coordinated park-and-ride transport solutions for the upcoming Soweto Derby at FNB Stadium.', '2026-08-01'),
(6, 'Smart Card Rollout', 'MetroBus', 'Phase 2 of our new tap-and-go smart card system goes live for the Sandton and Rosebank routes.', '2026-06-01');

CREATE TABLE `fares` (
  `id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `fares` (`id`, `route_id`, `price`, `discount_info`) VALUES
(1, 1, 25.00, 'Student discount: 20%'),
(2, 2, 30.00, 'Pensioner discount: 50%'),
(3, 3, 20.00, 'No discount'),
(4, 1, 22.50, 'Standard Zone 1 pricing applies.'),
(5, 2, 28.00, 'Standard Zone 2 pricing applies.'),
(6, 3, 35.50, 'Zone 3 pricing. Heavy traffic route.'),
(7, 4, 25.00, 'Standard Zone 1 pricing applies.'),
(8, 5, 30.00, 'Zone 2 cross-city pricing.'),
(9, 6, 40.00, 'Zone 3 long-distance pricing.'),
(10, 7, 35.00, 'Zone 3 pricing applies.');

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `category` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `feedback` (`id`, `name`, `email`, `rating`, `category`, `message`, `created_at`) VALUES
(1, 'Jane Smith', 'jane@example.com', 4, 'Service', 'Good service overall.', '2026-05-07 04:14:00'),
(2, 'Anonymous', '', 4, 'App', 'We like this app', '2026-05-07 16:04:40'),
(3, 'John Doe', 'john@example.com', 5, 'Routes', 'Excellent route coverage.', '2026-05-08 10:30:00');

CREATE TABLE `live_status` (
  `id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `status` enum('on_time','delayed','cancelled') DEFAULT 'on_time',
  `delay_minutes` int(11) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `live_status` (`id`, `route_id`, `status`, `delay_minutes`, `updated_at`) VALUES
(1, 1, 'on_time', 0, '2026-05-07 04:14:00'),
(2, 2, 'delayed', 5, '2026-05-07 04:14:00'),
(3, 3, 'cancelled', 0, '2026-05-07 04:14:00'),
(4, 1, 'on_time', 0, '2026-05-09 22:24:15'),
(5, 2, 'on_time', 0, '2026-05-09 22:24:15'),
(6, 3, 'delayed', 15, '2026-05-09 22:24:15'),
(7, 4, 'on_time', 0, '2026-05-09 22:24:15'),
(8, 5, 'on_time', 0, '2026-05-09 22:24:15'),
(9, 6, 'cancelled', NULL, '2026-05-09 22:24:15'),
(10, 7, 'on_time', 0, '2026-05-09 22:24:15');

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` enum('Service Update','Maintenance','Alert') DEFAULT 'Service Update',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `notices` (`id`, `title`, `content`, `category`, `created_at`) VALUES
(1, 'Route 5 Detour', 'Due to emergency roadworks in Sandton, Route 5 will be diverted via Grayston Drive until further notice. Expect minor delays.', 'Service Update', '2026-05-09 22:59:55'),
(2, 'System Maintenance', 'Our ticketing system will undergo scheduled maintenance tonight from 12:00 AM to 02:00 AM. Online reloads will be unavailable.', 'Maintenance', '2026-05-09 22:59:55'),
(3, 'Meeting at the boardroom', 'urgent alert to all the board members', 'Alert', '2026-05-09 23:05:32');

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `route_name` varchar(255) NOT NULL,
  `start_point` varchar(255) NOT NULL,
  `end_point` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `routes` (`id`, `route_name`, `start_point`, `end_point`, `status`) VALUES
(1, 'Route 1', 'Sandton', 'Johannesburg CBD', 'active'),
(2, 'Route 2', 'Rosebank', 'Midrand', 'active'),
(3, 'Route 3', 'Braamfontein', 'Soweto', 'active'),
(4, 'Route 4', 'Pretoria', 'Johannesburg CBD', 'active'),
(5, 'Route 81', 'Faraday', 'Randburg', 'active'),
(6, 'Route 122', 'Joburg CBD', 'Roodepoort', ''),
(7, 'Route 30', 'Gandhi Square', 'Fourways', 'active');

CREATE TABLE `stops` (
  `id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `stop_name` varchar(255) NOT NULL,
  `stop_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `stops` (`id`, `route_id`, `stop_name`, `stop_order`) VALUES
(1, 1, 'Sandton Station', 1),
(2, 1, 'Rosebank Mall', 2),
(3, 1, 'Johannesburg Station', 3),
(4, 2, 'Rosebank Station', 1),
(5, 2, 'Midrand Station', 2),
(6, 3, 'Braamfontein Station', 1),
(7, 3, 'Soweto Station', 2),
(8, 4, 'Pretoria Station', 1),
(9, 4, 'Johannesburg Station', 2),
(10, 1, 'Gandhi Square', 1),
(11, 1, 'Braamfontein', 2),
(12, 1, 'Rosebank', 3),
(13, 1, 'Sandton City', 4),
(14, 2, 'Gandhi Square', 1),
(15, 2, 'Booysens', 2),
(16, 2, 'Mondeor', 3),
(17, 2, 'Southgate Mall', 4),
(18, 3, 'Gandhi Square', 1),
(19, 3, 'Parktown', 2),
(20, 3, 'Rivonia', 3),
(21, 3, 'Sunninghill', 4),
(22, 4, 'Gandhi Square', 1),
(23, 4, 'Bez Valley', 2),
(24, 4, 'Eastgate', 3);

CREATE TABLE `timetables` (
  `id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_time` time NOT NULL,
  `day_type` enum('weekday','weekend','holiday') DEFAULT 'weekday'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `timetables` (`id`, `route_id`, `departure_time`, `arrival_time`, `day_type`) VALUES
(1, 1, '06:00:00', '07:00:00', 'weekday'),
(2, 1, '07:00:00', '08:00:00', 'weekday'),
(3, 1, '08:00:00', '09:00:00', 'weekday'),
(4, 2, '06:30:00', '07:30:00', 'weekday'),
(5, 2, '07:30:00', '08:30:00', 'weekday'),
(6, 3, '07:00:00', '08:00:00', 'weekday'),
(7, 4, '05:00:00', '06:30:00', 'weekday'),
(8, 1, '06:00:00', '07:15:00', 'weekday'),
(9, 1, '08:00:00', '09:15:00', 'weekday'),
(10, 1, '16:30:00', '17:45:00', 'weekday'),
(11, 2, '06:30:00', '07:30:00', 'weekday'),
(12, 2, '17:00:00', '18:00:00', 'weekday'),
(13, 3, '07:00:00', '08:30:00', 'weekday'),
(14, 4, '06:15:00', '06:45:00', 'weekday'),
(15, 5, '06:00:00', '07:00:00', 'weekday'),
(16, 7, '06:45:00', '08:00:00', 'weekday');

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(4, 'Admin1234', 'Admin1234@gmail.com', '$2y$10$Ajw.wNBybWuHXMnb7.E.geaOp.PPcU85I5/k.WR.cQqmTHrvTQWpy', 'admin', '2026-05-09 22:32:08'),
(5, 'test1234', 'test1234@gmail.com', '$2y$10$nuNBHnUagdnuKXeriO9UP.jU/xn5nCWavKdlRKpBXJDgk9b9Mh2r2', 'user', '2026-05-09 22:36:03');

ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `fares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `route_id` (`route_id`);

ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `live_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `route_id` (`route_id`);

ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `stops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `route_id` (`route_id`);

ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `route_id` (`route_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `fares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `live_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `stops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `timetables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `fares`
  ADD CONSTRAINT `fares_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE;

ALTER TABLE `live_status`
  ADD CONSTRAINT `live_status_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE;

ALTER TABLE `stops`
  ADD CONSTRAINT `stops_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE;

ALTER TABLE `timetables`
  ADD CONSTRAINT `timetables_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE;
COMMIT;