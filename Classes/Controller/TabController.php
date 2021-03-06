<?php
namespace Subugoe\Subtabs\Controller;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>
 *      Goettingen State and University Library, Germany
 *      http://www.sub.uni-goettingen.de
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

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Subugoe\Subtabs\Domain\Repository\FaecherRepository;

/**
 * Controller for the Tab object
 */
class TabController extends ActionController
{

    /**
     * @var \Subugoe\Subtabs\Domain\Repository\KatalogeRepository
     * @inject
     */
    protected $katalogeRepository;

    /**
     * @var integer
     */
    protected $language;

    /**
     * Initialisierung von Defaultwerten
     */
    public function initializeAction()
    {
        $this->language = $GLOBALS['TSFE']->sys_language_uid;
    }

    /**
     * Shows all tabs
     */
    public function listAction()
    {

        // catalogue tab
        $kataloge = $this->katalogeRepository->findAll();

        $this->view->assign('kataloge', $kataloge);
    }

    /**
     * JSON Ausgabe der ganzen Synonyme und Fachbereiche
     */
    public function jsonAction()
    {
        /** @var FaecherRepository $faecherRepository */
        $faecherRepository = $this->objectManager->get(FaecherRepository::class);

        // Ausgabe aller Faecher und Sammlungen
        $faechersammlungen = $faecherRepository->findFaecherSammlungen($this->language);
        $this->view->assign('faechersammlungen', $faechersammlungen);
    }
}
