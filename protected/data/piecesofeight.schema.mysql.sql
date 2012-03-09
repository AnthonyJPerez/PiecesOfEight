

SET SQL_MODE="TRADITIONAL"; #-- TRADITIONAL
START TRANSACTION;


#----------------------------------------------------------------------------------------------
#-- SCHEMA
#----------------------------------------------------------------------------------------------


#-- Category
#--
#-- Represents a Category in the database
CREATE TABLE p8_category
(
	#-- Key
	id						INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	
	#-- Attributes
	name					VARCHAR(255) NOT NULL,
	
	#-- Constraints
	PRIMARY KEY (id),
	UNIQUE KEY fk_category_name(name)
	
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




#-- Tag
#--
#-- Represents a Tag in the database
CREATE TABLE p8_tag
(
	#-- Key
	id						INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	
	#-- Attributes
	name					VARCHAR(255) NOT NULL,
	
	#-- Constraints
	PRIMARY KEY (id),
	UNIQUE KEY uk_tag_name(name)
	
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




#-- Product
#--
#-- Represents a Product in the database
CREATE TABLE p8_product
(
	#-- Key
	id					INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	
	#-- Attributes
	name					VARCHAR(255) NOT NULL,						#-- Product name
	quantity				INTEGER UNSIGNED NOT NULL DEFAULT 0,			#-- Quantity in stock
	price					DECIMAL(6,2) NOT NULL,						#-- Price per item
	date_inserted			DATETIME,						#-- Date product was listed
	description				TEXT,								#-- Description of the product
	category_id			INTEGER UNSIGNED NOT NULL,					#-- Product belongs to one Category
	
	#-- Constraints
	PRIMARY KEY (id),
	UNIQUE KEY uk_product_name (name),
	FOREIGN KEY (category_id) REFERENCES p8_category(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




#-- Image
#--
#-- Represents an Image in the database
CREATE TABLE p8_image
(
	#-- Key
	id						INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	
	#-- Attributes
	url						VARCHAR(255) NOT NULL default "product-null_1.jpg",
	product_id				INTEGER UNSIGNED NOT NULL, #-- Image belongs to Product
	
	#-- Constraints
	PRIMARY KEY (id),
	#UNIQUE KEY uk_image_url(url),
	FOREIGN KEY (product_id) REFERENCES p8_product(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




#-- Tag_Product
#--
#-- Tags HABTM Products.  Products can have multiple tags (sale, etc..) and 
#-- Tags can be applied to multiple products (multiple products on sale, etc..).
CREATE TABLE p8_tag_product
(
	#-- Key
	tag_id				INTEGER UNSIGNED NOT NULL,
	product_id			INTEGER UNSIGNED NOT NULL,
	
	#-- Attributes
	
	#-- Constraints
	PRIMARY KEY (tag_id, product_id),
	FOREIGN KEY (tag_id) REFERENCES p8_tag(id),
	FOREIGN KEY (product_id) REFERENCES p8_product(id)
	
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






#----------------------------------------------------------------------------------------------
#-- INSERT DATA
#----------------------------------------------------------------------------------------------


INSERT INTO p8_category (name)
VALUES
	("accessories"),
	("blouses"),
	("capes"),
	("coats"),
	("dresses"),
	("miscellaneous"),
	("pants"),
	("skirts"),
	("shirts"),
	("tabbards"),
	("vests");
	
	
INSERT INTO p8_tag (name)
VALUES
	("sale");
	
	
INSERT INTO p8_product(name, price, category_id, date_inserted)
VALUES
	("Old Shirt", 100.00, 9, NOW()),
	("New Shirt", 100.00, 9, NOW()),
	("Long Pants", 150.00, 7, NOW()),
	("Short Pants", 150.00, 7, NOW()),
	("Long Cape", 200.00, 3, NOW());
	
	
INSERT INTO p8_image(url, product_id)
VALUES
	("product-1_1.jpg", 1),
	("product-1_2.jpg", 1),
	("product-1_3.jpg", 1),
	("product-1_4.jpg", 1),
	("product-1_5.jpg", 1),
	("product-1_6.jpg", 1),
	("product-1_7.jpg", 1),
	("product-1_8.jpg", 1),
	("product-1_9.jpg", 1),
	("product-1_10.jpg", 1),
	("product-2_1.jpg", 2),
	("product-2_2.jpg", 2),
	("product-2_3.jpg", 2),
	("product-2_4.jpg", 2),
	("product-2_5.jpg", 2),
	("product-2_6.jpg", 2),
	("product-2_7.jpg", 2),
	("product-2_8.jpg", 2),
	("product-2_9.jpg", 2),
	("product-null_1.jpg", 3),
	("product-null_1.jpg", 4),
	("product-null_1.jpg", 5);
	

	
COMMIT;