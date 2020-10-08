-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ott 08, 2020 alle 10:59
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tecnologiedelweb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `articolo`
--

CREATE TABLE `articolo` (
  `id` int(10) UNSIGNED NOT NULL,
  `titolo` varchar(300) NOT NULL,
  `autore` varchar(300) NOT NULL,
  `descrizione` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `articolo`
--

INSERT INTO `articolo` (`id`, `titolo`, `autore`, `descrizione`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Nuovo rasoio per rasatura perfetta', 'Simone', 'doc', NULL, '2020-10-07 16:14:29', '2020-10-07 16:14:29'),
(2, 'Nuova lametta', 'Simone', 'doc', NULL, '2020-10-07 16:14:29', '2020-10-07 16:14:29');

-- --------------------------------------------------------

--
-- Struttura della tabella `articolo_has_tags`
--

CREATE TABLE `articolo_has_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_articolo` int(10) UNSIGNED NOT NULL,
  `id_tag` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_utente` int(10) UNSIGNED NOT NULL,
  `id_prodotto` int(10) UNSIGNED NOT NULL,
  `quantita` int(11) NOT NULL,
  `id_sessione` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descrizione` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `immagine` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `descrizione`, `url`, `immagine`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'rasoi', 'rasoi', 'rasoi', NULL, 'token', '2020-10-07 16:14:29', NULL),
(2, 'lamette', 'lamette', 'lamette', NULL, 'token', '2020-10-07 16:14:29', NULL),
(3, 'forbici', 'forbici', 'forbici', NULL, 'token', '2020-10-07 16:14:29', NULL),
(4, 'schiuma', 'schiuma', 'schiuma', NULL, 'token', '2020-10-07 16:14:29', NULL),
(5, 'regolatori', 'regolatori', 'regolatori', NULL, 'token', '2020-10-07 16:14:29', NULL),
(6, 'pennellino', 'pennellino', 'pennellino', NULL, 'token', '2020-10-07 16:14:29', NULL),
(7, 'dopobarba', 'floid dopobarba', 'floid dopobarba', NULL, 'token', '2020-10-07 16:14:29', NULL),
(8, 'bottigliette spray', 'bottigliette spray', 'bottigliette spray', NULL, 'token', '2020-10-07 16:14:29', NULL),
(9, 'pennelli per tinta', 'pennelli per tinta', 'pennelli per tinta', NULL, 'token', '2020-10-07 16:14:29', NULL),
(10, 'grembiuli', 'grembiuli', 'grembiuli', NULL, 'token', '2020-10-07 16:14:29', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_utente` int(10) UNSIGNED NOT NULL,
  `id_prodotto` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `testo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `approvato` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `commento`
--

INSERT INTO `commento` (`id`, `id_utente`, `id_prodotto`, `email`, `testo`, `approvato`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'marcodecesaris146@gmail.com', 'grande!', 0, '2020-10-07 16:14:29', '2020-10-07 16:14:29'),
(2, 1, 2, 'marcodecesaris146@gmail.com', 'ottimo prodotto!', 0, '2020-10-07 16:14:29', '2020-10-07 16:14:29');

-- --------------------------------------------------------

--
-- Struttura della tabella `consegna`
--

CREATE TABLE `consegna` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_corriere` int(10) UNSIGNED NOT NULL,
  `id_indirizzo` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `contenuto`
--

CREATE TABLE `contenuto` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_prodotto` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `corriere`
--

CREATE TABLE `corriere` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `corriere`
--

INSERT INTO `corriere` (`id`, `nome`, `created_at`, `updated_at`) VALUES
(1, 'Bartolini', '2020-10-07 16:14:29', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `coupon`
--

CREATE TABLE `coupon` (
  `id` int(10) UNSIGNED NOT NULL,
  `codice` varchar(100) NOT NULL,
  `percentuale` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `coupon`
--

INSERT INTO `coupon` (`id`, `codice`, `percentuale`, `created_at`, `updated_at`) VALUES
(1, 'barbershop_25', '25%', '2020-10-07 16:14:29', NULL),
(2, 'barbershop_30', '30%', '2020-10-07 16:14:29', NULL),
(3, 'barbershop_10', '10%', '2020-10-07 16:14:29', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `group_has_service`
--

CREATE TABLE `group_has_service` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_gruppo` int(10) UNSIGNED NOT NULL,
  `id_servizio` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `gruppo`
--

CREATE TABLE `gruppo` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `immagine`
--

CREATE TABLE `immagine` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(300) NOT NULL,
  `id_prodotto` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `indirizzo`
--

CREATE TABLE `indirizzo` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome_utente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_indirizzo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `citta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cap` int(11) NOT NULL,
  `paese` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_utente` int(10) UNSIGNED NOT NULL,
  `telefono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `indirizzo`
--

INSERT INTO `indirizzo` (`id`, `nome_utente`, `nome_indirizzo`, `citta`, `cap`, `paese`, `id_utente`, `telefono`, `created_at`, `updated_at`) VALUES
(1, 'Loreto Cicerone', 'Via Umberto 1', 'Pagliara', 2021, 'Italia', 1, '3890233514', '2020-10-07 16:14:29', NULL),
(2, 'Marco De Cesaris', 'Via dei salici', 'Borgorose', 2021, 'Italia', 2, '3920607183', '2020-10-07 16:14:29', NULL),
(3, 'Simone Caruso', 'Via Sandonato', 'Pescara', 65129, 'Italia', 3, '3881046378', '2020-10-07 16:14:29', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_utente` int(10) UNSIGNED NOT NULL,
  `id_indirizzo` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_utente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stato` int(11) NOT NULL,
  `metodo_pagamento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `totale` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine_prodotto`
--

CREATE TABLE `ordine_prodotto` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ordine` int(10) UNSIGNED NOT NULL,
  `id_prodotto` int(10) UNSIGNED NOT NULL,
  `quantità` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `preferiti`
--

CREATE TABLE `preferiti` (
  `id_utente` int(10) UNSIGNED NOT NULL,
  `id_prodotto` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `codice` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descrizione` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezzo` double(8,2) NOT NULL,
  `immagine` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `raccomandato` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`id`, `id_categoria`, `nome`, `codice`, `brand`, `descrizione`, `prezzo`, `immagine`, `stock`, `raccomandato`, `created_at`, `updated_at`) VALUES
(1, 1, 'Braun Series 9', 'braun1', 'Braun', 'Leva completamente regolabile. Elimina la necessita di utilizzare più lame.', 85.00, NULL, 10, 1, '2020-10-07 16:14:29', NULL),
(2, 1, 'Philips Aquatouch', 'philips2', 'Philips', 'Completamente in alluminio leggero e infrangibile, molto affidabile.', 50.00, NULL, 15, 1, '2020-10-07 16:14:29', NULL),
(3, 1, 'Philips Multigroom Series', 'philips3', 'Philips', 'Fornito di leva regolabile per una rasatura completa.', 21.00, NULL, 30, 1, '2020-10-07 16:14:29', NULL),
(4, 2, 'Eberbart rasoio', 'eberbart1', 'Eberbart', 'Rasoio barbiere in legno di rose e acciaio inossidabile, per rasatura e rifinitura di barba e capelli.', 15.00, NULL, 10, 0, '2020-10-07 16:14:29', NULL),
(5, 2, 'Morocutti magic rasoio', 'morocutti1', 'Morocutti', 'Comodo sistema di montaggio della lama con binario scorrevole, in acciaio inossidabile che consente un limitato contatto con la lametta.', 27.00, NULL, 40, 1, '2020-10-07 16:14:29', NULL),
(6, 2, 'Wilkinson Sword', 'wilkinson1', 'Wilkinson', 'Ideale per una rasatura precisa con una finitura perfetta, è il must-have tipico dei dei barbershop per rifinire i bordi della barba in modo impeccabile.', 50.00, NULL, 30, 1, '2020-10-07 16:14:29', NULL),
(7, 3, 'Giubra Mastr sfloty', 'giubra2', 'Giubra', 'Forbici per sfoltitura capelli.', 15.00, NULL, 30, 1, '2020-10-07 16:14:29', NULL),
(8, 3, 'Sharaonds Pharaoh.', 'sharaonds2', 'Sharaonds', 'Forbici eleganti per sfoltitura capelli.', 50.00, NULL, 10, 1, '2020-10-07 16:14:29', NULL),
(9, 3, 'BeautyTime International', 'beauty1', 'BeautyTime International SRL', 'Forbici per sfoltitura capelli.', 60.00, NULL, 10, 1, '2020-10-07 16:14:29', NULL),
(10, 4, 'Schiuma da barba gillette.', 'gillette2', 'Gillette', 'Schiuma da barba.', 10.00, NULL, 40, 1, '2020-10-07 16:14:29', NULL),
(11, 4, 'Palmolive schiuma da barba.', 'palmolive2', 'Palmolive', 'Schiuma da barba.', 10.00, NULL, 40, 1, '2020-10-07 16:14:29', NULL),
(12, 4, 'Avene schiuma da barba', 'avene1', 'Avene', 'Schiuma da barba.', 10.00, NULL, 30, 1, '2020-10-07 16:14:29', NULL),
(13, 5, 'Braun pettine regolabile', 'pettine1', 'Braun', 'Pettine regolabile per rasoi.', 5.00, NULL, 10, 1, '2020-10-07 16:14:29', NULL),
(14, 5, 'Braun pettine regolabile', 'pettine2', 'Braun', 'Pettine regolabile per rasoi.', 6.00, NULL, 10, 1, '2020-10-07 16:14:29', NULL),
(15, 5, 'Philips pettine regolabile', 'pettine3', 'Philips', 'Pettine regolabile per rasoi.', 6.00, NULL, 10, 1, '2020-10-07 16:14:29', NULL),
(16, 6, 'UEB pennello spargitalco', 'pennello1', 'UEB', 'Pennello spargitalco.', 10.00, NULL, 10, 1, '2020-10-07 16:14:29', NULL),
(17, 6, 'Teriam pennello spargitalco', 'pennello2', 'Teriam', 'Pennello spargitalco.', 10.00, NULL, 15, 1, '2020-10-07 16:14:29', NULL),
(18, 6, 'Wahl pennello spargitalco', 'pennello3', 'Wahl', 'Pennello spargitalco.', 10.00, NULL, 15, 1, '2020-10-07 16:14:29', NULL),
(19, 7, 'CubaGold dopobarba', 'dopobarba1', 'CubaGold', 'Dopobarba', 21.00, NULL, 15, 1, '2020-10-07 16:14:29', NULL),
(20, 7, 'Hipsteria after shave', 'dopobarba2', 'Hipesteria', 'Dopobarba', 21.00, NULL, 30, 1, '2020-10-07 16:14:29', NULL),
(21, 7, 'Denim after shave', 'dopobarba3', 'Denim', 'Dopobarba', 21.00, NULL, 24, 1, '2020-10-07 16:14:29', NULL),
(22, 8, 'Bakaji vaporizzatore', 'bottigliette1', 'Bakaji', 'Bottigliette spray', 7.00, NULL, 60, 1, '2020-10-07 16:14:29', NULL),
(23, 9, 'Goldwell - color brush', 'pennelli1', 'Goldwell', 'Pennello per tinta capelli.', 10.00, NULL, 70, 1, '2020-10-07 16:14:29', NULL),
(24, 10, 'grembiule', 'grembiule1', 'Sconosciuto', 'Grembiule da indossare durante acconciatura.', 10.00, NULL, 40, 1, '2020-10-07 16:14:29', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto_has_tags`
--

CREATE TABLE `prodotto_has_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_prodotto` int(10) UNSIGNED NOT NULL,
  `id_tag` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `recensione`
--

CREATE TABLE `recensione` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_prodotto` int(10) UNSIGNED NOT NULL,
  `id_utente` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `commento` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `approvato` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `recensione`
--

INSERT INTO `recensione` (`id`, `id_prodotto`, `id_utente`, `user_name`, `commento`, `approvato`, `created_at`, `updated_at`) VALUES
(1, 15, 3, 'Simone Caruso', 'Ottimo prodotto.', 1, '2020-10-07 16:14:29', '2020-10-07 16:14:29'),
(2, 12, 3, 'Simone Caruso', 'Ottimo', 1, '2020-10-07 16:14:29', '2020-10-07 16:14:29'),
(3, 21, 3, 'Simone Caruso', 'Bel prodotto.', 1, '2020-10-07 16:14:29', '2020-10-07 16:14:29');

-- --------------------------------------------------------

--
-- Struttura della tabella `servizio`
--

CREATE TABLE `servizio` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `tag`
--

CREATE TABLE `tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome_tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tag`
--

INSERT INTO `tag` (`id`, `nome_tag`, `created_at`, `updated_at`) VALUES
(1, 'rasoi', '2020-10-08 08:15:51', '2020-10-08 08:15:51'),
(2, 'lamette', '2020-10-08 08:15:51', '2020-10-08 08:15:51'),
(3, 'dopobarba', '2020-10-08 08:15:51', '2020-10-08 08:15:51'),
(4, 'forbici', '2020-10-08 08:15:51', '2020-10-08 08:15:51'),
(5, 'pettine', '2020-10-08 08:15:51', '2020-10-08 08:15:51'),
(6, 'schiuma', '2020-10-08 08:15:51', '2020-10-08 08:15:51'),
(7, 'pennello', '2020-10-08 08:15:51', '2020-10-08 08:15:51'),
(8, 'grembiule', '2020-10-08 08:15:51', '2020-10-08 08:15:51');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Simone', 'scaruso96@gmail.com', '$2y$10$y3i4Tg0JY8gOwcBqoGEtB.GUqFSx6qcA9af/qGZIE6GH9XoGaeF6G', 1, 'TAt85B9mYEgPBSVGwdQHBFBGFOuALK25BT64M5QPrAZbv6Rx4AL4d5Xom9jf', '2020-10-08 06:16:38', '2020-10-08 06:16:38');

-- --------------------------------------------------------

--
-- Struttura della tabella `user_has_coupon`
--

CREATE TABLE `user_has_coupon` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_utente` int(10) UNSIGNED NOT NULL,
  `id_coupon` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `user_has_groups`
--

CREATE TABLE `user_has_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_gruppo` int(10) UNSIGNED NOT NULL,
  `id_utente` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass_word` varchar(200) NOT NULL,
  `remember_token` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `user_name`, `email`, `pass_word`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Loreto Cicerone', 'loretocicerone1@gmail.com', 'pass', 'token', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Marco De Cesaris', 'marcodecesaris146@gmail.com', 'pass', 'token', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Simone Caruso', 'scaruso96@gmail.com', 'pass', 'token', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `articolo`
--
ALTER TABLE `articolo`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `articolo_has_tags`
--
ALTER TABLE `articolo_has_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articolo_tag` (`id_articolo`),
  ADD KEY `tag_articolo` (`id_tag`);

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrello_prodotto` (`id_prodotto`),
  ADD KEY `carrello_utente` (`id_utente`);

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commento_prodotto` (`id_prodotto`),
  ADD KEY `commento_utente` (`id_utente`);

--
-- Indici per le tabelle `consegna`
--
ALTER TABLE `consegna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consegna_corriere` (`id_corriere`),
  ADD KEY `consegna_indirizzo` (`id_indirizzo`);

--
-- Indici per le tabelle `contenuto`
--
ALTER TABLE `contenuto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_prodotto` (`id_prodotto`),
  ADD KEY `prodotto_categoria` (`id_categoria`);

--
-- Indici per le tabelle `corriere`
--
ALTER TABLE `corriere`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `group_has_service`
--
ALTER TABLE `group_has_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servizio_gruppo` (`id_gruppo`),
  ADD KEY `gruppo_servizio` (`id_servizio`);

--
-- Indici per le tabelle `gruppo`
--
ALTER TABLE `gruppo`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `immagine`
--
ALTER TABLE `immagine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `immagine_prodotto` (`id_prodotto`);

--
-- Indici per le tabelle `indirizzo`
--
ALTER TABLE `indirizzo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indirizzo_utente` (`id_utente`);

--
-- Indici per le tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordine_utente` (`id_utente`),
  ADD KEY `ordine_indirizzo` (`id_indirizzo`);

--
-- Indici per le tabelle `ordine_prodotto`
--
ALTER TABLE `ordine_prodotto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordine_pr` (`id_ordine`),
  ADD KEY `pr_ordine` (`id_prodotto`);

--
-- Indici per le tabelle `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indici per le tabelle `preferiti`
--
ALTER TABLE `preferiti`
  ADD PRIMARY KEY (`id_utente`,`id_prodotto`),
  ADD KEY `preferiti_prodotto` (`id_prodotto`);

--
-- Indici per le tabelle `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `prodotto_has_tags`
--
ALTER TABLE `prodotto_has_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_prodotto` (`id_prodotto`),
  ADD KEY `prodotto_tag` (`id_tag`);

--
-- Indici per le tabelle `recensione`
--
ALTER TABLE `recensione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recensione_utente` (`id_utente`),
  ADD KEY `recensione_prodotto` (`id_prodotto`);

--
-- Indici per le tabelle `servizio`
--
ALTER TABLE `servizio`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indici per le tabelle `user_has_coupon`
--
ALTER TABLE `user_has_coupon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_utente` (`id_utente`),
  ADD KEY `utente_coupon` (`id_coupon`);

--
-- Indici per le tabelle `user_has_groups`
--
ALTER TABLE `user_has_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utente_gruppo` (`id_gruppo`),
  ADD KEY `gruppo_utente` (`id_utente`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `articolo`
--
ALTER TABLE `articolo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `articolo_has_tags`
--
ALTER TABLE `articolo_has_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `carrello`
--
ALTER TABLE `carrello`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `consegna`
--
ALTER TABLE `consegna`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `contenuto`
--
ALTER TABLE `contenuto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `corriere`
--
ALTER TABLE `corriere`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `group_has_service`
--
ALTER TABLE `group_has_service`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `gruppo`
--
ALTER TABLE `gruppo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `immagine`
--
ALTER TABLE `immagine`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `indirizzo`
--
ALTER TABLE `indirizzo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ordine_prodotto`
--
ALTER TABLE `ordine_prodotto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT per la tabella `prodotto_has_tags`
--
ALTER TABLE `prodotto_has_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `recensione`
--
ALTER TABLE `recensione`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `servizio`
--
ALTER TABLE `servizio`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `user_has_coupon`
--
ALTER TABLE `user_has_coupon`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `user_has_groups`
--
ALTER TABLE `user_has_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `articolo_has_tags`
--
ALTER TABLE `articolo_has_tags`
  ADD CONSTRAINT `articolo_tag` FOREIGN KEY (`id_articolo`) REFERENCES `articolo` (`id`),
  ADD CONSTRAINT `tag_articolo` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id`);

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `carrello_prodotto` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotto` (`id`),
  ADD CONSTRAINT `carrello_utente` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`);

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `commento_prodotto` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotto` (`id`),
  ADD CONSTRAINT `commento_utente` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`);

--
-- Limiti per la tabella `consegna`
--
ALTER TABLE `consegna`
  ADD CONSTRAINT `consegna_corriere` FOREIGN KEY (`id_corriere`) REFERENCES `corriere` (`id`),
  ADD CONSTRAINT `consegna_indirizzo` FOREIGN KEY (`id_indirizzo`) REFERENCES `indirizzo` (`id`);

--
-- Limiti per la tabella `contenuto`
--
ALTER TABLE `contenuto`
  ADD CONSTRAINT `categoria_prodotto` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotto` (`id`),
  ADD CONSTRAINT `prodotto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Limiti per la tabella `group_has_service`
--
ALTER TABLE `group_has_service`
  ADD CONSTRAINT `gruppo_servizio` FOREIGN KEY (`id_servizio`) REFERENCES `servizio` (`id`),
  ADD CONSTRAINT `servizio_gruppo` FOREIGN KEY (`id_gruppo`) REFERENCES `gruppo` (`id`);

--
-- Limiti per la tabella `immagine`
--
ALTER TABLE `immagine`
  ADD CONSTRAINT `immagine_prodotto` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotto` (`id`);

--
-- Limiti per la tabella `indirizzo`
--
ALTER TABLE `indirizzo`
  ADD CONSTRAINT `indirizzo_utente` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `ordine_indirizzo` FOREIGN KEY (`id_indirizzo`) REFERENCES `indirizzo` (`id`),
  ADD CONSTRAINT `ordine_utente` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`);

--
-- Limiti per la tabella `ordine_prodotto`
--
ALTER TABLE `ordine_prodotto`
  ADD CONSTRAINT `ordine_pr` FOREIGN KEY (`id_ordine`) REFERENCES `ordine` (`id`),
  ADD CONSTRAINT `pr_ordine` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotto` (`id`);

--
-- Limiti per la tabella `preferiti`
--
ALTER TABLE `preferiti`
  ADD CONSTRAINT `preferiti_prodotto` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotto` (`id`),
  ADD CONSTRAINT `preferiti_utente` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`);

--
-- Limiti per la tabella `prodotto_has_tags`
--
ALTER TABLE `prodotto_has_tags`
  ADD CONSTRAINT `prodotto_tag` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `tag_prodotto` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotto` (`id`);

--
-- Limiti per la tabella `recensione`
--
ALTER TABLE `recensione`
  ADD CONSTRAINT `recensione_prodotto` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotto` (`id`),
  ADD CONSTRAINT `recensione_utente` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`);

--
-- Limiti per la tabella `user_has_coupon`
--
ALTER TABLE `user_has_coupon`
  ADD CONSTRAINT `coupon_utente` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`),
  ADD CONSTRAINT `utente_coupon` FOREIGN KEY (`id_coupon`) REFERENCES `coupon` (`id`);

--
-- Limiti per la tabella `user_has_groups`
--
ALTER TABLE `user_has_groups`
  ADD CONSTRAINT `gruppo_utente` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`),
  ADD CONSTRAINT `utente_gruppo` FOREIGN KEY (`id_gruppo`) REFERENCES `gruppo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
