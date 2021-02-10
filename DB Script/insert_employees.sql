USE
eyalet_BackEnd_Project_Chen;

INSERT INTO `Employee` (`first_name`, `last_name`, `city`, `latitude`, `longitude`, `radius`) VALUES
('Israel', 'Israeli', 'Lod', 31.951688, 34.890900, 50),
('Meir', 'Or', 'Beer Sheva', 31.249416, 34.783759, 100),
('Sara', 'Dor', 'Haifa', 32.796670, 34.983930, 35),
('Yehudit', 'Mor', 'Jerusalem', 31.751435, 35.192354, 40),
('Shai', 'Grossman', 'Herzeliya', 32.166573, 34.823764, 25),
('Ofir', 'Dror', 'Binyamina', 32.515273, 34.950490, 55),
('Yael', 'David', 'Eilat', 29.566496, 34.954532, 65),
('Dotan', 'Kraus', 'Tiberias', 32.787549, 35.537493, 40),
('Miri', 'Segev', 'Ashkelon', 31.679846, 34.556979, 45),
('Amir', 'Hertz', 'Karmiel', 32.921058, 35.301284, 60);


INSERT INTO `Employee_services` (`employee_id`, `service_id`)
VALUES (1, 1),
       (1, 2),
       (1, 2),
       (2, 3),
       (2, 1),
       (3, 1),
       (3, 2),
       (3, 3),
       (4, 2),
       (4, 3),
       (5, 1),
       (5, 2),
       (6, 1),
       (6, 2),
       (6, 3),
       (7, 1),
       (7, 2),
       (7, 3),
       (8, 1),
       (8, 2),
       (8, 3),
       (9, 1),
       (9, 2),
       (9, 3),
       (10, 1),
       (10, 2),
       (10, 3);
