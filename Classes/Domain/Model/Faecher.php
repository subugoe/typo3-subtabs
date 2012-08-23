<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>, 
 *	Goettingen State and University Library, 
 *	Germany http://www.sub.uni-goettingen.de
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
 * Reiter Faecher und Sammlungen
 */
class Tx_Subtabs_Domain_Model_Faecher extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Titel des Faches / der Sammlung
	 * @var string
	 */
	protected $titel;
	/**
	 * Liste der Faecher
	 * @lazy
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Subtabs_Domain_Model_Fach> $fachListe
	 */
	protected $fachListe;
	/**
	 * Link zu der Seite der Uebersicht
	 * @var Tx_Subtabs_Domain_Model_Page
	 */
	protected $seite;

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

		$this->fachListe = new Tx_Extbase_Persistence_ObjectStorage();
		$this->seite = new Tx_Extbase_Persistence_ObjectStorage();

	}

	/**
	 * Adds a Fach
	 *
	 * @param Tx_Subtabs_Domain_Model_Fach $fachListe
	 * @return void
	 */
	public function addFachListe(Tx_Subtabs_Domain_Model_Fach $fachListe) {
		$this->fachListe->attach($fachListe);
	}

	/**
	 * Removes a Fach
	 *
	 * @param Tx_Subtabs_Domain_Model_Fach $fachListeToRemove Das zu loeschende Fach
	 * @return void
	 */
	public function removeFachListe(Tx_Subtabs_Domain_Model_Fach $fachListeToRemove) {
		$this->fachListe->detach($fachListeToRemove);
	}

	/**
	 * Returns the fachListe
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Subtabs_Domain_Model_Fach> $fachListe
	 */
	public function getFachListe() {
		return $this->fachListe;
	}

	/**
	 * Sets the fachListe
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Subtabs_Domain_Model_Fach> $fachListe
	 * @return void
	 */
	public function setFachListe($fachListe) {
		$this->fachListe = $fachListe;
	}

	/**
	 * Der Titel des Knotens
	 * @return string Titel des Knotens
	 */
	public function getTitel() {
		return $this->titel;
	}

	/**
	 * Setter fuer den Titel
	 * @param string $titel 
	 */
	public function setTitel($titel) {
		$this->titel = $titel;
	}

	/**
	 * Getter fuer das Fach
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Subtabs_Domain_Model_Page>
	 */
	public function getSeite() {
		return $this->seite;
	}

	/**
	 * Setter fuer das Fach
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Subtabs_Domain_Model_Page> $seite
	 */
	public function setSeite($seite) {
		$this->seite = $seite;
	}

	public function encodeJSON()
	{


	    foreach ($this as $key => $value)
	    {
	        $json->$key = $value;
	    }
	    return $json;
	}

}

?>