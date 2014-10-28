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

CREATE TABLE contractors(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	contractor VARCHAR(128),
	address VARCHAR(256),
	phone VARCHAR(32),
	email VARCHAR(128),
	fax VARCHAR(32),
	valid BOOLEAN,
	PRIMARY KEY (id)
) ENGINE InnoDB;


CREATE TABLE proposals(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	contractorid INT UNSIGNED,
	model VARCHAR(128),
	opt VARCHAR(128),
	hours SMALLINT,
	labor DECIMAL(8,2),
	totes DECIMAL(8,2),
	adjust DECIMAL(8,2),
	partstotal DECIMAL(8,2),
	profitmargin VARCHAR(12),
	PRIMARY KEY (id)
) ENGINE InnoDB;

CREATE TABLE proposalparts(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	room VARCHAR(64),
	partid INT UNSIGNED,
	price DECIMAL(8,2),
	PRIMARY KEY (id)
)	ENGINE InnoDB;


CREATE TABLE estimateparts(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	room VARCHAR(128),
	partid INT UNSIGNED,
	bidit INT UNSIGNED,
	price DECIMAL(8,2),
	PRIMARY KEY (id)
) ENGINE InnoDB;




CREATE TABLE sessions(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	userid INT UNSIGNED,
	cookid VARCHAR(128),
	useragent VARCHAR(256),
	valid BOOLEAN,
	PRIMARY KEY (id)
) ENGINE InnoDB;

CREATE TABLE settings(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id)
) ENGINE InnoDB;


CREATE TABLE bids(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	expiration DATE,
	bid VARCHAR(64),
	supplierid INT UNSIGNED,
	valid BOOLEAN,
	PRIMARY KEY (id)
) ENGINE InnoDB;

CREATE TABLE bidparts(
	bidid INT UNSIGNED,
	partid INT UNSIGNED,
	price DECIMAL(8,2)
) ENGINE InnoDB;

CREATE TABLE parts(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	partid VARCHAR(64) UNIQUE,
	brand VARCHAR(32),
	partdesc VARCHAR(512),
	installhours DECIMAL(3,3),
	installpoint VARCHAR(16),
	upc VARCHAR(64),
	listprice DECIMAL(8,2),
	smallpic VARCHAR(512),
	largepic VARCHAR(512),
	productinfo VARCHAR(512),
	techmanual VARCHAR(512),
	PRIMARY KEY (id)
) ENGINE InnoDB;





CREATE TABLE suppliers(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	supplier VARCHAR(64),
	address VARCHAR(256),
	email VARCHAR(128),
	fax VARCHAR(32),
	phone VARCHAR(32),
	valid BOOLEAN,
	PRIMARY KEY (id)
) ENGINE InnoDB;





CREATE TABLE users(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	dtu DATETIME,
	wid INT UNSIGNED,
	username VARCHAR(128),
	password VARCHAR(255),
	authlevel TINYINT UNSIGNED,
	valid BOOLEAN,
	PRIMARY KEY (id)
) ENGINE InnoDB;


CREATE TABLE visits(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dt DATETIME,
	ua VARCHAR(128),
	ip INT UNSIGNED,
	PRIMARY KEY (id)
);


