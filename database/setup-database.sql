-- Purpose: Create the database schema and populate it with sample data.

drop table if exists customer;
create table customer(
customerId integer auto_increment,
username varchar(50) unique not null,
firstName varchar(100),
surname varchar(100),
shippingAddress varchar(500) not null,
emailAddress varchar(250),
password varchar(50) not null,
constraint customer_PK primary key(customerId)
);
 
 
 drop table if exists product;
create table product(
productId varchar(20),
name varchar(100) not null,
description varchar(1000) not null,
category varchar(100) not null,
listPrice decimal(10,2) not null,
quantityInStock decimal(4,0) not null,
constraint product_PK primary key(productId)
);

INSERT INTO customer (username, firstName, surname, shippingAddress, emailAddress, password)
VALUES
    ('john_doe', 'John', 'Doe', '123 Elm Street, Springfield, IL, 62704', 'john.doe@example.com', 'password123'),
    ('jane_smith', 'Jane', 'Smith', '456 Oak Avenue, Rivertown, TX, 75001', 'jane.smith@example.com', 'securepass456'),
    ('alice_jones', 'Alice', 'Jones', '789 Maple Road, Willow Creek, CA, 94001', 'alice.jones@example.com', 'alicepass789'),
    ('bob_brown', 'Bob', 'Brown', '101 Pine Lane, Lakeside, FL, 33101', 'bob.brown@example.com', 'bobpass101'),
    ('carol_white', 'Carol', 'White', '202 Cedar Street, Mountain View, CO, 80301', 'carol.white@example.com', 'carolpass202');


INSERT INTO product (productId, name, description, category, listPrice, quantityInStock)
VALUES
    ('P1001', 'Wireless Mouse', 'A high-precision wireless mouse with ergonomic design.', 'Accessories', 29.99, 150),
    ('P1002', 'Bluetooth Headphones', 'Over-ear Bluetooth headphones with noise-cancellation.', 'Headphones', 89.99, 75),
    ('P1003', '4K Ultra HD Smart TV', '55-inch 4K Ultra HD Smart TV with built-in streaming apps and voice control.', 'TV', 499.99, 25),
    ('P1004', 'Smartphone', 'Latest model smartphone with 128GB storage, 6GB RAM, and advanced camera features.', 'Smartphones', 699.99, 50),
    ('P1005', 'Smartwatch', 'Stylish smartwatch with fitness tracking, notifications, and customizable watch faces.', 'Watches', 199.99, 100),
    ('P1006', 'Wireless Keyboard and Mouse Combo', 'Compact wireless keyboard and mouse combo with long battery life and ergonomic design.', 'Accessories', 49.99, 200),
    ('P1007', 'Portable Bluetooth Speaker', 'Water-resistant portable Bluetooth speaker with 12 hours of battery life and superior sound quality.', 'Speaker', 79.99, 120),
    ('P1008', 'Digital Camera', 'High-resolution digital camera with 20MP sensor, optical zoom, and Wi-Fi connectivity.', 'Camera', 299.99, 40),
    ('P1009', 'External Hard Drive', '1TB external hard drive with USB 3.0 connectivity and backup software.', 'Electronics', 89.99, 60),
    ('P1010', 'Home Security Camera', 'Smart home security camera with motion detection, night vision, and remote access.', 'Electronics', 129.99, 35),
    ('P1011', 'Gaming Console', 'Next-gen gaming console with 4K support, high-speed SSD, and a library of popular games.', 'Gaming', 399.99, 20),
    ('P1012', 'Virtual Reality Headset', 'Immersive virtual reality headset with motion controllers and a wide field of view.', 'Gaming', 299.99, 45);