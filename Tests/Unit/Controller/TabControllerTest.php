<?php
namespace Subugoe\Subtabs\Tests\Unit\Controller;

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
 *  the Free Software Foundation; either version 2 of the License, or
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

use Subugoe\Subtabs\Controller\TabController;
use Subugoe\Subtabs\Domain\Repository\FaecherRepository;

/**
 * Test case for class Tx_Subtabs_Controller_FachController
 */
class TabControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

    /**
     * @var TabController
     */
    protected $fixture;

    /**
     * @var FaecherRepository
     */
    protected $repository;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->fixture = $this->getMock(TabController::class);

        /**
         * @var $repository \Subugoe\Subtabs\Domain\Repository\FaecherRepository
         */
        $this->repository = $this->getMock(
            FaecherRepository::class,
            ['findAll', 'findByUid', 'update', 'add', 'remove', 'countAll', 'findSuchbegriff']
        );

    }

    /**
     * @test
     * @markTestIncomplete
     */
    public function testFachAnlage()
    {
        $i = 1;

        $this->assertEquals(1, $i);
    }

}
