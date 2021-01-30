CREATE DATABASE eyalet_BackEnd_Project_Chen; USE
eyalet_BackEnd_Project_Chen;
CREATE TABLE Customer(
                         id VARCHAR(32) PRIMARY KEY,
                         first_name VARCHAR(30),
                         last_name VARCHAR(30),
                         email VARCHAR(30) NOT NULL UNIQUE,
                         `password` VARCHAR(32),
                         phone_number VARCHAR(14)
); CREATE TABLE Address(
                           id INT AUTO_INCREMENT PRIMARY KEY,
                           customer_id VARCHAR(32),
                           city VARCHAR(30),
                           street VARCHAR(30),
                           house_number INT,
                           zip_code INT,
                           FOREIGN KEY(customer_id) REFERENCES Customer(id) ON DELETE CASCADE
   ); CREATE TABLE Dog(
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          customer_id VARCHAR(32),
                          dog_name VARCHAR(30),
                          weight FLOAT,
                          age INT,
                          size VARCHAR(20),
                          gender VARCHAR(1),
                          FOREIGN KEY(customer_id) REFERENCES Customer(id) ON DELETE CASCADE
      ); CREATE TABLE Employee(
                                  id INT PRIMARY KEY,
                                  first_name VARCHAR(30),
                                  last_name VARCHAR(30),
                                  city VARCHAR(30),
                                  radius INT
         ); CREATE TABLE Service(
                                    id INT AUTO_INCREMENT PRIMARY KEY,
                                    service_name VARCHAR(30),
                                    price INT,
                                    description VARCHAR(100)
            ); CREATE TABLE Employee_services(
                                                 employee_id INT,
                                                 service_id INT,
                                                 FOREIGN KEY(employee_id) REFERENCES Employee(id) ON DELETE CASCADE,
                                                 FOREIGN KEY(service_id) REFERENCES Service(id) ON DELETE CASCADE
               ); CREATE TABLE Additional_services(
                                                      id INT AUTO_INCREMENT PRIMARY KEY,
                                                      service_name VARCHAR(30),
                                                      price INT
                  ); CREATE TABLE Orders(
                                            id INT AUTO_INCREMENT PRIMARY KEY,
                                            employee_id INT,
                                            service_id INT,
                                            additional_services_id INT,
                                            customer_id VARCHAR(32),
                                            order_date DATE,
                                            total_price INT,
                                            FOREIGN KEY(employee_id) REFERENCES Employee(id) ON DELETE CASCADE,
                                            FOREIGN KEY(service_id) REFERENCES Service(id) ON DELETE CASCADE,
                                            FOREIGN KEY(additional_services_id) REFERENCES Additional_services(id) ON DELETE CASCADE,
                                            FOREIGN KEY(customer_id) REFERENCES Customer(id) ON DELETE CASCADE
                     ); CREATE TABLE Order_add(
                                                  additional_services_id INT,
                                                  Orders_id INT,
                                                  FOREIGN KEY(additional_services_id) REFERENCES Additional_services(id) ON DELETE CASCADE,
                                                  FOREIGN KEY(Orders_id) REFERENCES Orders(id) ON DELETE CASCADE
                        ); ALTER TABLE
    Address AUTO_INCREMENT = 234;
ALTER TABLE
    Dog AUTO_INCREMENT = 2001;
ALTER TABLE
    Orders AUTO_INCREMENT = 1000001;
INSERT INTO `Service`(
    `service_name`,
    `price`,
    `description`
)
VALUES(
          'Haircut',
          150,
          'Haircut suitable for dog breed, bathing, perfuming, and drying'
      );
INSERT INTO `Service`(
    `service_name`,
    `price`,
    `description`
)
VALUES(
          'Grooming',
          200,
          'Thorough brushing and opening of knots, thinning of excess fur, bathing, perfuming and drying'
      );
INSERT INTO `Service`(
    `service_name`,
    `price`,
    `description`
)
VALUES(
          'Shower',
          100,
          'Rinse the dog with shampoo and conditioner and perfume'
      );
INSERT INTO `Additional_services`(`service_name`, `price`)
VALUES('Ear cleaning', 20);
INSERT INTO `Additional_services`(`service_name`, `price`)
VALUES('Nail clipping', 30);
INSERT INTO `Additional_services`(`service_name`, `price`)
VALUES('Flea treatment', 50);
