<?php
namespace Subugoe\Subtabs\Domain\Model;

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
 * a catalogue
 */
class Katalog extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject
{

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
     * @var bool $neuesFenster
     */
    protected $neuesFenster;

    /**
     * Returns the titel
     *
     * @return string
     */
    public function getTitel()
    {
        return $this->titel;
    }

    /**
     * Sets the titel
     *
     * @param string $titel
     */
    public function setTitel($titel)
    {
        $this->titel = $titel;
    }

    /**
     * Returns the url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Returns suchparameter
     *
     * @return string
     */
    public function getSuchparameter()
    {
        return $this->suchparameter;
    }

    /**
     * Setter for suchparameter
     *
     * @param $suchparameter
     */
    public function setSuchparameter($suchparameter)
    {
        $this->suchparameter = $suchparameter;
    }

    /**
     * Returns the information
     *
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Sets the information
     *
     * @param string $information
     */
    public function setInformation($information)
    {
        $this->information = $information;
    }

    /**
     * Returns the neuesFenster
     *
     * @return bool
     */
    public function getNeuesFenster()
    {
        return $this->neuesFenster;
    }

    /**
     * Returns the boolean state of neuesFenster
     *
     * @return bool
     */
    public function isNeuesFenster()
    {
        return $this->getNeuesFenster();
    }

    /**
     * Sets the neuesFenster
     *
     * @param bool $neuesFenster
     */
    public function setNeuesFenster($neuesFenster)
    {
        $this->neuesFenster = $neuesFenster;
    }

    /**
     * @return string
     */
    public function getDirektLink()
    {
        return $this->direktLink;
    }

    /**
     * @param string $direktLink
     */
    public function setDirektLink($direktLink)
    {
        $this->direktLink = $direktLink;
    }

    /**
     * @return string
     */
    public function getDirektLinkTitel()
    {
        return $this->direktLinkTitel;
    }

    /**
     * @param string $direktLinkTitel
     */
    public function setDirektLinkTitel($direktLinkTitel)
    {
        $this->direktLinkTitel = $direktLinkTitel;
    }
}
