-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08/12/2024 às 21:05
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `assistencia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

DROP TABLE IF EXISTS `alunos`;
CREATE TABLE IF NOT EXISTS `alunos` (
  `cpf` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `matricula` int NOT NULL,
  `turma` varchar(255) NOT NULL,
  PRIMARY KEY (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`cpf`, `nome`, `email`, `matricula`, `turma`) VALUES
('04907172095', 'bruno', 'brunobitencourt57br@gmail.com', 2022310863, 'info31'),
('eweqe', 'wewe', 'e@2', 0, 'qe');

-- --------------------------------------------------------

--
-- Estrutura para tabela `recuperar_senha`
--

DROP TABLE IF EXISTS `recuperar_senha`;
CREATE TABLE IF NOT EXISTS `recuperar_senha` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `token` varchar(255) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `usado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `recuperar_senha`
--

INSERT INTO `recuperar_senha` (`id`, `email`, `token`, `data_criacao`, `usado`) VALUES
(4, 'brunobitencourt57br@gmail.com', 'c1363e0d7e451071387f9f97144016a5cc4fd87b52f6edf59487e278572beab2a0d1da1a63ca0c909254bd500b69021b6a2c', '2024-12-05 19:50:46', 1),
(2, 'brunobitencourt57br@gmail.com', 'c6af01cf34f1a24dac6d0885227f69932c4a71832f6189709a47820dd967705795d5298bd775a27e2b0148d9d557d70a023d', '2024-12-01 20:04:29', 0),
(3, 'brunobitencourt57br@gmail.com', 'f4342354534d5751ae7ca9e2ebf02a4a14b62b8e080638dd4662635ff5b0c06f416da6ac66731d3454befc1fbb1e6c9249b4', '2024-12-05 19:48:48', 1),
(5, 'brunobitencourt57br@gmail.com', '2d200f6de891a202cd5c3fbd288b1de1c926f7a4bbf4ae368041735d2f730dafb9817c789e1b7cc1ec7a73617bd53d8277f7', '2024-12-05 19:53:08', 1),
(6, 'brunobitencourt57br@gmail.com', '20114bf93352b95bea096e554ef58ca47f7277463c37d47cb0bc89124fa21fb58be4445ba1bec24aba222f40bb463baa4eb1', '2024-12-05 19:54:01', 1),
(7, 'brunobitencourt57br@gmail.com', 'b12b108d0cc41ebcfaae464315ecf354a7c7ee4e1b3b52b6a09e0dc5de375e9b7e9ab53c54ed3a9e29bdfce5c4ccb5afe74e', '2024-12-05 20:44:44', 1),
(8, 'brunobitencourt57br@gmail.com', '934dcc8d2903ee82fc59fc3fbb2dbb07b2182de3e43b2ecde872f29b11e9a2a125856feb589e8d342f1288244efa03640627', '2024-12-05 20:48:39', 1),
(9, 'brunobitencourt57br@gmail.com', 'bad406de24f50c6bfbdc77f028aa2b035691abd99531bbccaae83abb001bf6e964c4d2bdc8ab7113904ea76dc90a3e477bcb', '2024-12-05 20:52:16', 1),
(10, 'brunobitencourt57br@gmail.com', '279c3ee5cd7f76af5364d21789c0a6e7d0351961e5228ded53c0dc371801c962e372920a198cb9d5dd800af57d6861eba2ab', '2024-12-05 20:59:10', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `registros`
--

DROP TABLE IF EXISTS `registros`;
CREATE TABLE IF NOT EXISTS `registros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `matricula` varchar(50) NOT NULL,
  `turma` varchar(100) DEFAULT NULL,
  `motivo` text,
  `tipo` enum('entrada','saida') NOT NULL,
  `data` date NOT NULL,
  `horario` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `registros`
--

INSERT INTO `registros` (`id`, `nome`, `matricula`, `turma`, `motivo`, `tipo`, `data`, `horario`) VALUES
(1, '22', '22w', '22', '22', 'entrada', '2024-11-06', '20:27:21'),
(2, '32', '2', '3321', '13213', 'entrada', '0021-03-23', '03:13:00'),
(3, '213', '321', '2132132', '3213213', 'entrada', '2132-03-31', '13:21:00'),
(4, 'w22132', '21', '2131', '323123211', 'entrada', '1321-12-31', '03:01:00'),
(5, '2122', '2312313', '321', '213213', 'saida', '0002-02-02', '21:03:00'),
(6, '11', '12', '2221', '2121', 'entrada', '0121-02-21', '21:01:00'),
(7, '21', '2321', '32132', '21323213', 'saida', '0000-00-00', '03:21:00'),
(8, '3e2', '321321', '21321321', '21', 'entrada', '0213-03-31', '21:03:00'),
(9, 'entrada', 'entrada', 'entrada', 'entrada', 'entrada', '0003-02-13', '21:12:00'),
(10, 'saida', 'saida\r\n', 'saida', 'saida', 'saida', '1321-02-23', '03:21:00'),
(11, 'bruno', '2022310863', 'info31', 'dormiu dms', 'entrada', '2024-12-01', '16:28:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `nome` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `Perfil` int NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `SIAPE` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`SIAPE`),
  UNIQUE KEY `SIAPE` (`SIAPE`)
) ENGINE=InnoDB AUTO_INCREMENT=23232330 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`nome`, `senha`, `Perfil`, `imagem`, `SIAPE`, `email`) VALUES
('coordenação', '$2y$10$a6WlaWOU.WG20nzFdjPTtOSdd2qCNjaA1t4OmNfgsGJhScSpqrW/a', 1, '', 111, 'coordenacao@gmail.com'),
('bruno', '$2y$10$LbRJj/z2WWZy8gDJww2EH.4zQhw8Bkjqh5vwr9kcuV6pEhL4SLEKy', 1, '', 123, 'brunobitencourt57br@gmail.com'),
('w', '$2y$10$tcvRLTzC.Y/Ndin2Vd8QtONgiB4qKrKJm7hu9FzFwvL2ke0G5Xz.u', 2, '', 23232328, 'eewe2@2'),
('wew', '$2y$10$ilLXpalcN26nERzYvd4awOLCMJL.wVE./xbxmy2/hZoDzvQmsAr/W', 4, '', 23232329, 'ewewew@2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
