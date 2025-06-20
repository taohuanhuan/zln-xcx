CREATE TABLE `yly_badge` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '徽章名称',
  `description` varchar(255) DEFAULT '' COMMENT '描述',
  `icon` varchar(255) DEFAULT '' COMMENT '图标',
  `createtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `yly_user_badge` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL COMMENT '用户ID',
  `badge_id` int unsigned NOT NULL COMMENT '徽章ID',
  `mood` varchar(255) DEFAULT '' COMMENT '领取时心情',
  `get_time` datetime DEFAULT NULL COMMENT '获取时间',
  `createtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_user_badge` (`user_id`,`badge_id`),
  KEY `idx_user` (`user_id`),
  KEY `idx_badge` (`badge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
