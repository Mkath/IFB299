
CREATE DATABASE  IF NOT EXISTS `Property_Management` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `Property_Management`;


CREATE TABLE `property_details` (
	`propertyid` int NOT NULL AUTO_INCREMENT,
	`employeeid` int,
	`tenantid`  int,
	`ownerid`  int,
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
	`image_decription` varchar(20) NOT NULL,
	`image_path` varchar(50) NOT NULL,
  PRIMARY KEY (`imageid`),
FOREIGN KEY (propertyid) REFERENCES property_details(propertyid)
);

insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('123 Smith Street','Taringa',3,'unit',FALSE,1,'This house is a test, It features a number of different features.',320,'http://www.gumtree.com.au/s-ad/beaumaris/flatshare-houseshare/large-beach-side-house-king-bed-ensuite-pool-view-transport-/1085277833','15 September 2015 12:00 - 12:15','16 September 2015 12:15 - 12:30',FALSE);
insert into property_details (street_address,suburb,number_rooms,property_type,furnished,number_bathrooms,description,rent_amt,gumtree_url,inspection_time1,inspection_time2,posted)  values('123 Fred Street','South Brisbane',2,'house',FALSE,1,'This house is a second test, It features a number of different features.',453,'http://www.gumtree.com.au/s-ad/penshurst/flatshare-houseshare/double-room-for-rent-in-quiet-street-close-to-station/1084216095','17 September 2015 1:00 - 1:15','18 September 2015 1:15 - 1:30',FALSE);

insert into property_images (propertyid, image_decription, image_path) values ('1', 'Bedroom','bed1.jpg');
insert into property_images (propertyid, image_decription, image_path) values ('1', 'kitchen','kit1.jpg');
insert into property_images (propertyid, image_decription, image_path) values ('1', 'bathroom','bath1.jpg');
insert into property_images (propertyid, image_decription, image_path) values ('1', 'livingroom','bath2.jpg');
insert into property_images (propertyid, image_decription, image_path) values ('2', 'outside','room3.jpg');
insert into property_images (propertyid, image_decription, image_path) values ('2', 'livingroom','room1.jpg');
insert into property_images (propertyid, image_decription, image_path) values ('2', 'livingroom2','room4.jpg');



