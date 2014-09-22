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
--	basketsitems
--	contractors
--	helpers
--	images
--	jobs
--	jobparts
--	models
--	parts
--	settings
--	suppliers
--	users
--	workers


CREATE DATABASE baskets;
GRANT ALL ON baskets.* TO baskets@localhost IDENTIFIED BY 'baskets';
USE baskets;

CREATE TABLE baskets(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	basket VARCHAR(16),
	PRIMARY KEY (id)
) ENGINE InnoDB;

CREATE TABLE basketitems(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	basketid INT UNSIGNED,
	jobid INT UNSIGNED,
	PRIMARY KEY (id)
) ENGINE InnoDB;

CREATE TABLE contractors(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	contractor VARCHAR(128),
	address VARCHAR(256),
	phone VARCHAR(32),
	valid BOOLEAN,
	PRIMARY KEY (id)
) ENGINE InnoDB;

CREATE TABLE images(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	filename VARCHAR(32),
	partid INT UNSIGNED,
	workerid INT UNSIGNED,
	helperid INT UNSIGNED,
	userid INT UNSIGNED,
	jobid INT UNSIGNED,
	valid BOOLEAN,
	PRIMARY KEY (id)
) ENGINE InnoDB;

CREATE TABLE jobs(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	job VARCHAR(128),
	contractor INT UNSIGNED,
	model INT UNSIGNED,
	worker INT UNSIGNED,
	helper INT UNSIGNED,
	PRIMARY KEY (id)
) ENGINE InnoDB;

CREATE TABLE jobparts(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	jobid INT UNSIGNED,
	partid INT UNSIGNED,
	room VARCHAR(32),
	status SMALLINT,
	comment TEXT,
	imageid INT UNSIGNED,
	PRIMARY KEY (id)
) ENGINE InnoDB;

CREATE TABLE models(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	model VARCHAR(128),
	contractorid INT UNSIGNED,
	PRIMARY KEY (id)
) ENGINE InnoDB;

CREATE TABLE parts(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	partid VARCHAR(16),
	partname VARCHAR(128),
	supplierid INT UNSIGNED,
	bidid INT UNSIGNED,	
	price FLOAT,
	PRIMARY KEY (id)
) ENGINE InnoDB;

CREATE TABLE settings(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id)
) ENGINE InnoDB;

CREATE TABLE suppliers(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	supplier VARCHAR(64),
	address VARCHAR(256),
	phone VARCHAR(32),
	valid BOOLEAN,
	PRIMARY KEY (id)
) ENGINE InnoDB;

CREATE TABLE users(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	wid INT UNSIGNED,
	password VARCHAR(128),
	authlevel TINYINT UNSIGNED,
	valid BOOLEAN,
	PRIMARY KEY (id)
) ENGINE InnoDB;

CREATE TABLE workers(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	department VARCHAR(16),
	name VARCHAR(128),
	email VARCHAR(128),
	phone VARCHAR(32),
	address VARCHAR(256),
	firstday DATE,
	lastday DATE,
	employed BOOLEAN,
	PRIMARY KEY (id)
) ENGINE InnoDB;

