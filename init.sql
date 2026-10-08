CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,INSERT,UPDATE,DELETE ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;

CREATE TABLE IF NOT EXISTS users (
  ID INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL,
  surname VARCHAR(40) NOT NULL,
  PRIMARY KEY (ID)
);

INSERT INTO users (name, surname) VALUES
  ('Alex', 'Rover'),
  ('Bob', 'Marley'),
  ('Kate', 'Yandson'),
  ('Lilo', 'Black');

CREATE TABLE IF NOT EXISTS orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  product VARCHAR(100) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(ID)
);

INSERT INTO orders (user_id, product, price) VALUES
  (1, 'Bread', 40.00),
  (1, 'Milk', 80.00),
  (2, 'Cheese', 200.00),
  (3, 'Apple', 30.00),
  (4, 'Juice', 100.00);
