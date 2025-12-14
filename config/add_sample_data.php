<?php
// Script to add sample data to existing database
require_once 'config.php';

// Add 5 criminals
$criminals = [
    [1001, 'Glenn Quagmire', 'Joe Swanson', 'Rape', '1989-02-11', '2002-06-01', '2001-09-01', 'M', 'Quahog, Rhode Island', '../images/download.jpg', '375'],
    [1002, 'John Smith', 'Sarah Johnson', 'Robbery', '1985-03-15', '2023-05-20', '2023-05-18', 'M', '123 Main Street, New York', '../images/download.jpg', '392'],
    [1003, 'Maria Garcia', 'Michael Brown', 'Kidnapping', '1990-07-22', '2023-08-10', '2023-08-05', 'F', '456 Oak Avenue, Los Angeles', '../images/download.jpg', '363'],
    [1004, 'Robert Wilson', 'Emily Davis', 'Murder', '1982-11-30', '2022-12-15', '2022-12-10', 'M', '789 Pine Road, Chicago', '../images/download.jpg', '302'],
    [1005, 'Lisa Anderson', 'David Martinez', 'Fraud', '1995-04-08', '2024-01-25', '2024-01-20', 'F', '321 Elm Street, Houston', '../images/download.jpg', '420']
];

// Add 5 officers
$officers = [
    ['Mr.Peater', 1091, 1001, 9787414066, 'M', 'Pistol Auto 9mm 1A', 'API'],
    ['Sarah Johnson', 1092, 1002, 9876543210, 'F', 'Glock Pistol', 'Sr.PI'],
    ['Michael Brown', 1093, 1003, 9123456789, 'M', 'Smith and Wesson M&P', 'PSI'],
    ['Emily Davis', 1094, 1004, 9234567890, 'F', 'M4', 'API'],
    ['David Martinez', 1095, 1005, 9345678901, 'M', 'MP5 German Automatic Sub-machine Gun', 'HC']
];

try {
    // Insert criminals
    $stmt = $db->prepare("INSERT OR IGNORE INTO `info` (`id`, `name`, `offname`, `crime`, `dob`, `arrDate`, `crimeDate`, `sex`, `address`, `img`, `more`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    foreach ($criminals as $criminal) {
        $stmt->bindValue(1, $criminal[0], SQLITE3_INTEGER);
        $stmt->bindValue(2, $criminal[1], SQLITE3_TEXT);
        $stmt->bindValue(3, $criminal[2], SQLITE3_TEXT);
        $stmt->bindValue(4, $criminal[3], SQLITE3_TEXT);
        $stmt->bindValue(5, $criminal[4], SQLITE3_TEXT);
        $stmt->bindValue(6, $criminal[5], SQLITE3_TEXT);
        $stmt->bindValue(7, $criminal[6], SQLITE3_TEXT);
        $stmt->bindValue(8, $criminal[7], SQLITE3_TEXT);
        $stmt->bindValue(9, $criminal[8], SQLITE3_TEXT);
        $stmt->bindValue(10, $criminal[9], SQLITE3_TEXT);
        $stmt->bindValue(11, $criminal[10], SQLITE3_TEXT);
        $stmt->execute();
    }

    // Insert officers
    $stmt = $db->prepare("INSERT OR IGNORE INTO `officer` (`offName`, `offID`, `ID`, `contact`, `gender`, `weapon`, `role`) VALUES (?, ?, ?, ?, ?, ?, ?)");

    foreach ($officers as $officer) {
        $stmt->bindValue(1, $officer[0], SQLITE3_TEXT);
        $stmt->bindValue(2, $officer[1], SQLITE3_INTEGER);
        $stmt->bindValue(3, $officer[2], SQLITE3_INTEGER);
        $stmt->bindValue(4, $officer[3], SQLITE3_INTEGER);
        $stmt->bindValue(5, $officer[4], SQLITE3_TEXT);
        $stmt->bindValue(6, $officer[5], SQLITE3_TEXT);
        $stmt->bindValue(7, $officer[6], SQLITE3_TEXT);
        $stmt->execute();
    }

    echo "Successfully added 5 criminals and 5 officers to the database!\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

$db->close();
?>
