<?php

declare(strict_types=1);

namespace Jramke\TailwindStyledContent\ViewHelpers;

use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\TypoScript\TypoScriptService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * A ViewHelper for creating a link for an image popup.
 *
 * = Example =
 *
 * <code title="enlarge image on click">
 * <tsc:lightbox image="{image}" configuration="{settings.images.popup}"><img src=""></tsc:lightbox>
 * </code>
 *
 * <output>
 * <a href="url" onclick="javascript" target="thePicture"><img src=""></a>
 * </output>
 *
 */
final class LightboxViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        $this->registerArgument('image', FileInterface::class, 'The original image file', true);
        $this->registerArgument(
            'configuration',
            'array',
            'TypoScript properties for the "imageLinkWrap" function',
            true
        );
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext): string
    {
        /** @var FileInterface $image */
        $image = $arguments['image'];
        self::getContentObjectRenderer()->setCurrentFile($image);

        $objDataBackup = null;
        if ($renderingContext->getVariableProvider()->exists('data')) {
            $objDataBackup = self::getContentObjectRenderer()->data;
            self::getContentObjectRenderer()->data = $renderingContext->getVariableProvider()->get('data');
        }
        $configuration = self::getTypoScriptService()->convertPlainArrayToTypoScriptArray($arguments['configuration']);
        $content = $renderChildrenClosure();
        $configuration['enable'] = true;

        $result = self::getContentObjectRenderer()->imageLinkWrap((string)$content, $image, $configuration);
        if ($objDataBackup) {
            self::getContentObjectRenderer()->data = $objDataBackup;
        }
        return $result;
    }

    protected static function getContentObjectRenderer(): ContentObjectRenderer
    {
        return $GLOBALS['TSFE']->cObj;
    }

    protected static function getTypoScriptService(): TypoScriptService
    {
        return GeneralUtility::makeInstance(TypoScriptService::class);
    }
}
