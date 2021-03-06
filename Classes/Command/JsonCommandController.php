<?php
namespace Subugoe\Subtabs\Command;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Ingo Pfennigstorf <pfennigstorf@sub-goettingen.de>
 *      Goettingen State Library
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * ************************************************************* */

use MatthiasMullie\Minify;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

require_once ExtensionManagementUtility::extPath('subtabs') . 'vendor/autoload.php';

class JsonCommandController extends CommandController
{

    /**
     * Write Json files to location
     */
    public function writeJsonFilesCommand()
    {
        $result = false;

        $subConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['subtabs']);

        $hostname = $subConf['baseUrl'];

        /** @var Minify\JS $minifier */
        $minifier = new Minify\JS();

        // do it twice. one tine for each language
        for ($i = 0; $i <= 1; $i++) {
            $destinationDirectory = GeneralUtility::getFileAbsFileName('uploads/tx_subtabs/data-' . $i . '.js');
            $url = $hostname . '?type=1011&L=' . $i;
            $json = GeneralUtility::getUrl($url, 0);
            $minifier->add($json);
            GeneralUtility::devLog($url, 'subtabs', 1);
            GeneralUtility::writeFile($destinationDirectory, $minifier->minify()) ? $result = true : $result = false;
        }

        return $result;
    }
}
