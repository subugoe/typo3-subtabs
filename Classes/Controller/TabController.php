<?php

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
class Tx_Subtabs_Controller_TabController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var t3lib_cache_frontend_StringFrontend
	 */
	protected $cacheInstance;

	/**
	 * Repository fuer den Reiter Kataloge
	 * @var Tx_Subtabs_Domain_Repository_KatalogeRepository
	 * @inject
	 */
	protected $katalogeRepository;
	/**
	 * Repository mit den Faechern
	 * @var Tx_Subtabs_Domain_Repository_FaecherRepository
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
		$this->initializeCache();
		$this->language = $GLOBALS['TSFE']->sys_language_uid;
	}

	/**
	 * Initialisierung des Cachingframeworks
	 *
	 * @return void
	 */
	protected function initializeCache() {

		t3lib_cache::initializeCachingFramework();
		try {
			$this->cacheInstance = $GLOBALS['typo3CacheManager']->getCache('subtabs_cache');
		} catch (t3lib_cache_exception_NoSuchCache $e) {
			$this->cacheInstance = $GLOBALS['typo3CacheFactory']->create(
				'subtabs_cache',
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['subtabs_cache']['frontend'],
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['subtabs_cache']['backend'],
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['subtabs_cache']['options']
			);
		}
	}

	/**
	 * shows all tabs
	 *
	 * @return void
	 */
	public function listAction() {

		$cacheName = 'subtabs-' . $this->language;

		if ($this->cacheInstance->has($cacheName) === FALSE) {
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

			$toCache = $this->view->render();
			$this->cacheInstance->set($cacheName, $toCache, array(), 0);
		}
		return $this->cacheInstance->get($cacheName);

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
?>