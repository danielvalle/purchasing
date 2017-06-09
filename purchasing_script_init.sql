CREATE TABLE agency
  (
      `id` int, 
      `agency_name` varchar(50),
      `is_active` bit,
      `created_at` date,
      `updated_at` date
      PRIMARY KEY (id)
    );
    
CREATE TABLE department
  (
      `id` int, 
      `department_name` varchar(50),
      `is_active` bit,
      `created_at` date,
      `updated_at` date
      PRIMARY KEY (id)
    );
    
CREATE TABLE designation
  (
      `id` int, 
      `designation_name` varchar(50),
      `is_active` bit,
      `created_at` date,
      `updated_at` date
      PRIMARY KEY (id)
    );

CREATE TABLE unit
  (
      `id` int, 
      `unit_name` varchar(50),
      `is_active` bit,
      `created_at` date,
      `updated_at` date
      PRIMARY KEY (id)
    );
    
CREATE TABLE section
    (
      `id` int,
      `section_name` varchar(50),
      `department_fk` int,
      `is_active` bit,
      `created_at` date,
      `updated_at` date
      PRIMARY KEY (id)
    );
    
CREATE TABLE category
    (
      `id` int,
      `category_name` varchar(50),
      `is_active` bit,
      `created_at` date,
      `updated_at` date
      PRIMARY KEY (id)
    );
    
CREATE TABLE item
  (
      `id` int, 
      `item_name` varchar(50),
      `unit_cost` float,
      `is_active` bit,
      `created_at` date,
      `updated_at` date
      PRIMARY KEY (id),
      FOREIGN KEY (unit_fk) REFERENCES unit(id) 
    );
    
CREATE TABLE user
  (
      `id` int, 
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
      `updated_at` date
       PRIMARY KEY (id), 
       FOREIGN KEY (agency_fk) REFERENCES agency(id),
       FOREIGN KEY (designation_fk) REFERENCES designation(id)
    );
    
CREATE TABLE supplier
  (
      `id` int, 
      `supplier_name` varchar(50),
      `is_active` bit,
      `created_at` date,
      `updated_at` date
      PRIMARY KEY (id)
    );
    
CREATE TABLE purchase_request
    (
      `id` int,
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
      `updated_at` date
      PRIMARY KEY (id),
      FOREIGN KEY (agency_fk) REFERENCES agency(id),
      FOREIGN KEY (department_fk) REFERENCES department(id),
      FOREIGN KEY (section_fk) REFERENCES section(id),
      FOREIGN KEY (requested_by_fk) REFERENCES user(id),
      FOREIGN KEY (approved_by_fk) REFERENCES user(id)
    );

CREATE TABLE purchase_request_detail
    (
      `id` int,
      `purchase_request_fk` int,
      `quantity` int,
      `unit_of_issue_fk` int,
      `item_fk` float,
      `category_fk` varchar(50),
      `stock_no` float,
      `total_cost` float, 
      `is_active` bit,
      `created_at` date,
      `updated_at` date
      PRIMARY KEY (id),
      FOREIGN KEY (pr_fk) REFERENCES purchase_request(id),
      FOREIGN KEY (item_fk) REFERENCES item(id),
      FOREIGN KEY (category_fk) REFERENCES category(id)
    );
    
CREATE TABLE request_for_quote
    (
      `id` int,
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
      `updated_at` date
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
      `id` int,
      `request_for_quote_fk` int,
      `quantity` float,
      `unit_fk` int,
      `item_fk` int,
      `total` float,
      `is_active` bit,
      `created_at` date,
      `updated_at` date
      PRIMARY KEY(id),
      FOREIGN KEY(pr_fk) REFERENCES request_for_quote(id),
      FOREIGN KEY(unit_fk) REFERENCES unit(id),
      FOREIGN KEY(item_fk) REFERENCES item(id)
    );



    

 