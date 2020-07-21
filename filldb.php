INSERT INTO `users`(`id`, `login`, `password`, `role`) VALUES (NULL,'hape','twlou','student')
INSERT INTO `users`(`id`, `login`, `password`, `role`) VALUES (NULL,'v_v_v', 'h3h3','student')

INSERT INTO `users`(`id`, `login`, `password`, `role`) VALUES (NULL,'zsa','world','lecturer')

INSERT INTO `lecturers`(`id`, `userid`, `name`, `middle_name`, `surname`) VALUES (1,2,'С','А','З')

INSERT INTO `courses`(`id`, `lectid`, `name`, `year`, `semester`) VALUES (NULL,1,'Электродинамика',2019,1)

INSERT INTO `students`(`id`, `userid`, `groupid`, `name`, `middle_name`, `surname`, `course_year`) VALUES (NULL,1,1,'В','Д','Ф',3) 
INSERT INTO `students`(`id`, `userid`, `groupid`, `name`, `middle_name`, `surname`, `course_year`) VALUES (NULL,3,1,'В','В','В',3) 

INSERT INTO `attend_records`(`id`, `courseid`, `studentid`, `lecture_date`, `status`) VALUES (NULL,2,1,STR_TO_DATE("2019-06-15",'%Y-%m-%d'),'был');
INSERT INTO `attend_records`(`id`, `courseid`, `studentid`, `lecture_date`, `status`) VALUES (NULL,2,1,STR_TO_DATE("2019-06-22",'%Y-%m-%d'),'был');
INSERT INTO `attend_records`(`id`, `courseid`, `studentid`, `lecture_date`, `status`) VALUES (NULL,2,2,STR_TO_DATE("2019-06-15",'%Y-%m-%d'),'был');
INSERT INTO `attend_records`(`id`, `courseid`, `studentid`, `lecture_date`, `status`) VALUES (NULL,2,2,STR_TO_DATE("2019-06-22",'%Y-%m-%d'),'был')

INSERT INTO `curriculum_history`(`id`, `studentid`, `courseid`) VALUES (NULL,1,2)
INSERT INTO `curriculum_history`(`id`, `studentid`, `courseid`) VALUES (NULL,2,2)