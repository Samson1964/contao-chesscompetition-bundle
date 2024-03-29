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
 * Table tl_chesscompetition
 */
$GLOBALS['TL_DCA']['tl_chesscompetition'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_chesscompetition_matches'),
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id'    => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('toDate DESC'),
			'flag'                    => 1,
			'panelLayout'             => 'sort,filter;search,limit',
		),
		'label' => array
		(
			'fields'                  => array('toDate', 'title', 'place', 'country', 'complete'),
			'showColumns'             => true,
			'format'                  => '%s %s %s %s %s',
			'label_callback'          => array('tl_chesscompetition', 'listTournaments')
		),
		'global_operations' => array
		(
			'players' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesscompetition']['players'],
				'href'                => 'table=tl_chesscompetition_players',
				'icon'                => 'bundles/contaochesscompetition/images/players.png',
			),  
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
				'href'                => 'table=tl_chesscompetition_matches',
				'icon'                => 'edit.gif'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesscompetition']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'button_callback'     => array('tl_chesscompetition', 'editHeader')
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesscompetition']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif',
				'button_callback'     => array('tl_chesscompetition', 'copyArchive')
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesscompetition']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
				'button_callback'     => array('tl_chesscompetition', 'deleteArchive')
			),
			'toggle' => array
			(
				'label'                => &$GLOBALS['TL_LANG']['tl_chesscompetition']['toggle'],
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
				'label'               => &$GLOBALS['TL_LANG']['tl_chesscompetition']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{title_legend},title,type;{place_legend},place,country;{date_legend},fromDate,toDate;{info_legend:hide},info,source;{options_legend:hide},singleSRC,url;{publish_legend},complete,published'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true, 
				'maxlength'           => 255,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'place' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition']['place'],
			'exclude'                 => true,
			'search'                  => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false, 
				'maxlength'           => 255,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'country' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition']['country'],
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
		'type' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition']['type'],
			'exclude'                 => true,
			'filter'                  => true,
			'default'                 => '',
			'inputType'               => 'select',
			'options'                 => $GLOBALS['TL_LANG']['tl_chesscompetition']['typen'], 
			'eval'                    => array
			(
				'includeBlankOption'  => true,
				'mandatory'           => false,
				'doNotCopy'           => false,
				'tl_class'            => 'w50',
			),
			'sql'                     => "char(2) NOT NULL default ''"
		),  
		'fromDate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition']['fromDate'],
			'default'                 => date('Ymd'),
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true, 
				'maxlength'           => 10,
				'tl_class'            => 'w50',
				'rgxp'                => 'alnum'
			),
			'load_callback'           => array
			(
				array('tl_chesscompetition', 'getDate')
			),
			'save_callback' => array
			(
				array('tl_chesscompetition', 'putDate')
			),
			'sql'                     => "int(8) unsigned NOT NULL default '0'"
		), 
		'toDate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition']['toDate'],
			'default'                 => date('Ymd'),
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 2,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'maxlength'           => 10,
				'tl_class'            => 'w50',
				'rgxp'                => 'alnum'
			),
			'load_callback'           => array
			(
				array('tl_chesscompetition', 'getDate')
			),
			'save_callback' => array
			(
				array('tl_chesscompetition', 'putDate')
			),
			'sql'                     => "int(8) unsigned NOT NULL default '0'"
		),  
		'info' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition']['info'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE', 'helpwizard'=>true, 'tl_class'=>'clr'),
			'explanation'             => 'insertTags',
			'sql'                     => "mediumtext NULL"
		),  
		'source' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition']['source'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'long'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		), 
		'singleSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition']['singleSRC'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('filesOnly'=>true, 'fieldType'=>'radio', 'tl_class'=>'clr'),
			'sql'                     => "binary(16) NULL",
		),  
		'url' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition']['url'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'fieldType'=>'radio', 'tl_class'=>'clr w50 wizard'),
			'wizard' => array
			(
				array('tl_chesscompetition', 'pagePicker')
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		), 
		'complete' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition']['complete'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'default'                 => false,
			'inputType'               => 'checkbox',
			'sql'                     => "char(1) NOT NULL default ''"
		),  
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesscompetition']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'default'                 => true,
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
 * Class tl_chesscompetition
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2014
 * @author     Leo Feyer <https://contao.org>
 * @package    News
 */
class tl_chesscompetition extends Backend
{

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
		return ($this->User->isAdmin || count(preg_grep('/^tl_chesscompetition::/', $this->User->alexf)) > 0) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}


	/**
	 * Return the copy archive button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function copyArchive($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin || $this->User->hasAccess('create', 'newp')) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}


	/**
	 * Return the delete archive button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function deleteArchive($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin || $this->User->hasAccess('delete', 'newp')) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
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

	/**
	 * Listenansicht manipulieren
	 * @param array
	 * @param string
	 * @param \DataContainer
	 * @param array
	 * @return string
	 */
	public function listTournaments($row, $label, DataContainer $dc, $args)
	{
		$args[0] = $this->getDate($args[0]);
		$args[1] = '<b>'.$args[1].'</b>';
		$args[4] = $row['complete'] ? $this->generateImage('ok.gif', 'Wettbewerb komplett') : $this->generateImage('delete.gif', 'Wettbewerb nicht komplett');
		return $args;
	}

}