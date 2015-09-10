
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




/*		<table name="tenant_details" >
			<column name="tenantid" type="int" jt="4" mandatory="y" />
			<column name="propertyid" type="int" jt="4" />
			<column name="tenant_firstname" type="varchar" length="100" jt="12" mandatory="y" />
			<column name="tenant_dob" type="varchar" length="15" jt="12" />
			<column name="tenant_phone" type="int" jt="4" />
			<column name="tenant_email" type="varchar" length="200" jt="12" mandatory="y" />
			<column name="tenant_postal" type="varchar" length="200" jt="12" />
			<column name="tenant_lastname" type="varchar" length="100" jt="12" mandatory="y" />
			<column name="tenant_username" type="varchar" length="100" jt="12" mandatory="y" />
			<column name="tenant_password" type="varchar" length="100" jt="12" mandatory="y" />
			<index name="pk_tenant_details" unique="PRIMARY_KEY" >
				<column name="tenantid" />
			</index>
			<index name="idx_tenant_details" unique="UNIQUE" >
				<column name="propertyid" />
			</index>
			<index name="idx_tenant_username" unique="UNIQUE" >
				<column name="tenant_username" />
			</index>
			<fk name="fk_tenant_favourite" to_schema="ifb299" to_table="tenant_favourites" delete_action="cascade" >
				<fk_column name="tenantid" pk="tenantid" />
			</fk>
			<fk name="fk_tenant_registration" to_schema="ifb299" to_table="tenant_registration" delete_action="cascade" >
				<fk_column name="tenantid" pk="tenantid" />
			</fk>
*/

/*
<table name="tenant_favourites" >
			<column name="tenantid" type="int" jt="4" mandatory="y" />
			<column name="propertyid" type="int" jt="4" />
			<index name="pk_tenant_favourites" unique="UNIQUE" >
				<column name="tenantid" />
			</index>
			<index name="pk_tenant_favourites_0" unique="UNIQUE" >
				<column name="propertyid" />
			</index>
			<storage><![CDATA[engine=InnoDB]]></storage>
		</table>


		<table name="tenant_registration" >
			<column name="tenantid" type="int" jt="4" mandatory="y" />
			<column name="propertyid" type="int" jt="4" mandatory="y" />
			<index name="pk_tenant_registration" unique="UNIQUE" >
				<column name="tenantid" />
			</index>
			<index name="pk_tenant_registration_0" unique="UNIQUE" >
				<column name="propertyid" />
			</index>
			<storage><![CDATA[engine=InnoDB]]></storage>
		</table>
*/


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
	`inspection_time` varchar(50) NOT NULL,	
  PRIMARY KEY (tenantid, propertyid, inspection_time),
FOREIGN KEY (propertyid) REFERENCES property_details(propertyid),
FOREIGN KEY (tenantid) REFERENCES tenant_details(tenantid)
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

insert into tenant_details (tenant_firstname, tenant_lastname, tenant_dob, tenant_phone, tenant_email, tenant_postal, tenant_username, tenant_password)  values ('Mike','Kath','1982-10-15','040499999','Chainber@hotmail.com','4068','mkath','pass123');




