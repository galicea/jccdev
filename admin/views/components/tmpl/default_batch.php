<?php
/**
 * @package     JCCDev
 * @subpackage  Views
 *
 * @copyright  	Copyright (C) 2014, Tilo-Lars Flasche. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

$form = JForm::getInstance('component_batch', 'component_batch', array('control' => 'batch'));
?>
<div class="modal hide fade" id="collapseModal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&#215;</button>
		<h3><?php echo JText::_('COM_JCCDEV_BATCH_OPTIONS');?></h3>
	</div>
	<div class="modal-body">
		<p><?php echo JText::_('COM_JCCDEV_BATCH_TIP'); ?></p>
		<div class="control-group">
			<div class="control-label"><?php echo $form->getLabel('site'); ?></div>
			<div class="controls"><?php echo $form->getInput('site'); ?></div>
		</div>
		<br><br>
		<br><br>
	</div>
	<div class="modal-footer">
		<button class="btn" type="button" onclick="document.id('batch_site').value='';" data-dismiss="modal">
			<?php echo JText::_('JCANCEL'); ?>
		</button>
		<button class="btn btn-primary" type="submit" onclick="Joomla.submitbutton('component.batch');">
			<?php echo JText::_('JGLOBAL_BATCH_PROCESS'); ?>
		</button>
	</div>
</div>
