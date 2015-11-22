CREATE TABLE IF NOT EXISTS `query_logs` (
  `id` int(11) NOT NULL,
  `ip` bigint(20) NOT NULL,
  `hostname` varchar(125) NOT NULL,
  `wpad` blob NOT NULL,
  `var_server` blob NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER TABLE `query_logs` ADD PRIMARY KEY (`id`);

CREATE TABLE IF NOT EXISTS `wpads` (
  `id` int(11) NOT NULL,
  `name` varchar(125) NOT NULL,
  `ip` bigint(25) NOT NULL,
  `mask` int(2) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `content` blob NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

ALTER TABLE `wpads` ADD PRIMARY KEY (`id`);

INSERT INTO `wpads` (`id`, `name`, `ip`, `mask`, `is_active`, `content`, `modified`) VALUES
(1, 'Default', 0, 0, 1, 0x66756e6374696f6e2046696e6450726f7879466f7255524c2875726c2c20686f737429207b0d0a0972657475726e2022444952454354223b0d0a7d, CURRENT_TIMESTAMP);




