DROP DATABASE IF EXISTS storeDB;

CREATE DATABASE storeDB;

USE storeDB;

CREATE TABLE Customer (
    customerID int NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    firstName varchar(255) NOT NULL,
    lastName varchar(255) NOT NULL,
    email varchar(255) NOT NULL, 
    phone varchar(20) NOT NULL,
    /*postalCode varchar(255) NOT NULL,
    FOREIGN KEY (postalCode) REFERENCES PostalCode(postalCode)*/
);

CREATE TABLE Purchase (
    purchaseID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    customerID int NOT NULL,
    purchaseDate date NOT NULL,
    totalPrice DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (customerID) REFERENCES Customer(customerID)
);

CREATE TABLE Product (
    productID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(255) NOT NULL,
    priceOfProduct DECIMAL(10, 2) NOT NULL
);

CREATE TABLE Address (
    addressID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    city varchar(100) NOT NULL,
    postalCode varchar(20) NOT NULL,
    streetName varchar(255) NOT NULL,
    streetNumber varchar(20) NOT NULL,
    country varchar(100) NOT NULL
);

-- Many-to-Many relation
CREATE TABLE PurchaseProduct (
    purchaseProductID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    purchaseID int NOT NULL,
    productID int NOT NULL,
    FOREIGN KEY (purchaseID) REFERENCES Purchase(purchaseID),
    FOREIGN KEY (productID) REFERENCES Product(productID)
);

-- Many-to-Many relation
CREATE TABLE CustomerAddress (
    customerAddressID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    customerID int NOT NULL,
    addressID int NOT NULL,
    FOREIGN KEY (customerID) REFERENCES Customer(customerID),
    FOREIGN KEY (addressID) REFERENCES Address(addressID)
);

