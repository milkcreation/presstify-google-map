<?php

/**
 * Exemple de configuration.
 */

return [
    /**
     * Clé d'api Google (requise).
     * @see https://developers.google.com/maps/documentation/javascript/get-api-key?hl=fr
     */
    'apiKey'        => '',

    /**
     * Définition du marqueur.
     * -----------------------------------------------------------------------------------------------------------------
     */
    /**
     * Géocode (recommandé)
     */
    'geocode'       => [
        'address' => 'Tour Eiffel, Paris'
    ],

    /**
     * Options du marqueur (alternative.
     * @see : https://developers.google.com/maps/documentation/javascript/reference?hl=fr#MarkerOptions
     */
    'markerOptions' => [
        // Latitude/Longitude (si adresse non définie ou introuvable)
        'position' => [
            'lat' => 48.85837009999999,
            'lng' => 2.2944813000000295
        ],
        // Titre de survol
        'title'    => __('La tour Eiffel', 'tify'),
        // Visibilité du marqueur
        'visible'  => true,
        // Personnalisation de l'icône (url requise) - format recommandé png 32x32
        //icon => '',
    ],

    /**
     * Options de la carte.
     * -----------------------------------------------------------------------------------------------------------------
     * @see https://developers.google.com/maps/documentation/javascript/reference/map?hl=fr#MapOptions
     */
    'mapOptions'    => [
        // Couleur de fond.
        'backgroundColor'        => 'none',
        // Positionnement du centre de la carte
        'center'                 => [
            'lat' => 48.85837009999999,
            'lng' => 2.2944813000000295
        ],
        // Zoom
        'zoom'                   => 12,
        // Styles de la carte.
        // @see https://developers.google.com/maps/documentation/javascript/reference/map?hl=fr#MapTypeStyle
        // @resources https://snazzymaps.com/
        'styles'                 => 'subtle-grayscale.json',
        // Activation/Désactivation de toutes les interfaces (elles peuvent être réactivées indépendemment)
        'disableDefaultUI'       => false,
        // Activation/Désactivation du centrage et du zoom au double click
        'disableDoubleClickZoom' => false,
        // Activation/Désactivation du parcours de la carte
        'draggable'              => true,
        // Activation/Désactivation de l'affichage plein écran
        'fullscreenControl'      => true,
        // Activation/Désactivation des raccourcis clavier de contrôle de la carte
        'keyboardShortcuts'      => true,
        // Activation/Désactivation du choix de type de carte
        'mapTypeControl'         => true,
        // Activation/Désactivation de l'echelle
        'scaleControl'           => true,
        // Activation/Désactivation du zoom au défilement (recommandé :false)
        'scrollwheel'            => false,
        // Activation/Désactivation de controleur d'affichage StreetView
        'streetViewControl'      => true,
        // Activation/Désactivation du controleur de zoom
        'zoomControl'            => true,
        // Options des contrôles
        // @see https://developers.google.com/maps/documentation/javascript/reference/control?hl=fr#MapTypeControlOptions
        'mapTypeControlOptions'  => [
            // @see https://developers.google.com/maps/documentation/javascript/reference/map?hl=fr#MapTypeId
            'mapTypeIds' => ["HYBRID", "ROADMAP", "SATELLITE", "TERRAIN"],
            // @see https://developers.google.com/maps/documentation/javascript/reference/control?hl=fr#ControlPosition
            'position'   => 'google.maps.ControlPosition.TOP_LEFT',
            // @see https://developers.google.com/maps/documentation/javascript/reference/control?hl=fr#MapTypeControlStyle
            'style'      => 'google.maps.MapTypeControlStyle.DROPDOWN_MENU'
        ]
    ]
];