-- Is it actualy processing the data from inputs?? If not then Customer, Address, hasCustomerAddress can be removed
CREATE TABLE IF NOT EXISTS Customer (
    customerID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstName varchar(255) NOT NULL,
    lastName varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    phone varchar(20) NOT NULL
);
-- Is it actualy processing the data from inputs?? If not then Customer, Address, hasCustomerAddress can be removed
CREATE TABLE IF NOT EXISTS Address ( 
    addressID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    customerID int NOT NULL,
    city varchar(100) NOT NULL,
    postalCode varchar(20) NOT NULL,
    streetName varchar(255) NOT NULL,
    streetNumber varchar(20) NOT NULL,
    country varchar(100) NOT NULL,
    FOREIGN KEY (customerID) REFERENCES Customer(customerID)
);

CREATE TABLE IF NOT EXISTS Product (
    productID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    priceOfProduct DECIMAL(10, 2) NOT NULL
);

CREATE TABLE IF NOT EXISTS Purchase (
    purchaseID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    productID int NOT NULL,
    customerID int NOT NULL,
    addressID int NOT NULL,
    purchaseDate date NOT NULL,
    totalPrice DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (productID) REFERENCES Product(productID),
    FOREIGN KEY (customerID) REFERENCES Customer(customerID),
    FOREIGN KEY (addressid) REFERENCES Address(addressID)
);

CREATE TABLE IF NOT EXISTS Photo (
    photoID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(255) NOT NULL,
  --  ratio varchar(255) NOT NULL, RATIO IS NOT BEING INEGRATED
    description text NOT NULL,
    basePrice decimal(10, 2) NOT NULL
);
-- Only single print type - no point in having a multiple 
CREATE TABLE Print (
    printID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    printType varchar(255) NOT NULL,
    printTypePrice decimal(10, 2) NOT NULL
);
-- is there implemented larger dimensions = higher price? Cant all sizes be in for the same price  
CREATE TABLE Size (
    sizeID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    dimensions varchar(255) NOT NULL,
    sizePrice decimal(10, 2) NOT NULL
);
-- Is it actualy being used - wouldnt boolean make it easier - frame: YES/NO? 
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
-- Are data about the cusomer being actualy collected throught the input form?
-- Many-to-Many relation
CREATE TABLE CustomerAddress (
    customerAddressID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    customerID int NOT NULL,
    addressID int NOT NULL,
    FOREIGN KEY (customerID) REFERENCES Customer(customerID),
    FOREIGN KEY (addressID) REFERENCES Address(addressID)
);