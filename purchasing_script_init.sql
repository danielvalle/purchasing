CREATE DATABASE dbpurchasing;

USE dbpurchasing;

CREATE TABLE agency
  (
      `id` int NOT NULL AUTO_INCREMENT, 
      `agency_name` varchar(50),
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id)
    );
    
CREATE TABLE department
  (
      `id` int NOT NULL AUTO_INCREMENT, 
      `department_name` varchar(50),
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id)
    );
    
CREATE TABLE designation
  (
      `id` int NOT NULL AUTO_INCREMENT, 
      `designation_name` varchar(50),
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id)
    );

CREATE TABLE unit
  (
      `id` int NOT NULL AUTO_INCREMENT, 
      `unit_name` varchar(50),
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id)
    );
    
CREATE TABLE section
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `section_name` varchar(50),
      `department_fk` int,
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id),
      FOREIGN KEY (department_fk) REFERENCES department(id)
    );

CREATE TABLE office
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `office_name` varchar(50),
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id)
    );
    
CREATE TABLE category
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `category_name` varchar(50),
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id)
    );
    
CREATE TABLE item
  (
      `id` int NOT NULL AUTO_INCREMENT, 
      `item_name` varchar(50),
      `item_description` varchar(255),
      `unit_cost` float,
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id)
    );
    
CREATE TABLE user
  (
      `id` int NOT NULL AUTO_INCREMENT, 
      `first_name` varchar(50), 
      `last_name` varchar(50),
      `middle_name` varchar(50),
      `sex` varchar(10),
      `suffix` varchar(50),
      `email` varchar(50),
      `birthday` date,
      `password` varchar(50),
      `agency_fk` int,
      `user_type` int,
      `designation_fk` int,
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
       PRIMARY KEY (id), 
       FOREIGN KEY (agency_fk) REFERENCES agency(id),
       FOREIGN KEY (designation_fk) REFERENCES designation(id)
    );
    
CREATE TABLE supplier
  (
      `id` int NOT NULL AUTO_INCREMENT, 
      `supplier_name` varchar(50),
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id)
    );
    
CREATE TABLE purchase_request
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `agency_fk` int,
      `department_fk` int,
      `section_fk` int,
      `pr_number` varchar(50),
      `pr_date` datetime,
      `sai_number` varchar(50),
      `sai_date` datetime,
      `purpose` varchar(255),
      `requested_by_fk` int,
      `approved_by_fk` int,
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id),
      FOREIGN KEY (agency_fk) REFERENCES agency(id),
      FOREIGN KEY (department_fk) REFERENCES department(id),
      FOREIGN KEY (section_fk) REFERENCES section(id),
      FOREIGN KEY (requested_by_fk) REFERENCES user(id),
      FOREIGN KEY (approved_by_fk) REFERENCES user(id)
    );

CREATE TABLE purchase_request_detail
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `purchase_request_fk` int,
      `quantity` float,
      `unit_of_issue_fk` int,
      `item_fk` int,
      `category_fk`int,
      `stock_no` varchar(50),
      `total_cost` float, 
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id),
      FOREIGN KEY (purchase_request_fk) REFERENCES purchase_request(id),
      FOREIGN KEY (item_fk) REFERENCES item(id),
      FOREIGN KEY (category_fk) REFERENCES category(id),
      FOREIGN KEY (unit_of_issue_fk) REFERENCES unit(id)
    );
    
CREATE TABLE request_for_quote
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `date` date,
      `supplier1_fk` int,
      `supplier2_fk` int,
      `supplier3_fk` int,
      `supplier4_fk` int,
      `supplier5_fk` int,
      `vat_nonvat_tin` varchar(50),
      `place_of_delivery` varchar(255),
      `within_no_of_days` float,
      `requestor_fk` int,
      `canvasser_fk` int,
      `pr_fk` int,
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY(id),
      FOREIGN KEY(supplier1_fk) REFERENCES supplier(id),
      FOREIGN KEY(supplier2_fk) REFERENCES supplier(id),
      FOREIGN KEY(supplier3_fk) REFERENCES supplier(id),
      FOREIGN KEY(supplier4_fk) REFERENCES supplier(id),
      FOREIGN KEY(supplier5_fk) REFERENCES supplier(id),
      FOREIGN KEY(requestor_fk) REFERENCES user(id),
      FOREIGN KEY(canvasser_fk) REFERENCES user(id),
      FOREIGN KEY(pr_fk) REFERENCES purchase_request(id)
    );

CREATE TABLE request_for_quote_detail
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `request_for_quote_fk` int,
      `quantity` float,
      `unit_fk` int,
      `item_fk` int,
      `total` float,
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY(id),
      FOREIGN KEY(request_for_quote_fk) REFERENCES request_for_quote(id),
      FOREIGN KEY(unit_fk) REFERENCES unit(id),
      FOREIGN KEY(item_fk) REFERENCES item(id)
    );

CREATE TABLE abstract_quotation
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `date` date,
      `supervising_admin_fk` int,
      `admin_officer_fk` int,
      `admin_officer_2_fk` int,
      `board_secretary_fk` int,
      `vpak_fk` int,
      `approve_fk` int,
      `pr_fk` int,
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY(id),
      FOREIGN KEY(supervising_admin_fk) REFERENCES user(id),
      FOREIGN KEY(admin_officer_fk) REFERENCES user(id),
      FOREIGN KEY(admin_officer_2_fk) REFERENCES user(id),
      FOREIGN KEY(board_secretary_fk) REFERENCES user(id),
      FOREIGN KEY(vpak_fk) REFERENCES user(id),
      FOREIGN KEY(approve_fk) REFERENCES user(id),
      FOREIGN KEY(pr_fk) REFERENCES purchase_request(id)
    );

CREATE TABLE abstract_quotation_detail
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `abstract_quotation_fk` int,
      `item_no` varchar(50),
      `unit_fk` int,
      `item_fk` int,
      `supplier1_amount` float,
      `supplier2_amount` float,
      `supplier3_amount` float,
      `supplier4_amount` float,
      `supplier5_amount` float,
      `quantity` float,
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY(id),
      FOREIGN KEY(abstract_quotation_fk) REFERENCES abstract_quotation(id),
      FOREIGN KEY(unit_fk) REFERENCES unit(id),
      FOREIGN KEY(item_fk) REFERENCES item(id)
    );


CREATE TABLE purchase_order
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `agency_fk` int,
      `po_no` varchar(50),
      `supplier_fk` int,
      `address` varchar(255),
      `tin` varchar(50),
      `date` date,
      `mode_of_procurement` varchar(50),
      `place_of_delivery` varchar(255),
      `date_of_delivery` date,
      `delivery_term` varchar(50),
      `payment_term` varchar(50),
      `total_amount` float,
      `authorized_official_fk` int,
      `alobs_bub_no` varchar(50),
      `amount` float,
      `pr_no_fk` int,
      `abstract_quotation_fk` int,
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY(id),
      FOREIGN KEY(agency_fk) REFERENCES agency(id),
      FOREIGN KEY(supplier_fk) REFERENCES supplier(id),
      FOREIGN KEY(authorized_official_fk) REFERENCES user(id),
      FOREIGN KEY(pr_no_fk) REFERENCES purchase_request(id),
      FOREIGN KEY(abstract_quotation_fk) REFERENCES abstract_quotation(id)
    );

CREATE TABLE purchase_order_detail
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `po_id_fk` int,
      `stock_no` varchar(50),
      `unit_fk` int,
      `item_fk` int,
      `category_fk` int,
      `quantity` float,
      `unit_cost` float,
      `amount` float,
      `is_active` bit,
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY(id),
      FOREIGN KEY(po_id_fk) REFERENCES purchase_order(id),
      FOREIGN KEY(unit_fk) REFERENCES unit(id),
      FOREIGN KEY(item_fk) REFERENCES item(id),
      FOREIGN KEY(category_fk) REFERENCES category(id)
    );

    