$servername = "localhost";
$username = "id20422756_sagar";
$password = "E1L@KQ5jY[6@C22#";
$dbname = "id20422756_project";

-- reg_verify
CREATE TABLE reg_verify (
	email varchar(100) not null,
    code varchar(100) not null, 
    status varchar(10),
    PRIMARY KEY(email),
    FOREIGN KEY (email) REFERENCES userdetails(Email)
);

CREATE TABLE stdEnrolled(
    Uid varchar(25) Not null,
    course_code varchar(10) not null,
    course_name varchar(50) not null,
    date_enrolled timestamp,
    finish_date timestamp,
    status varchar(10),
    PRIMARY KEY (Uid, course_code, course_name),
    constraint ch_uid FOREIGN KEY (Uid) REFERENCES userdetails(Uid),
    constraint ch_course FOREIGN KEY (course_code, course_name) REFERENCES courseDetails(course_code,course_name)
);

CREATE TABLE courses(
    course_code varchar(10) not null,
    course_name varchar(50) not null,
    instructor_id varchar(20) not null,
    date_started timestamp,
    status varchar(10),
    totalstd int,
    PRIMARY KEY (course_code, course_name),
    constraint ch_instructor FOREIGN KEY (instructor_id) REFERENCES instructors(instructor_id)
);

CREATE TABLE instructors(
    instructor_id varchar(20) not null,
    instructor_name varchar(30),
    joined_date timestamp,
    PRIMARY KEY (instructor_id, instructor_name)
);