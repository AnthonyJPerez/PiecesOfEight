

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
	
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




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
	UNIQUE KEY fk_tag_name(name)
	
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




#-- Product
#--
#-- Represents a Product in the database
CREATE TABLE p8_product
(
	#-- Key
	id						INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	
	#-- Attributes
	name					VARCHAR(255) NOT NULL,						#-- Product name
	quantity				INTEGER UNSIGNED NOT NULL,					#-- Quantity in stock
	price					DECIMAL(6,2) NOT NULL,						#-- Price per item
	date_inserted			DATETIME NOT NULL,							#-- Date product was listed
	p8_category_id			INTEGER UNSIGNED NOT NULL,					#-- Product belongs to one Category
	
	#-- Constraints
	PRIMARY KEY (id),
	UNIQUE KEY fk_product_name (name),
	FOREIGN KEY (p8_category_id) REFERENCES p8_category(id)
	
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



#-- Tags_Products
#--
#-- Tags HABTM Products.  Products can have multiple tags (sale, etc..) and 
#-- Tags can be applied to multiple products (multiple products on sale, etc..).
CREATE TABLE p8_tags_products
(
	#-- Key
	p8_tag_id				INTEGER UNSIGNED NOT NULL,
	p8_product_id			INTEGER UNSIGNED NOT NULL,
	
	#-- Attributes
	
	#-- Constraints
	PRIMARY KEY (p8_tag_id, p8_product_id),
	FOREIGN KEY (p8_tag_id) REFERENCES p8_tag(id),
	FOREIGN KEY (p8_product_id) REFERENCES p8_product(id)
	
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


#----------------------------------------------------------------------------------------------
#-- INSERT DATA
#----------------------------------------------------------------------------------------------


INSERT INTO p8_category (name)
VALUES
	("accessories"),
	("blouses"),
	("capes"),
	("doats"),
	("dresses"),
	("miscellaneous"),
	("pants"),
	("skirts"),
	("tabbards"),
	("vests");
	
	
INSERT INTO p8_tag (name)
VALUES
	("sale");


	
COMMIT;