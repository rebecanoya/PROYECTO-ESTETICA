INSERT INTO `cosmetica`.`lineas` ( `ID_Music`, `Nombre`, `Color`,`Descripcion`) VALUES 
( '1', 'Revitalizante', 'FFC0CB',
'Elaborada con precisión e infundida con los ingredientes revitalizantes más potentes de la naturaleza, esta gama de cuidado de la piel está diseñada para dar nueva vida a tu piel, revelando un cutis radiante y rejuvenecido.'),
('2', 'Relajante', 'AF49FC',
'Con precisión y los ingredientes más potentes, esta gama de cuidado de la piel da vida a tu cutis, revelando una piel radiante y rejuvenecida. Déjate envolver por la frescura y el rejuvenecimiento que esta línea ofrece, y experimenta la sensación de una piel revitalizada y llena de vitalidad.');
INSERT INTO `cosmetica`.`productos` (`Precio`, `Stock`, `Descripcion`, `ID_Line`, `Nombre`) VALUES 
('20', '10', 'demo', '1', 'Aceite'),
('5', '25', 'demo2', '1', 'Ambientador'),
('15', '40', 'demo3', '1', 'Colonia'),
('10', '10', 'demo4', '1', 'Exfoliante'),
('18', '20', 'demo5', '1', 'Sales'),
('6', '50', 'demo6', '1', 'Vela'),
('20', '10', 'demo', '2', 'Aceite'),
('5', '25', 'demo2', '2', 'Ambientador'),
('15', '40', 'demo3', '2', 'Colonia'),
('10', '10', 'demo4', '2', 'Exfoliante'),
('18', '20', 'demo5', '2', 'Sales'),
('6', '50', 'demo6', '2', 'Vela');


