CREATE TABLE vendors(
  id int NOT NULL AUTO_INCREMENT,
  vendor_name varchar(100) NOT NULL,
  descriptions text,
  comments text,
  status_id int NOT NULL DEFAULT 1,
  generated_id varchar(80) NOT NULL UNIQUE DEFAULT '0',
  created_by int NOT NULL DEFAULT 0,
  modified_by int NOT NULL DEFAULT 0,
  date_created date NOT NULL,
  time_created time NOT NULL,
  updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  deleted_status INT NOT NULL DEFAULT 0,
  deleted_by INT NOT NULL DEFAULT 0,
  PRIMARY KEY(id)
);


CREATE TABLE sales_group(
  id int NOT NULL AUTO_INCREMENT,
  vendor_id int NOT NULL DEFAULT 0,
  group_name varchar(100) NOT NULL,
  comments text,
  status_id int NOT NULL DEFAULT 1,
  generated_id varchar(80) NOT NULL UNIQUE DEFAULT '0',
  created_by int NOT NULL DEFAULT 0,
  modified_by int NOT NULL DEFAULT 0,
  date_created date NOT NULL,
  time_created time NOT NULL,
  updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  deleted_status INT NOT NULL DEFAULT 0,
  deleted_by INT NOT NULL DEFAULT 0,  
  PRIMARY KEY(id),
  FOREIGN KEY(vendor_id) REFERENCES vendors(id)
);

CREATE TABLE sales_items(
  id int NOT NULL AUTO_INCREMENT,
  group_id int NOT NULL DEFAULT 0,
  item_name varchar(100) NOT NULL,
  unit_price decimal(10, 2) not null DEFAULT 0.0,
  descriptions text,
  status_id int NOT NULL DEFAULT 1,
  generated_id varchar(80) NOT NULL UNIQUE DEFAULT '0',
  created_by int NOT NULL DEFAULT 0,
  modified_by int NOT NULL DEFAULT 0,
  date_created date NOT NULL,
  time_created time NOT NULL,
  updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  deleted_status INT NOT NULL DEFAULT 0,
  deleted_by INT NOT NULL DEFAULT 0,
  PRIMARY KEY(id)
);

CREATE TABLE sales_records(
  id int NOT NULL AUTO_INCREMENT,
  item_id INT NOT NULL,
  qty INT NOT NULL,
  unit_price decimal(10, 2) not null DEFAULT 0.0,
  amount decimal(10, 2) not null DEFAULT 0.0,
  payment_type varchar(80) NOT NULL,
  customer_id int NOT NULL DEFAULT 0,
  soldTo varchar(100) NOT NULL,
  invoice_number varchar(100) NOT NULL,
  status_id int NOT NULL DEFAULT 1,
  generated_id varchar(80) NOT NULL UNIQUE DEFAULT '0',
  created_by int NOT NULL DEFAULT 0,
  modified_by int NOT NULL DEFAULT 0,
  date_created date NOT NULL,
  time_created time NOT NULL,
  updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  deleted_status INT NOT NULL DEFAULT 0,
  deleted_by INT NOT NULL DEFAULT 0,
  PRIMARY KEY(id)
);

CREATE TABLE sales_records_2(
  id int NOT NULL AUTO_INCREMENT,
  item_id INT NOT NULL,
  qty INT NOT NULL DEFAULT 0,
  unit_price decimal(10, 2) not null DEFAULT 0.0,
  amount decimal(10, 2) not null DEFAULT 0.0,
  payment_type varchar(80) NOT NULL,
  customer_id int NOT NULL DEFAULT 0,
  soldTo varchar(100) NOT NULL,
  invoice_number varchar(100) NOT NULL,
  status_id int NOT NULL DEFAULT 1,
  generated_id varchar(80) NOT NULL UNIQUE DEFAULT '0',
  created_by int NOT NULL DEFAULT 0,
  modified_by int NOT NULL DEFAULT 0,
  date_created date NOT NULL,
  time_created time NOT NULL,
  updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  deleted_status INT NOT NULL DEFAULT 0,
  deleted_by INT NOT NULL DEFAULT 0,
  PRIMARY KEY(id)
);

CREATE TABLE sales_invoices(
  id int NOT NULL AUTO_INCREMENT,
  invoice_number varchar(100) NOT NULL,
  total_amount decimal(10, 2) not null DEFAULT 0.0,
  customer_id int NOT NULL DEFAULT 0,
  soldTo varchar(100) NOT NULL,
  status_id int NOT NULL DEFAULT 1,
  generated_id varchar(80) NOT NULL UNIQUE DEFAULT '0',
  created_by int NOT NULL DEFAULT 0,
  modified_by int NOT NULL DEFAULT 0,
  date_created date NOT NULL,
  time_created time NOT NULL,
  updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  deleted_status INT NOT NULL DEFAULT 0,
  deleted_by INT NOT NULL DEFAULT 0,
  PRIMARY KEY(id)
);

DROP VIEW `vw_sales_record`;

CREATE VIEW vw_sales_record AS 
SELECT max(t1.id) as id, t1.invoice_number, max(t1.soldTo) as soldTo,
 max(t1.payment_type) as payment_type, max(t3.lastname) as attendant, sum(t1.amount) as totalPrice,
 max(t4.lastname) as customerName, max(t1.date_created) as date_created, max(t1.time_created) 
 as time_created FROM sales_records as t1 
inner join sales_items as t2 on t2.id = t1.item_id 
left join admin_record as t3 on t3.id = t1.created_by
left join user_record as t4 on t4.id = t1.customer_id group by t1.invoice_number
