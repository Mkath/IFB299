CREATE DATABASE  IF NOT EXISTS `Property_Management`;
USE `Property_Management`;


CREATE TABLE `property_details` (
	`propertyid` int NOT NULL AUTO_INCREMENT,
	`tenantid`  int,
	`street_address` VARCHAR(50) NOT NULL,
	`suburb` VARCHAR(50) NOT NULL,
	`number_rooms` int NOT NULL,
	`property_type` VARCHAR(20) NOT NULL,
	`furnished` boolean Not null,
	`number_bathrooms` int NOT NULL,
	`description` VARCHAR(250) NOT NULL,
	`rent_amt` int NOT NULL,
	`gumtree_url` varchar(150),
	`inspection_time1` varchar(50) NOT NULL,	
	`inspection_time2` varchar(50) NOT NULL,	
	`posted` boolean NOT NULL,	
  PRIMARY KEY (`propertyid`)
) charset utf8;




CREATE TABLE `property_images` (
	`imageid` int NOT NULL AUTO_INCREMENT,	
	`propertyid` int NOT NULL,
	`image_path` varchar(50) NOT NULL,
  PRIMARY KEY (`imageid`),
FOREIGN KEY (propertyid) REFERENCES property_details(propertyid)
);


CREATE TABLE `tenant_details` (
	`tenantid` int NOT NULL AUTO_INCREMENT,	
	`propertyid` int,
	`tenant_firstname` varchar(50) NOT NULL,
	`tenant_lastname` varchar(50) NOT NULL,	
	`tenant_dob` date NOT NULL,
	`tenant_phone` varchar(50) NOT NULL,
	`tenant_email` varchar(50) NOT NULL,
	`tenant_postal` Int NOT NULL,
	`tenant_username` varchar(50) NOT NULL,
	`tenant_password` varchar(50) NOT NULL,	
  PRIMARY KEY (`tenantid`),
FOREIGN KEY (propertyid) REFERENCES property_details(propertyid)
);


CREATE TABLE `tenant_favourites` (
	`tenantid` int NOT NULL,	
	`propertyid` int NOT NULL,
  PRIMARY KEY (tenantid, propertyid),
FOREIGN KEY (propertyid) REFERENCES property_details(propertyid),
FOREIGN KEY (tenantid) REFERENCES tenant_details(tenantid)
);


CREATE TABLE `tenant_registration` (
	`tenantid` int NOT NULL,	
	`propertyid` int NOT NULL,
	`time` varchar(50) NOT NULL,
	`review` varchar(100),
	PRIMARY KEY (tenantid, propertyid, time),
FOREIGN KEY (propertyid) REFERENCES property_details(propertyid),
FOREIGN KEY (tenantid) REFERENCES tenant_details(tenantid)
);

CREATE TABLE `contract_details` (
	`contractid` int NOT NULL AUTO_INCREMENT, 
	`propertyid` int NOT NULL,
	`tenantid`  int,
	`ownerid`  int,
	`contract_length` varchar(50) NOT NULL,
	`contract_conditions`  varchar (200),
	`contract_expiry` date NOT NULL,
PRIMARY KEY (contractid, propertyid), 
FOREIGN KEY (propertyid) REFERENCES property_details(propertyid),
FOREIGN KEY (tenantid) REFERENCES tenant_details(tenantid)
);


CREATE TABLE `propertyowner_details` (
	`propertyownerid` int NOT NULL AUTO_INCREMENT,	
	`propertyowner_firstname` varchar(50) NOT NULL,
	`propertyowner_lastname` varchar(50) NOT NULL,	
	`propertyowner_dob` date NOT NULL,
	`propertyowner_phone` varchar(50) NOT NULL,
	`propertyowner_email` varchar(50) NOT NULL,
	`propertyowner_postal` Int NOT NULL,
	`propertyowner_username` varchar(50) NOT NULL,
	`propertyowner_password` varchar(50) NOT NULL,	
  PRIMARY KEY (`propertyownerid`)
);

CREATE TABLE `employee_details` (
	`employeeid` int NOT NULL AUTO_INCREMENT,	
	`employee_firstname` varchar(50) NOT NULL,
	`employee_lastname` varchar(50) NOT NULL,	
	`employee_dob` date NOT NULL,
	`employee_phone` varchar(50) NOT NULL,
	`employee_email` varchar(50) NOT NULL,
	`employee_postal` Int NOT NULL,
	`employee_username` varchar(50) NOT NULL,
	`employee_password` varchar(50) NOT NULL,
	`employee_admin` BOOLEAN NOT NULL Default 0,	
  PRIMARY KEY (`employeeid`)
);

CREATE TABLE `employee_property` (
	`employeeid` int NOT NULL,	
	`propertyid` int NOT NULL,
	PRIMARY KEY (employeeid, propertyid),
FOREIGN KEY (propertyid) REFERENCES property_details(propertyid),
FOREIGN KEY (employeeid) REFERENCES employee_details(employeeid)
);




CREATE TABLE `propertyowner_property` (
	`propertyownerid` int NOT NULL,	
	`propertyid` int NOT NULL,
  PRIMARY KEY (propertyownerid, propertyid),
FOREIGN KEY (propertyid) REFERENCES property_details(propertyid),
FOREIGN KEY (propertyownerid) REFERENCES propertyowner_details(propertyownerid)
);


insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('123 Smith Street','Taringa',3,'unit',FALSE,1,'This house is a test, It features a number of different features.',320,'http://www.gumtree.com.au/s-ad/beaumaris/flatshare-houseshare/large-beach-side-house-king-bed-ensuite-pool-view-transport-/1085277833','15 September 2015 12:00 - 12:15','16 September 2015 12:15 - 12:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('123 Fred Street','South Brisbane',2,'house',FALSE,1,'This house is a second test, It features a number of different features.',453,'http://www.gumtree.com.au/s-ad/penshurst/flatshare-houseshare/double-room-for-rent-in-quiet-street-close-to-station/1084216095','17 September 2015 1:00 - 1:15','18 September 2015 1:15 - 1:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('222 Smith Street','Taringa',2,'unit',FALSE,1,'This house is a test1, It features a number of different features.',200,null,'16 September 2015 12:15 - 12:30','17 September 2015 12:15 - 12:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('111 Beatrice Street','Taringa',1,'unit',FALSE,2,'This house is a test2, It features a number of different features.',100,null,'17 September 2015 12:15 - 12:30','21 September 2015 12:15 - 12:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('112 Beatrice Street','Taringa',2,'house',TRUE,3,'This house is a test3, It features a number of different features. ',200,null,'18 September 2015 12:15 - 12:30','21 September 2015 12:15 - 12:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('113 Beatrice Street','Taringa',3,'house',TRUE,3,'This house is a test1, It features a number of different features.',300,null,'19 September 2015 12:15 - 12:30','24 September 2015 12:15 - 12:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('114 Beatrice Street','Taringa',4,'house',FALSE,3,'This house is a test2, It features a number of different features.',300,null,'20 September 2015 12:15 - 12:30','25 September 2015 12:15 - 12:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('115 Beatrice Street','Taringa',5,'apartment',FALSE,3,'This house is a test3, It features a number of different features. ',300,null,'21 September 2015 12:15 - 12:30','26 September 2015 12:15 - 12:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('116 Beatrice Street','Taringa',6,'apartment',TRUE,3,'This house is a test1, It features a number of different features.',300,null,'22 September 2015 12:15 - 12:30','27 September 2015 12:15 - 12:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('117 Beatrice Street','Taringa',7,'apartment',TRUE,1,'This house is a test2, It features a number of different features.',300,null,'23 September 2015 12:15 - 12:30','28 September 2015 12:15 - 12:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('118 Beatrice Street','Taringa',8,'unit',FALSE,1,'This house is a test3, It features a number of different features. ',299,null,'24 September 2015 12:15 - 12:30','29 September 2015 12:15 - 12:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('119 Beatrice Street','Taringa',9,'unit',FALSE,1,'This house is a test1, It features a number of different features.',150,null,'25 September 2015 12:15 - 12:30','30 September 2015 12:15 - 12:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('120 Beatrice Street','Taringa',10,'house',TRUE,1,'This house is a test2, It features a number of different features.',151,null,'26 September 2015 12:15 - 12:30','1 September 2015 12:15 - 12:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('121 Beatrice Street','Taringa',4,'house',TRUE,1,'This house is a test3, It features a number of different features. ',152,null,'27 September 2015 12:15 - 12:30','2 September 2015 12:15 - 12:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('122 Beatrice Street','Taringa',4,'house',FALSE,1,'This house is a test1, It features a number of different features.',153,null,'28 September 2015 12:15 - 12:30','3 September 2015 12:15 - 12:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('123 Beatrice Street','Taringa',4,'apartment',FALSE,1,'This house is a test2, It features a number of different features.',154,null,'29 September 2015 12:15 - 12:30','4 September 2015 12:15 - 12:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('124 Beatrice Street','Taringa',3,'apartment',TRUE,4,'This house is a test3, It features a number of different features. ',155,null,'30 September 2015 12:15 - 12:30','5 September 2015 12:15 - 12:30',TRUE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('125 Beatrice Street','Taringa',3,'apartment',TRUE,4,'This house is a test1, It features a number of different features.',156,null,'1 September 2015 12:15 - 12:30','6 September 2015 12:15 - 12:30',TRUE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('126 Beatrice Street','Taringa',3,'unit',FALSE,4,'This house is a test2, It features a number of different features.',157,null,'2 September 2015 12:15 - 12:30','20 September 2015 12:15 - 12:30',TRUE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('127 Beatrice Street','Taringa',2,'unit',FALSE,5,'This house is a test3, It features a number of different features. ',158,null,'3 September 2015 12:15 - 12:30','21 September 2015 12:15 - 12:30',TRUE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('128 Beatrice Street','Taringa',2,'house',TRUE,5,'This house is a test1, It features a number of different features.',159,null,'4 September 2015 12:15 - 12:30','20 September 2015 12:15 - 12:30',TRUE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('129 Beatrice Street','Taringa',1,'house',TRUE,5,'This house is a test2, It features a number of different features.',160,null,'5 September 2015 12:15 - 12:30','21 September 2015 12:15 - 12:30',TRUE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('130 Beatrice Street','Taringa',1,'house',FALSE,5,'This house is a test3, It features a number of different features. ',161,null,'6 September 2015 12:15 - 12:30','5 September 2015 12:15 - 12:30',TRUE);




insert into property_images (propertyid, image_decription, image_path) values ('1', 'Bedroom','bed1.jpg');
insert into property_images (propertyid, image_decription, image_path) values ('1', 'kitchen','kit1.jpg');
insert into property_images (propertyid, image_decription, image_path) values ('1', 'bathroom','bath1.jpg');
insert into property_images (propertyid, image_decription, image_path) values ('1', 'livingroom','bath2.jpg');
insert into property_images (propertyid, image_decription, image_path) values ('2', 'outside','room3.jpg');
insert into property_images (propertyid, image_decription, image_path) values ('2', 'livingroom','room1.jpg');
insert into property_images (propertyid, image_decription, image_path) values ('2', 'livingroom2','room4.jpg');

insert into tenant_details (tenant_firstname, tenant_lastname, tenant_dob, tenant_phone, tenant_email, tenant_postal, tenant_username, tenant_password)  values ('Mike','Kath','1982-10-15','040499999','Chainber@hotmail.com','4068','mkath','pass123');

insert into contract_details (propertyid, tenantid, contract_conditions, contract_length, contract_expiry) 
values (1, 1, 'Testing contract conditions for property1 test1', '12 Months', '6/11/16');

insert into employee_details (employee_firstname, employee_lastname, employee_dob, employee_phone, employee_email, employee_postal, employee_username, employee_password)  values ('Sam','Gamgee','1970-02-15','040526608','gamgee@hotmail.com','4122','sgamgee','testing1');

insert into propertyowner_details (propertyowner_firstname, propertyowner_lastname, propertyowner_dob, propertyowner_phone, propertyowner_email, propertyowner_postal, propertyowner_username, propertyowner_password)  values ('Frodo','Baggins','1980-01-01','0423612786','baggins@hotmail.com','4122','fbaggins','testing1');

insert into employee_details (employee_firstname, employee_lastname, employee_dob, employee_phone, employee_email, employee_postal, employee_username, employee_password, employee_admin)  values ('Admin','Gamgee','1970-02-15','040526608','gamgee@hotmail.com','4122','admin','testing1', TRUE);
