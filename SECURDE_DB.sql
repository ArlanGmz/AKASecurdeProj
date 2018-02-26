-- WEBSITE NAME: CraftCourt

DROP SCHEMA IF EXISTS craftcourt_db;

CREATE SCHEMA craftcourt_db; 

USE craftcourt_db;

CREATE table users(
	account_id INT AUTO_INCREMENT NOT NULL,
    username VARCHAR(25) NOT NULL,
    password VARCHAR(80) NOT NULL,
    email TEXT NOT NULL,
    contact_no INT NOT NULL,
    address LONGTEXT NOT NULL,
    shop_id INT NULL,
    
    PRIMARY KEY (account_id)
);

-- A user can buy or sell products
-- A user can open only one shop
-- A new row in `shops` is created when a user opens a shop

CREATE table shops(
	id INT AUTO_INCREMENT NOT NULL,
    shop_owner INT NOT NULL,
    shop_name TEXT,
    shop_address LONGTEXT NOT NULL,
    shop_email TEXT NOT NULL,
    shop_contact INT NOT NULL,
    description VARCHAR(300),

	PRIMARY KEY (id),

    CONSTRAINT opener
		FOREIGN KEY (shop_owner) 
        REFERENCES users(id)
);

-- A shop can have zero to many products
-- User -> Shop -> Products

CREATE table products(
	id INT AUTO_INCREMENT,
    seller_id INT,
    p_name VARCHAR(100),
    price INT,
    description VARCHAR(250),
    p_type INT,
    date_posted DATE,
    
	PRIMARY KEY (id),
    
    CONSTRAINT product_seller
		FOREIGN KEY (seller_id) 
        REFERENCES shops(id)
);

CREATE table product_inventory(
	shop INT,
    product INT,
    inventory_id INT AUTO_INCREMENT,
    p_status INT,
    
    PRIMARY KEY (inventory_id),
    
    CONSTRAINT seller
		FOREIGN KEY (shop) 
        REFERENCES shops(id),
	CONSTRAINT item
		FOREIGN KEY (product) 
        REFERENCES products(id)
);

CREATE table product_status(
	status_id INT,
    state TEXT
);