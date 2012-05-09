

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
	
	#-- quantity				INTEGER UNSIGNED NOT NULL DEFAULT 0,			#-- Quantity in stock -- Removed for now, not really needed!
	price					DECIMAL(6,2) NOT NULL,						#-- Price per item
	date_inserted			DATETIME,						#-- Date product was listed
	description				TEXT,								#-- Description of the product
	category_id				INTEGER UNSIGNED NOT NULL,					#-- Product belongs to one Category
	size_chart				TEXT,						#-- Every product has exactly one size_chart associated with it.
	care_information			TEXT,						#-- Every product has care information
	default_image_id			INTEGER UNSIGNED DEFAULT NULL,		#-- Every product has a default image
	
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
	product_id				INTEGER UNSIGNED NOT NULL, 		#-- Image belongs to Product

	
	#-- Attributes
	url						VARCHAR(255) NOT NULL default "product-null_1.jpg",
	
	#-- Constraints
	PRIMARY KEY (id),
	#-- UNIQUE KEY uk_image_url(url), -- don't use this, for now. Not sure if it is necessary.
	FOREIGN KEY (product_id) REFERENCES p8_product(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE p8_product ADD FOREIGN KEY (default_image_id) REFERENCES p8_image(id) ON DELETE SET NULL;




#-- Gallery
#--
#-- Gallery Has Many Image. Gallery is a table that tracks images in the gallery/ folder.
#-- The purpose of the gallery table is to make it easier to upload and delete images inside
#-- the gallery. This table also lets us track the product an image belongs to.
CREATE TABLE p8_gallery
(
	#-- Key
	id				INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	
	#-- Attributes
	url				VARCHAR(255) NOT NULL default "product-null_1.jpg",
	product_id			INTEGER UNSIGNED NOT NULL,
	
	#-- Constraints
	PRIMARY KEY (id),
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



#-- Size
#--
#-- Represents a size of a Product. Can range from extra small to extra large.
#-- Each size has a 
CREATE TABLE p8_size
(
	#-- Key
	id				INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	
	#-- Attributes
	size				VARCHAR (255),
	
	#-- Constraints
	PRIMARY KEY (id)
	
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




#-- Product_Size
#--
#-- Products HABTM Sizes.  Products can support multiple sizes, such as
#-- Large, X-Large, Small, etc..  Each relationship is on a per-product basis,
#-- and thus each relationship describes how that size fits that particular product.
#-- For example, a Vest-Small may have different size chart than a Coat-Small.
CREATE TABLE p8_size_product
(
	#-- Key
	size_id			INTEGER UNSIGNED NOT NULL,
	product_id			INTEGER UNSIGNED NOT NULL,
	
	#-- Attributes
	
	#-- Constraints
	PRIMARY KEY (size_id, product_id),
	FOREIGN KEY (size_id) REFERENCES p8_size(id),
	FOREIGN KEY (product_id) REFERENCES p8_product(id)
	
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




#-- Promocode
#-- 
#-- Promotion codes 
CREATE TABLE p8_promocode
(
	#-- Key
	id			INTEGER UNSIGNED NOT NULL,
	
	#-- Attributes
	name			VARCHAR (255),  #-- Names will be like: REN12-FREESHIP or MAY12-10%OFF or DX712-82
	location		VARCHAR (255),  #-- Metadata. You can tag this code with a location to track who used it. 
							#-- Some codes may only be given out at certain events, etc..
	type			INTEGER UNSIGNED NOT NULL, #-- type of discount (freeshipping, % discount, $ discount, combo_order, etc..
	dollar_discount	DECIMAL (6, 2) DEFAULT NULL,
	percent_discount	DECIMAL (6, 2) DEFAULT NULL,
	
	
	#-- generic_data_a	INTEGER UNSIGNED DEFAULT NULL, #-- Can be used for anything, such as: ID of product or category, amount of dollars saved, % of discount, etc..
	
	#-- Constraints
	PRIMARY KEY (id)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




#-- Product_Promocode
#--
#-- Products HABTM Promocodes. Products can be assigned multiple promocodes, and promocodes
#-- can be assigned to multiple products
CREATE TABLE p8_product_promocode
(
	#-- KEY
	product_id		INTEGER UNSIGNED NOT NULL,
	promocode_id	INTEGER UNSIGNED NOT NULL,
	
	#-- Attributes
	
	#-- Constraints
	PRIMARY KEY (product_id, promocode_id),
	FOREIGN KEY (product_id) REFERENCES p8_product(id),
	FOREIGN KEY (promocode_id) REFERENCES p8_promocode(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;





#----------------------------------------------------------------------------------------------
#-- INSERT DATA
#----------------------------------------------------------------------------------------------


INSERT INTO p8_category (name)
VALUES
	("Accessories"),
	("Blouses"),
	("Capes"),
	("Coats"),
	("Dresses"),
	("Miscellaneous"),
	("Pants"),
	("Skirts"),
	("Shirts"),
	("Tabards"),
	("Vests");
	
	
INSERT INTO p8_tag (name)
VALUES
	("Sale"),
	("Out of Stock");
	
	
INSERT INTO p8_size (size)
VALUES
	("XS"),
	("S"),
	("M"),
	("L"),
	("XL");
	
	
	
	
	
	
	
#-- test data:
	
INSERT INTO p8_product(name, price, category_id, date_inserted, description)
VALUES
	("Men's Pirate / Renaissance Coat", 100.00, 9, NOW(), "This is a description of the Old Shirt. As per its name, this shirt is very old. Actual pirates used to wear this shirt, hence why it is being sold as an old pirate shirt. If you are looking for Authenticity, then this is a shirt for you. Quick, only one of these shirts remains in existence, so you better purchase it before someone else buys it first!<br/><br/>This shirt only comes in one color: white."),
	("New Shirt", 100.00, 9, NOW(), "This is a description of the Old Shirt. As per its name, this shirt is very old. Actual pirates used to wear this shirt, hence why it is being sold as an old pirate shirt. If you are looking for Authenticity, then this is a shirt for you. Quick, only one of these shirts remains in existence, so you better purchase it before someone else buys it first!<br/><br/>This shirt only comes in one color: white."),
	("Long Pants", 150.00, 7, NOW(), "This is a description of the Old Shirt. As per its name, this shirt is very old. Actual pirates used to wear this shirt, hence why it is being sold as an old pirate shirt. If you are looking for Authenticity, then this is a shirt for you. Quick, only one of these shirts remains in existence, so you better purchase it before someone else buys it first!<br/><br/>This shirt only comes in one color: white."),
	("Short Pants", 150.00, 7, NOW(), "This is a description of the Old Shirt. As per its name, this shirt is very old. Actual pirates used to wear this shirt, hence why it is being sold as an old pirate shirt. If you are looking for Authenticity, then this is a shirt for you. Quick, only one of these shirts remains in existence, so you better purchase it before someone else buys it first!<br/><br/>This shirt only comes in one color: white."),
	("Long Cape", 200.00, 3, NOW(), "This is a description of the Old Shirt. As per its name, this shirt is very old. Actual pirates used to wear this shirt, hence why it is being sold as an old pirate shirt. If you are looking for Authenticity, then this is a shirt for you. Quick, only one of these shirts remains in existence, so you better purchase it before someone else buys it first!<br/><br/>This shirt only comes in one color: white.");

	

	
COMMIT;