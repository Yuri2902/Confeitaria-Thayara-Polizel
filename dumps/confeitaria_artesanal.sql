CREATE DATABASE IF NOT EXISTS confeitaria_artesanal;
USE confeitaria_artesanal;

-- 1. Criação da Tabela de Produtos
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    img VARCHAR(255) NOT NULL,
    cat VARCHAR(50) NOT NULL
);

-- 2. Inserção dos Dados Iniciais do Cardápio
INSERT INTO produtos (id, nome, preco, img, cat) VALUES
(1,  'Brigadeiros Clássicos',          4.50,  'fotos/img/1.png',  'brigadeiro'),
(2,  'Brigadeiros Especiais',           5.50,  'fotos/img/2.png',  'brigadeiro'),
(3,  'Surpresa de Uva',                 5.00,  'fotos/img/3.png',  'brigadeiro'),
(4,  'Brigadeiros Premium',             7.00,  'fotos/img/4.png',  'brigadeiro'),
(5,  'Brigadeiro Floral',               6.50,  'fotos/img/5.png',  'brigadeiro'),
(6,  'Camafeu com Chocolate',           6.00,  'fotos/img/6.png',  'brigadeiro'),
(7,  'Bombom de Cereja',                6.00,  'fotos/img/7.png',  'caixa'),
(8,  'Caixa de Pistache',               12.00, 'fotos/img/8.png',  'caixa'),
(9,  'Caixa de Uva',                    11.00, 'fotos/img/9.png',  'caixa'),
(10, 'Coração Aberto',                  18.00, 'fotos/img/10.png', 'caixa'),
(11, 'Coração Fechado',                 20.00, 'fotos/img/11.png', 'caixa'),
(12, 'Pirâmide de Frutas Vermelhas',    22.00, 'fotos/img/12.png', 'caixa'),
(13, 'Pirulito de Chocolate',           5.00,  'fotos/img/13.png', 'mini'),
(14, 'Bem Casado de Colher',            6.50,  'fotos/img/14.png', 'mini'),
(15, 'Cake Pop Quadrado',               6.00,  'fotos/img/15.png', 'mini'),
(16, 'Mini Bolo de Cenoura',            14.00, 'fotos/img/16.png', 'mini'),
(17, 'Mini Bombom de Uva',              5.50,  'fotos/img/17.png', 'mini'),
(18, 'Mini Brownie',                    5.00,  'fotos/img/18.png', 'mini'),
(19, 'Mini Brownie Recheado',           6.00,  'fotos/img/19.png', 'mini'),
(20, 'Mini Tortinha de Limão',          7.00,  'fotos/img/20.png', 'mini'),
(21, 'Mini Trufas',                     5.50,  'fotos/img/21.png', 'mini'),
(22, 'Mini Maçã do Amor',               6.00,  'fotos/img/22.png', 'mini'),
(23, 'Mini Churros Recheado',           5.50,  'fotos/img/23.png', 'mini'),
(24, 'Mini Cone Recheado',              5.00,  'fotos/img/24.png', 'mini');