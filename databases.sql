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
--	jobs
--	jobparts
--	jobworkers
--	images
--	models
--	parts
--	suppliers
--	settings
--	users
--	workers


CREATE DATABASE baskets;
GRANT ALL ON baskets.* TO baskets@localhost IDENTIFIED BY 'baskets';
CREATE TABLE jobs(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	title VARCHAR(128),
	contractor INT UNSIGNED,
	model INT UNSIGNED,
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

