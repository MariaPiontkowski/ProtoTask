/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 80018
 Source Host           : localhost:3306
 Source Schema         : prototask

 Target Server Type    : MySQL
 Target Server Version : 80018
 File Encoding         : 65001

 Date: 06/10/2020 21:35:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for projects
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `init_at` date NOT NULL,
  `end_at` date NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of projects
-- ----------------------------
INSERT INTO `projects` VALUES (1, 'Teste 1', '2020-10-05', '2020-10-28', '2020-10-04 21:32:35', '2020-10-04 21:32:35');
INSERT INTO `projects` VALUES (2, 'Teste 2', '2020-10-05', '2020-10-27', '2020-10-04 21:32:35', '2020-10-06 05:02:45');
INSERT INTO `projects` VALUES (3, 'Teste 3', '2020-10-06', '2020-10-29', '2020-10-06 04:51:20', '2020-10-06 04:51:20');
INSERT INTO `projects` VALUES (4, 'Teste 4', '2020-10-15', '2020-10-29', '2020-10-06 05:50:21', '2020-10-06 05:50:21');
INSERT INTO `projects` VALUES (6, 'Teste 5', '2020-10-11', '2020-10-13', '2020-10-06 16:45:51', '2020-10-06 16:46:05');
INSERT INTO `projects` VALUES (7, 'Teste 6', '2020-10-06', '2020-10-23', '2020-10-07 00:01:57', '2020-10-07 00:02:10');

-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `init_at` date NOT NULL,
  `end_at` date NOT NULL,
  `finished` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tasks_project_id_foreign`(`project_id`) USING BTREE,
  CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tasks
-- ----------------------------
INSERT INTO `tasks` VALUES (1, 1, 'Atividade 1', '2020-10-12', '2020-10-22', 1, NULL, '2020-10-06 17:45:22');
INSERT INTO `tasks` VALUES (2, 1, 'Atividade 2', '2020-10-06', '2020-10-20', 1, NULL, '2020-10-06 17:44:20');
INSERT INTO `tasks` VALUES (4, 1, 'Atividade 3', '2020-10-06', '2020-10-20', 1, NULL, NULL);
INSERT INTO `tasks` VALUES (5, 1, 'Atividade 4', '2020-10-06', '2020-10-20', 1, NULL, NULL);
INSERT INTO `tasks` VALUES (6, 1, 'Atividade 5', '2020-10-06', '2020-10-20', 1, NULL, '2020-10-06 17:44:50');
INSERT INTO `tasks` VALUES (7, 1, 'Atividade 6', '2020-10-06', '2020-10-20', 1, NULL, '2020-10-06 17:45:20');
INSERT INTO `tasks` VALUES (8, 1, 'Atividade 7', '2020-10-07', '2020-10-20', 1, NULL, '2020-10-06 17:45:33');
INSERT INTO `tasks` VALUES (9, 1, 'Atividade 8', '2020-10-06', '2020-10-20', 1, NULL, '2020-10-06 17:45:19');
INSERT INTO `tasks` VALUES (10, 1, 'Atividade 9', '2020-10-06', '2020-10-20', 1, NULL, '2020-10-06 17:45:21');
INSERT INTO `tasks` VALUES (11, 1, 'Atividade 10', '2020-10-06', '2020-10-29', 1, '2020-10-06 06:03:33', '2020-10-06 17:45:23');
INSERT INTO `tasks` VALUES (12, 2, 'Atividade 11', '2020-10-06', '2020-10-14', 0, '2020-10-06 06:14:10', '2020-10-06 06:14:10');
INSERT INTO `tasks` VALUES (13, 1, 'Atividade 12', '2020-10-02', '2020-10-15', 1, '2020-10-06 16:40:41', '2020-10-06 16:58:26');
INSERT INTO `tasks` VALUES (14, 6, 'Atividade 13', '2020-10-09', '2020-10-28', 1, '2020-10-07 00:08:19', '2020-10-07 00:23:17');
INSERT INTO `tasks` VALUES (15, 3, 'Atividade 14', '2020-10-10', '2020-11-12', 1, '2020-10-07 00:24:50', '2020-10-07 00:30:03');
INSERT INTO `tasks` VALUES (17, 3, 'Atividade 15', '2020-10-09', '2020-10-15', 0, '2020-10-07 00:30:34', '2020-10-07 00:30:34');

SET FOREIGN_KEY_CHECKS = 1;
