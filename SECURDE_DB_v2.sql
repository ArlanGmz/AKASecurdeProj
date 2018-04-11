DROP SCHEMA IF EXISTS craftcourt_db;
CREATE SCHEMA craftcourt_db; 
USE craftcourt_db;

-- ==============================================================
-- Creating tables...
-- ==============================================================

-- TURNS OUT I NEED TO MAKE PK B4 I MAKE IT FK...GODS HELP ME

CREATE table p_payment(
	py_id INT NOT NULL,
    py_mode VARCHAR(200) NOT NULL,
    
    PRIMARY KEY(py_id)
);

CREATE table p_status(
	st_id INT NOT NULL,
    status_txt VARCHAR(200) NOT NULL,
    
    PRIMARY KEY(st_id)
);

CREATE table p_type(
	t_id INT NOT NULL,
    type_txt VARCHAR(200) NOT NULL,
    
    PRIMARY KEY(t_id)
);

CREATE table users(
	id INT AUTO_INCREMENT NOT NULL,
    uname VARCHAR(50) NOT NULL,
    pcode VARCHAR(50) NOT NULL,
    firstname TEXT NOT NULL,
    lastname TEXT NOT NULL,
    email TEXT NOT NULL,
    
    PRIMARY KEY (id)
);

CREATE table shops(
	s_id INT AUTO_INCREMENT NOT NULL,
    shop_name VARCHAR(50) NOT NULL,
    description TEXT,

	PRIMARY KEY (s_id)
);

CREATE table user_shops(
	id INT NOT NULL,
    s_id INT NOT NULL,
    
    CONSTRAINT keeper
		FOREIGN KEY (id)
        REFERENCES `users`(`id`),
        
    CONSTRAINT shop
		FOREIGN KEY (s_id) 
        REFERENCES `shops`(`s_id`)
);

CREATE table products(
	p_id INT AUTO_INCREMENT NOT NULL,
    seller INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    price decimal(8,2) NOT NULL,
    description VARCHAR(250) NULL,
    p_type INT NOT NULL,
    state INT NOT NULL,
    
    CONSTRAINT provider
		FOREIGN KEY (seller) 
        REFERENCES `shops`(`s_id`),
        
	CONSTRAINT state
		FOREIGN KEY(state)
        REFERENCES p_status(st_id),
        
    PRIMARY KEY (p_id)
);

-- CREATE table listing(
-- 	l_id INT AUTO_INCREMENT NOT NULL,
-- 	listdate DATE NOT NULL,
--    p_id INT NOT NULL,
--    quantity INT NOT NULL,
    
--    CONSTRAINT product
-- 		FOREIGN KEY (p_id)
--        REFERENCES products(p_id),
        
--    PRIMARY KEY (l_id)
-- );

 CREATE table deliveries(
 	d_id INT AUTO_INCREMENT NOT NULL,
    p_id INT NOT NULL,
    saledate DATE NOT NULL,
	fullname VARCHAR(200) NOT NULL,
	address TEXT NOT NULL,
    py_id INT NOT NULL,
    
    CONSTRAINT bought
		FOREIGN KEY (p_id)
		REFERENCES `products`(`p_id`),
        
	CONSTRAINT pmode
		FOREIGN KEY (py_id)
		REFERENCES `p_payment`(`py_id`),
        
	 	PRIMARY KEY (d_id)
 );


-- ==============================================================
-- Adding sample data...
-- ==============================================================

INSERT INTO `p_type`
	VALUES	(1,'Accessories'),
			(2,'Art Collectibles'),
			(3,'Bags'),
			(4,'Beauty'),
			(5,'Books, Movies, and Music'),
			(6,'Clothing'),
			(7,'Craft Supplies and Tools'),
			(8,'Electronics'),
			(9,'Home and Living'),
			(10,'Jewellry'),
			(11,'Party Supplies'),
			(12,'Pet Supplies'),
			(13,'Shoes'),
			(14,'Toys and Games'),
			(15,'Weddings');
    
INSERT INTO `p_status`
	VALUES	(1,'For Sale'),
			(2,'Sold');
            
INSERT INTO `p_payment`
	VALUES	(1,'Cash'),
			(2,'Credit Card');
    
INSERT INTO `users`(`uname`,`pcode`,`firstname`,`lastname`,`email`) 
	VALUES	('1_admin','633367e0d6cfecc1a6a60536d6d97b03a455903da93d67bf561dc2803cf42040', 'Jan', 'Lagayan','alylagayan@gmail.com'), -- 01_admin
			('rossmendez','16807e90ffbfe800d7fb27773574e1d08e229253d2e388c9e7e221b33e16b5a4', 'Ross', 'Mendez','rossmendez@gmail.com'), -- hOSANNA
            ('doktoraBello','ade852c46f3c6393ced06bd9a885bf71ac07e2db149324bf06ea62c807574309', 'Vicki', 'Bello','bello_phd@gmail.com'), -- uyBESH
            ('cass_ce','abaa35e56a2efea258ac3393228c91cb5e2f75635b492f60558ef34c24a6fb1e', 'Cassandra', 'Matias','c_matias@yahoo.com'), -- bebebebe
            ('ag5598', '4043f749cda5e263c132cf209bd8bc3801b913923dee93b4686d0447926c1204', 'Arlan', 'Gomez','arlanross@gmail.com'), -- gomez123
            ('aric','fe7af83b5433537b6d47fac41eb96107999a203afbb2949817141626eee261b6', 'Aric', 'Brillantes','aricbrillantes@gmail.com'), -- aric123
			('Yves', '3feb4db620a2b44ddde33dc64a0973be30092c691250138a272061c58527087f', 'Khobert', 'Linchangco','khobert_linchangco@dlsu.edu.ph'), -- khob
            ('ajctan','a5a28cfe2786537d28d4f57d4a15fe5813a973d3d6f9b9186033b8df50fac56b', 'Aron', 'Tan', 'arontan@yahoo.com'); -- aron
            
INSERT INTO `shops`(`shop_name`,`description`) 
 	VALUES	('Book Cabin','Antique Books FTW'),
 			('Vanguard Galleria', 'Complete! Current! Awesome!'),
            ('The Pipeline','All you geeky necessities!'),
            ('Kitty Cat Chasers','A 18 year old girls collection of yarn');
            
INSERT INTO `user_shops`
 	VALUES	(4,1),
			(5,2),
            (2,3),
			(1,4);
            
INSERT INTO `products`(`seller`,`title`,`price`,`description`, `state`,`p_type`) 
	VALUES	(3, 'PSVita', 10000.00, 'PSVita phat, slight scratches, comes with a game(freedom wars)', 1, 8),
			(5, 'God of War collection', 600.00, 'PSVita game', 1, 14),
			(1, 'Craft Yarn Multi-function Knitting Board Knit & Weave Loom Kit DIY Tool Set', 1700.00, '', 1, 7),
			(4, 'Complete Collection of Harry Potter Books', 2500.00, 'Used only for a few times', 1, 5),
			(4, 'The Hunger Games Trilogy Boxset', 1500.00, 'Hard Cover box set', 1,5),
			(4, 'The Maze Runner series', 2500.00, 'Hard Cover box set', 1,5),
			(4, 'The Fault in our Stars', 600.00, 'Hard Cover book', 1,5),
			(4, 'Percy Jackson and the Olympians 5 Book Paperback Boxed Set ', 2300.00, 'Hard Cover books (The Lightning Thief, The Sea of Monsters, The Titans Curse, The Battle of the Labyrinth, and The Last Olympian)', 1,5),
			(4, 'Fifty Shades Trilogy', 3000.00, 'Hard Cover book set (Fifty Shades of Grey / Fifty Shades Darker / Fifty Shades Freed)', 1,5),
			(5, 'GBT14  Divine Dragon Apocrypha 1',2400.00,'Unopened and sealed', 1, 14),
			(5, 'GBT14  Divine Dragon Apocrypha 2',2400.00,'Unopened and sealed', 1, 14),
			(5, 'GBT14  Divine Dragon Apocrypha 3',2400.00,'Unopened and sealed', 1, 14),
			(5, 'GBT13  Ultimate Stride 1',2400.00,'Unopened and sealed', 1, 14),
			(5, 'GBT13  Ultimate Stride 2',2400.00,'Unopened and sealed', 1, 14),
			(5, 'GCB07  Divas Festa 1',2400.00,'Unopened and sealed', 1, 14),
			(5, 'GBT13  Divas Festa 2',2400.00,'Unopened and sealed', 1, 14),
			(7, 'Standard Size Mashiro sleeves', 1000.00, 'Mashiro from Mikakunun de shinkokei', 1, 1),
			(8, 'Vanguard Deletor mat', 500.00, 'used few times', 1, 1),
			(7, 'Card Binder with vanguard cards', 500.00, '',1, 1),
			(5, 'Vanguard Dimensional Robo deck', 4000.00, 'Comes with sleeves and deckbox', 1, 14),
			(2, 'Black Leather couch', 6000.00, '', 1, 9),
			(7, 'Onesimus Barong Tagalog', 1500.00, 'Used only twice', 1, 6),
			(6, 'Dog toys and treats', 1500.00, 'Treats come in beef, chicken, and pork flavors', 1, 12),
			(6, 'Adidas Originals Superstar Foundation', 5000.00, 'Unisex', 1,13),
			(6, 'Lenovo IdeaPad 320-14AST AMD A6-9220 - Platinum Grey', 19500.00,' 14-inch notebook powered by AMD A6-9220 Dual-core processor wih 1MB of cache, with AMD Radeon 530, equipped with 64-bit Windows 10 Operating System. It runs at 2.5GHz with 4GB of RAM and 2133MHz of RAM speed. It features HD display with 1366 x 768 pixel resolution. Weighing in at 2.1kg, the notebook features a Hard Disk Drive with 500GB of storage. It is 338.3 x 249.9 x 22.7 mm. Ports include 1x USB 2.0; 1 x USB 2.0; 3.5mm combo audio jack; 1 x HDMI; 1 x RJ-45; and memory card reader.', 1, 8);
            