<?php

function get_tutored_courses($link, $lectid){
    $query = "SELECT 
            id, name   
            FROM
            courses 
            WHERE 
            lectid = '$lectid'";
    $result = mysqli_query($link, $query);

    if(is_bool($result)){
    if ($result) {
        return array();
    } else {
        $error = "Не удалось совершить запрос";
    }
    }
    $courses = $result->fetch_all(MYSQLI_ASSOC);
    return $courses;
}

function get_course_attendance($link, $courseid){
    $query = "SELECT studentid, lecture_date, status
    FROM 
    attend_records
    WHERE 
    courseid = '$courseid'
    ORDER BY studentid, lecture_date";
    $result = mysqli_query($link, $query);
    $records = $result->fetch_all(MYSQLI_ASSOC);
    return $records;
}
function get_course_dates($link, $courseid){
    $query = "SELECT DISTINCT lecture_date 
FROM attend_records 
WHERE courseid='$courseid' 
ORDER BY lecture_date";
    $result = mysqli_query($link, $query);
    $records = $result->fetch_all(MYSQLI_NUM);
    return $records;
}
function get_course_stud_names($link, $courseid){
$query = "SELECT students.id, students.name, students.middle_name, students.surname
 FROM students, curriculum_history
 WHERE students.id = curriculum_history.studentid AND curriculum_history.courseid = '$courseid'
 ORDER BY students.id";
    $result = mysqli_query($link, $query);
    $records = $result->fetch_all(MYSQLI_ASSOC);
    return $records;
}
function get_course_info($link, $courseid){
    $query = "SELECT * FROM courses WHERE id='$courseid'";
    $result = mysqli_query($link, $query);
    $course_info = $result->fetch_all(MYSQLI_ASSOC);
    return $course_info;
}

function get_groups($link){
    $query = "SELECT * FROM un_groups ORDER BY course_year, groupnum";
    $result = mysqli_query($link, $query);
    $groups = $result->fetch_all(MYSQLI_ASSOC);
    return $groups;
}

?>