-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/10/2026 às 03:09
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `confeitaria_artesanal`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `chave` varchar(60) NOT NULL,
  `valor` text NOT NULL,
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `configuracoes`
--

INSERT INTO `configuracoes` (`chave`, `valor`, `atualizado_em`) VALUES
('loja_aberta', '1', '2026-09-30 20:05:26'),
('loja_mensagem', 'Estamos temporariamente fora do ar para novos pedidos.\n\nObrigada pela paciência — em breve as encomendas voltam a ser aceitas por aqui. 💗', '2026-09-30 20:05:26');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `img` varchar(255) NOT NULL,
  `cat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `img`, `cat`) VALUES
(1, 'Brigadeiros Clássicos', 4.50, 'fotos/img/1.png', 'brigadeiro'),
(2, 'Brigadeiros Especiais', 5.50, 'fotos/img/2.png', 'brigadeiro'),
(3, 'Surpresa de Uva', 5.00, 'fotos/img/3.png', 'brigadeiro'),
(4, 'Brigadeiros Premium', 7.00, 'fotos/img/4.png', 'brigadeiro'),
(5, 'Brigadeiro Floral', 6.50, 'fotos/img/5.png', 'brigadeiro'),
(6, 'Camafeu com Chocolate', 6.00, 'fotos/img/6.png', 'brigadeiro'),
(7, 'Bombom de Cereja', 6.00, 'fotos/img/7.png', 'caixa'),
(8, 'Caixa de Pistache', 12.00, 'fotos/img/8.png', 'caixa'),
(9, 'Caixa de Uva', 11.00, 'fotos/img/9.png', 'caixa'),
(10, 'Coração Aberto', 18.00, 'fotos/img/10.png', 'caixa'),
(11, 'Coração Fechado', 20.00, 'fotos/img/11.png', 'caixa'),
(12, 'Pirâmide de Frutas Vermelhas', 22.00, 'fotos/img/12.png', 'caixa'),
(13, 'Pirulito de Chocolate', 5.00, 'fotos/img/13.png', 'mini'),
(14, 'Bem Casado de Colher', 6.50, 'fotos/img/14.png', 'mini'),
(15, 'Cake Pop Quadrado', 6.00, 'fotos/img/15.png', 'mini'),
(16, 'Mini Bolo de Cenoura', 14.00, 'fotos/img/16.png', 'mini'),
(17, 'Mini Bombom de Uva', 5.50, 'fotos/img/17.png', 'mini'),
(18, 'Mini Brownie', 5.00, 'fotos/img/18.png', 'mini'),
(19, 'Mini Brownie Recheado', 6.00, 'fotos/img/19.png', 'mini'),
(20, 'Mini Tortinha de Limão', 7.00, 'fotos/img/20.png', 'mini'),
(21, 'Mini Trufas', 5.50, 'fotos/img/21.png', 'mini'),
(22, 'Mini Maçã do Amor', 6.00, 'fotos/img/22.png', 'mini'),
(23, 'Mini Churros Recheado', 5.50, 'fotos/img/23.png', 'mini'),
(24, 'Mini Cone Recheado', 5.00, 'fotos/img/24.png', 'mini');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_nasc` date NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `telefone` int(11) NOT NULL,
  `perfil` enum('admin','cliente') NOT NULL DEFAULT 'cliente',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_nasc`, `endereco`, `telefone`, `perfil`, `criado_em`) VALUES
(1, 'Samuel', 'samuelzzz@gmail.com', '$2y$10$6Y2K0GJWTSUVrsRjAVELNulhH1eTHvtrM4CX6Ch.K.uC6ZtX4lMhS', '2007-10-09', 'Rua Santo Eduarto 154', 1158244990, 'cliente', '2026-10-06 01:07:50');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`chave`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
