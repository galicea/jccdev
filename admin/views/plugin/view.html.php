<?php
/**
 * @package     JCCDev
 * @subpackage  Views
 *
 * @copyright  	Copyright (C) 2014, Tilo-Lars Flasche. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

/**
 * JCCDev Plugin View
 *
 * @package     JCCDev
 * @subpackage  Views
 */
class JCCDevViewPlugin extends JViewLegacy
{
	protected $item;
	protected $form;
	protected $state;
	
	public function display($tpl = null)
	{
		//-- Hauptmenü sperren
		$input = JFactory::getApplication()->input;
		$this->_layout == "edit" ? $input->set('hidemainmenu', true) : null;
		
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		$this->state = $this->get('State');
				
		if ($this->_layout == "default")
		{
			$model = JModelLegacy::getInstance("Overrides", "JCCDevModel");
			$this->overrides = $model->getOverrides("plugin", $this->item->id);
			
			$model = JModelLegacy::getInstance("Plugins", "JCCDevModel");
			$this->items = $model->getItems();
		}
				
		$this->sidebar = JLayoutHelper::render("sidebar", array("active" => "plugins"), JCCDevLAYOUTS);
		$this->addToolbar();
		parent::display($tpl);
	}
	
	protected function addToolbar()
	{
		if ($this->_layout == "default")
		{
			JToolBarHelper::title(JText::_('COM_JCCDEV_PLUGIN'));
		}
		else
		{
			JToolBarHelper::title(JText::_('COM_JCCDEV_PLUGIN'));
			JToolBarHelper::apply('plugin.apply');
			JToolBarHelper::save('plugin.save');
			JToolBarHelper::save2copy('plugin.save2copy');
			JToolBarHelper::save2new('plugin.save2new');
			JToolBarHelper::cancel('plugin.cancel', 'JTOOLBAR_CANCEL');
		}
	}
}