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
defined('_JEXEC') or die('Restricted access');   
JHTML::_('behavior.tooltip');
JHTML::_('behavior.modal');

$user = JFactory::getUser();
$userId = $user->get('id');

$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');

$canOrder = true; 
$saveOrder = $listOrder == 'a.ordering';
?>
<form action="<?php echo JRoute::_('index.php?option=com_giza&view=pyramids'); ?>" method="post" name="adminForm" id="adminForm">
<div class="clr"> </div>
<table class="adminlist">
	 <thead>
		<tr>
                <th width="1%">
                    <input type="checkbox" name="checkall-toggle" value="" onclick="Joomla.checkAll(this)" />
                </th>
                <th width="3%">
                    <?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
                </th>
                								
                <th width="1%">
                    <?php echo JHtml::_('grid.sort', 'JPUBLISHED', 'a.published', $listDirn, $listOrder); ?>
                </th>
                <th width="1%">
                    <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ORDERING', 'a.ordering', $listDirn, $listOrder); ?>
                    <?php if ($canOrder && $saveOrder) : ?>
                        <?php echo JHtml::_('grid.order', $this->items, 'filesave.png', 'items.saveorder'); ?>
                    <?php endif; ?>
                </th>
                <th width="1%">
                    <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                </th>
            </tr>
	 </thead>
	 <tfoot>
            <tr>
                <td colspan="10">
                     <?php echo $this->pagination->getListFooter(); ?>
                </td>
            </tr>
     </tfoot>
	 <tbody>
		<?php
                    $n = count($this->items);
                    foreach ($this->items as $i => $pyramid) :
                        $ordering = ($listOrder == 'a.ordering');
                        $canCreate = true;
                        $canEdit = true;
                        $canCheckin = true;
                        $canEditOwn = true;
                        $canChange = true;
                        $pyramidID = $pyramid->id;                        
                        $title = $this->escape($pyramid->title);
        ?>
		<tr class="row<?php echo $i % 2; ?>">
		
			<td class="center">
                <?php echo JHtml::_('grid.id', $i, $pyramidID); ?>
            </td>
			<td style="width:1%; text-align:center">
                        <a href="<?php echo JRoute::_('index.php?option=com_giza&task=pyramid.edit&id='.(int) $pyramid->id); ?>"><?php echo $title ?></a>
                        <p class="smallsub">
                        <?php echo JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($pyramid->alias)); ?>
                        </p>
            </td>
			<td class="center">
                       <?php echo JHtml::_('jgrid.published', $pyramid->published, $i, 'pyramids.', true, 'cb'); ?>
            </td>
			<td class="order" style="text-align:center">
                        <?php if ($canChange) : ?>
                               <?php if ($saveOrder) : ?>
                                <?php if ($listDirn == 'asc') : ?>
                                    <span><?php echo $this->pagination->orderUpIcon($i, ($pyramid->ordering == @$this->items[$i - 1]->ordering), 'pyramids.orderup', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
                                    <span><?php echo $this->pagination->orderDownIcon($i, $n, ($pyramid->ordering == @$this->items[$i + 1]->ordering), 'pyramids.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
                                <?php elseif ($listDirn == 'desc') : ?>
                                    <span><?php echo $this->pagination->orderUpIcon($i, ($pyramid->ordering == @$this->items[$i - 1]->ordering), 'pyramids.orderdown', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
                                    <span><?php echo $this->pagination->orderDownIcon($i, $n, ($pyramid->ordering == @$this->items[$i + 1]->ordering), 'pyramids.orderup', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
                                <?php endif; ?>
                        <?php endif; ?>
                            <?php $disabled = $saveOrder ? '' : 'disabled="disabled"'; ?>
                            <input  type="text" name="order[]" size="5" value="<?php echo $pyramid->ordering; ?>" <?php echo $disabled ?> class="text-area-order" />
                        <?php else : ?>
                            <?php echo $pyramid->ordering; ?>
                        <?php endif; ?>
            </td>
			<td align="center">
                        <?php echo $pyramid->id; ?>
            </td>
		
		</tr>
		 <?php endforeach; ?>
	 </tbody>
</table>

    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
        <?php echo JHtml::_('form.token'); ?>
    </div>

</form>


