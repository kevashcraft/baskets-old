--
-- DROP IF EXISTS
--
DROP DATABASE IF EXISTS baskets;

--
-- CREATE
--
CREATE DATABASE baskets;
GRANT ALL ON baskets.* TO baskets@localhost IDENTIFIED BY 'baskets';
