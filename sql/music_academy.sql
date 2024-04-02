-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 02, 2024 at 02:04 PM
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
-- Database: `music_academy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_username`, `admin_password`, `admin_status`) VALUES
(1, 'sshyamm', 'shy111', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `age_groups`
--

CREATE TABLE `age_groups` (
  `age_group_id` int(11) NOT NULL,
  `age_group_name` varchar(255) NOT NULL,
  `age_group_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `age_groups`
--

INSERT INTO `age_groups` (`age_group_id`, `age_group_name`, `age_group_status`) VALUES
(1, '11-20', 'Active'),
(2, '21-30', 'Active'),
(3, '31-40', 'Active'),
(4, '6-10', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `state_parent_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `city_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `state_parent_id`, `city_name`, `city_status`) VALUES
(1, 1, 'Coimbatore', 'Active'),
(2, 2, 'London', 'Active'),
(3, 3, 'Kochi', 'Active'),
(4, 4, 'Kuala Lampur', 'Active'),
(5, 5, 'Ipoh', 'Active'),
(6, 1, 'Chennai', 'Active'),
(7, 7, 'Jeffna', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `course_parent_id` int(11) NOT NULL,
  `user_parent_id` int(11) NOT NULL,
  `sched_start_time` time NOT NULL,
  `sched_end_time` time NOT NULL,
  `date_of_class` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `actual_start_time` datetime DEFAULT NULL,
  `actual_end_time` datetime DEFAULT NULL,
  `class_status` enum('Upcoming','Ongoing','Finished','Cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `course_parent_id`, `user_parent_id`, `sched_start_time`, `sched_end_time`, `date_of_class`, `created_at`, `updated_at`, `actual_start_time`, `actual_end_time`, `class_status`) VALUES
(21, 1, 5, '23:54:00', '23:55:00', '2024-03-21', '2024-03-17 11:54:46', '2024-03-20 02:30:51', '2024-03-28 19:59:53', '2024-03-28 20:00:33', 'Finished'),
(22, 2, 4, '23:54:00', '21:00:00', '2024-03-22', '2024-03-17 11:55:09', '2024-03-20 02:31:02', NULL, NULL, 'Upcoming'),
(25, 1, 5, '15:41:00', '16:42:00', '2024-03-23', '2024-03-20 03:40:10', '2024-03-26 05:48:22', '2024-03-28 17:01:52', '2024-03-28 20:11:45', 'Finished'),
(26, 2, 4, '16:43:00', '16:44:00', '2024-03-24', '2024-03-20 03:40:33', '2024-03-26 05:48:37', NULL, NULL, 'Upcoming'),
(27, 3, 18, '22:27:00', '00:28:00', '2024-03-27', '2024-03-26 11:25:26', '2024-03-26 11:25:26', NULL, NULL, 'Upcoming');

-- --------------------------------------------------------

--
-- Table structure for table `class_comments`
--

CREATE TABLE `class_comments` (
  `comment_id` int(11) NOT NULL,
  `user_parent_id` int(11) DEFAULT NULL,
  `class_parent_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `comment_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_comments`
--

INSERT INTO `class_comments` (`comment_id`, `user_parent_id`, `class_parent_id`, `comment`, `created_at`, `comment_status`) VALUES
(10, 17, 21, 'Hi', '2024-03-28 16:58:21', 'Active'),
(11, 17, 21, 'Yes, its Thursday', '2024-03-28 16:58:36', 'Active'),
(12, 5, 25, 'Hi , all', '2024-03-28 18:47:23', 'Active'),
(13, 5, 21, 'Hi,I&#039;m Jennie', '2024-03-28 20:04:05', 'Active'),
(14, 17, 25, 'Hi, Im Ramesh', '2024-03-28 20:10:03', 'Active'),
(15, 5, 25, 'Hii', '2024-03-31 15:51:02', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `class_rooms`
--

CREATE TABLE `class_rooms` (
  `class_room_id` int(11) NOT NULL,
  `class_parent_id` int(11) DEFAULT NULL,
  `user_parent_id` int(11) DEFAULT NULL,
  `attendance` enum('Present','Absent','Late') DEFAULT NULL,
  `attendance_time` varchar(255) DEFAULT NULL,
  `class_room_status` enum('Active','Inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_rooms`
--

INSERT INTO `class_rooms` (`class_room_id`, `class_parent_id`, `user_parent_id`, `attendance`, `attendance_time`, `class_room_status`) VALUES
(86, 25, 17, 'Late', NULL, NULL),
(87, 27, 17, NULL, NULL, NULL),
(89, 21, 17, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `class_tasks`
--

CREATE TABLE `class_tasks` (
  `task_id` int(11) NOT NULL,
  `task_desc` varchar(255) DEFAULT NULL,
  `course_parent_id` int(11) DEFAULT NULL,
  `date_parent_id` int(11) DEFAULT NULL,
  `task_file` varchar(255) DEFAULT NULL,
  `task_deadline` date DEFAULT NULL,
  `task_status` enum('Active','Inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_tasks`
--

INSERT INTO `class_tasks` (`task_id`, `task_desc`, `course_parent_id`, `date_parent_id`, `task_file`, `task_deadline`, `task_status`) VALUES
(67, 'Task for violin 21, 66 :)', 1, 21, 'class1_20240329135732.jpg', '2024-03-30', NULL),
(68, 'violin 2', 1, 21, 'keyboardIn_20240326163700.jpg', '2024-03-17', NULL),
(69, 'Vocal :)', 1, 25, 'vocalsIn_20240326164016.jpg', '2024-03-26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_parent_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `course_parent_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `comment_status` enum('Active','Inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_parent_id`, `comment`, `course_parent_id`, `created_at`, `comment_status`) VALUES
(3, 2, 'Hi Arunesh here', 2, '2024-03-27 13:52:38', 'Active'),
(4, 17, 'Hi, Ramesh here.', 1, '2024-03-27 14:10:47', 'Active'),
(5, 17, 'Shyam', 1, '2024-03-27 14:11:32', 'Active'),
(6, 3, 'I\'m Suresh', 2, '2024-03-27 14:44:26', 'Active'),
(7, 5, 'hii', 1, '2024-03-27 15:57:00', 'Active'),
(8, 5, 'Hii', 8, '2024-03-27 15:59:13', 'Active'),
(9, 5, 'Hii', 9, '2024-03-27 16:00:40', 'Active'),
(10, 17, 'Hi', 1, '2024-03-28 16:56:21', 'Active'),
(11, 17, 'Hi', 2, '2024-03-28 16:59:50', 'Active'),
(12, 5, 'Its piano', 6, '2024-03-28 18:47:10', 'Active'),
(13, 5, 'HI', 1, '2024-03-28 19:57:53', 'Active'),
(14, 5, '18:54 ', 2, '2024-03-29 18:54:17', 'Active'),
(15, 5, 'hi', 2, '2024-03-29 18:54:57', 'Active'),
(16, 5, 'Hii', 2, '2024-03-31 15:50:47', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `country_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`, `country_status`) VALUES
(1, 'India', 'Active'),
(2, 'England', 'Active'),
(3, 'Malaysia', 'Active'),
(4, 'Sri Lanka', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_desc` longtext NOT NULL,
  `course_img` varchar(255) NOT NULL,
  `course_icon` varchar(255) NOT NULL,
  `course_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_desc`, `course_img`, `course_icon`, `course_status`) VALUES
(1, 'Violin', 'One of the oldest musical instrument in existence, violin is the smallest and the most versatile member of the strings family. Unlike the piano and guitar, it is not possible to play the chords on the violin and hence is considered a melody instrument. Violin comes and various sizes ranging from 1/4th, 1/2 to full size. The choice of the instrument will depend on the age and built of the student and hence we highly recommend consulting our faculty before investing in an instrument. ', 'instuIn_2024-03-22_07-28-35.jpg', 'class10_2024-03-22_07-28-35.jpg', 'Active'),
(2, 'Guitar', 'Guitar is one of the most popular instruments among learners around the world. Although seemingly an easy instrument to play, guitar requires as much learning effort and dedication as any other musical discipline. At the Academy we teach a variety of guitars including Classical Guitar (nylon string acoustic guitar), standard Acoustic Guitar (Steel string acoustic guitar), Electric Guitar (solid/hollow body electric guitar) and Bass Guitar (4 string electric guitar).', 'guitarIn_2024-03-22_07-29-57.jpg', 'class6_2024-03-22_07-29-57.jpg', 'Active'),
(3, 'Drums', 'Drums is the core of a rhythm section in a band. This is purely a rhythm instrument and is not really capable of playing the melody or harmony. Often referred to as the timekeepers of the band, drummers play a very crucial role is keeping the band together and contribute considerably to the energy and momentum of the music. Students learning drums master their rudiments and gain technical command over different styles of music such as Rock, Pop, Jazz, Reggae, etc. ', 'drumIn_2024-03-22_07-33-23.jpg', 'class9_2024-03-22_07-33-23.jpg', 'Active'),
(4, 'Vocals', 'Often not considered as a musical instrument, vocals requires as much study, skill development and practice as any other musical instrument if not more. Consider a fresher studying piano would not have played a piano ever before and is guided with the correct technique of playing the instrument under expert guidance right from the start. Vocals on the other hand is an instrument we are all gifted with and have been using all our lives often without any expert guidance on how to use it and/or without deep understanding of how the voice is produced.', 'vocalsIn_2024-03-22_07-41-38.jpg', 'class1_2024-03-22_07-41-38.jpg', 'Active'),
(5, 'Electronic Keyboard', 'Although similar to the piano, keyboards involve learning many techniques and skills that are unique to this instrument such as pitch bend, glissandos, comping, sound synthesis, etc. Students aspiring to learn the keyboard need to understand that it is not a compromise over learning the piano, it is just a different instrument aimed at very different skillset that is unique to the keyboard. ', 'keyboardIn_2024-03-22_07-46-48.jpg', 'class7_2024-03-22_07-46-48.jpg', 'Active'),
(6, 'Piano', 'Students pursue structured progressive system to gain understanding and technical facility to play the Piano. The course carefully covers all aspects of playing the piano including Scales & Arpeggios, Sight Reading, Ear Training, improvisation, etc. Students aspiring to learn the piano may start their journey with a keyboard of the recommended quality and graduate to the piano at the appropriate level. Today there is a wide range of digital and acoustic piano available in the market, making it easy to find a good instrument within a decent budget. ', 'pianoIn_2024-03-22_07-50-44.jpg', 'class8_2024-03-22_07-50-44.jpg', 'Active'),
(7, 'Contemporary Music - Offline', 'The western contemporary music has evolved over the past century but features multiple genres of music owing to the technological developments that went hand in hand with its evolution. Considering the recent history and fast evolving soundscape of contemporary music, pedagogy of teaching this form of music is in its early stage of development. Compared to classical, you will not find many method books developed specifically targeted at Rock, Pop and other current forms of music. ', 'offlineIn_2024-03-22_08-01-36.jpg', 'class4_2024-03-22_08-01-36.jpg', 'Active'),
(8, 'Live Interactive Courses', 'We offer two formats of learning online, i.e. live interactive sessions and recorded video lessons. The live interactive sessions are only available in individual format, with the exception of Theory of Music lessons that are taught in a group of up to 10. The students learn one-on-one with the teacher over video conferencing softwares like Zoom, Google Meet, etc. The teachers typically guide the students with the requirements to ensure the lessons are as effective as offline physical lessons.', 'onlineIn_2024-03-22_08-04-19.jpg', 'class11_2024-03-22_08-04-19.jpg', 'Active'),
(9, 'Advanced Certificate Courses', 'At advanced levels, music takes a lot of discipline, hardwork and dedication, but more than anything else expert guidance is absolutely indispensable. As a premier institution known for high standards of music education, we often get students that have prior learning experience and are looking to get to the next level. Our faculty take the time to carefully understand the history of their learning, identify their pain points and help them get over their learning difficulties.', 'certifiIn_2024-03-22_08-08-08.jpg', 'class5_2024-03-22_08-08-08.jpg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_status` enum('Active','Jumbotron','Inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_name`, `image_path`, `image_status`) VALUES
(1, 'Image 1', 'index1_2024-03-29_13-50-56.jpg', 'Active'),
(2, 'Image 2', 'index2_2024-03-29_13-52-11.jpg', 'Active'),
(3, 'Image 3', 'index3_2024-03-29_13-52-41.jpg', 'Active'),
(4, 'Jumbotron 1', 'jumbotron1_2024-03-29_13-55-28.jpg', 'Jumbotron'),
(5, 'Jumbotron 2', 'jumbotron7_2024-03-29_13-55-55.jpg', 'Jumbotron'),
(6, 'Jumbotron 3', 'jumbotron11_2024-03-29_13-56-27.jpg', 'Jumbotron'),
(7, 'Image 4', 'class11_2024-03-29_14-10-36.jpg', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `interest_id` int(11) NOT NULL,
  `user_parent_id` int(11) DEFAULT NULL,
  `course_parent_id` int(11) DEFAULT NULL,
  `level_parent_id` int(11) DEFAULT NULL,
  `interest_status` enum('Joined','New') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`interest_id`, `user_parent_id`, `course_parent_id`, `level_parent_id`, `interest_status`) VALUES
(37, 17, 1, NULL, NULL),
(38, 17, 2, NULL, NULL),
(39, 17, 3, NULL, NULL),
(40, 17, 4, NULL, NULL),
(41, 17, 5, NULL, NULL),
(42, 3, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `level_id` int(11) NOT NULL,
  `level_name` varchar(255) NOT NULL,
  `level_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`level_id`, `level_name`, `level_status`) VALUES
(1, 'Beginner', 'Active'),
(2, 'Intermediate', 'Active'),
(3, 'Expert', 'Active'),
(6, 'Advanced', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `news_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `email`, `created_at`, `news_status`) VALUES
(18, 'shyam777sps@gmail.com', '2024-03-29 21:04:02', 'Active'),
(19, 'shyamsundar.p2019@vitstudent.ac.in', '2024-03-29 21:05:34', 'Active'),
(20, 'shyamsundar.p2019@vitstudent.ac.in', '2024-03-29 21:06:58', 'Active'),
(21, 'ram@gmail.com', '2024-03-29 21:08:54', 'Active'),
(22, 'ram@gmail.com', '2024-03-29 21:08:59', 'Active'),
(23, 'arun@gmail.com', '2024-03-29 21:11:20', 'Active'),
(24, 'shyam777sps@gmail.com', '2024-03-29 21:12:59', 'Active'),
(25, 'shyam777sps@gmail.com', '2024-03-29 21:13:28', 'Active'),
(26, 'shyam777sps@gmail.com', '2024-03-29 21:14:28', 'Active'),
(27, 'shyam777sps@gmail.com', '2024-03-29 21:16:00', 'Active'),
(28, 'shyam777sps@gmail.com', '2024-03-29 21:16:09', 'Active'),
(29, 'shyam777sps@gmail.com', '2024-03-29 21:16:21', 'Active'),
(30, 'arun@gmail.com', '2024-03-30 12:07:31', 'Active'),
(31, 'ram@gmail.com', '2024-03-31 15:53:09', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `country_parent_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `state_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `country_parent_id`, `state_name`, `state_status`) VALUES
(1, 1, 'Tamil Nadu', 'Active'),
(2, 2, 'South England', 'Active'),
(3, 1, 'Kerala', 'Active'),
(4, 3, 'Selangor', 'Active'),
(5, 3, 'Perak', 'Active'),
(7, 4, 'Colombo', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `user_parent_id` int(11) DEFAULT NULL,
  `phone_num` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `age_group_parent_id` int(11) DEFAULT NULL,
  `course_parent_id` int(11) DEFAULT NULL,
  `level_parent_id` int(11) DEFAULT NULL,
  `emergency_contact` varchar(255) DEFAULT NULL,
  `blood_group` enum('A+','A-','B+','B-','O-','O+','AB+','AB-') DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pincode` varchar(11) DEFAULT NULL,
  `city_parent_id` int(11) DEFAULT NULL,
  `state_parent_id` int(11) DEFAULT NULL,
  `country_parent_id` int(11) DEFAULT NULL,
  `student_status` enum('Enquired','Active','Inactive') DEFAULT 'Active',
  `joined_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `user_parent_id`, `phone_num`, `email`, `age_group_parent_id`, `course_parent_id`, `level_parent_id`, `emergency_contact`, `blood_group`, `address`, `pincode`, `city_parent_id`, `state_parent_id`, `country_parent_id`, `student_status`, `joined_date`) VALUES
(1, 1, '9188103943', 'shyam27sps@gmail.com', 1, 1, 6, '9447196749', 'B+', 'ABC, India', '641016', 1, 1, 1, 'Active', '2024-02-01'),
(3, 2, '8756545643', 'arun@gmail.com', 3, 1, 1, '8565667675', 'AB+', '54/2, BHARATHI PARK ROAD, SAI BABA COLONY , COIMBATORE - 641011', '641012', 4, 4, 3, 'Active', '2024-02-15'),
(4, 3, '7564566673', 'suresh@gmail.com', 3, 1, 2, '7566667874', 'A+', '54/2, BHARATHI PARK ROAD, SAI BABA COLONY , COIMBATORE - 641011', '641011', 6, 1, 1, 'Active', '2024-02-25'),
(85, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '2024-03-26'),
(90, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '2024-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_manager_id` int(11) NOT NULL,
  `task_parent_id` int(11) DEFAULT NULL,
  `user_parent_id` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `grading` varchar(255) DEFAULT NULL,
  `last_updated` varchar(255) DEFAULT NULL,
  `submit_status` enum('Pending','Submitted For Review','Graded & Completed') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_manager_id`, `task_parent_id`, `user_parent_id`, `remark`, `comment`, `file_path`, `grading`, `last_updated`, `submit_status`) VALUES
(73, 69, 17, 'Submitted by :)', 'Average', 'shyam_20240328200835.png', 'A3', '2024-03-31 15:52:20', 'Graded & Completed');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `user_parent_id` int(11) DEFAULT NULL,
  `teacher_phone` varchar(255) DEFAULT NULL,
  `teacher_email` varchar(255) DEFAULT NULL,
  `teacher_address` varchar(255) DEFAULT NULL,
  `course_parent_id` int(11) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `teacher_exp` int(11) DEFAULT NULL,
  `contract_date` date DEFAULT NULL,
  `current_salary` int(11) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `teacher_status` enum('Active','Inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `user_parent_id`, `teacher_phone`, `teacher_email`, `teacher_address`, `course_parent_id`, `qualification`, `teacher_exp`, `contract_date`, `current_salary`, `join_date`, `teacher_status`) VALUES
(1, 4, '9188103943', 'teacher@gmail.com', 'ABC, Coimbatore', 2, 'Music.Tech', 3, '2025-02-22', 12000, '2024-02-24', 'Inactive'),
(4, 5, '975744675', 'jennie@gmail.com', '54/2, BHARATHI PARK ROAD, SAI BABA COLONY , COIMBATORE - 641011', 1, 'V.Tech', 7, '2024-03-31', 12000, '2024-03-17', 'Active'),
(5, 18, '975744675', 'david@gmail.com', '54/2, BHARATHI PARK ROAD, SAI BABA COLONY , COIMBATORE - 641011', 3, 'D.Tech', 6, '2024-03-31', 30000, '2024-03-26', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_type` enum('Student','Teacher','None') NOT NULL DEFAULT 'None',
  `user_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_type`, `user_status`) VALUES
(1, 'Shyam', '$2y$10$20qTB1J.JbJVhDgdySYCzuothfURsw/3Ds53fxRRBBqtTvo48dRkm', 'Student', 'Active'),
(2, 'Arunesh', 'arun123', 'Student', 'Active'),
(3, 'Suresh', 'sur123', 'Student', 'Active'),
(4, 'Ann', 'ann123', 'Teacher', 'Active'),
(5, 'Jennie', 'jenn123', 'Teacher', 'Active'),
(17, 'Ramesh', 'ram123', 'Student', 'Active'),
(18, 'David', 'da123', 'Teacher', 'Active'),
(26, 'Karthik', '$2y$10$K0TE4YHrZqTL3tbWVWRtQ.JaEZBDNzkH9ykWT/46FnGGp1yaA6L9W', 'Student', 'Active'),
(27, 'Shiva', 'shiv123', 'None', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `age_groups`
--
ALTER TABLE `age_groups`
  ADD PRIMARY KEY (`age_group_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `class_comments`
--
ALTER TABLE `class_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `class_rooms`
--
ALTER TABLE `class_rooms`
  ADD PRIMARY KEY (`class_room_id`);

--
-- Indexes for table `class_tasks`
--
ALTER TABLE `class_tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`interest_id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_manager_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `age_groups`
--
ALTER TABLE `age_groups`
  MODIFY `age_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `class_comments`
--
ALTER TABLE `class_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `class_rooms`
--
ALTER TABLE `class_rooms`
  MODIFY `class_room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `class_tasks`
--
ALTER TABLE `class_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `interest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
