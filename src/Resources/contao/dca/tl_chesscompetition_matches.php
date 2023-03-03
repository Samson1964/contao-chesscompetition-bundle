<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package News
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Table tl_chesscompetition_matches
 */
$GLOBALS['TL_DCA']['tl_chesscompetition_matches'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_chesscompetition',
		'ctable'                      => 'tl_chesscompetition_games',
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index',
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'disableGrouping'         => true,
			'headerFields'            => array('title', 'fromDate', 'toDate', 'place', 'country'),
			'panelLayout'             => 'filter;sort,search,limit',
			'child_record_callback'   => array('tl_chesscompetition_matches', 'listMatches'),
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesscompetition']['edit'],
				'href'                => 'table=tl_chesscompetition_games',
				'icon'                => 'edit.gif'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesscompetition']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'button_callback'     => array('tl_chesscompetition_matches', 'editHeader')
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'toggle' => array
			(
				'label'                => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['toggle'],
				'attributes'           => 'onclick="Backend.getScrollOffset()"',
				'haste_ajax_operation' => array
				(
					'field'            => 'published',
					'options'          => array
					(
						array('value' => '', 'icon' => 'invisible.svg'),
						array('value' => '1', 'icon' => 'visible.svg'),
					),
				),
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{type_legend},type;{team_legend},germanTeam,germanCountry,opponentTeam,opponentCountry,home;{results_legend:hide},resultGerman,resultOpponent,info,source;{round_legend},round,pairing,eventDate,eventTime;{place_legend:hide},place;{referee_legend:hide},referee;{publish_legend},complete,published'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'foreignKey'              => 'tl_chesscompetition.title',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'belongsTo', 'load'=>'eager')
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'type' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['type'],
			'exclude'                 => true,
			'search'                  => false,
			'sorting'                 => false,
			'inputType'               => 'select',
			'options_callback'        => array('tl_chesscompetition_matches', 'getTypes'),
			'eval'                    => array
			(
				'includeBlankOption'  => true,
				'mandatory'           => false,
				'maxlength'           => 5,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(5) NOT NULL default ''"
		),
		'germanTeam' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['germanTeam'],
			'exclude'                 => true,
			'default'                 => 'Deutschland',
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true,
				'chosen'              => true,
				'maxlength'           => 255,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'germanCountry' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['germanCountry'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'select',
			'options'                 => System::getCountries(),
			'eval'                    => array
			(
				'includeBlankOption'  => true,
				'chosen'              => true,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(2) NOT NULL default ''"
		),
		'opponentTeam' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['opponentTeam'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true,
				'chosen'              => true,
				'maxlength'           => 255,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'opponentCountry' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['opponentCountry'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'select',
			'options'                 => System::getCountries(),
			'eval'                    => array
			(
				'includeBlankOption'  => true,
				'chosen'              => true,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(2) NOT NULL default ''"
		),
		'home' => array
		(
			'label'                 => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['home'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'default'                 => 1,
			'inputType'               => 'checkbox',
			'eval'                    => array
			(
				'doNotCopy'           => true,
				'tl_class'            => 'w50'
			),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'resultGerman' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['resultGerman'],
			'exclude'                 => true,
			'search'                  => false,
			'sorting'                 => false,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 10,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'resultOpponent' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['resultOpponent'],
			'exclude'                 => true,
			'search'                  => false,
			'sorting'                 => false,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 10,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'info' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['info'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE', 'helpwizard'=>true, 'tl_class'=>'clr'),
			'explanation'             => 'insertTags',
			'sql'                     => "mediumtext NULL"
		),
		'source' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['source'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'long'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'round' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['round'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'rgxp'                => 'digit',
				'tl_class'            => 'w50 clr',
				'mandatory'           => false,
				'maxlength'           => 2
			),
			'sql'                     => "smallint(2) unsigned NOT NULL default '0'"
		),
		'pairing' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['pairing'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'rgxp'                => 'digit',
				'tl_class'            => 'w50',
				'mandatory'           => false,
				'maxlength'           => 2
			),
			'sql'                     => "smallint(2) unsigned NOT NULL default '0'"
		),
		'eventDate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['eventDate'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'maxlength'           => 10,
				'tl_class'            => 'w50',
				'rgxp'                => 'alnum'
			),
			'load_callback'           => array
			(
				array('tl_chesscompetition_matches', 'getDate')
			),
			'save_callback' => array
			(
				array('tl_chesscompetition_matches', 'putDate')
			),
			'sql'                     => "int(8) unsigned NOT NULL default '0'"
		),
		'eventTime' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['eventTime'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'rgxp'                => 'time',
				'mandatory'           => false,
				'doNotCopy'           => false,
				'tl_class'            => 'w50'
			),
			'sql'                     => "int(10) unsigned NULL"
		),
		'place' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['place'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 255
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'referee' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['referee'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 255
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'complete' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['complete'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'default'                 => false,
			'inputType'               => 'checkbox',
			'sql'                     => "char(1) NOT NULL default ''"
		),
		// Paarung veröffentlicht
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition_matches']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'default'                 => 1,
			'inputType'               => 'checkbox',
			'eval'                    => array
			(
				'doNotCopy'           => true
			),
			'sql'                     => "char(1) NOT NULL default ''"
		),
	)
);


/**
 * Class tl_chesscompetition_matches
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2014
 * @author     Leo Feyer <https://contao.org>
 * @package    News
 */
class tl_chesscompetition_matches extends Backend
{

	var $nummer = 0;

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	/**
	 * Return the edit header button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function editHeader($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin || count(preg_grep('/^tl_chesscompetition_matches::/', $this->User->alexf)) > 0) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}


	/**
	 * Return the link picker wizard
	 * @param \DataContainer
	 * @return string
	 */
	public function pagePicker(DataContainer $dc)
	{
		return ' <a href="contao/page.php?do=' . Input::get('do') . '&amp;table=' . $dc->table . '&amp;field=' . $dc->field . '&amp;value=' . str_replace(array('{{link_url::', '}}'), '', $dc->value) . '" title="' . specialchars($GLOBALS['TL_LANG']['MSC']['pagepicker']) . '" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':765,\'title\':\'' . specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['MOD']['page'][0])) . '\',\'url\':this.href,\'id\':\'' . $dc->field . '\',\'tag\':\'ctrl_'. $dc->field . ((Input::get('act') == 'editAll') ? '_' . $dc->id : '') . '\',\'self\':this});return false">' . Image::getHtml('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top;cursor:pointer"') . '</a>';
	}

	public function listMatches($arrRow)
	{
		$temp = '<div class="tl_content_left">';
		$temp .= $arrRow['complete'] ? $this->generateImage('ok.gif', 'Länderkampf komplett') : $this->generateImage('delete.gif', 'Länderkampf nicht komplett');
		$temp .= ' <b>['.$arrRow['round'].']</b> <i>'.$this->getDate($arrRow['eventDate']).'</i>';
		// Mannschaftsnamen bauen
		($arrRow['home']) ? $temp .= ' <b>' . $arrRow['germanTeam'] : $temp .= ' <b>' . $arrRow['opponentTeam'];
		($arrRow['home']) ? $temp .= ' - ' . $arrRow['opponentTeam'].'</b>' : $temp .= ' - ' . $arrRow['germanTeam'].'</b>';
		// Ergebnis bauen
		($arrRow['home']) ? $temp .= ' ' . $arrRow['resultGerman'] : $temp .= ' ' . $arrRow['resultOpponent'];
		($arrRow['home']) ? $temp .= ':' . $arrRow['resultOpponent'] : $temp .= ':' . $arrRow['resultGerman'];
		return $temp.'</div>';
	}

	/**
	 * Datumswert aus Datenbank umwandeln
	 * @param mixed
	 * @return mixed
	 */
	public function getDate($varValue)
	{
		$laenge = strlen($varValue);
		$temp = '';
		switch($laenge)
		{
			case 8: // JJJJMMTT
				$temp = substr($varValue,6,2).'.'.substr($varValue,4,2).'.'.substr($varValue,0,4);
				break;
			case 6: // JJJJMM
				$temp = substr($varValue,4,2).'.'.substr($varValue,0,4);
				break;
			case 4: // JJJJ
				$temp = $varValue;
				break;
			default: // anderer Wert
				$temp = '';
		}

		return $temp;
	}

	/**
	 * Datumswert für Datenbank umwandeln
	 * @param mixed
	 * @return mixed
	 */
	public function putDate($varValue)
	{
		$laenge = strlen(trim($varValue));
		$temp = '';
		switch($laenge)
		{
			case 10: // TT.MM.JJJJ
				$temp = substr($varValue,6,4).substr($varValue,3,2).substr($varValue,0,2);
				break;
			case 7: // MM.JJJJ
				$temp = substr($varValue,3,4).substr($varValue,0,2);
				break;
			case 4: // JJJJ
				$temp = $varValue;
				break;
			default: // anderer Wert
				$temp = 0;
		}

		return $temp;
	}

	public function getTypes(DataContainer $dc)
	{
		$arrForms = array
		(
			'M'    => 'A-Länderkampf Männer',
			'F'    => 'A-Länderkampf Frauen',
			'M-B'  => 'B-Länderkampf Männer',
			'F-B'  => 'B-Länderkampf Frauen',
			'J'    => 'Jugend-Länderkampf',
		);
		return $arrForms;
	}

}
