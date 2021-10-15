CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;

CREATE TABLE IF NOT EXISTS users (
  ID INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL,
  surname VARCHAR(40) NOT NULL,
  pass VARCHAR(40) NOT NULL,
  grp VARCHAR(40) NOT NULL,
  PRIMARY KEY (ID)
);

INSERT INTO users (name, surname, pass, grp)
SELECT * FROM (SELECT 'Alex', 'Rover', 'Alexpass', 'users') AS tmp
WHERE NOT EXISTS (
    SELECT name FROM users WHERE name = 'Alex' AND surname = 'Rover' AND pass = 'Alexpass' AND grp = 'users'
) LIMIT 1;

INSERT INTO users (name, surname, pass, grp)
SELECT * FROM (SELECT 'Bob', 'Marley', 'Bobpass', 'users') AS tmp
WHERE NOT EXISTS (
    SELECT name FROM users WHERE name = 'Bob' AND surname = 'Marley' AND pass = 'Bobpass' AND grp = 'users'
) LIMIT 1;

INSERT INTO users (name, surname, pass, grp)
SELECT * FROM (SELECT 'Kate', 'Yandson', 'Katepass', 'admins') AS tmp
WHERE NOT EXISTS (
    SELECT name FROM users WHERE name = 'Kate' AND surname = 'Yandson' AND pass = 'Katepass' AND grp = 'admins'
) LIMIT 1;

INSERT INTO users (name, surname, pass, grp)
SELECT * FROM (SELECT 'Lilo', 'Black', 'Lilopass', 'admins') AS tmp
WHERE NOT EXISTS (
    SELECT name FROM users WHERE name = 'Lilo' AND surname = 'Black' AND pass = 'Lilopass' AND grp = 'admins'
) LIMIT 1;

CREATE TABLE IF NOT EXISTS products (
  ID INT(11) NOT NULL AUTO_INCREMENT,
  product VARCHAR(20) NOT NULL,
  price VARCHAR(40) NOT NULL,
  PRIMARY KEY (ID)
);

INSERT INTO products (product, price)
SELECT * FROM (SELECT 'Капучино', '50') AS tmp
WHERE NOT EXISTS (
    SELECT product FROM products WHERE product = 'Капучино' AND price = '50'
) LIMIT 1;

INSERT INTO products (product, price)
SELECT * FROM (SELECT 'Латте', '50') AS tmp
WHERE NOT EXISTS (
    SELECT product FROM products WHERE product = 'Латте' AND price = '50'
) LIMIT 1;

INSERT INTO products (product, price)
SELECT * FROM (SELECT 'Пончик', '60') AS tmp
WHERE NOT EXISTS (
    SELECT product FROM products WHERE product = 'Пончик' AND price = '60'
) LIMIT 1;

CREATE TABLE IF NOT EXISTS orders (
  ID INT(11) NOT NULL AUTO_INCREMENT,
  user VARCHAR(40) NOT NULL,
  product VARCHAR(20) NOT NULL,
  price VARCHAR(20) NOT NULL,
  PRIMARY KEY (ID)
);