<?php

use tiFy\Plugins\GoogleMap\GoogleMap;

if (!function_exists('google_map')) :
    /**
     * Récupération de l'instance.
     *
     * @return GoogleMap
     */
    function google_map()
    {
        return app(GoogleMap::class);
    }
endif;