-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2025 at 07:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `advisors`
--

CREATE TABLE `advisors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `expertise` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advisors`
--

INSERT INTO `advisors` (`id`, `name`, `expertise`, `profile_picture`, `email`) VALUES
(1, 'Nimali Perera', 'SEO & SEM Specialist', 'nimali.png', 'nimali.perera@growthgrid.com'),
(2, 'Tharindu Silva', 'Social Media Strategist', 'tharindu.avif', 'tharindu.silva@growthgrid.com'),
(3, 'Dinithi Fernando', 'Content Marketing Expert', 'dinithi.webp', 'dinithi.fernando@growthgrid.com'),
(4, 'Kavindu Jayasuriya', 'Email Marketing Specialist', 'kavindu.jpeg', 'kavindu.jayasuriya@growthgrid.com'),
(5, 'Ishara Karunaratne', 'Google Ads Consultant', 'ishara.jpeg', 'ishara.karunaratne@growthgrid.com'),
(6, 'Ruwini Gunasekara', 'Digital Campaign Planner', 'ruwini.jpeg', 'ruwini.gunasekara@growthgrid.com'),
(7, 'Janith Perera', 'Marketing Analytics Consultant', 'janith.jpeg', 'janith.perera@growthgrid.com'),
(8, 'Shehani Wickramasinghe', 'Influencer Marketing Advisor', 'shehani.jpg', 'shehani.wickrama@growthgrid.com'),
(9, 'Sahan Rajapaksha', 'E-commerce Growth Specialist', 'sahan.webp', 'sahan.rajapaksha@growthgrid.com'),
(10, 'Chalani Dissanayake', 'Brand Strategy & Online PR', 'chalani.png', 'chalani.dissanayake@growthgrid.com'),
(11, 'Thiyagarajah Kabilashika', 'Data Analysis', 'kabilashika.jpg', 'kabilashika@growthgrid.com'),
(12, 'Gunaseelan Dhanushika', 'Content Marketing', 'dhanushika.jpg', 'dhanushika@growthgrid.com'),
(13, 'Sathananthan Paventhiran', 'Digital Strategy', 'paventhiran.jpg', 'paventhiran@growthgrid.com'),
(14, 'Davidpillay Warrenpillay', 'Social Media Campaigns', 'warren.jpg', 'warrenpillay@growthgrid.com'),
(15, 'Dilaksi Jeyakumar', 'E-commerce Growth', 'dilakshi.jpeg', 'dilaksi@growthgrid.com');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `submitted_at`) VALUES
(1, 'Ramya', 'ramya@gmail.com', 'Testing', '2025-07-19 11:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `difficulty` varchar(50) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `course_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `category`, `created_at`, `difficulty`, `duration`, `course_image`) VALUES
(1, 'SEO Fundamentals', 'Learn the basics of Search Engine Optimization.', NULL, '2025-07-20 14:56:27', 'Beginner', 10, 'seo2.jpg'),
(2, 'Social Media Marketing', 'Explore techniques for Facebook, Instagram, and LinkedIn.', NULL, '2025-07-20 14:56:27', 'Beginner', 12, 'smm2.avif'),
(3, 'Google Ads Mastery', 'Run effective paid campaigns on Google.', NULL, '2025-07-20 14:56:27', 'Intermediate', 15, 'ads.jpg'),
(4, 'Content Strategy & Blogging', 'Plan and execute content-driven marketing.', NULL, '2025-07-20 14:56:27', 'Intermediate', 14, 'strategy.webp'),
(5, 'Data Analytics with Google Tools', 'Analyze campaign data using GA4 and Google Tag Manager.', NULL, '2025-07-20 14:56:27', 'Advanced', 20, 'data.jpeg'),
(6, 'Search Engine Optimization (SEO)', 'Optimize websites to rank higher in search engines using on-page and off-page techniques for increased visibility.', 'Marketing', '2025-07-20 15:48:03', 'Intermediate', 4, 'seo.png'),
(7, 'Pay-Per-Click Advertising (PPC)', 'Learn to run targeted paid ads on platforms like Google Ads to drive traffic and measure ROI.', 'Advertising', '2025-07-20 15:48:03', 'Beginner', 3, 'ppc.webp'),
(8, 'Social Media Marketing (SMM)', 'Use platforms like Facebook, Instagram, and LinkedIn to promote brands and engage with customers.', 'Marketing', '2025-07-20 15:48:03', 'Beginner', 4, 'social.jpg'),
(9, 'Content Marketing', 'Develop strategies for creating valuable blogs, videos, and infographics to attract and retain customers.', 'Marketing', '2025-07-20 15:48:03', 'Intermediate', 5, 'content.jpg'),
(10, 'Email Marketing', 'Create targeted email campaigns to nurture leads, promote products, and increase customer retention.', 'Marketing Automation', '2025-07-20 15:48:03', 'Beginner', 2, 'email.png'),
(11, 'Affiliate Marketing', 'Learn how to use third-party affiliates to increase product sales and drive performance-based marketing.', 'Sales & Performance', '2025-07-20 15:48:03', 'Intermediate', 3, 'affiliate.png'),
(12, 'Online Reputation Management (ORM)', 'Manage and improve a brand’s image by addressing reviews, feedback, and public perception online.', 'Public Relations', '2025-07-20 15:48:03', 'Intermediate', 3, 'orm.jpg'),
(13, 'Conversion Rate Optimization (CRO)', 'Enhance website elements to improve the percentage of visitors converting into customers.', 'Analytics & UX', '2025-07-20 15:48:03', 'Advanced', 4, 'cro.webp'),
(14, 'Influencer Marketing', 'Work with social media influencers to increase product visibility, trust, and engagement.', 'Branding', '2025-07-20 15:48:03', 'Beginner', 2, 'influencer.png'),
(15, 'Video Marketing', 'Create compelling video content to boost engagement, brand recognition, and product sales.', 'Creative Media', '2025-07-20 15:48:03', 'Intermediate', 3, 'marketing.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `creators`
--

CREATE TABLE `creators` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `creators`
--

INSERT INTO `creators` (`id`, `name`, `skills`, `profile_picture`, `bio`, `created_at`) VALUES
(1, 'Alice Perera', 'Social Media Marketing, Instagram Ads', 'alice.jpg', 'Creative strategist with a flair for engaging Instagram audiences.', '2025-07-22 01:00:52'),
(2, 'Brian Silva', 'SEO, Google Analytics', 'brian.jpg', 'Data-driven SEO consultant helping brands rank higher on search engines.', '2025-07-22 01:00:52'),
(3, 'Chathura Fernando', 'Facebook Ads, Conversion Optimization', 'chathura.jpg', 'Helping small businesses grow with high-ROI Facebook campaigns.', '2025-07-22 01:00:52'),
(4, 'Dilani Wijesinghe', 'Content Writing, Blogging', 'dilani.jpg', 'Skilled content writer passionate about tech, health, and education topics.', '2025-07-22 01:00:52'),
(5, 'Eshan Gunawardana', 'YouTube Marketing, Video Editing', 'eshan.jpg', 'YouTube growth expert helping creators scale with content strategy.', '2025-07-22 01:00:52'),
(6, 'Farah Rizwan', 'Influencer Marketing, Brand Campaigns', 'farah.jpg', 'Connecting lifestyle influencers with emerging brands.', '2025-07-22 01:00:52'),
(7, 'Gayan Amarasinghe', 'Email Marketing, Lead Generation', 'gayan.jpg', 'Crafting compelling email funnels that convert subscribers to customers.', '2025-07-22 01:00:52'),
(8, 'Hasini de Silva', 'Pinterest Ads, Ecommerce Marketing', 'hasini.jpg', 'Helping D2C brands thrive on Pinterest and visual search platforms.', '2025-07-22 01:00:52'),
(9, 'Ishan Madushanka', 'LinkedIn Marketing, B2B Strategy', 'ishan.jpg', 'Driving B2B visibility and connections via LinkedIn campaigns.', '2025-07-22 01:00:52'),
(10, 'Janani Rajapaksha', 'Copywriting, Brand Voice Design', 'janani.jpg', 'Helping startups craft powerful brand messages with strategic copy.', '2025-07-22 01:00:52'),
(11, 'Kasun Jayasuriya', 'Web Analytics, CRO', 'kasun.jpg', 'Specialist in interpreting digital data to improve marketing ROI.', '2025-07-22 01:00:52'),
(12, 'Lahiru Senanayake', 'TikTok Ads, Gen Z Engagement', 'lahiru.jpg', 'Viral campaign designer for TikTok-first digital brands.', '2025-07-22 01:00:52'),
(13, 'Madhavi Nimal', 'Affiliate Marketing, Influencer Deals', 'madhavi.jpg', 'Negotiating and managing influencer-based affiliate partnerships.', '2025-07-22 01:00:52'),
(14, 'Nadeesha Gunasekara', 'Online PR, Media Outreach', 'nadeesha.jpg', 'Generating brand buzz with targeted digital press coverage.', '2025-07-22 01:00:52'),
(15, 'Osanda Liyanage', 'Facebook Pixel, Retargeting', 'osanda.jpg', 'Expert in advanced Facebook tracking and retargeting.', '2025-07-22 01:00:52'),
(16, 'Prabodha Samarasinghe', 'SEM, Google Ads', 'prabodha.jpg', 'Certified Google Ads expert optimizing search ad performance.', '2025-07-22 01:00:52'),
(17, 'Ruwani Dissanayake', 'UI/UX for Campaign Landing Pages', 'ruwani.jpg', 'Designer optimizing landing pages for better conversions.', '2025-07-22 01:00:52'),
(18, 'Sajith Ranasinghe', 'Marketing Automation, CRM Integration', 'sajith.jpg', 'Automating campaigns using HubSpot and Mailchimp integrations.', '2025-07-22 01:00:52'),
(19, 'Thilina Weerasekara', 'Snapchat Ads, Influencer Outreach', 'thilina.jpg', 'Helping fashion brands connect with Gen Z audiences.', '2025-07-22 01:00:52'),
(20, 'Upeksha Karunaratne', 'Event Marketing, Webinar Promotions', 'upeksha.jpg', 'Driving webinar attendance through email and social promos.', '2025-07-22 01:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `progress` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `progress`) VALUES
(1, 5, 1, 80),
(2, 5, 2, 45),
(3, 5, 4, 100),
(4, 5, 5, 0),
(6, 5, 7, 0),
(7, 5, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_advisors`
--

CREATE TABLE `enterprise_advisors` (
  `id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `advisor_id` int(11) NOT NULL,
  `connected_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enterprise_advisors`
--

INSERT INTO `enterprise_advisors` (`id`, `enterprise_id`, `advisor_id`, `connected_at`) VALUES
(1, 7, 12, '2025-07-23 11:03:01'),
(2, 7, 11, '2025-07-23 17:51:05');

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_creators`
--

CREATE TABLE `enterprise_creators` (
  `id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `requested_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_enrollments`
--

CREATE TABLE `enterprise_enrollments` (
  `id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `progress` int(11) DEFAULT 0,
  `enrolled_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enterprise_enrollments`
--

INSERT INTO `enterprise_enrollments` (`id`, `enterprise_id`, `course_id`, `progress`, `enrolled_at`) VALUES
(1, 7, 7, 0, '2025-07-23 10:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_forum_comments`
--

CREATE TABLE `enterprise_forum_comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enterprise_forum_comments`
--

INSERT INTO `enterprise_forum_comments` (`id`, `post_id`, `enterprise_id`, `comment`, `created_at`) VALUES
(1, 1, 7, 'good', '2025-07-23 17:52:11');

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_forum_posts`
--

CREATE TABLE `enterprise_forum_posts` (
  `id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enterprise_forum_posts`
--

INSERT INTO `enterprise_forum_posts` (`id`, `enterprise_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 7, 'Digital Marketing', 'Evolving', '2025-07-23 17:51:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_services`
--

CREATE TABLE `enterprise_services` (
  `id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enterprise_services`
--

INSERT INTO `enterprise_services` (`id`, `enterprise_id`, `service_id`, `subscribed_at`) VALUES
(1, 7, 14, '2025-07-23 10:11:08'),
(2, 7, 1, '2025-07-23 10:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_toolkit`
--

CREATE TABLE `enterprise_toolkit` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `tool_url` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enterprise_toolkit`
--

INSERT INTO `enterprise_toolkit` (`id`, `title`, `description`, `category`, `tool_url`, `created_at`) VALUES
(1, 'ChatGPT Prompt Generator', 'Get optimized prompts for ChatGPT for marketing and business tasks.', 'AI-powered tool suggestions', 'https://toolbuilder.ai/chatgpt-prompts', '2025-07-23 10:53:12'),
(2, 'Jasper AI', 'Create high-converting marketing copy using AI.', 'AI-powered tool suggestions', 'https://www.jasper.ai', '2025-07-23 10:53:12'),
(3, 'Copy.ai', 'Generate email content, ads, and blog posts using AI.', 'AI-powered tool suggestions', 'https://www.copy.ai', '2025-07-23 10:53:12'),
(4, 'Synthesia', 'AI video generator for presentations and training.', 'AI-powered tool suggestions', 'https://www.synthesia.io', '2025-07-23 10:53:12'),
(5, 'Grammarly Business', 'AI-enhanced grammar and tone checker for teams.', 'AI-powered tool suggestions', 'https://www.grammarly.com/business', '2025-07-23 10:53:12'),
(6, 'Company Budget Calculator', 'Estimate startup costs and operational expenses.', 'Budget Calculators', 'https://www.score.org/resource/startup-expense-calculator', '2025-07-23 10:53:12'),
(7, 'Cash Flow Forecast Tool', 'Plan your monthly cash inflow and outflow.', 'Budget Calculators', 'https://templates.office.com/en-us/cash-flow-forecast-tm16368962', '2025-07-23 10:53:12'),
(8, 'Marketing Budget Calculator', 'Allocate spending across channels.', 'Budget Calculators', 'https://www.digitalmarketer.com/blog/marketing-budget-calculator', '2025-07-23 10:53:12'),
(9, 'Break-Even Calculator', 'Calculate how much you need to sell to break even.', 'Budget Calculators', 'https://www.shopify.com/tools/break-even-calculator', '2025-07-23 10:53:12'),
(10, 'Business Loan Calculator', 'Estimate monthly payments for a business loan.', 'Budget Calculators', 'https://www.bankrate.com/loans/business-loan-calculator', '2025-07-23 10:53:12'),
(11, 'LivePlan Business Planner', 'Step-by-step business plan builder.', 'Business Plan Templates', 'https://www.liveplan.com', '2025-07-23 10:53:12'),
(12, 'SBA Business Plan Tool', 'Official U.S. Small Business Administration planner.', 'Business Plan Templates', 'https://www.sba.gov/business-guide/plan-your-business/write-your-business-plan', '2025-07-23 10:53:12'),
(13, 'One-Page Business Plan Template', 'Simple business plan on one page.', 'Business Plan Templates', 'https://www.score.org/resource/business-plan-template-startup-business', '2025-07-23 10:53:12'),
(14, 'Lean Canvas Template', 'Visual business model plan for startups.', 'Business Plan Templates', 'https://leanstack.com/leancanvas', '2025-07-23 10:53:12'),
(15, 'Excel Business Plan Template', 'Editable Excel business plan template.', 'Business Plan Templates', 'https://templates.office.com/en-us/simple-business-plan-template-tm00000005', '2025-07-23 10:53:12'),
(16, 'NDAs (Non-Disclosure Agreements)', 'Download sample NDA contracts for business.', 'Legal Document Samples', 'https://www.legaltemplates.net/form/nda/', '2025-07-23 10:53:12'),
(17, 'Business Partnership Agreement', 'Agreement template for startup partners.', 'Legal Document Samples', 'https://www.rocketlawyer.com', '2025-07-23 10:53:12'),
(18, 'Freelancer Contract Template', 'Legal contract for hiring freelancers.', 'Legal Document Samples', 'https://www.honeybook.com/blog/freelance-contract-template', '2025-07-23 10:53:12'),
(19, 'Terms and Conditions Generator', 'Create terms for your website/app.', 'Legal Document Samples', 'https://termly.io/products/terms-and-conditions-generator/', '2025-07-23 10:53:12'),
(20, 'Privacy Policy Generator', 'Auto-generate a GDPR-compliant privacy policy.', 'Legal Document Samples', 'https://www.freeprivacypolicy.com', '2025-07-23 10:53:12'),
(21, 'Canva', 'Easy drag-and-drop logo and design creation.', 'Logo & Design Tools', 'https://www.canva.com', '2025-07-23 10:53:12'),
(22, 'Looka Logo Maker', 'AI-powered logo design for startups.', 'Logo & Design Tools', 'https://looka.com', '2025-07-23 10:53:12'),
(23, 'Hatchful by Shopify', 'Free logo generator.', 'Logo & Design Tools', 'https://hatchful.shopify.com', '2025-07-23 10:53:12'),
(24, 'Brandmark.io', 'AI-generated brand identity kits.', 'Logo & Design Tools', 'https://brandmark.io', '2025-07-23 10:53:12'),
(25, 'Figma', 'Advanced design collaboration tool for teams.', 'Logo & Design Tools', 'https://www.figma.com', '2025-07-23 10:53:12'),
(26, 'Trello Marketing Calendar', 'Organize your strategy using Trello boards.', 'Marketing Strategy Planners', 'https://trello.com/templates/marketing', '2025-07-23 10:53:12'),
(27, 'HubSpot Campaign Planner', 'All-in-one marketing campaign planner.', 'Marketing Strategy Planners', 'https://blog.hubspot.com/marketing/marketing-planning-template', '2025-07-23 10:53:12'),
(28, 'Notion Marketing Planner', 'Use Notion to structure monthly marketing goals.', 'Marketing Strategy Planners', 'https://www.notion.so/Marketing-Planner-Template', '2025-07-23 10:53:12'),
(29, 'Airtable Campaign Tracker', 'Track KPIs and marketing deliverables.', 'Marketing Strategy Planners', 'https://airtable.com/templates/marketing', '2025-07-23 10:53:12'),
(30, 'Google Sheets Marketing Plan', 'Editable spreadsheet template for planning.', 'Marketing Strategy Planners', 'https://docs.google.com/spreadsheets', '2025-07-23 10:53:12'),
(31, 'Sequoia Pitch Deck Template', 'Legendary VC-approved pitch format.', 'Pitch Deck Templates', 'https://docs.google.com/presentation/d/1V4y', '2025-07-23 10:53:12'),
(32, 'Slidebean Pitch Decks', 'Beautiful, AI-designed pitch decks.', 'Pitch Deck Templates', 'https://slidebean.com', '2025-07-23 10:53:12'),
(33, 'Canva Pitch Deck', 'Customizable startup pitch deck template.', 'Pitch Deck Templates', 'https://www.canva.com/presentations/templates/pitch-deck', '2025-07-23 10:53:12'),
(34, 'Pitch.com', 'Collaborative pitch deck creation tool.', 'Pitch Deck Templates', 'https://pitch.com', '2025-07-23 10:53:12'),
(35, 'Startup Pitch Guide by Y Combinator', 'YC’s structure for early-stage fundraising decks.', 'Pitch Deck Templates', 'https://www.ycombinator.com/library', '2025-07-23 10:53:12'),
(36, 'Hootsuite Content Calendar', 'Plan and publish social content in one place.', 'Social Media Content Calendars', 'https://blog.hootsuite.com/social-media-content-calendar', '2025-07-23 10:53:12'),
(37, 'Buffer Content Planner', 'Visualize and schedule weekly content.', 'Social Media Content Calendars', 'https://buffer.com/library/social-media-calendar/', '2025-07-23 10:53:12'),
(38, 'Notion Social Calendar', 'Manage your social media team on Notion.', 'Social Media Content Calendars', 'https://www.notion.so/templates/social-media-calendar', '2025-07-23 10:53:12'),
(39, 'Later Social Scheduler', 'Drag-and-drop Instagram planner.', 'Social Media Content Calendars', 'https://later.com', '2025-07-23 10:53:12'),
(40, 'Trello Social Media Template', 'Kanban-style editorial content board.', 'Social Media Content Calendars', 'https://trello.com/b/your-board-url', '2025-07-23 10:53:12');

-- --------------------------------------------------------

--
-- Table structure for table `freelancers`
--

CREATE TABLE `freelancers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `expertise` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `internships`
--

CREATE TABLE `internships` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'open',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internships`
--

INSERT INTO `internships` (`id`, `title`, `company_name`, `description`, `status`, `created_at`) VALUES
(1, 'Digital Marketing Intern', 'TechSpark', 'Assist with campaign creation and reporting.', 'open', '2025-07-20 14:07:45'),
(2, 'Digital Marketing Intern', 'PixelTech Solutions', 'Assist with campaign planning and keyword research.', 'open', '2025-07-20 15:05:28'),
(3, 'SEO Assistant Intern', 'RankRise Pvt Ltd', 'Help in optimizing client websites and preparing reports.', 'open', '2025-07-20 15:05:28'),
(4, 'Content Creation Intern', 'Brandwave Agency', 'Support video scripting, blogging, and social content.', 'open', '2025-07-20 15:05:28'),
(5, 'Analytics Intern', 'Insight.lk', 'Work with GA4 and visualize performance KPIs.', 'open', '2025-07-20 15:05:28'),
(6, 'Email Marketing Intern', 'Clicks & Leads', 'Setup email campaigns and run A/B tests.', 'open', '2025-07-20 15:05:28'),
(8, 'SEO intern', 'Admin', 'No paid', 'Open', '2025-07-22 01:16:54'),
(11, 'Digital marketing intern', 'Admin', 'Paid | Full time', 'Open', '2025-07-22 12:55:13'),
(12, 'Content creation intern', 'Kabilashika', 'Paid', 'Open', '2025-07-23 16:47:22'),
(13, 'Digital marketing intern', 'Kabilashika', 'No paid', 'Open', '2025-07-23 23:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `internship_applications`
--

CREATE TABLE `internship_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `internship_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Applied',
  `applied_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `cover_letter` text DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `applied_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_postings`
--

CREATE TABLE `job_postings` (
  `id` int(11) NOT NULL,
  `enterprise_id` int(11) DEFAULT NULL,
  `company_type` enum('startup','enterprise') NOT NULL DEFAULT 'startup',
  `startup_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Open',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_postings`
--

INSERT INTO `job_postings` (`id`, `enterprise_id`, `company_type`, `startup_id`, `title`, `description`, `status`, `created_at`) VALUES
(2, NULL, 'startup', 6, 'SEO intern', 'No paid', 'Open', '2025-07-22 01:16:54'),
(3, NULL, 'startup', 6, 'Marketing intern', 'no paid', 'Open', '2025-07-22 01:18:54'),
(5, NULL, 'startup', 6, 'Marketing Analyst', 'Paid | Full time', 'Open', '2025-07-22 12:52:09'),
(7, NULL, 'startup', 6, 'Digital marketing intern', 'Paid | Full time', 'Open', '2025-07-22 12:55:13'),
(8, NULL, 'startup', 6, 'Marketing Manager', 'Full time | paid', 'Open', '2025-07-22 13:00:27'),
(9, 7, 'startup', NULL, 'Content creation intern', 'Paid', 'Open', '2025-07-23 16:47:22'),
(11, 7, 'startup', NULL, 'Digital marketing intern', 'No paid', 'Open', '2025-07-23 23:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `mentors`
--

CREATE TABLE `mentors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `expertise` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mentors`
--

INSERT INTO `mentors` (`id`, `name`, `expertise`, `email`, `profile_picture`, `created_at`) VALUES
(1, 'Jane Doe', 'SEO & Analytics', 'jane@growthgrid.com', 'jane.png', '2025-07-20 14:07:45'),
(2, 'Nuwan Perera', 'SEO, Content Marketing', 'nuwan@growthgrid.com', 'nuwan.jpg', '2025-07-20 15:04:15'),
(3, 'Tharushi Fernando', 'Social Media Strategy', 'tharushi@growthgrid.com', 'tharushi.jpeg', '2025-07-20 15:04:15'),
(4, 'Roshan De Silva', 'Analytics & Data', 'roshan@growthgrid.com', 'roshan.png', '2025-07-20 15:04:15'),
(5, 'Ishara Jayasooriya', 'Email Marketing, CRM', 'ishara@growthgrid.com', 'ishara.jpeg', '2025-07-20 15:04:15'),
(6, 'Kevin Samarasinghe', 'E-commerce Strategy', 'kevin@growthgrid.com', 'kevin.webp', '2025-07-20 15:04:15'),
(7, 'Thiyagarajah Kabilashika', 'Data Analysis', 'kabilashika@growthgrid.com', 'kabilashika.jpg', '2025-07-23 14:52:20'),
(8, 'Gunaseelan Dhanushika', 'Content Marketing', 'dhanushika@growthgrid.com', 'dhanushika.jpg', '2025-07-23 14:52:20'),
(9, 'Sathananthan Paventhiran', 'Data Analysis', 'paventhiran@growthgrid.com', 'paventhiran.jpg', '2025-07-23 14:52:20'),
(10, 'Davidpillay Warrenpillay', 'Social Media Campaigns', 'warrenpillay@growthgrid.com', 'warren.jpg', '2025-07-23 14:52:20'),
(11, 'Dilaksi Jeyakumar', 'E-commerce Growth', 'dilaksi@growthgrid.com', 'dilakshi.jpeg', '2025-07-23 14:52:20');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `category`, `created_at`) VALUES
(1, 'Create a Blog SEO Plan', 'Research keywords and draft an SEO strategy for a sample blog.', 'SEO', '2025-07-20 15:00:13'),
(2, 'Social Campaign Mockup', 'Design and plan a 1-week campaign for a small product.', 'Social Media', '2025-07-20 15:00:13'),
(3, 'E-commerce Analytics Report', 'Use GA4 data to generate insights for an online store.', 'Analytics', '2025-07-20 15:00:13'),
(4, 'Brand Awareness Strategy', 'Design a campaign to boost brand recognition.', 'Content Marketing', '2025-07-20 15:00:13'),
(5, 'Email Funnel Design', 'Plan and automate a 5-step email sequence for conversions.', 'Email Marketing', '2025-07-20 15:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `content`, `rating`, `created_at`) VALUES
(5, 1, 'Very easy to follow and practical.', 5, '2025-07-20 15:06:47'),
(6, 1, 'Interesting project, but needed more guidance.', 4, '2025-07-20 15:06:47'),
(7, 5, 'Great learning experience at Marketify.', 5, '2025-07-20 15:06:47'),
(8, 5, 'Challenging but valuable.', 3, '2025-07-20 15:06:47'),
(9, 5, 'The mentor gave me great insight on SEO tactics. Very helpful session!', 5, '2025-02-20 12:00:00'),
(10, 5, 'The course was good, but could include more real-world examples.', 4, '2025-04-15 18:45:00'),
(11, 5, 'The internships offer valuable practice and knowledge', 4, '2025-07-20 17:19:42'),
(12, 6, 'Good services', 3, '2025-07-21 23:56:10'),
(13, 6, 'Good services', 3, '2025-07-21 23:56:35'),
(14, 6, 'good', 4, '2025-07-22 00:40:57'),
(15, 7, 'Good course content', 4, '2025-07-23 23:09:35'),
(16, 5, 'Good', 4, '2025-07-23 23:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `category`, `price`, `created_at`) VALUES
(1, 'Search Engine Optimization (SEO)', 'Optimize websites to rank higher in search engine results, drive organic traffic, and boost credibility with both on-page and off-page strategies.', 'SEO', 15000.00, '2025-07-21 15:35:02'),
(2, 'Pay-Per-Click Advertising (PPC)', 'Drive immediate leads through ads on search engines and social platforms; pay only when someone clicks.', 'Advertising', 10000.00, '2025-07-21 15:35:02'),
(3, 'Social Media Marketing (SMM)', 'Promote your business on platforms like Facebook, Instagram, LinkedIn to build brand awareness and community engagement.', 'Social Media', 8000.00, '2025-07-21 15:35:02'),
(4, 'Content Marketing', 'Create and distribute blogs, videos, and infographics to build authority, attract customers, and boost SEO.', 'Content', 12000.00, '2025-07-21 15:35:02'),
(5, 'Email Marketing', 'Send newsletters, promos, and personalized emails to nurture leads and build strong customer relationships.', 'Email', 5000.00, '2025-07-21 15:35:02'),
(6, 'Affiliate Marketing', 'Partner with affiliates to drive traffic or sales using commission-based strategies.', 'Affiliate', 7000.00, '2025-07-21 15:35:02'),
(7, 'Online Reputation Management (ORM)', 'Monitor and improve brand image by handling reviews and public perception across the web.', 'Branding', 9000.00, '2025-07-21 15:35:02'),
(8, 'Conversion Rate Optimization (CRO)', 'Analyze user behavior and improve design to increase conversions from existing traffic.', 'Analytics', 8500.00, '2025-07-21 15:35:02'),
(9, 'Influencer Marketing', 'Collaborate with influencers to reach targeted audiences and build trust-driven brand awareness.', 'Social Media', 11000.00, '2025-07-21 15:35:02'),
(10, 'Video Marketing', 'Use explainer videos, testimonials, and product demos to engage users and increase conversions.', 'Content', 13000.00, '2025-07-21 15:35:02'),
(11, 'Mobile Marketing', 'Promote products via mobile apps, SMS, and in-app advertising to reach users on-the-go.', 'Mobile', 9000.00, '2025-07-21 15:35:02'),
(12, 'Web Analytics & Reporting', 'Track visitor behavior and marketing performance using tools like Google Analytics.', 'Analytics', 6000.00, '2025-07-21 15:35:02'),
(13, 'E-commerce Marketing', 'Use digital tools to drive traffic, sales, and customer retention for online stores.', 'E-commerce', 14000.00, '2025-07-21 15:35:02'),
(14, 'Marketing Automation', 'Automate marketing workflows such as emails, lead nurturing, and customer segmentation.', 'Automation', 10000.00, '2025-07-21 15:35:02'),
(15, 'Landing Page Design', 'Create high-converting standalone pages for campaigns, promotions, or product launches.', 'Design', 5000.00, '2025-07-21 15:35:02'),
(16, 'Local SEO', 'Optimize your business for local searches to attract nearby customers and improve map visibility.', 'SEO', 7500.00, '2025-07-21 15:35:02'),
(17, 'Podcast Marketing', 'Leverage audio content to engage listeners and promote services through storytelling.', 'Content', 7000.00, '2025-07-21 15:35:02'),
(18, 'Web Development & Optimization', 'Build fast, responsive, and SEO-friendly websites optimized for conversion.', 'Web', 20000.00, '2025-07-21 15:35:02'),
(19, 'Chatbot Marketing', 'Use AI chatbots on websites and messengers to improve engagement and support.', 'AI Tools', 9500.00, '2025-07-21 15:35:02'),
(20, 'Online PR & Outreach', 'Boost credibility through press releases, digital mentions, and blogger outreach.', 'PR', 8000.00, '2025-07-21 15:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `service_payments`
--

CREATE TABLE `service_payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `role` enum('startup','enterprise') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `card_last4` char(4) DEFAULT NULL,
  `payment_status` enum('pending','paid','failed') DEFAULT 'paid',
  `paid_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_payments`
--

INSERT INTO `service_payments` (`id`, `user_id`, `service_id`, `role`, `amount`, `card_last4`, `payment_status`, `paid_at`) VALUES
(1, 7, 1, 'enterprise', 15000.00, '6789', 'paid', '2025-07-23 10:18:17'),
(2, 6, 3, 'startup', 8000.00, '9842', 'paid', '2025-07-23 10:20:19'),
(3, 6, 2, 'startup', 10000.00, '4569', 'paid', '2025-07-23 17:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `startup_advisors`
--

CREATE TABLE `startup_advisors` (
  `id` int(11) NOT NULL,
  `startup_id` int(11) DEFAULT NULL,
  `advisor_id` int(11) DEFAULT NULL,
  `connected_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `startup_advisors`
--

INSERT INTO `startup_advisors` (`id`, `startup_id`, `advisor_id`, `connected_at`) VALUES
(2, 6, 6, '2025-07-21 23:15:10'),
(3, 6, 11, '2025-07-23 23:18:40');

-- --------------------------------------------------------

--
-- Table structure for table `startup_creators`
--

CREATE TABLE `startup_creators` (
  `id` int(11) NOT NULL,
  `startup_id` int(11) DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `requested_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `startup_creators`
--

INSERT INTO `startup_creators` (`id`, `startup_id`, `creator_id`, `status`, `requested_at`) VALUES
(1, 6, 11, 'Pending', '2025-07-22 01:01:18');

-- --------------------------------------------------------

--
-- Table structure for table `startup_enrollments`
--

CREATE TABLE `startup_enrollments` (
  `id` int(11) NOT NULL,
  `startup_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `progress` int(11) DEFAULT 0,
  `enrolled_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `startup_enrollments`
--

INSERT INTO `startup_enrollments` (`id`, `startup_id`, `course_id`, `progress`, `enrolled_at`) VALUES
(2, 6, 1, 0, '2025-07-22 01:46:58');

-- --------------------------------------------------------

--
-- Table structure for table `startup_forum_comments`
--

CREATE TABLE `startup_forum_comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `startup_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `commented_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `startup_forum_comments`
--

INSERT INTO `startup_forum_comments` (`id`, `post_id`, `startup_id`, `comment`, `commented_at`) VALUES
(1, 1, 6, 'Nice', '2025-07-22 00:55:06'),
(2, 1, 6, 'Nice', '2025-07-22 00:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `startup_forum_posts`
--

CREATE TABLE `startup_forum_posts` (
  `id` int(11) NOT NULL,
  `startup_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `startup_forum_posts`
--

INSERT INTO `startup_forum_posts` (`id`, `startup_id`, `title`, `content`, `created_at`) VALUES
(1, 6, 'Digital Marketing', 'Best way to grow the startup', '2025-07-22 00:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `startup_hires`
--

CREATE TABLE `startup_hires` (
  `id` int(11) NOT NULL,
  `startup_id` int(11) DEFAULT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `hired_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `startup_services`
--

CREATE TABLE `startup_services` (
  `id` int(11) NOT NULL,
  `startup_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `subscribed_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `startup_services`
--

INSERT INTO `startup_services` (`id`, `startup_id`, `service_id`, `subscribed_at`) VALUES
(1, 6, 1, '2025-07-21 21:24:26'),
(2, 6, 3, '2025-07-23 15:50:19'),
(3, 6, 2, '2025-07-23 23:17:39');

-- --------------------------------------------------------

--
-- Table structure for table `student_internships`
--

CREATE TABLE `student_internships` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `internship_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT 'applied',
  `applied_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_internships`
--

INSERT INTO `student_internships` (`id`, `user_id`, `internship_id`, `status`, `applied_at`) VALUES
(1, 5, 1, 'Completed', '2025-03-01 10:00:00'),
(2, 5, 4, 'Applied', '2025-06-12 11:45:00'),
(3, 5, 8, 'Applied', '2025-07-22 01:17:51'),
(4, 5, 11, 'Applied', '2025-07-22 13:00:53'),
(5, 5, 12, 'Applied', '2025-07-23 17:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `student_mentors`
--

CREATE TABLE `student_mentors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `connected_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_mentors`
--

INSERT INTO `student_mentors` (`id`, `user_id`, `mentor_id`, `connected_at`) VALUES
(1, 5, 1, '2025-01-05 09:30:00'),
(2, 5, 3, '2025-02-10 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_projects`
--

CREATE TABLE `student_projects` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `status` enum('Not Started','In Progress','Completed') DEFAULT 'Not Started',
  `submitted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_projects`
--

INSERT INTO `student_projects` (`id`, `student_id`, `project_id`, `status`, `submitted_at`) VALUES
(1, 5, 1, 'Completed', '2024-12-15 10:00:00'),
(2, 5, 2, 'In Progress', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `toolkit_resources`
--

CREATE TABLE `toolkit_resources` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `toolkit_resources`
--

INSERT INTO `toolkit_resources` (`id`, `title`, `description`, `category`, `link`, `file_path`, `created_at`) VALUES
(1, 'Lean Startup Plan (DOC)', 'A one-page lean business plan template suitable for early-stage startups.', 'Business Plan Templates', '', '/downloads/business_plan_lean.docx', '2025-07-21 16:25:13'),
(2, 'Traditional Business Plan (PDF)', 'Comprehensive traditional format with financials and SWOT.', 'Business Plan Templates', '', '/downloads/business_plan_traditional.pdf', '2025-07-21 16:25:13'),
(3, 'Investor-Ready Plan', 'Designed for pitching to investors with slides and narrative.', 'Business Plan Templates', '', '/downloads/investor_pitch_plan.docx', '2025-07-21 16:25:13'),
(4, 'Startup Canvas Template', 'Canvas-based visual business plan framework.', 'Business Plan Templates', '', '/downloads/startup_canvas.pdf', '2025-07-21 16:25:13'),
(5, 'Editable Google Doc Plan', 'Editable business plan hosted on Google Docs for team access.', 'Business Plan Templates', 'https://docs.google.com/document/d/xyz', '', '2025-07-21 16:25:13'),
(6, 'Startup Budget Planner (Excel)', 'Track estimated vs actual costs and funding.', 'Budget Calculators', '', '/downloads/startup_budget_planner.xlsx', '2025-07-21 16:25:13'),
(7, 'Marketing Budget Estimator', 'Excel sheet to allocate and monitor marketing expenses.', 'Budget Calculators', '', '/downloads/marketing_budget.xlsx', '2025-07-21 16:25:13'),
(8, 'Monthly Operating Cost Calculator', 'Calculate fixed and variable costs by month.', 'Budget Calculators', '', '/downloads/operating_costs.xlsx', '2025-07-21 16:25:13'),
(9, 'Cash Flow Forecast Tool', 'Helps you project cash inflows/outflows.', 'Budget Calculators', '', '/downloads/cash_flow_forecast.xlsx', '2025-07-21 16:25:13'),
(10, 'Break-Even Calculator', 'Quickly determine your break-even sales volume.', 'Budget Calculators', '', '/downloads/break_even_calc.xlsx', '2025-07-21 16:25:13'),
(11, 'Monthly Content Calendar (Excel)', 'Plan posts across Facebook, Instagram, LinkedIn, and Twitter.', 'Social Media Content Calendars', '', '/downloads/social_calendar.xlsx', '2025-07-21 16:25:13'),
(12, 'Google Sheet Calendar Template', 'Cloud-shared calendar with color-coded channels.', 'Social Media Content Calendars', 'https://docs.google.com/spreadsheets/d/abc', '', '2025-07-21 16:25:13'),
(13, 'Canva Social Scheduler', 'Editable social planner with Canva integration.', 'Social Media Content Calendars', 'https://www.canva.com/planner', '', '2025-07-21 16:25:13'),
(14, 'Event-Based Posting Calendar', 'Plan posts around holidays and events.', 'Social Media Content Calendars', '', '/downloads/seasonal_social_calendar.xlsx', '2025-07-21 16:25:13'),
(15, 'Daily Reels & Shorts Tracker', 'Dedicated tracker for short-form video content.', 'Social Media Content Calendars', '', '/downloads/reels_tracker.xlsx', '2025-07-21 16:25:13'),
(16, 'Marketing Funnel Planner', 'Design your awareness-to-conversion funnel.', 'Marketing Strategy Planners', '', '/downloads/funnel_planner.pdf', '2025-07-21 16:25:13'),
(17, 'Content Strategy Worksheet', 'Plan blog, email, and social media content.', 'Marketing Strategy Planners', '', '/downloads/content_strategy.docx', '2025-07-21 16:25:13'),
(18, 'SEO Strategy Sheet', 'Keyword planner and optimization checklist.', 'Marketing Strategy Planners', '', '/downloads/seo_strategy.xlsx', '2025-07-21 16:25:13'),
(19, 'Email Campaign Planner', 'Structure your email funnel with this template.', 'Marketing Strategy Planners', '', '/downloads/email_campaign_planner.docx', '2025-07-21 16:25:13'),
(20, 'Growth Hacking Toolkit', 'Collection of quick, low-cost marketing strategies.', 'Marketing Strategy Planners', '', '/downloads/growth_hacks.pdf', '2025-07-21 16:25:13'),
(21, 'Startup Pitch Deck (PPT)', 'Standard format for investor presentations.', 'Pitch Deck Templates', '', '/downloads/pitch_deck_startup.pptx', '2025-07-21 16:25:13'),
(22, 'Minimalist Pitch Template', 'Clean and modern slide deck layout.', 'Pitch Deck Templates', '', '/downloads/minimal_pitch.pptx', '2025-07-21 16:25:13'),
(23, 'Financial Pitch Slides', 'Focused slides for revenue, burn rate, runway.', 'Pitch Deck Templates', '', '/downloads/financial_pitch.pptx', '2025-07-21 16:25:13'),
(24, 'Problem-Solution Deck', 'Emphasizes pain points and product fit.', 'Pitch Deck Templates', '', '/downloads/problem_solution_pitch.pptx', '2025-07-21 16:25:13'),
(25, 'AI/Tech Startup Pitch', 'Tech-themed pitch design for AI companies.', 'Pitch Deck Templates', '', '/downloads/ai_tech_pitch.pptx', '2025-07-21 16:25:13'),
(26, 'Free Logo Maker (Hatchful)', 'Online tool to generate logos for free.', 'Logo & Design Tools', 'https://hatchful.shopify.com/', '', '2025-07-21 16:25:13'),
(27, 'Canva Branding Kit', 'Free Canva template for startup branding.', 'Logo & Design Tools', 'https://www.canva.com/templates/EAE9L5X8p6s-brand-kit/', '', '2025-07-21 16:25:13'),
(28, 'Color Palette Generator', 'Generate professional color combinations.', 'Logo & Design Tools', 'https://coolors.co/', '', '2025-07-21 16:25:13'),
(29, 'Typography Guide', 'PDF guide to choosing fonts for branding.', 'Logo & Design Tools', '', '/downloads/font_guide.pdf', '2025-07-21 16:25:13'),
(30, 'Favicon Generator', 'Create favicon from logo instantly.', 'Logo & Design Tools', 'https://realfavicongenerator.net/', '', '2025-07-21 16:25:13'),
(31, 'NDA Template', 'Non-disclosure agreement for partnerships or hiring.', 'Legal Document Samples', '', '/downloads/nda_template.docx', '2025-07-21 16:25:13'),
(32, 'Founder Agreement', 'Covers equity, roles, and responsibilities.', 'Legal Document Samples', '', '/downloads/founder_agreement.docx', '2025-07-21 16:25:13'),
(33, 'Employment Contract', 'Sample agreement for startup hires.', 'Legal Document Samples', '', '/downloads/employment_contract.docx', '2025-07-21 16:25:13'),
(34, 'Service Agreement', 'Formalize client work and deliverables.', 'Legal Document Samples', '', '/downloads/service_agreement.docx', '2025-07-21 16:25:13'),
(35, 'Privacy Policy Generator', 'Create policies for your website.', 'Legal Document Samples', 'https://www.termsfeed.com/privacy-policy-generator/', '', '2025-07-21 16:25:13'),
(36, 'ChatGPT (OpenAI)', 'Generate content, replies, and ideas for marketing.', 'AI-powered tool suggestions', 'https://chat.openai.com/', '', '2025-07-21 16:25:13'),
(37, 'Durable AI Website Builder', 'Create websites instantly with AI.', 'AI-powered tool suggestions', 'https://durable.co/', '', '2025-07-21 16:25:13'),
(38, 'Copy.ai', 'Generate emails, ads, and blog posts quickly.', 'AI-powered tool suggestions', 'https://www.copy.ai/', '', '2025-07-21 16:25:13'),
(39, 'Looka Logo Generator', 'Create AI-generated logos and brand kits.', 'AI-powered tool suggestions', 'https://looka.com/', '', '2025-07-21 16:25:13'),
(40, 'Mixo.ai Landing Pages', 'Instant landing pages for MVP validation.', 'AI-powered tool suggestions', 'https://www.mixo.io/', '', '2025-07-21 16:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','startup','enterprise','admin') NOT NULL DEFAULT 'student',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `profile_picture`) VALUES
(1, 'Ram', 'ram@gmail.com', '$2y$10$y/ME2W0YAsiVRdkWaKOf5OoarWFyGgEvxQjEtFFGLaisaFXAWiQcu', 'startup', '2025-07-18 19:42:57', 'default.png'),
(5, 'Ramya', 'ramya@gmail.com', '$2y$10$g53AO4.Zr3Kx0B8VKWjS.uoVyATuWEJnjIFQtkd/VxAj1uyQJ2Ffq', 'student', '2025-07-18 20:34:27', 'profile_5_1753292802.jpeg'),
(6, 'Admin', 'admin@gmail.com', '$2y$10$OrddEAkOfXJL.tYKj9xi8OohRSmf6xLkV7hwT60I/xWVVP.B3W.v6', 'startup', '2025-07-20 11:51:00', 'profile_6_1753290966.jpg'),
(7, 'Kabilashika', 'kabilashika589@gmail.com', '$2y$10$w//OQPc62Y/AfrImdHYoX.RyM/2IKlrWzkOQUqbFiA9BKhEn4hPIC', 'enterprise', '2025-07-23 09:41:22', 'enterprise_7_1753292240.jpg'),
(11, 'Warren', 'warren@gmail.com', '$2y$10$6ggQf6RCcqPLBzG2BAGLXOSXYMUkaMT17w358wFdzpt8Kq1xLS3Li', 'student', '2025-07-23 10:35:31', 'default.png'),
(12, 'Kabilashika', 'iimsdresearchkabi@gmail.com', '$2y$10$HOc7sSdJEJruZyAwMqE9BOy1jVk/CsjhlKURxwKDBITnsF5ByP93e', 'student', '2025-07-23 10:37:02', 'default.png'),
(13, 'Air medicals', 'medical@gmail.com', '$2y$10$mA9tUBIyDRjBSIG.ywVAG.8NVCbP12V8xlSQBEMWS1GdtF7YoEEZS', 'enterprise', '2025-07-23 15:00:22', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advisors`
--
ALTER TABLE `advisors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creators`
--
ALTER TABLE `creators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `enterprise_advisors`
--
ALTER TABLE `enterprise_advisors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enterprise_id` (`enterprise_id`),
  ADD KEY `advisor_id` (`advisor_id`);

--
-- Indexes for table `enterprise_creators`
--
ALTER TABLE `enterprise_creators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enterprise_id` (`enterprise_id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `enterprise_enrollments`
--
ALTER TABLE `enterprise_enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enterprise_id` (`enterprise_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `enterprise_forum_comments`
--
ALTER TABLE `enterprise_forum_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `enterprise_id` (`enterprise_id`);

--
-- Indexes for table `enterprise_forum_posts`
--
ALTER TABLE `enterprise_forum_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enterprise_id` (`enterprise_id`);

--
-- Indexes for table `enterprise_services`
--
ALTER TABLE `enterprise_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enterprise_id` (`enterprise_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `enterprise_toolkit`
--
ALTER TABLE `enterprise_toolkit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `freelancers`
--
ALTER TABLE `freelancers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internships`
--
ALTER TABLE `internships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internship_applications`
--
ALTER TABLE `internship_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `internship_id` (`internship_id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `job_postings`
--
ALTER TABLE `job_postings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `startup_id` (`startup_id`);

--
-- Indexes for table `mentors`
--
ALTER TABLE `mentors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_payments`
--
ALTER TABLE `service_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `startup_advisors`
--
ALTER TABLE `startup_advisors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `startup_id` (`startup_id`),
  ADD KEY `advisor_id` (`advisor_id`);

--
-- Indexes for table `startup_creators`
--
ALTER TABLE `startup_creators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `startup_id` (`startup_id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `startup_enrollments`
--
ALTER TABLE `startup_enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `startup_id` (`startup_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `startup_forum_comments`
--
ALTER TABLE `startup_forum_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `startup_id` (`startup_id`);

--
-- Indexes for table `startup_forum_posts`
--
ALTER TABLE `startup_forum_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `startup_id` (`startup_id`);

--
-- Indexes for table `startup_hires`
--
ALTER TABLE `startup_hires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `startup_id` (`startup_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `startup_services`
--
ALTER TABLE `startup_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `startup_id` (`startup_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `student_internships`
--
ALTER TABLE `student_internships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `internship_id` (`internship_id`);

--
-- Indexes for table `student_mentors`
--
ALTER TABLE `student_mentors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `mentor_id` (`mentor_id`);

--
-- Indexes for table `student_projects`
--
ALTER TABLE `student_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `toolkit_resources`
--
ALTER TABLE `toolkit_resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advisors`
--
ALTER TABLE `advisors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `creators`
--
ALTER TABLE `creators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enterprise_advisors`
--
ALTER TABLE `enterprise_advisors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enterprise_creators`
--
ALTER TABLE `enterprise_creators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enterprise_enrollments`
--
ALTER TABLE `enterprise_enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enterprise_forum_comments`
--
ALTER TABLE `enterprise_forum_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enterprise_forum_posts`
--
ALTER TABLE `enterprise_forum_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enterprise_services`
--
ALTER TABLE `enterprise_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enterprise_toolkit`
--
ALTER TABLE `enterprise_toolkit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `freelancers`
--
ALTER TABLE `freelancers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `internships`
--
ALTER TABLE `internships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `internship_applications`
--
ALTER TABLE `internship_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_postings`
--
ALTER TABLE `job_postings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mentors`
--
ALTER TABLE `mentors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `service_payments`
--
ALTER TABLE `service_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `startup_advisors`
--
ALTER TABLE `startup_advisors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `startup_creators`
--
ALTER TABLE `startup_creators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `startup_enrollments`
--
ALTER TABLE `startup_enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `startup_forum_comments`
--
ALTER TABLE `startup_forum_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `startup_forum_posts`
--
ALTER TABLE `startup_forum_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `startup_hires`
--
ALTER TABLE `startup_hires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `startup_services`
--
ALTER TABLE `startup_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_internships`
--
ALTER TABLE `student_internships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_mentors`
--
ALTER TABLE `student_mentors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_projects`
--
ALTER TABLE `student_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `toolkit_resources`
--
ALTER TABLE `toolkit_resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `enterprise_advisors`
--
ALTER TABLE `enterprise_advisors`
  ADD CONSTRAINT `enterprise_advisors_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enterprise_advisors_ibfk_2` FOREIGN KEY (`advisor_id`) REFERENCES `advisors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enterprise_creators`
--
ALTER TABLE `enterprise_creators`
  ADD CONSTRAINT `enterprise_creators_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enterprise_creators_ibfk_2` FOREIGN KEY (`creator_id`) REFERENCES `creators` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enterprise_enrollments`
--
ALTER TABLE `enterprise_enrollments`
  ADD CONSTRAINT `enterprise_enrollments_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enterprise_enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enterprise_forum_comments`
--
ALTER TABLE `enterprise_forum_comments`
  ADD CONSTRAINT `enterprise_forum_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `enterprise_forum_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enterprise_forum_comments_ibfk_2` FOREIGN KEY (`enterprise_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enterprise_forum_posts`
--
ALTER TABLE `enterprise_forum_posts`
  ADD CONSTRAINT `enterprise_forum_posts_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enterprise_services`
--
ALTER TABLE `enterprise_services`
  ADD CONSTRAINT `enterprise_services_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enterprise_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `internship_applications`
--
ALTER TABLE `internship_applications`
  ADD CONSTRAINT `internship_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `internship_applications_ibfk_2` FOREIGN KEY (`internship_id`) REFERENCES `internships` (`id`);

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `job_applications_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job_postings` (`id`);

--
-- Constraints for table `job_postings`
--
ALTER TABLE `job_postings`
  ADD CONSTRAINT `job_postings_ibfk_1` FOREIGN KEY (`startup_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `service_payments`
--
ALTER TABLE `service_payments`
  ADD CONSTRAINT `service_payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_payments_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `startup_advisors`
--
ALTER TABLE `startup_advisors`
  ADD CONSTRAINT `startup_advisors_ibfk_1` FOREIGN KEY (`startup_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `startup_advisors_ibfk_2` FOREIGN KEY (`advisor_id`) REFERENCES `advisors` (`id`);

--
-- Constraints for table `startup_creators`
--
ALTER TABLE `startup_creators`
  ADD CONSTRAINT `startup_creators_ibfk_1` FOREIGN KEY (`startup_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `startup_creators_ibfk_2` FOREIGN KEY (`creator_id`) REFERENCES `creators` (`id`);

--
-- Constraints for table `startup_enrollments`
--
ALTER TABLE `startup_enrollments`
  ADD CONSTRAINT `startup_enrollments_ibfk_1` FOREIGN KEY (`startup_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `startup_enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `startup_forum_comments`
--
ALTER TABLE `startup_forum_comments`
  ADD CONSTRAINT `startup_forum_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `startup_forum_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `startup_forum_comments_ibfk_2` FOREIGN KEY (`startup_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `startup_forum_posts`
--
ALTER TABLE `startup_forum_posts`
  ADD CONSTRAINT `startup_forum_posts_ibfk_1` FOREIGN KEY (`startup_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `startup_hires`
--
ALTER TABLE `startup_hires`
  ADD CONSTRAINT `startup_hires_ibfk_1` FOREIGN KEY (`startup_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `startup_hires_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`);

--
-- Constraints for table `startup_services`
--
ALTER TABLE `startup_services`
  ADD CONSTRAINT `startup_services_ibfk_1` FOREIGN KEY (`startup_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `startup_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `student_internships`
--
ALTER TABLE `student_internships`
  ADD CONSTRAINT `student_internships_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `student_internships_ibfk_2` FOREIGN KEY (`internship_id`) REFERENCES `internships` (`id`);

--
-- Constraints for table `student_mentors`
--
ALTER TABLE `student_mentors`
  ADD CONSTRAINT `student_mentors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `student_mentors_ibfk_2` FOREIGN KEY (`mentor_id`) REFERENCES `mentors` (`id`);

--
-- Constraints for table `student_projects`
--
ALTER TABLE `student_projects`
  ADD CONSTRAINT `student_projects_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_projects_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
