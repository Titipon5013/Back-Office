-- Create Database
CREATE DATABASE CJ_Streetwear;
USE CJ_Streetwear;

-- Customer Table
CREATE TABLE Customer (
    CustomerID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    Email VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    RegistrationDate TIMESTAMP,
    OrderHistory TEXT,
    OrderTracking TEXT,
    CustomerLocation VARCHAR(255),
    PhoneNumber VARCHAR(15)
);

-- Order Table
CREATE TABLE `Order` (
    OrderID INT AUTO_INCREMENT PRIMARY KEY,
    CustomerID INT,
    CollectionID INT,
    OrderDate DATE,
    Status VARCHAR(50),
    FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID)
);

-- CollectionList Table (Stores products like Caps, Pants, etc.)
CREATE TABLE CollectionList (
    CollectionID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    Price DECIMAL(10, 2),
    Size VARCHAR(50),
    Color VARCHAR(50),
    StockLevel INT,
    Images TEXT,
    ListingDetails TEXT,
    Description TEXT
);

-- Shipping & Delivery Table
CREATE TABLE ShippingAndDelivery (
    ShippingID INT AUTO_INCREMENT PRIMARY KEY,
    OrderID INT,
    ShippingCost DECIMAL(10, 2),
    DeliveryTime DATE,
    CustomerLocation VARCHAR(255),
    OrderSize VARCHAR(50),
    Status VARCHAR(50),
    FOREIGN KEY (OrderID) REFERENCES `Order`(OrderID)
);

-- Transaction Table
CREATE TABLE Transaction (
    TransactionID INT AUTO_INCREMENT PRIMARY KEY,
    OrderID INT,
    PaymentMethod VARCHAR(50),
    PaymentDetails TEXT,
    Timestamp TIMESTAMP,
    FOREIGN KEY (OrderID) REFERENCES `Order`(OrderID)
);

-- Refund Table
CREATE TABLE Refund (
    RefundID INT AUTO_INCREMENT PRIMARY KEY,
    OrderID INT,
    ReturnReason TEXT,
    RefundStatus VARCHAR(50),
    FOREIGN KEY (OrderID) REFERENCES `Order`(OrderID)
);

-- Receipt Table
CREATE TABLE Receipt (
    ReceiptID INT AUTO_INCREMENT PRIMARY KEY,
    OrderID INT,
    CustomerID INT,
    CollectionID INT,
    TaxID INT,
    Details TEXT,
    FOREIGN KEY (OrderID) REFERENCES `Order`(OrderID),
    FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID),
    FOREIGN KEY (CollectionID) REFERENCES CollectionList(CollectionID),
    FOREIGN KEY (TaxID) REFERENCES Tax(TaxID)
);

-- Employee Table
CREATE TABLE Employee (
    EmployeeID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    Role VARCHAR(50),
    Salary DECIMAL(10, 2),
    PhoneNumber VARCHAR(15)
);
-- Inventory Table
CREATE TABLE Inventory (
    InventoryID INT AUTO_INCREMENT PRIMARY KEY,
    CollectionID INT,
    EmployeeID INT,
    StockLevel INT,
    Status VARCHAR(50),
    FOREIGN KEY (CollectionID) REFERENCES CollectionList(CollectionID),
    FOREIGN KEY (EmployeeID) REFERENCES Employee(EmployeeID)
);

-- Discount & Promotion Table
CREATE TABLE DiscountAndPromotion (
    PromotionID INT AUTO_INCREMENT PRIMARY KEY,
    DiscountCode VARCHAR(50),
    DiscountDetails TEXT,
    ValidUntil DATE
);

-- Tax Table
CREATE TABLE Tax (
    TaxID INT AUTO_INCREMENT PRIMARY KEY,
    Location VARCHAR(255),
    TaxRate DECIMAL(5, 4)
);


