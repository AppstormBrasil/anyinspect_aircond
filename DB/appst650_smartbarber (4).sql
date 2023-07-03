-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 26-Set-2020 às 02:29
-- Versão do servidor: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `appst650_Agendazy`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_booking`
--

CREATE TABLE IF NOT EXISTS `tb_booking` (
`id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `forma_pagamento` varchar(45) NOT NULL,
  `status_pagamento` varchar(45) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tb_booking`
--

INSERT INTO `tb_booking` (`id`, `id_companie`, `id_client`, `start_date`, `end_date`, `status`, `data_cadastro`, `forma_pagamento`, `status_pagamento`) VALUES
(1, 0, 20, '2020-09-18 08:00:00', '2020-09-18 08:30:00', 'Finalizado', '2020-09-18 22:28:22', '', 'NÃ£o'),
(2, 0, 21, '2020-09-22 08:00:00', '2020-09-22 08:30:00', 'Pendente', '2020-09-21 21:02:22', '', 'NÃ£o'),
(3, 0, 21, '2020-09-24 07:30:00', '2020-09-24 09:00:00', 'Pendente', '2020-09-24 21:29:43', '', 'NÃ£o'),
(4, 0, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Pendente', '2020-09-24 21:33:09', '', 'NÃ£o');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_book_detail`
--

CREATE TABLE IF NOT EXISTS `tb_book_detail` (
`id` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `started_at` datetime NOT NULL,
  `ended_at` datetime NOT NULL,
  `service_name` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `info_extra` varchar(50) NOT NULL,
  `time_block` time NOT NULL,
  `id_quem_executou` varchar(50) NOT NULL,
  `endereco` longtext NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_pacote` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tb_book_detail`
--

INSERT INTO `tb_book_detail` (`id`, `id_booking`, `started_at`, `ended_at`, `service_name`, `price`, `info_extra`, `time_block`, `id_quem_executou`, `endereco`, `id_funcionario`, `id_pacote`) VALUES
(1, 1, '2020-09-18 22:34:13', '2020-09-18 22:35:44', 1, '25.00', '', '00:00:00', '11', '', 11, NULL),
(2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '25.00', '', '00:00:00', '', '', 11, NULL),
(3, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '25.00', '', '00:00:00', '', '', 11, NULL),
(4, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, '25.00', '', '00:00:00', '', '', 4, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_book_func`
--

CREATE TABLE IF NOT EXISTS `tb_book_func` (
`id` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `id_fun` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tb_book_func`
--

INSERT INTO `tb_book_func` (`id`, `id_booking`, `id_fun`) VALUES
(1, 1, 11),
(2, 2, 11),
(3, 3, 11),
(4, 4, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_breeds`
--

CREATE TABLE IF NOT EXISTS `tb_breeds` (
`id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_client`
--

CREATE TABLE IF NOT EXISTS `tb_client` (
`id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` char(1) NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `data_nascimento` date NOT NULL,
  `phone` varchar(45) NOT NULL,
  `phone2` varchar(45) NOT NULL,
  `email` varchar(30) NOT NULL,
  `rg` varchar(45) NOT NULL,
  `zip` varchar(15) NOT NULL,
  `street` varchar(120) NOT NULL,
  `number` int(11) NOT NULL,
  `neighbor` varchar(120) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `city` varchar(120) NOT NULL,
  `state_` varchar(120) NOT NULL,
  `obs` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `lat` varchar(45) NOT NULL,
  `lon` varchar(45) NOT NULL,
  `authToken` varchar(45) NOT NULL,
  `contentEncoding` varchar(45) NOT NULL,
  `endpoint` longtext NOT NULL,
  `publicKey` longtext NOT NULL,
  `token_temp` longtext NOT NULL,
  `pass_temp` varchar(45) NOT NULL,
  `date_pass_temp` datetime NOT NULL,
  `insta_cliente` varchar(45) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Extraindo dados da tabela `tb_client`
--

INSERT INTO `tb_client` (`id`, `id_companie`, `name`, `gender`, `cpf`, `data_nascimento`, `phone`, `phone2`, `email`, `rg`, `zip`, `street`, `number`, `neighbor`, `complemento`, `city`, `state_`, `obs`, `foto`, `data_cadastro`, `lat`, `lon`, `authToken`, `contentEncoding`, `endpoint`, `publicKey`, `token_temp`, `pass_temp`, `date_pass_temp`, `insta_cliente`) VALUES
(1, 0, 'Rafael', '', '', '0000-00-00', '(12) 98888-8888', '', '', '', '12237-821', 'Rua JosÃ© Cobra', 73, 'Palmeiras de SÃ£o JosÃ©', '', 'SÃ£o JosÃ© dos Campos', 'SP', '', '1.jpg', '2020-04-23 10:58:16', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', ''),
(2, 0, 'Gabriel', 'm', '', '0000-00-00', '(11) 11111-1111', '(11) 11111-1111', '', '', '01310-918', 'Avenida Paulista 1708', 0, 'Bela Vista', '', 'SÃ£o Paulo', 'SP', '', '2.jpg', '2020-04-23 14:33:23', '-23.5605324', '-46.6570221', '', '', '', '', '', '', '0000-00-00 00:00:00', ''),
(3, 0, 'Bruno', 'm', '', '0000-00-00', '(11) 11111-1111', '(11) 11111-1111', '', '', '12212-510', 'PraÃ§a Padre JosÃ© RÃºbens Franco Bonafe', 40, 'Alto da Ponte', '', 'SÃ£o JosÃ© dos Campos', 'SP', '', '3.jpg', '2020-04-23 14:50:55', '-23.236577', '-45.859225', '', '', '', '', '', '', '0000-00-00 00:00:00', ''),
(4, 0, 'Pedro', 'f', '', '0000-00-00', '(11) 11111-1111', '(11) 11111-1111', '', '', '01310-918', 'Avenida Paulista 1708', 1225, 'Bela Vista', '', 'SÃ£o Paulo', 'SP', '', '4.jpg', '2020-04-23 16:19:35', '-23.5605324', '-46.6570221', '', '', '', '', '', '', '0000-00-00 00:00:00', ''),
(20, 0, 'Amanda Silva', 'f', '123.132.123-12', '1990-01-01', '(12) 31231-3122', '(12) 31231-3122', 'amanda@amanda.com', '32.132.131-2', '12230-000', 'Avenida AndrÃ´meda', 1, 'Jardim SatÃ©lite', '', 'SÃ£o JosÃ© dos Campos', 'SP', '', '20.jpg', '2020-05-08 18:23:44', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', ''),
(21, 0, 'Almir', '', '', '0000-00-00', '(12) 31231-3122', '', '', '', '', '', 0, '', '', '', '', '', '', '2020-09-18 22:42:19', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_clients_tb`
--

CREATE TABLE IF NOT EXISTS `tb_clients_tb` (
`id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `gender` char(1) NOT NULL,
  `type` varchar(15) NOT NULL,
  `mood` varchar(45) NOT NULL,
  `size` char(1) NOT NULL,
  `cut` varchar(50) NOT NULL,
  `hair` varchar(50) NOT NULL,
  `dt_nasc` date NOT NULL,
  `obs` varchar(200) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `foto` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_comission`
--

CREATE TABLE IF NOT EXISTS `tb_comission` (
`id` int(11) NOT NULL,
  `id_func` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `comission` decimal(10,2) NOT NULL,
  `save_date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_comission`
--

INSERT INTO `tb_comission` (`id`, `id_func`, `id_booking`, `comission`, `save_date`) VALUES
(1, 11, 1, '12.50', '2020-09-18 22:35:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_companie`
--

CREATE TABLE IF NOT EXISTS `tb_companie` (
`id` int(11) NOT NULL,
  `nome_empresa` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `whatsapp` varchar(50) NOT NULL,
  `cnpj` varchar(100) NOT NULL,
  `cep` varchar(15) NOT NULL,
  `endereco` varchar(120) NOT NULL,
  `bairro` varchar(120) NOT NULL,
  `number` int(11) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `info_extra` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `type_companie` varchar(100) NOT NULL,
  `foto` varchar(45) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_companie`
--

INSERT INTO `tb_companie` (`id`, `nome_empresa`, `email`, `phone`, `whatsapp`, `cnpj`, `cep`, `endereco`, `bairro`, `number`, `cidade`, `estado`, `info_extra`, `website`, `facebook`, `instagram`, `type_companie`, `foto`) VALUES
(1, 'Sheila Blue', 'sheilabluenails@yahoo.com.br', '(11) 97772-9338', '(11) 97772-9338', '', '04455-000', 'Rua Orlando Pinto Ribeiro', 'Vila Campo Grande', 0, 'SÃ£o Paulo', 'SP', 'Info Geral aqui', 'SheilaaBlue', 'SheilaaBlue', 'SheilaaBlue', '', 'logo.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_companie_facilities`
--

CREATE TABLE IF NOT EXISTS `tb_companie_facilities` (
`id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_info_adicional_service`
--

CREATE TABLE IF NOT EXISTS `tb_info_adicional_service` (
`id` int(18) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `Info_adicional` text NOT NULL,
  `data_cadastro` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `tb_info_adicional_service`
--

INSERT INTO `tb_info_adicional_service` (`id`, `id_booking`, `Info_adicional`, `data_cadastro`) VALUES
(1, 7, 'cliente alterou a cor', NULL),
(2, 12, 'informo que não tem informações', NULL),
(3, 12, 'tem informação sim brincadeira', NULL),
(4, 17, 'Descontar 5 reais', NULL),
(5, 17, 'cliente quer remarcar', NULL),
(6, 18, 'Cliente quer adicionar barba', NULL),
(7, 19, 'Cliente pediu desconto', NULL),
(8, 19, 'desconto de 10 reais', '2020-09-09 11:32:42'),
(9, 19, 'cliente fico feliz', '2020-09-09 11:36:48'),
(10, 9, 'Quer fazer outras coisas', '2020-09-15 22:30:25'),
(11, 8, 'teste', '2020-09-15 22:31:03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_jornada_trabalho`
--

CREATE TABLE IF NOT EXISTS `tb_jornada_trabalho` (
`id` int(11) NOT NULL,
  `id_func` int(11) NOT NULL,
  `dia_semana` varchar(20) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_termino` time NOT NULL,
  `pausa_incio` time NOT NULL,
  `pausa_final` time NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `tb_jornada_trabalho`
--

INSERT INTO `tb_jornada_trabalho` (`id`, `id_func`, `dia_semana`, `hora_inicio`, `hora_termino`, `pausa_incio`, `pausa_final`) VALUES
(1, 11, '2', '08:00:00', '19:00:00', '12:00:00', '13:00:00'),
(2, 11, '3', '07:00:00', '19:00:00', '00:00:00', '00:00:00'),
(3, 11, '4', '08:00:00', '19:00:00', '00:00:00', '00:00:00'),
(4, 11, '5', '08:00:00', '20:00:00', '00:00:00', '00:00:00'),
(6, 4, '5', '08:00:00', '19:00:00', '12:00:00', '14:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_log_reagendamento`
--

CREATE TABLE IF NOT EXISTS `tb_log_reagendamento` (
`id` int(11) NOT NULL,
  `id_team` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `datatime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mensage`
--

CREATE TABLE IF NOT EXISTS `tb_mensage` (
`IdMensage` int(11) NOT NULL,
  `IdCompanie` int(11) NOT NULL,
  `desc` text NOT NULL,
  `data_cadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_open_times`
--

CREATE TABLE IF NOT EXISTS `tb_open_times` (
`id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `start_at` varchar(50) NOT NULL,
  `end_at` varchar(50) NOT NULL,
  `week_day` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_package`
--

CREATE TABLE IF NOT EXISTS `tb_package` (
`id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_cadastro` date NOT NULL,
  `quantidade_usos` int(11) NOT NULL,
  `foto` varchar(45) NOT NULL,
  `validade` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_package`
--

INSERT INTO `tb_package` (`id`, `nome`, `valor`, `data_cadastro`, `quantidade_usos`, `foto`, `validade`) VALUES
(1, 'Pacote 4 Cortes', '90.00', '2020-09-18', 4, '1.jpg', 30);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_package_client`
--

CREATE TABLE IF NOT EXISTS `tb_package_client` (
`id` int(11) NOT NULL,
  `id_package` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `total_` int(11) NOT NULL,
  `data_compra` datetime NOT NULL,
  `validade` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_package_client`
--

INSERT INTO `tb_package_client` (`id`, `id_package`, `id_cliente`, `id_service`, `status`, `total_`, `data_compra`, `validade`) VALUES
(1, 1, 1, 1, 'Disponivel', 4, '2020-09-18 21:31:06', 30),
(2, 1, 1, 4, 'Disponivel', 4, '2020-09-18 21:31:06', 30);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_package_hist`
--

CREATE TABLE IF NOT EXISTS `tb_package_hist` (
`id` int(11) NOT NULL,
  `id_package_client` int(11) NOT NULL,
  `valor_gasto` decimal(10,2) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_package_service`
--

CREATE TABLE IF NOT EXISTS `tb_package_service` (
`id` int(11) NOT NULL,
  `id_package` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `data_cadastro` date DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_package_service`
--

INSERT INTO `tb_package_service` (`id`, `id_package`, `id_service`, `data_cadastro`) VALUES
(1, 1, 1, '2020-09-18'),
(2, 1, 4, '2020-09-18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_product`
--

CREATE TABLE IF NOT EXISTS `tb_product` (
`id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `desc` varchar(150) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `type` varchar(2) NOT NULL,
  `foto` varchar(10) NOT NULL,
  `qtd` float NOT NULL,
  `validade` date NOT NULL,
  `data_cadastro` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_product`
--

INSERT INTO `tb_product` (`id`, `id_companie`, `desc`, `value`, `type`, `foto`, `qtd`, `validade`, `data_cadastro`) VALUES
(1, 0, 'Gel Modelador', '15.00', 'G', '1.jpg', 249.9, '2020-10-01', '2020-09-16 08:17:47'),
(2, 0, 'Shampoo', '50.00', 'ML', '2.jpg', 250, '2020-12-30', '2020-09-16 08:51:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_product_hist`
--

CREATE TABLE IF NOT EXISTS `tb_product_hist` (
`id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `qtd` int(11) NOT NULL,
  `validade` date NOT NULL,
  `valor` varchar(45) NOT NULL,
  `data_atualizacao` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tb_product_hist`
--

INSERT INTO `tb_product_hist` (`id`, `id_produto`, `id_usuario`, `tipo`, `qtd`, `validade`, `valor`, `data_atualizacao`) VALUES
(1, 1, 1, 'G', 10, '0000-00-00', '10', '2020-09-16 08:38:45'),
(2, 1, 1, 'G', 10, '2020-10-01', '10', '2020-09-16 08:40:19'),
(3, 2, 1, 'ML', 250, '2020-12-30', '50', '2020-09-16 08:51:29'),
(4, 1, 1, 'G', 250, '2020-10-01', '15', '2020-09-18 22:03:09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_prod_shooping`
--

CREATE TABLE IF NOT EXISTS `tb_prod_shooping` (
  `id` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `descricao` text NOT NULL,
  `categoria` varchar(45) DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `qtd` int(11) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `data_update` datetime DEFAULT NULL,
  `alerta_estoque` int(11) DEFAULT NULL,
  `tipo_alerta` int(11) DEFAULT NULL,
  `qrcode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_prod_shooping`
--

INSERT INTO `tb_prod_shooping` (`id`, `titulo`, `descricao`, `categoria`, `preco`, `tipo`, `qtd`, `foto`, `status`, `data_update`, `alerta_estoque`, `tipo_alerta`, `qrcode`) VALUES
(1, 'Tinta para cabelo', 'tinta para cabelo marca top', 'Cabelo', '80.00', 'UN', 40, '1.jpg', NULL, '2020-09-18 11:38:50', NULL, NULL, NULL),
(2, 'Perfume malback', 'perfume para homens fragrância de madeira', 'masculino', '120.00', 'UN', 15, '2.jpg', NULL, '2020-09-18 11:38:12', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_services`
--

CREATE TABLE IF NOT EXISTS `tb_services` (
`id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `short_dec` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `est_time` time NOT NULL,
  `foto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tb_services`
--

INSERT INTO `tb_services` (`id`, `id_companie`, `short_dec`, `price`, `est_time`, `foto`) VALUES
(1, 0, 'Cabelo Masculino', '25.00', '00:30:00', '1.jpg'),
(2, 0, 'PÃ©', '20.00', '00:30:00', '2.jpg'),
(3, 0, 'MÃ£o', '25.00', '00:45:00', '3.jpg'),
(4, 0, 'Barba', '15.00', '00:15:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_service_prod`
--

CREATE TABLE IF NOT EXISTS `tb_service_prod` (
`id` int(11) NOT NULL,
  `id_service` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `qtd` float NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_service_prod`
--

INSERT INTO `tb_service_prod` (`id`, `id_service`, `id_product`, `qtd`) VALUES
(1, 1, 1, 0.05);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_team`
--

CREATE TABLE IF NOT EXISTS `tb_team` (
`id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` char(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `cpf` varchar(50) NOT NULL,
  `rg` varchar(50) NOT NULL,
  `reset_password_token` varchar(50) NOT NULL,
  `reset_password_sent_at` datetime NOT NULL,
  `sign_in_count` int(11) NOT NULL,
  `current_sign_in_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `permission` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `phone2` varchar(45) NOT NULL,
  `picture` varchar(45) NOT NULL,
  `zip` varchar(15) NOT NULL,
  `street` varchar(120) NOT NULL,
  `neighbor` varchar(120) NOT NULL,
  `city` varchar(120) NOT NULL,
  `state_` varchar(120) NOT NULL,
  `number` int(11) NOT NULL,
  `complemento` varchar(125) NOT NULL,
  `info_extra` varchar(120) NOT NULL,
  `born` date NOT NULL,
  `foto` varchar(100) NOT NULL,
  `type` char(1) NOT NULL,
  `comission` int(11) NOT NULL,
  `qr_code` varchar(45) NOT NULL,
  `authToken` longtext CHARACTER SET cp1257 NOT NULL,
  `contentEncoding` longtext NOT NULL,
  `endpoint` varchar(45) NOT NULL,
  `publicKey` varchar(45) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `tb_team`
--

INSERT INTO `tb_team` (`id`, `id_companie`, `name`, `gender`, `email`, `password`, `cpf`, `rg`, `reset_password_token`, `reset_password_sent_at`, `sign_in_count`, `current_sign_in_at`, `created_at`, `updated_at`, `permission`, `status`, `phone`, `phone2`, `picture`, `zip`, `street`, `neighbor`, `city`, `state_`, `number`, `complemento`, `info_extra`, `born`, `foto`, `type`, `comission`, `qr_code`, `authToken`, `contentEncoding`, `endpoint`, `publicKey`) VALUES
(1, 1, 'Administrador', '', 'adm@adm.com', '80bcd1ccdbc687febdb58650ee4e542c', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2020-07-27 13:51:58', 'a', 1, '', '', '', '', '', '', '', '', 0, '', '', '0000-00-00', '1.jpg', 'a', 100, '', 'TEtqsXf6KEb0CrRVSQW32Q==', 'aes128gcm', 'https://fcm.googleapis.com/fcm/send/cUy4oH5Ui', 'BPnXuZLZX4vbDNOngXrt4a6w6YpySoq0EMi1iTraU1z4L'),
(2, 0, 'Sheila Oliveira', '', 'pjsbluenails@gmail.com', '80bcd1ccdbc687febdb58650ee4e542c', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2020-07-27 13:55:16', '2020-07-28 09:00:59', '', 1, '', '', '', '', '', '', '', '', 0, '', '', '0000-00-00', '2.jpg', 'a', 50, '', 'ZOUA+GnQrcGnDgP2Vk0SvQ==', 'aes128gcm', 'https://fcm.googleapis.com/fcm/send/eASNuq8aE', 'BBjNAijwqeZzX0t6fE3/phm8HPGvfNgqvH+VIoO1wqtMl'),
(3, 0, 'Viviane Pacheco', '', 'encantodeusas@gmail.com', '80bcd1ccdbc687febdb58650ee4e542c', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2020-07-27 13:57:10', '2020-07-28 09:01:38', '', 1, '', '', '', '', '', '', '', '', 0, '', '', '0000-00-00', '3.jpg', 'f', 70, '', '3zTJwNF4s4yxthb8V7tCew==', 'aes128gcm', 'https://fcm.googleapis.com/fcm/send/f2yPCZY5X', 'BECW4XhQAEFWarSI+/kgKg/lteDt+CvWCac9EPnpmrXF2'),
(4, 0, 'Carolina Amorim Iwai', 'f', 'carolina.gbn@hotmail.com.br', '80bcd1ccdbc687febdb58650ee4e542c', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2020-07-27 14:29:52', '2020-07-27 14:29:59', '', 0, '', '', '', '', '', '', '', '', 0, '', '', '0000-00-00', '4.jpg', 'f', 50, '', 'kPK0riKjYcLz51FSyogDLw==', 'aes128gcm', 'https://fcm.googleapis.com/fcm/send/cEGApGjBn', 'BL616u4UsnqVhvDKi++KqgfIUbjKCpNaANcwNVR20iAIK'),
(5, 0, 'Kaline Ferreira Silva', '', 'silvakaline2001@gmail.com', '80bcd1ccdbc687febdb58650ee4e542c', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2020-07-27 14:30:29', '2020-07-27 14:41:51', '', 0, '', '', '', '', '', '', '', '', 0, '', '', '0000-00-00', '5.jpg', 'f', 50, '', 'JGV7sr4Vlm0k2UJO5IF1PA==', 'aes128gcm', 'https://fcm.googleapis.com/fcm/send/fb0TY2lyd', 'BLOLwcI78IoCEAfaCDHPDi2VSRmTl00XEgLqkFAAjNAYt'),
(6, 0, 'Rosanny Gomes', '', 'rosannygomes@gmail.com', '80bcd1ccdbc687febdb58650ee4e542c', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2020-07-27 14:31:17', '2020-07-27 14:42:00', '', 0, '', '', '', '', '', '', '', '', 0, '', '', '0000-00-00', '6.jpg', 'f', 70, '', '', '', '', ''),
(7, 0, 'Eliane Scotty', 'f', 'eli.scotti12@gmail.com', '80bcd1ccdbc687febdb58650ee4e542c', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2020-07-27 14:32:10', '2020-07-27 14:32:15', '', 0, '', '', '', '', '', '', '', '', 0, '', '', '0000-00-00', '7.jpg', 'f', 70, '', '', '', '', ''),
(8, 0, 'Karina Parruci', '', 'karinaparruci@gmail.com', '80bcd1ccdbc687febdb58650ee4e542c', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2020-07-27 14:32:58', '2020-08-03 20:43:15', '', 0, '', '', '', '', '', '', '', '', 0, '', '', '0000-00-00', '8.jpg', '', 70, '', '', '', '', ''),
(9, 0, 'Claudia dos Santos da Silva', 'f', 'claudiaph_ph@hotmail.com', '80bcd1ccdbc687febdb58650ee4e542c', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2020-07-27 14:43:16', '2020-07-27 14:43:27', '', 0, '', '', '', '', '', '', '', '', 0, '', '', '0000-00-00', '', 'f', 70, '', '', '', '', ''),
(10, 0, 'Emilio Santos', 'm', 'emilionegruts2007@gmail.com', '80bcd1ccdbc687febdb58650ee4e542c', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2020-07-27 14:44:05', '2020-07-27 14:44:08', '', 0, '', '', '', '', '', '', '', '', 0, '', '', '0000-00-00', '10.jpg', 'f', 50, '', 'KHG6ue4u/XZDRDZT/jQrdw==', 'aes128gcm', 'https://fcm.googleapis.com/fcm/send/fYJMEkGWw', 'BGTsl2WqtBsyETQMeKRggCQ8l1leCyHVl4Go/rGn7ODnK'),
(11, 0, 'Beatriz Kahwage', '', 'biakwg@gmail.com', '80bcd1ccdbc687febdb58650ee4e542c', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2020-07-27 14:44:53', '2020-07-29 12:53:42', '', 0, '', '', '', '', '', '', '', '', 0, '', '', '0000-00-00', '11.jpg', '', 70, '', '', '', '', ''),
(12, 0, 'Jefferson', 'm', 'jefsassa@hotmail.com', '80bcd1ccdbc687febdb58650ee4e542c', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2020-07-27 14:49:52', '2020-07-27 14:50:05', '', 0, '', '', '', '', '', '', '', '', 0, '', '', '0000-00-00', '12.jpg', 'f', 70, '', 'TEtqsXf6KEb0CrRVSQW32Q==', 'aes128gcm', 'https://fcm.googleapis.com/fcm/send/cUy4oH5Ui', 'BPnXuZLZX4vbDNOngXrt4a6w6YpySoq0EMi1iTraU1z4L'),
(13, 0, 'Eliane Santos', 'f', 'eliane.o1957@gmail.com', '80bcd1ccdbc687febdb58650ee4e542c', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2020-07-27 14:50:45', '2020-07-27 14:50:52', '', 0, '', '', '', '', '', '', '', '', 0, '', '', '0000-00-00', '13.jpg', 'f', 70, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_team_service`
--

CREATE TABLE IF NOT EXISTS `tb_team_service` (
`id` int(11) NOT NULL,
  `id_team` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `comission` decimal(10,2) NOT NULL,
  `data_cadastro` date NOT NULL,
  `status` varchar(80) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `tb_team_service`
--

INSERT INTO `tb_team_service` (`id`, `id_team`, `id_service`, `comission`, `data_cadastro`, `status`) VALUES
(1, 11, 1, '50.00', '2020-09-16', ''),
(2, 4, 3, '20.00', '2020-09-18', ''),
(3, 2, 4, '100.00', '2020-09-22', ''),
(4, 2, 1, '100.00', '2020-09-22', ''),
(5, 3, 1, '50.00', '2020-09-22', ''),
(6, 3, 2, '100.00', '2020-09-22', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_user_login`
--

CREATE TABLE IF NOT EXISTS `tb_user_login` (
`id` int(11) NOT NULL,
  `id_usuario` varchar(45) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `ip_city` varchar(45) DEFAULT NULL,
  `date_login` datetime DEFAULT NULL,
  `device_type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Extraindo dados da tabela `tb_user_login`
--

INSERT INTO `tb_user_login` (`id`, `id_usuario`, `ip`, `ip_city`, `date_login`, `device_type`) VALUES
(1, '1', '::1', '', '2020-09-16 14:25:24', NULL),
(2, '1', '::1', '', '2020-09-16 15:12:47', NULL),
(3, '1', '::1', '', '2020-09-16 15:28:06', NULL),
(4, '1', '::1', '', '2020-09-16 21:39:57', NULL),
(5, '1', '::1', '', '2020-09-16 21:46:15', NULL),
(6, '1', '::1', '', '2020-09-16 21:46:44', NULL),
(7, '1', '::1', '', '2020-09-16 21:48:54', NULL),
(8, '1', '::1', '', '2020-09-17 12:09:07', NULL),
(9, '1', '::1', '', '2020-09-18 09:13:23', NULL),
(10, '1', '::1', '', '2020-09-18 16:24:19', NULL),
(11, '1', '::1', '', '2020-09-18 19:32:35', NULL),
(12, '1', '::1', '', '2020-09-18 19:56:57', NULL),
(13, '1', '::1', '', '2020-09-19 15:09:12', NULL),
(14, '1', '::1', '', '2020-09-20 10:15:10', ''),
(15, '1', '::1', '', '2020-09-20 10:16:37', NULL),
(16, '1', '::1', '', '2020-09-20 17:27:25', NULL),
(17, '1', '::1', '', '2020-09-20 17:27:33', ''),
(18, '1', '::1', '', '2020-09-20 18:33:37', ''),
(19, '1', '::1', '', '2020-09-20 18:35:39', ''),
(20, '1', '::1', '', '2020-09-20 19:29:25', NULL),
(21, '1', '::1', '', '2020-09-20 20:45:58', ''),
(22, '1', '::1', '', '2020-09-20 21:33:47', ''),
(23, '1', '::1', '', '2020-09-20 21:43:37', ''),
(24, '1', '::1', '', '2020-09-20 21:58:46', NULL),
(25, '1', '::1', '', '2020-09-21 15:21:14', ''),
(26, '1', '::1', '', '2020-09-21 17:11:50', ''),
(27, '1', '::1', '', '2020-09-21 20:59:08', NULL),
(28, '1', '::1', '', '2020-09-21 21:23:02', ''),
(29, '1', '::1', '', '2020-09-21 21:29:32', NULL),
(30, '1', '::1', '', '2020-09-21 21:38:58', ''),
(31, '1', '::1', '', '2020-09-22 08:56:47', ''),
(32, '1', '::1', '', '2020-09-22 09:58:39', ''),
(33, '1', '::1', '', '2020-09-22 10:53:19', NULL),
(34, '1', '::1', '', '2020-09-22 10:55:21', ''),
(35, '1', '::1', '', '2020-09-22 10:56:10', ''),
(36, '1', '::1', '', '2020-09-22 10:57:09', ''),
(37, '1', '::1', '', '2020-09-22 11:40:23', ''),
(38, '1', '::1', '', '2020-09-22 11:47:33', NULL),
(39, '1', '::1', '', '2020-09-22 11:53:34', ''),
(40, '1', '::1', '', '2020-09-22 12:25:46', ''),
(41, '1', '::1', '', '2020-09-22 18:02:48', ''),
(42, '1', '::1', '', '2020-09-22 18:43:35', ''),
(43, '1', '::1', '', '2020-09-22 21:29:31', ''),
(44, '1', '::1', '', '2020-09-23 20:08:48', NULL),
(45, '1', '::1', '', '2020-09-24 09:19:43', NULL),
(46, '1', '::1', '', '2020-09-24 13:18:59', NULL),
(47, '1', '::1', '', '2020-09-24 21:28:45', NULL),
(48, '1', '::1', '', '2020-09-25 18:50:39', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_variante_prod`
--

CREATE TABLE IF NOT EXISTS `tb_variante_prod` (
  `id` int(11) NOT NULL,
  `id_prod_venda` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `tipo` varchar(7) NOT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_booking`
--
ALTER TABLE `tb_booking`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_book_detail`
--
ALTER TABLE `tb_book_detail`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_book_func`
--
ALTER TABLE `tb_book_func`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_breeds`
--
ALTER TABLE `tb_breeds`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `description` (`description`);

--
-- Indexes for table `tb_client`
--
ALTER TABLE `tb_client`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_clients_tb`
--
ALTER TABLE `tb_clients_tb`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_comission`
--
ALTER TABLE `tb_comission`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_companie`
--
ALTER TABLE `tb_companie`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_companie_facilities`
--
ALTER TABLE `tb_companie_facilities`
 ADD PRIMARY KEY (`id`), ADD KEY `tb_companie_facilities_fk0` (`id_companie`);

--
-- Indexes for table `tb_info_adicional_service`
--
ALTER TABLE `tb_info_adicional_service`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jornada_trabalho`
--
ALTER TABLE `tb_jornada_trabalho`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_log_reagendamento`
--
ALTER TABLE `tb_log_reagendamento`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_mensage`
--
ALTER TABLE `tb_mensage`
 ADD PRIMARY KEY (`IdMensage`);

--
-- Indexes for table `tb_open_times`
--
ALTER TABLE `tb_open_times`
 ADD PRIMARY KEY (`id`), ADD KEY `open_times_fk0` (`id_companie`);

--
-- Indexes for table `tb_package`
--
ALTER TABLE `tb_package`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_package_client`
--
ALTER TABLE `tb_package_client`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_package_hist`
--
ALTER TABLE `tb_package_hist`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_package_service`
--
ALTER TABLE `tb_package_service`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_product_hist`
--
ALTER TABLE `tb_product_hist`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_services`
--
ALTER TABLE `tb_services`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_service_prod`
--
ALTER TABLE `tb_service_prod`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_team`
--
ALTER TABLE `tb_team`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_team_service`
--
ALTER TABLE `tb_team_service`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user_login`
--
ALTER TABLE `tb_user_login`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_booking`
--
ALTER TABLE `tb_booking`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_book_detail`
--
ALTER TABLE `tb_book_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_book_func`
--
ALTER TABLE `tb_book_func`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_breeds`
--
ALTER TABLE `tb_breeds`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_client`
--
ALTER TABLE `tb_client`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tb_clients_tb`
--
ALTER TABLE `tb_clients_tb`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_comission`
--
ALTER TABLE `tb_comission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_companie`
--
ALTER TABLE `tb_companie`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_companie_facilities`
--
ALTER TABLE `tb_companie_facilities`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_info_adicional_service`
--
ALTER TABLE `tb_info_adicional_service`
MODIFY `id` int(18) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_jornada_trabalho`
--
ALTER TABLE `tb_jornada_trabalho`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_log_reagendamento`
--
ALTER TABLE `tb_log_reagendamento`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_mensage`
--
ALTER TABLE `tb_mensage`
MODIFY `IdMensage` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_open_times`
--
ALTER TABLE `tb_open_times`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_package`
--
ALTER TABLE `tb_package`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_package_client`
--
ALTER TABLE `tb_package_client`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_package_hist`
--
ALTER TABLE `tb_package_hist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_package_service`
--
ALTER TABLE `tb_package_service`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_product_hist`
--
ALTER TABLE `tb_product_hist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_services`
--
ALTER TABLE `tb_services`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_service_prod`
--
ALTER TABLE `tb_service_prod`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_team`
--
ALTER TABLE `tb_team`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tb_team_service`
--
ALTER TABLE `tb_team_service`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_user_login`
--
ALTER TABLE `tb_user_login`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
