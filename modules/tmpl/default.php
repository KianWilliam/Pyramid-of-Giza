<?php 
/*
  @package component giza for Joomla! 3.x
  @version $Id: com_giza 1.0.0 2016-07-20 23:26:33Z $
  @author Kian William Nowrouzian
  @copyright (C) 2015- Kian William Nowrouzian
  @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
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
 
*/ 
?>

<?php 
defined('_JEXEC') or die;
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::base()."components/com_giza/assets/css/giza.css");

  if($itemmod->params->get('jQuery')==1)
  {
	  $document->addScript(JURI::base()."components/com_giza/assets/js/jquery.js");
  }
  $document->addScript(JURI::base()."components/com_giza/assets/js/giza.js");
$noConf = " var gzb = jQuery.noConflict(); ";
$document->addScriptDeclaration($noConf);
   $itemsmod = json_decode(str_replace("|qq|", "\"", $itemmod->params->get('slides')));
   foreach($itemsmod as $imod=>$itemm)
   {	
		$imagesmod[] = JURI::base().$itemm->imgname;	
		$textsmod[]=$itemm->imgtext;	
   }
   
   $modgiza = "	
		gzb(document).ready(function(){
		gzb('.pyramid').pharoa.config({width:'".$itemmod->params->get('pyramid_width')."',  color:'".$itemmod->params->get('background_color')."',  timer:'".$itemmod->params->get('pyramid_speed')."', opacity:'".$itemmod->params->get('pyramid_dim_opacity')."'});
	});
	gzb.fn.pharoa.defaults = {};
	gzb.fn.pharoa.defaults.images = [];
	gzb.fn.pharoa.defaults.descs= [];
	gzb.fn.pharoa.defaults.width=250;
	gzb.fn.pharoa.defaults.color='#eb1bcd';
	gzb.fn.pharoa.defaults.timer=10000;
	gzb.fn.pharoa.defaults.opacity=0.7;
	var mymimages = ".json_encode($imagesmod).";
	var mymdescs = ".json_encode($textsmod).";
	for(var g=0; g<mymimages.length; g++)
	{
	    gzb.fn.pharoa.defaults.images[g] = mymimages[g];	
		gzb.fn.pharoa.defaults.descs[g] = mymdescs[g];	
	}
	
   ";
   $document->addScriptDeclaration($modgiza);
   
 

?>
<div class="pyramid"></div>
