-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2018 at 11:14 AM
-- Server version: 5.6.37
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `henfire`
--

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

CREATE TABLE IF NOT EXISTS `job_category` (
  `id` int(11) NOT NULL,
  `Category` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `SubCategory` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `glyphicon` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` tinytext COLLATE utf8_unicode_ci,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_category`
--

INSERT INTO `job_category` (`id`, `Category`, `SubCategory`, `glyphicon`, `description`, `image`) VALUES
(23, 'Video & Animation', 'Whiteboard & Animated Explainers', 'glyphicon-film', 'get your videos done', NULL),
(24, 'Video & Animation', 'Intros & Animated Logos', NULL, NULL, NULL),
(25, 'Video & Animation', 'Promotional Videos', NULL, NULL, NULL),
(26, 'Video & Animation', 'Editing & Post Production', NULL, NULL, NULL),
(27, 'Video & Animation', 'Lyric & Music Videos', NULL, NULL, NULL),
(28, 'Video & Animation', 'Spokesperson Videos', NULL, NULL, NULL),
(29, 'Video & Animation', 'Animated Characters & Modeling', NULL, NULL, NULL),
(30, 'Video & Animation', 'Short Video Ads', NULL, NULL, NULL),
(31, 'Video & Animation', 'Live Action Explainers', NULL, NULL, NULL),
(32, 'Video & Animation', 'Other', 'glyphicon-film', NULL, NULL),
(33, 'Graphics & Design', 'Logo Design', 'glyphicon-grain', 'All your graphical needs', NULL),
(34, 'Graphics & Design', 'Business Cards & Stationery', NULL, NULL, NULL),
(35, 'Graphics & Design', 'Illustration', NULL, NULL, NULL),
(36, 'Graphics & Design', 'Cartoons & Caricatures', NULL, NULL, NULL),
(37, 'Graphics & Design', 'Flyers & Brochures', NULL, NULL, NULL),
(38, 'Graphics & Design', 'Book Covers & Packaging', NULL, NULL, NULL),
(39, 'Graphics & Design', 'Web & Mobile Design', NULL, NULL, NULL),
(40, 'Graphics & Design', 'Social Media Design', NULL, NULL, NULL),
(41, 'Graphics & Design', 'Banner Ads', NULL, NULL, NULL),
(42, 'Graphics & Design', 'Photoshop Editing', NULL, NULL, NULL),
(43, 'Graphics & Design', '3D & 2D Models', NULL, NULL, NULL),
(44, 'Graphics & Design', 'T-Shirts & Merchandise', NULL, NULL, NULL),
(45, 'Graphics & Design', 'Presentation Design', NULL, NULL, NULL),
(46, 'Graphics & Design', 'Other', NULL, NULL, NULL),
(47, 'Digital Marketing', 'SEO', 'glyphicon-road', 'Market online', NULL),
(48, 'Digital Marketing', 'Social Media Marketing', NULL, NULL, NULL),
(49, 'Digital Marketing', 'Content Marketing', NULL, NULL, NULL),
(50, 'Digital Marketing', 'Video Marketing', NULL, NULL, NULL),
(51, 'Digital Marketing', 'Email Marketing', NULL, NULL, NULL),
(52, 'Digital Marketing', 'Search & Display Marketing', NULL, NULL, NULL),
(53, 'Digital Marketing', 'Marketing Strategy', NULL, NULL, NULL),
(54, 'Digital Marketing', 'Web Traffic', NULL, NULL, NULL),
(55, 'Digital Marketing', 'Other', NULL, NULL, NULL),
(56, 'Writing & Translation', 'Resumes & Cover Letters', 'glyphicon-text-size', 'All writing needs', NULL),
(57, 'Writing & Translation', 'Proofreading & Editing', NULL, NULL, NULL),
(58, 'Writing & Translation', 'Translation', NULL, NULL, NULL),
(59, 'Writing & Translation', 'Creative Writing', NULL, NULL, NULL),
(60, 'Writing & Translation', 'Business Copywriting', NULL, NULL, NULL),
(61, 'Writing & Translation', 'Research & Summaries', NULL, NULL, NULL),
(62, 'Writing & Translation', 'Articles & Blog Posts', NULL, NULL, NULL),
(63, 'Writing & Translation', 'Press Releases', NULL, NULL, NULL),
(64, 'Writing & Translation', 'Transcription', NULL, NULL, NULL),
(65, 'Writing & Translation', 'Other', NULL, NULL, NULL),
(66, 'Music & Audio', 'Voice Over', 'glyphicon-headphones', 'All of your audio neds', NULL),
(67, 'Music & Audio', 'Mixing & Mastering', NULL, NULL, NULL),
(68, 'Music & Audio', 'Producers & Composers', NULL, NULL, NULL),
(69, 'Music & Audio', 'Singer-Songwriters', NULL, NULL, NULL),
(70, 'Music & Audio', 'Session Musicians & Singers', NULL, NULL, NULL),
(71, 'Music & Audio', 'Jingles & Drops', NULL, NULL, NULL),
(72, 'Music & Audio', 'Sound Effects', NULL, NULL, NULL),
(73, 'Music & Audio', 'Other', NULL, NULL, NULL),
(74, 'Programming & Tech', 'WordPress', 'glyphicon-qrcode', 'All of your programming needs', NULL),
(75, 'Programming & Tech', 'Website Builders & CMS', NULL, NULL, NULL),
(76, 'Programming & Tech', 'Web Programming', NULL, NULL, NULL),
(77, 'Programming & Tech', 'Ecommerce', NULL, NULL, NULL),
(78, 'Programming & Tech', 'Mobile Apps & Web', NULL, NULL, NULL),
(79, 'Programming & Tech', 'Desktop applications', NULL, NULL, NULL),
(80, 'Programming & Tech', 'Support & IT', NULL, NULL, NULL),
(81, 'Programming & Tech', 'Chatbots', NULL, NULL, NULL),
(82, 'Programming & Tech', 'Data Analysis & Reports', NULL, NULL, NULL),
(83, 'Programming & Tech', 'Convert Files', NULL, NULL, NULL),
(84, 'Programming & Tech', 'Databases', NULL, NULL, NULL),
(85, 'Programming & Tech', 'User Testing', NULL, NULL, NULL),
(86, 'Programming & Tech', 'QA', NULL, NULL, NULL),
(87, 'Programming & Tech', 'Other', NULL, NULL, NULL),
(88, 'Business', 'Virtual Assistant', 'glyphicon-briefcase', 'Get your Business done', NULL),
(89, 'Business', 'Market Research', NULL, NULL, NULL),
(90, 'Business', 'Business Plans', NULL, NULL, NULL),
(91, 'Business', 'Branding Services', NULL, NULL, NULL),
(92, 'Business', 'Legal Consulting', NULL, NULL, NULL),
(93, 'Business', 'Financial Consulting', NULL, NULL, NULL),
(94, 'Business', 'Business Tips', NULL, NULL, NULL),
(95, 'Business', 'Presentations', NULL, NULL, NULL),
(96, 'Business', 'Career Advice', NULL, NULL, NULL),
(97, 'Business', 'Flyer Distribution', NULL, NULL, NULL),
(98, 'Business', 'Other', NULL, NULL, NULL),
(99, 'Fun & Lifestyle', 'Online Lessons', 'glyphicon-ice-lolly', 'For fun times', NULL),
(100, 'Fun & Lifestyle', 'Arts & Crafts', NULL, NULL, NULL),
(101, 'Fun & Lifestyle', 'Relationship Advice', NULL, NULL, NULL),
(102, 'Fun & Lifestyle', 'Health, Nutrition & Fitness', NULL, NULL, NULL),
(103, 'Fun & Lifestyle', 'Astrology & Readings', NULL, NULL, NULL),
(104, 'Fun & Lifestyle', 'Spiritual & Healing', NULL, NULL, NULL),
(105, 'Fun & Lifestyle', 'Family & Genealogy', NULL, NULL, NULL),
(106, 'Fun & Lifestyle', 'Gaming', NULL, NULL, NULL),
(107, 'Fun & Lifestyle', 'Greeting Cards & Videos', NULL, NULL, NULL),
(108, 'Fun & Lifestyle', 'Your Message On...', NULL, NULL, NULL),
(109, 'Fun & Lifestyle', 'Viral Videos', NULL, NULL, NULL),
(110, 'Fun & Lifestyle', 'Pranks & Stunts', NULL, NULL, NULL),
(111, 'Fun & Lifestyle', 'Celebrity Impersonators', NULL, NULL, NULL),
(112, 'Fun & Lifestyle', 'Collectibles', NULL, NULL, NULL),
(113, 'Fun & Lifestyle', 'Global Culture', NULL, NULL, NULL),
(114, 'Fun & Lifestyle', 'Other', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `job_category`
--
ALTER TABLE `job_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `job_category`
--
ALTER TABLE `job_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=115;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
