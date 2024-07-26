<?php

defined('TYPO3') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'tailwind_styled_content',
    'Configuration/TypoScript/',
    'Tailwind Styled Content'
);
