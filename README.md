# 🍽️ DineReserve

> Système de réservation de tables en ligne pour restaurant — Projet Laravel

---

## 📋 Description

**DineReserve** est une application web développée avec **Laravel** pour permettre à un restaurant de gérer efficacement les réservations de ses tables. Les clients peuvent réserver une table à une date et heure spécifiques, tandis que les administrateurs (gérants) peuvent gérer la disponibilité des tables.

---

## ⚙️ Technologies utilisées

- **Laravel 10+** – Backend & logique métier
- **MySQL** – Base de données relationnelle
- **Laravel Breeze** – Authentification simple (Login/Signup)
- **TailwindCSS** – Stylisation moderne & responsive
- **JavaScript** – Interactivité front-end
- **Mailtrap** – Simulation d’envoi d’emails

---

## 🧩 Fonctionnalités principales

### 🔐 Authentification

- Inscription / Connexion
- Rôles : `client` et `admin`
- Redirection en fonction du rôle

### 🪑 Gestion des tables (admin uniquement)

- Création / Modification / Suppression de tables
- Définition de capacité et disponibilité

### 📆 Réservations (clients)

- Réservation d’une table pour une date et une heure
- Liste de ses réservations passées et à venir
- Notification de confirmation par email

### ✏️ Modification / Annulation

- Un client peut modifier ou annuler une réservation tant qu’elle est à venir

### 📨 Notification par Email

- Un email est envoyé au client après chaque réservation ou modification
