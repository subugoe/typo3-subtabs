<?php

class tx_subtabs_faecherSammlungen extends \TYPO3\CMS\Frontend\Plugin\AbstractPlugin {

	/**
	 * Initializes defaults
	 */
	protected function init() {

		require_once(TYPO3CMSCoreUtilityExtensionManagementUtility::extPath('realurl') . 'class.tx_realurl.php');
		$this->realurl = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('tx_realurl');
		/** @var \t3lib_pageSelect  sys_page */
		$GLOBALS['TSFE']->sys_page = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
		/** @var \TYPO3\CMS\Core\TypoScript\TemplateService tmpl */
		$GLOBALS['TSFE']->tmpl = t3lib_div::makeInstance('TYPO3\\CMS\\Core\\TypoScript\\TemplateService');
		$GLOBALS['TSFE']->config['config']['tx_realurl_enable'] = 1;
		/** @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer cObj */
		$this->cObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');
	}

	/**
	 * @return string
	 */
	public function main() {
		$this->init();

		// Collect all Get / Postparameters
		$requestVars = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('faechersammlungen');
		$searchParam = filter_var($requestVars['suche'], FILTER_SANITIZE_STRING);
		$language = filter_var($requestVars['language'], FILTER_SANITIZE_NUMBER_INT);

		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
				't.tag, f.titel, u.titel AS fachtitel, f.uid, f.seite, u.seite as useite',
				'tx_subtabs_domain_model_tags t, tx_subtabs_domain_model_fach f, tx_subtabs_domain_model_faecher u',
				't.tag LIKE  \'%' . $searchParam . '%\' AND f.uid = t.fach AND f.faecher = u.uid AND t.sys_language_uid = ' . $language,
				'',
				'f.uid ASC',
				''
		);
		$resultArray = Array();

		while ($result = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			array_push($resultArray, $result);
		}

		$fachtitel = Array();
		$faechertitel = Array();
		$resultString = '';

		foreach ($resultArray as $result) {

			// just one time the top level item
			if (!in_array($result['fachtitel'], $fachtitel)) {
				$resultString .= '<li><a href="' . $this->getUrl($result['seite']) . '">' . $result['fachtitel'] . '</a>';
				array_push($fachtitel, $result['fachtitel']);
			}
			if (!in_array($result['titel'], $faechertitel)) {
				$titleString = '<a href="' . $this->getUrl($result['seite']) . '">' . $result['titel'] . '</a>';
				$resultString .= $this->wrapResultWith($titleString, 'ul');
				array_push($faechertitel, $result['titel']);
			}
			$resultString .= $this->highlight($result['tag'], $searchParam) . ', ';

		}
		return $this->wrapResultWith($resultString, 'ul');

	}

	/**
	 * @param $hlText
	 * @param $search
	 * @return string
	 */
	protected function highlight($hlText, $search) {
		$hlText = str_replace($search, '<span class="highlight">' . $search . '</span>', $hlText);
		$replace = str_replace(ucfirst($search), '<span class="highlight">' . ucfirst($search) . '</span>', $hlText);
		return $replace;
	}

	/**
	 * @param $result
	 * @param $with
	 * @return string
	 */
	protected function wrapResultWith($result, $with) {
		return '<' . $with . '>' . $result . '</' . $with . '>';
	}

	/**
	 * @param $pid
	 * @param $params
	 * @return mixed
	 */
	protected function getUrl($pid, $params = NULL) {
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'pages', 'uid = ' . (int)$pid);
		$pagerow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
		$conf['LD'] = $GLOBALS['TSFE']->tmpl->linkData($pagerow, '', 0, 'index.php', '', \TYPO3\CMS\Core\Utility\GeneralUtility::implodeArrayForUrl('', $params));
		$this->realurl->encodeSpURL($conf, $this);
		$url = $conf['LD']['totalURL'];
		return $url;
	}

}

$eID = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('tx_subtabs_faecherSammlungen');
$content = $eID->main();
echo $content;
