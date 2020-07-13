<?php
date_default_timezone_set('Africa/Dar_es_salaam');
include '../../database/config.php';
include '../../includes/uniques.php';
$exam_id = 'EX-'.get_rand_numbers(6).'';
$exam = ucwords(mysqli_real_escape_string($conn, $_POST['exam']));
$duration = mysqli_real_escape_string($conn, $_POST['duration']);
$passmark = mysqli_real_escape_string($conn, $_POST['passmark']);
$attempts = mysqli_real_escape_string($conn, $_POST['attempts']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$category = mysqli_real_escape_string($conn, $_POST['category']);

$sql = "SELECT * FROM tbl_examinations WHERE exam_name = '$exam' AND subject = '$subject' AND category = '$category'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
header("location:../examinations.php?DUPLICATE RECORD FOUND!!");
    }
} else {

$sql = "INSERT INTO tbl_examinations (exam_id, category, subject, exam_name, date, duration, passmark, re_exam)
VALUES ('$exam_id', '$category', '$subject', '$exam', '$date', '$duration', '$passmark', '$attempts')";

if ($conn->query($sql) === TRUE) {
header("location:../examinations.php?EXAM ADDED SUCCESSFULLY!!");
} else {
header("location:../examinations.php?COULD NOT ADD EXAM!!");
}


}
$conn->close();
?>