<?php

namespace TYPO3\T3extblog\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Felix Nagel <info@felixnagel.com>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractConditionViewHelper as BaseAbstractConditionViewHelper;
use TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\ViewHelperNode;
use TYPO3Fluid\Fluid\Core\Compiler\TemplateCompiler;

/**
 * Base for condition VH
 *
 * Includes caching fixes for 7.x while maintaining 6.x compatibility
 */
class AbstractConditionViewHelper extends BaseAbstractConditionViewHelper {

	/**
	 * @inheritdoc
	 */
	public function initializeArguments() {
		$this->registerArgument('then', 'mixed', 'Value to be returned if the condition if met.', FALSE);
		$this->registerArgument('else', 'mixed', 'Value to be returned if the condition if not met.', FALSE);
	}

	/**
	 * @return mixed
	 */
	public function render() {
		if (static::evaluateCondition($this->arguments)) {
			return $this->renderThenChild();
		} else {
			return $this->renderElseChild();
		}
	}

	/**
	 * Disable caching
	 *
	 * @inheritdoc
	 */
	public function compile(
		$argumentsName,
		$closureName,
		&$initializationPhpCode,
		ViewHelperNode $node,
		TemplateCompiler $compiler
	) {
		if (version_compare(TYPO3_branch, '8.0', '>=')) {
			$compiler->disable();
		} else {
			parent::compile($argumentsName, $closureName, $initializationPhpCode, $node, $compiler);
		}

		return $compiler::SHOULD_GENERATE_VIEWHELPER_INVOCATION;
	}
}
