CREATE DATABASE IF NOT EXISTS cafe_db;
USE cafe_db;

CREATE TABLE IF NOT EXISTS menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT
);

INSERT INTO menu_items (name, category, price, description) VALUES
('Cloud9-PH Latte', 'Coffee', 165.00, 'Smooth espresso with creamy steamed milk.'),
('Iced Barako', 'Coffee', 145.00, 'Strong local barako brewed over ice.'),
('Ube Cheesecake', 'Pastries', 180.00, 'Fusion of cheesecake and Filipino ube.'),
('Ensaymada Deluxe', 'Pastries', 95.00, 'Cheesy brioche with a butter glaze.'),
('Manual Espresso Maker', 'Equipment', 1200.00, 'Classic stovetop Moka pot.'),
('V60 Pour Over Kit', 'Equipment', 850.00, 'Complete kit for home pour over coffee.'),
('Benguet Highland Beans (250g)', 'Retail', 350.00, 'Medium roast whole beans from Benguet.');
