<?php

declare(strict_types=1);

defined('TYPO3') or die();

// Define TypoScript as content rendering template.
// This is normally set in Fluid Styled Content.
$GLOBALS['TYPO3_CONF_VARS']['FE']['contentRenderingTemplates'][] = 'tailwindstyledcontent/Configuration/TypoScript/';

// Only include page.tsconfig if TYPO3 version is below 12 so that it is not imported twice.
$versionInformation = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Information\Typo3Version::class);
if ($versionInformation->getMajorVersion() < 12) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
        @import "EXT:tailwind_styled_content/Configuration/page.tsconfig"
    ');
}