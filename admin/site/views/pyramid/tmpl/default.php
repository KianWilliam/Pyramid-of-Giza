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
JHtml::_('jquery.framework');
$document = JFactory::getDocument();
  $document->addStyleSheet(JURI::Base()."components/com_giza/assets/css/giza.css");

if($this->item->params->get('lib')==1)
{
   $document->addScript(JURI::Base()."components/com_giza/assets/js/jquery.js");
}
  $document->addScript(JURI::Base()."components/com_giza/assets/js/giza.js");
  $noConflict = "var gz = jQuery.noConflict()";
  $document->addScriptDeclaration($noConflict);
  
   $items = json_decode(str_replace("|qq|", "\"", $this->item->params->get('slides')));
   foreach($items as $i=>$item)
   { 
	
		$images[] = JURI::base().$item->imgname;	
		$texts[]=$item->imgtext;
	
   }
  $mygiza = "
	gz(document).ready(function(){
		gz('#giza').pharoa.config({width:'".$this->item->params->get('pyramid_width')."',  color:'".$this->item->params->get('background_color')."',  timer:'".$this->item->params->get('pyramid_speed')."', opacity:'".$this->item->params->get('pyramid_dim_opacity')."'});
	});
	gz.fn.pharoa.defaults = {};
	gz.fn.pharoa.defaults.images = [];
	gz.fn.pharoa.defaults.descs= [];
	gz.fn.pharoa.defaults.width=250;
	gz.fn.pharoa.defaults.color='#eb1bcd';
	gz.fn.pharoa.defaults.timer=10000;
	gz.fn.pharoa.defaults.opacity=0.7;

	var myimages = ".json_encode($images).";
	var mydescs = ".json_encode($texts).";
	for(var g=0; g<myimages.length; g++)
	{
	    gz.fn.pharoa.defaults.images[g] = myimages[g];	
		gz.fn.pharoa.defaults.descs[g] = mydescs[g];	
	}
	
  ";
  $document->addScriptDeclaration($mygiza);
  



?>

<div class="mpyramid<?php echo $this->pageclass_sfx?>">

	<div class="mpyramid<?php echo $this->pageclass_sfx?>">
         		 
	     <?php if ($this->item->title) : ?>
		    <h2>
			     <span class="pyramid-name"><?php echo $this->item->title; ?></span>
		    </h2>
	     <?php endif;  ?>
		 <div id="giza" class="pyramid<?php echo $this->pageclass_sfx?>">
		 </div>

		 
	</div>

</div>