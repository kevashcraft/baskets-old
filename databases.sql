--
-- DROP IF EXISTS
--
DROP DATABASE IF EXISTS baskets;

--
-- CREATE
--
-- db=baskets
-- tables:
--	baskets
--	contractors
--	helpers
--	images
--	jobs
--	jobparts
--	models
--	parts
--	suppliers
--	settings
--	users
--	workers


CREATE DATABASE baskets;
GRANT ALL ON baskets.* TO baskets@localhost IDENTIFIED BY 'baskets';
CREATE TABLE baskets(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	basket VARCHAR(16),
	PRIMARY KEY (id)
) ENGINE=innoDB;

CREATE TABLE contractors(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	contractor VARCHAR(128),
	PRIMARY KEY (id)
) ENGINE=innoDB;

CREATE TABLE helpers(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	name VARCHAR(128),
	email VARCHAR(128),
	phone VARCHAR(32),
	address VARCHAR(256),
	firstday DATE,
	lastday DATE,
	employed BOOLEAN,
	PRIMARY KEY (id)
) ENGINE=innoDB;

CREATE TABLE images(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	filename VARCHAR(32),
	partid INT UNSIGNED,
	workerid INT UNSIGNED,
	helperid INT UNSIGNED,
	userid INT UNSIGNED,
	jobid INT UNSIGNED,
	PRIMARY KEY (id)
) ENGINE=innoDB;

CREATE TABLE jobs(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	title VARCHAR(128),
	contractor INT UNSIGNED,
	model INT UNSIGNED,
	worker INT UNSIGNED,
	helper INT UNSIGNED,
	PRIMARY KEY (id)
) ENGINE=innoDB;

CREATE TABLE jobparts(
	jid INT UNSIGNED,
	pid INT UNSIGNED,
	room VARCHAR(32),
) ENGINE=innoDB;

CREATE TABLE models(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	title VARCHAR(128),
	contractor INT UNSIGNED,
	PRIMARY KEY (id)
) ENGINE=innoDB;

CREATE TABLE parts(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	partid VARCHAR(16),
	title VARCHAR(128),
	supplier INT UNSIGNED,
	bid INT UNSIGNED,	
	price FLOAT,
	PRIMARY KEY (id)
) ENGINE=innoDB;

