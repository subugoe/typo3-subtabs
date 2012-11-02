<?php

########################################################################
# Extension Manager/Repository config file for ext "subtabs".
#
# Auto generated 04-04-2012 09:11
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Tabs',
	'description' => 'Reiter / Tabs für die SUB Webseiten',
	'category' => 'plugin',
	'author' => 'Ingo Pfennigstorf',
	'author_email' => 'pfennigstorf@sub.uni-goettingen.de',
	'author_company' => 'Goettingen State and University Library, Germany http://www.sub.uni-goettingen.de',
	'shy' => '',
	'dependencies' => 'cms,extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => 1,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '2.0.1',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'extbase' => '',
			'fluid' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
	'_md5_values_when_last_written' => 'a:87:{s:9:"build.xml";s:4:"aaeb";s:21:"ext_conf_template.txt";s:4:"68b3";s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"177a";s:14:"ext_tables.php";s:4:"c3bf";s:14:"ext_tables.sql";s:4:"3590";s:12:"t3jquery.txt";s:4:"60e7";s:40:"Classes/Controller/FaecherController.php";s:4:"0ac2";s:40:"Classes/Controller/KatalogController.php";s:4:"3d84";s:41:"Classes/Controller/KatalogeController.php";s:4:"c5e1";s:41:"Classes/Controller/LauncherController.php";s:4:"cc23";s:36:"Classes/Controller/TabController.php";s:4:"e1cd";s:29:"Classes/Domain/Model/Fach.php";s:4:"3424";s:32:"Classes/Domain/Model/Faecher.php";s:4:"e4b4";s:32:"Classes/Domain/Model/Katalog.php";s:4:"2536";s:33:"Classes/Domain/Model/Kataloge.php";s:4:"06d0";s:28:"Classes/Domain/Model/Tab.php";s:4:"86e6";s:29:"Classes/Domain/Model/Tags.php";s:4:"25df";s:33:"Classes/Domain/Model/Webseite.php";s:4:"dd3a";s:44:"Classes/Domain/Repository/FachRepository.php";s:4:"084c";s:47:"Classes/Domain/Repository/FaecherRepository.php";s:4:"20f0";s:48:"Classes/Domain/Repository/KatalogeRepository.php";s:4:"0454";s:37:"Classes/Service/WritejsonfileTask.php";s:4:"50d4";s:47:"Classes/ViewHelpers/CommaExploderViewHelper.php";s:4:"c33f";s:43:"Classes/ViewHelpers/PageTitleViewHelper.php";s:4:"a86c";s:41:"Configuration/FlexForms/flexform_tabs.xml";s:4:"bfd8";s:26:"Configuration/TCA/Fach.php";s:4:"c0bc";s:29:"Configuration/TCA/Faecher.php";s:4:"7e15";s:29:"Configuration/TCA/Katalog.php";s:4:"9c8c";s:30:"Configuration/TCA/Kataloge.php";s:4:"5750";s:26:"Configuration/TCA/Tags.php";s:4:"7436";s:30:"Configuration/TCA/Webseite.php";s:4:"40fc";s:38:"Configuration/TypoScript/constants.txt";s:4:"aafc";s:34:"Configuration/TypoScript/setup.txt";s:4:"af64";s:23:"Documentation/ChangeLog";s:4:"e35a";s:31:"Documentation/Manual/Manual.rst";s:4:"b198";s:46:"Resources/Private/Backend/Layouts/Default.html";s:4:"4671";s:50:"Resources/Private/Backend/Partials/FormErrors.html";s:4:"f5bc";s:58:"Resources/Private/Backend/Partials/Faecher/Properties.html";s:4:"f262";s:58:"Resources/Private/Backend/Partials/Katalog/FormFields.html";s:4:"c39d";s:58:"Resources/Private/Backend/Partials/Katalog/Properties.html";s:4:"4b16";s:59:"Resources/Private/Backend/Partials/Webseite/Properties.html";s:4:"f262";s:53:"Resources/Private/Backend/Templates/Faecher/Show.html";s:4:"b561";s:53:"Resources/Private/Backend/Templates/Katalog/Edit.html";s:4:"cdeb";s:53:"Resources/Private/Backend/Templates/Katalog/List.html";s:4:"761e";s:52:"Resources/Private/Backend/Templates/Katalog/New.html";s:4:"14a6";s:53:"Resources/Private/Backend/Templates/Katalog/Show.html";s:4:"feb4";s:54:"Resources/Private/Backend/Templates/Kataloge/List.html";s:4:"53f5";s:56:"Resources/Private/Backend/Templates/Sammlungen/List.html";s:4:"b87a";s:54:"Resources/Private/Backend/Templates/Webseite/Show.html";s:4:"f84c";s:40:"Resources/Private/Language/locallang.xml";s:4:"682d";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"cc28";s:45:"Resources/Private/Language/locallang_tabs.xml";s:4:"ecfe";s:38:"Resources/Private/Layouts/Default.html";s:4:"cd49";s:36:"Resources/Private/Layouts/Plain.html";s:4:"49be";s:42:"Resources/Private/Layouts/Widget/Solr.html";s:4:"7929";s:39:"Resources/Private/Partials/Katalog.html";s:4:"e5b8";s:39:"Resources/Private/Partials/Solrtab.html";s:4:"577f";s:32:"Resources/Private/Sass/Tabs.scss";s:4:"d5f6";s:32:"Resources/Private/Sass/config.rb";s:4:"18ea";s:45:"Resources/Private/Templates/Faecher/List.html";s:4:"0039";s:46:"Resources/Private/Templates/Faecher/Suche.html";s:4:"80c7";s:45:"Resources/Private/Templates/Katalog/List.html";s:4:"d539";s:46:"Resources/Private/Templates/Kataloge/List.html";s:4:"cfaf";s:50:"Resources/Private/Templates/Launcher/ShowTabs.html";s:4:"d41d";s:41:"Resources/Private/Templates/Tab/Json.html";s:4:"d696";s:41:"Resources/Private/Templates/Tab/List.html";s:4:"4901";s:43:"Resources/Public/Ajax/FaecherSammlungen.php";s:4:"a9fe";s:29:"Resources/Public/Css/Tabs.css";s:4:"38b5";s:38:"Resources/Public/Icons/arrow_right.gif";s:4:"0c15";s:38:"Resources/Public/Icons/arrow_right.png";s:4:"e4b4";s:43:"Resources/Public/Icons/arrow_right_grey.png";s:4:"3e36";s:45:"Resources/Public/Icons/button_shade_large.png";s:4:"d68e";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:58:"Resources/Public/Icons/tx_subtabs_domain_model_faecher.gif";s:4:"1103";s:60:"Resources/Public/Icons/tx_subtabs_domain_model_formulare.gif";s:4:"905a";s:58:"Resources/Public/Icons/tx_subtabs_domain_model_katalog.gif";s:4:"905a";s:59:"Resources/Public/Icons/tx_subtabs_domain_model_kataloge.gif";s:4:"905a";s:59:"Resources/Public/Icons/tx_subtabs_domain_model_sammlung.gif";s:4:"4e5b";s:61:"Resources/Public/Icons/tx_subtabs_domain_model_sammlungen.gif";s:4:"1103";s:59:"Resources/Public/Icons/tx_subtabs_domain_model_webseite.gif";s:4:"1103";s:38:"Resources/Public/JavaScript/Suggest.js";s:4:"b0f4";s:39:"Resources/Public/JavaScript/TabClick.js";s:4:"44d6";s:35:"Resources/Public/JavaScript/Tabs.js";s:4:"57ae";s:42:"Tests/Controller/FaecherControllerTest.php";s:4:"9b74";s:15:"build/phpcs.xml";s:4:"ab01";s:15:"build/phpmd.xml";s:4:"ab48";}',
);

?>