<?php
namespace Subugoe\Subtabs\Domain\Model;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>,
 *  Goettingen State and University Library,
 *  Germany http://www.sub.uni-goettingen.de
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
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Reiter Faecher und Sammlungen
 */
class Faecher extends AbstractEntity
{

    /**
     * Titel des Faches / der Sammlung
     * @var string
     */
    protected $titel;
    /**
     * Liste der Faecher
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Subugoe\Subtabs\Domain\Model\Fach> $fachListe
     */
    protected $fachListe;

    /**
     * Link zu der Seite der Uebersicht
     * @var \Subugoe\Subtabs\Domain\Model\Page
     */
    protected $seite;

    public function __construct()
    {
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties.
     */
    protected function initStorageObjects()
    {

        $this->fachListe = new ObjectStorage();
        $this->seite = new ObjectStorage();

    }

    /**
     * Adds a Fach
     *
     * @param \Subugoe\Subtabs\Domain\Model\Fach $fachListe
     */
    public function addFachListe(\Subugoe\Subtabs\Domain\Model\Fach $fachListe)
    {
        $this->fachListe->attach($fachListe);
    }

    /**
     * Removes a Fach
     *
     * @param \Subugoe\Subtabs\Domain\Model\Fach $fachListeToRemove Das zu loeschende Fach
     */
    public function removeFachListe(\Subugoe\Subtabs\Domain\Model\Fach $fachListeToRemove)
    {
        $this->fachListe->detach($fachListeToRemove);
    }

    /**
     * Returns the fachListe
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Subugoe\Subtabs\Domain\Model\Fach> $fachListe
     */
    public function getFachListe()
    {
        return $this->fachListe;
    }

    /**
     * Sets the fachListe
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Subugoe\Subtabs\Domain\Model\Fach> $fachListe
     */
    public function setFachListe($fachListe)
    {
        $this->fachListe = $fachListe;
    }

    /**
     * Der Titel des Knotens
     * @return string Titel des Knotens
     */
    public function getTitel()
    {
        return $this->titel;
    }

    /**
     * Setter fuer den Titel
     * @param string $titel
     */
    public function setTitel($titel)
    {
        $this->titel = $titel;
    }

    /**
     * Getter fuer das Fach
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Subugoe\Subtabs\Domain\Model\Page>
     */
    public function getSeite()
    {
        return $this->seite;
    }

    /**
     * Setter fuer das Fach
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Subugoe\Subtabs\Domain\Model\Page> $seite
     */
    public function setSeite($seite)
    {
        $this->seite = $seite;
    }

    /**
     * @return mixed
     */
    public function encodeJSON()
    {
        $json = [];

        foreach ($this as $key => $value) {
            $json->$key = $value;
        }
        return $json;
    }

}
