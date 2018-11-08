<?php
/**
 * Carte Interactive Google Map.
 * ---------------------------------------------------------------------------------------------------------------------
 * @var tiFy\Contracts\View\ViewController $this
 */
?>

<?php
echo partial(
    'tag',
    [
        'tag'     => 'div',
        'attrs'   => $this->get('attrs', [])
    ]
);
?>