DROP SCHEMA IF EXISTS craftcourt_db;
CREATE SCHEMA craftcourt_db; 
USE craftcourt_db;

-- ==============================================================
-- Creating tables...
-- ==============================================================

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
        REFERENCES users(id),
        
    CONSTRAINT shop
		FOREIGN KEY (s_id) 
        REFERENCES shops(s_id)
);

CREATE table products(
	p_id INT AUTO_INCREMENT NOT NULL,
    seller INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    price decimal(8,2) NOT NULL,
    description VARCHAR(250) NULL,
    p_type INT NOT NULL,
    
    CONSTRAINT provider
		FOREIGN KEY (seller)
        REFERENCES shops(s_id),
    
    PRIMARY KEY (p_id)
);

CREATE table listing(
	l_id INT AUTO_INCREMENT NOT NULL,
    listdate DATE NOT NULL,
    p_id INT NOT NULL,
    quantity INT NOT NULL,
    
    CONSTRAINT product
		FOREIGN KEY (p_id)
        REFERENCES products(p_id),
        
    PRIMARY KEY (l_id)
);

CREATE table p_status(
	st_id INT,
    status_txt TEXT
);

CREATE table p_type(
	t_id INT,
    type_txt TEXT
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
	VALUES	(1,'Selling'),
			(2,'Sold');
    
INSERT INTO `users`(`uname`,`pcode`,`firstname`,`lastname`,`email`) 
	VALUES	('1_admin','01_admin', 'Jan', 'Lagayan','alylagayan@gmail.com'),
			('rossmendez','hOSANNA', 'Ross', 'Mendez','rossmendez@gmail.com'),
            ('doktoraBello','uyBESH', 'Vicki', 'Bello','bello_phd@gmail.com'),
            ('cass_ce','bebebebe', 'Cassandra', 'Matias','c_matias@yahoo.com'),
            ('ag5598', 'gomez123', 'Arlan', 'Gomez','arlanross@gmail.com'),
            ('aric','aric123', 'Aric', 'Brillantes','aricbrillantes@gmail.com'),
            ('ajctan','aron', 'Aron', 'Tan', 'arontan@yahoo.com');
            
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
            
INSERT INTO `products`(`seller`,`title`,`price`,`description`,`p_type`) 
	VALUES	(3, 'PSVita', 10000.00, 'PSVita phat, slight scratches, comes with a game(freedom wars)',8),
			(2, 'Vanguard Deletor mat', 500.00, 'used few times', 1),
            (3, 'God of War collection', 600.00, 'PSVita game',14),
			(2, 'Vanguard Dimensional Robo deck', 4000.00, 'Comes with sleeves and deckbox',14);