<?php
session_start();

if (isset($_POST['submit'])) {
    // Connect to database
    $con = mysqli_connect("localhost", "engbrcdg_hanan", "u5E10@kW_*ns", "engbrcdg_engbreak");

    $name = mysqli_escape_string($con, $_POST['name']);
    $email = mysqli_escape_string($con, $_POST['email']);
    $phone = mysqli_escape_string($con, $_POST['phone']);
    $university=mysqli_escape_string($con,$_POST['university']);
    $faculty=mysqli_escape_string($con,$_POST['faculty']);
    $firstPreference=mysqli_escape_string($con,$_POST['AcademicYear']);
    $_SESSION['messages'] = array();
    $msg_arr = array("academicYear" => "Academic year",
                    "name" => "Name",
                    "email" => "Email",
                    "phone" => "Phone",
                    "university" => "University",
                    "faculty" => "Faculty"
                    );
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
                $_SESSION['messages'][] = $msg_arr[$key]. " is empty.";
            }
        }
    }
    if (!empty($_SESSION['messages'])) {
         header("Location: index.php");
         die();
    }

    $sql = "INSERT INTO recruitment (
                                    name,
                                    email,
                                    phone,
                                    university,
                                    faculty,
                                    AcademicYear,
                                    date_time
                                    ) VALUES (
                                    '$name',
                                    '$email',
                                    '$phone',
                                    '$university',
                                    '$faculty',
                                    '$AcademicYear',
                                    NOW()
                                    )";
    $insert = mysqli_query($con, $sql);
    if ($insert) {
        $_SESSION['messages'][] = "Successful Registration <br> The  Opening Will be at ..... at 5 pm  ";
    } else {
        $error = mysqli_error($con);
        echo $error;
    }


    header("Location: index.php");
    die();


} else {
    echo "ELSE";
}


?>
