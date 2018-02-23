<?php

$sql_updates = [
    [
        'id' => 1,
        'info' => 'Drop unnecessary column',
        'date' => '06 Dec, 2017',
        'query' => 'ALTER TABLE `polls` DROP `starter_name`',
    ],
    [
        'id' => 2,
        'info' => 'Add missing FULLTEXT index for pm messages search',
        'date' => '07 Dec, 2017',
        'query' => 'ALTER TABLE `messages` ADD FULLTEXT INDEX `ft_subject` (`subject`)',
    ],
    [
        'id' => 3,
        'info' => 'Add missing FULLTEXT index for pm messages search',
        'date' => '07 Dec, 2017',
        'query' => 'ALTER TABLE `messages` ADD FULLTEXT INDEX `ft_msg` (`msg`)',
    ],
    [
        'id' => 4,
        'info' => 'Add missing FULLTEXT index for pm messages search',
        'date' => '07 Dec, 2017',
        'query' => 'ALTER TABLE `messages` ADD FULLTEXT INDEX `ft_subject_msg` (`subject`, `msg`)',
    ],
    [
        'id' => 5,
        'info' => 'Remove unnecessary column',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `database_updates` DROP COLUMN `info`',
    ],
    [
        'id' => 6,
        'info' => 'Update last_action default value',
        'date' => '10 Dec, 2017',
        'query' => 'ALTER TABLE `peers` MODIFY `last_action` INT(10) UNSIGNED NOT NULL DEFAULT 0',
    ],
    [
        'id' => 7,
        'info' => 'Update prev_action default value',
        'date' => '10 Dec, 2017',
        'query' => 'ALTER TABLE `peers` MODIFY `prev_action` INT(10) UNSIGNED NOT NULL DEFAULT 0',
    ],
    [
        'id' => 8,
        'info' => 'Add unique index on ips table',
        'date' => '11 Dec, 2017',
        'query' => 'ALTER TABLE `ips` ADD UNIQUE INDEX `ip_userid`(`ip`, `userid`)',
    ],
    [
        'id' => 9,
        'info' => 'Increase seedbonus limits',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `users` MODIFY `seedbonus` DECIMAL(20,1) NOT NULL DEFAULT 200',
    ],
    [
        'id' => 10,
        'info' => 'Set initial invites for new users to 0',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `users` MODIFY `invites` INT(10) UNSIGNED NOT NULL DEFAULT 0',
    ],
    [
        'id' => 11,
        'info' => 'Update events.startTime add default value',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `events` MODIFY `startTime` INT(10) UNSIGNED NOT NULL DEFAULT 0',
    ],
    [
        'id' => 12,
        'info' => 'Update events.endTime add default value',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `events` MODIFY `endTime` INT(10) UNSIGNED NOT NULL DEFAULT 0',
    ],
    [
        'id' => 13,
        'info' => 'Update events.displayDates add default value',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `events` MODIFY `displayDates` TINYINT(1) NOT NULL DEFAULT 0',
    ],
    [
        'id' => 14,
        'info' => 'Update invite_codes.receiver',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `invite_codes` MODIFY `receiver` INT(10) UNSIGNED NOT NULL DEFAULT 0',
    ],
    [
        'id' => 15,
        'info' => 'Update invite_codes.code',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `invite_codes` MODIFY `code` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL',
    ],
    [
        'id' => 16,
        'info' => 'Update invite_codes.invite_added',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `invite_codes` CHANGE `invite_added` `added` INT(10) UNSIGNED NOT NULL DEFAULT 0',
    ],
    [
        'id' => 17,
        'info' => 'Update invite_codes.email',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `invite_codes` MODIFY `email` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL',
    ],
    [
        'id' => 18,
        'info' => 'Drop Index',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `invite_codes` DROP INDEX `sender`',
    ],
    [
        'id' => 19,
        'info' => 'Add Index',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `invite_codes` ADD INDEX `sender`(`sender`)',
    ],
    [
        'id' => 20,
        'info' => 'Drop Index',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `invite_codes` DROP INDEX `sender_2`',
    ],
    [
        'id' => 21,
        'info' => 'Rename Table',
        'date' => '31 Dec, 2017',
        'query' => 'RENAME TABLE `password_resets` TO `tokens`',
    ],
    [
        'id' => 22,
        'info' => 'Update Collation',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `torrents` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci',
    ],
    [
        'id' => 23,
        'info' => 'Drop unnecessary table',
        'date' => '31 Dec, 2017',
        'query' => 'DROP TABLE `torrent_pass`',
    ],
    [
        'id' => 24,
        'info' => 'Update users.email',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `users` MODIFY `email` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL',
    ],
    [
        'id' => 25,
        'info' => 'Drop Index',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `tokens` DROP INDEX `password_resets_email_index`',
    ],
    [
        'id' => 26,
        'info' => 'Create Index',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `tokens` ADD INDEX `id`(`id`)',
    ],
    [
        'id' => 27,
        'info' => 'Create Index',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `tokens` ADD INDEX `email`(`email`)',
    ],
    [
        'id' => 28,
        'info' => 'Increase Column Length',
        'date' => '31 Dec, 2017',
        'query' => 'ALTER TABLE `messages` MODIFY `subject` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL',
    ],
    [
        'id' => 29,
        'info' => 'Update default value',
        'date' => '7 Jan, 2018',
        'query' => "ALTER TABLE `users` MODIFY `birthday` DATE DEFAULT '1970-01-01'",
    ],
    [
        'id' => 30,
        'info' => 'Update name',
        'date' => '10 Jan, 2018',
        'query' => "UPDATE `site_config` SET `name` = 'bonus_max_torrents' WHERE `name` = 'bonux_max_torrents'",
    ],
    [
        'id' => 31,
        'info' => 'Update name',
        'date' => '11 Jan, 2018',
        'query' => "UPDATE cleanup SET `clean_on` = 0, `clean_title` = 'Delete Torrents XBT' WHERE `clean_file` = 'delete_torrents_xbt_update.php'",
    ],
    [
        'id' => 32,
        'info' => 'Add unique index to snatched',
        'date' => '13 Jan, 2018',
        'query' => 'ALTER TABLE `snatched` ADD UNIQUE INDEX `userid_torrentid`(`userid`, `torrentid`)',
    ],
    [
        'id' => 33,
        'info' => 'Add auth column',
        'date' => '17 Jan, 2018',
        'query' => 'ALTER TABLE `users` ADD COLUMN `auth` VARCHAR(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL AFTER `torrent_pass`',
    ],
    [
        'id' => 34,
        'info' => 'Add unique index auth column',
        'date' => '17 Jan, 2018',
        'query' => 'ALTER TABLE `users` ADD UNIQUE INDEX `auth`(`auth`)',
    ],
    [
        'id' => 35,
        'info' => 'Add site_config anonymouse names',
        'date' => '17 Jan, 2018',
        'query' => 'INSERT INTO `site_config` (`name`, `value`, `description`) VALUES ("anonymous_names", "Tom Sawyer, Keyser Söze, Capt. Kirk", "A list of names, separated by a comma, used in place of \'Anonymous\'. Quotes are not necessary.")',
    ],
    [
        'id' => 36,
        'info' => 'Add Ebooks Category',
        'date' => '17 Jan, 2018',
        'query' => 'INSERT INTO `categories` (`name`, `image`, `cat_desc`, `parent_id`, `tabletype`) VALUES ("Ebooks", "cat_ebooks.png", "No Description", -1, 1)',
    ],
    [
        'id' => 37,
        'info' => 'Add Column to Categories',
        'date' => '17 Jan, 2018',
        'query' => 'ALTER TABLE `categories` ADD COLUMN `ordered` SMALLINT(6) NOT NULL DEFAULT "0"',
    ],
    [
        'id' => 38,
        'info' => 'Drop unused Column from Categories',
        'date' => '17 Jan, 2018',
        'query' => 'ALTER TABLE `categories` DROP COLUMN `parent_id`',
    ],
    [
        'id' => 39,
        'info' => 'Drop unused Column from Categories',
        'date' => '17 Jan, 2018',
        'query' => 'ALTER TABLE `categories` DROP COLUMN `tabletype`',
    ],
    [
        'id' => 40,
        'info' => 'Add ISBN column to torrents table',
        'date' => '17 Jan, 2018',
        'query' => 'ALTER TABLE `torrents` ADD COLUMN `isbn` VARCHAR(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL',
    ],
    [
        'id' => 41,
        'info' => 'Alter time value',
        'date' => '18 Jan, 2018',
        'query' => 'ALTER TABLE `wiki` MODIFY COLUMN `time` INT(10) UNSIGNED DEFAULT 0',
    ],
    [
        'id' => 42,
        'info' => 'Alter AUTH Key length',
        'date' => '18 Jan, 2018',
        'query' => 'ALTER TABLE `users` MODIFY COLUMN `auth` CHAR(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL',
    ],
    [
        'id' => 43,
        'info' => 'Alter Torrent Pass length',
        'date' => '18 Jan, 2018',
        'query' => 'ALTER TABLE `users` MODIFY COLUMN `torrent_pass` CHAR(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL',
    ],
    [
        'id' => 44,
        'info' => 'Add API Key',
        'date' => '18 Jan, 2018',
        'query' => 'ALTER TABLE `users` ADD COLUMN `apikey` CHAR(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL AFTER `auth`',
    ],
    [
        'id' => 45,
        'info' => 'DROP TABLE queries',
        'date' => '21 Jan, 2018',
        'query' => 'DROP TABLE `queries`',
    ],
    [
        'id' => 46,
        'info' => 'Remove log queries',
        'date' => '21 Jan, 2018',
        'query' => 'DELETE FROM `site_config`  WHERE `name` = "log_queries"',
    ],
    [
        'id' => 47,
        'info' => 'Remove log queries from staffpanel',
        'date' => '21 Jan, 2018',
        'query' => "DELETE FROM `staffpanel` WHERE `page_name` = 'View Mysql Queries'",
    ],
    [
        'id' => 48,
        'info' => 'Remove duplicate category',
        'date' => '23 Jan, 2018',
        'query' => "DELETE FROM `categories` WHERE `id` = 14 AND `name` = 'Music'",
    ],
    [
        'id' => 49,
        'info' => 'Rename category',
        'date' => '23 Jan, 2018',
        'query' => "UPDATE `categories` SET `name` = 'Games/Wii' WHERE `name` = 'GAMES'",
    ],
    [
        'id' => 50,
        'info' => 'Rename category',
        'date' => '23 Jan, 2018',
        'query' => "UPDATE `categories` SET `name` = 'Movies/DVD' WHERE `name` = 'Movies'",
    ],
    [
        'id' => 51,
        'info' => 'Rename category',
        'date' => '23 Jan, 2018',
        'query' => "UPDATE `categories` SET `name` = 'TV/Episodes' WHERE `name` = 'Episodes'",
    ],
    [
        'id' => 52,
        'info' => 'Rename category',
        'date' => '23 Jan, 2018',
        'query' => "UPDATE `categories` SET `name` = 'Misc' WHERE `id` = 13 AND `name` = 'Apps'",
    ],
    [
        'id' => 53,
        'info' => 'Add site config setting for image proxy',
        'date' => '24 Jan, 2018',
        'query' => "INSERT INTO `site_config` (`name`, `value`, `description`) VALUES ('image_proxy', '', 'An image proxy allows you to hotlink images through a proxy, keeping your site url out of their logs.')",
    ],
    [
        'id' => 54,
        'info' => 'Add banners to torrents',
        'date' => '25 Jan, 2018',
        'query' => 'ALTER TABLE `torrents` ADD COLUMN `banner` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL AFTER `poster`',
    ],
    [
        'id' => 55,
        'info' => 'Add background to torrents',
        'date' => '25 Jan, 2018',
        'query' => 'ALTER TABLE `torrents` ADD COLUMN `background` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL AFTER `banner`',
    ],
    [
        'id' => 56,
        'info' => 'Remove torrent thumbsup',
        'date' => '26 Jan, 2018',
        'query' => 'DROP TABLE `thumbsup`',
    ],
    [
        'id' => 57,
        'info' => 'Add TVMaze Table',
        'date' => '27 Jan, 2018',
        'query' => "CREATE TABLE `tvmaze` (
                    `tvmaze_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',
                      `tvrage_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',
                      `thetvdb_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',
                      `imdb_id` CHAR(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                      `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,                                                                                                                                                     
                      PRIMARY KEY (`tvmaze_id`),
                      KEY `tvrageid` (`tvrage_id`),
                      KEY `thetvdbid` (`thetvdb_id`),
                      KEY `imdbid` (`imdb_id`),
                      KEY `name` (`name`),
                      FULLTEXT KEY `ft_name` (`name`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC",
    ],
    [
        'id' => 58,
        'info' => 'Drop column clean_cron_key, not used',
        'date' => '27 Jan, 2018',
        'query' => 'ALTER TABLE `cleanup` DROP COLUMN `clean_cron_key`',
    ],
    [
        'id' => 59,
        'info' => 'Add cleanup update TVMaze IDs',
        'date' => '27 Jan, 2018',
        'query' => "INSERT INTO `cleanup` (`clean_title`, `clean_file`, `clean_time`, `clean_increment`, `clean_log`, `clean_desc`, `clean_on`, `function_name`) VALUES ('TVMaze Update', 'tvmaze_update.php', 1517184000, 86400, 1, 'Insert New TVMaze IDs', 1, 'tvmaze_update')",
    ],
    [
        'id' => 60,
        'info' => 'Add new_email column',
        'date' => '1 Feb, 2018',
        'query' => 'ALTER TABLE `tokens` ADD COLUMN `new_email` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL AFTER `email`',
    ],
    [
        'id' => 61,
        'info' => 'Delete trivia questions, to purge duplicates',
        'date' => '5 Feb, 2018',
        'query' => 'DELETE FROM `triviaq`',
    ],
    [
        'id' => 62,
        'info' => 'Add hash of question for duplicates',
        'date' => '5 Feb, 2018',
        'query' => 'ALTER TABLE `triviaq` ADD COLUMN `hash` CHAR(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL',
    ],
    [
        'id' => 63,
        'info' => 'Add unique index on trivia table.<br><span class="size_6 has-text-red">Please import the trivia.php.sql file.</span>',
        'date' => '5 Feb, 2018',
        'query' => 'ALTER TABLE `triviaq` ADD UNIQUE INDEX `hash`(`hash`)',
    ],
    [
        'id' => 64,
        'info' => 'Add index on torrents.free.',
        'date' => '12 Feb, 2018',
        'query' => 'ALTER TABLE `torrents` ADD INDEX `free`(`free`)',
    ],
];
