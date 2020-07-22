<?php

function get_assigned_courses($link, $studentid)
{
    $query = "SELECT 
            courseid,
            (SELECT name FROM courses WHERE curriculum_history.courseid = courses.id ) 
            AS course_name   
            FROM
            curriculum_history 
            WHERE 
            studentid = '$studentid'";
    $result = mysqli_query($link, $query);
    $courses = $result->fetch_all(MYSQLI_ASSOC);
    return $courses;
}

function get_attendance($link, $studentid, $courseid){
    $query = "SELECT
    lecutre_date, status
    WHERE
    courseid='$courseid' AND studentid='$studentid'";
    $result = mysqli_query($link, $query);
    $records = $result->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function get_stud_attendance($link, $studentid, $courseid){
    $query = "SELECT lecture_date, status
    FROM 
    attend_records
    WHERE 
    studentid = '$studentid' AND courseid = '$courseid'
    ORDER BY lecture_date";
    $result = mysqli_query($link, $query);
    $records = $result->fetch_all(MYSQLI_ASSOC);
    return $records;
}
?>