<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Tailwind Styled Content',
    'description' => 'Alternative for fluid_styled_content using Tailwind CSS, providing a clean, robust and modern starting point.',
    'category' => 'templates',
    'version' => '1.2.0',
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
