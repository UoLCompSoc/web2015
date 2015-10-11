USE compsoc;

DROP TABLE IF EXISTS transactions;
DROP TABLE IF EXISTS passwords;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS point_types;
DROP TABLE IF EXISTS clothing_sizes;
DROP TABLE IF EXISTS campaigns;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS batch_mails;

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
  fullname VARCHAR(50) NOT NULL,
  datejoined DATE NOT NULL,

  permissions INT NOT NULL,
  committee TINYINT NOT NULL DEFAULT 0,

  passwordhash VARCHAR(255) NOT NULL,
	
  githubID VARCHAR(40),
  linkedinURL VARCHAR(255),
  steamID VARCHAR(50),
  twitterID VARCHAR(20),

  PRIMARY KEY (userid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

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

CREATE TABLE campaigns (
  id INT NOT NULL AUTO_INCREMENT UNIQUE,

  name VARCHAR(255) NOT NULL,
  expiry_date DATETIME NOT NULL,
  description VARCHAR(255) NOT NULL,

  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

CREATE TABLE clothing_sizes (
  id INT NOT NULL AUTO_INCREMENT,

  name VARCHAR(255) NOT NULL,
  description VARCHAR(255) NOT NULL,

  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE orders (
  id INT NOT NULL AUTO_INCREMENT,

  userid INT NOT NULL,
  campaign_id INT NOT NULL,
  size_id INT NOT NULL,
  paid TINYINT NOT NULL,

  PRIMARY KEY (id),

  FOREIGN KEY(userid)
    REFERENCES users(userid)
    ON DELETE CASCADE
    ON UPDATE CASCADE,

  FOREIGN KEY(campaign_id)
    REFERENCES campaigns(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,

  FOREIGN KEY(size_id)
    REFERENCES clothing_sizes(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

CREATE TABLE batch_mails (
  id INT NOT NULL AUTO_INCREMENT,

  recipientCount INT NOT NULL,
  committeeOnly TINYINT NOT NULL,

  title VARCHAR(255) NOT NULL,
  subject VARCHAR(255) NOT NULL,
  emailText TEXT NOT NULL,
  
  sentDate DATETIME NOT NULL,

  senderID INT NOT NULL,

  PRIMARY KEY (id),

  FOREIGN KEY(senderID)
    REFERENCES users(userid)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

CREATE TABLE tags (
    id INT NOT NULL AUTO_INCREMENT UNIQUE,
    
    tag VARCHAR(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

CREATE TABLE questions (
    id INT NOT NULL AUTO_INCREMENT UNIQUE,
    
    submitterID INT NOT NULL,
    dateAsked DATETIME NOT NULL,
    question VARCHAR(255) NOT NULL,
    body TEXT NOT NULL, 
    answered BOOLEAN NOT NULL,
    
    PRIMARY KEY (id),
    
    FOREIGN KEY (submitterID)
        REFERENCES users(userid)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

CREATE TABLE question_tags (
    questionID INT NOT NULL,
    tagID INT NOT NULL,
    
    PRIMARY KEY (questionID, tagID),
    
    FOREIGN KEY (questionID)
        REFERENCES questions(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
        
    FOREIGN KEY (tagID)
        REFERENCES tags(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        

CREATE TABLE answers (
    id INT NOT NULL AUTO_INCREMENT UNIQUE,
    
    submitterID INT NOT NULL,
    questionID INT NOT NULL,
    dateAnswered DATETIME NOT NULL,
    body TEXT NOT NULL,
    helpfulCounter INT NOT NULL,
    
    PRIMARY KEY (id),
    
    FOREIGN KEY (questionID)
        REFERENCES questions(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    
    FOREIGN KEY (submitterID)
        REFERENCES users(userid)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;
