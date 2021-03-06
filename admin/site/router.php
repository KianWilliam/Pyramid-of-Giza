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
function GizaBuildRoute(&$query)
{
		$segments = array();
		
			$app		= JFactory::getApplication();
	        $menu		= $app->getMenu();
	        $params		= JComponentHelper::getParams('com_giza');
			$advanced	= $params->get('sef_advanced_link', 0);

			$menuItem = $menu->getActive();
            $mView	= (empty($menuItem->query['view'])) ? null : $menuItem->query['view'];
			$mId	= (empty($menuItem->query['title'])) ? null : $menuItem->query['title'];
			
			
	if (isset($query['view'])) {
		$view = $query['view'];	
        $segments[] = $query['view'];
		unset($query['view']);
	}
	
	if (isset($query['view']) && ($mView == $query['view']) and (isset($query['title'])) and ($mId == intval($query['title']))) {
		unset($query['view']);
		unset($query['title']);
		return $segments;
	}
		if (isset($view) and  $view == 'pyramid' ) {
			if ($mId != intval($query['title']) || $mView != $view) {
				if ($view == 'pyramid') {
				  if ($advanced) {
					list($tmp, $title) = explode(':', $query['title'], 2);
				  }
				   else {
					$title = $query['title'];
				  }

				$segments[] = $title;
			   }
			}
			unset($query['title']);
		
		}
//if ($query['layout'] == 'default') {
	//			unset($query['layout']);
	//}


	return $segments;


}
function GizaParseRoute($segments)
{
		$vars = array();
		
			$app	= JFactory::getApplication();
	        $menu	= $app->getMenu();
	        $item	= $menu->getActive();
	        $params = JComponentHelper::getParams('com_giza');
			
		    $count = count($segments);
			
		if (!isset($item)) {
		$vars['view']	= $segments[0];
		$vars['id']		= $segments[$count - 1];
		return $vars;
	   }
	   
		$id = (isset($item->query['title']) && $item->query['title'] >= 1) ? $item->query['title'] : 'root';
		$vars['id'] = $id;
		$vars['view']='pyramid';
		return $vars;

}
