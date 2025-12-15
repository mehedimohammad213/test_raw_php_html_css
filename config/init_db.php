<?php
// SQLite Database Initialization Script
$db_path = __DIR__ . '/../database/criminalinfo.db';
$db_dir = __DIR__ . '/../database';

// Create database directory if it doesn't exist
if (!file_exists($db_dir)) {
    mkdir($db_dir, 0755, true);
}

// Remove existing database if it exists
if (file_exists($db_path)) {
    unlink($db_path);
}

// Create new SQLite database
$db = new SQLite3($db_path);

// Create tables
$db->exec("CREATE TABLE IF NOT EXISTS `info` (
  `id` INTEGER PRIMARY KEY,
  `name` TEXT NOT NULL,
  `offname` TEXT NOT NULL,
  `crime` TEXT NOT NULL,
  `dob` DATE NOT NULL,
  `arrDate` DATE NOT NULL,
  `crimeDate` DATE NOT NULL,
  `sex` TEXT NOT NULL,
  `address` TEXT NOT NULL,
  `img` TEXT DEFAULT NULL,
  `more` TEXT NOT NULL
)");

$db->exec("CREATE TABLE IF NOT EXISTS `officer` (
  `offName` TEXT NOT NULL,
  `offID` INTEGER PRIMARY KEY,
  `ID` INTEGER NOT NULL,
  `contact` INTEGER NOT NULL,
  `gender` TEXT NOT NULL,
  `weapon` TEXT NOT NULL,
  `role` TEXT NOT NULL
)");

$db->exec("CREATE TABLE IF NOT EXISTS `users` (
  `uname` TEXT NOT NULL,
  `pass` TEXT NOT NULL
)");

// General Diary entries table
$db->exec("CREATE TABLE IF NOT EXISTS `gd_entries` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `entry_no` TEXT NOT NULL,
  `entry_datetime` TEXT NOT NULL,
  `officer_id` INTEGER NOT NULL,
  `station` TEXT NOT NULL,
  `type` TEXT NOT NULL,
  `subject` TEXT NOT NULL,
  `details` TEXT NOT NULL,
  `related_criminal_id` INTEGER,
  FOREIGN KEY(`officer_id`) REFERENCES `officer`(`offID`),
  FOREIGN KEY(`related_criminal_id`) REFERENCES `info`(`id`)
)");

                                // Insert default data - 5 criminals
$db->exec("INSERT INTO `info` (`id`, `name`, `offname`, `crime`, `dob`, `arrDate`, `crimeDate`, `sex`, `address`, `img`, `more`) VALUES
(1001, 'Glenn Quagmire', 'Joe Swanson', 'Rape', '1989-02-11', '2002-06-01', '2001-09-01', 'M', 'Quahog, Rhode Island', '../images/download.jpg', '375'),
(1002, 'John Smith', 'Sarah Johnson', 'Robbery', '1985-03-15', '2023-05-20', '2023-05-18', 'M', '123 Main Street, New York', '../images/download.jpg', '392'),
(1003, 'Maria Garcia', 'Michael Brown', 'Kidnapping', '1990-07-22', '2023-08-10', '2023-08-05', 'F', '456 Oak Avenue, Los Angeles', '../images/download.jpg', '363'),
(1004, 'Robert Wilson', 'Emily Davis', 'Murder', '1982-11-30', '2022-12-15', '2022-12-10', 'M', '789 Pine Road, Chicago', '../images/download.jpg', '302'),
(1005, 'Lisa Anderson', 'David Martinez', 'Fraud', '1995-04-08', '2024-01-25', '2024-01-20', 'F', '321 Elm Street, Houston', '../images/download.jpg', '420')");

// Insert default data - 5 officers
$db->exec("INSERT INTO `officer` (`offName`, `offID`, `ID`, `contact`, `gender`, `weapon`, `role`) VALUES
('Mr.Peater', 1091, 1001, 9787414066, 'M', 'Pistol Auto 9mm 1A', 'API'),
('Sarah Johnson', 1092, 1002, 9876543210, 'F', 'Glock Pistol', 'Sr.PI'),
('Michael Brown', 1093, 1003, 9123456789, 'M', 'Smith and Wesson M&P', 'PSI'),
('Emily Davis', 1094, 1004, 9234567890, 'F', 'M4', 'API'),
('David Martinez', 1095, 1005, 9345678901, 'M', 'MP5 German Automatic Sub-machine Gun', 'HC')");

$db->exec("INSERT INTO `users` (`uname`, `pass`) VALUES
('admin', 'admin')");

// Insert default data - 5 GD entries
$db->exec("INSERT INTO `gd_entries` (`entry_no`, `entry_datetime`, `officer_id`, `station`, `type`, `subject`, `details`, `related_criminal_id`) VALUES
('GD-1001', '2024-01-10 09:30', 1091, 'Quahog Police Station', 'Complaint', 'Noise complaint from neighborhood', 'Citizen reported loud music and disturbance in the neighborhood. Officers dispatched and situation handled peacefully.', 1001),
('GD-1002', '2024-02-05 14:15', 1092, 'Central City Police Station', 'Information', 'Suspicious vehicle spotted', 'Informant reported a suspicious van circling the commercial area multiple times. Details recorded for future reference.', 1002),
('GD-1003', '2024-03-12 20:45', 1093, 'Harbor Police Station', 'Patrol Note', 'Night patrol status update', 'Regular night patrol conducted in assigned sector. No major incidents observed. Minor traffic violations handled on the spot.', 1003),
('GD-1004', '2024-04-18 11:05', 1094, 'Downtown Police Station', 'Complaint', 'Lost wallet reported', 'Complainant reported loss of wallet containing ID and bank cards in market area. Statement recorded and CCTV footage requested.', 1004),
('GD-1005', '2024-05-22 16:30', 1095, 'North Zone Police Station', 'Misc', 'Internal meeting summary', 'Briefing conducted with all duty officers regarding upcoming festival security arrangements and deployment plan.', 1005)");

$db->close();

echo "Database initialized successfully!\n";
?>
