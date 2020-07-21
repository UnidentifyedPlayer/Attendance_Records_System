<?php

CREATE TABLE lecturers (
    id SMALLINT NOT NULL AUTO_INCREMENT,
    userid SMALLINT,
    name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50) NOT NULL,
    surname VARCHAR(50) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (userid),
    FOREIGN KEY (userid) REFERENCES users(id)
)

CREATE TABLE lecturers (
    id SMALLINT NOT NULL AUTO_INCREMENT,
    login SMALLINT UNIQUE,
    password VARCHAR(50) NOT NULL,
    role VARCHAR(8) NOT NULL,
    PRIMARY KEY (id),
)

CREATE TABLE attendance
(
    id SMALLINT NOT NULL AUTO_INCREMENT PRIMARY,
    courseid SMALLINT NOT NULL,
    studentid SMALLINT NOT NULL,
    date DATE NOT NULL,
    status VARCHAR(10),
	PRIMARY KEY (id),
    FOREIGN KEY (studentid) REFERENCES students(id) ON DELETE CASCADE
	FOREIGN KEY (courseid) REFERENCES courses(id) ON DELETE CASCADE
)

CREATE TABLE curriculum_history(
    id SMALLINT NOT NULL AUTO_INCREMENT,
    studentid SMALLINT NOT NULL,
    courseid SMALLINT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (studentid) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (courseid) REFERENCES courses(id) ON DELETE CASCADE
)


CREATE TABLE courses (
    id SMALLINT NOT NULL AUTO_INCREMENT,
    lectid SMALLINT UNIQUE,
    name VARCHAR(100) NOT NULL,
    year SMALLINT NOT NULL,
    semester SMALLINT CHECK ((semester>0) AND (semester<3)),
    PRIMARY KEY (id),
    FOREIGN KEY (lectid) REFERENCES lecturers(id)
)

CREATE TABLE groups
(
    id SMALLINT NOT NULL AUTO_INCREMENT,
    groupnum SMALLINT CHECK (groupnum>0),
    course_year SMALLINT CHECK (course_year>0),
    PRIMARY KEY (id)
)

CREATE TABLE students (
    id SMALLINT NOT NULL AUTO_INCREMENT,
    userid SMALLINT UNIQUE,
    groupid SMALLINT,
    name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50) NOT NULL,
    surname VARCHAR(50) NOT NULL,
    course_year SMALLINT CHECK (course_year>0),
    PRIMARY KEY (id),
    FOREIGN KEY (userid) REFERENCES users(id),
    FOREIGN KEY (groupid) REFERENCES un_groups(id)
)
"ALTER TABLE `courses`
 ADD `year` SMALLINT NOT NULL AFTER `name`,
 ADD `semester` TINYINT('1','2') NOT NULL AFTER `year`; "
?>