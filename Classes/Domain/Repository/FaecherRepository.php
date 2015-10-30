<?php
namespace Subugoe\Subtabs\Domain\Repository;

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
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for Faecher
 */
class FaecherRepository extends Repository
{

    /**
     * Suche in allen Teilen des verketteten Objekts nach dem Vorkommen eines Strings
     * @param string $suchbegriff
     * @return array|QueryResultInterface
     */
    public function findSuchbegriff($suchbegriff)
    {

        $query = $this->createQuery();
        $query = $query->matching(
            $query->logicalOr(
                $query->like('titel', '%' . $suchbegriff . '%'),
                $query->like('fachListe.titel', '%' . $suchbegriff . '%')
            ));

        return $query->execute();
    }

    /**
     * @return mixed
     */
    public function findOnlyTopLevelFaecher()
    {
        $query = $this->createQuery();
        $query = $query->statement('SELECT * FROM tx_subtabs_domain_model_faecher');
        return $query->execute();
    }

    /**
     * @param int $sysLanguageUid
     * @return mixed
     */
    public function findFaecherSammlungen($sysLanguageUid)
    {
        $query = $this->createQuery();
        $statement = 'SELECT * FROM tx_subtabs_domain_model_faecher WHERE deleted = 0 AND hidden = 0 AND sys_language_uid = ' . $sysLanguageUid;
        $query = $query->statement($statement);
        return $query->execute();
    }

}
