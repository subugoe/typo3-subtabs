<?php
namespace Subugoe\Subtabs\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>
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
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Catalogue tab
 */
class Kataloge extends AbstractEntity
{

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
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Subugoe\Subtabs\Domain\Model\Katalog> $katalogListe
     */
    protected $katalogListe;

    /**
     * Commaseparated list of pages
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Subugoe\Subtabs\Domain\Model\Page> $seitenListe
     */
    protected $seitenListe;

    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all \TYPO3\CMS\Extbase\Persistence\ObjectStorage properties.
     */
    protected function initStorageObjects()
    {
        /**
         * Do not modify this method!
         * It will be rewritten on each save in the kickstarter
         * You may modify the constructor of this class instead
         */
        $this->katalogListe = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->seitenListe = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the titel
     *
     * @return string $titel
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
     * Adds a Katalog
     *
     * @param \Subugoe\Subtabs\Domain\Model\Katalog $katalogListe
     */
    public function addKatalogListe(\Subugoe\Subtabs\Domain\Model\Katalog $katalogListe)
    {
        $this->katalogListe->attach($katalogListe);
    }

    /**
     * Removes a Katalog
     *
     * @param \Subugoe\Subtabs\Domain\Model\Katalog $katalogListeToRemove The Sammlung to be removed
     */
    public function removeKatalogListe(\Subugoe\Subtabs\Domain\Model\Katalog $katalogListeToRemove)
    {
        $this->katalogListe->detach($katalogListeToRemove);
    }

    /**
     * Returns the katalogListe
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Subugoe\Subtabs\Domain\Model\Katalog> $katalogListe
     */
    public function getKatalogListe()
    {
        return $this->katalogListe;
    }

    /**
     * Sets the katalogListe
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage <\Subugoe\Subtabs\Domain\Model\Katalog> $katalogListe
     */
    public function setKatalogListe($katalogListe)
    {
        $this->katalogListe = $katalogListe;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Subugoe\Subtabs\Domain\Model\Page>
     */
    public function getSeitenListe()
    {
        return $this->seitenListe;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage <\Subugoe\Subtabs\Domain\Model\Page> $seitenListe
     */
    public function setSeitenListe($seitenListe)
    {
        $this->seitenListe = $seitenListe;
    }
}
