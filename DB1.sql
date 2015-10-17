--Capping Database       Nikol Pettine
--we are doing best fit major
--
--create views for freq queries
--CREATE VIEW SpeciesMagicSpecs 
--AS
--SELECT s.name AS "Species Name", m.name AS "Magic Name", m.school AS "Magic 	School"
--FROM species s, MagicSpec ms, magic m
--WHERE ms.sid = s.sid AND ms.mid = m.mid
--ORDER BY m.school, m.name, s.name
-----------------------

--put the csv file into a folder and right click on the folder hit properties
-- pick Security tab and hit the add and put 'Everyone' in the enter object name to select text area.
-- after that runs then you can try running one of the following:
--COPY DCC_Courses FROM 'C:/Users/Nikol/Documents/Capping/d1.csv' WITH CSV HEADER;
--COPY MaristCourses FROM 'C:/Users/Nikol/Documents/Capping/m1.csv' WITH CSV HEADER;



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


--WRITE OUT SUBJECTS	
--DCC Courses
CREATE TABLE DCC_Courses (
    crsid varchar(100) NOT NULL unique, --Art 101
	ccid integer NOT NULL  references Colleges(cid),
	name varchar(250) NOT NULL,
	subject varchar(250), --Art
    PRIMARY KEY (crsid,ccid)
);

--WRITE OUT SUBJECTS	
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
--non-transfer connection	
--INSERT INTO MaristCourses(marid, mcid, name,subject)
  --  VALUES('Reg 800L', 1, 'NON-TRANSFERABLE COURSE', 'Reg');

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
--INSERT INTO Transferable(marid, mcid, crsid, ccid)
  --  VALUES('REG 800L', 1, 'ACC 100', 2);
--INSERT INTO Transferable(marid, mcid, crsid, ccid)
  --  VALUES('ACCT 801N', 1, 'ACC 101', 2);
	
--majors --name includes concentrations
CREATE TABLE Majors (
    majid SERIAL, --SERIAL starts at 1
    name varchar(250) NOT NULL unique,
	amtCourses integer, --will fill in eventually...
	PRIMARY KEY (majid)
);

--54 Majors -should be all of them
INSERT INTO Majors(name)
    VALUES('Accounting');
INSERT INTO Majors(name)
    VALUES('American Studies');
INSERT INTO Majors(name)
    VALUES('Applied Mathematics');
INSERT INTO Majors(name)
    VALUES('Fine Arts: Studio Arts');
INSERT INTO Majors(name)
    VALUES('Fine Arts: Art History');
INSERT INTO Majors(name)
    VALUES('Digital Media');
INSERT INTO Majors(name)
    VALUES('Studio Art');
INSERT INTO Majors(name)
    VALUES('Athletic Training');
INSERT INTO Majors(name)
    VALUES('Biology');
INSERT INTO Majors(name)
    VALUES('Biology Education');
INSERT INTO Majors(name)
    VALUES('Biomedical Sciences');
INSERT INTO Majors(name)
    VALUES('Business Administration');
INSERT INTO Majors(name)
    VALUES('Chemistry (B.S.)');
INSERT INTO Majors(name)
    VALUES('Chemistry – Biochemistry Option (B.S.)');
INSERT INTO Majors(name)
    VALUES('Chemistry (B.A.)');
INSERT INTO Majors(name)
    VALUES('Biochemistry (B.A.)');
INSERT INTO Majors(name)
    VALUES('Communication, Advertising Concentration');
INSERT INTO Majors(name)
    VALUES('Communication, Communication Studies Concentration');
INSERT INTO Majors(name)
    VALUES('Communication, Journalism Concentration');
INSERT INTO Majors(name)
    VALUES('Communication, Public Relations Concentration');
INSERT INTO Majors(name)
    VALUES('Communication, Sports Communication Concentration');
INSERT INTO Majors(name)
    VALUES('Computer Science with a Concentration in Software Development');
INSERT INTO Majors(name)
    VALUES('Computer Science with a Concentration in Game Design and Programming');
INSERT INTO Majors(name)
    VALUES('Criminal Justice');	
INSERT INTO Majors(name)
    VALUES('Economics');
INSERT INTO Majors(name)
    VALUES('Psychology and Dual Certification');
INSERT INTO Majors(name)
    VALUES('English Concentration in Literature');
INSERT INTO Majors(name)
    VALUES('English Concentration in Writing');
INSERT INTO Majors(name)
    VALUES('English Concentration in Theatre');
INSERT INTO Majors(name)
    VALUES('Environmental Science & Policy, Science Concentration');
INSERT INTO Majors(name)
    VALUES('Environmental Science & Policy, Policy Concentration ');
INSERT INTO Majors(name)
    VALUES('Fashion Design');
INSERT INTO Majors(name)
    VALUES('Fashion Merchandising with a Business Concentration');
INSERT INTO Majors(name)
    VALUES('Fashion Merchandising with Product Development Concentration');
INSERT INTO Majors(name)
    VALUES('Fashion Merchandising with a Fashion Promotion Concentration');
INSERT INTO Majors(name)
    VALUES('French');
INSERT INTO Majors(name)
    VALUES('History');
INSERT INTO Majors(name)
    VALUES('History / Secondary Education');
INSERT INTO Majors(name)
    VALUES('Information Technology and Systems with a Concentration in Information Technology');
INSERT INTO Majors(name)
    VALUES('Information Technology and Systems with a Concentration in Information Systems');
INSERT INTO Majors(name)
    VALUES('Italian');
INSERT INTO Majors(name)
    VALUES('Liberal Studies');
INSERT INTO Majors(name)
    VALUES('Mathematics');
INSERT INTO Majors(name)
    VALUES('Mathematics with Adolescence Education Certification');
INSERT INTO Majors(name)
    VALUES('Media Studies and Production: Interactive Media & Game Design Concentration');
INSERT INTO Majors(name)
    VALUES('Media Studies and Production: Film & Television Concentration');
INSERT INTO Majors(name)
    VALUES('Medical Technology');
INSERT INTO Majors(name)
    VALUES('Philosophy');
INSERT INTO Majors(name)
    VALUES('Philosophy with a Concentration in Religious Studies ');
INSERT INTO Majors(name)
    VALUES('Political Science');
INSERT INTO Majors(name)
    VALUES('Psychology');
INSERT INTO Majors(name)
    VALUES('Religion');
INSERT INTO Majors(name)
    VALUES('Social Work');
INSERT INTO Majors(name)
    VALUES('Spanish');		
	
--connection table between Majors and MaristCourses
CREATE TABLE MajorsMar (
    marid varchar(100) NOT NULL,
	mcid integer NOT NULL,
	majid integer NOT NULL references Majors(majid),
	FOREIGN KEY (marid, mcid) REFERENCES MaristCourses(marid, mcid),
    primary key (marid,mcid, majid)
);
--INSERT INTO MajorsMar(marid, mcid, majid)
   -- VALUES('Acct 800N', 1, 1);
		
		
--minors
CREATE TABLE Minors (
    minid SERIAL,
    name varchar(250) NOT NULL unique,
	amtCourses integer, --will fill in eventually...
	PRIMARY KEY (minid)
);

--54 Minors roughly all of them 
INSERT INTO Minors(name)
    VALUES('Accounting');
INSERT INTO Minors(name)
    VALUES('African Diaspora Studies');
INSERT INTO Minors(name)
    VALUES('American Studies');
INSERT INTO Minors(name)
    VALUES('Studio Art');	
INSERT INTO Minors(name)
    VALUES('Art History');	
INSERT INTO Minors(name)
    VALUES('Biology');
INSERT INTO Minors(name)
    VALUES('Business');
INSERT INTO Minors(name)
    VALUES('Catholic Studies');
INSERT INTO Minors(name)
    VALUES('Chemistry');
INSERT INTO Minors(name)
    VALUES('Cognitive Science');	
INSERT INTO Minors(name)
    VALUES('Cinema Studies');	
INSERT INTO Minors(name)
    VALUES('Communication');	
INSERT INTO Minors(name)
    VALUES('Communication, Advertising');
INSERT INTO Minors(name)
    VALUES('Communication, Advertising Communication Studies');
INSERT INTO Minors(name)
    VALUES('Communication, Communication Theory Communication General Communication Minor');
INSERT INTO Minors(name)
    VALUES('Communication Studies');	
INSERT INTO Minors(name)
    VALUES('Computer Science');	
INSERT INTO Minors(name)
    VALUES('Criminal Justice');	
INSERT INTO Minors(name)
    VALUES('Digital Video Production');
INSERT INTO Minors(name)
    VALUES('Economics');
INSERT INTO Minors(name)
    VALUES('English - Literature');
INSERT INTO Minors(name)
    VALUES('English - Theatre');	
INSERT INTO Minors(name)
    VALUES('English - Writing');	
INSERT INTO Minors(name)
    VALUES('Creative Writing');
INSERT INTO Minors(name)
    VALUES('Environmental Policy');
INSERT INTO Minors(name)
    VALUES('Environmental Science');
INSERT INTO Minors(name)
    VALUES('Environmental Studies');
INSERT INTO Minors(name)
    VALUES('Fashion Merchandising');	
INSERT INTO Minors(name)
    VALUES('Product Development');	
INSERT INTO Minors(name)
    VALUES('French Languages Studies');
INSERT INTO Minors(name)
    VALUES('Global');
INSERT INTO Minors(name)
    VALUES('Graphic Design');
INSERT INTO Minors(name)
    VALUES('History');
INSERT INTO Minors(name)
    VALUES('Hudson River Valley Regional Studies');	
INSERT INTO Minors(name)
    VALUES('Information Systems');	
INSERT INTO Minors(name)
    VALUES('Information Technology');
INSERT INTO Minors(name)
    VALUES('Enterprise Computing');
INSERT INTO Minors(name)
    VALUES('Interactive Media');
INSERT INTO Minors(name)
    VALUES('Italian');
INSERT INTO Minors(name)
    VALUES('Jewish Studies');	
INSERT INTO Minors(name)
    VALUES('Journalism');	
INSERT INTO Minors(name)
    VALUES('Mathematics');
INSERT INTO Minors(name)
    VALUES('Music');
INSERT INTO Minors(name)
    VALUES('Medieval and Renaissance Studies');
INSERT INTO Minors(name)
    VALUES('Philosophy');	
INSERT INTO Minors(name)
    VALUES('Photography');	
INSERT INTO Minors(name)
    VALUES('Political Science');
INSERT INTO Minors(name)
    VALUES('Psychology');
INSERT INTO Minors(name)
    VALUES('Religious Studies');
INSERT INTO Minors(name)
    VALUES('Public Praxis');
INSERT INTO Minors(name)
    VALUES('Social Work');	
INSERT INTO Minors(name)
    VALUES('Sociology');	
INSERT INTO Minors(name)
    VALUES('Spanish Languages Studies');
INSERT INTO Minors(name)
    VALUES('Women''s Studies');
	
	
--connection table between Minors and MaristCourses
CREATE TABLE MinorsMar (
    marid varchar(100) NOT NULL,
	mcid integer NOT NULL,
	minid integer NOT NULL references Majors(majid),
	FOREIGN KEY (marid, mcid) REFERENCES MaristCourses(marid, mcid),
    primary key (marid,mcid, minid)
);		
--INSERT INTO MinorsMar(marid, mcid, minid)
 --   VALUES('Acct 800N', 1, 1);	
		
		
		
		
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

--**above query on specific course ** --this is the main query
SELECT distinct c.crsid AS "DCC Course", c.name AS "DCC Name",  m.marid AS "Marist Course", m.name AS "Marist Name"
FROM DCC_Courses c, MaristCourses m, Transferable t
WHERE c.crsid = t.crsid AND c.ccid = t.ccid 
		AND m.marid = t.marid AND m.mcid = t.mcid
ORDER BY c.name
		
--works same as Majors one	
SELECT c.crsid AS "DCC Course", m.marid AS "Marist Course", mi.name AS "Minor"
FROM DCC_Courses c, MaristCourses m, Transferable t, Minors mi, MinorsMar mm 
WHERE c.crsid = t.crsid AND c.ccid = t.ccid 
		AND m.marid = t.marid AND m.mcid = t.mcid
		AND m.marid = mm.marid AND m.mcid = mm.mcid
		AND mm.minid = mi.minid	