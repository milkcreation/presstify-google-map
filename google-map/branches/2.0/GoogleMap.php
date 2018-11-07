<?php

/**
 * @name GoogleMap
 * @desc Extension PresstiFy de gestion de carte interactive Google Map.
 * @author Jordy Manner <jordy@tigreblanc.fr>
 * @package presstify-plugins/google-map
 * @namespace tiFy\Plugins\GoogleMap
 * @version 2.0.0
 */

namespace tiFy\Plugins\GoogleMap;

use tiFy\Contracts\View\ViewController;
use tiFy\Contracts\View\ViewEngine;
use tiFy\Kernel\Params\ParamsBagTrait;

/**
 * Class GoogleMap
 * @package tiFy\Plugins\GoogleMap
 *
 * Activation :
 * ---------------------------------------------------------------------------------------------------------------------
 * Dans config/app.php ajouter \tiFy\Plugins\GoogleMap\GoogleMap à la liste des fournisseurs de services chargés automatiquement par l'application.
 * ex.
 * <?php
 * ...
 * use tiFy\Plugins\GoogleMap\GoogleMap;
 * ...
 *
 * return [
 *      ...
 *      'providers' => [
 *          ...
 *          GoogleMap::class
 *          ...
 *      ]
 * ];
 *
 * Configuration :
 * ---------------------------------------------------------------------------------------------------------------------
 * Dans le dossier de config, créer le fichier google-map.php
 * @see /vendor/presstify-plugins/google-map/Resources/config/google-map.php Exemple de configuration
 */
class GoogleMap
{
    use ParamsBagTrait;

    /**
     * CONSTRUCTEUR.
     *
     * @return void
     */
    public function __construct()
    {
        add_action(
            'init',
            function () {
                wp_register_style('GoogleMap', $this->resourcesUrl('assets/css/styles.css'), [], 181107);

                wp_register_script(
                    'gmap',
                    '//maps.googleapis.com/maps/api/js?key=' . config('google-map.apiKey', ''),
                    [],
                    'v3',
                    false
                );

                wp_register_script('GoogleMap', $this->resourcesUrl('assets/js/script.js'), ['gmap'], 181107, true);

                $this->parse(config('google-map', []));
            },
            999999
        );
    }

    /**
     * Résolution de sortie du contrôleur au format chaîne de caractères.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->render();
    }

    /**
     * Affichage.
     *
     * @return
     */
    public function render()
    {
        return $this->viewer('google-map', $this->all());
    }

    /**
     * Récupération du chemin absolu vers une ressource.
     *
     * @param string $path Chemin relatif vers un sous élément.
     *
     * @return string
     */
    public function resourcesDir($path = '')
    {
        $path = '/Resources/' . ltrim($path, '/');

        return file_exists(__DIR__ . $path) ? __DIR__ . $path : '';
    }

    /**
     * Récupération de l'url absolue vers une ressource.
     *
     * @param string $path Chemin relatif vers un sous élément.
     *
     * @return string
     */
    public function resourcesUrl($path = '')
    {
        $cinfo = class_info($this);
        $path = '/Resources/' . ltrim($path, '/');

        return file_exists(__DIR__ . $path) ? class_info($this)->getUrl() . $path : '';
    }

    /**
     * Récupération d'un instance du controleur de liste des gabarits d'affichage ou d'un gabarit d'affichage.
     * {@internal Si aucun argument n'est passé à la méthode, retourne l'instance du controleur de liste.}
     * {@internal Sinon récupére l'instance du gabarit d'affichage et passe les variables en argument.}
     *
     * @param null|string view Nom de qualification du gabarit.
     * @param array $data Liste des variables passées en argument.
     *
     * @return ViewController|ViewEngine
     */
    public function viewer($view = null, $data = [])
    {
        if (!app()->bound('google-map.viewer')) :
            app()->singleton(
                'google-map.viewer',
                function () {
                    $default_dir = $this->resourcesDir('views');

                    return view()
                        ->setDirectory($default_dir)
                        ->setOverrideDir(
                            (($override_dir = $this->get('viewer.override_dir')) && is_dir($override_dir))
                                ? $override_dir
                                : $default_dir
                        );
                }
            );
        endif;

        /** @var ViewEngine $viewer */
        $viewer = app('google-map.viewer');

        if (func_num_args() === 0) :
            return $viewer;
        endif;

        return $viewer->make("_override::{$view}", $data);
    }
}