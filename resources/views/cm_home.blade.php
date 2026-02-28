@extends('layouts.app')

@section('title', 'Accueil - MTN Microsoft Store')

@section('content')
<!-- Hero Section with MTN Branding -->
<div class="bg-gradient-to-r from-black to-gray-900 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-5xl font-bold mb-6">
                Bienvenue sur le <span class="text-mtn-yellow">MTN Microsoft Store</span>
            </h1>
            <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
                Achetez vos licences Microsoft avec MTN Mobile Money. 
                Livraison instantanée, support local, prix compétitifs.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('products.index') }}" class="btn-mtn px-8 py-4 rounded-lg text-lg font-bold hover:scale-105 transition">
                    Voir les Produits
                </a>
                <a href="{{ route('contact') }}" class="bg-white text-black px-8 py-4 rounded-lg text-lg font-bold hover:bg-gray-100 transition">
                    Nous Contacter
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Pourquoi choisir MTN?</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="bg-mtn-yellow rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Livraison Instantanée</h3>
                <p class="text-gray-600">Recevez vos licences en quelques minutes</p>
            </div>
            
            <div class="text-center">
                <div class="bg-mtn-yellow rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-2">MTN Mobile Money</h3>
                <p class="text-gray-600">Payez facilement avec votre téléphone</p>
            </div>
            
            <div class="text-center">
                <div class="bg-mtn-yellow rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Support Local</h3>
                <p class="text-gray-600">Assistance en français 24/7</p>
            </div>
            
            <div class="text-center">
                <div class="bg-mtn-yellow rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-2">100% Authentique</h3>
                <p class="text-gray-600">Partenaire officiel Microsoft</p>
            </div>
        </div>
    </div>
</div>

<!-- Featured Products -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-4">Produits Populaires</h2>
        <p class="text-center text-gray-600 mb-12">Découvrez nos meilleures offres Microsoft</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Product Card 1 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="bg-mtn-yellow p-6 text-center">
                    <h3 class="text-2xl font-bold text-black">Microsoft 365 Business Basic</h3>
                </div>
                <div class="p-6">
                    <div class="text-center mb-6">
                        <span class="text-4xl font-bold">12,000</span>
                        <span class="text-gray-600"> XAF/mois</span>
                    </div>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>1 TB de stockage cloud</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Web et mobile</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Email professionnel</span>
                        </li>
                    </ul>
                    <a href="{{ route('products.index') }}" class="block w-full btn-mtn text-center py-3 rounded-lg font-bold">
                        Commander
                    </a>
                </div>
            </div>
            
            <!-- Product Card 2 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition border-4 border-mtn-yellow">
                <div class="bg-black p-6 text-center relative">
                    <div class="absolute top-0 right-0 bg-mtn-yellow text-black px-3 py-1 text-sm font-bold rounded-bl-lg">
                        POPULAIRE
                    </div>
                    <h3 class="text-2xl font-bold text-white">Microsoft 365 Business Standard</h3>
                </div>
                <div class="p-6">
                    <div class="text-center mb-6">
                        <span class="text-4xl font-bold">25,000</span>
                        <span class="text-gray-600"> XAF/mois</span>
                    </div>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Applications de bureau</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Teams illimité</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>1 TB de stockage</span>
                        </li>
                    </ul>
                    <a href="{{ route('products.index') }}" class="block w-full btn-mtn text-center py-3 rounded-lg font-bold">
                        Commander
                    </a>
                </div>
            </div>
            
            <!-- Product Card 3 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="bg-gradient-to-r from-black to-gray-800 p-6 text-center">
                    <h3 class="text-2xl font-bold text-white">Microsoft 365 E3</h3>
                </div>
                <div class="p-6">
                    <div class="text-center mb-6">
                        <span class="text-4xl font-bold">45,000</span>
                        <span class="text-gray-600"> XAF/mois</span>
                    </div>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Sécurité avancée</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Conformité avancée</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Analytics Power BI</span>
                        </li>
                    </ul>
                    <a href="{{ route('products.index') }}" class="block w-full btn-mtn text-center py-3 rounded-lg font-bold">
                        Commander
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-black text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-4">
            Prêt à commencer avec <span class="text-mtn-yellow">MTN?</span>
        </h2>
        <p class="text-xl text-gray-300 mb-8">
            Achetez vos licences Microsoft en toute sécurité avec MTN Mobile Money
        </p>
        <a href="{{ route('products.index') }}" class="btn-mtn px-10 py-4 rounded-lg text-xl font-bold inline-block hover:scale-105 transition">
            Voir tous les produits
        </a>
    </div>
</div>
@endsection
