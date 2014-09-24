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

/**
 * Controller for the Tab object
 */
class TabController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * @var \TYPO3\CMS\Core\Cache\Frontend\StringFrontend
	 */
	protected $cacheInstance;

	/**
	 * Repository fuer den Reiter Kataloge
	 * @var \Subugoe\Subtabs\Domain\Repository\KatalogeRepository
	 * @inject
	 */
	protected $katalogeRepository;
	/**
	 * Repository mit den Faechern
	 * @var \Subugoe\Subtabs\Domain\Repository\FaecherRepository
	 * @inject
	 */
	protected $faecherRepository;

	/**
	 * @var integer
	 */
	protected $language;

	/**
	 * Initialisierung von Defaultwerten
	 *
	 * @return void
	 */
	public function initializeAction() {
		$this->language = $GLOBALS['TSFE']->sys_language_uid;
		/** @var \TYPO3\CMS\Core\Page\PageRenderer $pageRenderer */
		$pageRenderer = $GLOBALS['TSFE']->getPageRenderer();
		$pageRenderer->addCssFile('typo3conf/ext/subtabs/Resources/Public/Css/Tabs.css');
	}

	/**
	 * shows all tabs
	 *
	 * @return void
	 */
	public function listAction() {

		// Reiter Kataloge
		$kataloge = $this->katalogeRepository->findAll();
		// Reiter Faecher Sammlungen
		$faechersammlungen = $this->faecherRepository->findAll();
		// Uebergabe an den View
		$this->view->assignMultiple(array(
						'faechersammlungen' => $faechersammlungen,
						'kataloge' => $kataloge
				)
		);
	}

	/**
	 * JSON Ausgabe der ganzen Synonyme und Fachbereiche
	 *
	 * @return void
	 */
	public function jsonAction() {
		// Ausgabe aller Faecher und Sammlungen
		$faechersammlungen = $this->faecherRepository->findFaecherSammlungen($GLOBALS['TSFE']->sys_language_uid);
		$this->view->assign('faechersammlungen', $faechersammlungen);
	}
}
