<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>,
*  Goettingen State and University Library, Germany
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
 * Eine Sammlung
 */
class Tx_Subtabs_Domain_Model_Katalog extends Tx_Extbase_DomainObject_AbstractValueObject {

	/**
	 * Titel des Katalogs
	 *
	 * @var string $titel
	 * @validate NotEmpty
	 */
	protected $titel;

	/**
	 * URL zum Katalog
	 *
	 * @var string $url
	 * @validate NotEmpty
	 */
	protected $url;

	/**
	 * Direktlink zum Katalog
	 *
	 * @var string $direktLink
	 */
	protected $direktLink;

	/**
	 * @var string
	 */
	protected $direktLinkTitel;

	/**
	 * Parameter der Suche
	 * @var string $suchparameter
	 */
	protected $suchparameter;

	/**
	 * Informationstext zur Sammlung
	 *
	 * @var string $information
	 * @validate NotEmpty
	 */
	protected $information;

	/**
	 * Ob das Suchergebnis in einem neuen Fenster geoeffnet werden soll
	 *
	 * @var boolean $neuesFenster
	 */
	protected $neuesFenster;

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
	 * Returns the titel
	 *
	 * @return string
	 */
	public function getTitel() {
		return $this->titel;
	}

	/**
	 * Sets the url
	 *
	 * @param string $url
	 * @return void
	 */
	public function setUrl($url) {
		$this->url = $url;
	}

	/**
	 * Returns the url
	 *
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * Returns suchparameter
	 *
	 * @return string
	 */
	public function getSuchparameter() {
		return $this->suchparameter;
	}

	/**
	 * Setter for suchparameter
	 *
	 * @param $suchparameter
	 */
	public function setSuchparameter($suchparameter) {
		$this->suchparameter = $suchparameter;
	}

	/**
	 * Sets the information
	 *
	 * @param string $information
	 * @return void
	 */
	public function setInformation($information) {
		$this->information = $information;
	}

	/**
	 * Returns the information
	 *
	 * @return string
	 */
	public function getInformation() {
		return $this->information;
	}

	/**
	 * Sets the neuesFenster
	 *
	 * @param boolean $neuesFenster
	 * @return void
	 */
	public function setNeuesFenster($neuesFenster) {
		$this->neuesFenster = $neuesFenster;
	}

	/**
	 * Returns the neuesFenster
	 *
	 * @return boolean
	 */
	public function getNeuesFenster() {
		return $this->neuesFenster;
	}

	/**
	 * Returns the boolean state of neuesFenster
	 *
	 * @return boolean
	 */
	public function isNeuesFenster() {
		return $this->getNeuesFenster();
	}

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
		// empty
	}

	/**
	 * @param string $direktLink
	 */
	public function setDirektLink($direktLink) {
		$this->direktLink = $direktLink;
	}

	/**
	 * @return string
	 */
	public function getDirektLink() {
		return $this->direktLink;
	}

	/**
	 * @param string $direktLinkTitel
	 */
	public function setDirektLinkTitel($direktLinkTitel) {
		$this->direktLinkTitel = $direktLinkTitel;
	}

	/**
	 * @return string
	 */
	public function getDirektLinkTitel() {
		return $this->direktLinkTitel;
	}

}
?>