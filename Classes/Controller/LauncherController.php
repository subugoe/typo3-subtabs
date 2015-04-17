<?php
namespace Subugoe\Subtabs\Controller;
/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>, Goettingen State and University Library, Germany
 *  http://www.sub.uni-goettingen.de
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

/**
 * Fuer das Launchen zustaendiger Controller
 *
 * @author Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>
 */
class LauncherController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * Startet die Aktion fuer den katalogreiter
	 *
	 * @return void
	 */
	public function showKatalogeAction() {
		$this->forward('list', 'Kataloge');
	}

	/**
	 * Startet die Aktion fuer den Faecher Reiter
	 *
	 * @return void
	 */
	public function showFaecherAction() {
		$this->forward('suche', 'Faecher');
	}

	/**
	 * Startet die Aktion fuer den Webseite Reiter
	 *
	 * @return void
	 */
	public function showWebseiteAction() {
		$this->forward('list', 'Webseite');
	}
	
	/**
	 * Zeige alle Tabs auf einmal
	 *
	 * @return void
	 */
	public function showTabsAction() {
		$this->forward('list', 'Tab');
	}

}
