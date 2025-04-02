INSERT INTO categorias (nombre, descripcion) VALUES
('Computadoras', 'Laptops y computadoras de escritorio'),
('Celulares', 'Teléfonos móviles y accesorios'),
('Electrónica', 'Dispositivos electrónicos como audífonos y parlantes'),
('Accesorios', 'Cables, cargadores y otros accesorios tecnológicos');


INSERT INTO productos (nombre, descripcion, categoria_id, precio, stock, imagen) VALUES
('Laptop Dell Inspiron', 'Procesador Intel i7, 16GB RAM, 512GB SSD', 1, 899.99, 10, 'img/laptop_dell.jpg'),
('MacBook Air M1', 'Chip M1, 8GB RAM, 256GB SSD', 1, 1199.99, 8, 'img/macbook_air.jpg'),
('iPhone 13', 'Pantalla Super Retina XDR de 6.1 pulgadas', 2, 999.99, 15, 'img/iphone_13.jpg'),
('Samsung Galaxy S22', 'Cámara de 50MP y pantalla Dynamic AMOLED', 2, 849.99, 12, 'img/galaxy_s22.jpg'),
('Audífonos Inalámbricos Sony', 'Cancelación de ruido y alta fidelidad', 3, 149.99, 20, 'img/sony_headphones.jpg'),
('Cargador Rápido USB-C', 'Carga rápida 20W compatible con iPhone y Android', 4, 19.99, 30, 'img/usb_c_charger.jpg');
