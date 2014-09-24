<?php
namespace Subugoe\Subtabs\Controller;
/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>
 *  Goettingen State and University Library, Germany
 *  http://www.sub.uni-goettingen.de
 *
 *  All rights reserved
 *
 *   This script is part of the TYPO3 project. The TYPO3 project is
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
 * Controller for the Sammlungen object
 *
 */
class KatalogeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * katalogeRepository
	 *
	 * @var \Subugoe\Subtabs\Domain\Repository\KatalogeRepository
	 */
	protected $katalogeRepository;
	/**
	 * GOK Repository verfuegbar machen
	 *
	 * @var \Subugoe\Subtabs\Domain\Repository\GokRepository 
	 */
	protected $gokRepository;

	/**
	 * Alle IRRE Kataloge
	 *
	 * @param \Subugoe\Subtabs\Domain\Repository\KatalogeRepository $katalogeRepository 
	 */
	public function injectKataloge(\Subugoe\Subtabs\Domain\Repository\KatalogeRepository $katalogeRepository) {
		$this->katalogeRepository = $katalogeRepository;
	}

	/**
	 * Alle GOK Kataloge
	 *
	 * @param \Subugoe\Subtabs\Domain\Repository\GokRepository $gokRepository
	 * @return void
	 */
	public function injectGok(\Subugoe\Subtabs\Domain\Repository\GokRepository $gokRepository) {
		$this->gokRepository = $gokRepository;
	}

	/**
	 * Displays all Katalogeintraege
	 *
	 * @return void
	 */
	public function listAction() {
		$kataloge = $this->katalogeRepository->findAll();
		$goks = $this->gokRepository->findAll();

		$this->view->assign('kataloge', $kataloge);
		$this->view->assign('goks', $goks);
	}
}
