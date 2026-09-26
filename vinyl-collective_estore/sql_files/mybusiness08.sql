CREATE DATABASE IF NOT EXISTS hannah_kats_vinyl_collective;USE hannah_kats_vinyl_collective;

CREATE TABLE IF NOT EXISTS Customers (
  customer_id INT NOT NULL AUTO_INCREMENT,
  salutation VARCHAR(10) DEFAULT NULL,
  customer_first_name VARCHAR(50) NOT NULL,
  customer_middle_initial VARCHAR(5) DEFAULT NULL,
  customer_last_name VARCHAR(50) NOT NULL,
  gender VARCHAR(1) DEFAULT NULL,
  email_address VARCHAR(50) NOT NULL,
  login_name VARCHAR(50) NOT NULL,
  login_password VARCHAR(50) NOT NULL,
  phone_number VARCHAR(20) DEFAULT NULL,
  address TEXT DEFAULT NULL,
  town_city VARCHAR(50) DEFAULT NULL,
  county VARCHAR(50) DEFAULT NULL,
  country VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (customer_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO Customers (customer_id, salutation, customer_first_name, customer_middle_initial, customer_last_name, gender, email_address, login_name, login_password, phone_number, address, town_city, county, country)
VALUES
(1,'Mr.','Harry','J','Potter','M','harry.potter@email.com','harry','potter123','(212) 555-0101','4 Privet Drive','Little Whinging','Surrey','UK'),
(2,'Mr.','Donald','F','Duck','M','donald.duck@email.com','donald','duck123','(718) 555-0182','1313 Webfoot Walk','Duckburg','Calisota','US'),
(3,'Ms.','Carrie','M','Bradshaw','F','carrie.bradshaw@email.com','carrie','bradshaw123','(917) 555-0247','66 Perry Street','Manhattan','NY','US'),
(4,'Mr.','Paddington','B','Bear','M','paddington.bear@email.com','paddington','bear123','(917) 555-0248','32 Windsor Gardens','London','London','UK'),
(5,'Mr.','Peter','B','Parker','M','peter.parker@email.com','peter','parker123','(646) 555-0318','20 Ingram St.','Forest Hills','Queens','US');

CREATE TABLE IF NOT EXISTS Products (
  product_id INT NOT NULL AUTO_INCREMENT,
  product_name VARCHAR(150) NOT NULL,
  product_category_code VARCHAR(50) NOT NULL,
  product_price DECIMAL(8,2) NOT NULL,
  product_inventory INT NOT NULL DEFAULT 0,
  product_image_url VARCHAR(255) DEFAULT '/images-store/image1.png',
  PRIMARY KEY (product_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO Products (product_id, product_name, product_category_code, product_price, product_inventory, product_image_url)
VALUES
(1,'Ghibli Jazz Live - All That Jazz','antique',148.99,2,'/images-store/image1.png'),
(2,'Eternal Sunshine Deluxe: Brighter Days Ahead 2LP','vinyl_album',34.99,8,'/images-store/image2.png'),
(3,'Mans Best Friend D2C Alt Cover','second_hand',35.50,3,'/images-store/image3.png'),
(4,'BTS 5th Full Album - ARIRANG','signed',1599.00,1,'/images-store/image4.png'),
(5,'Coldplay Music of the Spheres Vinyl LP','exclusive',89.99,4,'/images-store/image5.png'),
(6,'Yellow Submarine LP','exclusive',89.99,4,'/images-store/image6.png'),
(7,'Right Person Wrong Place','vinyl_album',34.99,8,'/images-store/image7.png'),
(8,'Golden Weverse Ver','second_hand',35.50,3,'/images-store/image8.png'),
(9,'Brat','signed',599.00,2,'/images-store/image9.png'),
(10,'Dangerous Double Vinyl','antique',149.99,1,'/images-store/image10.png'),
(11,'Wuthering Heights Soundtrack Vinyl','rentable',19.99,5,'/images-store/image11.png'),
(12,'Face Walmart Exclusive','vinyl_album',29.99,6,'/images-store/image12.png'),
(13,'Olivia Rodrigo GUTS Limited Edition','second_hand',24.99,4,'/images-store/image13.png'),
(14,'SZA SOS Deluxe Edition','exclusive',79.99,3,'/images-store/image14.png'),
(15,'Fleetwood Mac Rumours Classic Edition','antique',199.99,1,'/images-store/image15.png')
ON DUPLICATE KEY UPDATE
  product_name = VALUES(product_name),
  product_category_code = VALUES(product_category_code),
  product_price = VALUES(product_price),
  product_inventory = VALUES(product_inventory),
  product_image_url = VALUES(product_image_url);

CREATE TABLE IF NOT EXISTS Orders (
  order_id INT NOT NULL AUTO_INCREMENT,
  customer_id INT NOT NULL DEFAULT 0,
  order_status_code VARCHAR(2) NOT NULL DEFAULT 'IP',
  date_order_placed DATE DEFAULT NULL,
  order_details TEXT DEFAULT NULL,
  PRIMARY KEY (order_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS Order_Items (
  order_item_id INT NOT NULL AUTO_INCREMENT,
  order_item_status_code VARCHAR(2) NOT NULL DEFAULT 'IP',
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  order_item_quantity INT DEFAULT NULL,
  order_item_price DECIMAL(8,2) DEFAULT NULL,
  other_order_item_details TEXT DEFAULT NULL,
  PRIMARY KEY (order_item_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS Ref_Product_Categories (
  product_category_code VARCHAR(50) NOT NULL,
  product_category_description VARCHAR(100) NOT NULL,
  department_name VARCHAR(50) NOT NULL,
  PRIMARY KEY (product_category_code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO Ref_Product_Categories (product_category_code, product_category_description, department_name)
VALUES
('vinyl_album','Vinyl Albums','Vinyl Library'),
('second_hand','Second-Hand Vinyls','Vinyl Library'),
('antique','Antique Vinyls','Vinyl Library'),
('exclusive','Exclusive Vinyls','Vinyl Library'),
('signed','Signed Vinyls','Vinyl Library'),
('rentable','Rentable Vinyls','Vinyl Library');