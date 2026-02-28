<?php

return [
    // Navigation
    'nav' => [
        'home' => 'Accueil',
        'products' => 'Produits',
        'about' => 'À Propos',
        'contact' => 'Contact',
        'login' => 'Connexion',
        'register' => 'Inscription',
        'dashboard' => 'Tableau de Bord',
        'orders' => 'Mes Commandes',
        'subscriptions' => 'Mes Abonnements',
        'logout' => 'Déconnexion',
    ],

    // Common
    'common' => [
        'welcome' => 'Bienvenue',
        'search' => 'Rechercher',
        'filter' => 'Filtrer',
        'sort' => 'Trier',
        'save' => 'Enregistrer',
        'cancel' => 'Annuler',
        'delete' => 'Supprimer',
        'edit' => 'Modifier',
        'view' => 'Voir',
        'back' => 'Retour',
        'next' => 'Suivant',
        'previous' => 'Précédent',
        'submit' => 'Soumettre',
        'loading' => 'Chargement...',
        'no_results' => 'Aucun résultat trouvé',
        'error' => 'Erreur',
        'success' => 'Succès',
    ],

    // Products
    'products' => [
        'title' => 'Produits Microsoft',
        'subtitle' => 'Choisissez la solution parfaite pour votre entreprise',
        'all_products' => 'Tous les Produits',
        'featured' => 'Produits en Vedette',
        'category' => 'Catégorie',
        'price' => 'Prix',
        'per_month' => 'par mois',
        'per_year' => 'par an',
        'add_to_cart' => 'Ajouter au Panier',
        'buy_now' => 'Acheter Maintenant',
        'learn_more' => 'En Savoir Plus',
        'quantity' => 'Quantité',
        'users' => 'Utilisateurs',
        'min_quantity' => 'Minimum: :min utilisateurs',
        'description' => 'Description',
        'features' => 'Fonctionnalités',
    ],

    // Cart & Checkout
    'cart' => [
        'title' => 'Panier',
        'empty' => 'Votre panier est vide',
        'item' => 'Article',
        'price' => 'Prix',
        'quantity' => 'Quantité',
        'total' => 'Total',
        'subtotal' => 'Sous-total',
        'tax' => 'Taxe',
        'grand_total' => 'Total Général',
        'continue_shopping' => 'Continuer les Achats',
        'proceed_to_checkout' => 'Passer la Commande',
        'remove' => 'Retirer',
    ],

    'checkout' => [
        'title' => 'Paiement',
        'billing_information' => 'Informations de Facturation',
        'company_information' => 'Informations sur l\'Entreprise',
        'payment_method' => 'Mode de Paiement',
        'review_order' => 'Vérifier la Commande',
        'place_order' => 'Passer la Commande',
        'processing' => 'Traitement de votre commande...',
        'success' => 'Commande passée avec succès!',
        'error' => 'Échec du traitement de la commande. Veuillez réessayer.',
    ],

    // Dashboard
    'dashboard' => [
        'welcome' => 'Bienvenue, :name',
        'overview' => 'Aperçu',
        'active_subscriptions' => 'Abonnements Actifs',
        'total_spent' => 'Total Dépensé',
        'pending_orders' => 'Commandes en Attente',
        'recent_activity' => 'Activité Récente',
    ],

    // Orders
    'orders' => [
        'title' => 'Mes Commandes',
        'order_number' => 'Commande #:number',
        'date' => 'Date',
        'status' => 'Statut',
        'total' => 'Total',
        'view_details' => 'Voir les Détails',
        'download_invoice' => 'Télécharger la Facture',
        'statuses' => [
            'pending' => 'En Attente',
            'processing' => 'En Traitement',
            'completed' => 'Terminée',
            'failed' => 'Échouée',
            'cancelled' => 'Annulée',
        ],
    ],

    // Subscriptions
    'subscriptions' => [
        'title' => 'Mes Abonnements',
        'active' => 'Actif',
        'expired' => 'Expiré',
        'renews_on' => 'Renouvelle le',
        'expires_on' => 'Expire le',
        'auto_renew' => 'Renouvellement automatique',
        'manage' => 'Gérer',
        'upgrade' => 'Mettre à Niveau',
        'cancel' => 'Annuler',
        'renew' => 'Renouveler',
        'statuses' => [
            'active' => 'Actif',
            'suspended' => 'Suspendu',
            'cancelled' => 'Annulé',
            'expired' => 'Expiré',
        ],
    ],

    // Forms
    'forms' => [
        'email' => 'Adresse E-mail',
        'password' => 'Mot de Passe',
        'confirm_password' => 'Confirmer le Mot de Passe',
        'company_name' => 'Nom de l\'Entreprise',
        'first_name' => 'Prénom',
        'last_name' => 'Nom',
        'phone' => 'Numéro de Téléphone',
        'address' => 'Adresse',
        'city' => 'Ville',
        'state' => 'État/Province',
        'postal_code' => 'Code Postal',
        'country' => 'Pays',
        'domain' => 'Domaine de l\'Entreprise',
    ],

    // Admin
    'admin' => [
        'dashboard' => 'Tableau de Bord Admin',
        'customers' => 'Clients',
        'products' => 'Produits',
        'orders' => 'Commandes',
        'subscriptions' => 'Abonnements',
        'settings' => 'Paramètres',
        'branding' => 'Image de Marque',
        'reports' => 'Rapports',
    ],

    // Messages
    'messages' => [
        'order_success' => 'Votre commande a été passée avec succès!',
        'order_error' => 'Une erreur s\'est produite lors du traitement de votre commande.',
        'payment_success' => 'Paiement reçu avec succès!',
        'payment_pending' => 'En attente de confirmation du paiement...',
        'subscription_activated' => 'Abonnement activé avec succès!',
        'settings_saved' => 'Paramètres enregistrés avec succès!',
    ],
];
