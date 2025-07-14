-- Create the database
CREATE DATABASE lifechoicesshop;
USE lifechoicesshop;

-- Users table
CREATE TABLE users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) ,
  password VARCHAR(50) 
);

-- Insert demo users
INSERT INTO users (username, password)
VALUES ('Likhona Benayo', 'password123'),
	   ('John Doe', 'aeiou');

-- Items table
CREATE TABLE items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) ,
  price DECIMAL(10,2)
);

-- Insert 5 products
INSERT INTO items (name, price) 
VALUES ('Journal', 300),
	   ('Candle', 120),
	   ('Yoga Mat', 250),
	   ('Brown Fur Coat', 180),
	   ('Book', 200);



-- Cart table
CREATE TABLE  cart (
  cart_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (id) REFERENCES items(id)
);

-- Optionally, insert some cart data for testing
-- INSERT INTO cart (user_id, item_id) VALUES (1, 1), (1, 2);
