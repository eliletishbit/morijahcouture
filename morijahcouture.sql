-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 05 juin 2026 à 20:03
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `morijahcouture`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis_produis`
--

CREATE TABLE `avis_produis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `nom_client` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `commentaire` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `note` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `caracteristique_produits`
--

CREATE TABLE `caracteristique_produits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categorie_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `valeur` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `carte_cadeaus`
--

CREATE TABLE `carte_cadeaus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `mode_envoi` enum('email','impression') NOT NULL,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `email_destination` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `catalogue_echantillons`
--

CREATE TABLE `catalogue_echantillons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Occasion', NULL, '2026-04-20 11:18:14', '2026-04-20 11:18:14'),
(2, 'Chaussures', NULL, '2026-04-20 11:18:38', '2026-04-20 11:18:38'),
(3, 'Lookbooks', NULL, '2026-04-20 11:18:57', '2026-04-20 11:18:57'),
(4, 'Vêtements', NULL, '2026-04-20 11:19:17', '2026-04-20 11:19:17'),
(5, 'Accessoires', NULL, '2026-04-20 11:19:41', '2026-04-20 11:19:41'),
(6, 'Tenues', NULL, '2026-04-20 15:17:26', '2026-04-20 15:17:26');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_option_personnalisations`
--

CREATE TABLE `categorie_option_personnalisations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_categorie` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie_option_personnalisations`
--

INSERT INTO `categorie_option_personnalisations` (`id`, `nom_categorie`, `created_at`, `updated_at`) VALUES
(1, 'Vetements', '2026-05-08 04:14:30', '2026-05-08 04:14:30');

-- --------------------------------------------------------

--
-- Structure de la table `collections`
--

CREATE TABLE `collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `image_principale` varchar(255) DEFAULT NULL,
  `sous_categorie_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `collections`
--

INSERT INTO `collections` (`id`, `nom`, `image_principale`, `sous_categorie_id`, `created_at`, `updated_at`) VALUES
(1, 'Costume 2 pièce', 'collections_images/6gVfYzlnkmeZ8XpBtBudCtYVMT6OyLj52CuNNMda.jpg', 1, '2026-04-20 14:48:48', '2026-04-20 14:51:28'),
(2, 'Cotumes 3 pièces', 'collections_images/kBq8zlVd5RGwE1fgKDzc86jlSKfDsqUwZz2VJKDZ.jpg', 1, '2026-04-20 14:52:07', '2026-04-20 14:52:07');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero_commande` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `mode_livraison_id` bigint(20) UNSIGNED DEFAULT NULL,
  `adresse_livraison` text NOT NULL,
  `adresse_facturation` text DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `statut` varchar(255) NOT NULL DEFAULT 'en cours',
  `methode_paiement` varchar(255) NOT NULL,
  `statut_paiement` varchar(255) NOT NULL DEFAULT 'en attente',
  `notes` text DEFAULT NULL,
  `personnalisation_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`personnalisation_data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `numero_commande`, `user_id`, `mode_livraison_id`, `adresse_livraison`, `adresse_facturation`, `total`, `statut`, `methode_paiement`, `statut_paiement`, `notes`, `personnalisation_data`, `created_at`, `updated_at`) VALUES
(1, 'CMD-20260505-S7LUEF', 1, 1, 'dsdsdsd', 'sdsdsd', 1232.00, 'en cours', '1', 'en attente', 'dsdsdsd', NULL, '2026-05-05 12:29:28', '2026-05-05 12:29:29'),
(2, 'CMD-20260505-XCEWSM', 1, 1, 'paris', 'paris', 2464.00, 'en cours', '1', 'en attente', 'fsfsfsfsf', NULL, '2026-05-05 12:52:03', '2026-05-05 12:52:03'),
(3, 'CMD-20260513-ZDBNE1', 1, 1, 'eeaeaeaeaeae', 'eaeaea', 3771.00, 'en cours', '1', 'en attente', NULL, NULL, '2026-05-13 13:51:32', '2026-05-13 13:51:32');

-- --------------------------------------------------------

--
-- Structure de la table `commande_produit`
--

CREATE TABLE `commande_produit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commande_id` bigint(20) UNSIGNED NOT NULL,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT 1,
  `prix_unitaire` decimal(10,2) NOT NULL,
  `prix_total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande_produit`
--

INSERT INTO `commande_produit` (`id`, `commande_id`, `produit_id`, `quantite`, `prix_unitaire`, `prix_total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1232.00, 1232.00, '2026-05-05 12:29:29', '2026-05-05 12:29:29'),
(2, 2, 1, 2, 1232.00, 2464.00, '2026-05-05 12:52:03', '2026-05-05 12:52:03'),
(3, 3, 1, 3, 1257.00, 3771.00, '2026-05-13 13:51:32', '2026-05-13 13:51:32');

-- --------------------------------------------------------

--
-- Structure de la table `echantillons`
--

CREATE TABLE `echantillons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `catalogue_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `idee_produits`
--

CREATE TABLE `idee_produits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `image_lookbooks`
--

CREATE TABLE `image_lookbooks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `lookbook_id` bigint(20) UNSIGNED NOT NULL,
  `is_principale` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `image_personnalisees`
--

CREATE TABLE `image_personnalisees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lookbooks`
--

CREATE TABLE `lookbooks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `sous_titre` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `statut` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `materiaux`
--

CREATE TABLE `materiaux` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mesures`
--

CREATE TABLE `mesures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `produit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'physique',
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mesures`
--

INSERT INTO `mesures` (`id`, `user_id`, `produit_id`, `type`, `data`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'physique', '{\"tour_poitrine\":\"30\",\"tour_taille\":\"30\",\"tour_hanche\":\"30\",\"longueur_manche\":\"24\",\"longueur_totale\":\"56\",\"tour_epaule\":\"24\",\"tour_cou\":null,\"largeur_dos\":\"24\",\"hauteur_taille\":\"24\",\"commentaires\":\"SFFS\"}', '2026-05-13 13:00:47', '2026-05-13 13:00:47'),
(2, 1, 1, 'physique', '{\"tour_poitrine\":\"30\",\"tour_taille\":\"30\",\"tour_hanche\":\"30\",\"longueur_manche\":\"24\",\"longueur_totale\":\"56\",\"tour_epaule\":\"24\",\"tour_cou\":null,\"largeur_dos\":\"24\",\"hauteur_taille\":\"24\",\"commentaires\":\"SFFS\"}', '2026-05-13 13:44:59', '2026-05-13 13:44:59'),
(3, 1, 1, 'physique', '{\"tour_poitrine\":\"30\",\"tour_taille\":\"30\",\"tour_hanche\":\"30\",\"longueur_manche\":\"24\",\"longueur_totale\":\"56\",\"tour_epaule\":\"24\",\"tour_cou\":null,\"largeur_dos\":\"24\",\"hauteur_taille\":\"24\",\"commentaires\":\"SFFS\"}', '2026-05-13 13:50:19', '2026-05-13 13:50:19'),
(4, 1, 1, 'physique', '{\"tour_poitrine\":\"34\",\"tour_taille\":\"30\",\"tour_hanche\":\"30\",\"longueur_manche\":\"24\",\"longueur_totale\":\"56\",\"tour_epaule\":\"24\",\"tour_cou\":null,\"largeur_dos\":\"24\",\"hauteur_taille\":\"24\",\"commentaires\":\"DDSDSDSD\"}', '2026-05-13 16:01:55', '2026-05-13 16:01:55'),
(5, 1, 1, 'physique', '{\"tour_poitrine\":\"34\",\"tour_taille\":\"30\",\"tour_hanche\":\"30\",\"longueur_manche\":\"24\",\"longueur_totale\":\"56\",\"tour_epaule\":\"24\",\"tour_cou\":null,\"largeur_dos\":\"24\",\"hauteur_taille\":\"24\",\"commentaires\":\"DDSDSDSD\"}', '2026-05-26 09:21:57', '2026-05-26 09:21:57'),
(6, 1, 1, 'physique', '{\"tour_poitrine\":\"34\",\"tour_taille\":\"30\",\"tour_hanche\":\"30\",\"longueur_manche\":\"24\",\"longueur_totale\":\"56\",\"tour_epaule\":\"24\",\"tour_cou\":null,\"largeur_dos\":\"24\",\"hauteur_taille\":\"24\",\"commentaires\":\"DDSDSDSD\"}', '2026-05-26 12:08:13', '2026-05-26 12:08:13'),
(7, 1, 1, 'physique', '{\"tour_poitrine\":\"34\",\"tour_taille\":\"30\",\"tour_hanche\":\"30\",\"longueur_manche\":\"24\",\"longueur_totale\":\"56\",\"tour_epaule\":\"24\",\"tour_cou\":null,\"largeur_dos\":\"24\",\"hauteur_taille\":\"24\",\"commentaires\":\"DDSDSDSD\"}', '2026-05-26 12:33:38', '2026-05-26 12:33:38');

-- --------------------------------------------------------

--
-- Structure de la table `methode_paiements`
--

CREATE TABLE `methode_paiements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `methode_paiements`
--

INSERT INTO `methode_paiements` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'paypal', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_21_161333_create_categories_table', 1),
(5, '2025_08_21_161454_create_sous_categories_table', 1),
(6, '2025_08_21_161549_create_collections_table', 1),
(7, '2025_08_21_161709__create_materiaux_table', 1),
(8, '2025_08_21_161710_create_products_table', 1),
(9, '2025_08_21_161753_create_caracteristique_produits_table', 1),
(10, '2025_08_21_161822_create_lookbooks_table', 1),
(11, '2025_08_21_161900_create_image_lookbooks_table', 1),
(12, '2025_08_21_161927_create_video_lookbooks_table', 1),
(13, '2025_08_21_162014_create_point_interactifs_table', 1),
(14, '2025_08_21_162115_create_categorie_option_personnalisations_table', 1),
(15, '2025_08_21_162117_create_options_personnalisations_table', 1),
(16, '2025_08_21_162214_create_sous_option_personnalisations_table', 1),
(17, '2025_08_21_162215_create_valeur_options_table', 1),
(18, '2025_08_21_162256_create_catalogue_echantillons_table', 1),
(19, '2025_08_21_162326_create_echantillons_table', 1),
(20, '2025_08_21_162421_create_carte_cadeaus_table', 1),
(21, '2025_08_21_162506_create_avis_produis', 1),
(22, '2025_08_21_162840_create_idee_produits_table', 1),
(23, '2025_08_21_162930_create_categorie_idee_produits_table', 1),
(24, '2025_08_21_184826_create_mode_livraisons_table', 1),
(25, '2025_08_21_184912_create_commandes_table', 1),
(26, '2025_08_21_184946_create_methode_paiements_table', 1),
(27, '2025_08_21_184948_create_paiements_table', 1),
(28, '2025_08_21_185036_create_notifications_table', 1),
(29, '2025_08_21_190716_create_commande_produit_table', 1),
(30, '2025_09_11_171601_create_piece_produit_table', 1),
(31, '2025_10_14_092109_create_produit_option_valeur_table', 1),
(32, '2025_10_14_092247_create_image_personnalisees', 1),
(33, '2025_10_14_092249_create_produit_image_personnalisees_table', 1),
(34, '2025_10_22_094219_create_personal_access_tokens_table', 1),
(35, '2025_11_18_150530_add_columns_to_commandes_table', 1),
(36, '2025_11_19_144606_add_stock_to_produits_table', 1),
(37, '2026_04_16_170838_drop_categorie_idee_produits_table', 1),
(38, '2026_04_17_110612_create_produit_idee_produit_table', 1),
(39, '2026_05_08_015856_add_image_modele_neutre_to_produits_table', 2),
(40, '2026_05_08_020152_add_image_calque_to_valeur_options_table', 2),
(41, '2026_05_08_021506_add_personnalisation_data_to_commandes_table', 2),
(42, '2026_05_08_083231_add_categorie_option_personnalisation_id_to_sous_categories_table', 3),
(43, '2026_05_13_101028_create_mesures_table', 4);

-- --------------------------------------------------------

--
-- Structure de la table `mode_livraisons`
--

CREATE TABLE `mode_livraisons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `delai_estime` int(11) DEFAULT NULL,
  `cout` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mode_livraisons`
--

INSERT INTO `mode_livraisons` (`id`, `nom`, `delai_estime`, `cout`, `created_at`, `updated_at`) VALUES
(1, 'la poste', NULL, 0.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `vue` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `option_personnalisations`
--

CREATE TABLE `option_personnalisations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `categorie_option_personnalisation_id` bigint(20) UNSIGNED NOT NULL,
  `nom_option` varchar(255) NOT NULL,
  `type_option` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `option_personnalisations`
--

INSERT INTO `option_personnalisations` (`id`, `produit_id`, `categorie_option_personnalisation_id`, `nom_option`, `type_option`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'tissu', 'vetement', '2026-05-08 04:18:59', '2026-05-08 04:18:59'),
(2, NULL, 1, 'styles', 'vetement', '2026-05-08 06:12:38', '2026-05-08 06:12:38');

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

CREATE TABLE `paiements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commande_id` bigint(20) UNSIGNED NOT NULL,
  `methode_paiement_id` bigint(20) UNSIGNED NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `statut` varchar(255) NOT NULL DEFAULT 'en attente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `piece_produit`
--

CREATE TABLE `piece_produit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `piece_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `point_interactifs`
--

CREATE TABLE `point_interactifs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_lookbook_id` bigint(20) UNSIGNED NOT NULL,
  `position_x` double NOT NULL,
  `position_y` double NOT NULL,
  `produit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description_popup` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_produit` varchar(255) DEFAULT NULL,
  `image_modele_neutre` varchar(255) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `prix_base` decimal(10,2) DEFAULT NULL,
  `collection_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sous_categorie_id` bigint(20) UNSIGNED NOT NULL,
  `personnalisable` tinyint(1) NOT NULL DEFAULT 0,
  `type_produit` varchar(255) NOT NULL,
  `gamme_taille` varchar(255) DEFAULT 'sur-mesure',
  `materiau_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delai_fabrication` int(11) DEFAULT NULL,
  `delai_livraison` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `image_produit`, `image_modele_neutre`, `nom`, `description`, `prix_base`, `collection_id`, `sous_categorie_id`, `personnalisable`, `type_produit`, `gamme_taille`, `materiau_id`, `delai_fabrication`, `delai_livraison`, `created_at`, `updated_at`, `stock`) VALUES
(1, 'produits_images/swgYKZJR8dqpUdnwFQwVoY8ozX4OFQu8mhZITupD.jpg', 'produits_modeles/mp9tStcHjbb2Nu31kEYSwRyqX1xHXW3RNTbXuVth.png', 'Costume sortie', 'aaaaza', 1232.00, 1, 1, 1, 'vetement', 'xl', NULL, 10, 12, '2026-04-20 15:31:46', '2026-05-13 13:51:32', 994),
(2, 'produits_images/25Y1sk0bSbIqGmNHpDgLrkB5SGpTPwfWQ5aZbpw7.jpg', NULL, 'Costume tenue', 'tenue deux piece', 134.00, 1, 7, 0, 'tenue', 'xl', NULL, 12, 12, '2026-04-20 15:36:26', '2026-04-20 15:36:26', 1000),
(3, 'produits_images/l3obIxP31tycXutSq7V3onYY6utqUJvwpyxwVqAr.png', NULL, 'costume tenue 2', 'joli costume tenu pour les sortis business ou aaaea eaeaeaeaeae eae eaea eaea eaea eae eaea ea ea eae', 123.00, 1, 7, 1, 'tenue', 'xl', NULL, 12, 12, '2026-05-07 10:21:08', '2026-05-07 10:21:08', 0);

-- --------------------------------------------------------

--
-- Structure de la table `produit_idee_produit`
--

CREATE TABLE `produit_idee_produit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `idee_produit_id` bigint(20) UNSIGNED NOT NULL,
  `ordre` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit_image_personnalisees`
--

CREATE TABLE `produit_image_personnalisees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `image_personnalisee_id` bigint(20) UNSIGNED NOT NULL,
  `option_personnalisation_id` bigint(20) UNSIGNED NOT NULL,
  `valeur_option_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit_option_valeur`
--

CREATE TABLE `produit_option_valeur` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `option_personnalisation_id` bigint(20) UNSIGNED NOT NULL,
  `valeur_option_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EaRzSy8CbaHENMjIeNVQ4M2ca3JITYAPVxDKsWqj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYTVCMEVJeHIwOUQ2ckxRMTBENnlNaUhIWnM4S25vdUU1RVczWUZndiI7czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1780603442),
('eN8yFKwLrEXAZvPKJThwk4TkjPiwCtqudo2k5As3', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiajhZYUJQWTVFRE1LZFFYcWZkQ0R2d3BVV1lUN3diR0p0ZzJFeExkNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWl0cy8xL3BlcnNvbm5hbGlzYXRpb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiY2FydCI7YToxOntpOjE7YTo3OntzOjI6ImlkIjtpOjE7czozOiJub20iO3M6MTQ6IkNvc3R1bWUgc29ydGllIjtzOjQ6InByaXgiO2Q6MTM1NTtzOjg6InF1YW50aXRlIjtpOjE7czo1OiJpbWFnZSI7czo2MDoicHJvZHVpdHNfaW1hZ2VzL3N3Z1lLWkpSOGRxcFVkbndGUXdWb1k4b3pYNE9GUXU4bWhaSVR1cEQuanBnIjtzOjE2OiJwZXJzb25uYWxpc2F0aW9uIjthOjE6e2k6MTtpOjM7fXM6OToibWVzdXJlX2lkIjtpOjc7fX1zOjIyOiJQSFBERUJVR0JBUl9TVEFDS19EQVRBIjthOjA6e319', 1779802560),
('iL6RYdTK7Zk4nu9lSUuA9MjZiR0wg3nN8BWLzhkf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib3lnNUFQMTlscGkwMFJoTkFmOVR5eWJENlBrejVueE9TWnZMSWdJdSI7czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1780565023),
('ZJBxb2cufoKxEFfQyTFFObsUGechXJUMqbscCVQx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNGxPbDF3MkJ3U3RYdGlYcllXb0kzOXN0VGxKOHBnR2Nrd1o4YUtrcyI7czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1780565189);

-- --------------------------------------------------------

--
-- Structure de la table `sous_categories`
--

CREATE TABLE `sous_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `categorie_id` bigint(20) UNSIGNED NOT NULL,
  `categorie_option_personnalisation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sous_categories`
--

INSERT INTO `sous_categories` (`id`, `nom`, `categorie_id`, `categorie_option_personnalisation_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Costumes', 4, 1, 'sous_categories_images/Q0RlD6r1hmv6aT4yhuR4WMj6Y6bu1gzMqkqY3zOe.jpg', '2026-04-20 11:25:44', '2026-05-08 12:06:59'),
(2, 'Chemises', 4, NULL, 'sous_categories_images/8MokfDZtSL5aSJkAbLXF0FwXns77TAhCqA44bwQr.jpg', '2026-04-20 11:43:40', '2026-04-20 11:43:40'),
(3, 'Goodluck', 4, NULL, 'sous_categories_images/H3HGabYpDOi3bf0Zyu1wmqRBo1l4WUNa1soRfJ9h.jpg', '2026-04-20 14:31:56', '2026-04-20 14:31:56'),
(4, 'Costume de cérémonie', 4, NULL, 'sous_categories_images/GCN3KQIwlRlA9TX1BJeSCwCJRtqhNwd60T1wmCe1.webp', '2026-04-20 14:32:37', '2026-04-20 14:32:37'),
(5, 'Costume de ville', 4, NULL, 'sous_categories_images/9kKd1n727CXa0YwZnLC3CvBqzRdToCCq9tnUr58t.webp', '2026-04-20 14:33:54', '2026-04-20 14:33:54'),
(6, 'Costume local', 4, NULL, 'sous_categories_images/pUY5nyrCAm8rACitOjuV7hHGMeE3uJ5NOdfI9X1B.jpg', '2026-04-20 14:33:55', '2026-04-20 14:41:13'),
(7, 'ideeproduit', 6, NULL, 'sous_categories_images/2GKQC3h0WXvzADOtgO3ZTvcuUgg7qdwMuYrO8MHs.jpg', '2026-04-20 15:18:08', '2026-04-20 15:20:55');

-- --------------------------------------------------------

--
-- Structure de la table `sous_option_personnalisations`
--

CREATE TABLE `sous_option_personnalisations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_personnalisation_id` bigint(20) UNSIGNED NOT NULL,
  `nom_sous_option` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `status` varchar(255) DEFAULT 'active',
  `profile_picture` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `status`, `profile_picture`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'mathias', 'mat@gmail.com', NULL, '$2y$12$DSMwHTPRbuurwI3n0IyZw.0CZQ43gSK340PrUqzWtfnfVomitz2li', 'admin', 'active', 'profile_pictures/tLXItLuhStqmWlyHsLU2xf5Fk5zHyv6O88styO87.jpg', 'cR1sqhHtZtKBKU90YTBeZbFGrPzGG3qbOLYG6QxQvXfSew9gmnX9ZeCLAGap', '2026-04-20 10:37:50', '2026-04-20 10:37:50');

-- --------------------------------------------------------

--
-- Structure de la table `valeur_options`
--

CREATE TABLE `valeur_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_personnalisation_id` bigint(20) UNSIGNED NOT NULL,
  `sous_option_personnalisation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `valeur` varchar(255) NOT NULL,
  `image_calque` varchar(255) DEFAULT NULL,
  `ordre_calque` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `valeur_options`
--

INSERT INTO `valeur_options` (`id`, `option_personnalisation_id`, `sous_option_personnalisation_id`, `valeur`, `image_calque`, `ordre_calque`, `image`, `prix`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'webster bleu cobalt', 'valeur_options_imagecalque/OaJsobVaYfnkBdXO7jlKhYaBVClIten2nPqbUsTh.jpg', 1, 'valeur_options/rAqXhMcwW2ishQpBeOAaMlQk8jrqMamQK4iHK9B0.jpg', 12.00, '2026-05-08 06:09:53', '2026-05-26 09:08:04'),
(2, 2, NULL, 'cravate', 'valeur_options_imagecalque/C4ei9ahrZ2znWExjKUr7nMre27Mzd0Pxp39Qw8gh.png', 2, 'valeur_options/K1KcKTaYJnhi4jz7guvcNxad7A47JzS6gnAPyGwJ.png', 25.00, '2026-05-08 06:24:22', '2026-05-08 06:24:22'),
(3, 1, NULL, 'webster rose cobalt', 'valeur_options_imagecalque/JGMxSoe8XV1yVBw6HwLDhIhFIbG7ErXPboantTjE.jpg', 1, 'valeur_options/7vILcuNAIRTq5OEyiYuu64aKrqZebld3KRivGh27.png', 123.00, '2026-05-26 08:36:35', '2026-05-26 08:37:08');

-- --------------------------------------------------------

--
-- Structure de la table `video_lookbooks`
--

CREATE TABLE `video_lookbooks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `lookbook_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis_produis`
--
ALTER TABLE `avis_produis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avis_produis_produit_id_foreign` (`produit_id`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `caracteristique_produits`
--
ALTER TABLE `caracteristique_produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caracteristique_produits_categorie_id_foreign` (`categorie_id`);

--
-- Index pour la table `carte_cadeaus`
--
ALTER TABLE `carte_cadeaus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `catalogue_echantillons`
--
ALTER TABLE `catalogue_echantillons`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie_option_personnalisations`
--
ALTER TABLE `categorie_option_personnalisations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categorie_option_personnalisations_nom_categorie_unique` (`nom_categorie`);

--
-- Index pour la table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collections_sous_categorie_id_foreign` (`sous_categorie_id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `commandes_numero_commande_unique` (`numero_commande`),
  ADD KEY `commandes_user_id_foreign` (`user_id`),
  ADD KEY `commandes_mode_livraison_id_foreign` (`mode_livraison_id`);

--
-- Index pour la table `commande_produit`
--
ALTER TABLE `commande_produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commande_produit_commande_id_foreign` (`commande_id`),
  ADD KEY `commande_produit_produit_id_foreign` (`produit_id`);

--
-- Index pour la table `echantillons`
--
ALTER TABLE `echantillons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `echantillons_catalogue_id_foreign` (`catalogue_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `idee_produits`
--
ALTER TABLE `idee_produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `image_lookbooks`
--
ALTER TABLE `image_lookbooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_lookbooks_lookbook_id_foreign` (`lookbook_id`);

--
-- Index pour la table `image_personnalisees`
--
ALTER TABLE `image_personnalisees`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lookbooks`
--
ALTER TABLE `lookbooks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `materiaux`
--
ALTER TABLE `materiaux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mesures`
--
ALTER TABLE `mesures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mesures_user_id_foreign` (`user_id`),
  ADD KEY `mesures_produit_id_foreign` (`produit_id`);

--
-- Index pour la table `methode_paiements`
--
ALTER TABLE `methode_paiements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mode_livraisons`
--
ALTER TABLE `mode_livraisons`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Index pour la table `option_personnalisations`
--
ALTER TABLE `option_personnalisations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `option_personnalisations_produit_id_foreign` (`produit_id`),
  ADD KEY `fk_categorie_option_id` (`categorie_option_personnalisation_id`);

--
-- Index pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paiements_commande_id_foreign` (`commande_id`),
  ADD KEY `paiements_methode_paiement_id_foreign` (`methode_paiement_id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Index pour la table `piece_produit`
--
ALTER TABLE `piece_produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `piece_produit_produit_id_foreign` (`produit_id`),
  ADD KEY `piece_produit_piece_id_foreign` (`piece_id`);

--
-- Index pour la table `point_interactifs`
--
ALTER TABLE `point_interactifs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `point_interactifs_image_lookbook_id_foreign` (`image_lookbook_id`),
  ADD KEY `point_interactifs_produit_id_foreign` (`produit_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produits_collection_id_foreign` (`collection_id`),
  ADD KEY `produits_sous_categorie_id_foreign` (`sous_categorie_id`),
  ADD KEY `produits_materiau_id_foreign` (`materiau_id`);

--
-- Index pour la table `produit_idee_produit`
--
ALTER TABLE `produit_idee_produit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `produit_idee_produit_produit_id_idee_produit_id_unique` (`produit_id`,`idee_produit_id`),
  ADD KEY `produit_idee_produit_idee_produit_id_foreign` (`idee_produit_id`);

--
-- Index pour la table `produit_image_personnalisees`
--
ALTER TABLE `produit_image_personnalisees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `produit_image_personnalisee_unique` (`produit_id`,`option_personnalisation_id`,`valeur_option_id`),
  ADD KEY `produit_image_personnalisees_image_personnalisee_id_foreign` (`image_personnalisee_id`),
  ADD KEY `produit_image_personnalisees_option_personnalisation_id_foreign` (`option_personnalisation_id`),
  ADD KEY `produit_image_personnalisees_valeur_option_id_foreign` (`valeur_option_id`);

--
-- Index pour la table `produit_option_valeur`
--
ALTER TABLE `produit_option_valeur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `produit_option_valeur_unique` (`produit_id`,`option_personnalisation_id`,`valeur_option_id`),
  ADD KEY `produit_option_valeur_option_personnalisation_id_foreign` (`option_personnalisation_id`),
  ADD KEY `produit_option_valeur_valeur_option_id_foreign` (`valeur_option_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sous_categories_categorie_id_foreign` (`categorie_id`),
  ADD KEY `sous_categories_categorie_option_personnalisation_id_foreign` (`categorie_option_personnalisation_id`);

--
-- Index pour la table `sous_option_personnalisations`
--
ALTER TABLE `sous_option_personnalisations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sous_option_personnalisations_option_personnalisation_id_foreign` (`option_personnalisation_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `valeur_options`
--
ALTER TABLE `valeur_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valeur_options_option_personnalisation_id_foreign` (`option_personnalisation_id`),
  ADD KEY `valeur_options_sous_option_personnalisation_id_foreign` (`sous_option_personnalisation_id`);

--
-- Index pour la table `video_lookbooks`
--
ALTER TABLE `video_lookbooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_lookbooks_lookbook_id_foreign` (`lookbook_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis_produis`
--
ALTER TABLE `avis_produis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `caracteristique_produits`
--
ALTER TABLE `caracteristique_produits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `carte_cadeaus`
--
ALTER TABLE `carte_cadeaus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `catalogue_echantillons`
--
ALTER TABLE `catalogue_echantillons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `categorie_option_personnalisations`
--
ALTER TABLE `categorie_option_personnalisations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commande_produit`
--
ALTER TABLE `commande_produit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `echantillons`
--
ALTER TABLE `echantillons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `idee_produits`
--
ALTER TABLE `idee_produits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `image_lookbooks`
--
ALTER TABLE `image_lookbooks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `image_personnalisees`
--
ALTER TABLE `image_personnalisees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lookbooks`
--
ALTER TABLE `lookbooks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `materiaux`
--
ALTER TABLE `materiaux`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mesures`
--
ALTER TABLE `mesures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `methode_paiements`
--
ALTER TABLE `methode_paiements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `mode_livraisons`
--
ALTER TABLE `mode_livraisons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `option_personnalisations`
--
ALTER TABLE `option_personnalisations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `piece_produit`
--
ALTER TABLE `piece_produit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `point_interactifs`
--
ALTER TABLE `point_interactifs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `produit_idee_produit`
--
ALTER TABLE `produit_idee_produit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit_image_personnalisees`
--
ALTER TABLE `produit_image_personnalisees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit_option_valeur`
--
ALTER TABLE `produit_option_valeur`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `sous_option_personnalisations`
--
ALTER TABLE `sous_option_personnalisations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `valeur_options`
--
ALTER TABLE `valeur_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `video_lookbooks`
--
ALTER TABLE `video_lookbooks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis_produis`
--
ALTER TABLE `avis_produis`
  ADD CONSTRAINT `avis_produis_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `caracteristique_produits`
--
ALTER TABLE `caracteristique_produits`
  ADD CONSTRAINT `caracteristique_produits_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `collections_sous_categorie_id_foreign` FOREIGN KEY (`sous_categorie_id`) REFERENCES `sous_categories` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_mode_livraison_id_foreign` FOREIGN KEY (`mode_livraison_id`) REFERENCES `mode_livraisons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `commandes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commande_produit`
--
ALTER TABLE `commande_produit`
  ADD CONSTRAINT `commande_produit_commande_id_foreign` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commande_produit_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `echantillons`
--
ALTER TABLE `echantillons`
  ADD CONSTRAINT `echantillons_catalogue_id_foreign` FOREIGN KEY (`catalogue_id`) REFERENCES `catalogue_echantillons` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `image_lookbooks`
--
ALTER TABLE `image_lookbooks`
  ADD CONSTRAINT `image_lookbooks_lookbook_id_foreign` FOREIGN KEY (`lookbook_id`) REFERENCES `lookbooks` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `mesures`
--
ALTER TABLE `mesures`
  ADD CONSTRAINT `mesures_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `mesures_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `option_personnalisations`
--
ALTER TABLE `option_personnalisations`
  ADD CONSTRAINT `fk_categorie_option_id` FOREIGN KEY (`categorie_option_personnalisation_id`) REFERENCES `categorie_option_personnalisations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `option_personnalisations_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD CONSTRAINT `paiements_commande_id_foreign` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paiements_methode_paiement_id_foreign` FOREIGN KEY (`methode_paiement_id`) REFERENCES `methode_paiements` (`id`);

--
-- Contraintes pour la table `piece_produit`
--
ALTER TABLE `piece_produit`
  ADD CONSTRAINT `piece_produit_piece_id_foreign` FOREIGN KEY (`piece_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `piece_produit_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `point_interactifs`
--
ALTER TABLE `point_interactifs`
  ADD CONSTRAINT `point_interactifs_image_lookbook_id_foreign` FOREIGN KEY (`image_lookbook_id`) REFERENCES `image_lookbooks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `point_interactifs_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_collection_id_foreign` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `produits_materiau_id_foreign` FOREIGN KEY (`materiau_id`) REFERENCES `materiaux` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `produits_sous_categorie_id_foreign` FOREIGN KEY (`sous_categorie_id`) REFERENCES `sous_categories` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `produit_idee_produit`
--
ALTER TABLE `produit_idee_produit`
  ADD CONSTRAINT `produit_idee_produit_idee_produit_id_foreign` FOREIGN KEY (`idee_produit_id`) REFERENCES `idee_produits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produit_idee_produit_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `produit_image_personnalisees`
--
ALTER TABLE `produit_image_personnalisees`
  ADD CONSTRAINT `produit_image_personnalisees_image_personnalisee_id_foreign` FOREIGN KEY (`image_personnalisee_id`) REFERENCES `image_personnalisees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produit_image_personnalisees_option_personnalisation_id_foreign` FOREIGN KEY (`option_personnalisation_id`) REFERENCES `option_personnalisations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produit_image_personnalisees_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produit_image_personnalisees_valeur_option_id_foreign` FOREIGN KEY (`valeur_option_id`) REFERENCES `valeur_options` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `produit_option_valeur`
--
ALTER TABLE `produit_option_valeur`
  ADD CONSTRAINT `produit_option_valeur_option_personnalisation_id_foreign` FOREIGN KEY (`option_personnalisation_id`) REFERENCES `option_personnalisations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produit_option_valeur_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produit_option_valeur_valeur_option_id_foreign` FOREIGN KEY (`valeur_option_id`) REFERENCES `valeur_options` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD CONSTRAINT `sous_categories_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `sous_categories_categorie_option_personnalisation_id_foreign` FOREIGN KEY (`categorie_option_personnalisation_id`) REFERENCES `categorie_option_personnalisations` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `sous_option_personnalisations`
--
ALTER TABLE `sous_option_personnalisations`
  ADD CONSTRAINT `sous_option_personnalisations_option_personnalisation_id_foreign` FOREIGN KEY (`option_personnalisation_id`) REFERENCES `option_personnalisations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `valeur_options`
--
ALTER TABLE `valeur_options`
  ADD CONSTRAINT `valeur_options_option_personnalisation_id_foreign` FOREIGN KEY (`option_personnalisation_id`) REFERENCES `option_personnalisations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `valeur_options_sous_option_personnalisation_id_foreign` FOREIGN KEY (`sous_option_personnalisation_id`) REFERENCES `sous_option_personnalisations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `video_lookbooks`
--
ALTER TABLE `video_lookbooks`
  ADD CONSTRAINT `video_lookbooks_lookbook_id_foreign` FOREIGN KEY (`lookbook_id`) REFERENCES `lookbooks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
