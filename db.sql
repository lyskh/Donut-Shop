CREATE DATABASE IF NOT EXISTS donut_shop;
USE donut_shop;

-- inventory table
CREATE TABLE IF NOT EXISTS inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    type ENUM('donut', 'coffee') NOT NULL,
    quantity INT NOT NULL
);

-- customers table
CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- employees table
CREATE TABLE IF NOT EXISTS employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- transactions table
CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    inventory_id INT,
    customer_id INT,
    employee_id INT,
    action ENUM('buy', 'add') NOT NULL,
    quantity INT NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (inventory_id) REFERENCES inventory(id),
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);

-- initial inventory data
INSERT INTO inventory (name, type, quantity) VALUES
('Chocolate', 'donut', 50),
('Strawberry', 'donut', 40),
('Boston Cream', 'donut', 30),
('Bavarian', 'donut', 20),
('Glazed', 'donut', 60),
('Regular Coffee', 'coffee', 50),
('Iced Coffee', 'coffee', 40),
('Latte', 'coffee', 30),
('Espresso', 'coffee', 20),
('Frappe', 'coffee', 10);
