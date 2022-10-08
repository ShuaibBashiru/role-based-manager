
-- Students

CREATE TABLE students_record(
id int not null AUTO_INCREMENT,
personal_id varchar(80) NOT NULL UNIQUE,
lastname varchar(50) NOT NULL,
  firstname varchar(50) NOT NULL,
  othername varchar(50) DEFAULT '',
  fullname varchar(100) DEFAULT '',
  programName varchar(100) DEFAULT '',
  departmentName varchar(100) DEFAULT '',
  schoolName varchar(100) DEFAULT '',
  levelName varchar(100) DEFAULT '',
  program_id INT NOT NULL DEFAULT 0,
  department_id INT NOT NULL DEFAULT 0,
  school_id INT NOT NULL DEFAULT 0,
  payment_id INT NOT NULL DEFAULT 0,
  email_one varchar(80) NOT NULL UNIQUE,
  email_two varchar(80) DEFAULT '',
  phone_one varchar(50) NOT NULL UNIQUE,
  phone_two varchar(50) DEFAULT '',
  phone_code varchar(30) NOT NULL DEFAULT '+234',
  passport_url text, 
  gender_id INT NOT NULL DEFAULT 0,
  dob VARCHAR(11) NOT NULL DEFAULT 0,
  mob VARCHAR(11) NOT NULL DEFAULT 0,
  yob VARCHAR(11) NOT NULL DEFAULT 0,
  date_of_birth varchar(30) null,
  age int NOT NULL DEFAULT 0,
  zipcode int NOT NULL DEFAULT 0,
  language_code varchar(30) DEFAULT '',
  lga_id int NOT NULL DEFAULT 0,
  city_id int NOT NULL DEFAULT 0,
  state_id int NOT NULL DEFAULT 0,
  country_id int NOT NULL DEFAULT 0,
  address_one text,
  address_two text,
  document_id varchar(120) DEFAULT NULL,
  status_id int NOT NULL DEFAULT 1,
  generated_id varchar(80) NOT NULL UNIQUE DEFAULT '0',
  created_by int NOT NULL DEFAULT 0,
  modified_by int NOT NULL DEFAULT 0,
  date_created date NOT NULL,
  time_created time NOT NULL,
  updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  deleted_status INT NOT NULL DEFAULT 0,
  deleted_by INT NOT NULL DEFAULT 0,
  date_login date DEFAULT NULL,
  time_login time DEFAULT NULL,
  PRIMARY KEY(id) 
);


CREATE TABLE registered_courses(
  id int NOT NULL AUTO_INCREMENT,
  student_id INT NOT NULL DEFAULT 0,
  personal_id varchar(80) NOT NULL,
  courseTitle varchar(100) not null,
  courseCode varchar(50) not null,
  courseUnit int not null,
  sessionName varchar(50) not null,
  levelName varchar(50) not null,
  semesterName varchar(50) not null,
  test_score  float not null DEFAULT 0,
  exam_score  float not null DEFAULT 0,
  total_score  float not null DEFAULT 0,
  point_count  float not null DEFAULT 0,
  weight_count  float not null DEFAULT 0,
  percentage_score  float not null DEFAULT 0,
  grade_level  varchar(50) not null DEFAULT '',
  grade_score  decimal(10, 2) not null DEFAULT 0.0,
  quality_point int not null DEFAULT 0.0,
  status_id int NOT NULL DEFAULT 1,
  generated_id varchar(80) NOT NULL UNIQUE DEFAULT '0',
  created_by int NOT NULL DEFAULT 0,
  modified_by int NOT NULL DEFAULT 0,
  date_created date NOT NULL,
  time_created time NOT NULL,
  updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  deleted_status INT NOT NULL DEFAULT 0,
  deleted_by INT NOT NULL DEFAULT 0,
  PRIMARY KEY(id),
  FOREIGN KEY(student_id) REFERENCES students_record(id)
);

CREATE TABLE results_summary(
  id int NOT NULL AUTO_INCREMENT,
  student_id INT NOT NULL DEFAULT 0,
  personal_id varchar(80) NOT NULL,
  sessionName varchar(50) not null,
  levelName varchar(50) not null,
  semesterName varchar(50) not null,
  totalUnit int not null DEFAULT 0,
  totalPoint decimal(10, 2) not null DEFAULT 0.0,
  gpa  decimal(10, 2) not null DEFAULT 0.0,
  cgpa  decimal(10, 2) not null DEFAULT 0.0,
  status_id int NOT NULL DEFAULT 1,
  generated_id varchar(80) NOT NULL UNIQUE DEFAULT '0',
  created_by int NOT NULL DEFAULT 0,
  modified_by int NOT NULL DEFAULT 0,
  date_created date NOT NULL,
  time_created time NOT NULL,
  updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  deleted_status INT NOT NULL DEFAULT 0,
  deleted_by INT NOT NULL DEFAULT 0,
  PRIMARY KEY(id),
  FOREIGN KEY(student_id) REFERENCES students_record(id)
);


DELIMITER $$
CREATE OR REPLACE TRIGGER new_cgpa_before_insert 
BEFORE INSERT
ON results_summary FOR EACH ROW

BEGIN

    SET @newcgpa = (SELECT (sum(totalPoint+NEW.totalPoint) / sum(totalUnit+NEW.totalUnit)) from results_summary 
    WHERE lock_status=0 AND personal_id=NEW.personal_id group by personal_id);
    if (@newcgpa != '') then
      set NEW.cgpa = @newcgpa;
    else
      set NEW.cgpa = NEW.gpa;

    end if;

END$$

DELIMITER ;


DELIMITER $$
CREATE OR REPLACE TRIGGER new_cgpa_before_update 
BEFORE UPDATE
ON results_summary FOR EACH ROW

BEGIN

    SET @newcgpa = (SELECT (sum(totalPoint+NEW.totalPoint) / sum(totalUnit+NEW.totalUnit)) from results_summary 
    WHERE lock_status=0 AND personal_id=NEW.personal_id group by personal_id);
    if (@newcgpa != '') then
      set NEW.cgpa = @newcgpa;
    else
      set NEW.cgpa = NEW.gpa;

    end if;

END$$

DELIMITER ;


DELIMITER $$
CREATE OR REPLACE TRIGGER new_cgpa_before_update 
BEFORE UPDATE
ON results_summary FOR EACH ROW

BEGIN

    SET @newcgpa = (SELECT (sum(totalPoint+NEW.totalPoint) / sum(totalUnit+NEW.totalUnit)) from results_summary 
    WHERE lock_status=0 AND personal_id=NEW.personal_id group by personal_id);
    if (@newcgpa != '') then
      set NEW.cgpa = @newcgpa;
    else
      set NEW.cgpa = NEW.gpa;

    end if;

END$$

DELIMITER ;