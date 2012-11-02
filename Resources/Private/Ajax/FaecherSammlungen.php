<?php
require_once(PATH_tslib.'class.tslib_pibase.php');

class  tx_subtabs_faecherSammlungen extends tslib_pibase {

	/**
	 *
	 */
	protected function init() {

		require_once(PATH_tslib.'class.tslib_content.php');
		require_once(PATH_t3lib.'class.t3lib_page.php');
		require_once(t3lib_extMgm::extPath('realurl').'class.tx_realurl.php');
		tslib_eidtools::connectDB();
		$this->realurl = t3lib_div::makeInstance('tx_realurl');
		$GLOBALS['TSFE']->sys_page = t3lib_div::makeInstance('t3lib_pageSelect');
		$GLOBALS['TSFE']->tmpl = t3lib_div::makeInstance('t3lib_TStemplate');
		$GLOBALS['TSFE']->config['config']['tx_realurl_enable'] = 1;
		$this->cObj = t3lib_div::makeInstance('tslib_cObj');
	}

	/**
	 * @return string
	 */
	public function main() {
		$this->init();

			// Collect all Get / Postparameters
		$requestVars = t3lib_div::_GP('faechersammlungen');
		$searchParam = filter_var($requestVars['suche'], FILTER_SANITIZE_STRING);
		$language = filter_var($requestVars['language'], FILTER_SANITIZE_NUMBER_INT);

		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
			't.tag, f.titel, u.titel AS fachtitel, f.uid, f.seite',
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
				$resultString .= $this->wrapResultWith('<a href="' . $this->getUrl($result['seite']) . '">' . $result['fachtitel'] .'</a>', 'li');
					array_push($fachtitel, $result['fachtitel']);
			}
			if (!in_array($result['titel'], $faechertitel)) {
				$titelString = $this->wrapResultWith($result['titel'], 'li');
				$resultString .= $this->wrapResultWith($titelString, 'ul');
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
		$hlText = str_replace($search, '<span class="highlight">'.$search.'</span>', $hlText);
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
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'pages', 'uid = '.(int)$pid);
		$pagerow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
		$conf['LD'] = $GLOBALS['TSFE']->tmpl->linkData($pagerow, '', 0, 'index.php', '', t3lib_div::implodeArrayForUrl('',$params));
		$this->realurl->encodeSpURL($conf, $this);
		$url = $conf['LD']['totalURL'];
		return $url;
	}

}

$eID = t3lib_div::makeInstance('tx_subtabs_faecherSammlungen');
$content = $eID->main();
echo $content;

?>