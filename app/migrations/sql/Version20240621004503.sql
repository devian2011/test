INSERT INTO countries (id, name)
VALUES (1, 'DE'),
       (2, 'IT'),
       (3, 'GR'),
       (4, 'FR');
INSERT INTO taxes (country_id, pattern, tax_percent)
VALUES (1, 'DEXXXXXXXXX', 19),
       (2, 'ITXXXXXXXXXXX', 22),
       (3, 'GRXXXXXXXXX', 24),
       (4, 'FRYYXXXXXXXXX', 20);
INSERT INTO goods (name, price)
VALUES ('Iphone', 100),
       ('Headphones', 20),
       ('Case', 10);
INSERT INTO sellers (id, name) VALUES (1, 'SellerOne');
INSERT INTO coupons (seller_id, code, value, type)
VALUES (1, 'P10', 10, 1),
       (1, 'F20', 20, 2),
       (1, 'U20', 20, 3),
       (1, 'P40', 20, 1),
       (1, 'F10', 20, 2);