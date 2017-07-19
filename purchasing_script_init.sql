CREATE DATABASE dbfrchasing ;

USE dbpurchasing;

CREATE TABLE department
  (
      `id` int NOT NULL AUTO_INCREMENT, 
      `department_name` varchar(50),
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id)
    );
  
CREATE TABLE entity
  (
      `id` int NOT NULL AUTO_INCREMENT, 
      `entity_name` varchar(50),
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id)
    );
    
    
CREATE TABLE designation
  (
      `id` int NOT NULL AUTO_INCREMENT, 
      `designation_name` varchar(50),
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id)
    );

CREATE TABLE unit
  (
      `id` int NOT NULL AUTO_INCREMENT, 
      `unit_name` varchar(50),
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id)
    );

CREATE TABLE office
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `office_name` varchar(50),
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id)
    );
    
CREATE TABLE category
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `category_name` varchar(50),
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id)
    );
    
CREATE TABLE item
  (
      `id` int NOT NULL AUTO_INCREMENT, 
      `stock_no` varchar(50),
      `item_name` varchar(50),
      `item_description` varchar(255),
      `item_quantity` decimal,
      `is_active` tinyint(1),
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
      `password` varchar(255),
      `user_type` int,
      `designation_fk` int,
      `remember_token` varchar(255),
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
       PRIMARY KEY (id), 
       FOREIGN KEY (designation_fk) REFERENCES designation(id)
    );
    
INSERT INTO entity(entity_name, is_active, created_at, updated_at) values ("Main Entity", 1, NOW(), NOW());
INSERT INTO designation(designation_name, is_active, created_at, updated_at) values ("Administrator", 1, NOW(), NOW());
INSERT INTO user(first_name, last_name, sex, email, birthday, password, entity_fk, designation_fk, user_type, is_active, created_at, updated_at)
VALUES ("Super", "Admin", "M", "superadmin@gmail.com", NOW(), "$2y$10$cwli4dox7NjqBLptzb6jjOkT9Wj5h69wDjkDwWfhtq4c9o2/ercXi", 
        (SELECT id from entity WHERE entity_name = "Main Entity" LIMIT 1), 
        (SELECT id from designation WHERE designation_name = "Administrator" LIMIT 1), 
        1, 1, NOW(), NOW());

CREATE TABLE supplier
  (
      `id` int NOT NULL AUTO_INCREMENT, 
      `supplier_name` varchar(50),
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id)
    );
    
CREATE TABLE purchase_request
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `entity_fk` int,
      `department_fk` int,
      `office_fk` int,
      `entity_fk` int,
      `fund_cluster` varchar(50),
      `responsibility_center_code` varchar(50),
      `pr_number` varchar(50),
      `pr_date` datetime,
      `sai_number` varchar(50),
      `sai_date` datetime,
      `purpose` varchar(255),
      `requested_by_fk` int,
      `requestor_designation_fk`,
      `approved_by_fk` int,
      `approver_designation_fk` int,
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY (id),
      FOREIGN KEY (entity_fk) REFERENCES entity(id),
      FOREIGN KEY (department_fk) REFERENCES department(id),
      FOREIGN KEY (office_fk) REFERENCES office(id),
      FOREIGN KEY (requested_by_fk) REFERENCES user(id),
      FOREIGN KEY (approved_by_fk) REFERENCES user(id),
      FOREIGN KEY (requestor_designation_fk) REFERENCES designation(id),
      FOREIGN KEY (approver_designation_fk) REFERENCES designation(id)
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
      `is_active` tinyint(1),
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
      `rfq_number` varchar(50),
      `supplier1_fk` int,
      `supplier2_fk` int,
      `supplier3_fk` int,
      `supplier4_fk` int,
      `supplier5_fk` int,
      `vat_nonvat_tin` varchar(50),
      `place_of_delivery` varchar(255),
      `within_no_of_days` float,
      `requestor_fk` int,
      `requestor_designation_fk`,
      `canvasser_fk` int,
      `canvasser_designation_fk`,
      `pr_fk` int,
      `is_active` tinyint(1),
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
      FOREIGN KEY(requestor_designation_fk) REFERENCES designation(id),
      FOREIGN KEY(canvasser_designation_fk) REFERENCES designation(id),
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
      `is_active` tinyint(1),
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
      `aq_number` varchar(50),
      `supplier1_fk` int,
      `supplier2_fk` int,
      `supplier3_fk` int,
      `supplier4_fk` int,
      `supplier5_fk` int,
      `supervising_admin_fk` int,
      `admin_officer_fk` int,
      `admin_officer_2_fk` int,
      `board_secretary_fk` int,
      `vpaf_fk` int,
      `approve_fk` int,
      `pr_fk` int,
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY(id),
      FOREIGN KEY(supplier1_fk) REFERENCES supplier(id),
      FOREIGN KEY(supplier2_fk) REFERENCES supplier(id),
      FOREIGN KEY(supplier3_fk) REFERENCES supplier(id),
      FOREIGN KEY(supplier4_fk) REFERENCES supplier(id),
      FOREIGN KEY(supplier5_fk) REFERENCES supplier(id),
      FOREIGN KEY(supervising_admin_fk) REFERENCES user(id),
      FOREIGN KEY(admin_officer_fk) REFERENCES user(id),
      FOREIGN KEY(admin_officer_2_fk) REFERENCES user(id),
      FOREIGN KEY(board_secretary_fk) REFERENCES user(id),
      FOREIGN KEY(vpaf_fk) REFERENCES user(id),
      FOREIGN KEY(approve_fk) REFERENCES user(id),
      FOREIGN KEY(pr_fk) REFERENCES purchase_request(id)
    );

CREATE TABLE abstract_quotation_detail
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `abstract_quotation_fk` int,
      `unit_fk` int,
      `item_fk` int,
      `supplier1_amount` float,
      `supplier2_amount` float,
      `supplier3_amount` float,
      `supplier4_amount` float,
      `supplier5_amount` float,
      `winning_supplier_fk` int,
      `winning_supplier_amount` float,
      `quantity` float,
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY(id),
      FOREIGN KEY(abstract_quotation_fk) REFERENCES abstract_quotation(id),
      FOREIGN KEY(winning_supplier_fk) REFERENCES supplier(id),
      FOREIGN KEY(unit_fk) REFERENCES unit(id),
      FOREIGN KEY(item_fk) REFERENCES item(id)
    );


CREATE TABLE purchase_order
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `entity_fk` int,
      `po_number` varchar(50),
      `supplier_fk` int,
      `address` varchar(255),
      `tin` varchar(50),
      `invoice_date` date,
      `mode_of_procurement` varchar(50),
      `place_of_delivery` varchar(255),
      `date_of_delivery` varchar(255),
      `delivery_term` varchar(50),
      `payment_term` varchar(50),
      `total_amount` float,
      `authorized_official_fk` int,
      `total_amount_in_words` varchar(255),
      `pr_no_fk` int,
      `abstract_quotation_fk` int,
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY(id),
      FOREIGN KEY(entity_fk) REFERENCES entity(id),
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
      `quantity` float,
      `unit_cost` float,
      `amount` float,
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY(id),
      FOREIGN KEY(po_id_fk) REFERENCES purchase_order(id),
      FOREIGN KEY(unit_fk) REFERENCES unit(id),
      FOREIGN KEY(item_fk) REFERENCES item(id)
    );

CREATE TABLE acceptance
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `entity_fk` int,
      `supplier_fk` int,
      `acceptance_number` varchar(50),
      `po_fk` int,
      `po_no` varchar(50),
      `po_date` date,
      `iar` varchar(50),
      `invoice_no` varchar(50),
      `invoice_date` date,
      `requisitioning_dept_fk` int,
      `date_inspected` date,
      `verification` varchar(50),
      `inspector_fk` int,
      `date_accepted` date,
      `completeness` varchar(50),
      `property_officer_fk` int,
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY(id),
      FOREIGN KEY(entity_fk) REFERENCES entity(id),
      FOREIGN KEY(supplier_fk) REFERENCES supplier(id),
      FOREIGN KEY(po_fk) REFERENCES purchase_order(id),
      FOREIGN KEY(requisitioning_dept_fk) REFERENCES department(id),
      FOREIGN KEY(inspector_fk) REFERENCES user(id),
      FOREIGN KEY(property_officer_fk) REFERENCES user(id)
    );

CREATE TABLE acceptance_detail
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `acceptance_fk` int,
      `item_fk` int,
      `unit_fk` int,
      `quantity` int,
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY(id),
      FOREIGN KEY(item_fk) REFERENCES item(id),
      FOREIGN KEY(unit_fk) REFERENCES unit(id),
      FOREIGN KEY(acceptance_fk) REFERENCES acceptance(id)
    );

CREATE TABLE issuance
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `issuance_number` varchar(50),
      `entity_fk` int,
      `department_fk` int,
      `office_fk` int,
      `reasonability_center_code` varchar(50),
      `ris_no` varchar(50),
      `ris_date` date,
      `sai_no` varchar(50),
      `sai_date` date,
      `document_type` varchar(50),
      `purpose` varchar(255),
      `requested_by_fk` int,
      `requestor_designation_fk` int,
      `request_date` date,
      `approver_fk` int,
      `approver_designation_fk` int,
      `approved_date` date,
      `issued_by_fk` int,
      `issuer_designation_fk` int,
      `issued_date` date,
      `received_by_fk` int,
      `recipient_designation_fk` int,
      `receipt_date` date,
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY(id),
      FOREIGN KEY(entity_fk) REFERENCES entity(id),
      FOREIGN KEY(department_fk) REFERENCES department(id),
      FOREIGN KEY(office_fk) REFERENCES office(id),
      FOREIGN KEY(requested_by_fk) REFERENCES user(id),
      FOREIGN KEY(requestor_designation_fk) REFERENCES designation(id),
      FOREIGN KEY(approver_fk) REFERENCES user(id),
      FOREIGN KEY(approver_designation_fk) REFERENCES designation(id),
      FOREIGN KEY(issued_by_fk) REFERENCES user(id),
      FOREIGN KEY(issuer_designation_fk) REFERENCES designation(id),
      FOREIGN KEY(received_by_fk) REFERENCES user(id),
      FOREIGN KEY(recipient_designation_fk) REFERENCES designation(id)
    );

CREATE TABLE issuance_detail
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `issuance_fk` int,
      `stock_no` varchar(50),
      `unit_fk` int,
      `item_fk` int,
      `quantity` float,
      `no_of_days_consume` varchar(50),
      `remarks` varchar(255),
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY(id),
      FOREIGN KEY(issuance_fk) REFERENCES issuance(id),
      FOREIGN KEY(item_fk) REFERENCES item(id),
      FOREIGN KEY(unit_fk) REFERENCES unit(id)
    );

CREATE TABLE stock_card
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `item_fk` int,
      `date` date,
      `reference` varchar(50),
      `po_fk` int,
      `acceptance_fk` int,
      `issuance_fk` int,
      `reference_no` varchar(50),
      `received_quantity` float,
      `issued_quantity` float,
      `office_fk` int,
      `balanced_quantity` float,
      `no_of_days_consume` float,
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY(id),
      FOREIGN KEY(item_fk) REFERENCES item(id),
      FOREIGN KEY(po_fk) REFERENCES purchase_order(id),
      FOREIGN KEY(acceptance_fk) REFERENCES acceptance(id),
      FOREIGN KEY(issuance_fk) REFERENCES issuance(id),
      FOREIGN KEY(office_fk) REFERENCES office(id)
    );

CREATE TABLE disbursement_voucher
    (
      `id` int NOT NULL AUTO_INCREMENT,
      `dv_number` varchar(50),
      `mode_of_payment` varchar(50),
      `payee_fk` int,
      `employee_no` varchar(50),
      `or_bur_no` varchar(50),
      `address` varchar(255),
      `project` varchar(50),
      `code` varchar(50),
      `explanation` varchar(255),
      `amount` float,
      `certified` varchar(50),
      `certifier_name_fk` int,
      `date` date,
      `approved_for_payment` varchar(50),
      `approver_fk` int,
      `approve_date` date,
      `ada_no` varchar(50),
      `payment_check_date` date,
      `bank_name` varchar(50),
      `check_printed_name_fk` int,
      `jev_no` varchar(50),
      `check_date` date,
      `other_docs` varchar(50),
      `is_active` tinyint(1),
      `created_at` date,
      `updated_at` date,
      PRIMARY KEY(id),
      FOREIGN KEY(payee_fk) REFERENCES user(id),
      FOREIGN KEY(certifier_name_fk) REFERENCES user(id),
      FOREIGN KEY(approver_fk) REFERENCES user(id),
      FOREIGN KEY(check_printed_name_fk) REFERENCES user(id)
    );
