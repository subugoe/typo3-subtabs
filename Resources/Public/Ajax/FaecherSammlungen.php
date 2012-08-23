<?php

	// Connect to TYPO3 Ddatabase
$db = tslib_eidtools::connectDB();

	// Collect all Get / Postparameters
$requestVars = t3lib_div::_GP('faechersammlungen');
$searchParam = $requestVars['suche'];
$language = $requestVars['lang'];

$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
	't.tag, f.titel, u.titel AS fachtitel',
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
		$resultString .= wrapResultWith($result['fachtitel'], 'li');
			array_push($fachtitel, $result['fachtitel']);
	}
	if (!in_array($result['titel'], $faechertitel)) {
		$titelString = wrapResultWith($result['titel'], 'li');
		$resultString .= wrapResultWith($titelString, 'ul');
			array_push($faechertitel, $result['titel']);
	}
	$resultString .= highlight($result['tag'], $searchParam) . ', ';

}
$resultString = wrapResultWith($resultString, 'ul');

echo $resultString;

/**
 * @param $hlText
 * @param $search
 * @return string
 */
function highlight($hlText, $search) {
	return str_ireplace($search, '<span class="highlight">'.$search.'</span>', $hlText);
}

/**
 * @param $result
 * @param $with
 * @return string
 */
function wrapResultWith($result, $with) {

	return '<' . $with . '>' . $result . '</' . $with . '>';
}

?>

