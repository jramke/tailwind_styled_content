<?php

namespace Jramke\TailwindStyledContent\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class MinViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    protected $escapeOutput = false;

    public function initializeArguments()
    {
        $this->registerArgument('value', 'mixed', 'The array or comma separated string', true);
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): mixed {
        $value = $arguments['value'];

        if (is_array($value)) {
            return min($value);
        }

        if (is_string($value)) {
            $value = explode(',', $value);
            return min($value);
        }

        throw new \InvalidArgumentException('The value must be an array or a comma separated string.');
    }
}
