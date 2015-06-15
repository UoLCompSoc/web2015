USE compsoc;

DROP TABLE IF EXISTS transactions;
DROP TABLE IF EXISTS passwords;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS point_types;

CREATE TABLE point_types (
	id INT NOT NULL AUTO_INCREMENT UNIQUE,
	
	title VARCHAR(50) NOT NULL UNIQUE,
	description VARCHAR(255) NOT NULL,
	
	PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

INSERT INTO point_types (title, description) VALUES ("Academic", "Awarded for academic participation such as joining in with lectures or projects");
INSERT INTO point_types (title, description) VALUES ("Social", "Awarded for getting involved with social events");

CREATE TABLE users (
	userid INT NOT NULL AUTO_INCREMENT UNIQUE,
	email VARCHAR(50) NOT NULL UNIQUE,
	username VARCHAR(50) NOT NULL UNIQUE,
	fullname VARCHAR(50) NOT NULL,
	datejoined DATE NOT NULL,
	permissions INT NOT NULL,
	
	salt VARCHAR(255) NOT NULL,
	
	githubID VARCHAR(40),
	linkedinID VARCHAR(255),
	steamID VARCHAR(50),
	
	PRIMARY KEY (userid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

CREATE TABLE passwords (
	userid INT NOT NULL UNIQUE,
	hash VARCHAR(255) NOT NULL,
	
	PRIMARY KEY(userid),
	FOREIGN KEY (userid)
		REFERENCES users(userid)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE transactions (
	id INT NOT NULL AUTO_INCREMENT UNIQUE,
	
	userid INT NOT NULL,
	assignerid INT NOT NULL,
	
	timecreated DATETIME NOT NULL,
	
	amount INT NOT NULL,
	pointtype INT NOT NULL,
	
	transaction_comment TEXT,
	
	PRIMARY KEY (id),
	
	FOREIGN KEY(userid)
		REFERENCES users(userid)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
		
	FOREIGN KEY(assignerid)
		REFERENCES users(userid)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
		
	FOREIGN KEY(pointtype)
		REFERENCES point_types(id)
		ON DELETE RESTRICT
		ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;