<?php
namespace Subugoe\Subtabs\Domain\Model;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>, Goettingen State and University Library
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
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Eine Sammlung
 */
class Fach extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject
{

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
     * @var \Subugoe\Subtabs\Domain\Model\Page
     */
    protected $seite;
    /**
     * Liste der Tags
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Subugoe\Subtabs\Domain\Model\Tags> $tagListe
     */
    protected $tagListe;

    public function __construct()
    {
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties.
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->fachListe = new ObjectStorage();
    }

    /**
     * Adds a Tag
     *
     * @param \Subugoe\Subtabs\Domain\Model\Tags $tagListe
     * @return void
     */
    public function addTagListe(\Subugoe\Subtabs\Domain\Model\Tags $tagListe)
    {
        $this->tagListe->attach($tagListe);
    }

    /**
     * Removes a Tag
     *
     * @param \Subugoe\Subtabs\Domain\Model\Tags $tagListeToRemove The Sammlung to be removed
     * @return void
     */
    public function removeTagListe(\Subugoe\Subtabs\Domain\Model\Tags $tagListeToRemove)
    {
        $this->tagListe->detach($tagListeToRemove);
    }

    /**
     * Returns the tagListe
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Subugoe\Subtabs\Domain\Model\Tags> $tagListe
     */
    public function getTagListe()
    {
        return $this->tagListe;
    }

    /**
     * Sets the tagListe
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Subugoe\Subtabs\Domain\Model\Tags> $tagListe
     * @return void
     */
    public function setTagListe($tagListe)
    {
        $this->tagListe = $tagListe;
    }

    /**
     * Titel des Fachs (getter)
     *
     * @return string
     */
    public function getTitel()
    {
        return $this->titel;
    }

    /**
     * Setter fuer den Tites
     *
     * @param string $titel
     */
    public function setTitel($titel)
    {
        $this->titel = $titel;
    }

    /**
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Subugoe\Subtabs\Domain\Model\Page>
     */
    public function getSeite()
    {
        return $this->seite;
    }

    /**
     *
     * @param Tx_Extbase_Persistence_ObjectStorage <\Subugoe\Subtabs\Domain\Model\Page> $seite
     */
    public function setSeite($seite)
    {
        $this->seite = $seite;
    }
}
