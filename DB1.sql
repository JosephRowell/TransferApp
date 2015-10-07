--Capping Database       Nikol Pettine
--we are doing best fit major
--create views for freq queries
-----------------------
--Colleges
CREATE TABLE Colleges (
    cid SERIAL, --SERIAL starts at 1
    name varchar(250) NOT NULL unique,
    PRIMARY KEY(cid)
);
INSERT INTO Colleges( Name)
    VALUES( 'Marist');
INSERT INTO Colleges( Name)
    VALUES( 'DCC');
	
--People --requires all
CREATE TABLE People (
    pid SERIAL,
    cid integer NOT NULL references Colleges(cid),
    fName varchar(100) NOT NULL,
	lName varchar(100) NOT NULL,
    email varchar(250) NOT NULL,
	PRIMARY KEY(pid)
);
--admin = pid 1
INSERT INTO People(cid, fName, lName, email)
    VALUES(1, 'admin', 'admin', 'admin');
INSERT INTO People(cid, fName, lName, email)
    VALUES(1, 'Nikol', 'Pettine', 'gmail');
INSERT INTO People(cid, fName, lName, email)
    VALUES(2, 'test', 'test', 'test');
	
--Admin
CREATE TABLE Admins (
    pid integer NOT NULL references People(pid) primary key,
	password varchar(100) NOT NULL
);
INSERT INTO Admins(pid, password)
    VALUES(1, 'admin');
INSERT INTO Admins(pid, password)
    VALUES(2, 'test');

--Students --requires all from People table
--if we are doing the email loop, 
CREATE TABLE Students (
 pid integer NOT NULL references People(pid) primary key,
 major varchar(100) NOT NULL, --this keep 
 startDate varchar(8) NOT NULL --mm/dd/yyyy --dumped the rest they were not in case study
);
INSERT INTO Students(pid, major, startDate)
    VALUES(3, 'Computer Science', '08312015');

	
--DCC Courses
CREATE TABLE DCC_Courses (
    crsid varchar(100) NOT NULL unique, --Art 101
	ccid integer NOT NULL  references Colleges(cid),
	name varchar(250) NOT NULL,
	subject varchar(250), --Art
    PRIMARY KEY (crsid,ccid)
);

--first 2 transferable Acc courses
INSERT INTO DCC_Courses(crsid, ccid, name,subject)
    VALUES('Acc 1', 2, 'Accounting Elect', 'Acc');
INSERT INTO DCC_Courses(crsid, ccid, name,subject)
    VALUES('Acc 101', 2, 'PRINC ACCOUNTING I', 'Acc');
	
--Marist Courses
CREATE TABLE MaristCourses (
    marid varchar(100) NOT NULL unique,
	mcid integer NOT NULL  references Colleges(cid),
	name varchar(250) NOT NULL,  
	-- 250  to accommodate spaces in course names
	credit integer, --get from catalog maybe
	subject varchar(250),
    PRIMARY KEY (marid,mcid)
);
--first 2 eqv to DCC Acc courses
INSERT INTO MaristCourses(marid, mcid, name,credit, subject)
    VALUES('Acct 800N', 1, 'Accounting Elective', 3, 'Acct');
INSERT INTO MaristCourses(marid, mcid, name,credit, subject)
    VALUES('Acct 801N', 1, 'Accounting Elective', 3, 'Acct');
--non-transfer connection	
INSERT INTO MaristCourses(marid, mcid, name,subject)
    VALUES('Reg 800L', 1, 'NON-TRANSFERABLE COURSE', 'Reg');

--transferable courses
CREATE TABLE Transferable (
    marid varchar(100) NOT NULL,
	mcid integer NOT NULL,
	crsid varchar(100) NOT NULL,
	ccid integer NOT NULL,
	FOREIGN KEY (marid, mcid) REFERENCES MaristCourses(marid, mcid),
	FOREIGN KEY (crsid, ccid) REFERENCES DCC_Courses(crsid, ccid),
    PRIMARY KEY (marid,mcid, crsid, ccid)
);
INSERT INTO Transferable(marid, mcid, crsid, ccid)
    VALUES('Acct 800N', 1, 'Acc 1', 2);
INSERT INTO Transferable(marid, mcid, crsid, ccid)
    VALUES('Acct 801N', 1, 'Acc 101', 2);
	
--majors --name includes concentrations
CREATE TABLE Majors (
    majid SERIAL, --SERIAL starts at 1
    name varchar(250) NOT NULL unique,
	PRIMARY KEY (majid)
);
INSERT INTO Majors(name)
    VALUES('Accounting');
INSERT INTO Majors(name)
    VALUES('Computer Science Software Development');

--connection table between Majors and MaristCourses
CREATE TABLE MajorsMar (
    marid varchar(100) NOT NULL,
	mcid integer NOT NULL,
	majid integer NOT NULL references Majors(majid),
	FOREIGN KEY (marid, mcid) REFERENCES MaristCourses(marid, mcid),
    primary key (marid,mcid, majid)
);
INSERT INTO MajorsMar(marid, mcid, majid)
    VALUES('Acct 800N', 1, 1);
INSERT INTO MajorsMar(marid, mcid, majid)
    VALUES('Acct 801N', 1, 1);
		
		
--minors
CREATE TABLE Minors (
    minid SERIAL,
    name varchar(250) NOT NULL unique,
	PRIMARY KEY (minid)
);
INSERT INTO Minors(name)
    VALUES('Accounting');
INSERT INTO Minors(name)
    VALUES('Computer Science Software Development');
	
--connection table between Minors and MaristCourses
CREATE TABLE MinorsMar (
    marid varchar(100) NOT NULL,
	mcid integer NOT NULL,
	minid integer NOT NULL references Majors(majid),
	FOREIGN KEY (marid, mcid) REFERENCES MaristCourses(marid, mcid),
    primary key (marid,mcid, minid)
);		
INSERT INTO MinorsMar(marid, mcid, minid)
    VALUES('Acct 800N', 1, 1);
INSERT INTO MinorsMar(marid, mcid, minid)
    VALUES('Acct 801N', 1, 1);		
		
		
		
		
---------------QUERIES--------------------------
--see Admins
SELECT p.fName AS "First Name", p.lName AS "Last Name"
FROM People p, Admins a
WHERE p.pid = a.pid

--see Students including college 
SELECT p.fName AS "First Name", p.lName AS "Last Name", s.major, c.name
FROM People p, Students s, Colleges c
WHERE p.pid = s.pid AND p.cid = c.cid	

--shows what major a DCC Course is under based on its Marist equivalent
--don't need a connection table between DCC_Courses and Majors
SELECT c.crsid AS "DCC Course", m.marid AS "Marist Course", maj.name AS "Major"
FROM DCC_Courses c, MaristCourses m, Transferable t, Majors maj, MajorsMar mm 
WHERE c.crsid = t.crsid AND c.ccid = t.ccid 
		AND m.marid = t.marid AND m.mcid = t.mcid
		AND m.marid = mm.marid AND m.mcid = mm.mcid
		AND mm.majid = maj.majid

--above query on specific course 
SELECT c.crsid AS "DCC Course", m.marid AS "Marist Course", maj.name AS "Major"
FROM DCC_Courses c, MaristCourses m, Transferable t, Majors maj, MajorsMar mm 
WHERE c.crsid = t.crsid AND c.ccid = t.ccid 
		AND m.marid = t.marid AND m.mcid = t.mcid
		AND m.marid = mm.marid AND m.mcid = mm.mcid
		AND mm.majid = maj.majid AND c.crsid = 'Acc 1'
		
--works same as Majors one	
SELECT c.crsid AS "DCC Course", m.marid AS "Marist Course", mi.name AS "Minor"
FROM DCC_Courses c, MaristCourses m, Transferable t, Minors mi, MinorsMar mm 
WHERE c.crsid = t.crsid AND c.ccid = t.ccid 
		AND m.marid = t.marid AND m.mcid = t.mcid
		AND m.marid = mm.marid AND m.mcid = mm.mcid
		AND mm.minid = mi.minid	