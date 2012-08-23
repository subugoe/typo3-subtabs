<?php

/* * *************************************************************
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
 * ************************************************************* */

/**
 * Eine Sammlung
 */
class Tx_Subtabs_Domain_Model_Fach extends Tx_Extbase_DomainObject_AbstractValueObject {

	/**
	 * Titel des Fachs
	 *
	 * @var string $titel
	 * @validate NotEmpty
	 */
	protected $titel;
	/**
	 * Link zur Seite des Fachknotens
	 *
	 * @var Tx_Subtabs_Domain_Model_Page
	 */
	protected $seite;
	/**
	 * Liste der Tags
	 * @lazy
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Subtabs_Domain_Model_Tags> $tagListe
	 */
	protected $tagListe;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		// Do not remove the next line: It would break the functionality
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
		$this->fachListe = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Adds a Tag
	 *
	 * @param Tx_Subtabs_Domain_Model_Tags $tagListe
	 * @return void
	 */
	public function addTagListe(Tx_Subtabs_Domain_Model_Tags $tagListe) {
		$this->tagListe->attach($tagListe);
	}

	/**
	 * Removes a Tag
	 *
	 * @param Tx_Subtabs_Domain_Model_Tags $tagListeToRemove The Sammlung to be removed
	 * @return void
	 */
	public function removeTagListe(Tx_Subtabs_Domain_Model_Tags $tagListeToRemove) {
		$this->tagListe->detach($tagListeToRemove);
	}

	/**
	 * Returns the tagListe
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Subtabs_Domain_Model_Tags> $tagListe
	 */
	public function getTagListe() {
		return $this->tagListe;
	}

	/**
	 * Sets the tagListe
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Subtabs_Domain_Model_Tags> $tagListe
	 * @return void
	 */
	public function setTagListe($tagListe) {
		$this->tagListe = $tagListe;
	}

	/**
	 * Titel des Fachs (getter)
	 *
	 * @return string
	 */
	public function getTitel() {
		return $this->titel;
	}

	/**
	 * Setter fuer den Tites
	 *
	 * @param string $titel 
	 */
	public function setTitel($titel) {
		$this->titel = $titel;
	}

	/**
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Subtabs_Domain_Model_Page>
	 */
	public function getSeite() {
		return $this->seite;
	}

	/**
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Subtabs_Domain_Model_Page> $seite
	 */
	public function setSeite($seite) {
		$this->seite = $seite;
	}
}
?>