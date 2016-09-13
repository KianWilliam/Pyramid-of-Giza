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
	protected $form;
	protected $isNew = true;
	
	public function display($tpl = null)
	{
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');
		$this->isNew	= ($this->item->id == 0);
		
		if (count($errors = $this->get('Errors'))) {
			
			return false;
		}
		
		 $this->addToolbar();
		 parent::display($tpl);
		
	}
	
	protected function addToolbar()
	{
		
		$app = JFactory::getApplication();
		$input = $app->input;
		$input->set('hidemainmenu', true);

		$title = JText::_('COM_GIZA')." - ";
		if($this->isNew)
			$title .= '<small>[ ' . JText::_( 'COM_GIZA_NEW' ).' ]</small>'; 
		else 
			$title .= $this->item->title." <small>[".JText::_("COM_GIZA_EDIT_SETTINGS")."]</small>";
		
		JToolBarHelper::title($title   , 'generic.png' );
		if ($this->isNew){
			JToolBarHelper::apply('pyramid.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('pyramid.save', 'JTOOLBAR_SAVE');
			JToolBarHelper::custom('pyramid.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
			JToolBarHelper::cancel('pyramid.cancel', 'JTOOLBAR_CANCEL');
		}
		else {
			JToolBarHelper::apply('pyramid.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('pyramid.save', 'JTOOLBAR_SAVE');
			JToolBarHelper::custom('pyramid.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
			JToolBarHelper::cancel('pyramid.cancel', 'JTOOLBAR_CANCEL');
		}
	}
	
	
}


