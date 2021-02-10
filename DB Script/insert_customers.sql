USE eyalet_BackEnd_Project_Chen;
INSERT INTO `Customer` (`id`, `first_name`, `last_name`, `email`, `password`, `phone_number`) VALUES
('111111111', 'Anat', 'Lelior', 'anat@gmail.com', '1234', '050-1111111'),
('222222222', 'Miki', 'Kook', 'miki@hotmail.com', '1234', '050-2222222'),
('333333333', 'Omri', 'Ding', 'dingking@gmail.com', '1234', '050-3333333'),
('444444444', 'Moti', 'Banana', 'bananas@gmai.com', '1234', '050-4444444'),
('555555555', 'Jane', 'Bordoux', 'einav@gmail.com', '1234', '050-5555555'),
('666666666', 'Yossi', 'Revivo', 'yosrevivo@walla.co.il', '1234', '050-6666666'),
('777777777' ,'David', 'Davidi', 'davidi@hitmail.com', '1234', '050-7777777'),
('888888888', 'Yossef', 'Choen', 'ycohen@gmail.com', '1234', '050-8888888'),
('9999999999', 'Nurit', 'Levi', 'nirutlevi@gmail.com', '1234', '050-8888888'),
('101010101', 'Itay', 'Harel', 'itharel@gmail.com', '1234', '050-1010101');


INSERT INTO `Address` (`customer_id`, `city`, `street`, `house_number`, `zip_code`) VALUES
('111111111', 'Tel Aviv', 'Hayarkon', 10, 6560311),
('222222222', 'Tel Aviv', 'Ben Yehuda', 132, 6340222),
('333333333', 'Haifa', 'Tchernikhovski', 35, 3570901),
('444444444', 'Hod Hasharon', 'Habanim', 23, 4526834),
('555555555', 'Yavne', 'Petel', 8, 8155336),
('666666666', 'Shoham', 'Gazit', 3, 6082016),
('777777777', 'Acre', 'Herzl', 33, 2420336),
('888888888', 'Netanya', 'David Remez', 21, 4240603),
('9999999999', 'Beer Sheva', 'Felix', 14, 8483456),
('101010101', 'Ashdod', 'Kakal', 44, 7746136);
