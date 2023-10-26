DROP DATABASE IF EXISTS storeDB;

CREATE DATABASE storeDB;

USE storeDB;

CREATE TABLE PostalCode (
    postalCode varchar(255) NOT NULL PRIMARY KEY,
    city varchar(255) NOT NULL
);
CREATE TABLE Customer (
    customerID int NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    firstName varchar(255) NOT NULL,
    lastName varchar(255) NOT NULL,
    email varchar(255) NOT NULL, 
    phone varchar(255) NOT NULL,
    postalCode varchar(255) NOT NULL,
    FOREIGN KEY (postalCode) REFERENCES PostalCode(postalCode)
);
CREATE TABLE Purchase (
    purchaseID int NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    price int NOT NULL,
    customerID int NOT NULL,
    FOREIGN KEY (customerID) REFERENCES Customer(customerID)
)
