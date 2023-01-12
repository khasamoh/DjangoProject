create table tbl_user(
	user_id int(11) auto_increment primary key,
	fname varchar(50) not null,
	lname varchar(100),
	email varchar(100),
	phone varchar(50) not null,
	username varchar(50) not null,
	user_password varchar(100) not null,
	privilage varchar(50) not null);
	
create table tbl_product(
	PrID int(11) auto_increment primary key,
	PrName varchar(70) not null,
	Buyprice int(11) not null,
	Saleprice int(11) not null,
	Quantity int(11) not null,
	user_id int(11) not null,
	constraint fk1 foreign key(user_id) references tbl_user(user_id) on delete cascade on update cascade);
	
create table tbl_customer(
	CsID int(11) auto_increment primary key,
	fname varchar(50) not null,
	lname varchar(100),
	gender varchar(7),
	address varchar(50),
	phone varchar(50) not null);
	
create table tbl_sale(
	SaleID int(11) auto_increment primary key,
	PrID int(11) not null,
	CsID int(11) not null,
	SaleQuantity int(11) not null,
	Discount int(11) not null,
	payment varchar(5) not null,
	SaleDate date not null,
	constraint fk2 foreign key(PrID) references tbl_Product(PrID) on delete cascade on update cascade,
	constraint fk3 foreign key(CsID) references tbl_Customer(CsID) on delete cascade on update cascade);


INSERT INTO tbl_User VALUES('','Khamis','Mohd','khasamoh.12@gmail.com','0773274743','admin',MD5('12345'),'Administrator');
INSERT INTO tbl_Customer VALUES('','Temp','Temp','Temp','0773274743');

SELECT tbl_product.PrName,SUM(tbl_sale.SaleQuantity) AS QuantitySold,SUM(tbl_sale.Discount) AS TDiscount,tbl_product.Quantity AS Remain,(SUM(tbl_sale.SaleQuantity)*tbl_product.Saleprice) AS TotalAmount FROM tbl_product INNER JOIN tbl_sale USING(PrID) WHERE tbl_sale.SaleDate = CURRENT_DATE() GROUP BY tbl_product.PrName;
SELECT tbl_product.PrName,SUM(tbl_sale.SaleQuantity) AS QuantitySold,SUM(tbl_sale.Discount) AS TDiscount,tbl_product.Quantity AS Remain,(SUM(tbl_sale.SaleQuantity)*tbl_product.Saleprice) AS TotalAmount FROM tbl_product INNER JOIN tbl_sale USING(PrID) WHERE tbl_sale.SaleDate = CURRENT_DATE() GROUP BY tbl_product.PrName;
SELECT tbl_product.PrName,SUM(tbl_sale.SaleQuantity) AS QuantitySold,IF(tbl_sale.Discount != 1,SUM(tbl_sale.Discount),0)AS TDiscount,tbl_product.Quantity AS Remain,(SUM(tbl_sale.SaleQuantity)*tbl_product.Saleprice) AS TotalAmount FROM tbl_product INNER JOIN tbl_sale USING(PrID) WHERE tbl_sale.SaleDate = CURRENT_DATE() GROUP BY tbl_product.PrName