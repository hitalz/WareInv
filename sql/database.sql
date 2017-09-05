-- Create inventory database.
CREATE DATABASE inventory;

-- Select inventory database.
USE inventory;

-- Creat user table.
CREATE TABLE user (
  user_id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHHAR(50) NOT NULL,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL
);

-- Create state table.
CREATE TABLE state (
  state_id SMALLINT(5) unsigned NOT NULL AUTO_INCREMENT,
  state_name VARCHAR(32) NOT NULL,
  state_abbr VARCHAR(8) NOT NULL,
  PRIMARY KEY (state_id)
);

-- Insert values into state table.
INSERT INTO state VALUES
  (NULL, 'Alabama', 'AL'),
  (NULL, 'Alaska', 'AK'),
  (NULL, 'Arizona', 'AZ'),
  (NULL, 'Arkansas', 'AR'),
  (NULL, 'California', 'CA'),
  (NULL, 'Colorado', 'CO'),
  (NULL, 'Connecticut', 'CT'),
  (NULL, 'Delaware', 'DE'),
  (NULL, 'District of Columbia', 'DC'),
  (NULL, 'Florida', 'FL'),
  (NULL, 'Georgia', 'GA'),
  (NULL, 'Hawaii', 'HI'),
  (NULL, 'Idaho', 'ID'),
  (NULL, 'Illinois', 'IL'),
  (NULL, 'Indiana', 'IN'),
  (NULL, 'Iowa', 'IA'),
  (NULL, 'Kansas', 'KS'),
  (NULL, 'Kentucky', 'KY'),
  (NULL, 'Louisiana', 'LA'),
  (NULL, 'Maine', 'ME'),
  (NULL, 'Maryland', 'MD'),
  (NULL, 'Massachusetts', 'MA'),
  (NULL, 'Michigan', 'MI'),
  (NULL, 'Minnesota', 'MN'),
  (NULL, 'Mississippi', 'MS'),
  (NULL, 'Missouri', 'MO'),
  (NULL, 'Montana', 'MT'),
  (NULL, 'Nebraska', 'NE'),
  (NULL, 'Nevada', 'NV'),
  (NULL, 'New Hampshire', 'NH'),
  (NULL, 'New Jersey', 'NJ'),
  (NULL, 'New Mexico', 'NM'),
  (NULL, 'New York', 'NY'),
  (NULL, 'North Carolina', 'NC'),
  (NULL, 'North Dakota', 'ND'),
  (NULL, 'Ohio', 'OH'),
  (NULL, 'Oklahoma', 'OK'),
  (NULL, 'Oregon', 'OR'),
  (NULL, 'Pennsylvania', 'PA'),
  (NULL, 'Rhode Island', 'RI'),
  (NULL, 'South Carolina', 'SC'),
  (NULL, 'South Dakota', 'SD'),
  (NULL, 'Tennessee', 'TN'),
  (NULL, 'Texas', 'TX'),
  (NULL, 'Utah', 'UT'),
  (NULL, 'Vermont', 'VT'),
  (NULL, 'Virginia', 'VA'),
  (NULL, 'Washington', 'WA'),
  (NULL, 'West Virginia', 'WV'),
  (NULL, 'Wisconsin', 'WI'),
  (NULL, 'Wyoming', 'WY');

-- Create country table.
CREATE TABLE country (
  country_id INT(11) NOT NULL AUTO_INCREMENT,
  country_name VARCHAR(80) NOT NULL,
  country_abbr VARCHAR(8) NOT NULL,
  PRIMARY KEY (country_id)
);
-- Insert value into country table.
INSERT INTO country VALUES
  (NULL, 'United States of America', 'USA');

-- Create carrier table.
CREATE TABLE carrier (
  carrier_id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  carrier_name VARCHAR(100) NOT NULL,
  carrier_address VARCHAR(100) NOT NULL,
  carrier_city VARCHAR(50) NOT NULL,
  state_id SMALLINT(5) unsigned NOT NULL,
  carrier_zip INT(10) unsigned NOT NULL,
  country_id INT(11) NOT NULL,
  PRIMARY KEY (carrier_id),
  FOREIGN KEY (state_id) REFERENCES state(state_id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (country_id) REFERENCES country(country_id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Create customer table.
CREATE TABLE customer (
  customer_id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  customer_name VARCHAR(100) NOT NULL,
  customer_address VARCHAR(100) NOT NULL,
  customer_city VARCHAR(50) NOT NULL,
  state_id SMALLINT(5) unsigned NOT NULL,
  carrier_zip INT(10) unsigned NOT NULL,
  country_id INT(11) NOT NULL,
  PRIMARY KEY (customer_id),
  FOREIGN KEY (state_id) REFERENCES state(state_id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (country_id) REFERENCES country(country_id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Create supplier table.
CREATE TABLE supplier (
  supplier_id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  supplier_name VARCHAR(100) NOT NULL,
  supplier_address VARCHAR(100) NOT NULL,
  supplier_city VARCHAR(50) NOT NULL,
  state_id SMALLINT(5) unsigned NOT NULL,
  supplier_zip INT(10) unsigned NOT NULL,
  country_id INT(11) NOT NULL,
  PRIMARY KEY (supplier_id),
  FOREIGN KEY (state_id) REFERENCES state(state_id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (country_id) REFERENCES country(country_id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Create package table.
CREATE TABLE package (
  package_id SMALLINT unsigned NOT NULL AUTO_INCREMENT,
  package_type VARCHAR(50) NOT NULL,
  PRIMARY KEY (package_id)
);
-- Insert data into package table.
INSERT INTO package VALUES
  (NULL, 'Box'),
  (NULL, 'Envelope'),
  (NULL, 'Pallet');

-- Create refrence table.
CREATE TABLE reference (
  reference_id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  customer_id INT(11) unsigned NOT NULL,
  supplier_id INT(11) unsigned NOT NULL,
  arrival_date DATE NOT NULL,
  arrival_time TIME NOT NULL,
  carrier_id INT(11) unsigned NOT NULL,
  purchase_order VARCHAR(20) NOT NULL,
  tracking_number INT(20) unsigned NOT NULL,
  package_quantity INT(2) unsigned NOT NULL,
  package_id SMALLINT(5) unsigned NOT NULL,
  description TEXT,
  PRIMARY KEY (reference_id),
  FOREIGN KEY (customer_id) REFERENCES customer(customer_id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (supplier_id) REFERENCES supplier(supplier_id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (carrier_id) REFERENCES carrier(carrier_id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (package_id) REFERENCES package(package_id) ON UPDATE CASCADE ON DELETE CASCADE
);
