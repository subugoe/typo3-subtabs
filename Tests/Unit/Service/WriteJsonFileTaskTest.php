<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>
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

/**
 * Test case for class Tx_Subtabs_Service_WriteJsonFileTask
 *
 * @author Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>
 * $Id: WriteJsonFileTaskTest.php 1899 2012-08-06 06:54:22Z pfennigstorf $
 * @package subtabs
 */
class Tx_Subtabs_Tests_Unit_Controller_FaecherControllerTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Subtabs_Service_WriteJsonFileTask
	 */
	protected $fixture;


	/**
	 * @return void
	 */
	public function setUp() {
		$class =  'Tx_Subtabs_Service_WriteJsonFileTask';
		$this->fixture = $this->getMock($class);
	}

	/**
	 * @test
	 */
	public function checkIfDeterminationOfBaseUrlWorksTest() {

		$baseUrl = 'http://www.sub.uni-goettingen.de/';

		$serializedString = 'a:1:{s:7:"baseUrl";s:33:"http://www.sub.uni-goettingen.de/";}';
		$unserialized = unserialize($serializedString);
		$this->assertEquals($baseUrl, $unserialized['baseUrl']);
	}

	public function checkIfExecutionWorks() {
		$this->fixture->execute();
	}

}

?>