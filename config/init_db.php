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

$db->close();

echo "Database initialized successfully!\n";
?>
