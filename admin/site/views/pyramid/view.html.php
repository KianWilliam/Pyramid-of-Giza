<?php
/**
 * @package component giza for Joomla! 3.x
 * @version $Id: com_giza 1.0.0 2016-07-20 23:26:33Z $
 * @author Kian William Nowrouzian
 * @copyright (C) 2015- Kian William Nowrouzian
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of giza.
    giza is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    giza is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with giza.  If not, see <http://www.gnu.org/licenses/>.
 
**/ 
 ?>


<?php 
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
class GizaViewPyramid extends JViewLegacy
{
	protected $state;
	protected $item;
	function display($tpl = null)
	{
		$app		= JFactory::getApplication();
		$item		= $this->get('Item');
		$params		= $app->getParams();
		// or $params = JComponentHelper::getParams('com_giza'); 
		$state		= $this->get('State');		
		
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));
		$this->assignRef('params',		$params);
		$this->assignRef('item', 		$item);
		$this->assignRef('state', 		$state);
		
			
			$this->_prepareDocument();
			
		parent::display($tpl);

	}
	protected function _prepareDocument()
	{
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu();
		$title 		= null;
		$menu = $menus->getActive();
		
		if ($menu) {
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		}
		else {
			$this->params->def('page_heading', JText::_('COM_GIZA_DEFAULT_PAGE_TITLE'));
		}
		
		$title = $this->params->get('page_title', '');
		
		if (empty($title)) {
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}
		if (empty($title)) {
			$title = $this->item->title;
		}
		$this->document->setTitle($title);



	}
}