<?php

namespace TYPO3\T3extblog\Hooks\Sitemap;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014-2015 Felix Nagel <info@felixnagel.com>
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

use DmitryDulepov\DdGooglesitemap\Renderers\NewsSitemapRenderer;
use TYPO3\T3extblog\Utility\GeneralUtility;

/**
 * This class contains a renderer for the 'news' sitemap.
 */
class Renderer extends NewsSitemapRenderer
{
    /**
     * Creates an instance of this class.
     */
    public function __construct()
    {
        if (GeneralUtility::getTsFe()->tmpl->setup['plugin.']['tx_t3extblog.']['settings.']['blogName']) {
            $this->sitename = GeneralUtility::getTsFe()->tmpl->setup['plugin.']['tx_t3extblog.']['settings.']['blogName'];
        } else {
            $this->sitename = GeneralUtility::getTsFe()->tmpl->setup['sitetitle'];
        }

        $this->sitename = htmlspecialchars($this->sitename);
    }
}
