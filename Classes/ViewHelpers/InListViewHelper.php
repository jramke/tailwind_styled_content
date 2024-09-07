<?php

namespace Jramke\TailwindStyledContent\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class InListViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    protected $escapeOutput = false;

    public function initializeArguments()
    {
        $this->registerArgument('needle', 'mixed', 'The value to search for', true);
        $this->registerArgument('haystack', 'string', 'The comma-separated list to search in', true);
        $this->registerArgument('strict', 'boolean', 'Boolean value if check is strict or not', false, false);
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): int {
        $needle = $arguments['needle'];
        $haystack = $arguments['haystack'];
        $strict = $arguments['strict'];

        $list = array_map('trim', explode(',', $haystack));
        return in_array($needle, $list, $strict) ? 1 : 0;
    }
}