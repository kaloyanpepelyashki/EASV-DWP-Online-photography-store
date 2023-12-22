DROP DATABASE IF EXISTS storeDB;

CREATE DATABASE storeDB;

USE storeDB;

CREATE TABLE Customer (
    customerID int NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    firstName varchar(255) NOT NULL,
    lastName varchar(255) NOT NULL,
    email varchar(255) NOT NULL, 
    phone varchar(20) NOT NULL
);

CREATE TABLE Address (
    addressID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    customerID int NOT NULL,
    city varchar(100) NOT NULL,
    postalCode varchar(20) NOT NULL,
    streetName varchar(255) NOT NULL,
    streetNumber varchar(20) NOT NULL,
    country varchar(100) NOT NULL,
    FOREIGN KEY (customerID) REFERENCES Customer(customerID)
);

CREATE TABLE Purchase (
    purchaseID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    customerID int NOT NULL,
    addressID int NOT NULL,
    purchaseDate date NOT NULL,
    totalPrice DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (customerID) REFERENCES Customer(customerID),
    FOREIGN KEY (addressid) REFERENCES Address(addressID)
);

CREATE TABLE Product (
    productID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    priceOfProduct DECIMAL(10, 2) NOT NULL
);

CREATE TABLE Photo (
    photoID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(255) NOT NULL,
    ratio varchar(255) NOT NULL,
    description text NOT NULL,
    basePrice decimal(10, 2) NOT NULL
);

CREATE TABLE Print (
    printID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    printType varchar(255) NOT NULL,
    printTypePrice decimal(10, 2) NOT NULL
);

CREATE TABLE Size (
    sizeID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    dimensions varchar(255) NOT NULL,
    sizePrice decimal(10, 2) NOT NULL
);

CREATE TABLE Frame (
    frameID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    frameType varchar(255) NOT NULL,
    frameSize varchar(255) NOT NULL,
    framePrice decimal(10, 2) NOT NULL
);

CREATE TABLE DailyOffer (
    offerID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    discount decimal(5, 2) NOT NULL,
    photoID int NOT NULL,
    FOREIGN KEY (photoID) REFERENCES Photo(photoID)
);

ALTER TABLE Product
ADD COLUMN printID int NOT NULL,
ADD COLUMN sizeID int NOT NULL,
ADD COLUMN frameID int NOT NULL,
ADD COLUMN photoID int NOT NULL,
ADD COLUMN offerID int NOT NULL;

ALTER TABLE Product
ADD FOREIGN KEY (printID) REFERENCES Print(printID),
ADD FOREIGN KEY (sizeID) REFERENCES Size(sizeID),
ADD FOREIGN KEY (frameID) REFERENCES Frame(frameID),
ADD FOREIGN KEY (photoID) REFERENCES Photo(photoID),
ADD FOREIGN KEY (offerID) REFERENCES DailyOffer(offerID);

CREATE TABLE shopInfo (
    uniqueID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    about text NOT NULL,
    ownerPhone varchar(255) NOT NULL,
    openingHour time NOT NULL,
    closingHour time NOT NULL
);

CREATE TABLE News (
    newsID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    news text NOT NULL,
    date DATE NOT NULL
);

-- Many-to-Many relation
CREATE TABLE PurchaseProduct (
    purchaseProductID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    purchaseID int NOT NULL,
    productID int NOT NULL,
    FOREIGN KEY (purchaseID) REFERENCES Purchase(productID),
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