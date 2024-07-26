<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Tailwind Styled Content',
    'description' => 'Fluid templates for TYPO3 content elements with Tailwind CSS.',
    'category' => 'templates',
    'version' => '0.0.1',
    'state' => 'beta',
    'author' => 'Joost Ramke',
    'author_email' => 'hey@joostramke.com',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-13.9.99',
            'fluid' => '11.5.0-13.9.99',
            'frontend' => '11.5.0-13.9.99',
        ],
        'conflicts' => [
            'css_styled_content' => '*',
            'fluid_styled_content' => '*',
        ],
        'suggests' => [],
    ],
];
