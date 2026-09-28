-- Rode este arquivo se o banco confeitaria_artesanal ja estiver importado. So acrescenta as tabelas novas, nao mexe em produtos.

USE confeitaria_artesanal;

-- 1. Criação da Tabela de Usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    perfil ENUM('admin', 'cliente') NOT NULL DEFAULT 'cliente',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Conta inicial da administradora (email: admin@thayarapolizel.com, senha: admin123 - trocar depois)
INSERT INTO usuarios (nome, email, senha, perfil) VALUES
('Thayara Polizel', 'admin@thayarapolizel.com',
 '$2y$10$UvzHmBuFMa3yPhDwoAwl5OTx403TwmUvCF657U1UI8EarVotnUEC2', 'admin')
ON DUPLICATE KEY UPDATE email = email;

-- 3. Criação da Tabela de Configurações
CREATE TABLE IF NOT EXISTS configuracoes (
    chave VARCHAR(60) PRIMARY KEY,
    valor TEXT NOT NULL,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 4. Valores iniciais da loja
INSERT INTO configuracoes (chave, valor) VALUES
('loja_aberta', '1'),
('loja_mensagem', 'Estamos temporariamente fora do ar para novos pedidos.\n\nObrigada pela paciência — em breve as encomendas voltam a ser aceitas por aqui. 💗')
ON DUPLICATE KEY UPDATE valor = valor;
