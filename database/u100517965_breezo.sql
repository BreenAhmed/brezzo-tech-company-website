-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 11, 2026 at 12:15 AM
-- Server version: 11.8.9-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u100517965_breezo`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(50) NOT NULL,
  `entity_type` varchar(50) DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(150) DEFAULT NULL,
  `role` enum('admin','editor') DEFAULT 'admin',
  `active` tinyint(1) DEFAULT 1,
  `last_login_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `email`, `password_hash`, `full_name`, `role`, `active`, `last_login_at`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@brezzo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin', 1, NULL, '2025-11-13 23:24:46', '2025-11-13 23:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `blog_post_images`
--

CREATE TABLE `blog_post_images` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('new','read','replied') DEFAULT 'new',
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `name_ar` varchar(100) DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `description_ar` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `currency` varchar(3) DEFAULT 'USD',
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `features_ar` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features_ar`)),
  `price_note` varchar(120) DEFAULT NULL,
  `cta_text` varchar(50) DEFAULT 'Get Started',
  `is_popular` tinyint(1) DEFAULT 0,
  `is_visible` tinyint(1) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `name_ar`, `slug`, `description`, `description_ar`, `price`, `currency`, `features`, `features_ar`, `price_note`, `cta_text`, `is_popular`, `is_visible`, `sort_order`, `created_at`, `updated_at`) VALUES
(5, 'LaunchPad Package', 'باقة الانطلاق', 'launchpad-package', 'Kickstart your online presence with the LaunchPad Package. Get a responsive website, essential branding, and core marketing tools to attract your first customers—simple, effective, and built to grow.', 'ابدأ حضورك الرقمي مع باقة الانطلاق LaunchPad. احصل على موقع إلكتروني متجاوب، عناصر أساسية للعلامة التجارية، وأدوات التسويق الأساسية لجذب أول عملائك — بسيطة، فعّالة، ومصممة للنمو مع عملك.', 1000.00, 'USD', '[\"Responsive Website (Up to 5 Pages)\",\"Basic Branding Setup\",\"On-Page SEO Essentials\",\"Contact Form Integration\",\"Social Media Linking\",\"Analytics Setup\",\"1-Month Support\"]', '[\"\\u0645\\u0648\\u0642\\u0639 \\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a \\u0645\\u062a\\u062c\\u0627\\u0648\\u0628 (\\u062d\\u062a\\u0649 5 \\u0635\\u0641\\u062d\\u0627\\u062a)\",\"\\u0625\\u0639\\u062f\\u0627\\u062f \\u0647\\u0648\\u064a\\u0629 \\u0628\\u0635\\u0631\\u064a\\u0629 \\u0623\\u0633\\u0627\\u0633\\u064a\\u0629\",\"\\u0623\\u0633\\u0627\\u0633\\u064a\\u0627\\u062a \\u062a\\u062d\\u0633\\u064a\\u0646 \\u0645\\u062d\\u0631\\u0643\\u0627\\u062a \\u0627\\u0644\\u0628\\u062d\\u062b \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 (On-Page SEO)\",\"\\u062f\\u0645\\u062c \\u0646\\u0645\\u0648\\u0630\\u062c \\u0627\\u0644\\u0627\\u062a\\u0635\\u0627\\u0644\",\"\\u0631\\u0628\\u0637 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\",\"\\u062f\\u0639\\u0645 \\u0644\\u0645\\u062f\\u0629 \\u0634\\u0647\\u0631 \\u0648\\u0627\\u062d\\u062f\"]', NULL, 'Get Started', 0, 1, 0, '2025-12-04 11:54:35', '2025-12-04 12:15:52'),
(6, 'Growth Accelerator Package', 'باقة مسرّع النمو', 'growth-accelerator-package', 'Boost your business with the Growth Accelerator Package. Enjoy a responsive website, enhanced branding, SEO, lead-generation tools, and social media integration to expand your reach and grow revenue.', 'عزز عملك مع باقة مسرّع النمو Growth Accelerator. احصل على موقع إلكتروني متجاوب، عناصر هوية بصرية محسّنة، تحسين محركات البحث (SEO)، أدوات لتوليد العملاء المحتملين، وتكامل مع وسائل التواصل الاجتماعي لتوسيع نطاق عملك وزيادة الإيرادات.', 1400.00, 'USD', '[\"Responsive Website (8\\u201312 Pages)\",\"Enhanced Branding Setup\",\"On-Page & Basic Off-Page SEO\",\"Lead Generation Tools\",\"Social Media Integration & Management Tips\",\"Analytics & Performance Tracking\",\"Blog \\/ News Section\",\"2 Months Support & Minor Updates\"]', '[\"\\u0645\\u0648\\u0642\\u0639 \\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a \\u0645\\u062a\\u062c\\u0627\\u0648\\u0628 (8\\u201312 \\u0635\\u0641\\u062d\\u0629)\",\"\\u0625\\u0639\\u062f\\u0627\\u062f \\u0647\\u0648\\u064a\\u0629 \\u0628\\u0635\\u0631\\u064a\\u0629 \\u0645\\u062d\\u0633\\u0651\\u0646\\u0629\",\"\\u062a\\u062d\\u0633\\u064a\\u0646 \\u0645\\u062d\\u0631\\u0643\\u0627\\u062a \\u0627\\u0644\\u0628\\u062d\\u062b \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 (On-Page) \\u0648\\u0627\\u0644\\u0623\\u0633\\u0627\\u0633\\u064a \\u062e\\u0627\\u0631\\u062c \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 (Off-Page)\",\"\\u0623\\u062f\\u0648\\u0627\\u062a \\u062a\\u0648\\u0644\\u064a\\u062f \\u0627\\u0644\\u0639\\u0645\\u0644\\u0627\\u0621 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0645\\u0644\\u064a\\u0646\",\"\\u062a\\u0643\\u0627\\u0645\\u0644 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a \\u0648\\u0646\\u0635\\u0627\\u0626\\u062d \\u0627\\u0644\\u0625\\u062f\\u0627\\u0631\\u0629\",\"\\u0627\\u0644\\u062a\\u062d\\u0644\\u064a\\u0644\\u0627\\u062a \\u0648\\u062a\\u062a\\u0628\\u0639 \\u0627\\u0644\\u0623\\u062f\\u0627\\u0621\",\"\\u0642\\u0633\\u0645 \\u0627\\u0644\\u0645\\u062f\\u0648\\u0646\\u0629 \\/ \\u0627\\u0644\\u0623\\u062e\\u0628\\u0627\\u0631\",\"\\u062f\\u0639\\u0645 \\u0644\\u0645\\u062f\\u0629 \\u0634\\u0647\\u0631\\u064a\\u0646 \\u0648\\u062a\\u062d\\u062f\\u064a\\u062b\\u0627\\u062a \\u0628\\u0633\\u064a\\u0637\\u0629\"]', NULL, 'Get Started', 1, 1, 0, '2025-12-04 11:58:33', '2025-12-04 12:13:37'),
(7, 'Scale-Up Premium Package', 'باقة التوسع المميزة', 'scale-up-premium-package', 'The Scale-Up Premium Package is for established businesses ready to dominate online. Get a fully customized website, advanced features, full branding, SEO, analytics, and ongoing support to scale efficiently.', 'التوسع المميزة Scale-Up Premium مخصّصة للشركات الراسخة المستعدة للهيمنة على الإنترنت. احصل على موقع إلكتروني مُصمّم بالكامل، ميزات متقدمة، هوية بصرية كاملة، تحسين محركات البحث (SEO)، تحليلات، ودعم مستمر لتوسيع عملك بكفاءة.', 2000.00, 'USD', '[\"Fully Custom Responsive Website (15+ Pages)\",\"Comprehensive Branding\",\"Advanced SEO & Marketing Tools\",\"E-commerce or Advanced Functionalities\",\"Lead Generation & Conversion Optimization\",\"Blog \\/ Content Marketing Section\",\"Social Media Integration & Automation Setup\",\"Analytics & Reporting\",\"3\\u20136 Months Premium Support & Maintenance\"]', '[\"\\u0645\\u0648\\u0642\\u0639 \\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a \\u0645\\u062a\\u062c\\u0627\\u0648\\u0628 \\u0648\\u0645\\u062e\\u0635\\u0635 \\u0628\\u0627\\u0644\\u0643\\u0627\\u0645\\u0644 (\\u0623\\u0643\\u062b\\u0631 \\u0645\\u0646 15 \\u0635\\u0641\\u062d\\u0629)\",\"\\u0627\\u0644\\u0647\\u0648\\u064a\\u0629 \\u0627\\u0644\\u0628\\u0635\\u0631\\u064a\\u0629 \\u0627\\u0644\\u0634\\u0627\\u0645\\u0644\\u0629\",\"\\u0623\\u062f\\u0648\\u0627\\u062a \\u062a\\u0633\\u0648\\u064a\\u0642 \\u0648\\u062a\\u062d\\u0633\\u064a\\u0646 \\u0645\\u062d\\u0631\\u0643\\u0627\\u062a \\u0627\\u0644\\u0628\\u062d\\u062b \\u0627\\u0644\\u0645\\u062a\\u0642\\u062f\\u0645\\u0629 (SEO)\",\"\\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\\u0629 \\u0623\\u0648 \\u0627\\u0644\\u0648\\u0638\\u0627\\u0626\\u0641 \\u0627\\u0644\\u0645\\u062a\\u0642\\u062f\\u0645\\u0629\",\"\\u062a\\u0648\\u0644\\u064a\\u062f \\u0627\\u0644\\u0639\\u0645\\u0644\\u0627\\u0621 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0645\\u0644\\u064a\\u0646 \\u0648\\u062a\\u062d\\u0633\\u064a\\u0646 \\u0627\\u0644\\u062a\\u062d\\u0648\\u064a\\u0644\\u0627\\u062a\",\"\\u0642\\u0633\\u0645 \\u0627\\u0644\\u0645\\u062f\\u0648\\u0646\\u0629 \\/ \\u062a\\u0633\\u0648\\u064a\\u0642 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649\",\"\\u062a\\u0643\\u0627\\u0645\\u0644 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a \\u0648\\u0625\\u0639\\u062f\\u0627\\u062f \\u0627\\u0644\\u0623\\u062a\\u0645\\u062a\\u0629\",\"\\u0627\\u0644\\u062a\\u062d\\u0644\\u064a\\u0644\\u0627\\u062a \\u0648\\u0627\\u0644\\u062a\\u0642\\u0627\\u0631\\u064a\\u0631\",\"\\u062f\\u0639\\u0645 \\u0648\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0645\\u062a\\u0645\\u064a\\u0632\\u0629 \\u0644\\u0645\\u062f\\u0629 3\\u20136 \\u0623\\u0634\\u0647\\u0631\"]', NULL, 'Get Started', 0, 1, 0, '2025-12-04 12:02:06', '2025-12-04 12:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_visible` tinyint(1) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `logo`, `website`, `description`, `is_visible`, `sort_order`, `created_at`, `updated_at`) VALUES
(6, 'Goalchii', '6924eadd8ca49_1764027101.jpg', 'https://goalchii.shop/store/index.php', '', 1, 0, '2025-11-24 23:31:41', '2025-11-27 00:18:35'),
(7, 'Tashawan Group', '692798ee53369_1764202734.png', 'https://tashawan.net/', '', 1, 0, '2025-11-27 00:18:54', '2025-11-27 00:19:18'),
(9, 'Tegelwerk Co.', '69279af3aa9b4_1764203251.png', 'https://tegelwerk.co/', '', 1, 0, '2025-11-27 00:27:31', '2025-11-27 00:30:07'),
(10, 'Salon Exclusive', '69279b5c24248_1764203356.png', 'https://www.salonexclusive.no/', '', 1, 0, '2025-11-27 00:29:16', '2025-11-27 00:29:16'),
(11, 'Sozvin Store', '69279bf828624_1764203512.png', 'https://sozvin.store/', '', 1, 0, '2025-11-27 00:31:52', '2025-11-27 00:31:52'),
(12, 'Erbil Quartz Hotel', '696272407e364_1768059456.png', '', '', 1, 0, '2026-01-10 15:37:36', '2026-01-10 15:37:36'),
(13, 'J-K Beauty Salon', '69c5b6902f148_1774565008.png', 'https://www.j-kbeauty.no/', '', 1, 0, '2026-03-26 22:43:28', '2026-03-26 22:43:28');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_ar` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `excerpt_ar` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `content_ar` longtext DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `category` varchar(50) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `status` enum('draft','published') DEFAULT 'draft',
  `publish_date` datetime DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_description_ar` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `title_ar`, `slug`, `excerpt`, `excerpt_ar`, `content`, `content_ar`, `featured_image`, `is_featured`, `category`, `tags`, `status`, `publish_date`, `meta_description`, `meta_description_ar`, `created_at`, `updated_at`) VALUES
(7, 'How Smart Digital Marketing Helps Businesses Grow in 2025', 'كيف يُسهم التسويق الرقمي الذكي في نمو الأعمال في عام 2025', 'how-smart-digital-marketing-helps-businesses-grow-in-2025', 'In today’s fast-moving digital world, your online presence is no longer “a nice extra”—it’s the center of your business growth. Whether you\'re a startup, a local store, or a well-known brand, the way you appear online directly shapes how customers see, trust, and choose you.\r\n\r\nAt Brezzo, we focus on helping businesses turn their digital platforms into powerful growth engines using creative design, smart strategy, and data-driven execution.', 'في عالم اليوم الرقمي السريع، لم تعد هويتك الإلكترونية مجرد “ميزة إضافية” — بل أصبحت المحور الأساسي لنمو عملك. سواءً كنت شركة ناشئة، أو متجرًا محليًا، أو علامة تجارية معروفة، فإن الطريقة التي تظهر بها عبر الإنترنت تؤثر بشكل مباشر على كيفية رؤية العملاء لك، وثقتهم بك، وقرارهم باختيارك.\r\n\r\nفي Brezzo، نركز على مساعدة الشركات في تحويل منصّاتها الرقمية إلى محرّكات نمو قوية من خلال التصميم الإبداعي، والاستراتيجيات الذكية، والتنفيذ المبني على البيانات.', 'Why Digital Marketing Matters More Than Ever\r\n\r\nHere’s the reality:\r\nCustomers check your website before they step into your store. They judge your brand by your social media posts. And they compare your ads with your competitors’.\r\n\r\nA solid digital strategy helps you:\r\n\r\nBuild trust and brand recognition\r\n\r\nIncrease sales and customer engagement\r\n\r\nReach the right audience with precise targeting\r\n\r\nStand out in an overcrowded market\r\n\r\nOur goal is simple—make your brand unforgettable.\r\n\r\nWhat Makes Brezzo Different?\r\n\r\nMany agencies offer marketing, but not all combine design, development, and advertising under one strategy. Here is what sets Brezzo apart:\r\n\r\n1. Performance-Driven Advertising\r\n\r\nWe run Meta Ads, Google Ads, and TikTok Ads built to deliver real results—more leads, higher conversions, and lower costs.\r\n\r\n2. Creative Social Media Content\r\n\r\nYour brand needs visuals that stop the scroll.\r\nOur team designs eye-catching posts, brand stories, and social media campaigns that boost engagement and reach.\r\n\r\n3. Professional Web Development\r\n\r\nA website must be fast, beautiful, and optimized.\r\nWe build websites that perform—both technically and commercially.\r\n\r\n4. Smart Automation & AI Integration\r\n\r\nWe help businesses save time and streamline operations using AI tools, automation workflows, and smart digital systems.\r\n\r\nHow We Help Businesses Grow\r\n\r\nEvery project at Brezzo starts with understanding your audience and your business goals. Then we build a step-by-step strategy that covers:\r\n\r\nBrand identity & creative direction\r\n\r\nWebsite design & optimization\r\n\r\nSocial media growth\r\n\r\nPaid advertising strategies\r\n\r\nData tracking & performance analysis\r\n\r\nLong-term digital scaling\r\n\r\nThe result?\r\nA clear, measurable, and sustainable growth path.\r\n\r\nReady to Take Your Brand to the Next Level?\r\n\r\nDigital marketing isn’t just about posting content or running ads—it’s about creating experiences that convert viewers into loyal customers.\r\n\r\nIf you’re ready to grow faster, reach more people, and give your brand the professional presence it deserves, Brezzo is here to help.\r\n\r\n👉 Visit brezzo.co to explore our services and start your next project.', 'لماذا يُعدّ التسويق الرقمي مهمًا أكثر من أي وقتٍ مضى؟\r\n\r\nإليك الحقيقة:\r\nالعملاء يتحققون من موقعك الإلكتروني قبل أن يزوروا متجرك. ويحكمون على علامتك التجارية من منشوراتك على وسائل التواصل الاجتماعي. ويقارنون إعلاناتك بإعلانات منافسيك.\r\n\r\nاستراتيجية رقمية قوية تساعدك على:\r\n\r\nبناء الثقة وتعزيز قوة العلامة التجارية\r\n\r\nزيادة المبيعات ورفع مستوى تفاعل العملاء\r\n\r\nالوصول إلى الجمهور المناسب من خلال استهداف دقيق\r\n\r\nالتميّز وسط سوق مزدحم\r\n\r\nهدفنا بسيط — أن نجعل علامتك التجارية لا تُنسى.\r\n\r\nما الذي يجعل Brezzo مختلفة؟\r\n\r\nالكثير من الوكالات تقدّم خدمات تسويق، لكن القليل فقط يجمع بين التصميم والتطوير والإعلانات ضمن استراتيجية واحدة. وإليك ما يميز Brezzo:\r\n\r\n1. إعلانات مبنية على الأداء\r\nندير حملات Meta Ads وGoogle Ads وTikTok Ads مصممة لتحقيق نتائج حقيقية — المزيد من العملاء المحتملين، وتحويلات أعلى، وتكاليف أقل.\r\n\r\n2. محتوى إبداعي لوسائل التواصل الاجتماعي\r\nعلامتك التجارية تحتاج إلى محتوى يجذب الأنظار.\r\nفريقنا يصمّم منشورات مميزة، قصصًا مرئية، وحملات تواصل اجتماعي تزيد من التفاعل والوصول.\r\n\r\n3. تطوير مواقع احترافي\r\nيجب أن يكون الموقع سريعًا، جميلًا، ومحسّنًا.\r\nنحن نبني مواقع تعمل بكفاءة — تقنيًا وتجاريًا.\r\n\r\n4. أتمتة ذكية ودمج أدوات الذكاء الاصطناعي\r\nنساعد الشركات على توفير الوقت وتنظيم العمل عبر أدوات الذكاء الاصطناعي، وأنظمة الأتمتة، والحلول الرقمية الذكية.\r\n\r\nكيف نساعد الشركات على النمو؟\r\n\r\nكل مشروع في Brezzo يبدأ بفهم جمهورك وأهداف عملك.\r\nثم نبني استراتيجية خطوة بخطوة تشمل:\r\n\r\nهوية العلامة والتوجه الإبداعي\r\n\r\nتصميم الموقع وتحسينه\r\n\r\nنمو وسائل التواصل الاجتماعي\r\n\r\nاستراتيجيات الإعلانات الممولة\r\n\r\nتتبّع البيانات وتحليل الأداء\r\n\r\nالتوسع الرقمي طويل المدى\r\n\r\nالنتيجة؟\r\nمسار نمو واضح، قابل للقياس، ومستدام.\r\n\r\nجاهز للانتقال بعلامتك التجارية إلى مستوى جديد؟\r\n\r\nالتسويق الرقمي ليس مجرد نشر محتوى أو تشغيل إعلانات — إنه خلق تجارب تحوّل المشاهدين إلى عملاء دائمين.\r\n\r\nإذا كنت مستعدًا للنمو بشكل أسرع، والوصول إلى جمهور أكبر، ومنح علامتك التجارية حضورًا احترافيًا تستحقه، فإن Brezzo هنا لمساعدتك.\r\n\r\n👉 زر موقع brezzo.co لاكتشاف خدماتنا وبدء مشروعك التالي.', '692791617bd82_1764200801.jpeg', 0, 'marketing', '', 'published', '2025-11-26 23:49:55', 'Boost your brand with Brezzo—expert digital marketing, web development, and creative design solutions that help businesses grow online.', 'ارتقِ بعلامتك التجارية مع Brezzo — خبراء في التسويق الرقمي، وتطوير المواقع، والتصميم الإبداعي، لنساعد عملك على النمو والتميز عبر الإنترنت.', '2025-11-26 23:45:41', '2025-11-26 23:49:55'),
(8, 'How Automation Is Transforming Business Growth in 2025', 'كيف تُحوِّل الأتمتة نمو الأعمال في عام 2025', 'how-automation-is-transforming-business-growth-in-2025', 'Automation used to sound like something only big tech companies could afford. Today, it\'s become one of the most valuable tools for any business—small, medium, or large. And in 2025, companies that embrace automation aren’t just working faster… they’re outperforming their competitors entirely.\r\n\r\nAt Brezzo, we help businesses upgrade their digital systems with smart automation, AI tools, and streamlined workflows that save time, reduce errors, and increase revenue.', 'كانت الأتمتة تُسمع في السابق كأمر يخص شركات التكنولوجيا الكبيرة فقط. اليوم، أصبحت واحدة من أكثر الأدوات قيمة لأي عمل—سواء صغير، متوسط، أو كبير. وفي عام 2025، الشركات التي تعتمد الأتمتة لا تعمل بسرعة أكبر فحسب… بل تتفوّق على منافسيها بالكامل.\r\n\r\nفي Brezzo، نساعد الشركات على ترقية أنظمتها الرقمية من خلال الأتمتة الذكية، وأدوات الذكاء الاصطناعي، وسير العمل المبسّط الذي يوفر الوقت، ويقلّل الأخطاء، ويزيد الإيرادات.', 'Why Automation Matters More Than Ever\r\n\r\nBetween customer messages, content creation, analytics, and daily operations, businesses waste dozens of hours every week on repetitive tasks.\r\n\r\nAutomation helps you:\r\n\r\nSave time by eliminating manual work\r\n\r\nIncrease accuracy and consistency\r\n\r\nRespond to customers instantly\r\n\r\nImprove lead generation and sales tracking\r\n\r\nScale faster without increasing workload\r\n\r\nIn a digital world where customer expectations are rising, automation turns chaos into clarity.\r\n\r\nWhat Can Your Business Automate?\r\n\r\nYou’d be surprised how many tasks can be fully automated today. Here are some of the most impactful areas:\r\n\r\n1. Social Media & Content Scheduling\r\n\r\nTools publish posts, track performance, and organize content calendars automatically.\r\n\r\n2. Customer Support & Chatbots\r\n\r\nAI chatbots can answer FAQs, collect leads, and operate 24/7—without hiring extra staff.\r\n\r\n3. Automated Sales Funnels\r\n\r\nFrom capturing leads to sending follow-up emails, automation keeps your sales pipeline active and organized.\r\n\r\n4. Payment & Invoice Systems\r\n\r\nAutomatic invoicing and reminders reduce late payments and paperwork.\r\n\r\n5. Analytics & Reporting\r\n\r\nInstead of manual checking, automated dashboards show all key metrics in one place.\r\n\r\n6. Workflow Automation (n8n, Zapier, Make)\r\n\r\nConnect your apps—CRM, website, email, ads, forms—and let them work together without manual effort.\r\n\r\nHow Brezzo Helps Businesses Automate\r\n\r\nWe build smart digital systems tailored to your needs. Our team specializes in:\r\n\r\nAI-powered customer support\r\n\r\nAutomated sales funnels\r\n\r\nSocial media content workflows\r\n\r\nCRM integrations\r\n\r\nCustom automation using n8n, Zapier, or Make\r\n\r\nWebsite automation (forms, bookings, notifications)\r\n\r\nBusiness dashboards for real-time data\r\n\r\nWe don’t just set up tools—we design a full, scalable system that works behind the scenes while you focus on growth.\r\n\r\nAutomation + AI = Your Competitive Advantage\r\n\r\nAI has supercharged automation. Instead of simple triggers and actions, businesses now enjoy:\r\n\r\nAutomated copywriting suggestions\r\n\r\nPredictive analytics\r\n\r\nSmart ad optimization\r\n\r\nAI-driven customer behavior insights\r\n\r\nPersonalized messaging at scale\r\n\r\nThis combination gives you a competitive edge even if you’re a small business.\r\n\r\nReady to Work Smarter, Not Harder?\r\n\r\nAutomation isn’t the future—it’s the present. And the faster your business adapts, the faster you grow.\r\n\r\nAt Brezzo, we help brands save time, reduce costs, and build powerful digital ecosystems that work automatically.\r\n\r\n👉 Visit brezzo.co to start automating your business today.', 'لماذا أصبحت الأتمتة أكثر أهمية من أي وقتٍ مضى\r\n\r\nبين رسائل العملاء، وإنشاء المحتوى، والتحليلات، والعمليات اليومية، تضيع الشركات عشرات الساعات أسبوعيًا على المهام المتكررة.\r\n\r\nالأتمتة تساعدك على:\r\n\r\nتوفير الوقت من خلال القضاء على العمل اليدوي\r\n\r\nزيادة الدقة والاتساق\r\n\r\nالرد على العملاء فورًا\r\n\r\nتحسين توليد العملاء المحتملين وتتبع المبيعات\r\n\r\nالتوسع بسرعة دون زيادة عبء العمل\r\n\r\nفي عالم رقمي تتزايد فيه توقعات العملاء، تُحوّل الأتمتة الفوضى إلى وضوح.\r\n\r\nما الذي يمكن أن تُؤتمتّه أعمالك؟\r\n\r\nستتفاجأ بعدد المهام التي يمكن أتمتتها بالكامل اليوم. إليك بعض المجالات الأكثر تأثيرًا:\r\n\r\nوسائل التواصل الاجتماعي وجدولة المحتوى\r\nالأدوات تنشر المنشورات، وتتابع الأداء، وتنظم جداول المحتوى تلقائيًا.\r\n\r\nدعم العملاء والدردشة الآلية\r\nيمكن لروبوتات المحادثة الذكية الرد على الأسئلة الشائعة، وجمع العملاء المحتملين، والعمل على مدار الساعة بدون توظيف إضافي.\r\n\r\nقنوات المبيعات الآلية\r\nمن جمع العملاء المحتملين إلى إرسال رسائل المتابعة، تحافظ الأتمتة على نشاط وتنظيم خط المبيعات.\r\n\r\nأنظمة الدفع والفواتير\r\nالفواتير والتنبيهات التلقائية تقلّل من التأخير والأعمال الورقية.\r\n\r\nالتحليلات والتقارير\r\nبدل الفحص اليدوي، تعرض لوحات التحكم الآلية جميع المقاييس الرئيسية في مكان واحد.\r\n\r\nأتمتة سير العمل (n8n، Zapier، Make)\r\nربط تطبيقاتك—CRM، الموقع، البريد، الإعلانات، النماذج—لتعمل معًا بدون جهد يدوي.\r\n\r\nكيف تساعد Brezzo الشركات على الأتمتة\r\n\r\nننشئ أنظمة رقمية ذكية مصممة خصيصًا لاحتياجاتك. فريقنا متخصص في:\r\n\r\nدعم العملاء باستخدام الذكاء الاصطناعي\r\n\r\nقنوات المبيعات الآلية\r\n\r\nسير عمل محتوى وسائل التواصل الاجتماعي\r\n\r\nتكاملات CRM\r\n\r\nأتمتة مخصصة باستخدام n8n، Zapier، أو Make\r\n\r\nأتمتة الموقع (النماذج، الحجوزات، الإشعارات)\r\n\r\nلوحات بيانات الأعمال لعرض المعلومات بشكل لحظي\r\n\r\nنحن لا نكتفي بإعداد الأدوات فقط—نصمّم نظامًا متكاملًا وقابلًا للتوسع يعمل في الخلفية بينما تركز أنت على النمو.\r\n\r\nالأتمتة + الذكاء الاصطناعي = ميزتك التنافسية\r\n\r\nلقد عزز الذكاء الاصطناعي قوة الأتمتة. بدلاً من مجرد تشغيل مشغلات وإجراءات بسيطة، يمكن للشركات الآن الاستفادة من:\r\n\r\nاقتراحات كتابة المحتوى تلقائيًا\r\n\r\nالتحليلات التنبؤية\r\n\r\nتحسين الإعلانات الذكية\r\n\r\nرؤى سلوك العملاء المدعومة بالذكاء الاصطناعي\r\n\r\nالرسائل الشخصية على نطاق واسع\r\n\r\nهذا المزيج يمنحك ميزة تنافسية حتى لو كنت شركة صغيرة.\r\n\r\nجاهز للعمل بذكاء أكثر، وليس بجهد أكبر؟\r\n\r\nالأتمتة ليست مستقبلًا—إنها الحاضر. وكلما تكيف عملك أسرع، نما أسرع.\r\n\r\nفي Brezzo، نساعد العلامات التجارية على توفير الوقت، وتقليل التكاليف، وبناء أنظمة رقمية قوية تعمل تلقائيًا.\r\n\r\n👉 زر موقع brezzo.co لبدء أتمتة عملك اليوم.', '6927946e26eb5_1764201582.jpg', 0, 'tech', '', 'published', '2025-11-26 23:59:42', 'Boost your business with smart automation solutions. Brezzo helps you save time, reduce costs, and scale faster using AI-powered workflows.', 'نمِّ عملك بحلول الأتمتة الذكية. تساعدك Brezzo على توفير الوقت، وتقليل التكاليف، والتوسع بسرعة أكبر باستخدام سير عمل مدعوم بالذكاء الاصطناعي.', '2025-11-26 23:54:38', '2025-11-26 23:59:42'),
(9, 'How AI Agents Are Revolutionizing Business in 2025', 'كيف تُحدث الوكلاء الذكاء الاصطناعي ثورة في الأعمال عام 2025', 'how-ai-agents-are-revolutionizing-business-in-2025', 'Artificial Intelligence (AI) isn’t just a buzzword—it’s a game-changer for businesses across every industry. One of the most exciting applications? AI Agents. These intelligent systems can understand, interact, and make decisions like a human assistant—but faster, smarter, and tirelessly.\r\n\r\nAt Brezzo, we help businesses implement AI agents that streamline operations, improve customer engagement, and create smarter workflows.', 'الذكاء الاصطناعي (AI) ليس مجرد مصطلح شائع—بل هو محرك تغيّر حقيقي للأعمال في جميع الصناعات. أحد أكثر التطبيقات إثارة؟ الوكلاء الذكاء الاصطناعي. هذه الأنظمة الذكية قادرة على الفهم والتفاعل واتخاذ القرارات مثل المساعد البشري—ولكن بسرعة أكبر، وذكاء أعلى، وبدون توقف.\r\n\r\nفي Brezzo، نساعد الشركات على تنفيذ وكلاء الذكاء الاصطناعي الذين يبسطون العمليات، ويحسّنون تفاعل العملاء، ويخلقون سير عمل أكثر ذكاءً.', 'What Are AI Agents?\r\n\r\nAI agents are advanced programs that can:\r\n\r\nUnderstand natural language (text or voice)\r\n\r\nHandle customer queries and support tasks\r\n\r\nPerform complex decision-making based on data\r\n\r\nAutomate repetitive operations\r\n\r\nThink of them as your digital team members—available 24/7 and able to learn and improve over time.\r\n\r\nWhy Businesses Need AI Agents\r\n\r\nHere’s why AI agents are becoming indispensable:\r\n\r\n24/7 Customer Support\r\nNo more missed messages or delayed responses. AI agents provide instant, accurate answers to customer inquiries.\r\n\r\nLead Generation & Nurturing\r\nAI can qualify leads, answer questions, and follow up automatically—keeping your sales pipeline active.\r\n\r\nMultilingual Communication\r\nAI agents can interact with customers in multiple languages and understand regional accents, including Arabic and Kurdish, making global expansion easier.\r\n\r\nData-Driven Insights\r\nAI agents analyze interactions, detect patterns, and offer recommendations to optimize marketing, sales, and operations.\r\n\r\nTime & Cost Efficiency\r\nBy automating repetitive tasks, your team can focus on creative, strategic, and high-value work.\r\n\r\nHow Brezzo Builds AI Agents for Businesses\r\n\r\nAt Brezzo, we don’t just implement AI—we craft intelligent agents tailored to your business needs:\r\n\r\nCustomer Service AI: Handle FAQs, bookings, and complaints automatically.\r\n\r\nSales & Marketing AI: Engage leads, send personalized messages, and track conversions.\r\n\r\nData Analysis AI: Monitor KPIs and generate actionable insights.\r\n\r\nMultilingual AI Agents: Support Arabic, Kurdish, and English with accent understanding.\r\n\r\nVoice & Chat AI Integration: Work across websites, apps, and social platforms.\r\n\r\nOur AI agents are fully integrated with your systems, working seamlessly to improve productivity and customer satisfaction.\r\n\r\nThe Future of Business Is Smart AI Agents\r\n\r\nAI agents are no longer optional—they’re a competitive advantage. Companies using AI agents are faster, more responsive, and more customer-focused than those relying solely on humans for repetitive tasks.\r\n\r\nWith Brezzo, you get intelligent agents that work for your business around the clock, streamline workflows, and help you make data-driven decisions with confidence.\r\n\r\nGet Started with AI Agents Today\r\n\r\nAI agents are transforming businesses worldwide. Don’t wait—embrace the future, automate intelligently, and scale smarter with Brezzo.\r\n\r\n👉 Visit brezzo.co to explore how AI agents can elevate your business.', 'ما هي وكلاء الذكاء الاصطناعي؟\r\n\r\nوكلاء الذكاء الاصطناعي هي برامج متقدمة قادرة على:\r\n\r\nفهم اللغة الطبيعية (نصوص أو صوت)\r\n\r\nالتعامل مع استفسارات العملاء ومهام الدعم\r\n\r\nاتخاذ قرارات معقدة بناءً على البيانات\r\n\r\nأتمتة العمليات المتكررة\r\n\r\nفكر فيهم كأعضاء فريقك الرقمي—متاحين 24/7 وقادرين على التعلم والتحسين مع الوقت.\r\n\r\nلماذا تحتاج الشركات إلى وكلاء الذكاء الاصطناعي؟\r\n\r\nدعم العملاء على مدار الساعة\r\nلا مزيد من الرسائل المفقودة أو الردود المتأخرة. يوفر الوكلاء الذكاء الاصطناعي إجابات فورية ودقيقة لاستفسارات العملاء.\r\n\r\nتوليد ورعاية العملاء المحتملين\r\nيمكن للذكاء الاصطناعي تصنيف العملاء المحتملين، والإجابة على أسئلتهم، والمتابعة تلقائيًا—مما يحافظ على نشاط خط المبيعات.\r\n\r\nالتواصل متعدد اللغات\r\nيمكن للوكلاء التفاعل مع العملاء بعدة لغات وفهم اللهجات الإقليمية، بما في ذلك العربية والكردية، لتسهيل التوسع العالمي.\r\n\r\nرؤى مستندة إلى البيانات\r\nيقوم الوكلاء بتحليل التفاعلات، واكتشاف الأنماط، وتقديم توصيات لتحسين التسويق والمبيعات والعمليات.\r\n\r\nتوفير الوقت والتكاليف\r\nمن خلال أتمتة المهام المتكررة، يمكن لفريقك التركيز على الأعمال الإبداعية والاستراتيجية وعالية القيمة.\r\n\r\nكيف يبني Brezzo وكلاء الذكاء الاصطناعي للشركات\r\n\r\nفي Brezzo، لا نكتفي بتنفيذ الذكاء الاصطناعي—بل نصمّم وكلاء أذكياء مصمّمين خصيصًا لاحتياجات عملك:\r\n\r\nذكاء اصطناعي لخدمة العملاء: إدارة الأسئلة الشائعة، والحجوزات، والشكاوى تلقائيًا.\r\n\r\nذكاء اصطناعي للمبيعات والتسويق: التفاعل مع العملاء المحتملين، إرسال رسائل مخصصة، وتتبع التحويلات.\r\n\r\nذكاء اصطناعي لتحليل البيانات: مراقبة مؤشرات الأداء الرئيسية وتوليد رؤى قابلة للتطبيق.\r\n\r\nوكلاء ذكاء اصطناعي متعدد اللغات: دعم العربية والكردية والإنجليزية مع فهم اللهجات.\r\n\r\nدمج الصوت والدردشة: العمل عبر المواقع، والتطبيقات، ومنصات التواصل الاجتماعي.\r\n\r\nوكلاؤنا الذكاء الاصطناعي متكاملون بالكامل مع أنظمتك، ويعملون بسلاسة لتحسين الإنتاجية ورضا العملاء.\r\n\r\nمستقبل الأعمال هو الوكلاء الذكاء الاصطناعي الأذكياء\r\n\r\nلم يعد وجود الوكلاء خيارًا—بل أصبح ميزة تنافسية. الشركات التي تستخدمهم أسرع، وأكثر استجابة، وأكثر تركيزًا على العملاء مقارنة بمن يعتمدون فقط على البشر للمهام المتكررة.\r\n\r\nمع Brezzo، تحصل على وكلاء ذكيين يعملون لصالح عملك على مدار الساعة، يبسطون سير العمل، ويساعدونك على اتخاذ قرارات مستندة إلى البيانات بثقة.\r\n\r\nابدأ مع وكلاء الذكاء الاصطناعي اليوم\r\n\r\nالوكلاء الذكاء الاصطناعي يغيرون طريقة عمل الشركات عالميًا. لا تنتظر—اعتمد المستقبل، وأتمت عملك بذكاء، وتوسع بذكاء مع Brezzo.\r\n\r\n👉 زر موقع brezzo.co لاستكشاف كيف يمكن للوكلاء الذكاء الاصطناعي تعزيز عملك.', '692795881a86f_1764201864.webp', 0, 'tech', '', 'published', '2025-11-27 00:04:24', 'Transform your business with AI agents. Brezzo builds intelligent systems that automate tasks, improve customer support, and boost productivity.', 'حوّل عملك باستخدام وكلاء الذكاء الاصطناعي. تقوم Brezzo ببناء أنظمة ذكية تقوم بأتمتة المهام، وتحسين دعم العملاء، وزيادة الإنتاجية.', '2025-11-27 00:02:03', '2025-11-27 00:04:24'),
(10, 'Why Web Development Is the Backbone of Modern Business', 'لماذا يُعتبر تطوير المواقع العمود الفقري للأعمال الحديثة', 'why-web-development-is-the-backbone-of-modern-business-1', 'In 2025, your website isn’t just an online presence—it’s your digital storefront, your sales engine, and your brand ambassador all in one. A professionally developed website can make the difference between a visitor scrolling past or becoming a loyal customer.\r\n\r\nAt Brezzo, we specialize in creating websites that are not only visually stunning but also fast, functional, and conversion-focused.', 'في عام 2025، لم يعد موقعك الإلكتروني مجرد حضور على الإنترنت—بل هو واجهتك الرقمية، ومحرك مبيعاتك، وسفير علامتك التجارية في آن واحد. يمكن لموقع مطوَّر بشكل احترافي أن يصنع الفارق بين زائر يتصفح بسرعة وبين عميل مخلص.\r\n\r\nفي Brezzo، نختص في إنشاء مواقع ليست مذهلة بصريًا فحسب، بل سريعة، عملية، ومصممة لتحقيق أقصى معدلات التحويل.', 'The Importance of Web Development\r\n\r\nA website is often the first point of contact between your brand and potential customers. A poorly built site can cost you credibility, leads, and revenue. On the other hand, a well-developed website can:\r\n\r\nBoost credibility and brand trust\r\n\r\nImprove user experience across devices\r\n\r\nIncrease conversion rates and sales\r\n\r\nEnhance SEO performance\r\n\r\nIntegrate seamlessly with marketing tools and automation\r\n\r\nKey Elements of Modern Web Development\r\n\r\nAt Brezzo, we focus on building websites that balance design, performance, and functionality:\r\n\r\n1. Responsive Design\r\n\r\nYour site must look perfect on desktops, tablets, and smartphones. Responsive design ensures no visitor is left frustrated.\r\n\r\n2. Fast Load Times\r\n\r\nEvery second counts. Slow websites lose visitors and affect search engine rankings.\r\n\r\n3. SEO Optimization\r\n\r\nA beautiful website is useless if it can’t be found. SEO-friendly development ensures your pages rank higher and attract more organic traffic.\r\n\r\n4. User Experience (UX)\r\n\r\nClear navigation, intuitive layouts, and fast interactions keep users engaged and drive conversions.\r\n\r\n5. Integration with Tools & Automation\r\n\r\nFrom payment gateways to CRM systems and AI chatbots, your website should work seamlessly with all your business tools.\r\n\r\nHow Brezzo Elevates Your Web Presence\r\n\r\nWe go beyond coding. Every website we build is crafted to meet business goals:\r\n\r\nCustom web development tailored to your brand\r\n\r\nE-commerce platforms optimized for sales\r\n\r\nMobile-first designs for modern users\r\n\r\nIntegration with marketing, analytics, and automation tools\r\n\r\nOngoing support and updates to keep your site secure and fast\r\n\r\nThe result? A website that doesn’t just exist—it performs, converts, and grows with your business.\r\n\r\nThe Future of Web Development\r\n\r\nWeb development is constantly evolving. From AI-driven interfaces to interactive designs and advanced automation, your website can be more than a static page—it can be a smart digital hub that works for your business 24/7.\r\n\r\nWith Brezzo, your website becomes a powerful asset, not just an online placeholder.\r\n\r\nStart Building Your Digital Future Today\r\n\r\nA strong website is no longer optional—it’s essential. Let Brezzo help you create a digital presence that impresses visitors, drives conversions, and grows your business.\r\n\r\n👉 Visit brezzo.co to explore our web development services and start your project today.', 'أهمية تطوير المواقع\r\n\r\nغالبًا ما يكون الموقع الإلكتروني أول نقطة تواصل بين علامتك التجارية والعملاء المحتملين. موقع سيء التصميم يمكن أن يكلفك المصداقية والعملاء المحتملين والإيرادات. من ناحية أخرى، يمكن لموقع مطوَّر بشكل جيد أن:\r\n\r\nيعزز المصداقية وثقة العملاء بعلامتك التجارية\r\n\r\nيحسّن تجربة المستخدم عبر جميع الأجهزة\r\n\r\nيزيد معدلات التحويل والمبيعات\r\n\r\nيعزز أداء تحسين محركات البحث (SEO)\r\n\r\nيتكامل بسلاسة مع أدوات التسويق والأتمتة\r\n\r\nالعناصر الأساسية لتطوير المواقع الحديثة\r\n\r\nفي Brezzo، نركز على بناء مواقع توازن بين التصميم، الأداء، والوظائف:\r\n\r\nتصميم متجاوب\r\nيجب أن يبدو موقعك مثاليًا على أجهزة الكمبيوتر، والأجهزة اللوحية، والهواتف الذكية. التصميم المتجاوب يضمن عدم إحباط أي زائر.\r\n\r\nسرعة التحميل\r\nكل ثانية مهمة. المواقع البطيئة تفقد الزوار وتؤثر على ترتيبها في محركات البحث.\r\n\r\nتحسين محركات البحث (SEO)\r\nالموقع الجميل بلا فائدة إذا لم يتم العثور عليه. يضمن تطوير صديق لمحركات البحث أن ترتفع صفحاتك في الترتيب وتجذب المزيد من الزيارات العضوية.\r\n\r\nتجربة المستخدم (UX)\r\nالتنقل الواضح، والتخطيطات البديهية، والتفاعلات السريعة تحافظ على اهتمام المستخدمين وتزيد من التحويلات.\r\n\r\nالتكامل مع الأدوات والأتمتة\r\nمن بوابات الدفع إلى أنظمة CRM وروبوتات الدردشة الذكية، يجب أن يعمل موقعك بسلاسة مع جميع أدوات عملك.\r\n\r\nكيف ترتقي Brezzo بحضورك الرقمي\r\n\r\nنحن لا نكتفي بالبرمجة فقط. كل موقع نبنيه مصمم لتحقيق أهداف عملك:\r\n\r\nتطوير مواقع مخصص وفق علامتك التجارية\r\n\r\nمنصات التجارة الإلكترونية محسّنة للمبيعات\r\n\r\nتصاميم متوافقة مع الهواتف الذكية للمستخدمين العصريين\r\n\r\nالتكامل مع أدوات التسويق، التحليلات، والأتمتة\r\n\r\nدعم مستمر وتحديثات لضمان أمان وسرعة الموقع\r\n\r\nالنتيجة؟ موقع لا يكتفي بالوجود فحسب—بل يُؤدي، يحوّل، وينمو مع عملك.\r\n\r\nمستقبل تطوير المواقع\r\n\r\nتطوير المواقع في تطور مستمر. من واجهات مدعومة بالذكاء الاصطناعي إلى التصاميم التفاعلية والأتمتة المتقدمة، يمكن لموقعك أن يكون أكثر من مجرد صفحة ثابتة—يمكن أن يصبح مركزًا رقميًا ذكيًا يعمل لصالح عملك على مدار الساعة.\r\n\r\nمع Brezzo، يصبح موقعك الإلكتروني أصلًا قويًا، وليس مجرد مساحة على الإنترنت.\r\n\r\nابدأ ببناء مستقبلك الرقمي اليوم\r\n\r\nالموقع القوي لم يعد اختياريًا—بل أصبح ضروريًا. دع Brezzo يساعدك في إنشاء حضور رقمي يبهج الزوار، ويزيد التحويلات، وينمي عملك.\r\n\r\n👉 زر موقع brezzo.co لاستكشاف خدمات تطوير المواقع وبدء مشروعك اليوم.', '692797546923c_1764202324.jpg', 0, 'tech', '', 'published', '2025-11-27 00:12:04', 'Brezzo builds responsive, fast, and SEO-friendly websites that enhance user experience, boost conversions, and grow your business online.', 'تبني Brezzo مواقع إلكترونية متجاوبة، سريعة، وصديقة لتحسين محركات البحث، تعزز تجربة المستخدم، تزيد من التحويلات، وتنمي عملك عبر الإنترنت.', '2025-11-27 00:08:39', '2025-11-27 00:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_ar` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `description_ar` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `content_ar` longtext DEFAULT NULL,
  `client` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `project_url` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `result_metrics` text DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `visible` tinyint(1) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `title_ar`, `slug`, `description`, `description_ar`, `content`, `content_ar`, `client`, `category`, `location`, `project_url`, `start_date`, `end_date`, `result_metrics`, `featured_image`, `is_featured`, `visible`, `sort_order`, `created_at`, `updated_at`) VALUES
(11, 'Smart Matching System', NULL, 'smart-matching-system-1', 'Explore Brezzo\'s commitment to innovation and excellence in the digital marketing world.\r\n\r\n', NULL, 'Introducing our recent project, Smart Matching, a website developed for a college specializing in IT.\r\n\r\n- Fully responsive design\r\n- Robust database\r\n- Top-notch security models\r\n- Seamless user experience', NULL, 'CIS College', 'Web Development', 'Iraq', '', '2023-11-28', '2024-02-10', '', '6924ed9c6f958_1764027804.png', 0, 1, 0, '2025-11-24 23:43:24', '2025-11-24 23:45:22'),
(12, 'Shaddok Co.', NULL, 'shaddok-co--1', 'Introducing our latest project — a creative graphic design campaign crafted for a leading agricultural company committed to growth and sustainability.', NULL, 'Clean, nature-inspired visual design\r\n\r\nFully optimized graphics for print and digital platforms\r\n\r\nClear communication of agricultural products, services, and values\r\n\r\nConsistent branding across all marketing materials\r\n\r\nMultilingual support for reaching diverse communities\r\n\r\nExperience our dedication to delivering impactful visual solutions that elevate agricultural brands and communicate their mission with clarity and professionalism.', NULL, 'Shaddok Co.', 'Marketing', 'Iraq', '', '2025-08-25', '2025-08-31', '', '6924ef3f27e9c_1764028223.png', 0, 1, 0, '2025-11-24 23:50:23', '2026-01-16 11:24:51'),
(13, 'Tegelwerk .Co', NULL, 'tegelwerk-co', 'Introducing our recent project, Ceramics Landing Page, crafted to showcase the elegance and artistry of ceramic design.', NULL, '* Fully responsive design for all devices\r\n* Robust product catalog and database\r\n* Strong security models for safe browsing and shopping\r\n* Seamless and aesthetic user experience\r\n\r\n*Discover Brezzo dedication to innovation and excellence in the world of ceramics and digital presentation.\r\n\r\n', NULL, 'tegelwerk ', 'Web Development', 'Netherlands', 'https://tegelwerk.co/', '2025-07-20', '2025-08-10', '', '6924eff4bef3c_1764028404.png', 0, 1, 0, '2025-11-24 23:53:24', '2025-11-25 21:20:36'),
(14, 'Tashawan Expo', NULL, 'tashawan-expo-1', 'Introducing our recent project, Tashawan Exhibitions — a dynamic platform built for an international exhibition company connecting global industries and innovators.', NULL, 'Elegant and fully responsive design\r\n\r\nPowerful and scalable backend\r\n\r\nAdvanced booking and exhibitor management system\r\n\r\nSeamless multilingual experience\r\n\r\nDiscover Brezzo’s dedication to creating digital solutions that elevate global brands and transform the exhibition experience.\r\n\r\n', NULL, 'Tashawan Group', 'Web Development', 'Iraq', 'https://tashawan.net/', '2025-09-15', '2025-10-15', '', '692644cf5825f_1764115663.png', 0, 1, 0, '2025-11-26 00:07:43', '2025-11-26 00:10:48'),
(15, 'Sozvin Store', NULL, 'sozvin-store', 'Introducing our recent project, Sozvin Store — an elegant online store crafted for women’s fashion, bringing style and convenience together.\r\n', NULL, 'Fully responsive and mobile-friendly design\r\n\r\nSecure and seamless shopping experience\r\n\r\nEasy-to-manage product catalog and inventory\r\n\r\nSmooth and intuitive user interface for effortless browsing\r\n\r\nDiscover Brezzo’s commitment to creating digital experiences that empower fashion brands and delight their customers.', NULL, 'Sozvin for Women Clothes', 'Web Development', 'Syria', 'https://sozvin.store/', '2025-08-24', '2025-09-09', '', '692645f21468a_1764115954.png', 0, 1, 0, '2025-11-26 00:12:34', '2025-11-26 00:14:22'),
(16, 'Salon Exclusive', NULL, 'salon-exclusive-1', 'Introducing our recent project, Salon Exclusive — a stylish online store designed for women’s hair care products, combining beauty with convenience.', NULL, 'Fully responsive and mobile-friendly design\r\n\r\nSecure and seamless shopping experience\r\n\r\nEasy-to-manage product catalog and inventory\r\n\r\nSmooth and intuitive user interface for effortless browsing\r\n\r\nExperience Brezzo’s dedication to building digital solutions that elevate beauty brands and delight customers', NULL, 'Salon Exclusive', 'Web Development', 'Norway', 'https://www.salonexclusive.no/', '2025-10-20', '2025-11-10', '', '692646ca3b68f_1764116170.png', 0, 1, 0, '2025-11-26 00:16:10', '2025-11-26 00:19:50'),
(17, 'Goalchii', NULL, 'goalchii-1', 'Introducing our latest project, Goalchii — a modern sportswear store built to empower athletes, fitness lovers, and everyday movers.', NULL, 'Sleek, performance-focused design inspired by today’s athletic lifestyle\r\n\r\nLightning-fast, fully responsive shopping experience\r\n\r\nSmart product filtering for quick access to sportswear, footwear, and accessories\r\n\r\nIntegrated inventory and order management for smooth operations\r\n\r\nMultilingual support for a seamless shopping journey across regions\r\n\r\nExperience Goalchii’s commitment to high-quality sports fashion, innovation, and comfort — crafted to help every customer perform at their best.', NULL, 'Goalchii Store', 'Web Development', 'Iraq', 'https://goalchii.shop/store/index.php', '2025-10-27', '2025-11-24', '', '69264f8d0044f_1764118413.png', 0, 1, 0, '2025-11-26 00:53:33', '2025-11-26 00:56:12'),
(18, 'Erbil Quartz Hotel', NULL, 'erbil-quartz-hotel', 'We were so happy to work with a great partner such as Erbil Quartz Hotel to manage their social media and marketing ', NULL, 'Managing Social media \r\nManaging Marketing \r\nProduction including photography & videography', NULL, 'Erbil Quartz Hotel', 'Marketing', 'Iraq', '', '2026-01-01', '0000-00-00', '', '696a2151c9d63_1768563025.jpeg', 0, 1, 0, '2026-01-16 11:30:27', '2026-01-16 11:30:27'),
(19, 'J-K Beauty Salon', NULL, 'j-k-beauty-salon-1', 'Introducing our recent project, J-K Beauty Salon — a stylish online website designed for women’s care treatments, combining beauty with convenience.\r\n\r\n', NULL, 'Fully responsive and mobile-friendly design\r\n\r\nEasy-to-manage product catalog and inventory\r\n\r\nSmooth and intuitive user interface for effortless browsing\r\n\r\nExperience Brezzo’s dedication to building digital solutions that elevate beauty brands and delight customers', NULL, 'J-K Beauty Salon', 'Web Development', 'Norway', 'https://www.j-kbeauty.no/', '2026-03-02', '2026-03-18', '', '69c5b582ed289_1774564738.png', 0, 1, 0, '2026-03-26 22:38:58', '2026-03-26 22:39:37'),
(20, 'JK Flow', NULL, 'jk-flow', 'Introducing our latest project at JK Flow — a modern, high-performance digital solution built for a tech-focused business, combining clean design, seamless functionality, and optimized user experience to deliver real-world results.', NULL, '', NULL, 'JK Flow', 'Web Development', 'Norway', '', '2026-05-05', '2026-05-19', '', '6a0f91caa729b_1779405258.png', 0, 1, 0, '2026-05-21 23:14:18', '2026-05-21 23:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `project_images`
--

CREATE TABLE `project_images` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_images`
--

INSERT INTO `project_images` (`id`, `project_id`, `filename`, `alt_text`, `sort_order`, `created_at`) VALUES
(13, 11, '6924ed9c70aa4_1764027804.png', '', 0, '2025-11-24 23:43:24'),
(14, 11, '6924ed9c71984_1764027804.png', '', 1, '2025-11-24 23:43:24'),
(15, 11, '6924ed9c71e76_1764027804.png', '', 2, '2025-11-24 23:43:24'),
(16, 11, '6924ed9c7256c_1764027804.png', '', 3, '2025-11-24 23:43:24'),
(17, 11, '6924ed9c729ba_1764027804.png', '', 4, '2025-11-24 23:43:24'),
(18, 11, '6924ed9c72e75_1764027804.png', '', 5, '2025-11-24 23:43:24'),
(19, 11, '6924ed9c731ca_1764027804.png', '', 6, '2025-11-24 23:43:24'),
(20, 11, '6924ed9c734d4_1764027804.png', '', 7, '2025-11-24 23:43:24'),
(21, 12, '6924ef3f287d9_1764028223.png', '', 0, '2025-11-24 23:50:23'),
(22, 12, '6924ef3f29348_1764028223.png', '', 1, '2025-11-24 23:50:23'),
(23, 12, '6924ef3f29ead_1764028223.png', '', 2, '2025-11-24 23:50:23'),
(24, 12, '6924ef3f2a92c_1764028223.png', '', 3, '2025-11-24 23:50:23'),
(25, 12, '6924ef3f2b1fc_1764028223.png', '', 4, '2025-11-24 23:50:23'),
(26, 12, '6924ef3f2bcc7_1764028223.png', '', 5, '2025-11-24 23:50:23'),
(27, 13, '6924eff4c0739_1764028404.png', '', 0, '2025-11-24 23:53:24'),
(28, 13, '6924eff4c1c8f_1764028404.png', '', 1, '2025-11-24 23:53:24'),
(29, 13, '6924eff4c20e7_1764028404.png', '', 2, '2025-11-24 23:53:24'),
(30, 13, '6924eff4c266e_1764028404.png', '', 3, '2025-11-24 23:53:24'),
(31, 13, '6924eff4c38a3_1764028404.png', '', 4, '2025-11-24 23:53:24'),
(32, 13, '6924eff4c3fa1_1764028404.png', '', 5, '2025-11-24 23:53:24'),
(33, 13, '6924eff4c54c6_1764028404.png', '', 6, '2025-11-24 23:53:24'),
(34, 14, '692644cf59db7_1764115663.png', '', 0, '2025-11-26 00:07:43'),
(35, 14, '692644cf5b558_1764115663.png', '', 1, '2025-11-26 00:07:43'),
(36, 14, '692644cf5c6c7_1764115663.png', '', 2, '2025-11-26 00:07:43'),
(37, 14, '692644cf5d4b5_1764115663.png', '', 3, '2025-11-26 00:07:43'),
(38, 14, '692644cf5e4d1_1764115663.png', '', 4, '2025-11-26 00:07:43'),
(39, 14, '692644cf6012d_1764115663.png', '', 5, '2025-11-26 00:07:43'),
(40, 14, '692644cf60f40_1764115663.png', '', 6, '2025-11-26 00:07:43'),
(41, 14, '692644cf618e4_1764115663.png', '', 7, '2025-11-26 00:07:43'),
(42, 14, '692644cf61e4b_1764115663.png', '', 8, '2025-11-26 00:07:43'),
(43, 15, '692645f215600_1764115954.png', '', 0, '2025-11-26 00:12:34'),
(44, 15, '692645f216323_1764115954.png', '', 1, '2025-11-26 00:12:34'),
(45, 15, '692645f217245_1764115954.png', '', 2, '2025-11-26 00:12:34'),
(46, 15, '692645f2174ae_1764115954.png', '', 3, '2025-11-26 00:12:34'),
(47, 15, '692645f217b3d_1764115954.png', '', 4, '2025-11-26 00:12:34'),
(48, 15, '692645f217f0c_1764115954.png', '', 5, '2025-11-26 00:12:34'),
(49, 16, '692646ca3cca0_1764116170.png', '', 0, '2025-11-26 00:16:10'),
(50, 16, '692646ca3e0e6_1764116170.png', '', 1, '2025-11-26 00:16:10'),
(51, 16, '692646ca3f99d_1764116170.png', '', 2, '2025-11-26 00:16:10'),
(52, 16, '692646ca40339_1764116170.png', '', 3, '2025-11-26 00:16:10'),
(53, 16, '692646ca409ed_1764116170.png', '', 4, '2025-11-26 00:16:10'),
(54, 16, '692646ca40eca_1764116170.png', '', 5, '2025-11-26 00:16:10'),
(55, 16, '692646ca4211e_1764116170.png', '', 6, '2025-11-26 00:16:10'),
(56, 16, '692646ca42a5d_1764116170.png', '', 7, '2025-11-26 00:16:10'),
(57, 16, '692646ca43208_1764116170.png', '', 8, '2025-11-26 00:16:10'),
(58, 16, '692646ca4355f_1764116170.png', '', 9, '2025-11-26 00:16:10'),
(59, 17, '69264f8d0dfdc_1764118413.png', '', 0, '2025-11-26 00:53:33'),
(60, 17, '69264f8d0f275_1764118413.png', '', 1, '2025-11-26 00:53:33'),
(61, 17, '69264f8d0f7d1_1764118413.png', '', 2, '2025-11-26 00:53:33'),
(62, 17, '69264f8d0fb28_1764118413.png', '', 3, '2025-11-26 00:53:33'),
(63, 17, '69264f8d1029a_1764118413.png', '', 4, '2025-11-26 00:53:33'),
(64, 17, '69264f8d10624_1764118413.png', '', 5, '2025-11-26 00:53:33'),
(65, 17, '69264f8d10f76_1764118413.png', '', 6, '2025-11-26 00:53:33'),
(66, 18, '696a215313513_1768563027.jpeg', '', 0, '2026-01-16 11:30:27'),
(67, 18, '696a215313e8b_1768563027.jpeg', '', 1, '2026-01-16 11:30:27'),
(68, 18, '696a2153143ad_1768563027.jpeg', '', 2, '2026-01-16 11:30:27'),
(69, 18, '696a2153148c9_1768563027.jpeg', '', 3, '2026-01-16 11:30:27'),
(70, 18, '696a215314dbc_1768563027.jpeg', '', 4, '2026-01-16 11:30:27'),
(71, 18, '696a215315389_1768563027.jpeg', '', 5, '2026-01-16 11:30:27'),
(72, 18, '696a2153157fe_1768563027.jpeg', '', 6, '2026-01-16 11:30:27'),
(73, 18, '696a215315ba5_1768563027.jpeg', '', 7, '2026-01-16 11:30:27'),
(74, 18, '696a215316056_1768563027.jpeg', '', 8, '2026-01-16 11:30:27'),
(75, 19, '69c5b582ee5e1_1774564738.png', '', 0, '2026-03-26 22:38:58'),
(76, 19, '69c5b582ef73c_1774564738.png', '', 1, '2026-03-26 22:38:58'),
(77, 19, '69c5b582efbf8_1774564738.png', '', 2, '2026-03-26 22:38:58'),
(78, 19, '69c5b582f0b38_1774564738.png', '', 3, '2026-03-26 22:38:58'),
(79, 19, '69c5b582f10a9_1774564738.png', '', 4, '2026-03-26 22:38:58'),
(80, 20, '6a0f91caa7f32_1779405258.png', '', 0, '2026-05-21 23:14:18'),
(81, 20, '6a0f91caa871a_1779405258.png', '', 1, '2026-05-21 23:14:18'),
(82, 20, '6a0f91caa8a37_1779405258.png', '', 2, '2026-05-21 23:14:18'),
(83, 20, '6a0f91caa8eed_1779405258.png', '', 3, '2026-05-21 23:14:18'),
(84, 20, '6a0f91caa97d4_1779405258.png', '', 4, '2026-05-21 23:14:18'),
(85, 20, '6a0f91caa9c40_1779405258.png', '', 5, '2026-05-21 23:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` longtext DEFAULT NULL,
  `setting_type` enum('text','textarea','json','boolean','number') DEFAULT 'text',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `setting_type`, `created_at`, `updated_at`) VALUES
(1, 'site_title', 'Brezzo - Creative Digital Agency', 'text', '2025-11-13 23:24:46', '2025-11-13 23:24:46'),
(2, 'site_description', 'We create exceptional digital experiences that drive results', 'textarea', '2025-11-13 23:24:46', '2025-11-13 23:24:46'),
(3, 'contact_email', 'info@brezzo.com', 'text', '2025-11-13 23:24:46', '2025-11-13 23:24:46'),
(4, 'contact_phone', '+1 (555) 123-4567', 'text', '2025-11-13 23:24:46', '2025-11-13 23:24:46'),
(5, 'contact_address', '123 Business St, Creative District, NY 10001', 'textarea', '2025-11-13 23:24:46', '2025-11-13 23:24:46'),
(6, 'social_facebook', 'https://facebook.com/brezzo', 'text', '2025-11-13 23:24:46', '2025-11-13 23:24:46'),
(7, 'social_twitter', 'https://twitter.com/brezzo', 'text', '2025-11-13 23:24:46', '2025-11-13 23:24:46'),
(8, 'social_instagram', 'https://instagram.com/brezzo', 'text', '2025-11-13 23:24:46', '2025-11-13 23:24:46'),
(9, 'social_linkedin', 'https://linkedin.com/company/brezzo', 'text', '2025-11-13 23:24:46', '2025-11-13 23:24:46'),
(10, 'google_analytics', '', 'textarea', '2025-11-13 23:24:46', '2025-11-13 23:24:46'),
(11, 'recaptcha_site_key', '', 'text', '2025-11-13 23:24:46', '2025-11-13 23:24:46'),
(12, 'recaptcha_secret_key', '', 'text', '2025-11-13 23:24:46', '2025-11-13 23:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','editor') DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `email`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@brezzo.com', 'admin', '2025-11-13 23:24:46', '2025-11-13 23:24:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_action` (`action`),
  ADD KEY `idx_entity_type` (`entity_type`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_admin_username` (`username`),
  ADD KEY `idx_admin_email` (`email`),
  ADD KEY `idx_admin_active` (`active`);

--
-- Indexes for table `blog_post_images`
--
ALTER TABLE `blog_post_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_post_id` (`post_id`),
  ADD KEY `idx_sort_order` (`sort_order`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_slug` (`slug`),
  ADD KEY `idx_is_visible` (`is_visible`),
  ADD KEY `idx_is_popular` (`is_popular`),
  ADD KEY `idx_sort_order` (`sort_order`),
  ADD KEY `idx_packages_created_at` (`created_at`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_is_visible` (`is_visible`),
  ADD KEY `idx_sort_order` (`sort_order`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_slug` (`slug`),
  ADD KEY `idx_category` (`category`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_publish_date` (`publish_date`),
  ADD KEY `idx_posts_created_at` (`created_at`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_slug` (`slug`),
  ADD KEY `idx_category` (`category`),
  ADD KEY `idx_visible` (`visible`),
  ADD KEY `idx_sort_order` (`sort_order`),
  ADD KEY `idx_projects_created_at` (`created_at`);

--
-- Indexes for table `project_images`
--
ALTER TABLE `project_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_project_id` (`project_id`),
  ADD KEY `idx_sort_order` (`sort_order`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`),
  ADD KEY `idx_setting_key` (`setting_key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_username` (`username`),
  ADD KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_post_images`
--
ALTER TABLE `blog_post_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `project_images`
--
ALTER TABLE `project_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `blog_post_images`
--
ALTER TABLE `blog_post_images`
  ADD CONSTRAINT `blog_post_images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_images`
--
ALTER TABLE `project_images`
  ADD CONSTRAINT `project_images_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
