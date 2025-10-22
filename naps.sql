-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Out-2025 às 15:33
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `naps`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atalhos`
--

CREATE TABLE `atalhos` (
  `codAtalho` int(11) NOT NULL,
  `codModulo` int(11) NOT NULL,
  `codPerfil` int(11) NOT NULL,
  `codOrganizacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `atalhos`
--

INSERT INTO `atalhos` (`codAtalho`, `codModulo`, `codPerfil`, `codOrganizacao`) VALUES
(14, 242, 5, 1),
(20, 239, 2, 1),
(23, 251, 2, 1),
(26, 242, 2, 1),
(27, 256, 2, 1),
(29, 260, 2, 1),
(30, 261, 10, 1),
(31, 260, 10, 1),
(32, 256, 10, 1),
(33, 263, 9, 1),
(34, 258, 9, 1),
(35, 256, 11, 1),
(36, 261, 11, 1),
(37, 262, 11, 1),
(38, 265, 12, 1),
(39, 267, 12, 1),
(40, 268, 12, 1),
(44, 256, 14, 1),
(45, 262, 14, 1),
(47, 256, 13, 1),
(48, 274, 16, 1),
(49, 273, 16, 1),
(50, 275, 16, 1),
(51, 273, 15, 1),
(52, 256, 18, 1),
(53, 279, 2, 1),
(54, 280, 9, 1),
(55, 282, 19, 1),
(56, 276, 10, 1),
(57, 282, 10, 1),
(58, 262, 10, 1),
(59, 264, 10, 1),
(60, 284, 10, 1),
(61, 283, 19, 1),
(62, 279, 20, 1),
(63, 285, 20, 1),
(64, 286, 20, 1),
(65, 287, 20, 1),
(66, 288, 20, 1),
(67, 289, 10, 1),
(69, 291, 19, 1),
(70, 292, 10, 1),
(71, 293, 10, 1),
(73, 296, 12, 1),
(74, 290, 12, 1),
(75, 299, 9, 1),
(76, 300, 9, 1),
(77, 270, 24, 1),
(78, 271, 24, 1),
(80, 306, 25, 1),
(81, 242, 25, 1),
(82, 306, 5, 1),
(83, 302, 26, 1),
(84, 307, 5, 1),
(85, 307, 26, 1),
(86, 303, 26, 1),
(87, 308, 26, 1),
(88, 309, 9, 1),
(89, 303, 27, 1),
(90, 308, 27, 1),
(91, 307, 27, 1),
(92, 302, 27, 1),
(93, 310, 27, 1),
(94, 297, 23, 1),
(95, 300, 23, 1),
(96, 270, 23, 1),
(97, 312, 23, 1),
(98, 271, 23, 1),
(99, 312, 24, 1),
(103, 273, 28, 1),
(106, 292, 28, 1),
(108, 284, 28, 1),
(110, 256, 28, 1),
(111, 295, 28, 1),
(112, 306, 28, 1),
(113, 260, 29, 1),
(114, 256, 29, 1),
(115, 262, 29, 1),
(116, 314, 2, 1),
(117, 314, 11, 1),
(118, 314, 18, 1),
(119, 202, 32, 1),
(120, 213, 32, 1),
(121, 260, 32, 1),
(122, 289, 32, 1),
(123, 203, 32, 1),
(124, 256, 32, 1),
(125, 316, 20, 1),
(126, 319, 20, 1),
(127, 315, 20, 1),
(128, 320, 20, 1),
(129, 321, 20, 1),
(130, 322, 20, 1),
(131, 319, 13, 1),
(132, 323, 20, 1),
(136, 256, 34, 1),
(138, 326, 2, 1),
(141, 329, 9, 1),
(142, 325, 2, 1),
(143, 330, 2, 1),
(144, 19, 1, 21),
(145, 23, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `atendimentos`
--

CREATE TABLE `atendimentos` (
  `codAtendimento` int(11) NOT NULL,
  `codOrganizacao` int(11) NOT NULL,
  `codPaciente` int(11) NOT NULL,
  `dataCriacao` timestamp NULL DEFAULT NULL,
  `dataAtualizacao` timestamp NULL DEFAULT NULL,
  `codStatus` int(11) NOT NULL,
  `codEspecialidade` int(11) DEFAULT NULL,
  `senha` varchar(15) DEFAULT NULL,
  `seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `atendimentos`
--

INSERT INTO `atendimentos` (`codAtendimento`, `codOrganizacao`, `codPaciente`, `dataCriacao`, `dataAtualizacao`, `codStatus`, `codEspecialidade`, `senha`, `seq`) VALUES
(1, 1, 1, '2025-10-22 13:00:00', '2025-10-22 13:19:00', 1, 1, 'CLIN001', 1),
(2, 1, 1, '2025-10-22 13:22:00', '2025-10-22 13:29:00', 3, 3, 'FISIO001', 1),
(3, 1, 13, '2025-10-22 13:22:00', '2025-10-22 13:29:00', 4, 3, 'FISIO002', 2),
(4, 1, 3, '2025-10-22 13:23:00', '2025-10-22 13:23:00', 1, 3, 'FISIO003', 3),
(5, 1, 12, '2025-10-22 13:23:00', '2025-10-22 13:24:00', 4, 3, 'FISIO004', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `atendimentostatus`
--

CREATE TABLE `atendimentostatus` (
  `codStatus` int(11) NOT NULL,
  `status` varchar(40) NOT NULL,
  `botao` varchar(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `atendimentostatus`
--

INSERT INTO `atendimentostatus` (`codStatus`, `status`, `botao`) VALUES
(1, 'Espera', 'secondary'),
(2, 'Em atendimento', 'primary'),
(3, 'Faltou', 'danger'),
(4, 'Atendido', 'success');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `codCargo` int(11) NOT NULL,
  `siglaCargo` varchar(60) NOT NULL,
  `descricaoCargo` varchar(100) NOT NULL,
  `comentario` text NOT NULL,
  `ordenacaoCargo` int(11) NOT NULL,
  `dataCriacao` timestamp NULL DEFAULT NULL,
  `dataAtualizacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`codCargo`, `siglaCargo`, `descricaoCargo`, `comentario`, `ordenacaoCargo`, `dataCriacao`, `dataAtualizacao`) VALUES
(1, 'Mal', 'Marechal', '', 1, NULL, '2022-06-07 12:05:24'),
(2, 'Gen Ex', 'General de Exército', '', 2, NULL, '2022-06-07 12:05:24'),
(3, 'Gen Div', 'General de Divisão', '', 3, NULL, '2022-06-07 12:05:24'),
(4, 'Gen Bda', 'General de Brigada', '', 4, NULL, '2022-06-07 12:05:24'),
(5, 'Cel', 'Coronel', '', 5, NULL, '2022-06-07 12:05:24'),
(6, 'TC', 'Tenente Coronel', '', 6, NULL, '2022-06-07 12:05:24'),
(7, 'Maj', 'Major', '', 7, NULL, '2022-06-07 12:05:24'),
(8, 'Cap', 'Capitão', '', 8, NULL, '2022-06-07 12:05:24'),
(9, '1º Ten', '1º Tenente', '', 9, NULL, '2022-06-07 12:05:24'),
(10, '2º Ten', '2º Tenente', '', 10, NULL, '2022-06-07 12:05:24'),
(11, 'Asp', 'Aspirante', '', 11, NULL, '2022-06-07 12:05:24'),
(12, 'ST', 'Subtenente', '', 12, NULL, '2022-06-07 12:05:24'),
(13, '1º Sgt', '1º Sargento', '', 13, NULL, '2022-06-07 12:05:24'),
(14, '2º Sgt', '2º Sargento', '', 14, NULL, '2022-06-07 12:05:24'),
(15, '3º Sgt', '3º Sargento', '', 15, NULL, '2022-06-07 12:05:24'),
(16, 'CB', 'Cabo', '', 16, NULL, '2022-06-07 12:05:24'),
(17, 'Sd NB', 'Soldado NB', '', 17, NULL, '2022-06-07 12:05:24'),
(18, 'Sd EV', 'Soldado EV', '', 18, NULL, '2022-06-07 12:05:24'),
(19, 'SC', 'Servidor Civil', '', 19, NULL, '2022-06-07 12:05:24'),
(20, 'DEP SC', 'Dependente Serv. Civil', '', 20, '2022-08-27 15:59:40', '2022-08-27 15:59:40'),
(21, 'CV - CIVIL', 'Civil', '', 21, '2022-08-27 15:59:40', '2022-08-27 15:59:40'),
(22, 'Militar MB', 'Militar MB', '', 22, '2022-08-27 15:59:40', '2022-08-27 15:59:40'),
(23, 'Militar FAB', 'Militar FAB', '', 23, '2022-08-27 15:59:40', '2022-08-27 15:59:40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamadasfila`
--

CREATE TABLE `chamadasfila` (
  `codChamada` int(11) NOT NULL,
  `localAssistencia` varchar(100) DEFAULT NULL,
  `dataChamada` timestamp NOT NULL DEFAULT current_timestamp(),
  `codChamador` int(11) NOT NULL,
  `qtdChamadas` int(11) NOT NULL,
  `codPaciente` int(11) NOT NULL,
  `codOrganizacao` int(11) NOT NULL,
  `codEspecialidade` int(11) DEFAULT NULL,
  `codClasseRisco` int(11) NOT NULL DEFAULT 1,
  `codExameLista` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaboradores`
--

CREATE TABLE `colaboradores` (
  `codColaborador` int(11) NOT NULL,
  `codClasse` int(11) NOT NULL DEFAULT 1,
  `codPerfilPadrao` int(11) DEFAULT 1,
  `codOrganizacao` int(11) NOT NULL DEFAULT 3,
  `ordenacao` int(11) DEFAULT NULL,
  `pai` int(11) DEFAULT NULL,
  `conta` varchar(100) DEFAULT NULL,
  `codFuncao` int(11) DEFAULT NULL,
  `codCargo` int(11) DEFAULT NULL,
  `dn` mediumtext DEFAULT NULL,
  `nomeExibicao` varchar(50) DEFAULT NULL,
  `nomeCompleto` varchar(100) DEFAULT NULL,
  `nomePrincipal` varchar(50) DEFAULT NULL,
  `identidade` varchar(15) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `emailFuncional` varchar(40) DEFAULT NULL,
  `emailPessoal` varchar(40) DEFAULT NULL,
  `emailGoogle` varchar(100) DEFAULT NULL,
  `codEspecialidade` int(11) DEFAULT NULL,
  `telefoneTrabalho` varchar(16) DEFAULT NULL,
  `celular` varchar(16) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `aceiteTermos` int(11) DEFAULT NULL,
  `hashTcms` varchar(64) DEFAULT NULL,
  `senha` varchar(256) DEFAULT NULL,
  `dataSenha` timestamp NULL DEFAULT NULL,
  `historicoSenhas` text DEFAULT NULL,
  `ativo` varchar(1) NOT NULL DEFAULT '1',
  `ipRequisitante` varchar(16) DEFAULT NULL,
  `notificado` int(11) NOT NULL DEFAULT 0,
  `dataCriacao` timestamp NULL DEFAULT NULL,
  `dataAtualizacao` timestamp NULL DEFAULT NULL,
  `dataInicioEmpresa` date DEFAULT NULL,
  `dataNascimento` date DEFAULT NULL,
  `codUnidade` int(11) DEFAULT 0,
  `nrEndereco` int(11) DEFAULT NULL,
  `codMunicipioFederacao` int(11) DEFAULT NULL,
  `reservadoSimNao` int(11) DEFAULT NULL,
  `reservadoTexto100` varchar(100) DEFAULT NULL,
  `reservadoNumero` int(11) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `fotoPerfil` varchar(32) DEFAULT NULL,
  `informacoesComplementares` text DEFAULT NULL,
  `senhaResincLDAP` varchar(64) DEFAULT NULL,
  `codMotivoInativo` int(11) DEFAULT NULL,
  `codBen` varchar(14) DEFAULT NULL,
  `codDepartamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `colaboradores`
--

INSERT INTO `colaboradores` (`codColaborador`, `codClasse`, `codPerfilPadrao`, `codOrganizacao`, `ordenacao`, `pai`, `conta`, `codFuncao`, `codCargo`, `dn`, `nomeExibicao`, `nomeCompleto`, `nomePrincipal`, `identidade`, `cpf`, `emailFuncional`, `emailPessoal`, `emailGoogle`, `codEspecialidade`, `telefoneTrabalho`, `celular`, `endereco`, `aceiteTermos`, `hashTcms`, `senha`, `dataSenha`, `historicoSenhas`, `ativo`, `ipRequisitante`, `notificado`, `dataCriacao`, `dataAtualizacao`, `dataInicioEmpresa`, `dataNascimento`, `codUnidade`, `nrEndereco`, `codMunicipioFederacao`, `reservadoSimNao`, `reservadoTexto100`, `reservadoNumero`, `cep`, `fotoPerfil`, `informacoesComplementares`, `senhaResincLDAP`, `codMotivoInativo`, `codBen`, `codDepartamento`) VALUES
(2, 2, 2, 1, NULL, NULL, 'emanuel', NULL, NULL, NULL, 'CAP EMANUEL', 'EMANUEL PEIXOTO VICENTE', 'CAP EMANUEL', '0000', '03164238401', '', 'emanuel@rumoaesfcex.com.br', NULL, NULL, '', '(81) 97900-0000', 'Avenida, Cais do Apolo, 77, Recife - PE', 1, NULL, 'd58b0a80c6cf8eecc8badbcb2f8f8ef0807935642b6f2ce30408c279f132830f', '2025-10-21 23:37:00', '', '1', NULL, 0, '2024-01-10 16:42:09', '2025-10-21 23:37:00', NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'ajRIaHYvV1gzQ0xGMEluVTRyQ0V1UT09OjoKrxlzzkJ1eQ==', NULL, NULL, NULL),
(3, 2, NULL, 1, NULL, NULL, 'recepcao', NULL, NULL, NULL, 'RECEPÇÃO', 'RECEPÇÃO', 'RECEPÇÃO', '0000', '00000000000', '', 'recepcao@7rm.eb.mil.br', NULL, NULL, '2222', '(22) 22222-2222', 'xxxx', 1, NULL, 'fcf1cd79e8113240974a15c1afb2f9ef5116b8ea49129b07a4bb963f37a74bb8', '2025-10-21 23:43:00', '', '1', NULL, 0, '2024-11-14 19:23:59', '2025-10-21 23:43:00', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(4, 2, 2, 30, NULL, NULL, 'cta', NULL, NULL, NULL, '5º CTA', '5CTA', '5º CTA', '0000', '03164238401', '', '5cta@5cta.eb.mil.br', NULL, NULL, '', '(81) 97900-0000', 'Avenida, Cais do Apolo, 77, Recife - PE', 1, NULL, '8e2fcad5215c0caded6f2474f4cb13214e7d687a62a986b4bb957af1f8b02259', '2025-03-12 18:23:00', '', '1', NULL, 0, '2024-01-10 16:42:09', '2025-03-12 18:45:00', NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'ajRIaHYvV1gzQ0xGMEluVTRyQ0V1UT09OjoKrxlzzkJ1eQ==', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamentos`
--

CREATE TABLE `departamentos` (
  `codDepartamento` int(11) NOT NULL,
  `paiDepartamento` int(11) NOT NULL,
  `codOrganizacao` int(11) NOT NULL,
  `descricaoDepartamento` varchar(100) NOT NULL,
  `abreviacaoDepartamento` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ativo` varchar(1) DEFAULT '1',
  `ultimaAlteracao` timestamp NULL DEFAULT current_timestamp(),
  `autorAlteracao` int(11) DEFAULT NULL,
  `codTipoDepartamento` int(11) NOT NULL DEFAULT 1,
  `codTaxaServico` int(11) NOT NULL DEFAULT 1,
  `codTaxaServicoAcompanhante` int(11) NOT NULL DEFAULT 6,
  `seqRequisicao` int(11) DEFAULT NULL,
  `SeqAno` int(11) DEFAULT NULL,
  `codChefe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `departamentos`
--

INSERT INTO `departamentos` (`codDepartamento`, `paiDepartamento`, `codOrganizacao`, `descricaoDepartamento`, `abreviacaoDepartamento`, `telefone`, `email`, `ativo`, `ultimaAlteracao`, `autorAlteracao`, `codTipoDepartamento`, `codTaxaServico`, `codTaxaServicoAcompanhante`, `seqRequisicao`, `SeqAno`, `codChefe`) VALUES
(0, 0, 60210, 'HMAR', 'HMAR', '', '', '0', '2024-07-15 13:43:00', 1601, 3, 1, 6, NULL, NULL, 1722),
(4, 0, 60210, 'CENTRAL DE MATERIAL ESTERILIZADO', 'CME', '', '', '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 26, 2023, 1803),
(5, 0, 60210, 'DIVISÃO DE APOIO ADMINISTRATIVO', 'DAA', '', '', '1', '2024-04-18 11:00:00', 1, 1, 1, 6, NULL, NULL, 1803),
(7, 0, 60210, '2ª UNIDADE DE INTERNAÇÃO', '2UI', '', '', '1', '2024-06-25 11:28:00', 1, 2, 1, 13, NULL, NULL, 1722),
(8, 0, 60210, '3ª UNIDADE DE INTERNAÇÃO', '3UI', '', '', '0', '2022-06-07 12:05:24', 1, 2, 1, 13, NULL, NULL, 1803),
(9, 0, 60210, '4ª UNIDADE DE INTERNAÇÃO', '4UI', '', '', '1', '2024-07-15 13:43:00', 1, 2, 1, 13, NULL, NULL, 1722),
(10, 0, 60210, '5ª UNIDADE DE INTERNAÇÃO', '5UI', '', '', '1', '2024-07-15 13:43:00', 1, 2, 1, 13, 2, 2023, 1722),
(11, 0, 60210, '7ª UNIDADE DE INTERNAÇÃO', '7UI', '', '', '0', '2024-07-15 13:43:00', 1, 2, 1, 13, NULL, NULL, 1722),
(12, 0, 60210, '8ª UNIDADE DE INTERNAÇÃO', '8UI', '', '', '1', '2024-07-15 13:43:00', 1, 2, 1, 13, NULL, NULL, 1722),
(13, 0, 60210, 'POSTO MÉDICO - EMERGÊNCIA', 'PAMO', '', '', '1', '2024-07-15 13:43:00', 1, 3, 1, 6, 2, 2023, 1722),
(14, 0, 60210, 'SEÇÃO DE APROVISIONAMENTO', 'APV', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 182, 2024, 1529),
(15, 0, 60210, 'TECNOLOGIA DA INFORMAÇÃO', 'STI', '', '', '1', '2024-06-20 17:49:00', 1, 1, 1, 6, 44, 2024, 2578),
(16, 0, 60210, 'SEÇÃO DE ANESTESIOLOGIA', 'ANST', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 3, 1, 6, NULL, NULL, NULL),
(17, 0, 60210, 'DIVISÃO DE ENFERMAGEM', 'ENFE', '', '', '1', '2024-03-19 10:45:00', 1, 3, 1, 6, 1, 2023, 1067),
(18, 0, 60210, 'SETOR DE HOTELARIA', 'DIVH', '', '', '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 1, 2023, 1803),
(19, 0, 60210, 'ORDENADOR DE DESPESAS', 'OD', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, NULL, NULL, NULL),
(20, 0, 60210, 'ASSESSORIA JURÍDICA', 'SAJ', '', '', '1', '2022-06-07 12:05:24', 1, 1, 1, 6, NULL, NULL, NULL),
(21, 0, 60210, 'COMUNICAÇÃO SOCIAL', 'SCS', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 1, 2018, NULL),
(22, 0, 60210, 'FARMÁCIA HOSPITALAR', 'FARH', '', '', '1', '2024-09-04 11:56:00', 1, 1, 1, 6, 695, 2024, 2568),
(23, 0, 60210, 'PESSOAL MILITAR - S1', 'S1', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 1, 2023, NULL),
(24, 0, 60210, 'SEGURANÇA ORGÂNICA', 'SSO', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 1, 2023, NULL),
(25, 0, 60210, 'DIVISAO DE MEDICINA', 'DIVM', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 1, 2023, NULL),
(26, 0, 60210, 'ENGENHARIA CLÍNICA', 'ENGC', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, NULL, NULL, NULL),
(27, 0, 60210, 'REGULAÇÃO DO HMAR', 'REGU', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, NULL, NULL, NULL),
(28, 0, 60210, 'CLINICA PEDIATRICA', 'CLIP', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 3, 1, 6, NULL, NULL, NULL),
(29, 0, 60210, 'DIVISÃO DE ENSINO', NULL, NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, NULL, NULL, NULL),
(30, 0, 60210, 'SUPORTE DOCUMENTAL', 'SDOC', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 1, 2023, NULL),
(31, 0, 60210, 'CLÍNICA CIRUGICA', 'CLIC', NULL, NULL, '1', '2024-07-15 13:43:00', 1, 3, 1, 6, 1, 2015, 1722),
(32, 0, 60210, 'CLÍNICA VASCULAR', 'CLIV', NULL, NULL, '1', '2024-07-15 13:43:00', 1, 3, 1, 6, NULL, NULL, 1722),
(33, 0, 60210, 'CLÍNICA MÉDICA', 'CLIM', '', '', '1', '2022-06-07 12:05:24', 1, 3, 1, 6, NULL, NULL, 1166),
(34, 0, 60210, 'PERICIAS MEDICAS', 'SP', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, NULL, NULL, NULL),
(35, 0, 60210, 'SERVIÇOS GERAIS', 'SVG', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, NULL, NULL, NULL),
(36, 0, 60210, 'BLOCO CIRÚGICO', 'BLOCO CIR', '', '', '1', '2022-06-07 12:05:24', 1, 4, 1, 6, 1, 2023, NULL),
(37, 0, 60210, 'CONTAS EXTERNAS', 'CEXT', '', '', '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 1, 2023, NULL),
(38, 0, 60210, 'CONTAS INTERNAS', 'CMI', '', '', '1', '2024-08-26 11:20:00', 1, 1, 1, 6, NULL, NULL, 1722),
(39, 0, 60210, 'CONTAS MÉDICAS', 'CM', '', '', '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 24, 2023, NULL),
(40, 0, 60210, 'SERVIÇO SOCIAL', 'SSS', '', '', '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 1, 2023, NULL),
(41, 0, 60210, 'ENDOCRINOLOGIA', 'ENDC', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, NULL, NULL, NULL),
(42, 0, 60210, 'FISCALIZAÇÃO', 'FADM', NULL, NULL, '1', '2023-10-26 11:42:00', 1, 1, 1, 6, 1, 2023, 1320),
(43, 0, 60210, 'FONOAUDIOLOGIA', 'FONO', '', '', '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 2, 2019, NULL),
(44, 0, 60210, 'NEUROCIRURGIA', 'NEUR', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, NULL, NULL, NULL),
(45, 0, 60210, 'ODONTOCLINICA', 'ODON', '', '', '1', '2024-06-27 13:55:00', 1, 3, 1, 6, 81, 2024, 1361),
(46, 0, 60210, 'PESSOAL CIVIL', 'SPC', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, NULL, NULL, NULL),
(47, 0, 60210, 'ALMOXARIFADO', 'ALMX', '', '', '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 353, 2024, 2314),
(48, 0, 60210, 'CONFORMIDADE', 'SCRG', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 1, 2014, NULL),
(49, 0, 60210, 'DERMATOLOGIA', 'CLID', NULL, NULL, '1', '2024-06-20 11:35:00', 1, 1, 1, 6, NULL, NULL, 1085),
(50, 0, 60210, 'FISIOTERAPIA', 'FSIO', '', '', '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 4, 2018, NULL),
(51, 0, 60210, 'OFTALMOLOGIA', 'OFTA', '', '', '1', '2024-05-02 11:05:00', 1, 3, 1, 6, NULL, NULL, 1376),
(52, 0, 60210, 'POLICLÍNICA', 'POLI', '', '', '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 2, 2023, NULL),
(53, 0, 60210, 'PSIQUIÁTRIA', 'PSIQ', '', '', '1', '2024-02-19 21:22:00', 1, 3, 1, 6, NULL, NULL, 1173),
(54, 0, 60210, '2ª SEÇÃO', 'S2', NULL, NULL, '1', '2024-08-26 11:20:00', 1, 1, 1, 6, 3, 2018, 1722),
(55, 0, 60210, '3ª SEÇÃO', 'S3', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 1, 2019, NULL),
(56, 0, 60210, 'CARDIOLOGIA', 'CARD', NULL, NULL, '1', '2024-07-15 13:45:00', 1, 3, 1, 6, 1, 2019, 2578),
(57, 0, 60210, 'CONTINGENTE', 'CONT', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 6, 2015, NULL),
(58, 0, 60210, 'GINECOLOGIA', 'GINE', '', '', '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 1, 2023, NULL),
(59, 0, 60210, 'LABORATORIO', 'LAC', '', '', '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 103, 2024, NULL),
(60, 0, 60210, 'MATERNIDADE', 'MAT', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 2, 2017, 1085),
(61, 0, 60210, 'PROCTOLOGIA', 'PROC', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 2, 2023, NULL),
(62, 0, 60210, 'ENDOSCOPIA', 'ENDO', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 1, 2023, NULL),
(63, 0, 60210, 'FINANCEIRO', 'SF', '', '', '1', '2024-03-01 15:06:00', 1, 1, 1, 6, 4, 2024, 1739),
(64, 0, 60210, 'LAVANDERIA', 'LAVA', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 1, 2023, NULL),
(65, 0, 60210, 'MASTOLOGIA', 'MAST', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 3, 1, 6, NULL, NULL, NULL),
(66, 0, 60210, 'NUTRIÇÃO', 'NUTR', '', '', '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 73, 2024, 1073),
(67, 0, 60210, 'PSICOLOGIA', 'PSIC', '', '', '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 3, 2023, NULL),
(68, 0, 60210, 'RADIOLOGIA', 'RADI', '', '', '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 1, 2023, NULL),
(69, 0, 60210, 'SECRETARIA', 'SECT', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, NULL, NULL, NULL),
(71, 25, 60210, 'GERIATRIA', 'GERI', '', '', '1', '2022-06-07 12:05:24', 1, 3, 1, 6, NULL, NULL, NULL),
(72, 0, 60210, 'ONCOLOGIA', 'ONCO', '', '', '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 1, 2023, 1085),
(73, 0, 60210, 'ORTOPEDIA', 'ORTO', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 3, 1, 6, NULL, NULL, NULL),
(74, 0, 60210, 'PAGAMENTO', 'PAG', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 2, 2016, NULL),
(75, 0, 60210, 'PATOLOGIA', 'SAP', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 9, 2019, NULL),
(76, 0, 60210, 'PEDIATRIA', 'PED', '', '', '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 2, 2023, NULL),
(77, 0, 60210, 'DIRECÃO', 'DIR', '', '', '1', '2024-03-15 09:55:00', 1, 1, 1, 6, 1, 2023, 2578),
(78, 0, 60210, 'OTORRINO', 'OTO', '', '', '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 1, 2023, 2291),
(80, 0, 60210, 'GASTRO', 'GAST', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 3, 1, 6, NULL, NULL, NULL),
(81, 0, 60210, 'PAASSE', 'CO', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, NULL, NULL, NULL),
(82, 0, 60210, 'FUSEX', 'FUSEX', '', '', '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 1, 2023, NULL),
(83, 0, 60210, 'ABAS', 'ABAS', '', '', '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 1, 2023, 1568),
(84, 0, 60210, 'CCIH', 'CCIH', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 3, 1, 6, NULL, NULL, NULL),
(85, 0, 60210, 'NETI', 'NETI', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 1, 2023, NULL),
(86, 0, 60210, 'SALC', 'SALC', '', '', '1', '2024-05-21 18:24:00', 1, 1, 1, 6, 1, 2023, 2314),
(87, 0, 60210, 'SAME', 'SAME', '', '', '1', '2024-01-02 09:57:00', 1, 3, 1, 6, 1, 2023, 1803),
(88, 0, 60210, 'DUE', 'DUI', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 3, 1, 6, NULL, NULL, NULL),
(89, 0, 60210, 'SETOR DE ATENDIMENTO DOMICILIAR', 'SAD', '', '', '1', '2022-06-07 12:05:24', 1, 2, 1, 13, 1, 2023, NULL),
(92, 0, 60210, 'TRANSPORTE', 'SMT', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 6, 2019, NULL),
(93, 0, 60210, 'UROLOGIA', 'URO', '', '', '1', '2022-06-07 12:05:24', 1, 3, 1, 6, 1, 2023, NULL),
(94, 0, 60210, 'UTI 1', 'UTI 1', '', '', '1', '2022-06-07 12:05:24', 1, 2, 1, 13, 1, 2017, 1803),
(95, 0, 60210, 'ASSESSORIA DE PLANEJAMENTO E GESTÃO', 'APG', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, 56, 2018, NULL),
(98, 0, 60210, 'FARMÁCIA AMBULATORIAL DO EXÉRCITO', 'FAEX', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 1, 1, 6, NULL, NULL, 1164),
(99, 0, 60210, '1ª UNIDADE DE INTERNAÇÃO', '1UI', NULL, NULL, '1', '2022-06-07 12:05:24', 1, 2, 1, 13, 2082, 0, 1803),
(100, 0, 60210, 'UAAC - 7RM', 'UAAC - 7RM', '', '', '1', '2022-06-10 13:23:24', NULL, 3, 1, 6, NULL, NULL, NULL),
(102, 87, 60210, 'NEUROLOGIA', 'NEURO', '', '', '1', '2022-07-19 11:49:47', NULL, 1, 1, 6, 1, 2023, NULL),
(103, 0, 60210, 'OFTALMOLOGIA - DESATIVADO ', 'OFTALMO', '', '', '0', '2024-04-17 18:13:00', NULL, 1, 1, 6, NULL, NULL, 2476),
(104, 0, 60210, 'UTI 2', 'UTI 2', '', '', '1', '2022-09-01 12:20:23', NULL, 2, 1, 13, 2, 2017, 1803),
(105, 0, 60210, 'UTI 3', 'UTI 3', '', '', '0', '2022-09-01 12:20:54', NULL, 2, 1, 0, NULL, NULL, 1803),
(106, 0, 60210, 'UTI 4', 'UTI 4', '', '', '0', '2022-09-01 12:22:26', NULL, 2, 1, 0, NULL, NULL, 1803),
(107, 0, 60210, 'UCE', 'UCE', '', '', '1', '2022-09-01 12:25:40', NULL, 2, 1, 0, NULL, NULL, 1803),
(109, 0, 60210, '10ª UNIDADE DE INTERNAÇÃO', '10UI', '', '', '0', '2022-09-01 13:11:25', NULL, 2, 1, 13, NULL, NULL, 1803),
(110, 0, 60210, '9ª UNIDADE DE INTERNAÇÃO', '9UI', '', '', '1', '2022-09-01 13:11:43', NULL, 2, 1, 13, NULL, NULL, 1803),
(111, 0, 60210, 'UNIDADE DE INTERNAÇÃO HOSPITAL PORTUGUÊS', 'UIHR', '', '', '1', '2023-05-08 01:22:54', NULL, 6, 1, 6, NULL, NULL, NULL),
(112, 0, 60210, 'UNIDADE DE INTERNAÇÃO HOSPITAL ESPERANÇA RECIFE', 'UIHER', '', '', '1', '2023-05-08 04:19:03', NULL, 6, 1, 6, NULL, NULL, NULL),
(113, 0, 60210, 'UNIDADE DE INTERNAÇÃO HOSPITAL ESPERANÇA OLINDA', 'UIHEO', '', '', '1', '2023-05-08 04:19:03', NULL, 6, 1, 6, NULL, NULL, NULL),
(114, 0, 60210, 'UNIDADE DE INTERNAÇÃO HOSPITAL SÃO MARCOS', 'UIHSM', '', '', '1', '2023-05-08 04:19:03', NULL, 6, 1, 6, NULL, NULL, NULL),
(115, 0, 60210, 'UNIDADE DE INTERNAÇÃO HOSPITAL JAIME DA FONTE', 'UIHJF', '', '', '1', '2023-05-08 04:19:03', NULL, 6, 1, 6, NULL, NULL, NULL),
(116, 0, 60210, 'UNIDADE DE INTERNAÇÃO HOSPITAL DE FRATURAS', 'UIHF', '', '', '1', '2023-05-08 04:19:03', NULL, 6, 1, 6, NULL, NULL, NULL),
(117, 0, 60210, 'UNIDADE DE INTERNAÇÃO HOSPITAL DE ÁVILA', 'UIHA', '', '', '1', '2023-05-08 04:19:03', NULL, 6, 1, 6, NULL, NULL, NULL),
(118, 0, 60210, 'SETOR DE ÓRTESES, PRÓTESES E MATERIAIS ESPECIAIS', 'OPME', '', '', '1', '2024-01-15 10:36:00', NULL, 1, 1, 6, 512, 2024, 1223),
(119, 0, 60210, 'CURATIVOS', 'CUR', '', '', '1', '2024-06-25 11:33:00', 1, 3, 1, 6, NULL, NULL, 1722),
(120, 0, 60210, 'AGENCIA TRANSFUSIONAL', 'TRFU', '', '', '1', '2022-06-07 15:05:24', 1, 1, 1, 6, 1, 2019, NULL),
(121, 0, 60210, 'BIBLIOTECA', 'BIB', NULL, NULL, '1', '2022-06-07 15:05:24', 1, 1, 1, 6, NULL, NULL, NULL),
(122, 0, 60210, 'ACUPUNTURA', 'ACU', NULL, NULL, '1', '2022-06-07 15:05:24', 1, 1, 1, 6, 4, 2018, NULL),
(123, 0, 60210, 'SARGENTEAÇÃO', 'SARG', NULL, NULL, '1', '2022-06-07 15:05:24', 1, 1, 1, 6, NULL, NULL, NULL),
(124, 0, 60210, 'SEÇÃO DE SAÚDE', 'SECSAU', '', '', '1', '2022-06-07 15:05:24', 1, 3, 1, 6, NULL, NULL, NULL),
(125, 0, 60210, 'ESCRITÓRIO DA QUALIDADE', 'QUALI', NULL, NULL, '1', '2022-06-07 15:05:24', 1, 1, 1, 6, NULL, NULL, NULL),
(126, 0, 60210, 'AUDITORIA', 'AUD', '', '', '1', '2024-08-30 10:53:00', NULL, 1, 1, 6, NULL, NULL, 1320),
(127, 0, 60210, 'PROGRAMA DE ATENDIMENTO DOMICILIAR - PAD', 'PAD', '', '', '1', '2024-01-25 11:18:09', NULL, 3, 1, 6, NULL, NULL, NULL),
(128, 0, 60210, 'IMAGINOLOGIA ODONTOLÓGICA', 'IMGODONTO', '', '', '1', '2024-02-29 13:38:00', NULL, 3, 1, 6, NULL, NULL, 1361),
(129, 0, 60210, 'AMBULATORIO DA ENFERMAGEM', 'AMBENF', '', '', '1', '2024-06-25 11:28:00', NULL, 2, 1, 6, NULL, NULL, 1722);

-- --------------------------------------------------------

--
-- Estrutura da tabela `especialidades`
--

CREATE TABLE `especialidades` (
  `codEspecialidade` int(11) NOT NULL,
  `especialidade` varchar(100) NOT NULL,
  `sigla` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `especialidades`
--

INSERT INTO `especialidades` (`codEspecialidade`, `especialidade`, `sigla`) VALUES
(1, 'CLÍNICO', 'CLIN'),
(2, 'DENTISTA', 'DENT'),
(3, 'FISIOTERAPIA', 'FISIO'),
(4, 'ORTOPEDISTA', 'ORTO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estadosfederacao`
--

CREATE TABLE `estadosfederacao` (
  `codEstadoFederacao` int(11) NOT NULL,
  `nomeEstadoFederacao` varchar(30) NOT NULL,
  `siglaEstadoFederacao` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estadosfederacao`
--

INSERT INTO `estadosfederacao` (`codEstadoFederacao`, `nomeEstadoFederacao`, `siglaEstadoFederacao`) VALUES
(1, '', 'AC'),
(2, '', 'AL'),
(3, '', 'AM'),
(4, '', 'AP'),
(5, '', 'BA'),
(6, '', 'CE'),
(7, '', 'DF'),
(8, '', 'ES'),
(9, '', 'GO'),
(10, '', 'MA'),
(11, '', 'MG'),
(12, '', 'MS'),
(13, '', 'MT'),
(14, '', 'PA'),
(15, '', 'PB'),
(16, '', 'PE'),
(17, '', 'PI'),
(18, '', 'PR'),
(19, '', 'RJ'),
(20, '', 'RN'),
(21, '', 'RO'),
(22, '', 'RR'),
(23, '', 'RS'),
(24, '', 'SC'),
(25, '', 'SE'),
(26, '', 'SP'),
(27, '', 'TO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `federacoes`
--

CREATE TABLE `federacoes` (
  `codFederacao` int(11) NOT NULL,
  `descricaoFederacao` varchar(100) NOT NULL,
  `servidor` varchar(100) NOT NULL,
  `banco` varchar(120) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `federacoes`
--

INSERT INTO `federacoes` (`codFederacao`, `descricaoFederacao`, `servidor`, `banco`, `login`, `senha`) VALUES
(7, 'Conecta', '10.47.23.75', 'avaliacoes', 'root', '67b43e3462668127d1f3f8fba23ef8e60cd13d39169d6addf08f15529ad81e7d95e7cb65bfc4523832baeb6b4a75a697628de92364ffc653143dbd692c3b8021e2d8e5062ca556b9682fcfe4f464a50dd6559412ff2ea778de64');

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE `logs` (
  `codLog` int(11) NOT NULL,
  `codOrganizacao` int(11) NOT NULL,
  `ocorrencia` varchar(100) NOT NULL,
  `codColaborador` int(11) NOT NULL,
  `dataCriacao` timestamp NULL DEFAULT NULL,
  `ip` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`codLog`, `codOrganizacao`, `ocorrencia`, `codColaborador`, `dataCriacao`, `ip`) VALUES
(0, 21, 'Saiu do sistema', 2, '2024-11-19 09:35:00', '10.47.20.184'),
(1, 1, 'Saiu do sistema', 0, '2024-11-06 11:59:00', '127.0.0.1'),
(2, 1, 'Saiu do sistema', 0, '2024-11-06 11:59:00', '127.0.0.1'),
(3, 1, 'Saiu do sistema', 1, '2024-11-06 12:11:00', '127.0.0.1'),
(4, 0, 'Saiu do sistema', 1, '2024-11-06 12:14:00', '127.0.0.1'),
(5, 0, 'Saiu do sistema', 1, '2024-11-06 12:17:00', '127.0.0.1'),
(6, 3, 'Saiu do sistema', 1, '2024-11-06 12:18:00', '127.0.0.1'),
(7, 1, 'Saiu do sistema', 1, '2024-11-06 12:22:00', '127.0.0.1'),
(8, 1, 'Login Sucesso', 2, '2024-11-06 17:57:00', '127.0.0.1'),
(9, 1, 'Login Sucesso', 2, '2024-11-06 18:04:00', '127.0.0.1'),
(10, 1, 'Login Sucesso', 2, '2024-11-06 18:04:00', '127.0.0.1'),
(11, 1, 'Login Sucesso', 2, '2024-11-06 18:04:00', '127.0.0.1'),
(12, 1, 'Falha no Login', 2, '2024-11-06 18:07:00', '127.0.0.1'),
(13, 1, 'Saiu do sistema', 0, '2024-11-06 18:11:00', '127.0.0.1'),
(14, 1, 'Saiu do sistema', 0, '2024-11-06 18:12:00', '127.0.0.1'),
(15, 1, 'Login Sucesso', 2, '2024-11-06 18:12:00', '127.0.0.1'),
(16, 1, 'Saiu do sistema', 0, '2024-11-06 18:12:00', '127.0.0.1'),
(17, 1, 'Login Sucesso', 2, '2024-11-06 18:15:00', '127.0.0.1'),
(18, 1, 'Saiu do sistema', 0, '2024-11-06 18:15:00', '127.0.0.1'),
(19, 1, 'Login Sucesso', 2, '2024-11-06 18:19:00', '127.0.0.1'),
(20, 1, 'Falha no Login', 2, '2024-11-06 18:23:00', '127.0.0.1'),
(21, 1, 'Login Sucesso', 2, '2024-11-06 18:23:00', '127.0.0.1'),
(22, 1, 'Falha no Login', 2, '2024-11-06 18:37:00', '127.0.0.1'),
(23, 1, 'Falha no Login', 2, '2024-11-06 18:38:00', '127.0.0.1'),
(24, 1, 'Login Sucesso', 2, '2024-11-06 18:38:00', '127.0.0.1'),
(25, 1, 'Saiu do sistema', 0, '2024-11-06 18:39:00', '127.0.0.1'),
(26, 1, 'Saiu do sistema', 0, '2024-11-06 18:39:00', '127.0.0.1'),
(27, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(28, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(29, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(30, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(31, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(32, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(33, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(34, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(35, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(36, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(37, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(38, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(39, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(40, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(41, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(42, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(43, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(44, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(45, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(46, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(47, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(48, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(49, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(50, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(51, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(52, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(53, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(54, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(55, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(56, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(57, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(58, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(59, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(60, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(61, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(62, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(63, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(64, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(65, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(66, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(67, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(68, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(69, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(70, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(71, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(72, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(73, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(74, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(75, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(76, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(77, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(78, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(79, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(80, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(81, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(82, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(83, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(84, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(85, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(86, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(87, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(88, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(89, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(90, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(91, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(92, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(93, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(94, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(95, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(96, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(97, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(98, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(99, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(100, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(101, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(102, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(103, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(104, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(105, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(106, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(107, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(108, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(109, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(110, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(111, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(112, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(113, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(114, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(115, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(116, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(117, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(118, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(119, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(120, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(121, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(122, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(123, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(124, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(125, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(126, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(127, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(128, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(129, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(130, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(131, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(132, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(133, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(134, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(135, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(136, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(137, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(138, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(139, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(140, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(141, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(142, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(143, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(144, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(145, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(146, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(147, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(148, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(149, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(150, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(151, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(152, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(153, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(154, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(155, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(156, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(157, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(158, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(159, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(160, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(161, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(162, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(163, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(164, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(165, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(166, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(167, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(168, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(169, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(170, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(171, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(172, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(173, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(174, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(175, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(176, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(177, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(178, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(179, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(180, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(181, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(182, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(183, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(184, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(185, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(186, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(187, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(188, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(189, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(190, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(191, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(192, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(193, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(194, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(195, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(196, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(197, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(198, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(199, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(200, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(201, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(202, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(203, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(204, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(205, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(206, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(207, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(208, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(209, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(210, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(211, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(212, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(213, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(214, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(215, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(216, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(217, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(218, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(219, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(220, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(221, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(222, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(223, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(224, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(225, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(226, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(227, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(228, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(229, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(230, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(231, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(232, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(233, 1, 'Saiu do sistema', 0, '2024-11-06 18:40:00', '127.0.0.1'),
(234, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(235, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(236, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(237, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(238, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(239, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(240, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(241, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(242, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(243, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(244, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(245, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(246, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(247, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(248, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(249, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(250, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(251, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(252, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(253, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(254, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(255, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(256, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(257, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(258, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(259, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(260, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(261, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(262, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(263, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(264, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(265, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(266, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(267, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(268, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(269, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(270, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(271, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(272, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(273, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(274, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(275, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(276, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(277, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(278, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(279, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(280, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(281, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(282, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(283, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(284, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(285, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(286, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(287, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(288, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(289, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(290, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(291, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(292, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(293, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(294, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(295, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(296, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(297, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(298, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(299, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(300, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(301, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(302, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(303, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(304, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(305, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(306, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(307, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(308, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(309, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(310, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(311, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(312, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(313, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(314, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(315, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(316, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(317, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(318, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(319, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(320, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(321, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(322, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(323, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(324, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(325, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(326, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(327, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(328, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(329, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(330, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(331, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(332, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(333, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(334, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(335, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(336, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(337, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(338, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(339, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(340, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(341, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(342, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(343, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(344, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(345, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(346, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(347, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(348, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(349, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(350, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(351, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(352, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(353, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(354, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(355, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(356, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(357, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(358, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(359, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(360, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(361, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(362, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(363, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(364, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(365, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(366, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(367, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(368, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(369, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(370, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(371, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(372, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(373, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(374, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(375, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(376, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(377, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(378, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(379, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(380, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(381, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(382, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(383, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(384, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(385, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(386, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(387, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(388, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(389, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(390, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(391, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(392, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(393, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(394, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(395, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(396, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(397, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(398, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(399, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(400, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(401, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(402, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(403, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(404, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(405, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(406, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(407, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(408, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(409, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(410, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(411, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(412, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(413, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(414, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(415, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(416, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(417, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(418, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(419, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(420, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(421, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(422, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(423, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(424, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(425, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(426, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(427, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(428, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(429, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(430, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(431, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(432, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(433, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(434, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(435, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(436, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(437, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(438, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(439, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(440, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(441, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(442, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(443, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(444, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(445, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(446, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(447, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(448, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(449, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(450, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(451, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(452, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(453, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(454, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(455, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(456, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(457, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(458, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(459, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(460, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(461, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(462, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(463, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(464, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(465, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(466, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(467, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(468, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(469, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(470, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(471, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(472, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(473, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(474, 1, 'Saiu do sistema', 0, '2024-11-06 18:41:00', '127.0.0.1'),
(475, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(476, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(477, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(478, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(479, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(480, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(481, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(482, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(483, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(484, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(485, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(486, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(487, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(488, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(489, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(490, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(491, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(492, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(493, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(494, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(495, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(496, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(497, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(498, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(499, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(500, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(501, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(502, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(503, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(504, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(505, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(506, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(507, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(508, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(509, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(510, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(511, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(512, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(513, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(514, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(515, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(516, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(517, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(518, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(519, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(520, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(521, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(522, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(523, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(524, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(525, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(526, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(527, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(528, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(529, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(530, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(531, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(532, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(533, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(534, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(535, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(536, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(537, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(538, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(539, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(540, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(541, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(542, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(543, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(544, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(545, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(546, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(547, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(548, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(549, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(550, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(551, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(552, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(553, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(554, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(555, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(556, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(557, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(558, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(559, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(560, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(561, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(562, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(563, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(564, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(565, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(566, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(567, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(568, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(569, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(570, 1, 'Saiu do sistema', 0, '2024-11-06 18:42:00', '127.0.0.1'),
(571, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(572, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(573, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(574, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(575, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(576, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(577, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(578, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(579, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(580, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(581, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(582, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(583, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(584, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(585, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(586, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(587, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(588, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(589, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(590, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(591, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(592, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(593, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(594, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(595, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(596, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(597, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(598, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(599, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(600, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(601, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(602, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(603, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(604, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(605, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(606, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(607, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(608, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(609, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(610, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(611, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(612, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(613, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(614, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(615, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(616, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(617, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(618, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(619, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(620, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(621, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(622, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(623, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(624, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(625, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(626, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(627, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(628, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(629, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(630, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(631, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(632, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(633, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(634, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(635, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(636, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(637, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(638, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(639, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(640, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(641, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(642, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(643, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(644, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(645, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(646, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(647, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(648, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(649, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(650, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(651, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(652, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(653, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(654, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(655, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(656, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(657, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(658, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(659, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(660, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(661, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(662, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(663, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(664, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(665, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(666, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(667, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(668, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(669, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(670, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(671, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(672, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(673, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(674, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(675, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(676, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(677, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(678, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(679, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(680, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(681, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(682, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(683, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(684, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(685, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(686, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(687, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(688, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(689, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(690, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(691, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(692, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(693, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(694, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(695, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(696, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(697, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(698, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(699, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(700, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(701, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(702, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(703, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(704, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(705, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(706, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(707, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(708, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(709, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(710, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(711, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(712, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(713, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(714, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(715, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(716, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(717, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(718, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(719, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(720, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(721, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(722, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(723, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(724, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(725, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(726, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(727, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(728, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(729, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(730, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(731, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(732, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(733, 1, 'Saiu do sistema', 0, '2024-11-06 18:43:00', '127.0.0.1'),
(734, 1, 'Saiu do sistema', 0, '2024-11-06 18:47:00', '127.0.0.1'),
(735, 1, 'Login Sucesso', 2, '2024-11-06 19:00:00', '127.0.0.1'),
(736, 1, 'Saiu do sistema', 0, '2024-11-07 10:06:00', '127.0.0.1'),
(737, 1, 'Login Sucesso', 2, '2024-11-07 10:06:00', '127.0.0.1'),
(738, 1, 'Saiu do sistema', 2, '2024-11-07 10:12:00', '127.0.0.1'),
(739, 1, 'Saiu do sistema', 0, '2024-11-07 10:12:00', '127.0.0.1'),
(740, 1, 'Login Sucesso', 2, '2024-11-07 10:13:00', '127.0.0.1'),
(741, 1, 'Saiu do sistema', 2, '2024-11-07 11:29:00', '127.0.0.1'),
(742, 1, 'Login Sucesso', 2, '2024-11-07 11:30:00', '127.0.0.1'),
(743, 1, 'Saiu do sistema', 2, '2024-11-07 13:49:00', '127.0.0.1'),
(744, 1, 'Login Sucesso', 2, '2024-11-07 13:49:00', '127.0.0.1'),
(745, 1, 'Saiu do sistema', 0, '2024-11-07 17:12:00', '127.0.0.1'),
(746, 1, 'Login Sucesso', 2, '2024-11-07 17:26:00', '127.0.0.1'),
(747, 1, 'Saiu do sistema', 2, '2024-11-07 17:26:00', '127.0.0.1'),
(748, 1, 'Saiu do sistema', 0, '2024-11-07 17:27:00', '127.0.0.1'),
(749, 1, 'Saiu do sistema', 0, '2024-11-07 17:47:00', '127.0.0.1'),
(750, 1, 'Saiu do sistema', 0, '2024-11-07 17:48:00', '127.0.0.1'),
(751, 1, 'Login Sucesso', 2, '2024-11-07 17:48:00', '127.0.0.1'),
(752, 1, 'Saiu do sistema', 2, '2024-11-07 17:49:00', '127.0.0.1'),
(753, 1, 'Saiu do sistema', 0, '2024-11-07 17:49:00', '127.0.0.1'),
(754, 1, 'Saiu do sistema', 0, '2024-11-08 11:42:00', '::1'),
(755, 1, 'Login Sucesso', 2, '2024-11-08 11:47:00', '::1'),
(756, 1, 'Saiu do sistema', 2, '2024-11-08 13:31:00', '::1'),
(757, 1, 'Saiu do sistema', 0, '2024-11-08 13:39:00', '::1');
INSERT INTO `logs` (`codLog`, `codOrganizacao`, `ocorrencia`, `codColaborador`, `dataCriacao`, `ip`) VALUES
(758, 1, 'Login Sucesso', 2, '2024-11-08 13:40:00', '::1'),
(759, 1, 'Saiu do sistema', 0, '2024-11-11 12:59:00', '::1'),
(760, 1, 'Saiu do sistema', 0, '2024-11-11 13:34:00', '::1'),
(761, 1, 'Saiu do sistema', 0, '2024-11-11 13:42:00', '::1'),
(762, 1, 'Saiu do sistema', 0, '2024-11-11 14:17:00', '::1'),
(763, 1, 'Saiu do sistema', 0, '2024-11-11 14:50:00', '::1'),
(764, 1, 'Login Sucesso', 2, '2024-11-11 14:50:00', '::1'),
(765, 1, 'Saiu do sistema', 0, '2024-11-12 10:08:00', '::1'),
(766, 1, 'Login Sucesso', 2, '2024-11-13 10:23:00', '::1'),
(767, 1, 'Saiu do sistema', 2, '2024-11-13 12:00:00', '::1'),
(768, 1, 'Login Sucesso', 2, '2024-11-13 12:04:00', '::1'),
(769, 1, 'Saiu do sistema', 0, '2024-11-13 16:05:00', '::1'),
(770, 1, 'Saiu do sistema', 0, '2024-11-13 16:05:00', '::1'),
(771, 1, 'Saiu do sistema', 0, '2024-11-13 16:05:00', '::1'),
(772, 1, 'Login Sucesso', 2, '2024-11-13 16:06:00', '::1'),
(773, 1, 'Saiu do sistema', 2, '2024-11-13 16:08:00', '::1'),
(774, 1, 'Login Sucesso', 2, '2024-11-13 16:08:00', '::1'),
(775, 1, 'Saiu do sistema', 2, '2024-11-13 16:11:00', '::1'),
(776, 1, 'Login Sucesso', 2, '2024-11-13 16:18:00', '::1'),
(777, 1, 'Saiu do sistema', 2, '2024-11-13 16:19:00', '::1'),
(778, 1, 'Login Sucesso', 2, '2024-11-13 16:19:00', '::1'),
(779, 1, 'Saiu do sistema', 2, '2024-11-13 16:19:00', '::1'),
(780, 1, 'Login Sucesso', 2, '2024-11-13 16:28:00', '::1'),
(781, 1, 'Saiu do sistema', 2, '2024-11-13 16:28:00', '::1'),
(782, 1, 'Login Sucesso', 2, '2024-11-13 16:28:00', '::1'),
(783, 1, 'Saiu do sistema', 2, '2024-11-13 16:32:00', '::1'),
(784, 1, 'Login Sucesso', 2, '2024-11-13 16:33:00', '::1'),
(785, 1, 'Saiu do sistema', 2, '2024-11-13 16:39:00', '::1'),
(786, 1, 'Login Sucesso', 2, '2024-11-13 16:42:00', '::1'),
(787, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:45:00', '::1'),
(788, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:47:00', '::1'),
(789, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:48:00', '::1'),
(790, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:48:00', '::1'),
(791, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:50:00', '::1'),
(792, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:50:00', '::1'),
(793, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:50:00', '::1'),
(794, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:50:00', '::1'),
(795, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:50:00', '::1'),
(796, 1, 'Saiu do sistema', 2, '2024-11-13 16:50:00', '::1'),
(797, 1, 'Login Sucesso', 2, '2024-11-13 16:50:00', '::1'),
(798, 1, 'Saiu do sistema', 2, '2024-11-13 16:51:00', '::1'),
(799, 1, 'Login Sucesso', 2, '2024-11-13 16:51:00', '::1'),
(800, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:51:00', '::1'),
(801, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:53:00', '::1'),
(802, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:53:00', '::1'),
(803, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:54:00', '::1'),
(804, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:54:00', '::1'),
(805, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:54:00', '::1'),
(806, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:54:00', '::1'),
(807, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:54:00', '::1'),
(808, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:54:00', '::1'),
(809, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:54:00', '::1'),
(810, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:54:00', '::1'),
(811, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:54:00', '::1'),
(812, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:54:00', '::1'),
(813, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:54:00', '::1'),
(814, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:54:00', '::1'),
(815, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:54:00', '::1'),
(816, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:54:00', '::1'),
(817, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:55:00', '::1'),
(818, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:58:00', '::1'),
(819, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:58:00', '::1'),
(820, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:58:00', '::1'),
(821, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 16:58:00', '::1'),
(822, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 17:12:00', '::1'),
(823, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 17:16:00', '::1'),
(824, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 17:17:00', '::1'),
(825, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 17:17:00', '::1'),
(826, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 17:17:00', '::1'),
(827, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 17:19:00', '::1'),
(828, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 17:20:00', '::1'),
(829, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 17:20:00', '::1'),
(830, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 17:21:00', '::1'),
(831, 1, 'Saiu do sistema', 0, '2024-11-13 17:40:00', '::1'),
(832, 1, 'Login Sucesso', 2, '2024-11-13 17:40:00', '::1'),
(833, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 17:48:00', '::1'),
(834, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 17:48:00', '::1'),
(835, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 17:48:00', '::1'),
(836, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 17:48:00', '::1'),
(837, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 17:49:00', '::1'),
(838, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 17:49:00', '::1'),
(839, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 17:49:00', '::1'),
(840, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 17:49:00', '::1'),
(841, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 17:58:00', '::1'),
(842, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 18:08:00', '::1'),
(843, 1, 'Saiu do sistema', 2, '2024-11-13 18:08:00', '::1'),
(844, 1, 'Login Sucesso', 2, '2024-11-13 18:08:00', '::1'),
(845, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 18:08:00', '::1'),
(846, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:09:00', '::1'),
(847, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:10:00', '::1'),
(848, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:10:00', '::1'),
(849, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:10:00', '::1'),
(850, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:10:00', '::1'),
(851, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:10:00', '::1'),
(852, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:10:00', '::1'),
(853, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:10:00', '::1'),
(854, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:10:00', '::1'),
(855, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:10:00', '::1'),
(856, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:10:00', '::1'),
(857, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:10:00', '::1'),
(858, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:10:00', '::1'),
(859, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:10:00', '::1'),
(860, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:10:00', '::1'),
(861, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:12:00', '::1'),
(862, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 18:13:00', '::1'),
(863, 1, 'Saiu do sistema', 2, '2024-11-13 18:14:00', '::1'),
(864, 1, 'Login Sucesso', 2, '2024-11-13 18:14:00', '::1'),
(865, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 18:15:00', '::1'),
(866, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 18:15:00', '::1'),
(867, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 18:15:00', '::1'),
(868, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 18:15:00', '::1'),
(869, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 18:15:00', '::1'),
(870, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 18:15:00', '::1'),
(871, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 18:15:00', '::1'),
(872, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:15:00', '::1'),
(873, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:15:00', '::1'),
(874, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-13 18:15:00', '::1'),
(875, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 18:53:00', '::1'),
(876, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:17:00', '::1'),
(877, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:23:00', '::1'),
(878, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:23:00', '::1'),
(879, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:23:00', '::1'),
(880, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:24:00', '::1'),
(881, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:24:00', '::1'),
(882, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:24:00', '::1'),
(883, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:24:00', '::1'),
(884, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:24:00', '::1'),
(885, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:24:00', '::1'),
(886, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:24:00', '::1'),
(887, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 19:27:00', '::1'),
(888, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-13 19:27:00', '::1'),
(889, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:28:00', '::1'),
(890, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:34:00', '::1'),
(891, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:34:00', '::1'),
(892, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:34:00', '::1'),
(893, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:34:00', '::1'),
(894, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:34:00', '::1'),
(895, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:34:00', '::1'),
(896, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:34:00', '::1'),
(897, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:34:00', '::1'),
(898, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:34:00', '::1'),
(899, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:34:00', '::1'),
(900, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:34:00', '::1'),
(901, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:34:00', '::1'),
(902, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:34:00', '::1'),
(903, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:36:00', '::1'),
(904, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:36:00', '::1'),
(905, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:36:00', '::1'),
(906, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:36:00', '::1'),
(907, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:38:00', '::1'),
(908, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:38:00', '::1'),
(909, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:38:00', '::1'),
(910, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:39:00', '::1'),
(911, 1, 'Acesso indevido ao Módulo Teste', 2, '2024-11-13 19:39:00', '::1'),
(912, 1, 'Saiu do sistema', 2, '2024-11-14 10:16:00', '::1'),
(913, 1, 'Saiu do sistema', 0, '2024-11-14 10:47:00', '::1'),
(914, 1, 'Login Sucesso', 2, '2024-11-14 10:47:00', '::1'),
(915, 3, 'Saiu do sistema', 2, '2024-11-14 11:09:00', '::1'),
(916, 1, 'Login Sucesso', 2, '2024-11-14 11:09:00', '::1'),
(917, 25, 'Saiu do sistema', 2, '2024-11-14 13:20:00', '::1'),
(918, 1, 'Login Sucesso', 2, '2024-11-14 13:20:00', '::1'),
(919, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 13:21:00', '::1'),
(920, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 13:21:00', '::1'),
(921, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 13:21:00', '::1'),
(922, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 13:21:00', '::1'),
(923, 1, 'Saiu do sistema', 2, '2024-11-14 13:59:00', '::1'),
(924, 1, 'Login Sucesso', 2, '2024-11-14 13:59:00', '::1'),
(925, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-14 14:00:00', '::1'),
(926, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-14 14:01:00', '::1'),
(927, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-14 14:04:00', '::1'),
(928, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-14 14:04:00', '::1'),
(929, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-14 14:04:00', '::1'),
(930, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-14 14:04:00', '::1'),
(931, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-14 14:04:00', '::1'),
(932, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-14 14:04:00', '::1'),
(933, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-14 14:05:00', '::1'),
(934, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-14 14:28:00', '::1'),
(935, 1, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-14 14:29:00', '::1'),
(936, 41, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-14 14:31:00', '::1'),
(937, 41, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-14 14:31:00', '::1'),
(938, 41, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-14 14:31:00', '::1'),
(939, 41, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-14 14:31:00', '::1'),
(940, 41, 'Acesso indevido ao Módulo Modulos', 0, '2024-11-14 14:31:00', '::1'),
(941, 41, 'Saiu do sistema', 2, '2024-11-14 14:31:00', '::1'),
(942, 1, 'Login Sucesso', 2, '2024-11-14 14:31:00', '::1'),
(943, 1, 'Saiu do sistema', 2, '2024-11-14 14:32:00', '::1'),
(944, 1, 'Login Sucesso', 2, '2024-11-14 14:32:00', '::1'),
(945, 1, 'Saiu do sistema', 2, '2024-11-14 14:33:00', '::1'),
(946, 1, 'Login Sucesso', 2, '2024-11-14 14:33:00', '::1'),
(947, 1, 'Saiu do sistema', 2, '2024-11-14 14:33:00', '::1'),
(948, 1, 'Saiu do sistema', 0, '2024-11-14 14:37:00', '::1'),
(949, 1, 'Login Sucesso', 2, '2024-11-14 14:39:00', '::1'),
(950, 1, 'Saiu do sistema', 2, '2024-11-14 14:39:00', '::1'),
(951, 1, 'Login Sucesso', 2, '2024-11-14 14:40:00', '::1'),
(952, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 14:44:00', '::1'),
(953, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 15:04:00', '::1'),
(954, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 15:05:00', '::1'),
(955, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 15:05:00', '::1'),
(956, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 15:05:00', '::1'),
(957, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 15:05:00', '::1'),
(958, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 15:05:00', '::1'),
(959, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 15:05:00', '::1'),
(960, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 15:05:00', '::1'),
(961, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 15:07:00', '::1'),
(962, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 15:07:00', '::1'),
(963, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 15:07:00', '::1'),
(964, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 15:07:00', '::1'),
(965, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 15:07:00', '::1'),
(966, 1, 'Saiu do sistema', 2, '2024-11-14 15:07:00', '::1'),
(967, 1, 'Login Sucesso', 2, '2024-11-14 15:07:00', '::1'),
(968, 1, 'Acesso indevido ao Módulo Perfis', 2, '2024-11-14 16:14:00', '::1'),
(969, 1, 'Saiu do sistema', 2, '2024-11-14 16:14:00', '::1'),
(970, 1, 'Login Sucesso', 2, '2024-11-14 16:14:00', '::1'),
(971, 56, 'Acesso indevido ao Módulo Teste', 2, '2024-11-14 16:34:00', '::1'),
(972, 1, 'Login Sucesso', 2, '2024-11-14 17:01:00', '::1'),
(973, 1, 'Saiu do sistema', 2, '2024-11-14 17:01:00', '::1'),
(974, 1, 'Login Sucesso', 2, '2024-11-14 17:01:00', '::1'),
(975, 1, 'Saiu do sistema', 2, '2024-11-14 17:02:00', '::1'),
(976, 1, 'Login Sucesso', 2, '2024-11-14 17:02:00', '::1'),
(977, 1, 'Saiu do sistema', 2, '2024-11-14 17:02:00', '::1'),
(978, 1, 'Login Sucesso', 2, '2024-11-14 17:02:00', '::1'),
(979, 1, 'Saiu do sistema', 2, '2024-11-14 17:04:00', '::1'),
(980, 1, 'Login Sucesso', 2, '2024-11-14 17:04:00', '::1'),
(981, 1, 'Saiu do sistema', 2, '2024-11-14 17:21:00', '::1'),
(982, 21, 'Login Sucesso', 2, '2024-11-14 17:41:00', '::1'),
(983, 21, 'Saiu do sistema', 2, '2024-11-14 17:43:00', '::1'),
(984, 21, 'Login Sucesso', 2, '2024-11-14 17:43:00', '::1'),
(985, 21, 'Saiu do sistema', 2, '2024-11-14 17:47:00', '::1'),
(986, 36, 'Login Sucesso', 2, '2024-11-14 17:48:00', '::1'),
(987, 36, 'Saiu do sistema', 2, '2024-11-14 17:51:00', '::1'),
(988, 36, 'Login Sucesso', 2, '2024-11-14 17:52:00', '::1'),
(989, 36, 'Saiu do sistema', 2, '2024-11-14 17:52:00', '::1'),
(990, 21, 'Login Sucesso', 2, '2024-11-14 17:54:00', '::1'),
(991, 1, 'Saiu do sistema', 0, '2024-11-18 12:21:00', '::1'),
(992, 21, 'Login Sucesso', 2, '2024-11-18 12:23:00', '::1'),
(993, 21, 'Saiu do sistema', 2, '2024-11-18 12:34:00', '::1'),
(994, 21, 'Login Sucesso', 2, '2024-11-18 12:41:00', '::1'),
(995, 21, 'Acesso indevido ao Módulo \"Federacoes\"', 2, '2024-11-18 12:59:00', '::1'),
(996, 21, 'Acesso indevido ao Módulo \"Federacoes\"', 2, '2024-11-18 13:00:00', '::1'),
(997, 21, 'Acesso indevido ao Módulo \"Federacoes\"', 2, '2024-11-18 13:00:00', '::1'),
(998, 21, 'Saiu do sistema', 2, '2024-11-18 13:00:00', '::1'),
(999, 57, 'Login Sucesso', 2, '2024-11-18 13:01:00', '::1'),
(1000, 57, 'Acesso indevido ao Módulo Rotinas', 2, '2024-11-18 13:27:00', '::1'),
(1001, 57, 'Saiu do sistema', 2, '2024-11-18 13:27:00', '::1'),
(1002, 57, 'Login Sucesso', 2, '2024-11-18 13:27:00', '::1'),
(1003, 57, 'Saiu do sistema', 2, '2024-11-18 18:17:00', '::1'),
(1004, 42, 'Login Sucesso', 2, '2024-11-18 18:17:00', '::1'),
(1005, 42, 'Saiu do sistema', 2, '2024-11-18 18:27:00', '::1'),
(1006, 57, 'Login Sucesso', 2, '2024-11-18 18:27:00', '::1'),
(1007, 57, 'Saiu do sistema', 2, '2024-11-18 18:38:00', '::1'),
(1008, 57, 'Login Sucesso', 2, '2024-11-18 18:38:00', '::1'),
(1009, 57, 'Saiu do sistema', 2, '2024-11-18 18:45:00', '::1'),
(1010, 21, 'Login Sucesso', 2, '2024-11-18 18:45:00', '::1'),
(1011, 21, 'Saiu do sistema', 2, '2024-11-18 19:46:00', '::1'),
(1012, 57, 'Falha no Login', 3, '2024-11-18 19:46:00', '::1'),
(1013, 42, 'Falha no Login', 3, '2024-11-18 19:46:00', '::1'),
(1014, 42, 'Login Sucesso', 2, '2024-11-18 19:47:00', '::1'),
(1015, 42, 'Saiu do sistema', 2, '2024-11-18 19:50:00', '::1'),
(1016, 21, 'Login Sucesso', 3, '2024-11-18 19:50:00', '::1'),
(1017, 21, 'Saiu do sistema', 3, '2024-11-18 19:50:00', '::1'),
(1018, 21, 'Login Sucesso', 2, '2024-11-18 19:50:00', '::1'),
(1019, 36, 'Falha no Login', 3, '2024-11-19 09:36:00', '10.47.20.184'),
(1020, 36, 'Login Sucesso', 3, '2024-11-19 09:36:00', '10.47.20.184'),
(1021, 36, 'Saiu do sistema', 3, '2024-11-19 09:37:00', '10.47.20.184'),
(1022, 15, 'Login Sucesso', 3, '2024-11-19 09:38:00', '10.47.20.184'),
(1023, 1, 'Saiu do sistema', 0, '2024-11-21 07:43:00', '10.47.21.155'),
(1024, 1, 'Saiu do sistema', 0, '2024-11-21 08:15:00', '10.47.21.155'),
(1025, 57, 'Login Sucesso', 3, '2024-11-21 08:15:00', '10.47.21.155'),
(1026, 1, 'Saiu do sistema', 0, '2024-11-22 08:59:00', '10.47.20.52'),
(1027, 57, 'Falha no Login', 2, '2024-11-22 11:47:00', '10.47.21.52'),
(1028, 57, 'Login Sucesso', 2, '2024-11-22 11:47:00', '10.47.21.52'),
(1029, 1, 'Saiu do sistema', 0, '2024-11-22 11:56:00', '10.47.21.52'),
(1030, 21, 'Login Sucesso', 2, '2024-11-22 11:56:00', '10.47.21.52'),
(1031, 1, 'Saiu do sistema', 0, '2024-11-25 10:03:00', '10.47.21.52'),
(1032, 21, 'Login Sucesso', 2, '2024-11-25 10:03:00', '10.47.21.52'),
(1033, 1, 'Saiu do sistema', 0, '2024-11-25 10:16:00', '10.47.20.184'),
(1034, 57, 'Login Sucesso', 3, '2024-11-25 10:17:00', '10.47.20.184'),
(1035, 1, 'Saiu do sistema', 0, '2024-11-27 10:35:00', '10.47.20.53'),
(1036, 1, 'Saiu do sistema', 0, '2024-11-27 11:02:00', '10.47.20.53'),
(1037, 16, 'Login Sucesso', 2, '2024-11-27 11:02:00', '10.47.20.53'),
(1038, 1, 'Saiu do sistema', 0, '2024-11-27 14:32:00', '10.47.20.53'),
(1039, 1, 'Saiu do sistema', 0, '2024-11-27 15:44:00', '10.47.20.116'),
(1040, 36, 'Login Sucesso', 2, '2024-11-27 15:45:00', '10.47.20.116'),
(1041, 36, 'Saiu do sistema', 2, '2024-11-27 15:46:00', '10.47.20.116'),
(1042, 1, 'Saiu do sistema', 0, '2024-12-24 09:26:00', '10.47.21.52'),
(1043, 36, 'Login Sucesso', 2, '2024-12-24 09:26:00', '10.47.21.52'),
(1044, 1, 'Saiu do sistema', 0, '2025-01-15 08:13:00', '10.47.21.52'),
(1045, 1, 'Saiu do sistema', 0, '2025-02-18 14:30:00', '10.47.21.189'),
(1046, 1, 'Login Sucesso', 2, '2025-02-18 14:31:00', '10.47.21.189'),
(1047, 1, 'Saiu do sistema', 0, '2025-03-12 15:17:00', '10.47.21.189'),
(1048, 1, 'Login Sucesso', 2, '2025-03-12 15:17:00', '10.47.21.189'),
(1049, 1, 'Acesso indevido ao Módulo Perfis', 2, '2025-03-12 15:18:00', '10.47.21.189'),
(1050, 1, 'Acesso indevido ao Módulo Perfis', 2, '2025-03-12 15:18:00', '10.47.21.189'),
(1051, 1, 'Acesso indevido ao Módulo Modulos', 0, '2025-03-12 15:19:00', '10.47.21.189'),
(1052, 1, 'Saiu do sistema', 2, '2025-03-12 15:23:00', '10.47.21.189'),
(1053, 1, 'Login Sucesso', 4, '2025-03-12 15:24:00', '10.47.21.189'),
(1054, 1, 'Saiu do sistema', 4, '2025-03-12 15:24:00', '10.47.21.189'),
(1055, 1, 'Login Sucesso', 4, '2025-03-12 15:25:00', '10.47.21.189'),
(1056, 1, 'Saiu do sistema', 4, '2025-03-12 15:42:00', '10.47.21.189'),
(1057, 1, 'Login Sucesso', 4, '2025-03-12 15:42:00', '10.47.21.189'),
(1058, 1, 'Saiu do sistema', 4, '2025-03-12 15:42:00', '10.47.21.189'),
(1059, 1, 'Login Sucesso', 2, '2025-03-12 15:42:00', '10.47.21.189'),
(1060, 1, 'Saiu do sistema', 2, '2025-03-12 15:45:00', '10.47.21.189'),
(1061, 1, 'Login Sucesso', 2, '2025-03-12 15:46:00', '10.47.21.189'),
(1062, 1, 'Saiu do sistema', 2, '2025-03-12 15:47:00', '10.47.21.189'),
(1063, 30, 'Login Sucesso', 4, '2025-03-12 15:47:00', '10.47.21.189'),
(1064, 30, 'Saiu do sistema', 4, '2025-03-12 15:48:00', '10.47.21.189'),
(1065, 30, 'Login Sucesso', 4, '2025-03-12 15:48:00', '10.47.21.189'),
(1066, 1, 'Saiu do sistema', 0, '2025-03-13 15:40:00', '10.47.21.189'),
(1067, 1, 'Saiu do sistema', 0, '2025-03-14 11:02:00', '10.47.21.189'),
(1068, 1, 'Saiu do sistema', 0, '2025-04-11 10:42:00', '10.47.20.183'),
(1069, 56, 'Saiu do sistema', 0, '2025-04-15 11:58:00', '10.47.21.249'),
(1070, 56, 'Saiu do sistema', 0, '2025-04-15 12:13:00', '10.47.21.249'),
(1071, 1, 'Login Sucesso', 2, '2025-04-15 12:13:00', '10.47.21.249'),
(1072, 1, 'Saiu do sistema', 2, '2025-04-15 12:16:00', '10.47.21.249'),
(1073, 1, 'Saiu do sistema', 0, '2025-04-15 13:14:00', '10.47.21.249'),
(1074, 1, 'Login Sucesso', 2, '2025-04-15 13:21:00', '10.47.21.249'),
(1075, 1, 'Saiu do sistema', 2, '2025-04-15 15:51:00', '10.47.21.249'),
(1076, 1, 'Saiu do sistema', 0, '2025-04-15 15:51:00', '10.47.21.249'),
(1077, 1, 'Saiu do sistema', 0, '2025-05-26 15:26:00', '10.47.21.209'),
(1078, 1, 'Login Sucesso', 2, '2025-05-26 15:42:00', '10.47.21.209'),
(1079, 41, 'Saiu do sistema', 2, '2025-05-26 15:51:00', '10.47.21.209'),
(1080, 1, 'Saiu do sistema', 0, '2025-05-26 18:48:00', '::1'),
(1081, 1, 'Login Sucesso', 2, '2025-05-26 18:59:00', '::1'),
(1082, 1, 'Saiu do sistema', 0, '2025-05-27 10:53:00', '::1'),
(1083, 1, 'Login Sucesso', 2, '2025-05-27 14:21:00', '::1'),
(1084, 1, 'Saiu do sistema', 0, '2025-10-21 00:14:00', '::1'),
(1085, 1, 'Login Sucesso', 2, '2025-10-21 00:14:00', '::1'),
(1086, 1, 'Saiu do sistema', 2, '2025-10-21 00:34:00', '::1'),
(1087, 1, 'Login Sucesso', 2, '2025-10-21 00:35:00', '::1'),
(1088, 1, 'Saiu do sistema', 2, '2025-10-21 00:37:00', '::1'),
(1089, 1, 'Saiu do sistema', 0, '2025-10-21 00:37:00', '::1'),
(1090, 1, 'Saiu do sistema', 0, '2025-10-21 00:39:00', '::1'),
(1091, 1, 'Login Sucesso', 2, '2025-10-21 00:39:00', '::1'),
(1092, 1, 'Saiu do sistema', 0, '2025-10-21 14:04:00', '::1'),
(1093, 1, 'Login Sucesso', 2, '2025-10-21 14:05:00', '::1'),
(1094, 1, 'Saiu do sistema', 2, '2025-10-21 14:35:00', '::1'),
(1095, 1, 'Login Sucesso', 2, '2025-10-21 14:35:00', '::1'),
(1096, 1, 'Saiu do sistema', 0, '2025-10-21 23:29:00', '::1'),
(1097, 1, 'Falha no Login', 2, '2025-10-21 23:30:00', '::1'),
(1098, 1, 'Falha no Login', 2, '2025-10-21 23:30:00', '::1'),
(1099, 1, 'Falha no Login', 2, '2025-10-21 23:30:00', '::1'),
(1100, 1, 'Falha no Login', 2, '2025-10-21 23:30:00', '::1'),
(1101, 1, 'Falha no Login', 2, '2025-10-21 23:31:00', '::1'),
(1102, 1, 'Falha no Login', 3, '2025-10-21 23:32:00', '::1'),
(1103, 1, 'Falha no Login', 3, '2025-10-21 23:32:00', '::1'),
(1104, 1, 'Falha no Login', 3, '2025-10-21 23:33:00', '::1'),
(1105, 1, 'Falha no Login', 3, '2025-10-21 23:33:00', '::1'),
(1106, 1, 'Falha no Login', 4, '2025-10-21 23:34:00', '::1'),
(1107, 1, 'Falha no Login', 4, '2025-10-21 23:34:00', '::1'),
(1108, 1, 'Login Sucesso', 2, '2025-10-21 23:35:00', '::1'),
(1109, 1, 'Saiu do sistema', 2, '2025-10-21 23:36:00', '::1'),
(1110, 1, 'Falha no Login', 2, '2025-10-21 23:36:00', '::1'),
(1111, 1, 'Falha no Login', 2, '2025-10-21 23:36:00', '::1'),
(1112, 1, 'Falha no Login', 2, '2025-10-21 23:36:00', '::1'),
(1113, 1, 'Falha no Login', 2, '2025-10-21 23:36:00', '::1'),
(1114, 1, 'Falha no Login', 2, '2025-10-21 23:36:00', '::1'),
(1115, 1, 'Falha no Login', 2, '2025-10-21 23:36:00', '::1'),
(1116, 1, 'Falha no Login', 2, '2025-10-21 23:36:00', '::1'),
(1117, 1, 'Falha no Login', 2, '2025-10-21 23:36:00', '::1'),
(1118, 1, 'Falha no Login', 2, '2025-10-21 23:36:00', '::1'),
(1119, 1, 'Falha no Login', 2, '2025-10-21 23:36:00', '::1'),
(1120, 1, 'Falha no Login', 2, '2025-10-21 23:36:00', '::1'),
(1121, 1, 'Falha no Login', 2, '2025-10-21 23:36:00', '::1'),
(1122, 1, 'Falha no Login', 2, '2025-10-21 23:37:00', '::1'),
(1123, 1, 'Login Sucesso', 2, '2025-10-21 23:37:00', '::1'),
(1124, 1, 'Saiu do sistema', 2, '2025-10-21 23:42:00', '::1'),
(1125, 1, 'Login Sucesso', 2, '2025-10-21 23:42:00', '::1'),
(1126, 1, 'Saiu do sistema', 0, '2025-10-22 10:40:00', '::1'),
(1127, 1, 'Login Sucesso', 2, '2025-10-22 10:54:00', '::1'),
(1128, 1, 'Saiu do sistema', 2, '2025-10-22 10:55:00', '::1'),
(1129, 1, 'Login Sucesso', 2, '2025-10-22 10:55:00', '::1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `meios`
--

CREATE TABLE `meios` (
  `codMeio` int(11) NOT NULL,
  `descricaoMeio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `meios`
--

INSERT INTO `meios` (`codMeio`, `descricaoMeio`) VALUES
(1, 'E-mail'),
(2, 'Telefone'),
(3, 'Fale com a SFPC'),
(4, 'Presencial');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

CREATE TABLE `modulos` (
  `codModulo` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `link` varchar(70) NOT NULL,
  `pai` int(11) NOT NULL DEFAULT 0,
  `ordem` int(11) NOT NULL,
  `destaque` int(11) NOT NULL,
  `icone` varchar(30) NOT NULL,
  `dataCriacao` timestamp NULL DEFAULT NULL,
  `dataAtualizacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modulos`
--

INSERT INTO `modulos` (`codModulo`, `nome`, `link`, `pai`, `ordem`, `destaque`, `icone`, `dataCriacao`, `dataAtualizacao`) VALUES
(10, 'CONFIGURAÇÕES', '#', 0, 10, 2, 'fas fa-cogs', '2021-09-12 01:05:00', '2022-06-07 15:05:25'),
(11, 'Módulos', 'modulos', 10, 11, 0, 'fas fa-cogs', '2020-06-02 22:41:36', '2022-06-07 15:05:25'),
(12, 'Colaboradores', 'colaboradores', 10, 12, 0, 'fas fa-users', '2020-06-02 22:41:36', '2023-11-11 03:04:00'),
(13, 'Perfis de acesso', 'perfis', 10, 4, 0, 'fas fa-user-md', '2021-09-02 19:18:00', '2022-06-07 15:05:25'),
(14, 'Organizações', 'organizacoes', 10, 1, 1, 'fas fa-cogs', '2021-09-03 19:53:48', '2022-06-07 15:05:25'),
(15, 'DESENVOLVIMENTO', '#', 0, 800, 1, 'fas fa-code', '2021-09-09 21:36:42', '2024-11-14 15:04:00'),
(16, 'Desenvolvimento', 'crud', 15, 999, 1, 'fas fa-chart-line', '2021-09-09 18:50:57', '2024-11-18 12:42:00'),
(17, 'Teste', 'teste', 15, 1, 1, 'fas fa-chart-line', '2024-11-14 16:34:00', '2024-11-14 16:34:00'),
(18, 'RELATÓRIOS', '#', 0, 1, 1, 'fas fa-code', '2024-11-14 17:42:00', '2024-11-14 17:42:00'),
(19, 'Respostas', 'respostas', 18, 1, 1, 'fas fa-chart-line', '2024-11-14 17:42:00', '2024-11-14 17:42:00'),
(20, 'Federações', 'federacoes', 15, 3, 3, 'fas fa-code', '2024-11-18 13:00:00', '2024-11-18 13:00:00'),
(21, 'Rotinas', 'rotinas', 15, 4, 4, 'fas fa-chart-line', '2024-11-18 13:26:00', '2024-11-18 13:26:00'),
(22, 'NAPS', '#', 0, 1, 1, 'fa fa-plus', '2025-05-27 14:22:00', '2025-10-21 00:58:00'),
(24, 'Atendimentos', 'atendimentos', 22, 1, 1, 'fa fa-plus', '2025-10-21 01:10:00', '2025-10-21 01:10:00'),
(25, 'Paciente', 'pacientes', 22, 2, 2, 'fas fa-cogs	', '2025-10-21 17:33:00', '2025-10-21 17:33:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulosnotificacao`
--

CREATE TABLE `modulosnotificacao` (
  `codModuloNotificacao` int(11) NOT NULL,
  `codOrganizacao` int(11) DEFAULT NULL,
  `codModulo` int(11) DEFAULT NULL,
  `observacoes` varchar(60) DEFAULT NULL,
  `codModeloNotificacao` int(11) DEFAULT NULL,
  `codTipoNotificacao` int(11) DEFAULT 0,
  `destinoNotificacao` text DEFAULT NULL,
  `dataCriacao` timestamp NULL DEFAULT NULL,
  `dataAtualizacao` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modulosnotificacao`
--

INSERT INTO `modulosnotificacao` (`codModuloNotificacao`, `codOrganizacao`, `codModulo`, `observacoes`, `codModeloNotificacao`, `codTipoNotificacao`, `destinoNotificacao`, `dataCriacao`, `dataAtualizacao`) VALUES
(1, 1, 202, '', 5, 2, '0', NULL, NULL),
(2, 1, 150, '', 5, 1, '1,91,92', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `om_data`
--

CREATE TABLE `om_data` (
  `codigo` int(11) DEFAULT NULL,
  `sigla` varchar(255) DEFAULT NULL,
  `nome_cmt` varchar(255) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `razao_social` varchar(255) DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `numero_end` int(11) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `codigo_rm` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `om_data`
--

INSERT INTO `om_data` (`codigo`, `sigla`, `nome_cmt`, `cnpj`, `razao_social`, `lat`, `lng`, `endereco`, `numero_end`, `bairro`, `cep`, `cidade`, `estado`, `codigo_rm`) VALUES
(1, 'Cmdo 7ª RM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, '201º BI Mtz', NULL, '97.551.507/0001-75', 'Unidade', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(3, 'Cmdo 20ª RM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(4, 'Pq R Mnt 7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(5, '7º D Sup', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(6, '7ª Bda Inf Mtz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(7, '16º BIMtz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(8, '17º GAC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(9, '7º BECmb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(10, '15º BIMtz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(11, '31º BIMtz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(12, '16º RCMec', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(13, '59º BIMtz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(14, 'Cia C 10ª Bda Inf Mtz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(15, '14º BLog', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(16, '14º BIMtz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(17, '7º GAC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(18, '71º BIMtz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(19, '72º BICaat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(20, '4º BPE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(21, '10ª Cia E Cmb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(22, '1º BEC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(25, 'B Adm Gu JP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(27, '7ª ICFEx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(28, 'CRO/7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(29, '3º C Geo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(30, '5º CTA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(32, '1º Gpt E', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(33, '5ª Cia Itlg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(34, '7ª Cia Com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(35, 'B Adm Curado', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(36, '10º Esqd C Mec', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(37, '4º B Com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(38, '7º Pel PE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(39, 'CPOR/R', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(40, 'CMR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(41, 'CIMNC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(42, 'HMAR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(43, 'H Gu JP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(44, 'H Gu N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(45, 'CMNE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(46, 'B Adm Gu N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(47, 'Cmdo 7ª RM - SSIP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(48, 'PMPE', NULL, '11.433.190/0001-57', 'Polícia Militar do Estado de Pernambuco', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PE', 1),
(49, 'CBMPE', NULL, '00.358.773/0001-44', 'Corpo de Bombeiros Militar do Estado de Pernambuco', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PE', 1),
(50, 'PMPB', NULL, '08.907.776/0001-00', 'Polícia Militar do Estado da Paraíba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PB', 1),
(51, 'PMAL', NULL, '12.442.570/0001-10', 'Polícia Militar do Estado de Alagoas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AL', 1),
(52, 'PMRN', NULL, '04.058.766/0001-88', 'Polícia Militar do Estado do Rio Grande do Norte', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RN', 1),
(53, 'CBMPB', NULL, '09.537.092/0001-18', 'Corpo de Bombeiros Militar do Estado da Paraíba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PB', 1),
(54, 'CBMAL', NULL, '69.977.817/0001-10', 'Corpo de Bombeiros Militar do Estado de Alagoas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AL', 1),
(55, 'CBMRN', NULL, '04.994.771/0001-00', 'Corpo de Bombeiros Militar do Rio Grande do Norte', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RN', 1),
(56, 'Cia Cmdo CMNE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(57, '10ª Bda Inf Mtz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(58, '7ª DE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `organizacoes`
--

CREATE TABLE `organizacoes` (
  `codOrganizacao` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `siglaOrganizacao` varchar(30) DEFAULT NULL,
  `endereço` varchar(100) DEFAULT NULL,
  `telefone` varchar(16) DEFAULT NULL,
  `cnpj` varchar(30) DEFAULT NULL,
  `razaoSocial` varchar(200) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `fundo` varchar(50) DEFAULT NULL,
  `codTimezone` int(11) NOT NULL DEFAULT 129,
  `chaveSalgada` varchar(100) DEFAULT '7lyx$q4g@ICU.',
  `tempoInatividade` int(11) DEFAULT NULL,
  `loginAdmin` varchar(50) DEFAULT NULL,
  `senhaAdmin` varchar(64) DEFAULT NULL,
  `forcarExpiracao` int(11) NOT NULL DEFAULT 0,
  `dataCriacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `dataAtualizacao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cep` varchar(12) DEFAULT NULL,
  `permiteAutocadastro` int(11) NOT NULL DEFAULT 0,
  `matriz` int(11) NOT NULL DEFAULT 0,
  `formularioRegistro` int(11) NOT NULL DEFAULT 1,
  `politicaSenha` int(11) NOT NULL DEFAULT 0,
  `diferenteUltimasSenhas` int(11) NOT NULL DEFAULT 0,
  `senhaNaoSimples` int(11) NOT NULL DEFAULT 0,
  `numeros` int(11) NOT NULL DEFAULT 0,
  `letras` int(11) NOT NULL DEFAULT 0,
  `caracteresEspeciais` int(11) NOT NULL DEFAULT 0,
  `minimoCaracteres` int(11) NOT NULL DEFAULT 8,
  `maiusculo` int(11) NOT NULL DEFAULT 0,
  `cabecalho` longtext DEFAULT NULL,
  `rodape` longtext DEFAULT NULL,
  `cabecalhoPrescricao` longtext DEFAULT NULL,
  `rodapePrescricao` longtext DEFAULT NULL,
  `codPerfilPadrao` int(11) NOT NULL DEFAULT 1,
  `nomeExibicaoSistema` int(11) NOT NULL DEFAULT 1,
  `ativarSenhaPadrao` int(11) NOT NULL DEFAULT 0,
  `senhaPadrao` varchar(64) DEFAULT NULL,
  `confirmacaoCadastroPorEmail` int(11) NOT NULL DEFAULT 0,
  `senhaAleatória` int(11) NOT NULL DEFAULT 0,
  `creditoswhatsapp` int(11) NOT NULL DEFAULT 0,
  `creditossms` int(11) NOT NULL DEFAULT 0,
  `creditossmtp` int(11) NOT NULL DEFAULT 0,
  `servidorSpedDB` varchar(100) DEFAULT NULL,
  `portaSpedDB` int(11) NOT NULL DEFAULT 5432,
  `SpedDB` varchar(50) DEFAULT NULL,
  `administradorSpedDB` varchar(50) DEFAULT NULL,
  `senhaadministradorSpedDB` varchar(60) DEFAULT NULL,
  `servidorSPEDStatus` int(11) NOT NULL DEFAULT 0,
  `linkedin_url` varchar(200) DEFAULT NULL,
  `facebook_url` varchar(200) DEFAULT NULL,
  `instagram_url` varchar(200) DEFAULT NULL,
  `twitter_url` varchar(200) DEFAULT NULL,
  `youtube_url` varchar(200) DEFAULT NULL,
  `site` varchar(200) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `codEstadoFederacao` int(11) DEFAULT NULL,
  `mensagemFusex` text DEFAULT NULL,
  `faleConosco` varchar(100) DEFAULT NULL,
  `hero` text DEFAULT NULL,
  `contatos` text DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `codTipoOrganizacao` int(11) DEFAULT NULL,
  `codTipoMultisite` int(11) DEFAULT NULL,
  `multiSiteLoginAtivado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `organizacoes`
--

INSERT INTO `organizacoes` (`codOrganizacao`, `descricao`, `siglaOrganizacao`, `endereço`, `telefone`, `cnpj`, `razaoSocial`, `logo`, `fundo`, `codTimezone`, `chaveSalgada`, `tempoInatividade`, `loginAdmin`, `senhaAdmin`, `forcarExpiracao`, `dataCriacao`, `dataAtualizacao`, `cep`, `permiteAutocadastro`, `matriz`, `formularioRegistro`, `politicaSenha`, `diferenteUltimasSenhas`, `senhaNaoSimples`, `numeros`, `letras`, `caracteresEspeciais`, `minimoCaracteres`, `maiusculo`, `cabecalho`, `rodape`, `cabecalhoPrescricao`, `rodapePrescricao`, `codPerfilPadrao`, `nomeExibicaoSistema`, `ativarSenhaPadrao`, `senhaPadrao`, `confirmacaoCadastroPorEmail`, `senhaAleatória`, `creditoswhatsapp`, `creditossms`, `creditossmtp`, `servidorSpedDB`, `portaSpedDB`, `SpedDB`, `administradorSpedDB`, `senhaadministradorSpedDB`, `servidorSPEDStatus`, `linkedin_url`, `facebook_url`, `instagram_url`, `twitter_url`, `youtube_url`, `site`, `cidade`, `codEstadoFederacao`, `mensagemFusex`, `faleConosco`, `hero`, `contatos`, `foto`, `codTipoOrganizacao`, `codTipoMultisite`, `multiSiteLoginAtivado`) VALUES
(1, 'Cmdo 7ª RM', 'Cmdo 7ª RM', NULL, NULL, NULL, NULL, NULL, NULL, 129, '7lyx$q4g@ICU.', NULL, NULL, NULL, 0, '2024-11-05 19:06:22', '2025-10-21 14:34:36', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, 0, 0, 0, 0, 0, NULL, 5432, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `codPaciente` int(11) NOT NULL,
  `nomeCompleto` varchar(150) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `preccp` varchar(14) DEFAULT NULL,
  `codOrganizacao` int(11) DEFAULT NULL,
  `postoGraduacao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`codPaciente`, `nomeCompleto`, `cpf`, `preccp`, `codOrganizacao`, `postoGraduacao`) VALUES
(1, 'Emanuel Peixoto Vicente', '111.111.111-11', '1111111111111', NULL, 8),
(2, 'ghfh', '555.555.555-55', '55555555555555', 1, 2),
(3, 'Douglas da Silva', '212.222.121-21', '10111100000001', 1, 9),
(4, 'marcos da silva', '212.121.212-12', '99999999999999', 1, 8),
(5, 'Patriot', '744.444.444-44', '44444444444444', 1, 1),
(6, 'gfgfgf', '343.333.333-33', '3333333333', 1, 3),
(7, 'rrrrrrrrrrr', '333.333.333-33', '33333333333333', 1, 16),
(8, 'aaaaaaaaaa', '111.111.111-11', '11111111111111', 1, 2),
(9, 'bola gato', '333.333.333-33', '33333333333333', 1, 5),
(10, 'bola bola', '434.343.434-34', '343434', 1, 2),
(11, 'gatuno', '222.222.222-22', 'wesdsds', 1, 3),
(12, 'xzxzxx', '111.111.111-33', '44444444444445', 1, 4),
(13, 'JOÃO PAULO SILVA', '053.151.604-08', '2121245458', 1, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfis`
--

CREATE TABLE `perfis` (
  `codPerfil` int(11) NOT NULL,
  `codOrganizacao` int(11) NOT NULL DEFAULT 1,
  `descricao` varchar(60) NOT NULL,
  `dataCriacao` timestamp NULL DEFAULT NULL,
  `dataAtualizacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `perguntarLocalAtendimento` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfis`
--

INSERT INTO `perfis` (`codPerfil`, `codOrganizacao`, `descricao`, `dataCriacao`, `dataAtualizacao`, `perguntarLocalAtendimento`) VALUES
(1, 1, 'Padrão', NULL, '2024-11-13 18:56:00', 0),
(2, 1, 'Administrador', NULL, '2024-11-13 18:48:00', 0),
(3, 1, 'Colaboradores', NULL, '2024-05-07 14:18:00', 0),
(36, 1, 'Recepcao', '2025-10-21 01:09:00', '2025-10-21 01:09:00', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfiscolaboradoresmembro`
--

CREATE TABLE `perfiscolaboradoresmembro` (
  `codColaboradorMembro` int(11) NOT NULL,
  `codColaborador` int(11) DEFAULT NULL,
  `codPerfil` int(11) NOT NULL,
  `dataCriacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `dataAtualizacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dataInicio` date DEFAULT NULL,
  `dataEncerramento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfiscolaboradoresmembro`
--

INSERT INTO `perfiscolaboradoresmembro` (`codColaboradorMembro`, `codColaborador`, `codPerfil`, `dataCriacao`, `dataAtualizacao`, `dataInicio`, `dataEncerramento`) VALUES
(1, 2, 2, '2024-11-14 17:40:00', '2024-11-14 14:40:59', '2024-11-14', NULL),
(10, 2, 1, '2024-11-14 19:14:00', '2024-11-14 19:14:00', '2024-11-14', NULL),
(11, 3, 1, '2024-11-18 22:46:00', '2024-11-18 22:46:00', '2024-11-18', NULL),
(12, 3, 2, '2024-11-18 22:52:00', '2024-11-18 22:52:00', '2024-11-18', NULL),
(13, 4, 1, '2025-03-12 18:24:00', '2025-03-12 18:24:00', '2025-03-12', NULL),
(14, 4, 2, '2025-03-12 18:45:00', '2025-03-12 18:45:00', '2025-03-12', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfismodulos`
--

CREATE TABLE `perfismodulos` (
  `codPerfil` int(11) NOT NULL,
  `codModulo` int(11) NOT NULL,
  `codOrganizacao` int(11) NOT NULL,
  `listar` int(11) NOT NULL DEFAULT 0,
  `adicionar` int(11) NOT NULL DEFAULT 0,
  `editar` int(11) NOT NULL DEFAULT 0,
  `deletar` int(11) NOT NULL DEFAULT 0,
  `dataCriacao` timestamp NULL DEFAULT current_timestamp(),
  `dataAtualizacao` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfismodulos`
--

INSERT INTO `perfismodulos` (`codPerfil`, `codModulo`, `codOrganizacao`, `listar`, `adicionar`, `editar`, `deletar`, `dataCriacao`, `dataAtualizacao`) VALUES
(1, 18, 21, 1, 1, 1, 1, '2024-11-18 12:24:27', '2024-11-18 12:24:27'),
(1, 19, 21, 1, 1, 1, 1, '2024-11-18 12:24:28', '2024-11-18 12:24:28'),
(2, 10, 1, 1, 1, 1, 1, '2025-10-21 17:33:23', '2025-10-21 17:33:23'),
(2, 11, 1, 1, 1, 1, 1, '2025-10-21 17:33:24', '2025-10-21 17:33:24'),
(2, 12, 1, 1, 1, 1, 1, '2025-10-21 17:33:24', '2025-10-21 17:33:24'),
(2, 13, 1, 1, 1, 1, 1, '2025-10-21 17:33:24', '2025-10-21 17:33:24'),
(2, 14, 1, 1, 1, 1, 1, '2025-10-21 17:33:24', '2025-10-21 17:33:24'),
(2, 15, 1, 1, 1, 1, 1, '2025-10-21 17:33:24', '2025-10-21 17:33:24'),
(2, 16, 1, 1, 1, 1, 1, '2025-10-21 17:33:24', '2025-10-21 17:33:24'),
(2, 17, 1, 1, 1, 1, 1, '2025-10-21 17:33:24', '2025-10-21 17:33:24'),
(2, 18, 1, 1, 1, 1, 1, '2025-10-21 17:33:24', '2025-10-21 17:33:24'),
(2, 19, 1, 1, 1, 1, 1, '2025-10-21 17:33:24', '2025-10-21 17:33:24'),
(2, 20, 1, 1, 1, 1, 1, '2025-10-21 17:33:24', '2025-10-21 17:33:24'),
(2, 21, 1, 1, 1, 1, 1, '2025-10-21 17:33:24', '2025-10-21 17:33:24'),
(2, 22, 1, 1, 1, 1, 1, '2025-10-21 17:33:24', '2025-10-21 17:33:24'),
(2, 24, 1, 1, 1, 1, 1, '2025-10-21 17:33:24', '2025-10-21 17:33:24'),
(2, 25, 1, 1, 1, 1, 1, '2025-10-21 17:33:24', '2025-10-21 17:33:24'),
(36, 22, 1, 1, 1, 1, 1, '2025-10-21 17:33:47', '2025-10-21 17:33:47'),
(36, 24, 1, 1, 1, 1, 1, '2025-10-21 17:33:47', '2025-10-21 17:33:47'),
(36, 25, 1, 1, 1, 1, 1, '2025-10-21 17:33:47', '2025-10-21 17:33:47');

-- --------------------------------------------------------

--
-- Estrutura da tabela `portalorganizacao`
--

CREATE TABLE `portalorganizacao` (
  `codPortal` int(11) NOT NULL,
  `codOrganizacao` int(11) NOT NULL,
  `corFundoPrincipal` varchar(12) DEFAULT NULL,
  `corTextoPrincipal` varchar(12) DEFAULT NULL,
  `corSecundaria` varchar(12) DEFAULT NULL,
  `corMenus` varchar(12) DEFAULT NULL,
  `corTextoMenus` varchar(12) DEFAULT NULL,
  `corBackgroundMenus` varchar(12) DEFAULT NULL,
  `dataAtualizacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `codAutor` int(11) DEFAULT NULL,
  `ativoHero` int(11) NOT NULL DEFAULT 1,
  `heroImagem` varchar(100) DEFAULT NULL,
  `heroTexto` text DEFAULT NULL,
  `corLinhaTabela` varchar(12) NOT NULL,
  `corTextoTabela` varchar(12) NOT NULL,
  `ativoSobre` int(11) NOT NULL DEFAULT 0,
  `sobreTexto` text DEFAULT NULL,
  `imagemSobre` varchar(100) DEFAULT NULL,
  `convenioAlternativo` int(11) NOT NULL DEFAULT 0,
  `textoConvenioAlternativo` text DEFAULT NULL,
  `tituloConvenioAlternativo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `portalorganizacao`
--

INSERT INTO `portalorganizacao` (`codPortal`, `codOrganizacao`, `corFundoPrincipal`, `corTextoPrincipal`, `corSecundaria`, `corMenus`, `corTextoMenus`, `corBackgroundMenus`, `dataAtualizacao`, `codAutor`, `ativoHero`, `heroImagem`, `heroTexto`, `corLinhaTabela`, `corTextoTabela`, `ativoSobre`, `sobreTexto`, `imagemSobre`, `convenioAlternativo`, `textoConvenioAlternativo`, `tituloConvenioAlternativo`) VALUES
(1, 1, '#15b7b9', '#ffffff', NULL, '#ffffff', '#6b6b6b', '#ffffff', '2024-11-12 16:02:00', 2, 1, NULL, '<h3><span style=\"font-family: &quot;Source Sans Pro&quot;; font-size: 36px;\"><font color=\"#f7f7f7\"><b>Desenrola Med desburocratiza seus embarações com os planos de saúde!</b></font></span></h3><h3><font color=\"#f7f7f7\" face=\"Source Sans Pro\"><span style=\"font-size: 20px;\">Descomplique as autorizações do seus plano de saúde.</span></font></h3>', '#f6ffeb', '#4a4a4a', 1, '<p></p><h3 data-aos=\"fade-up\" class=\"aos-init aos-animate\" style=\"font-family: Raleway, sans-serif; font-weight: 700; color: rgb(78, 64, 57); font-size: 34px; transform: translateZ(0px); opacity: 1; transition-property: opacity, transform; transition-duration: 0.8s; transition-timing-function: ease-in-out;\"><span style=\"font-family: Verdana; font-size: 36px;\">Conheça o Desenrola MED</span></h3><h3 data-aos=\"fade-up\" class=\"aos-init aos-animate\" style=\"font-family: Raleway, sans-serif; font-weight: 700; color: rgb(78, 64, 57); font-size: 34px; transform: translateZ(0px); opacity: 1; transition-property: opacity, transform; transition-duration: 0.8s; transition-timing-function: ease-in-out;\"><p style=\"font-weight: 400; font-size: 15px; color: rgb(90, 101, 112); font-family: &quot;Open Sans&quot;, sans-serif;\"></p></h3><h3 style=\"font-weight: 400; transform: translateZ(0px); font-size: 15px; color: rgb(90, 101, 112); opacity: 1; transition-property: opacity, transform; transition-duration: 0.8s; transition-timing-function: ease-in-out; font-family: &quot;Open Sans&quot;, sans-serif;\"><span style=\"color: rgb(5, 5, 5); font-family: Verdana; white-space-collapse: preserve; font-size: 20px;\">O Desenrola Med a juda você a conseguir as autorizações de procedimentos, exames e consultas de maneira rápida e prática!</span></h3><p data-aos=\"fade-up\" data-aos-delay=\"90\" class=\"aos-init aos-animate\" style=\"font-weight: 400; transform: translateZ(0px); font-size: 15px; color: rgb(90, 101, 112); opacity: 1; transition-property: opacity, transform; transition-duration: 0.8s; transition-timing-function: ease-in-out; font-family: &quot;Open Sans&quot;, sans-serif;\"><span style=\"color: rgb(5, 5, 5); font-family: Verdana; white-space-collapse: preserve;\"><br></span></p>', 'desenrolamedlogo.png', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questionarios`
--

CREATE TABLE `questionarios` (
  `codQuestionario` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `resumo` text DEFAULT NULL,
  `codOrganizacao` int(11) NOT NULL,
  `dataCriacao` timestamp NULL DEFAULT NULL,
  `dataAtualizacao` timestamp NULL DEFAULT NULL,
  `dataInicio` timestamp NULL DEFAULT NULL,
  `dataEncerramento` timestamp NULL DEFAULT NULL,
  `ativo` int(11) DEFAULT 0,
  `termoAceite` text DEFAULT NULL,
  `instrucoes` text DEFAULT NULL,
  `codAutor` int(11) DEFAULT NULL,
  `codVisibilidade` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `questionariosvisibilidade`
--

CREATE TABLE `questionariosvisibilidade` (
  `codVisibilidade` int(11) NOT NULL,
  `descricao` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `questionariosvisibilidade`
--

INSERT INTO `questionariosvisibilidade` (`codVisibilidade`, `descricao`) VALUES
(1, 'Publico'),
(2, 'Clientes'),
(3, 'Colaboradores');

-- --------------------------------------------------------

--
-- Estrutura da tabela `satisfacao`
--

CREATE TABLE `satisfacao` (
  `codPesquisa` int(11) NOT NULL,
  `codOrganizacao` int(11) DEFAULT NULL,
  `codMeio` int(11) DEFAULT NULL,
  `data` date NOT NULL,
  `email` text CHARACTER SET utf8 DEFAULT NULL,
  `servico` int(11) DEFAULT NULL,
  `atendimento` int(11) DEFAULT NULL,
  `qualidade` int(11) DEFAULT NULL,
  `tempo` int(11) DEFAULT NULL,
  `instalacoes` int(11) DEFAULT NULL,
  `qualidadePresencial` int(11) DEFAULT NULL,
  `sugestao` text CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `satisfacao`
--

INSERT INTO `satisfacao` (`codPesquisa`, `codOrganizacao`, `codMeio`, `data`, `email`, `servico`, `atendimento`, `qualidade`, `tempo`, `instalacoes`, `qualidadePresencial`, `sugestao`) VALUES
(1, 19, 1, '2022-09-13', NULL, 10, 10, 10, 9, 10, 10, NULL),
(2, 18, 2, '2022-09-14', 'carlospereiraadv0802@gmail.com', 10, 10, 10, 6, 6, 8, 'Só precisa melhorar na questão de tempo de conclusão de processo'),
(3, 11, 1, '2022-09-13', NULL, 8, 9, 5, 1, 0, 9, 'Mas agilidade na hora de analisa os casos'),
(4, 16, 3, '2022-12-14', NULL, 7, 5, 5, 10, 6, 6, 'A RM precisa capacitar melhor seus analistas e alinhar as informações com as OM\'s e com a DFPC, referente a tempo de processos, bug de sistema e até como proceder de acordo com a situação de cada problema. Atendimento presencial na RM deveria ser de uma analisa alguém que entenda o sistema de dentro, e não apenas um SD que leva informação e trás informação sem ter entendido muito bem o que ouviu. Tem muito descaso de informação, principalmente. O requerente paga taxa pelos processos. Não é feito de maneira gratuita. Precisamos de melhorias, urgente.'),
(5, 8, 1, '2022-09-14', NULL, 10, 10, 10, 10, 10, 10, 'EXCELENTE ATENDIMENTO COM MILITARES ATENCIOSOS E ENTENDIDOS'),
(6, 8, 2, '2022-09-14', NULL, 10, 10, 10, 10, 9, 9, 'MELHORAR A INSTALAÇÃO FÍSICA PARA O ATENDIMENTO.'),
(7, 6, 2, '2022-09-14', NULL, 2, 7, 1, 1, 7, 1, 'Mas clareza nas informações, agilidade nos processos ao exemplo um processo físico levar mais de 15 dias para ser protocolado é um absurdo ,resposta por e-mail ou tel muito raro'),
(8, 5, 2, '2022-09-13', 'igorparenteivo@gmail.com', 10, 10, 10, 10, 10, 10, 'Atendimento com presteza e militares bem qualificados para atender ao público'),
(9, 6, 3, '2022-09-14', NULL, 7, 7, 5, 6, 8, 3, 'colocando todos os atos no Sisgcorp'),
(10, 16, 3, '2022-12-14', NULL, 7, 7, 1, 10, 8, 7, 'O tempo de estipulado de resposta dos formulário no fale conosco são de três dias. estão levando muitos dias para serem respondidos. Para a pessoa que não tem tempo de ir presencial na OM ou RM, este meio de contanto é o ideal. Mas se não for agilizada a resposta fica difícil. Gostaria de uma melhora no tempo de resposta dos formulários do FALE CONSOCO. Inclusive, alguns nem são respondidos.'),
(11, 5, 2, '2022-09-13', 'ricardo@detalhes.com.br', 10, 10, 10, 8, 10, 10, 'Apenas tentar reduzir o tempo total de finalização dos processos. Qualidade de atendimento está perfeita, pelo menos nas unidades que me atendem.'),
(12, 14, 3, '2022-12-15', 'Processocac@hotmail.com', 1, 1, 1, 1, 1, 1, 'O problema persiste por mais de 2 meses e nunca me mandam uma solução, apenas informam que é um bug do sistema e nada resolvem'),
(13, 5, 1, '2022-09-13', 'ahgfadvogados@hotmail.com', 9, 9, 9, 9, 9, 9, 'Perfeito'),
(14, 16, 1, '2022-12-15', NULL, 1, 1, 1, 1, 4, 1, 'Resolver o problema seria uma boa coisa.'),
(15, 9, 2, '2024-06-25', 'Antônio Alves da Silva filho ', 8, 8, 8, 9, 6, 8, NULL),
(16, 18, 3, '2024-06-25', 'franklin.lima@iitb.pe.gov.br', 8, 7, 7, 5, 0, 5, 'Respostas mais eficazes.'),
(17, 5, 2, '2022-09-13', 'emmanuelcarvalho@gmail.com', 10, 10, 10, 8, 10, 10, 'Apenas com relação a ampliação do dias da semana para atendimento ao público, poderia ser durante toda a semana. Com relação as aspectos gerais, parabenizo minha OM simplesmente pelo trabalho profissional e conhecimento de toda legislação. Em especial ao Sr. Major Rodrigues, Sr. Sub. Calisto e deixo meu reconhecimento ao Sr. Sub. Ananias (Pelos excelentes serviços prestados durante sua permanencia) - Parabéns ao Comandante da OM, pela equipe. Temos relatos de colegas que evitam mudar de bairro para não perderem o vinculo com a região e os profissionais que ali trabalham.'),
(18, 9, 4, '2024-06-25', 'nhshhotingclub@gmail.com', 10, 10, 10, 10, 7, 8, NULL),
(19, 8, 2, '2022-09-14', 'henrriquemeira38@gmail.com', 10, 10, 10, 10, 10, 10, 'Tá excelente'),
(20, 16, 3, '2022-12-16', 'Brennokevyn@gmail.com', 10, 10, 10, 10, 10, 10, 'Tudo em perfeita ordem.'),
(21, 15, 4, '2024-06-25', 'ferolima@gmail.com', 7, 8, 8, 10, 9, 7, 'Melhorar o atendimento telefônico '),
(22, 4, 4, '2024-06-25', 'defenseconsultoria@yahoo.com', 7, 1, 1, 1, 6, 1, 'Todos os atiradores desportivos desta região vem sofrendo com a demora de mais de 180 dias de análise dos processos. Como também a insuficiência de informações quanto aos procedimentos. Por ex. temos processos protocolados em janeiro e na fila para análise. É preciso uma intervenção URGENTE da DFPC na SFPC da 7 RM e suas OMS '),
(23, 8, 2, '2022-09-14', 'joailson.ubirajara@hotmail.com', 10, 10, 10, 10, 10, 10, 'Tá bom assim'),
(24, 14, 3, '2022-12-16', NULL, 10, 10, 10, 10, 0, 10, NULL),
(25, 5, 2, '2022-09-13', NULL, 10, 10, 10, 10, 10, 10, NULL),
(26, 13, 3, '2022-12-17', 'jessicaleitejp@hotmail.com', 8, 10, 8, 3, 8, 8, 'Concertando os bugs.'),
(27, 5, 2, '2022-09-13', 'contato@speedclube.com.br', 10, 10, 10, 10, 10, 10, 'VOCÊS SÃO UMAS DAS MELHORES OM NO MOMENTO'),
(28, 16, 3, '2022-12-19', 'defesacivil.traipu@gmail.com', 10, 10, 10, 5, 10, 7, 'Uma forma de informar o andamento mais rápido.'),
(29, 11, 3, '2022-09-13', NULL, 1, 1, 1, 1, 6, 1, 'Parando de inventar exigências descabidas em relação aos processos'),
(30, 12, 2, '2022-12-22', 'josieksonbrito@gmail.com', 2, 1, 1, 1, 10, 1, 'processor sendo indeferidos sem motivo'),
(31, 5, 2, '2022-09-13', NULL, 10, 10, 10, 10, 10, 10, 'Colocando mais militares na seção'),
(32, 18, 1, '2022-12-27', 'Renanlive2022@gmail.com', 1, 1, 1, 1, 1, 1, 'Tem mais atenção'),
(33, 4, 1, '2022-09-13', NULL, 10, 10, 10, 10, 10, 8, NULL),
(34, 6, 2, '2022-09-14', 'josematheusrodrigues1@outlook.com', 10, 10, 10, 10, 10, 10, NULL),
(35, 14, 3, '2022-12-30', NULL, 10, 10, 10, 10, 0, 10, NULL),
(36, 5, 1, '2022-09-13', NULL, 5, 5, 5, 2, 6, 5, 'Terceirizando o serviço....'),
(37, 8, 1, '2022-09-14', NULL, 10, 10, 10, 10, 10, 10, 'Agilizar mais os processos quando retornar de pendecia dando prioridade na fila'),
(38, 17, 3, '2023-01-12', 'rgomonteiro@gmail.com', 10, 10, 10, 9, 10, 10, 'Liberar acompanhamento on-line das transferências de CAC para CAC'),
(39, 6, 1, '2022-09-14', 'harrisonviana@hotmail.com', 9, 9, 9, 9, 9, 9, 'Estou satisfeito com os serviços'),
(40, 5, 2, '2022-09-13', NULL, 10, 10, 10, 10, 9, 10, NULL),
(41, 17, 3, '2023-01-17', NULL, 10, 10, 10, 10, 10, 10, NULL),
(42, 16, 2, '2024-06-25', 'Celialima27@gmail.com', 10, 10, 9, 9, 10, 9, 'Mais rapidez no retorno. '),
(43, 6, 1, '2022-09-14', NULL, 8, 8, 7, 3, 4, 4, 'Melhora o tempo de resposta dos processos enviados para análise.'),
(44, 6, 2, '2022-09-14', NULL, 1, 1, 1, 1, 1, 1, 'Principalmente não demorando anos para emitir um simples CRAF, GT, CR etc.'),
(45, 6, NULL, '2022-09-14', NULL, 3, 4, 4, 1, 5, 3, 'Aumentar o efetivo na averiguação de processos'),
(46, 15, 3, '2022-09-13', 'Augusto.coelho@gmail.com', 10, 10, 10, 6, 10, 4, 'Não tem atendimento por telefone nem página atualizada com informações como em outras RMs'),
(47, 16, 1, '2024-06-25', 'afpm@discente.ifpe.edu.br', 9, 9, 8, 9, 8, 8, 'Nos ajudar a procurar o que estamos querendo encontrar, pois essa resposta humana/automática é muito abrangente é a mesma coisa de perguntar onde fica determinada inscrição, daí vcs poderiam da mais detalhes, porém a resposta é \"tá no site X, referente a sétima região\", é a mesma coisa que vcs mandarem a gente ler um edital de 200 páginas todinha, é a mesma coisa da gente está no Rio de Janeiro e perguntar onde fica o 7° RM e vcs dizem que fica localizado em Pernambuco... Certo, mais da  uma informação mais específica, mais acertiva.'),
(48, 5, 3, '2022-09-13', 'itiel.santos@yahoo.com.br', 10, 10, 10, 10, 10, 10, NULL),
(49, 17, 1, '2024-06-25', NULL, 8, 8, 8, 5, 9, 7, 'Não creio que possam melhor alguma coisa enquanto persistir todas essas alterações quase que semanais, são muitas indefinições vindas nas portarias.'),
(50, 8, 2, '2022-09-14', NULL, 10, 10, 10, 10, 10, 10, NULL),
(51, 18, 2, '2023-01-20', NULL, 10, 10, 10, 10, 10, 9, 'Sistema de agendamento p atendimento'),
(52, 16, 1, '2024-06-25', NULL, 1, 1, 1, 1, 4, 1, 'Sendo mais ágeis e tendo mais canais de atendimento'),
(53, 8, 2, '2022-09-14', NULL, 8, 8, 6, 8, 7, 2, NULL),
(54, 2, 2, '2023-01-23', NULL, 7, 7, 7, 8, 6, 8, NULL),
(55, 8, 2, '2022-09-14', NULL, 10, 10, 10, 10, 9, 10, NULL),
(56, 11, 4, '2024-06-25', 'capescaassessoria@gmail.com', 10, 10, 10, 10, 10, 10, 'Apenas para Pessoa Física, pois em nossa loja também tratamos de processo de CAC. Quanto ao Jurídico tem rápida resposta não tem o que melhorar. '),
(57, 2, 2, '2023-01-23', NULL, 7, 7, 7, 8, 6, 8, NULL),
(58, 6, 4, '2024-06-25', 'Thiago.limeira@hotmail.com', 2, 3, 2, 2, 6, 3, 'Atender telefone, responder e-mails, analisar processos com mais rapidez, não indeferir/restituir processos com exigências descabidas, entender que vcs são funcionários públicos e prestam serviço para população que paga muitos impostos e ainda as taxas por cada processo.'),
(59, 8, 3, '2023-01-25', NULL, 9, 9, 10, 8, 0, 8, 'Serviço bom, só um pouco demorado, lento.'),
(60, 5, 1, '2022-09-13', 'christiano_antunes@terra.com.br', 9, 9, 9, 9, 8, 8, 'Melhorar o Sisgcorp. Obrigado!'),
(61, 1, 4, '2024-06-25', NULL, 10, 10, 9, 9, 9, 8, NULL),
(62, 6, 1, '2023-02-13', 'luxdex@realiza.com.br', 5, 5, 5, 5, 5, 5, '13/02/23 consulta pelo Site não funciona o Formulário - Prezados, bom dia! Poderiam por gentileza nos informar o andamento do processo Empresa: EDITORA E DISTRIBUIDORA EDUCACIONAL - CNPJ: 38.733.648/0039-12 - Processo de Cancelamento de CR - Protocolado 02/22 - Obrigada - Celia R.S.T. Cavalcante - luxdex@realiza.com.br'),
(63, 5, 1, '2022-09-13', 'jromeroferreira@gmail.com', 10, 10, 10, 10, 9, 8, 'Serviço do 14BLOG muito bom!'),
(64, 2, 4, '2024-06-25', NULL, 1, 1, 3, 1, 2, 1, 'em tudo!'),
(65, 15, 2, '2022-09-13', NULL, 10, 10, 10, 10, 8, 10, NULL),
(66, 8, 1, '2022-09-14', 'DESPACHANTESHOTGUN@GMAIL.COM', 10, 10, 10, 10, 10, 10, NULL),
(67, 8, 2, '2022-09-14', NULL, 10, 10, 10, 10, 10, 10, 'Esclarecendo mais as restituição'),
(68, 12, 4, '2024-06-25', NULL, 3, 5, 3, 1, 1, 1, 'poderiam padronizar as analise dos processos, ao inves de cometer erros como vem acontecendo com frequencia.'),
(69, 5, 2, '2022-09-13', NULL, 10, 10, 10, 10, 10, 10, NULL),
(70, 6, 1, '2022-09-14', NULL, 9, 9, 9, 6, 8, 9, 'Creio ser necessário um efetivo maior para análise processual.'),
(71, 6, 3, '2023-02-14', 'jhomersonsilvah2@gmail.com', 10, 10, 10, 10, 10, 10, 'Climatização do ambiente'),
(72, 5, 3, '2022-09-13', 'sergioaugustoadv152@gmail.com', 10, 10, 10, 10, 10, 10, 'Atendimento Excelente'),
(73, 8, 2, '2022-09-14', NULL, 7, 8, 8, 9, 10, 8, 'Continuando'),
(74, 19, 3, '2023-03-15', NULL, 10, 10, 10, 10, 9, 10, NULL),
(75, 8, 2, '2022-09-14', NULL, 8, 7, 7, 6, 5, 6, NULL),
(76, 2, 2, '2023-03-22', NULL, 9, 9, 10, 8, 4, 9, 'As instalações são precárias necessitando de uma sala mais ampla, pois no momento todos ficam exprimidos em uma área muito pequena e cheia de papel.'),
(77, 12, 4, '2024-06-25', 'flaviove@gmail.com', 6, 7, 9, 1, 5, 7, 'Sendo mais breve nas conclusões dos processos.'),
(78, 19, NULL, '2023-03-22', NULL, 10, 10, 8, 10, 5, 3, 'Disponibilizar telefone fixo para tirar dúvidas.'),
(79, 19, 4, '2024-06-25', NULL, 9, 10, 10, 10, 1, 10, 'Melhoria nas instalações de Internet, predial com infiltração e vazamento de água na recepção, melhorar tempo de resposta de emissão de CR, como também o de 2 via de declaração que demora muito para ser respondido, unificar todas as informações de processo no parque de manutenção e não ter que direcionar para 7 RM fazer as verificação da documentação onde demora muito para resposta, nem contato telefônico lá na 7 RM eles atendem. '),
(80, 6, 2, '2023-04-04', NULL, 6, 7, 7, 7, 9, 6, 'Alguns processos são analisados pela RM, assim sendo, se faz necessário o canal direto do CAC, loja e clube com a RM. O uso do fale SFPC não está tendo resposta.'),
(81, 7, 1, '2024-06-25', NULL, 1, 1, 1, 1, 1, 1, 'Inicialmente para que possa sugerir melhoras no serviço precisaria que vocês tivessem respondido aos meus emails, pois enviei 3 e ( já tem cerca de 3 há 4 meses que foram enviados) até hoje não recebi nenhum retorno.\nVale ressaltar que estamos vivendo momentos de muitos questionamentos em virtude das mudanças ocorridas neste governo para os CAC´s e tais email foram enviado com questionamentos os quais reforço, até hoje não foram respondidos.\nPortanto, a minha avaliação para o 16 BI Mtz é péssima!'),
(82, 16, 1, '2022-09-13', NULL, 7, 9, 9, 10, 9, 7, NULL),
(83, 19, 2, '2023-04-17', 'Krlos.andre@hotmail.com', 10, 10, 10, 10, 10, 10, 'Excelente atendimento, profissionais de primeira!'),
(84, 6, 3, '2022-09-14', NULL, 1, 8, 7, 1, 8, 1, 'Agilizando os processos, está muito lento.'),
(85, 5, 1, '2022-09-13', 'felizzola@hotmail.com', 10, 10, 10, 5, 8, 10, 'Só tenho elogios, a presteza e gentileza do cap Rodrigues e inigualável sem contar a simpatia de Calixto, está OM é referência em atendimento, as demoras nós processos são em sua maioria quando chegam na 7RM'),
(86, 16, 1, '2023-04-25', 'Parabéns ao retorno', 10, 10, 10, 5, 10, 9, 'Analisando os processos do Sisgcorp mais rápido.'),
(87, 6, 1, '2022-09-14', 'Jcnildo@hotmail.com', 3, 4, 5, 3, 4, 5, 'Melhorar o tempo de resposta das solicitações'),
(88, 19, 3, '2023-04-28', NULL, 10, 10, 10, 10, 10, 10, 'Os serviços são prestados com excelência, no prazo com atenção e respeito. Muito bom, vocês estão de parabéns. Muito grato'),
(89, 5, 2, '2022-09-14', 'dudajack@hotmail.com', 10, 10, 10, 10, 10, 10, NULL),
(90, 6, 3, '2022-09-14', NULL, 3, 8, 1, 1, 9, 2, 'Com mais agilidade nos processos'),
(91, 12, 1, '2023-04-28', NULL, 10, 10, 10, 10, 10, 10, NULL),
(92, 5, 2, '2022-09-14', 'capswat@hotmail.com', 10, 10, 10, 10, 9, 10, 'A RM tentar melhorar nos prazos.'),
(93, 12, 3, '2024-06-25', NULL, 8, 10, 8, 9, 8, 8, 'Inserindo alguns serviços no sisgcorp tais como apostilamento de prensa e matrizes, mudança de níveis '),
(94, 6, 2, '2022-09-14', 'jampaulomedeiros@hotmail.com', 5, 8, 5, 1, 9, 1, 'Os processos estão demorando muito para tramitar e serem transferidos para a 7ª e agora não há mais um telefone que possamos falar diretamente com a unidade (15º Bl).'),
(95, 18, 1, '2022-09-14', 'atire@ig.com.br', 10, 10, 10, 10, 10, 10, NULL),
(96, 6, 3, '2022-09-14', NULL, 1, 4, 3, 1, 5, 3, 'Faznedo nos prazos estabelecidos'),
(97, 18, 2, '2022-09-14', 'vieira.desp.armas@outlook.com', 10, 10, 10, 8, 8, 10, 'melhorando o tempo de analise dos processos com mais analistas.'),
(98, 6, 3, '2022-09-14', NULL, 1, 1, 3, 1, 1, 1, 'Aumentando quantidades de colaboradores para no mínimo 20 , criando outros locais onde pode ser feito todo o trâmite e diminuindo a burocracia.'),
(99, 2, 2, '2022-09-14', NULL, 1, 1, 1, 1, 0, 5, NULL),
(100, 9, 4, '2024-06-25', NULL, 10, 10, 10, 1, 6, 10, NULL),
(101, 5, 4, '2024-06-25', 'amandaleo39@gmail.com', 10, 10, 10, 10, 10, 10, NULL),
(102, 2, 2, '2024-06-25', NULL, 1, 1, 1, 1, 0, 1, '1)Melhorar telefonia. Por varias vezes liguei para a 10°cia e cmb porém a mensagem sempre é pra tentar mais tarde. \n2) Instruir/esclarecer melhor os servidores que são responsáveis pelo setor SFPC. Quando por sorte o telefone funciona e um militar atende, as informações são bem desencontradas com a informada a meses antes.\n3) Maior celeridade nas análises (Principio da eficiência). Mais de 90 dias para analisar uma mera autorização de compra para equipamento de recararga, onde é analisado apenas um documento de identificação.'),
(103, 6, 3, '2022-09-14', 'luizclaudio.tuba@gmail.com', 5, 5, 5, 2, 5, 5, 'validar o processo quando solicitado a tempo hábil para disputar um campeonato, exemplo brasileiro que é importante para os atiradores esportivos.'),
(104, 10, 2, '2023-05-08', 'rddocumental@gmail.com', 10, 10, 9, 10, 8, 9, 'É necessário uma comunicação mais breve entre 7 região e OM.'),
(105, 16, 4, '2024-06-25', 'Diegoalvestatico01@gmail.com', 1, 1, 1, 1, 1, 1, 'Cumprindo com  om a lei. '),
(106, 6, 1, '2022-09-14', NULL, 1, 1, 1, 1, 1, 1, 'Atendendo mais rápido com eficácia.'),
(107, 13, 2, '2022-09-14', NULL, 10, 10, 10, 6, 0, 10, 'Somente o tempo de espera dos processos'),
(108, 6, 1, '2023-05-08', NULL, 3, 5, 5, 1, 5, 5, 'Agilidade e espera dos processos abaixo das expectativas'),
(109, 8, 4, '2024-06-25', 'sv.assessoria.2018@gmail.com', 10, 10, 10, 10, 10, 10, 'Mantendo o nível de atendimento'),
(110, 6, 1, '2022-09-14', 'lucasfernandesdecarvalho@gmail.com', 10, 10, 10, 10, 10, 10, NULL),
(111, 10, 2, '2023-05-08', NULL, 10, 10, 10, 10, 10, 10, 'Perfeito.'),
(112, 18, 2, '2022-09-14', NULL, 7, 9, 10, 5, 5, 10, 'Disponibilizando mais analistas para a seção a fim de dar mais vazão aos processos'),
(113, 6, 4, '2024-06-25', NULL, 8, 8, 2, 2, 10, 7, 'Não travar processos nas mãos dos integrantes do SFPC, tive até solução de pendência que passou mais de duas semanas na mão do SFPC e o processo foi indeferido por não terem anexado no sistema, processos que passou meses pra entrar no sistema, pedido de GT para mudança de endereço que foi analisada após a GT ter vencido, pedido de GT para competição que venceu por passar mais de 30 dias na fila'),
(114, 6, 1, '2022-09-14', NULL, 4, 4, 4, 1, 0, 3, 'Agilidade'),
(115, 15, NULL, '2023-05-18', NULL, 7, 9, 6, 8, 8, 1, 'Melhorando com informação do número de telefone.'),
(116, 16, 3, '2024-06-25', NULL, 8, 8, 10, 8, 10, 8, 'No Fale com a SFPC fui bem atendido algumas vezes, mesmo recebendo apenas respostas, porém nas últimas vezes nem respostas, por exemplo da última vez tive dois processos identicos de 2ª via de CRAF que não deveria alterar a validade do CRAF, porém foram alteradas para vencerem com apenas dois meses, fiz o pedido de revisão no Fale com a SFPC, como eram dois processos fiz duas vezes, uma para cada processo, um foi respondido e colocou a validade correta e o outro nem resposta houve'),
(117, 18, 2, '2022-09-14', 'mineriosbj_almoxarifado@hotmail.com', 10, 10, 9, 10, 9, 10, 'No momento não tenho nada a declarar, pois todas as vezes que precisei de atendimento consegui resolver minhas pendencia.'),
(118, 18, 1, '2023-06-12', NULL, 10, 10, 10, 10, 10, 10, 'Não sei como melhorar, pois todo meu processo está tudo certo, na minha primeira transferencia de sinarm para sigma foi rápido e essa transferencia de sigma para sigma que estou fazendo, foi diagnosticado uma pendencia, que já foi resolvida, muito obrigado aos militares que sempre estão avisando sobre a pendecia, e quando nós mandamos email para saber sobre algo, o retorno é rápido!!!'),
(119, 8, 2, '2022-09-14', 'Pedro2316224@hotmail.com', 9, 10, 9, 7, 9, NULL, NULL),
(120, 6, 1, '2024-06-26', 'brunorafael.s@hotmail.com', 8, 8, 8, 8, 8, 8, 'Site com orientação e passo-a-passo.'),
(121, 2, 1, '2022-09-14', NULL, 1, 1, 1, 1, 4, 3, 'Sendo mais prestativo e mais eficiente.'),
(122, 16, 1, '2024-06-26', NULL, 5, 1, 1, 1, 1, 1, 'Não deram retorno aos e-mails enviados, protocolo entrou em análise e faz meses que não tem alteração para finalização de processo.. Se quer melhorar, precisa urgentemente, atender de forma eficiente e mostrar todas as informações..'),
(123, 18, 2, '2022-09-14', 'carlapriscylla@hotmail.com', 10, 10, 10, 1, 10, 10, 'Acredito que com a demanda grande o quantitativo de operadores deveria aumentar dando assim mais agilidade aos processos.'),
(124, 14, 3, '2023-06-22', 'cftiropresidente@hotmail.com', 1, 1, 1, 1, 2, 1, 'melhorando o efetivo'),
(125, 6, 3, '2022-09-14', 'amaurymneto@hotmail.com', 1, 1, 1, 1, 2, 1, 'Atendendo o público de maneira Cortez e dentro de um prazo aceitável. 60 ou noventa dias no máximo.'),
(126, 12, 1, '2023-07-11', 'enoquejunior@bol.com.br', 1, 1, 3, 6, 6, 6, 'Atualizando o sistema, para que todos possam ser atendidos o mais rápido possível, pois estamos sem atendimento no SisGscorp.'),
(127, 6, 1, '2022-09-14', 'notlissalvador@gmail.com', 10, 10, 10, 10, 10, 10, NULL),
(128, 16, 1, '2023-07-26', NULL, 8, 8, 9, 7, 10, 9, 'Infelizmente depende da legislação. Seus serviços são ótimos, tudo dentro da lei'),
(129, 6, 1, '2022-09-14', 'georgegbelo2020@gmail.com', 10, 10, 10, 6, 9, 10, 'Menos tempo pra análise dos processos'),
(130, 16, 3, '2022-09-14', 'Aldem luiz da silva', 10, 10, 10, 10, 9, 10, NULL),
(131, 16, 4, '2024-06-26', 'venancio@alpekpolyester.com', 1, 3, 1, 1, 4, 1, '1) o telefone para contato (indicado na webpage) não atende.\n2) As instruções na página Web estão desatualizadas. Por exemplo: a instrução diz que para elaborar o formulário B3 é necessário usar os códigos do formulário B4. Porém, na realidade é preciso usar a Portaria 118 - COLOG 04/10/2019.\n3) Não há forma de consultar o processo via web. Isso dificulta sobremaneira o acompanhamento do processo. \n4) para saber do andamento do processo é necessário enviar um e-mail fazendo a solicitação que só é respondida após vários e-mails enviados.\n5) o analista do processo coloca pendências de documentações que já fazem parte do processo, ou seja, não são pertinentes. Bastaria uma análise dos documentos protocolados. \n6) as mesmas pendências são elencadas repetidas vezes. E o processo não evolui.'),
(132, 16, 1, '2023-07-31', 'Diogo_purcina@hotmail.com', 8, 9, 9, 8, 10, 9, 'Nada a acrescentar'),
(133, 16, 2, '2022-09-14', NULL, 8, 9, 9, 5, 8, 8, NULL),
(134, 18, 1, '2022-09-14', 'jsjoas@live.com', 6, 5, 6, 4, 5, 7, NULL),
(135, 16, 3, '2023-08-01', 'Ferolima@gmail.com', 4, 6, 6, 3, 10, 1, 'O link informado não funciona. Deveria ser fornecido um canal eletrônico como WhatsApp ou telegram . Muito difícil falar com sfpc.'),
(136, 16, 3, '2022-09-14', NULL, 4, 4, 7, 1, 7, 5, 'Diminuindo o tempo de espera porque e muito longo. Na minha humilde opinião deveria ter mais pessoas fazendo ós processos dó sisgcorp'),
(137, 16, 1, '2023-08-03', NULL, 10, 10, 1, 10, 10, 10, 'Recebi a informação da 7ª RM que os CRAFs estariam renovados no SIGMA, porém recebi a informação do 15 BI Mtz que os CRAFs não estão renovados e na prática os CRAFs que tenho em mãos não estão renovados, se na 7ª RM estão renovados e por isso foi indeferido os pedidos de renovação no SISGCORP (025098.23.035872 e 025098.23.035873), gostaria de saber a data que foi renovado e quem assinou tal pedido, pois não foi solicitado tal renovação e o primeiro CRAF foi emitido antes de Maio 2019 com validade até 2023, conforme cópia que foi anexado'),
(138, 16, 1, '2023-08-11', 'luxdex@realiza.com.br', 5, 5, 5, 5, 5, 5, 'Prezados Senhores, boa tarde, não conseguindo fazer a consulta dos processos de CR. Não tenho resposta dos e-mails enviados. Os telefones não atendem. Por gentileza aguardo uma posição sobre o andamento dos processos: PAREXGROUP IND. E COM. DE ARGAMASSAS Cnpj 88.028.873/0010-44; SEARA ALIMENTOS Cnpj 02914460/0449-56; EDITORA E DISTRIBUIDORA EDUCACIONAL Cnpj 38.733.648/0123-18; EDITORA E DISTRIBUIDORA EDUCACIONAL Cnpj 38.733.648/0039-12. Obrigada - Celia RST Cavalcante'),
(139, 2, 2, '2024-06-26', NULL, 1, 1, 1, 1, 1, 1, NULL),
(140, 6, 2, '2022-09-14', 'denilson_nadinhahotmail.com', 10, 10, 10, 10, 10, 10, 'Fui muito bem atendido , penso que só deveria estender o horário !'),
(141, 17, 3, '2024-06-26', NULL, 9, 10, 9, 8, 10, 7, NULL),
(142, 6, 3, '2022-09-14', 'fcpetrucci@gmail.com', 10, 10, 10, 10, 10, 10, NULL),
(143, 11, 1, '2024-06-26', 'weldeni.pereira@hotmail.com', 10, 10, 10, 10, 10, 10, 'achei tudo justo e perfeito'),
(144, 11, NULL, '2022-09-14', NULL, 3, 7, 7, 1, 8, 4, 'Tenho meu CR a quase 10 anos. Não consigo compreender como uma mera autorização de compra, de forma eletrônica, leva mais de 60 dias pra ser analisada e deferida. Sei que existem as deficiências de pessoal e material, entretanto essa problemática é antiga e nada, até a presente data foi feito pra mudar essa situação? É incompatível com o atual mundo globalizado que vivemos processos, especialmente eletrônicos, levarem mais de uma semana pra serem despachados, quiçá, mais de 2 meses.... Em qualquer empresa privada pessoas já teriam sido demitidas, ou a empresa simplesmente fecharia! Minha única reclamação é com o TEMPO DE ANALISE DOS PROCESSOS.'),
(145, 8, 3, '2022-09-15', 'przizelioalves@gmail.com', 10, 10, 10, 10, 10, 10, NULL),
(146, 18, 4, '2024-06-26', NULL, 1, 5, 1, 1, 5, 1, 'Dando deferimento nos processo que já está de acordo com o novo decreto. '),
(147, 4, NULL, '2022-09-14', 'ribadosaxalto@hotmail.com', 6, 7, 8, 1, 10, 10, NULL),
(148, 2, 3, '2022-09-15', NULL, 10, 10, 10, 10, 10, 10, 'Ter maior agilidade nos processos de aquisição de CR e Pedidos de compra de PCE'),
(149, 4, 1, '2022-09-14', 'Erivanguerra3@icloud.com', 10, 10, 10, 5, 10, 10, 'Mais agilidade nos processos !'),
(150, 17, 3, '2022-09-15', NULL, 4, 6, 5, 1, 8, NULL, 'Mais agilidade na condução dos processos!'),
(151, 18, 1, '2022-09-14', NULL, 10, 10, 10, 10, 10, 10, NULL),
(152, 11, 2, '2022-09-14', NULL, 10, 10, 10, 5, 10, 4, 'Agilidade nos processos'),
(153, 6, 2, '2024-06-26', 'wesleycesar85@gmail.com', 1, 1, 1, 1, 1, 1, 'agilizando os processos de analises. estou com processo em ANALISE, desde 15/05/2023. '),
(154, 14, 2, '2022-09-14', 'tiago.agillizeassessoria@gmail.com', 5, 6, 6, 2, 10, 3, 'Os atendentes e equipe são pessoas excelentes o problema é que os batalhões vivem sem internet, sem telefone, e nunca conseguimos agilizar os pedidos ou ate mesmo conversar com o pessoal, seja por e-mail, seja pelo que seja porque nunca funciona, os batalhões deveriam ter um link dedicado, ai sim funcionaria bem para todos.'),
(155, 18, 4, '2024-06-26', 'jumarcelo455@gmail.com', 1, 1, 1, 1, 1, 1, NULL),
(156, 16, 1, '2023-10-30', 'robertmeloseven07@gmail.com', 10, 10, 10, 10, 10, 10, 'ATENDIMENTO VIA WHATSAPP'),
(157, 18, 1, '2024-06-26', '.', 1, 1, 1, 1, 5, 4, 'Deferido todos os processos pendentes '),
(158, 18, 2, '2022-09-15', 'marconefiel@hotmail.com', 7, 9, 9, 2, 6, 9, 'Era bom que todos os serviços ficassem na OM, e não fosse mais para RM, o serviço da RM está muito ruim.'),
(159, 4, NULL, '2023-11-01', NULL, 1, 1, 1, 1, 10, 1, 'Os contatos telefônicos não funcionam'),
(160, 18, 2, '2024-06-26', NULL, 1, 1, 1, 1, 1, 1, 'Resolvendo nossas necessidades!!!!faz uns 6 meses que estou tentando transferir uma arma para meu nome!!!!! Absurdo'),
(161, 6, 2, '2022-09-15', NULL, 8, 8, 8, 7, 9, 8, 'Poderia ser mais ágil na liberação dos processos . Demora muito um craf por exemplo …'),
(162, 18, 1, '2024-06-26', NULL, 1, 1, 1, 1, 1, 1, 'Os processos não estão sendo analisados e não estão sendo deferidos.'),
(163, 6, NULL, '2022-09-15', NULL, 1, 1, 1, 1, 1, 1, 'Sendo mais eficientes.'),
(164, 12, 4, '2024-06-26', 'juridicoroncalli@gmail.com', 4, 4, 4, 4, 1, 5, 'Sequer tem um analista para atender. Nada se resolve porque tudo vai ser passado para a RM, a qual a gente só ouve falar e não tem nem telefone. A resposta não chega nunca para resolução dos problemas que muitas vezes são causados por indeferimentos sem qualquer justificativa plausível.'),
(165, 4, 3, '2022-09-14', 'cristianobezerra1967@gmail.com', 10, 10, 10, 10, 10, 10, 'Fui muito bem atendido'),
(166, 8, 2, '2022-09-15', NULL, 10, 10, 10, 10, 10, 10, NULL),
(167, 2, 2, '2022-09-14', 'Alissonazevedo2011@gmail.com', 8, 8, 8, 7, 10, 9, NULL),
(168, 6, 2, '2022-09-15', NULL, 3, 3, 9, 1, 9, 5, 'Agilizando os processos.'),
(169, 11, NULL, '2023-11-13', 'bhgsilva79@gmail.com', 5, 5, 4, 5, 7, 4, 'Esse serviço de formulários é muito bem vindo desde que as perguntas realmente sejam respondidas aos usuários, ja que há dificuldades de comunicação ( telefone e e-mail ) com as OM\'s e até de conhecimento por parte das equipes.'),
(170, 4, 2, '2023-11-17', NULL, 8, 10, 8, 5, 10, 1, 'Os telefones não atendem, o serviço de agendamento tbm não'),
(171, 19, 3, '2023-12-13', NULL, 2, 2, 1, 1, 1, 2, 'Informando de forma clara e objetiva os horários de atendimento, colocando funcionários eficientes e que se preocupem em realizar as atividades necessárias.'),
(172, 16, 4, '2024-06-26', 'mmcassessoria@outlook.com', 9, 10, 8, 7, 8, 8, 'Dando celeridade as solicitações efetuadas pelo fale com a SFPC.'),
(173, 13, 4, '2024-06-27', 'jessicaleitejp@hotmail.com', 7, 6, 5, 7, 6, 1, 'Um número de telefone que possamos ligar, tirar nossas dúvidas, já é um bom começo.'),
(174, 5, 1, '2022-09-14', NULL, 7, 10, 10, 5, 6, 10, 'Acredito que a demora na conclusão dos processo relativos aos PCE devam-se ao quadro de analistas ser muito pequeno como SFPC, e nós também, gostaríamos que fosse. Afora isso, só tenho a elogiar o tratamento prestado pela elos que fazem SFPC.'),
(175, 9, 4, '2024-06-27', NULL, 1, 1, 1, 1, 8, 1, 'A SFPC possui um horário de atendimento terrível. Não só funciona somente dois dias por semana, como a janela de atendimento em cada dia é pífia, inferior à 4 horas. Ademais, não possui acessibilidade através de telefone e não atende emails.'),
(176, 18, 1, '2022-09-14', NULL, 8, 8, 8, 8, 8, 8, 'Tendo resposta imediata'),
(177, 19, 3, '2024-01-16', NULL, 10, 10, 10, 10, 10, 10, NULL),
(178, 18, 1, '2022-09-15', 'Marcela.washington@chlorumsolutions.com', 10, 10, 10, 9, 9, 10, NULL),
(179, 12, 1, '2024-01-18', 'williamsmatoseco@gmail.com', 1, 10, 1, 1, 4, 1, 'Atendendo a sociedade com responsabilidade e compromisso.'),
(180, 5, 2, '2022-09-16', 'fredericomtavares@hotmail.com', 5, 6, 5, 1, 10, 10, 'Tornando o serviço mais ágil.'),
(181, 17, NULL, '2024-06-27', NULL, 9, 9, 9, 10, 7, 8, NULL),
(182, 5, 3, '2022-09-16', NULL, 10, 10, 10, 10, 10, 10, 'O serviço presencial está excelente nada a reclamar.'),
(183, 8, 2, '2022-09-19', 'britogutemberg@bol.com.br', 10, 10, 10, 10, 10, 10, NULL),
(184, 12, NULL, '2024-01-18', NULL, 1, 10, 2, 2, 4, 3, 'Tentendo fazer oque tem que fer feito para ajudar e facilitar a vida do cidadão pagador de impostos. Não fazendo tudo para dificultar criando cada vez mais problemas.'),
(185, 5, 2, '2022-09-19', 'evandro@tempest.com.br', 10, 10, 9, 10, 10, 10, 'Divulgando mais e melhor os dias e horários de atendimento presencial.'),
(186, 16, NULL, '2024-01-25', NULL, 1, 1, 1, 1, 1, 1, 'ATENDENDO O CIDADÃO'),
(187, 17, 4, '2024-06-27', 'j.piedrinho@hotmail.com', 1, 1, 1, 1, 1, 1, 'Precisa mudar de governo e de analistas .'),
(188, 7, 2, '2024-02-06', 'antonio.filho@halliburton.com', 10, 10, 9, 10, 10, 9, 'Atualização dos telefones uteis'),
(189, 13, 4, '2024-06-27', 'jessicaleitejp@hotmail.com', 7, 6, 5, 7, 6, 1, 'Um número de telefone que possamos ligar, tirar nossas dúvidas, já é um bom começo.'),
(190, 7, 1, '2024-02-17', NULL, 3, 5, 5, 7, 6, 4, 'O exército poderia ser mais claro em seus questionamento de restituição de processos'),
(191, 9, 4, '2024-06-27', NULL, 1, 1, 1, 1, 8, 1, 'A SFPC possui um horário de atendimento terrível. Não só funciona somente dois dias por semana, como a janela de atendimento em cada dia é pífia, inferior à 4 horas. Ademais, não possui acessibilidade através de telefone e não atende emails.'),
(192, 19, 1, '2024-03-14', NULL, 10, 10, 10, 10, 1, 10, 'Melhorar as instalações da recepção e colocar mais pessoas para atender !'),
(193, 6, 1, '2022-09-23', 'glaucioxf@gmail.com', 1, 3, 2, 1, 5, 1, 'Analisando processos de CR, de concessão de CR e de CRAF em tempo razoável. Pois uma demora de mais de dois meses apenas para concessão de CR é absurda. Tal demora é ainda pior.para um CRAF.'),
(194, 17, NULL, '2024-06-27', NULL, 9, 9, 9, 10, 7, 8, NULL),
(195, 14, 3, '2024-04-04', 'tcoliveira@agrovale.com', 10, 10, 10, 10, 8, 9, 'Excelente atendimento pelo setor de atendimento pelo CB José.'),
(196, 6, 1, '2022-09-23', NULL, 1, 3, 2, 1, 3, 1, 'Melhorando MUITO o tempo de análise para concessão de CR e também de CRAF, pois a demora atual é um absurdo. Mais de 60 dias apenas para um CR, e sem previsão de análise!'),
(197, 4, 1, '2024-04-09', NULL, 10, 10, 10, 10, 10, 10, 'Acredito que tendo mais recursos para resolver os problemas referentes a processos a distância, como a melhora do SisGcorp, e talvez um canal de atendimento dentro do sisfpc para o civil e para o militar entrar em contato com um analista específico de um processo específico, para poder sanar as pendências da melhor maneira possível.'),
(198, 6, 3, '2022-09-23', NULL, 1, 2, 2, 1, 3, 3, 'Precisam urgentemente fazer uma força tarefa para analisar processos de concessão de CR e CRAF. A demora está muito grande para uma análise documental. Mais de 2 meses apenas para um CR é um absurdo!'),
(199, 6, 1, '2022-09-26', 'japradosilva@gmail.com', 1, 3, 3, 1, 6, 1, 'Demora para analise dos processos'),
(200, 17, 4, '2024-06-27', 'j.piedrinho@hotmail.com', 1, 1, 1, 1, 1, 1, 'Precisa mudar de governo e de analistas .'),
(201, 14, 4, '2024-06-27', 'clealmir@hotmail.com ', 7, 9, 8, 4, 8, 3, 'Os telefones das unidades da 7ª RM, 14º BIMtz e Hospital da Guarnição de Natal, após ligação, não atendem ao chamado ou é informado que o número está errado. \n\nFui pessoalmente à 7ªRM para solicitar meu tempo de serviço para fins de aposentadoria, e,  não havia nenhuma anotação das minhas alterações no sistema. Mandei por e-mail a solicitação dos documentos ao CPOR/Recife, 14º BIMtz e para o HGuN em início de maio/24 e até o presente momento não recebi nenhum comunicado.    '),
(202, 19, 1, '2024-04-16', NULL, 7, 10, 7, 10, 5, 8, 'Liberar um acesso ao SICOVAB ou Acesso à informação prévia de cadastro de chassi no SICOVAB'),
(203, 6, 3, '2024-07-01', NULL, 3, 5, 3, 6, 8, 4, 'desburocratizando os processos, deixando as informações mais claras e videos orientando como realiza-se cada processo para que não haja dificuldades tanto para o cidadão de bem e a vossa instituição em avaliar os processos...'),
(204, 16, 3, '2024-05-09', NULL, 8, 8, 8, 5, 0, 6, 'Com mais presteza e maior disponibilidade de meios de comunicação.'),
(205, 6, 2, '2024-07-05', 'wesleycesar85@gmail.com', 1, 1, 1, 1, 1, 1, 'agilizando as analises dos processos'),
(206, 12, 4, '2024-08-08', 'cleber_gama@hotmail.com', 10, 10, 10, 10, 10, 10, 'Está tudo ok'),
(207, 16, 1, '2024-05-09', 'rozanasaturnino0@gmail.com', 10, 10, 10, 10, 10, 7, 'tendo um número whatsapp disponível, ou sendo mais rapidos no retorno via e-mail. mas de um modo geral gostaria de parabenizar o atendimento e prontidão na resolução do problema.'),
(208, 6, 3, '2022-09-26', NULL, 1, 3, 2, 1, 4, 2, 'O tempo de análise dos processos de CR e CRAF, com todo respeito, são absurdos. Se faz necessário ampliar a quantidade de analistas, e fiscalizações do prazo de análise, para que os processos sejam analisados com celeridade.'),
(209, 17, 4, '2024-05-20', NULL, 10, 10, 10, 10, 8, 10, 'Aumentar a sala para que às pessoas fiquem melhor acomodada, ficam setanda fora da sala'),
(210, 1, 2, '2022-09-30', NULL, 10, 10, 10, 10, 10, 10, NULL),
(211, 12, 4, '2024-08-08', 'rxtigadriano2017@gmail.com', 10, 10, 10, 10, 10, 5, NULL),
(212, 1, 2, '2022-09-30', NULL, 10, 10, 10, 10, 9, 10, 'SisGCorp apresenta muito atraso ocasionado por falhas do sistema.'),
(213, 12, 4, '2024-08-08', NULL, 10, 10, 10, 10, 10, 10, NULL),
(214, 19, 3, '2022-10-10', NULL, 9, 10, 6, 7, 10, 2, 'Em relação a liberação de Autorização de Transferencia o periodo deveria ser menos ,pois ja é entregue tudo pronto analisado de mediato e nao ha motivo de passar vários dias para liberacao.'),
(215, 19, 3, '2022-10-10', 'josinaldodiai@gmail.com', 8, 10, 10, 6, 6, 4, 'Uma atendimento melhor via telefone, que funcione.'),
(216, 18, 1, '2024-07-10', NULL, 1, 1, 1, 1, 7, 1, 'Agilizar as analises dos processos, pois, existem processos com mais de dois anos e ainda em analise. Telefones indicados no site, não funcionam.'),
(217, 17, 4, '2024-05-21', 'Waltermousinho@hotmail.com', 10, 10, 10, 10, 10, 10, 'Atendimento perfeito '),
(218, 6, 4, '2024-07-11', 'Sandroslvc@hotmail.com', 5, 5, 5, 1, 6, 2, 'dando mais seriedade a pedidos eu mesmo solicitei como pcd meu processos continua parados e uma simples segunda via de um registro nao sai e complicado estou participando do nacional com graf faltando ja renovado e nao sai para imprimir '),
(219, 17, 4, '2024-05-29', NULL, 8, 9, 9, 10, 8, 10, 'Havendo padronização nas informações dentre as unidades e também entre as RM.'),
(220, 16, 4, '2024-07-23', 'nilson.pimentel@gmail.com', 10, 10, 10, 10, 10, 10, '.'),
(221, 17, 4, '2024-06-03', NULL, 10, 10, 10, 10, 10, 10, NULL),
(222, 16, 4, '2024-08-02', 'pessoajuridica@scpconsultoria.com', 10, 10, 10, 10, 10, 9, NULL),
(223, 12, 4, '2024-08-06', 'Wagnerandre_@hotmail.com', 10, 10, 10, 8, 8, 10, NULL),
(224, 17, 4, '2024-06-03', 'andrebraw@gmail.com', 10, 10, 10, 10, 10, 10, 'Atendimento de excelência!!!'),
(225, 16, 2, '2022-10-11', 'willamferreiraaraujo@gmail.com', 5, 5, 4, 4, 9, 3, 'Buscar soluções para melhor resolução dos problemas enfrentados no sistema sisgcorp, atendimento pelo telefone quase impossível conseguir atendimento apenas chama ninguém atende'),
(226, 17, 4, '2024-06-03', NULL, 10, 10, 10, 10, 10, 10, 'Tudo perfeito! Meus parabéns a todos!'),
(227, 12, 4, '2024-08-08', 'Kimuradelmo@gmail.com', 10, 10, 10, 10, 10, 10, NULL),
(228, 12, 4, '2024-08-08', 'Felipe15lima@gmail.com', 10, 10, 10, 9, 10, 10, NULL),
(229, 6, 2, '2022-10-19', NULL, 10, 10, 10, 10, 10, 10, NULL),
(230, 17, 4, '2024-06-03', NULL, 10, 10, 10, 10, 8, 10, NULL),
(231, 12, 4, '2024-08-08', 'joelrafael96@gmail.com', 10, 10, 10, 8, 9, 10, 'Agilizar o tempo resposta do documento solicitado.'),
(232, 6, 3, '2022-10-21', NULL, 10, 10, 10, 10, 10, 9, 'Investir na seção ainda mais para manter o excelente desempenho do mesmo.'),
(233, 17, 4, '2024-06-03', NULL, 1, 2, 1, 5, 4, 2, 'Responder as perguntas feitas pelo whatsapp. Disponíbilizar um telefone para informações.'),
(234, 12, 4, '2024-08-08', 'lopinhoo9401@gmail.com', 10, 10, 10, 10, 10, 10, 'O serviço tá excelente '),
(235, 18, 3, '2022-10-23', NULL, 1, 1, 1, 5, 5, 1, 'O 7° GAC precisa alinhar melhor as informações prestadas e como proceder no recebimento e andamento de processos. É o quartel mais temido da região por demorar muito tempo e sempre ter dificuldades no processos. Poderiam criar outro quartel para dividir a demanda com o 7°GAC, tendo em vista que o mesmo não da conta sozinho de tantas cidades.'),
(236, 17, 4, '2024-06-03', NULL, 10, 10, 10, 10, 8, 8, 'Mantendo a qualidade do serviço '),
(237, 15, 4, '2024-08-08', 'moysesgustavo@yahoo.com.br', 5, 8, 4, 1, 4, 5, 'Resolvendo os problemas, apesar do fator humano ser impecável quanto a educação eu estou há mais de 1 ano e meio tentando resolver duas situações simples: 1 Compra de um PCE, 2 Alterar(ou corrigir) um registro meu que, não sei por culpa de quem pois não me foi informado por qual motivo ou responsabilidade., não está sendo corrigido.'),
(238, 7, 2, '2022-10-24', NULL, 1, 1, 1, 1, 9, 1, 'Tendo mais atenção com os usuários e atendimento presencial'),
(239, 17, 4, '2024-06-03', NULL, 8, 9, 8, 7, 8, 7, 'Procurando ajudar ainda mais os esportistas com informações dos processos em andamento, Ex: processos travados no sistema sem informação do setor, melhorar a comunicação e recebimento online de documentos onde temos Clubes e atiradores que estão longe da capital, todos nós precisamos melhorar em algum ponto e acho que precisa ser reconhecido internamente ideias de melhorias por integrantes do processo, que exista incentivo para melhorias do mesmo.'),
(240, 12, 4, '2024-08-08', NULL, 10, 10, 10, 10, 10, 10, NULL),
(241, 15, 2, '2024-08-08', 'moysesgustavo@yahoo.com.br', 5, 4, 4, 1, 4, 3, 'Novamente, resolvendo os problemas, segunda pesquisa que respondo mas esta foi por atendimento por telefone este é ainda pior! Pois quando o telefone está funcionando as vezes demora e ninguém atende, quando atende novamente o fator humano é impecável quanto a educação mas estou há mais de 1 ano e meio tentando resolver duas situações simples: 1 Compra de um PCE, 2 Alterar(ou corrigir) um registro meu que, não sei por culpa de quem pois não me foi informado por qual motivo ou responsabilidade., não está sendo corrigido.'),
(242, 12, 4, '2024-08-08', NULL, 10, 10, 8, 6, 9, 9, NULL),
(243, 16, 4, '2024-08-08', 'moysesgustavo@gmail.com', 3, 7, 3, 1, 8, 4, 'Não sei se por culpa da SFPC 7ªRM ou da da SFPC 7ªCIACOM (ou mesmo da DFPC) um simples problema de correção de cadastro não se resolve há mais de 1 ano e meio! E quando digo que não sei é porque não me foi informado mesmo, não sei qual o setor ou orgão responsável e apesar de muito educados o problema não é resolvido e não me foi dito por qual motivo ou por quem ele foi negado/recusado. Enquanto isso não consigo adquirir um simples PCE, me causando alguns transtornos e prejuízos. O pessoal (fator humano) sempre é muito educado mas a letargia do sistema e excessiva burocracia(parece um pleonasmo mesmo) dificulta o bom atendimento e resolução de simples problemas que em outras instâncias se mostra muito mais fácil e rápido de realizar, mesmo em orgãos federais.'),
(244, 16, 4, '2024-08-08', 'kimuradelmo@gmail.com', 10, 10, 10, 10, 10, 10, NULL),
(245, 12, 4, '2024-08-08', NULL, 10, 10, 10, 10, 10, 10, NULL),
(246, 12, 4, '2024-08-08', NULL, 10, 10, 10, 10, 10, 10, 'Agendamento por hora marcada seria uma opção para as próximas. '),
(247, 12, 4, '2024-08-08', NULL, 10, 10, 10, 10, 10, 10, 'Estou muito grato pelo atendimento que recebi. Muito obrigado '),
(248, 8, 3, '2022-10-27', NULL, 10, 10, 10, 10, 10, 10, NULL),
(249, 17, 4, '2024-06-03', 'cristina_anasilva@hotmail.com', 10, 10, 10, 10, 10, 10, NULL),
(250, 12, 4, '2024-08-08', 'salgueiroadvocacia@bol.com.br', 10, 10, 10, 10, 10, 10, NULL),
(251, 15, 3, '2022-10-28', 'valmir.380@hotmail.com', 10, 10, 10, 10, 10, 10, NULL),
(252, 17, 4, '2024-06-03', 'TALLYSON', 10, 10, 10, 10, 10, 10, NULL),
(253, 12, 4, '2024-08-08', 'J.marcoscarvalho@hotmail.com', 10, 10, 10, 10, 10, 10, NULL),
(254, 18, 2, '2022-10-31', 'ivosilva2014@bol.com.br', 3, 3, 1, 1, 1, 1, 'processo a meses pra correção sisgcop bugado e ninguem orienta a melhor forma de resolver'),
(255, 17, 4, '2024-06-03', NULL, 10, 10, 10, 10, 10, 10, NULL),
(256, 12, 4, '2024-08-08', 'romeropereiracavalcante3505@gmail.com', 10, 10, 10, 10, 10, 10, 'Vocês tão de parabéns '),
(257, 16, 1, '2022-11-01', 'sevdacio13@gmail.com', 7, 6, 5, 10, 0, 2, 'A 7° RM ainda assim, é a região militar na qual temos maior facilidade de contato, porém, o tempo estipulado para resposta dos chamados no formulários fale conosco são de três dias úteis. Mas muitas vezes leva mais de 10 dias. Isso dificulta e atrasa processos com erro no sistema que precisam de correção. E muitas vezes a informação das OM\'s é divergente de informações da própria região militar. O tempo na homologação dos processos de apostilamentos estão em excelência, parabéns pelo empenho. Só precisamos melhorar informações de como proceder em determinados processos. Um meio de comunicação formal, rápida e documentada facilitaria a vida de quem necessitada dos serviços militares, principalmente dos serviços de produtos controlados.'),
(258, 12, 4, '2024-08-08', NULL, 10, 10, 10, 10, 10, 10, NULL),
(259, 12, 4, '2024-08-08', 'maxtavarest@hotmail.com', 10, 10, 10, 10, 10, 10, 'Parabéns ao excelente atendimento '),
(260, 12, 4, '2024-08-08', NULL, 10, 10, 10, 10, 10, 10, NULL),
(261, 12, 4, '2024-08-08', 'rodrigo.fonseca.oliveira@live.com', 10, 10, 10, 10, 10, 10, NULL),
(262, 12, 4, '2024-08-08', 'wagner.rudolpho@hotmail.com', 10, 10, 10, 10, 10, 10, NULL),
(263, 12, 4, '2024-08-08', NULL, 10, 10, 10, 10, 10, 10, 'Não , tem como melhor , o atendimento é excelente !'),
(264, 10, 4, '2024-06-25', 'despachanteshotgun@gmail.com', 10, 10, 10, 10, 5, 10, NULL),
(265, 12, 4, '2024-08-08', 'michaelcouto@gmail.com ', 10, 10, 10, 10, 10, 10, NULL),
(266, 8, 4, '2024-06-25', NULL, 10, 10, 10, 10, 10, 10, NULL),
(267, 4, 3, '2022-11-07', 'Atendimento mal explicado e sem análise do caso em questão', 1, 1, 1, 1, 1, 10, 'Analisando o processo e restituindo o erro para ser concertado, o processo vai ser enviado para SFPC da 7rm solicitando restituição e chamar atenção do analista'),
(268, 12, 4, '2024-06-25', NULL, 8, 8, 7, 8, 7, 8, 'Fornecendo maior esclarecimento por parte da 7ªRM aos questionamentos quanto aos serviços da rede SFPC que hora acusam anormalidade. Assim como também, a padronização do entendimento consolidado quanto ao exigido em documentação e por fim sua publicidade aos usuários do serviço. '),
(269, 16, 3, '2022-11-17', NULL, 7, 6, 9, 1, 9, 10, 'Melhorando o tempo de andamento da analise dos processos do sisgcorp'),
(270, 16, 3, '2022-11-17', NULL, 6, 10, 4, 9, 6, 7, 'Quando se trata de erro de validação de cadastro inicial, por parte do usuário do SISGCORP ou do usuário (SISGCORP) a RM deveria facilitar a correção. mesmo o requerente tendo preenchido errado a SFPC validou o cadastro sem analise correta.'),
(271, 14, 1, '2024-09-25', NULL, 1, 5, 1, 1, 5, 1, 'O pessoal do 72 BI até tem a boa vontade,são bons profissionais, entretanto,a maioria das demandas não depende deles, e ,quando vai para 7Rm já era,mais de ano p resolverem.'),
(272, 12, 4, '2024-08-08', NULL, 10, 10, 10, 8, 5, 10, NULL),
(273, 7, 2, '2024-09-25', 'marceloalmeidabarroso@gmail.com', 10, 10, 10, 10, 10, 10, NULL),
(274, 12, 4, '2024-08-08', NULL, 10, 10, 10, 10, 10, 10, 'Só continuar como o atual.'),
(275, 14, 3, '2024-06-25', NULL, 5, 5, 1, 5, 7, 5, NULL),
(276, 12, 4, '2024-08-08', 'Willames.salazarr1@icloud.com', 10, 10, 10, 10, 10, 10, NULL),
(277, 7, 2, '2024-09-25', NULL, 9, 10, 9, 9, 9, 9, NULL),
(278, 5, NULL, '2022-11-17', 'aribeirolopesadv@gmail.com', 10, 10, 10, 8, 10, 10, 'Particularmente, o serviço atende as necessidades, apenas uma ressalva, melhorar o tempo de emissão de autização para compra de munição.'),
(279, 12, 4, '2024-08-08', NULL, 10, 10, 10, 10, 10, 10, 'Serviço maravilhoso com  presteza e educação.'),
(280, 6, 4, '2024-09-25', NULL, 10, 10, 10, 10, 10, 8, NULL),
(281, 16, 3, '2022-11-19', NULL, 7, 6, 1, 9, 7, 6, 'A RM precisa capacitar melhor seus analistas e alinhar as informações com as OM\'s e com a DFPC, referente a tempo de processos, bug de sistema e até como proceder de acordo com a situação de cada problema. Atendimento presencial na RM deveria ser de uma analisa alguém que entenda o sistema de dentro, e não apenas um SD que leva informação e trás informação sem ter entendido muito bem o que ouviu. Tem muito descaso de informação, principalmente. O requerente paga taxa pelos processos. Não é feito de maneira gratuita. Precisamos de melhorias, urgente.'),
(282, 12, 4, '2024-08-08', 'taismelo13@gmail.com', 9, 10, 10, 9, 9, 10, NULL),
(283, 7, 4, '2024-09-25', NULL, 10, 10, 10, 9, 8, 9, NULL),
(284, 16, 1, '2022-11-21', 'jefferson.w.carneiro@gmail.com', 10, 10, 10, 8, 10, 10, 'Acredito que as demandas são numerosas, sabemos do esforço do SFPC. Assim, eu gostaria de agradecer a todos os profissionais envolvidos e expressar o meu respeito ao trabalho do 7º RM, bem como o 4º BPE. Forte Abraço!'),
(285, 12, 4, '2024-08-09', NULL, 10, 10, 10, 10, 10, 10, 'O serviço prestado excelente '),
(286, 6, 4, '2024-09-25', NULL, 10, 9, 8, 6, 8, 7, NULL),
(287, 12, 4, '2024-08-09', 'eduardo.henrique@usinacaete.com', 10, 10, 10, 10, 10, 10, NULL),
(288, 3, 1, '2024-09-25', 'fernando@equipepe.com.br', 10, 10, 10, 10, 10, 10, NULL),
(289, 12, 4, '2024-08-09', 'albertomachadoadvogado@gmail.com', 10, 10, 10, 10, 10, 10, NULL),
(290, 16, 1, '2024-09-25', 'ac906062@gmail.com', 1, 1, 1, 1, 10, 1, 'Rapidez no atendimento!'),
(291, 7, 4, '2024-09-25', NULL, 4, 5, 5, 2, 5, NULL, NULL),
(292, 12, 3, '2022-11-24', 'miro.macena@gmail.com', 1, 5, 2, 1, 5, 1, '1. Unificando os bancos dos sistemas Sigma x Sisgcorp\n 2. Ampliando os dias e horários de atendimento aos CAC’s\n 3. Disponibilizando um canal de comunicação por telefone e/ou e-mail que realmente funcione'),
(293, 5, 4, '2024-09-25', 'hora.evandroc@gmail.com', 10, 10, 10, 10, 10, 10, NULL),
(294, 7, 4, '2024-09-25', 'empchcpex@gmail.com ', 9, 8, 9, 9, 8, 7, 'Melhorando o tempo de resposta e da avaliação  dos processos.'),
(295, 6, 4, '2024-09-25', NULL, 2, 3, 5, 1, 8, 4, 'Agilizar os serviços maior presteza nas informações '),
(296, 12, 4, '2024-08-09', 'caldinhodocarlao@hotmail.com', 10, 10, 10, 10, 10, 10, 'Este serviço no clube foi ótimo, pra mim está excelente.'),
(297, 8, 1, '2024-09-25', NULL, 8, 8, 8, 9, 9, 9, 'Manter o atendimento rápido '),
(298, 7, 3, '2022-12-08', 'Augustcms@hotmail.com', 3, 3, 2, 1, 7, NULL, NULL),
(299, 14, 2, '2024-09-26', 'claudenialvesbarros@gmail.com', 1, 1, 1, 1, 1, 1, 'Passando Mais Informações Sobre As Novas Leis Contra OS CAC '),
(300, 11, NULL, '2022-12-13', 'lucas.carv.emp@gmail.com', 8, 2, 5, 7, 8, 2, 'O 4BPE nao responde emails e nem ligação, mesmo indo pessoalmente lá não atendem ninguem, só falam para ligar ou mandar email. E fica esse looping sem resolução de mal atendimento.'),
(301, 6, 2, '2024-09-26', 'Thyagoanteryo77@gmail.com', 10, 10, 10, 10, 10, 10, 'Tá ótimo '),
(302, 7, 4, '2024-09-26', 'eliasjunior.ctb@gmail.com', 10, 10, 10, 10, 10, 10, NULL),
(303, 12, 4, '2024-08-09', NULL, 10, 10, 10, 10, 10, 10, NULL),
(304, 8, 4, '2024-09-26', 'pedrofilemonregis@gmail.com', 10, 10, 10, 10, 10, 10, NULL),
(305, 12, 4, '2024-08-09', 'cahcmcz@gmail.com', 10, 10, 10, 10, 10, 10, NULL),
(306, 10, 3, '2024-09-26', 'Cristiam_s@hotmail.com', 10, 10, 7, 7, 5, 5, 'Por telefone '),
(307, 12, 4, '2024-08-09', 'andersonhenrique.eng@gmail.com', 10, 10, 10, 10, 10, 10, NULL),
(308, 16, 1, '2024-09-26', 'benilton398@gmail.com', 10, 10, 10, 10, 10, 10, 'Ta excelente '),
(309, 12, 4, '2024-08-09', 'marcos_sergio2@hotmail.com', 10, 10, 10, 10, 10, 10, NULL),
(310, 7, 4, '2024-09-26', 'só.admnizia@gmail.com', 8, 10, 9, 6, 10, 5, NULL),
(311, 12, 4, '2024-08-09', 'joaofiorillo@hotmail.com', 10, 10, 10, 8, 8, 10, 'Foi tudo bem, graças a Deus. A única sugestão seria, na próxima vez, colocar mais dias de fiscalização no clube, pois um dia (conforme previsto inicialmente) foi pouco, não deu para todo mundo. Cheguei às 14:45,, bem antes do fim (16:00), e já haviam encerrado os atendimentos, de modo que tive que voltar no dia seguinte. Fora isso, o atendimento foi excelente.'),
(312, 17, 4, '2024-09-26', 'friccotenis@hotmail.com', 10, 10, 10, 10, 10, 6, 'ter maior brevidade nas respostas'),
(313, 8, 4, '2024-09-26', NULL, 10, 10, 9, 9, 8, 10, NULL),
(314, 6, 4, '2024-09-26', NULL, 10, 10, 8, 6, 9, 6, NULL),
(315, 6, 1, '2024-09-26', 'ffmaiant@gmail.com', 9, 9, 9, 8, 9, 8, 'Dando mais agilidade nos processos'),
(316, 7, 4, '2024-09-26', NULL, 10, 10, 10, 10, 10, 10, NULL),
(317, 6, 2, '2024-09-26', NULL, 10, 10, 10, 10, 10, 10, NULL),
(318, 6, 3, '2024-09-26', NULL, 1, 1, 1, 1, 1, 1, 'Ter respeito com o CAC'),
(319, 12, 4, '2024-08-10', 'paulosergiohonda@gmail.com', 10, 10, 10, 7, 10, 10, NULL),
(320, 3, 4, '2024-08-20', 'FERNANDO BRITO EQUIPE', 10, 10, 10, 10, 10, 10, 'Não necessário melhorar servico muito bom e eficiente '),
(321, 10, 4, '2024-08-21', 'despachanteshotgun@gmail.com\'', 10, 10, 10, 10, 10, 10, NULL);
INSERT INTO `satisfacao` (`codPesquisa`, `codOrganizacao`, `codMeio`, `data`, `email`, `servico`, `atendimento`, `qualidade`, `tempo`, `instalacoes`, `qualidadePresencial`, `sugestao`) VALUES
(322, 10, 4, '2024-08-21', 'despachanteshotgun@gmial.com', 10, 10, 10, 10, 10, 10, NULL),
(323, 6, 4, '2024-09-26', NULL, 10, 10, 10, 10, 10, 10, NULL),
(324, 8, 1, '2024-09-04', 'valterluisanto@gmail.com', 3, 4, 4, 2, 4, 3, 'Agilidade no atendimento'),
(325, 17, 4, '2024-09-26', 'rosidilson@hotmail.com', 10, 10, 10, 10, 10, 10, 'Os serviços prestados estão tudo nos conformes'),
(326, 6, 4, '2024-09-16', NULL, 10, 10, 8, 7, 10, 7, NULL),
(327, 8, 3, '2024-09-26', NULL, 8, 10, 10, 7, 0, 8, 'Mais agilidades nos processos para CAC '),
(328, 6, 4, '2024-09-16', 'menespqdt@gmail.com', 9, 10, 9, 9, 10, 9, 'Melhorar o acesso a seção com câmeras de identificação.'),
(329, 6, 4, '2024-09-27', NULL, 10, 10, 10, 10, 10, 10, NULL),
(330, 7, 4, '2024-09-17', 'Katharine@dudustandard.com.br', 10, 10, 5, 5, 7, 8, 'Exigindo da DFPC um sistema que funcione e da RM mais clareza com as informações, disponibilizando os memento aos usuários por exemplo, o atendimento das OM são excelentes.'),
(331, 10, 4, '2024-09-27', NULL, 10, 10, 10, 10, 10, 10, 'Só temos a agradecer, os serviços prestados por esse setor tem atendidos de forma exemplar a todos meus pleitos em relação as demandas do sfpc do Exército'),
(332, 5, 4, '2024-09-27', NULL, 10, 10, 10, 10, 10, 10, NULL),
(333, 6, 4, '2024-09-18', NULL, 10, 10, 8, 8, 10, 8, NULL),
(334, 10, 2, '2024-09-27', 'Francisco.gadelha@gmail.com', 6, 7, 8, 5, 6, 6, 'Na minha opinião ta tudo certo '),
(335, 7, 4, '2024-09-18', 'friccotenis@hotmail.com', 10, 10, 10, 10, 10, 8, 'Atendimento  ao telefone na Região '),
(336, 7, 4, '2024-09-30', 'nandoqueiroz@yahoo.com.br', 10, 10, 10, 10, 10, 10, NULL),
(337, 15, 2, '2024-09-18', 'daynaralatoyacosta@gmail.com', 1, 1, 1, 1, 1, 1, 'Com atendentes que realmente estejam dispostos a atender a solicitação do cliente. '),
(338, 6, 4, '2024-09-30', NULL, 10, 10, 9, 5, 9, 6, NULL),
(339, 7, 4, '2024-09-18', NULL, 10, 10, 10, 10, 10, 10, NULL),
(340, 7, 4, '2024-10-01', NULL, 10, 10, 10, 10, 10, 10, NULL),
(341, 7, 2, '2024-09-18', 'alphaamilitar@gmail.com', 10, 10, 10, 7, 10, 10, 'Serviço dos prestadores é Excelente fica claro o empenho no qual eles tentam resolver as demandas que por vez temos. '),
(342, 6, 4, '2024-10-02', NULL, 10, 10, 9, 8, 9, 9, NULL),
(343, 6, 4, '2024-09-19', NULL, 10, 10, 9, 6, 9, 7, 'Portão de entrada Ex: (campainha, interfone)'),
(344, 14, 4, '2024-10-02', 'allann@toptiro.com.br', 2, 10, 6, 1, 6, 6, 'Aumentando a quantidade de militares na seção, uma vez que tem pouquíssimo para a demanda da região. deixar os militares fixo, não sobrecarregando colocando em missão totalmente diferente do SFPC. tem processo demorando mais de 6 meses para ser analisados, CR, CRAF, AUTORIZAÇÃO DE COMPRA. Um verdadeiro absurdo com o atirador esportivo. Onde na região temos atiradores diversas vezes campeões brasileiros, estaduais e internacional, uma vergonha nacional o atiradores dessas magnitude não poder treinar porque o Exército Brasileiro, não faz o papel dele de analisar os processos em tempo correto como demanda a legislação em vigor.   '),
(345, 6, 4, '2024-09-19', NULL, 10, 10, 9, 6, 10, 7, NULL),
(346, 14, 4, '2024-10-02', NULL, 1, 4, 1, 1, 5, 4, 'Aumentando a quantidade de militares  para assim cumprir os prazos como determina a legislação em vigor é uma vergonha uma região com tantos atiradores campeões tanto a nível estadual como nacional e internacional prejudicados pela demora na análise do processo '),
(347, 14, 3, '2024-10-02', NULL, 1, 4, 3, 1, 4, 1, 'Aumentando a quantidade de militares na seção, uma vez que tem pouquíssimo para a demanda da região. deixar os militares fixo, não sobrecarregando colocando em missão totalmente diferente do SFPC. tem processo demorando mais de 6 meses para ser analisados, CR, CRAF, AUTORIZAÇÃO DE COMPRA. Um verdadeiro absurdo com o atirador esportivo. Onde na região temos atiradores diversas vezes campeões brasileiros, estaduais e internacional, uma vergonha nacional o atiradores dessas magnitude não poder treinar porque o Exército Brasileiro, não faz o papel dele de analisar os processos em tempo correto como demanda a legislação em vigor.'),
(348, 6, 4, '2024-09-19', NULL, 9, 10, 8, 6, 9, 8, 'Colocar uma forma melhor de entrada para as instalações'),
(349, 10, 4, '2024-09-19', NULL, 7, 6, 8, 4, 7, 5, NULL),
(350, 7, 4, '2024-09-23', NULL, 10, 10, 10, 10, 9, 10, NULL),
(351, 14, 4, '2024-10-02', NULL, 1, 1, 1, 1, 1, 1, 'Em tudo '),
(352, 6, 4, '2024-09-24', NULL, 10, 10, 9, 8, 10, 9, NULL),
(353, 14, 3, '2024-10-02', NULL, 9, 9, 10, 9, 8, 8, 'Ta bom'),
(354, 6, 4, '2024-09-24', NULL, 10, 10, 8, 5, 9, 7, 'Interfone'),
(355, 14, 4, '2024-10-02', NULL, 10, 10, 10, 1, 10, 10, NULL),
(356, 11, 2, '2024-09-24', NULL, 10, 10, 10, 10, 10, 10, NULL),
(357, 14, 4, '2024-10-02', NULL, 9, 9, 9, 9, 9, 9, NULL),
(358, 4, 4, '2024-09-24', NULL, 10, 10, 10, 10, 10, 10, 'Poderia ter mais um militar para acelerar o tempo de atendimento. '),
(359, 14, 4, '2024-10-02', 'jandicleylubarino@hotmail.com', 10, 10, 10, 9, 9, 9, NULL),
(360, 11, 4, '2024-09-24', 'solutionpeassessoria@gmail.com', 10, 10, 6, 7, 10, 9, 'Mais clareza nas informações deixadas no sisgcorp.'),
(361, 14, 2, '2024-10-02', NULL, 3, 5, 3, 1, 9, 4, 'Em princípio, aumentar o efetivo para atendimento das demandas que são de encargo do Exército Brasileiro. Infelizmente, há uma lentidão no desenrolar dos processos. Urgindo assim, a necessidade de aumentar a quantidade de militares na referida seção, uma vez que tem pouco efetivo para a alta demanda regional. Há casos nos quais os processos demoram mais de 6 meses para serem analisados, sejam CR’s, CRAF’s ou Autorizações de caráter similar. O Nordeste, principalmente nesta região, concentram-se um grande número de atiradores campeões brasileiros, seja em modalidades estaduais, nacionais ou internacional. Em vista disso, não se configura como coerente o atraso nas análises das demandas supracitadas, sendo que algumas autoridades militares que já nos atenderam , direcionaram a culpabilidade de tal lentidão para o número pouquíssimo de agentes (no caso em questão, eram apenas dois para mais de mil processos). É notável a boa vontade de muitos militares analistas, todavia é impossível dar conta de um número ascendente de contínuos processos.'),
(362, 11, 4, '2024-09-24', 'Carlos.jafreitas@hotmail.com', 10, 10, 10, 0, 10, NULL, NULL),
(363, 14, 4, '2024-10-02', NULL, 5, 7, 6, 1, 7, 1, 'Sendo mais ágil no atendimento dos processos'),
(364, 14, 2, '2024-10-02', 'andre.balmeida@gmail.com', 1, 5, 5, 1, 5, 1, 'Mantendo um quadro fixo de militares no SFPC de modo que não se perca tempo na transmissão do conhecimento a cada substituição dos responsáveis pela sessão'),
(365, 4, 4, '2024-09-24', NULL, 10, 10, 10, 8, 8, 8, 'O tempo das análises '),
(366, 14, 3, '2024-10-02', 'manoelsilvatorresneto@gmail.com', 4, 5, 8, 1, 6, 6, 'Que possa ser avaliado os processos dentro do corpo administrativo do 72 BI para melhor agilidade e brevidade aos cidadão que pratica esses esportes.'),
(367, 7, 4, '2024-09-24', 'nandoqueiroz@yahoo.com.br', 10, 10, 10, 10, 10, 10, NULL),
(368, 14, 1, '2024-10-02', 'dasf1975@gmail.com', 7, 7, 7, 5, 7, 7, '\n\nAumentando a quantidade de militares na seção, uma vez que tem pouquíssimo para a demanda da região. deixar os militares fixo, não sobrecarregando colocando em missão totalmente diferente do SFPC. tem processo demorando mais de 6 meses para ser analisados, CR, CRAF, AUTORIZAÇÃO DE COMPRA atualização de endereço de acervo que deveria ser uma coisa simples . Um verdadeiro absurdo com o atirador esportivo. Onde na região temos atiradores diversas vezes campeões brasileiros, estaduais e internacional, uma vergonha nacional o atiradores dessas magnitude não poder treinar porque o Exército Brasileiro, não faz o papel dele de analisar os processos em tempo correto como demanda a legislação em vigor.'),
(369, 5, 4, '2024-09-24', NULL, 10, 10, 10, 10, 10, 10, 'Excelente atendimento'),
(370, 17, 4, '2024-09-24', NULL, 10, 8, 9, 10, 7, 8, 'Sistema funcionando sem interrupções '),
(371, 17, 4, '2024-09-24', NULL, 10, 10, 10, 10, 10, 10, NULL),
(372, 14, 4, '2024-10-02', NULL, 3, 3, 3, 1, 3, 2, 'Diminuindo o tempo para atendimento e conclusão dos processos !!!'),
(373, 14, 2, '2024-10-02', NULL, 4, 3, 3, 1, 6, 3, 'Aumentando a quantidade de militares na seção, uma vez que tem pouquíssimo para a demanda da região. deixar os militares fixo, não sobrecarregando colocando em missão totalmente diferente do SFPC. tem processo demorando mais de 6 meses para ser analisados, CR, CRAF, AUTORIZAÇÃO DE COMPRA. Um verdadeiro absurdo com o atirador esportivo. Onde na região temos atiradores diversas vezes campeões brasileiros, estaduais e internacional, uma vergonha nacional o atiradores dessas magnitude não poder treinar porque o Exército Brasileiro, não faz o papel dele de analisar os processos em tempo correto como demanda a legislação em vigor.'),
(374, 14, 4, '2024-10-02', NULL, 1, 1, 1, 1, 1, 1, 'Na opção 9 esse foi minha sugestão para eles \n\nAumentando a quantidade de militares na seção, uma vez que tem pouquíssimo para a demanda da região. deixar os militares fixo, não sobrecarregando colocando em missão totalmente diferente do SFPC. tem processo demorando mais de 6 meses para ser analisados, CR, CRAF, AUTORIZAÇÃO DE COMPRA. Um verdadeiro absurdo com o atirador esportivo. Onde na região temos atiradores diversas vezes campeões brasileiros, estaduais e internacional, uma vergonha nacional o atiradores dessas magnitude não poder treinar porque o Exército Brasileiro, não faz o papel dele de analisar os processos em tempo correto como demanda a legislação em vigor.'),
(375, 17, 4, '2024-09-24', 'andrecampos.instrutor@gmail.com', 10, 10, 10, 10, 10, 10, NULL),
(376, 14, 4, '2024-10-02', NULL, 1, 1, 2, 1, 7, 1, 'Aumentando o quadro de militares ativos e capacitados para as atividades do SFPC, aumentando a carga horária de trabalho para as atividades do SFPC, incluindo uma supervisão rigorosa nos processos e principalmente no tempo de execução dos processos e um comandante  atencioso e minimamente comprometido com as atividades do SFPC. '),
(377, 17, 4, '2024-09-24', 'radb1975@gmail.com', 10, 10, 10, 10, 9, 5, 'Dar uma resposta mais rápida ao  atendimento (telefone, e-mail, Fale com a SFPC)'),
(378, 17, 4, '2024-09-24', 'Clubedetirogurjau@gmail.com', 10, 10, 10, 10, 9, 10, NULL),
(379, 14, 1, '2024-10-02', 'fatima_f2373@yahoo.com', 10, 10, 9, 10, 10, 8, NULL),
(380, 17, 4, '2024-09-24', 'thelesfalcao@gmail.com', 10, 10, 10, 10, 10, 10, 'Tudo excelente!! '),
(381, 17, 4, '2024-09-24', 'marceloimoveis100@hotmail.com', 10, 10, 10, 10, 8, 10, 'Tudo ok'),
(382, 17, 4, '2024-09-24', 'jacksonmiki@hotmail.com', 10, 10, 10, 10, 10, 10, 'Sempre fui muito bem atendido pelo pessoal do SFPC, não tenho o que reclamar, apenas elogio a toda equipe.'),
(383, 17, 4, '2024-09-24', 'arabellipriscila2011@hotmail.com', 10, 10, 10, 9, 10, 10, 'Agilizando um pouquinho as análises de CR'),
(384, 17, 4, '2024-09-24', NULL, 10, 10, 10, 10, 10, 10, 'Atendendo excelente '),
(385, 17, 2, '2024-09-24', NULL, 10, 10, 10, 10, 10, 10, NULL),
(386, 17, 4, '2024-09-24', NULL, 10, 10, 10, 10, 8, 9, NULL),
(387, 14, 2, '2024-10-02', NULL, 1, 2, 2, 1, 7, 3, 'No modo geral informatizar os processos'),
(388, 14, 4, '2024-10-03', NULL, 1, 1, 1, 1, 1, 1, 'Aumentadando o RH'),
(389, 14, 1, '2024-10-03', NULL, 3, 7, 2, 1, 7, 2, 'Sendo mais ágio '),
(390, 10, 4, '2024-10-03', NULL, 10, 10, 10, 10, 9, 8, 'U sr cb Paiva '),
(391, 7, 4, '2024-10-03', 'pedroneto.nr@hotmail.com', 10, 10, 10, 10, 10, 10, NULL),
(392, 10, 4, '2024-10-03', NULL, 9, 10, 10, 10, 8, 7, NULL),
(393, 9, 4, '2024-09-24', 'Desportivodorn@gmail.com', 5, 7, 5, 5, 10, 2, 'Melhorar significativamente na parte telefônica, e-mail e outros meios que possam agilizar o atendimento e o serviço prestado.'),
(394, 17, 4, '2024-09-24', NULL, 8, 10, 10, 7, 9, 9, 'Só agilizar os processos, de resto está ótimo. Pessoal atende muito bem. '),
(395, 8, 4, '2024-09-24', 'sv.assessoria.2018@gmail.com', 10, 10, 10, 10, 10, 9, 'O Fale com a SFPC poderia dar uma resposta mais rápida'),
(396, 8, 1, '2024-09-24', 'rrildo.insp@gmail.com', 8, 10, 9, 4, 9, 8, 'Agilizando na análise dos processos q atualmente demora muito.'),
(397, 6, 4, '2024-10-03', NULL, 10, 10, 10, 10, 10, 8, NULL),
(398, 14, 1, '2024-10-04', NULL, 2, 3, 4, 1, 4, 5, 'Aumento do efetivo e melhoria na tecnologia '),
(399, 17, 2, '2024-10-04', 'cristina_anasilva@hotmail.com', 10, 10, 10, 10, 10, 10, NULL),
(400, 6, 4, '2024-09-24', 'sv.assessoria.2018@gmail.com', 8, 10, 10, 8, 10, 6, 'O Fale com a SFPC poderia dar uma resposta mais rápida, fiz 2 pedidos na mesma data de correção por erro no sistema, uma CRAF foi corrido em uma semana e o outro CRAF já tá com 10 meses e o erro foi o mesmo, veio com data de validade errada'),
(401, 17, 2, '2024-10-04', 'cristina_anasilva@hotmail.com', 10, 10, 10, 10, 10, 10, NULL),
(402, 18, 4, '2024-10-05', NULL, 1, 1, 1, 1, 1, 1, 'Analisar os processos físicos pois tem processo desde abril protocolados e não estão sendo analisados '),
(403, 6, 4, '2024-10-07', NULL, 10, 10, 9, 7, 9, 8, NULL),
(404, 3, 1, '2024-10-08', 'GUSTAVO.FREJ@UOL.COM.BR', 10, 10, 10, 10, 9, 9, NULL),
(405, 11, 4, '2024-09-24', NULL, 10, 10, 10, 10, 10, 5, NULL),
(406, 11, 4, '2024-09-24', NULL, 10, 10, 10, 10, 10, 5, NULL),
(407, 7, 4, '2024-09-24', 'Excelente ', 10, 10, 10, 10, 8, 9, 'Só a questão do local, onde somos atendidos melhorar '),
(408, 17, 4, '2024-09-24', 'clubedotiroatitude@gmail.com', 10, 10, 10, 9, 9, 10, 'Mais gente no SFPC'),
(409, 16, 2, '2024-09-24', NULL, 10, 10, 10, 10, 10, 10, 'Tá excelente '),
(410, 8, 2, '2024-09-24', 'franciscopneto@hotmail.com', 9, 10, 9, 10, 8, 8, 'Melhorando o sistema do SISGCORP. Referente ao funcionamento da OM 16RC MEC, só tenho a enaltecer a excelência do serviço prestado. '),
(411, 8, 1, '2024-09-24', NULL, 10, 10, 10, 10, 9, 8, 'Colocando mais pessoas no setor. '),
(412, 3, 1, '2024-10-08', 'GUSTAVO.FREJ@UOL.COM.BR', 10, 10, 10, 10, 9, 10, NULL),
(413, 3, 4, '2024-10-08', 'comex@scpcconsultoria.com', 10, 10, 10, 10, 10, 10, 'Atualização de tecnologia '),
(414, 3, 2, '2024-10-08', 'financeiro@scpcconsultoria.com', 10, 10, 10, 10, 10, 10, 'O atendimento do 10⁰ Esq e do Cap Ocimar é excelente! Nada a acrescentar, só elogios.'),
(415, 6, 4, '2024-09-25', NULL, 10, 10, 8, 5, 9, 8, NULL),
(416, 11, 4, '2024-09-25', 'GUSTAVO.FREJ@UOL.COM.BR', 10, 10, 10, 10, 9, 9, NULL),
(417, 8, 3, '2024-09-25', NULL, 10, 10, 9, 10, 10, 10, 'A demora dos processos no Sigscorp , poderia ser mas rápido e dá muito bug no sistema, e as vezes passa vários dias sem pegar!'),
(418, 7, 4, '2024-09-25', NULL, 10, 9, 10, 9, 8, 10, NULL),
(419, 14, 4, '2024-09-25', 'despachantejunior@yahoo.com', 10, 10, 10, 5, 10, 6, NULL),
(420, 7, 4, '2024-09-25', NULL, 10, 10, 10, 10, 10, 10, 'Fui muito bem atendida,'),
(421, 7, 2, '2024-09-25', NULL, 10, 10, 10, 10, 10, 10, NULL),
(422, 14, 1, '2024-09-25', NULL, 1, 5, 1, 1, 5, 1, 'Ter mais gente trabalhando na seção já seria uma ótima resposta para sociedade,estão analisando os CRs que deram entrada do mês de março.Estao atrasando a vida de todos,atiradores,,donos de clubes e lojistas.'),
(423, 7, 4, '2024-09-25', NULL, 10, 10, 10, 10, 8, 8, 'Divulgação dis meios eletrônicos p comunicação '),
(424, 1, 1, '2024-11-27', '1', 1, 1, 1, 1, 1, 1, '1'),
(425, 18, 1, '2024-11-11', NULL, 5, 5, 5, 5, 5, 5, 'xxxx'),
(426, 6, 4, '2024-11-11', 'emanue@cddd', 5, 5, 5, 5, 5, 5, ''),
(427, 22, 4, '2024-11-11', 'emanue@cddd', 4, 4, 4, 4, 4, 4, 'ssdd'),
(428, 15, 3, '2024-11-11', 'emanuel@rumoa', 5, 5, 5, 5, 5, 5, 'sssss'),
(429, 1, 3, '2024-11-11', 'emanuel@caasda', 5, 4, 1, 1, 2, 2, 'xxxx'),
(430, 6, 3, '2024-11-11', 'emanuel@caasda', 5, 4, 4, 4, 4, 4, 'aaaaa'),
(431, 4, 4, '2024-11-11', 'emanuel@caasda', 3, 3, 3, 3, 3, 3, 'bola'),
(432, 21, 4, '2024-11-11', 'emanuel@caasda', 2, 2, 2, 2, 2, 2, 'zzzzz'),
(433, 16, 2, '2024-11-13', 'emanuel@caasda', 5, 5, 5, 5, 5, 5, 'teste'),
(434, 42, 2, '2024-11-14', 'emanuel@xxx.com', 5, 5, 3, 5, 5, 5, 'xxx');

-- --------------------------------------------------------

--
-- Estrutura da tabela `teste`
--

CREATE TABLE `teste` (
  `codTeste` int(11) NOT NULL,
  `descricao` varchar(20) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `teste`
--

INSERT INTO `teste` (`codTeste`, `descricao`, `tipo`) VALUES
(6, 'd', 2),
(11, 'FFDF', 1),
(12, 'gfgfg', 1),
(13, 'fgg', 1),
(15, 'sdsd', 1),
(16, 'dsd', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `timezone`
--

CREATE TABLE `timezone` (
  `codTimezone` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `timezone`
--

INSERT INTO `timezone` (`codTimezone`, `nome`) VALUES
(1, 'Africa/Abidjan'),
(2, 'Africa/Accra'),
(3, 'Africa/Algiers'),
(4, 'Africa/Bissau'),
(5, 'Africa/Cairo'),
(6, 'Africa/Casablanca'),
(7, 'Africa/Ceuta'),
(8, 'Africa/El_Aaiun'),
(9, 'Africa/Johannesburg'),
(10, 'Africa/Juba'),
(11, 'Africa/Khartoum'),
(12, 'Africa/Lagos'),
(13, 'Africa/Maputo'),
(14, 'Africa/Monrovia'),
(15, 'Africa/Nairobi'),
(16, 'Africa/Ndjamena'),
(17, 'Africa/Sao_Tome'),
(18, 'Africa/Tripoli'),
(19, 'Africa/Tunis'),
(20, 'Africa/Windhoek'),
(21, 'America/Adak'),
(22, 'America/Anchorage'),
(23, 'America/Araguaina'),
(24, 'America/Argentina/Buenos_Aires'),
(25, 'America/Argentina/Catamarca'),
(26, 'America/Argentina/Cordoba'),
(27, 'America/Argentina/Jujuy'),
(28, 'America/Argentina/La_Rioja'),
(29, 'America/Argentina/Mendoza'),
(30, 'America/Argentina/Rio_Gallegos'),
(31, 'America/Argentina/Salta'),
(32, 'America/Argentina/San_Juan'),
(33, 'America/Argentina/San_Luis'),
(34, 'America/Argentina/Tucuman'),
(35, 'America/Argentina/Ushuaia'),
(36, 'America/Asuncion'),
(37, 'America/Atikokan'),
(38, 'America/Bahia'),
(39, 'America/Bahia_Banderas'),
(40, 'America/Barbados'),
(41, 'America/Belem'),
(42, 'America/Belize'),
(43, 'America/Blanc-Sablon'),
(44, 'America/Boa_Vista'),
(45, 'America/Bogota'),
(46, 'America/Boise'),
(47, 'America/Cambridge_Bay'),
(48, 'America/Campo_Grande'),
(49, 'America/Cancun'),
(50, 'America/Caracas'),
(51, 'America/Cayenne'),
(52, 'America/Chicago'),
(53, 'America/Chihuahua'),
(54, 'America/Costa_Rica'),
(55, 'America/Creston'),
(56, 'America/Cuiaba'),
(57, 'America/Curacao'),
(58, 'America/Danmarkshavn'),
(59, 'America/Dawson'),
(60, 'America/Dawson_Creek'),
(61, 'America/Denver'),
(62, 'America/Detroit'),
(63, 'America/Edmonton'),
(64, 'America/Eirunepe'),
(65, 'America/El_Salvador'),
(66, 'America/Fort_Nelson'),
(67, 'America/Fortaleza'),
(68, 'America/Glace_Bay'),
(69, 'America/Goose_Bay'),
(70, 'America/Grand_Turk'),
(71, 'America/Guatemala'),
(72, 'America/Guayaquil'),
(73, 'America/Guyana'),
(74, 'America/Halifax'),
(75, 'America/Havana'),
(76, 'America/Hermosillo'),
(77, 'America/Indiana/Indianapolis'),
(78, 'America/Indiana/Knox'),
(79, 'America/Indiana/Marengo'),
(80, 'America/Indiana/Petersburg'),
(81, 'America/Indiana/Tell_City'),
(82, 'America/Indiana/Vevay'),
(83, 'America/Indiana/Vincennes'),
(84, 'America/Indiana/Winamac'),
(85, 'America/Inuvik'),
(86, 'America/Iqaluit'),
(87, 'America/Jamaica'),
(88, 'America/Juneau'),
(89, 'America/Kentucky/Louisville'),
(90, 'America/Kentucky/Monticello'),
(91, 'America/La_Paz'),
(92, 'America/Lima'),
(93, 'America/Los_Angeles'),
(94, 'America/Maceio'),
(95, 'America/Managua'),
(96, 'America/Manaus'),
(97, 'America/Martinique'),
(98, 'America/Matamoros'),
(99, 'America/Mazatlan'),
(100, 'America/Menominee'),
(101, 'America/Merida'),
(102, 'America/Metlakatla'),
(103, 'America/Mexico_City'),
(104, 'America/Miquelon'),
(105, 'America/Moncton'),
(106, 'America/Monterrey'),
(107, 'America/Montevideo'),
(108, 'America/Nassau'),
(109, 'America/New_York'),
(110, 'America/Nipigon'),
(111, 'America/Nome'),
(112, 'America/Noronha'),
(113, 'America/North_Dakota/Beulah'),
(114, 'America/North_Dakota/Center'),
(115, 'America/North_Dakota/New_Salem'),
(116, 'America/Nuuk'),
(117, 'America/Ojinaga'),
(118, 'America/Panama'),
(119, 'America/Pangnirtung'),
(120, 'America/Paramaribo'),
(121, 'America/Phoenix'),
(122, 'America/Port-au-Prince'),
(123, 'America/Port_of_Spain'),
(124, 'America/Porto_Velho'),
(125, 'America/Puerto_Rico'),
(126, 'America/Punta_Arenas'),
(127, 'America/Rainy_River'),
(128, 'America/Rankin_Inlet'),
(129, 'America/Recife'),
(130, 'America/Regina'),
(131, 'America/Resolute'),
(132, 'America/Rio_Branco'),
(133, 'America/Santarem'),
(134, 'America/Santiago'),
(135, 'America/Santo_Domingo'),
(136, 'America/Sao_Paulo'),
(137, 'America/Scoresbysund'),
(138, 'America/Sitka'),
(139, 'America/St_Johns'),
(140, 'America/Swift_Current'),
(141, 'America/Tegucigalpa'),
(142, 'America/Thule'),
(143, 'America/Thunder_Bay'),
(144, 'America/Tijuana'),
(145, 'America/Toronto'),
(146, 'America/Vancouver'),
(147, 'America/Whitehorse'),
(148, 'America/Winnipeg'),
(149, 'America/Yakutat'),
(150, 'America/Yellowknife'),
(151, 'Antarctica/Casey'),
(152, 'Antarctica/Davis'),
(153, 'Antarctica/DumontDUrville'),
(154, 'Antarctica/Macquarie'),
(155, 'Antarctica/Mawson'),
(156, 'Antarctica/Palmer'),
(157, 'Antarctica/Rothera'),
(158, 'Antarctica/Syowa'),
(159, 'Antarctica/Troll'),
(160, 'Antarctica/Vostok'),
(161, 'Asia/Almaty'),
(162, 'Asia/Amman'),
(163, 'Asia/Anadyr'),
(164, 'Asia/Aqtau'),
(165, 'Asia/Aqtobe'),
(166, 'Asia/Ashgabat'),
(167, 'Asia/Atyrau'),
(168, 'Asia/Baghdad'),
(169, 'Asia/Baku'),
(170, 'Asia/Bangkok'),
(171, 'Asia/Barnaul'),
(172, 'Asia/Beirut'),
(173, 'Asia/Bishkek'),
(174, 'Asia/Brunei'),
(175, 'Asia/Chita'),
(176, 'Asia/Choibalsan'),
(177, 'Asia/Colombo'),
(178, 'Asia/Damascus'),
(179, 'Asia/Dhaka'),
(180, 'Asia/Dili'),
(181, 'Asia/Dubai'),
(182, 'Asia/Dushanbe'),
(183, 'Asia/Famagusta'),
(184, 'Asia/Gaza'),
(185, 'Asia/Hebron'),
(186, 'Asia/Ho_Chi_Minh'),
(187, 'Asia/Hong_Kong'),
(188, 'Asia/Hovd'),
(189, 'Asia/Irkutsk'),
(190, 'Asia/Jakarta'),
(191, 'Asia/Jayapura'),
(192, 'Asia/Jerusalem'),
(193, 'Asia/Kabul'),
(194, 'Asia/Kamchatka'),
(195, 'Asia/Karachi'),
(196, 'Asia/Kathmandu'),
(197, 'Asia/Khandyga'),
(198, 'Asia/Kolkata'),
(199, 'Asia/Krasnoyarsk'),
(200, 'Asia/Kuala_Lumpur'),
(201, 'Asia/Kuching'),
(202, 'Asia/Macau'),
(203, 'Asia/Magadan'),
(204, 'Asia/Makassar'),
(205, 'Asia/Manila'),
(206, 'Asia/Nicosia'),
(207, 'Asia/Novokuznetsk'),
(208, 'Asia/Novosibirsk'),
(209, 'Asia/Omsk'),
(210, 'Asia/Oral'),
(211, 'Asia/Pontianak'),
(212, 'Asia/Pyongyang'),
(213, 'Asia/Qatar'),
(214, 'Asia/Qostanay'),
(215, 'Asia/Qyzylorda'),
(216, 'Asia/Riyadh'),
(217, 'Asia/Sakhalin'),
(218, 'Asia/Samarkand'),
(219, 'Asia/Seoul'),
(220, 'Asia/Shanghai'),
(221, 'Asia/Singapore'),
(222, 'Asia/Srednekolymsk'),
(223, 'Asia/Taipei'),
(224, 'Asia/Tashkent'),
(225, 'Asia/Tbilisi'),
(226, 'Asia/Tehran'),
(227, 'Asia/Thimphu'),
(228, 'Asia/Tokyo'),
(229, 'Asia/Tomsk'),
(230, 'Asia/Ulaanbaatar'),
(231, 'Asia/Urumqi'),
(232, 'Asia/Ust-Nera'),
(233, 'Asia/Vladivostok'),
(234, 'Asia/Yakutsk'),
(235, 'Asia/Yangon'),
(236, 'Asia/Yekaterinburg'),
(237, 'Asia/Yerevan'),
(238, 'Atlantic/Azores'),
(239, 'Atlantic/Bermuda'),
(240, 'Atlantic/Canary'),
(241, 'Atlantic/Cape_Verde'),
(242, 'Atlantic/Faroe'),
(243, 'Atlantic/Madeira'),
(244, 'Atlantic/Reykjavik'),
(245, 'Atlantic/South_Georgia'),
(246, 'Atlantic/Stanley'),
(247, 'Australia/Adelaide'),
(248, 'Australia/Brisbane'),
(249, 'Australia/Broken_Hill'),
(250, 'Australia/Currie'),
(251, 'Australia/Darwin'),
(252, 'Australia/Eucla'),
(253, 'Australia/Hobart'),
(254, 'Australia/Lindeman'),
(255, 'Australia/Lord_Howe'),
(256, 'Australia/Melbourne'),
(257, 'Australia/Perth'),
(258, 'Australia/Sydney'),
(259, 'CET'),
(260, 'CST6CDT'),
(261, 'EET'),
(262, 'EST'),
(263, 'EST5EDT'),
(264, 'Etc/GMT'),
(265, 'Etc/GMT+1'),
(266, 'Etc/GMT+10'),
(267, 'Etc/GMT+11'),
(268, 'Etc/GMT+12'),
(269, 'Etc/GMT+2'),
(270, 'Etc/GMT+3'),
(271, 'Etc/GMT+4'),
(272, 'Etc/GMT+5'),
(273, 'Etc/GMT+6'),
(274, 'Etc/GMT+7'),
(275, 'Etc/GMT+8'),
(276, 'Etc/GMT+9'),
(277, 'Etc/GMT-1'),
(278, 'Etc/GMT-10'),
(279, 'Etc/GMT-11'),
(280, 'Etc/GMT-12'),
(281, 'Etc/GMT-13'),
(282, 'Etc/GMT-14'),
(283, 'Etc/GMT-2'),
(284, 'Etc/GMT-3'),
(285, 'Etc/GMT-4'),
(286, 'Etc/GMT-5'),
(287, 'Etc/GMT-6'),
(288, 'Etc/GMT-7'),
(289, 'Etc/GMT-8'),
(290, 'Etc/GMT-9'),
(291, 'Etc/UTC'),
(292, 'Europe/Amsterdam'),
(293, 'Europe/Andorra'),
(294, 'Europe/Astrakhan'),
(295, 'Europe/Athens'),
(296, 'Europe/Belgrade'),
(297, 'Europe/Berlin'),
(298, 'Europe/Brussels'),
(299, 'Europe/Bucharest'),
(300, 'Europe/Budapest'),
(301, 'Europe/Chisinau'),
(302, 'Europe/Copenhagen'),
(303, 'Europe/Dublin'),
(304, 'Europe/Gibraltar'),
(305, 'Europe/Helsinki'),
(306, 'Europe/Istanbul'),
(307, 'Europe/Kaliningrad'),
(308, 'Europe/Kiev'),
(309, 'Europe/Kirov'),
(310, 'Europe/Lisbon'),
(311, 'Europe/London'),
(312, 'Europe/Luxembourg'),
(313, 'Europe/Madrid'),
(314, 'Europe/Malta'),
(315, 'Europe/Minsk'),
(316, 'Europe/Monaco'),
(317, 'Europe/Moscow'),
(318, 'Europe/Oslo'),
(319, 'Europe/Paris'),
(320, 'Europe/Prague'),
(321, 'Europe/Riga'),
(322, 'Europe/Rome'),
(323, 'Europe/Samara'),
(324, 'Europe/Saratov'),
(325, 'Europe/Simferopol'),
(326, 'Europe/Sofia'),
(327, 'Europe/Stockholm'),
(328, 'Europe/Tallinn'),
(329, 'Europe/Tirane'),
(330, 'Europe/Ulyanovsk'),
(331, 'Europe/Uzhgorod'),
(332, 'Europe/Vienna'),
(333, 'Europe/Vilnius'),
(334, 'Europe/Volgograd'),
(335, 'Europe/Warsaw'),
(336, 'Europe/Zaporozhye'),
(337, 'Europe/Zurich'),
(338, 'HST'),
(339, 'Indian/Chagos'),
(340, 'Indian/Christmas'),
(341, 'Indian/Cocos'),
(342, 'Indian/Kerguelen'),
(343, 'Indian/Mahe'),
(344, 'Indian/Maldives'),
(345, 'Indian/Mauritius'),
(346, 'Indian/Reunion'),
(347, 'MET'),
(348, 'MST'),
(349, 'MST7MDT'),
(350, 'PST8PDT'),
(351, 'Pacific/Apia'),
(352, 'Pacific/Auckland'),
(353, 'Pacific/Bougainville'),
(354, 'Pacific/Chatham'),
(355, 'Pacific/Chuuk'),
(356, 'Pacific/Easter'),
(357, 'Pacific/Efate'),
(358, 'Pacific/Enderbury'),
(359, 'Pacific/Fakaofo'),
(360, 'Pacific/Fiji'),
(361, 'Pacific/Funafuti'),
(362, 'Pacific/Galapagos'),
(363, 'Pacific/Gambier'),
(364, 'Pacific/Guadalcanal'),
(365, 'Pacific/Guam'),
(366, 'Pacific/Honolulu'),
(367, 'Pacific/Kiritimati'),
(368, 'Pacific/Kosrae'),
(369, 'Pacific/Kwajalein'),
(370, 'Pacific/Majuro'),
(371, 'Pacific/Marquesas'),
(372, 'Pacific/Nauru'),
(373, 'Pacific/Niue'),
(374, 'Pacific/Norfolk'),
(375, 'Pacific/Noumea'),
(376, 'Pacific/Pago_Pago'),
(377, 'Pacific/Palau'),
(378, 'Pacific/Pitcairn'),
(379, 'Pacific/Pohnpei'),
(380, 'Pacific/Port_Moresby'),
(381, 'Pacific/Rarotonga'),
(382, 'Pacific/Tahiti'),
(383, 'Pacific/Tarawa'),
(384, 'Pacific/Tongatapu'),
(385, 'Pacific/Wake'),
(386, 'Pacific/Wallis'),
(387, 'WET'),
(389, 'America/Sao_Paulo');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `atalhos`
--
ALTER TABLE `atalhos`
  ADD PRIMARY KEY (`codAtalho`);

--
-- Índices para tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD PRIMARY KEY (`codAtendimento`);

--
-- Índices para tabela `atendimentostatus`
--
ALTER TABLE `atendimentostatus`
  ADD PRIMARY KEY (`codStatus`);

--
-- Índices para tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`codCargo`);

--
-- Índices para tabela `chamadasfila`
--
ALTER TABLE `chamadasfila`
  ADD PRIMARY KEY (`codChamada`);

--
-- Índices para tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`codColaborador`,`codOrganizacao`),
  ADD KEY `codColaborador` (`codColaborador`);

--
-- Índices para tabela `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`codDepartamento`);

--
-- Índices para tabela `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`codEspecialidade`);

--
-- Índices para tabela `estadosfederacao`
--
ALTER TABLE `estadosfederacao`
  ADD PRIMARY KEY (`codEstadoFederacao`);

--
-- Índices para tabela `federacoes`
--
ALTER TABLE `federacoes`
  ADD PRIMARY KEY (`codFederacao`);

--
-- Índices para tabela `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`codLog`);

--
-- Índices para tabela `meios`
--
ALTER TABLE `meios`
  ADD PRIMARY KEY (`codMeio`);

--
-- Índices para tabela `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`codModulo`);

--
-- Índices para tabela `modulosnotificacao`
--
ALTER TABLE `modulosnotificacao`
  ADD PRIMARY KEY (`codModuloNotificacao`);

--
-- Índices para tabela `organizacoes`
--
ALTER TABLE `organizacoes`
  ADD PRIMARY KEY (`codOrganizacao`);

--
-- Índices para tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`codPaciente`);

--
-- Índices para tabela `perfis`
--
ALTER TABLE `perfis`
  ADD PRIMARY KEY (`codPerfil`);

--
-- Índices para tabela `perfiscolaboradoresmembro`
--
ALTER TABLE `perfiscolaboradoresmembro`
  ADD PRIMARY KEY (`codColaboradorMembro`);

--
-- Índices para tabela `perfismodulos`
--
ALTER TABLE `perfismodulos`
  ADD PRIMARY KEY (`codPerfil`,`codModulo`);

--
-- Índices para tabela `portalorganizacao`
--
ALTER TABLE `portalorganizacao`
  ADD PRIMARY KEY (`codPortal`);

--
-- Índices para tabela `questionarios`
--
ALTER TABLE `questionarios`
  ADD PRIMARY KEY (`codQuestionario`);

--
-- Índices para tabela `questionariosvisibilidade`
--
ALTER TABLE `questionariosvisibilidade`
  ADD PRIMARY KEY (`codVisibilidade`);

--
-- Índices para tabela `satisfacao`
--
ALTER TABLE `satisfacao`
  ADD PRIMARY KEY (`codPesquisa`);

--
-- Índices para tabela `teste`
--
ALTER TABLE `teste`
  ADD PRIMARY KEY (`codTeste`);

--
-- Índices para tabela `timezone`
--
ALTER TABLE `timezone`
  ADD PRIMARY KEY (`codTimezone`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atalhos`
--
ALTER TABLE `atalhos`
  MODIFY `codAtalho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT de tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  MODIFY `codAtendimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `atendimentostatus`
--
ALTER TABLE `atendimentostatus`
  MODIFY `codStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `codCargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `chamadasfila`
--
ALTER TABLE `chamadasfila`
  MODIFY `codChamada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `codColaborador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `codDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de tabela `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `codEspecialidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `estadosfederacao`
--
ALTER TABLE `estadosfederacao`
  MODIFY `codEstadoFederacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `federacoes`
--
ALTER TABLE `federacoes`
  MODIFY `codFederacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
  MODIFY `codLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1130;

--
-- AUTO_INCREMENT de tabela `meios`
--
ALTER TABLE `meios`
  MODIFY `codMeio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `modulos`
--
ALTER TABLE `modulos`
  MODIFY `codModulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `modulosnotificacao`
--
ALTER TABLE `modulosnotificacao`
  MODIFY `codModuloNotificacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `organizacoes`
--
ALTER TABLE `organizacoes`
  MODIFY `codOrganizacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `codPaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `perfis`
--
ALTER TABLE `perfis`
  MODIFY `codPerfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `perfiscolaboradoresmembro`
--
ALTER TABLE `perfiscolaboradoresmembro`
  MODIFY `codColaboradorMembro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `portalorganizacao`
--
ALTER TABLE `portalorganizacao`
  MODIFY `codPortal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `questionarios`
--
ALTER TABLE `questionarios`
  MODIFY `codQuestionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `questionariosvisibilidade`
--
ALTER TABLE `questionariosvisibilidade`
  MODIFY `codVisibilidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `satisfacao`
--
ALTER TABLE `satisfacao`
  MODIFY `codPesquisa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=435;

--
-- AUTO_INCREMENT de tabela `teste`
--
ALTER TABLE `teste`
  MODIFY `codTeste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `timezone`
--
ALTER TABLE `timezone`
  MODIFY `codTimezone` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=778;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
