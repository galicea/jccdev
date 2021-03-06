<?php
/**
 * @package     JCCDev
 * @subpackage  Views
 *
 * @copyright  	Copyright (C) 2014, Tilo-Lars Flasche. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$saveOrder = ($listOrder == 'ordering');
?>

		<?php foreach ($this->items as $i => $item) : ?>
			<tr>
        <td class="order nowrap center hidden-phone"><?php echo JHtml::_("jdgrid.ordering", $saveOrder, $item->ordering); ?></td>
				<td class="center"><?php echo JHtml::_('grid.id', $i, $item->id); ?></td>
				<td>
					<?php 
						$link = JRoute::_('index.php?option=com_jccdev&view=plugin&id=' . $item->id);						
						echo '<a href="' . $link . '">' . $this->escape($item->name) . '</a><br>';
					?>
				</td>
				<td><?php echo $this->escape($item->folder); ?></td>
        <td><?php echo JHtml::_("jdgrid.archives", "plg_", $item->name); ?></td>
				<td>
				<?php if (empty( $item->installed)) : ?>
					<i class="icon-unpublish"></i>
				<?php else : ?>
					<a href="<?php echo JURI::base(); ?>index.php?option=com_plugins&view=plugins&filter[search]=<?php echo $item->display_name; ?>">Go To</a>
				<?php endif; ?>
				</td>
        <td><?php echo JHtml::_("jdgrid.published", $item->enabled); ?></td>
				<td><?php echo $this->escape($item->version); ?></td>
        <td><?php echo JHtml::_("jdgrid.author", $item->created_by, $item->author_name); ?></td>
				<td><?php echo $this->escape($item->id); ?></td>
			</tr>
		<?php endforeach ?>