<?php

namespace TYPO3\T3extblog\ViewHelpers\Frontend;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 Georg Ringer <typo3@ringerge.org>
 *  (c) 2013-2015 Felix Nagel <info@felixnagel.com>
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

use TYPO3\T3extblog\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * ViewHelper to render the page title.
 */
class TitleTagViewHelper extends AbstractViewHelper
{
    /**
     * Override the title tag.
     *
     * @param bool   $prepend
     * @param string $searchTitle
     */
    public function render($prepend = true, $searchTitle = null)
    {
        if (TYPO3_MODE === 'BE') {
            return;
        }

        $content = $this->renderChildren();

        if (empty($content) !== true) {
            if ($prepend === true) {
                $content = $content.GeneralUtility::getTsFe()->page['title'];
            }

            if ($searchTitle === null) {
                $searchTitle = $content;
            }

            GeneralUtility::getTsFe()->indexedDocTitle = $searchTitle;
            GeneralUtility::getTsFe()->page['title'] = $content;
        }
    }
}
