-- WEBSITE NAME: CraftCourt

DROP SCHEMA IF EXISTS craftcourt_db;

CREATE SCHEMA craftcourt_db; 

USE craftcourt_db;

CREATE table users(
	account_id INT AUTO_INCREMENT NOT NULL,
    username VARCHAR(25) NOT NULL,
    password VARCHAR(80) NOT NULL,
    email TEXT NOT NULL,
    contact_no VARCHAR(11) NOT NULL,
    address LONGTEXT NOT NULL,
    shop_id INT NULL,
    
    PRIMARY KEY (account_id)
);

INSERT INTO `users`(`username`,`password`,`email`,`contact_no`,`address`) 
	VALUES('1_admin','01_admin','alylagayan@gmail.com','09471303432','B24 L14 P1A San Lorenzo South, Sta. Rosa, Laguna, Philipppines'),
		  ('rossmendez','hOSANNA','rossmendez@gmail.com','0922996193','Muralla Industrial Park, Libtong, Philipppines'),
          ('doktoraBello','uyBESH','bello_phd@gmail.com','0922996193','SUITE 202 Cortijos Condo25 Eisenhower Street Greenhills, Philipppines'),
          ('cass_ce','bebebebe','c_matias@yahoo.com','09893212253','7/F The Athenaeum Building, 160 Alfaro Street Salcedo Village 1200, Makati City, Manila, Philipppines'),
		  ('ag5598', 'gomez123','arlanross@gmail.com','09175728050','230 Mozart St., Sta. Rosa Estates 1, Santa Rosa, Laguna'),
		  ('aric','aric123','aricbrillantes@gmail.com','0922-8112714','B10 L22 Almacega St., Progressive Village,Tagapo,Santa Rosa,Laguna'),
	      ('ajctan','aron', 'arontan@yahoo.com','0917-9001234','18 Langka Cor. Guyabano St.Ayala Westgrove Heights,Silang, Cavite');
		  
INSERT INTO `users`(`username`,`password`,`email`,`contact_no`,`address`,`shop_id`) 
	VALUES('3_admin','03_admin','jan_lagayan@dlsu.edu.ph','09471303432','B24 L14 P1A San Lorenzo South, Sta. Rosa, Laguna, Philipppines', 1);
	

		  
		  
-- A user can buy or sell products
-- A user can open only one shop
-- A new row in `shops` is created when a user opens a shop

CREATE table shops(
	id INT NOT NULL,
    shop_owner INT NOT NULL,
    shop_name TEXT NOT NULL,
    shop_contact VARCHAR(11) NOT NULL,
    description VARCHAR(300) null,

	PRIMARY KEY (id),

    CONSTRAINT opener
		FOREIGN KEY (shop_owner) 
        REFERENCES users(account_id)
);

-- A shop can have zero to many products
-- User -> Shop -> Products

CREATE table products(
	id INT AUTO_INCREMENT,
    seller_id INT,
    p_name VARCHAR(100),
    price decimal(8,2) NOT NULL,
    description VARCHAR(250),
    p_type INT,
    date_posted DATE,
    
	PRIMARY KEY (id),
    
    CONSTRAINT product_seller
		FOREIGN KEY (seller_id) 
        REFERENCES shops(id)
);
INSERT INTO `products` VALUES	
	(5, 'PSVita', 10000.00, 'PSVita phat, slight scratches, comes with a game(freedom wars)',,'2017-09-30'),
	(7, 'Vanguard Deletor mat', 500.00,'used few times',,'2017-07-25'),
	(5, 'God of War collection', 600.00, 'PSVita game',,'2017-05-29'),
	(5, 'Vanguard Dimensional Robo deck', 4000.00,'Comes with sleeves and deckbox',,'2017-11-20');
	
	

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
INSERT INTO `product_status`
	(1,'For Sale'),
	(2,'Sold');


		  

