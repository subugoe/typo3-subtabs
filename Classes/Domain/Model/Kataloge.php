<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>, Goettingen State and University Library, Germany http://www.sub.uni-goettingen.de
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
***************************************************************/


/**
 * Reiter Sammlungen
 */
 class Tx_Subtabs_Domain_Model_Kataloge extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Title of the tab
	 *
	 * @var string $titel
	 * @validate NotEmpty
	 */
	protected $titel;

	/**
	 * List of catalogues
	 *
	 * @lazy
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Subtabs_Domain_Model_Katalog> $katalogListe
	 */
	protected $katalogListe;

	 /**
	  * Commaseparated list of pages
	  *
	  * @lazy
	  * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Subtabs_Domain_Model_Page> $seitenListe
	  */
	protected $seitenListe;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		* Do not modify this method!
		* It will be rewritten on each save in the kickstarter
		* You may modify the constructor of this class instead
		*/
		$this->katalogListe = new Tx_Extbase_Persistence_ObjectStorage();
		$this->seitenListe = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Returns the titel
	 *
	 * @return string $titel
	 */
	public function getTitel() {
		return $this->titel;
	}

	/**
	 * Sets the titel
	 *
	 * @param string $titel
	 * @return void
	 */
	public function setTitel($titel) {
		$this->titel = $titel;
	}

	/**
	 * Adds a Katalog
	 *
	 * @param Tx_Subtabs_Domain_Model_Katalog $katalogListe
	 * @return void
	 */
	public function addKatalogListe(Tx_Subtabs_Domain_Model_Katalog $katalogListe) {
		$this->katalogListe->attach($katalogListe);
	}

	/**
	 * Removes a Katalog
	 *
	 * @param Tx_Subtabs_Domain_Model_Katalog $katalogListeToRemove The Sammlung to be removed
	 * @return void
	 */
	public function removeKatalogListe(Tx_Subtabs_Domain_Model_Katalog $katalogListeToRemove) {
		$this->katalogListe->detach($katalogListeToRemove);
	}

	/**
	 * Returns the katalogListe
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Subtabs_Domain_Model_Katalog> $katalogListe
	 */
	public function getKatalogListe() {
		return $this->katalogListe;
	}

	/**
	 * Sets the katalogListe
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Subtabs_Domain_Model_Katalog> $katalogListe
	 * @return void
	 */
	public function setKatalogListe($katalogListe) {
		$this->katalogListe = $katalogListe;
	}

	 /**
	  * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Subtabs_Domain_Model_Page> $seitenListe
	  */
	 public function setSeitenListe($seitenListe) {
		 $this->seitenListe = $seitenListe;
	 }

	 /**
	  * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Subtabs_Domain_Model_Page>
	  */
	 public function getSeitenListe() {
		 return $this->seitenListe;
	 }

 }
?>