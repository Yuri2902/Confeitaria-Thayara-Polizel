Drop DATABASE confeitaria_artesanal;
CREATE DATABASE IF NOT EXISTS confeitaria_artesanal;
USE confeitaria_artesanal;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome       VARCHAR(100) NOT NULL,
    email      VARCHAR(150) NOT NULL UNIQUE,
    senha      VARCHAR(255) NOT NULL,
    perfil     ENUM('cliente', 'admin') NOT NULL DEFAULT 'cliente',
    data_nasc  DATE NULL,
    endereco   VARCHAR(255) NULL,
    telefone   VARCHAR(20) NULL,
    criado_em  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome       VARCHAR(100) NOT NULL,
    preco      DECIMAL(10, 2) NOT NULL,
    img        VARCHAR(255) NOT NULL,
    cat        VARCHAR(50) NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE IF NOT EXISTS pedidos (
    id_pedido    INT AUTO_INCREMENT PRIMARY KEY,
    data_emissao DATE NOT NULL,
    data_entrega DATE NULL,
    forma_pgto   VARCHAR(50),
    valor_total  DECIMAL(10, 2) NOT NULL DEFAULT 0,
    id_usuario   INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);


CREATE TABLE IF NOT EXISTS itens_pedido (
    id_item        INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido      INT NOT NULL,
    id_produto     INT NOT NULL,
    descricao      VARCHAR(100) NOT NULL,
    quantidade     INT NOT NULL DEFAULT 1,
    preco_unitario DECIMAL(10, 2) NOT NULL,
    preco_total    DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_pedido)  REFERENCES pedidos(id_pedido) ON DELETE CASCADE,
    FOREIGN KEY (id_produto) REFERENCES produtos(id)
);


CREATE TABLE IF NOT EXISTS configuracoes (
    chave         VARCHAR(60) PRIMARY KEY,
    valor         TEXT NOT NULL,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



-- Administradora (email: admin@thayarapolizel.com, senha: admin123 - trocar depois)
INSERT INTO usuarios (nome, email, senha, perfil) VALUES
('Thayara Polizel', 'admin@thayarapolizel.com',
 '$2y$10$UvzHmBuFMa3yPhDwoAwl5OTx403TwmUvCF657U1UI8EarVotnUEC2', 'admin')
ON DUPLICATE KEY UPDATE email = email;

-- Cliente padrão para testes (email: cliente@msn.com, senha: cliente123 - trocar depois)
INSERT INTO usuarios (nome, email, senha, perfil, data_nasc, endereco, telefone) VALUES
('Cliente', 'cliente@msn.com',
 '$2y$10$/mAX7Ygkl5v.a1c7Op.xh.U7IzeDtiDdukN7YddCb7/lQe5hYW2cK',
 'cliente', '2004-10-16', 'Rua das Flores, 123', '11987654321')
ON DUPLICATE KEY UPDATE email = email;

SET @id_admin = (SELECT id FROM usuarios WHERE email = 'admin@thayarapolizel.com');

INSERT INTO produtos (nome, preco, img, cat, id_usuario) VALUES
('Brigadeiros Clássicos',          4.50,  'fotos/img/1.png',  'brigadeiro', @id_admin),
('Brigadeiros Especiais',          5.50,  'fotos/img/2.png',  'brigadeiro', @id_admin),
('Surpresa de Uva',                5.00,  'fotos/img/3.png',  'brigadeiro', @id_admin),
('Brigadeiros Premium',            7.00,  'fotos/img/4.png',  'brigadeiro', @id_admin),
('Brigadeiro Floral',              6.50,  'fotos/img/5.png',  'brigadeiro', @id_admin),
('Camafeu com Chocolate',          6.00,  'fotos/img/6.png',  'brigadeiro', @id_admin),
('Bombom de Cereja',               6.00,  'fotos/img/7.png',  'caixa',      @id_admin),
('Caixa de Pistache',              12.00, 'fotos/img/8.png',  'caixa',      @id_admin),
('Caixa de Uva',                   11.00, 'fotos/img/9.png',  'caixa',      @id_admin),
('Coração Aberto',                 18.00, 'fotos/img/10.png', 'caixa',      @id_admin),
('Coração Fechado',                20.00, 'fotos/img/11.png', 'caixa',      @id_admin),
('Pirâmide de Frutas Vermelhas',   22.00, 'fotos/img/12.png', 'caixa',      @id_admin),
('Pirulito de Chocolate',          5.00,  'fotos/img/13.png', 'mini',       @id_admin),
('Bem Casado de Colher',           6.50,  'fotos/img/14.png', 'mini',       @id_admin),
('Cake Pop Quadrado',              6.00,  'fotos/img/15.png', 'mini',       @id_admin),
('Mini Bolo de Cenoura',           14.00, 'fotos/img/16.png', 'mini',       @id_admin),
('Mini Bombom de Uva',             5.50,  'fotos/img/17.png', 'mini',       @id_admin),
('Mini Brownie',                   5.00,  'fotos/img/18.png', 'mini',       @id_admin),
('Mini Brownie Recheado',          6.00,  'fotos/img/19.png', 'mini',       @id_admin),
('Mini Tortinha de Limão',         7.00,  'fotos/img/20.png', 'mini',       @id_admin),
('Mini Trufas',                    5.50,  'fotos/img/21.png', 'mini',       @id_admin),
('Mini Maçã do Amor',              6.00,  'fotos/img/22.png', 'mini',       @id_admin),
('Mini Churros Recheado',          5.50,  'fotos/img/23.png', 'mini',       @id_admin),
('Mini Cone Recheado',             5.00,  'fotos/img/24.png', 'mini',       @id_admin);

-- Valores iniciais da loja
INSERT INTO configuracoes (chave, valor) VALUES
('loja_aberta', '1'),
('loja_mensagem', 'Estamos temporariamente fora do ar para novos pedidos.\n\nObrigada pela paciência — em breve as encomendas voltam a ser aceitas por aqui. 💗')
ON DUPLICATE KEY UPDATE valor = valor;
SET @id_cliente = (SELECT id FROM usuarios WHERE email = 'cliente@msn.com');
-- EXEMPLO: SALVAR UMA COMPRA COM VÁRIOS ITENS (opcional, para testar) Descomente para executar.