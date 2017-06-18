<?php
/**
 * @package     JCCDev
 * @subpackage  Controllers
 *
 * @copyright  	Copyright (C) 2014, Tilo-Lars Flasche. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

/**
 * JCCDev Formfield Controller
 *
 * @package     JCCDev
 * @subpackage  Controllers
 */
class JCCDevControllerFormfield extends JControllerForm
{
	/**
	 * Method to run batch operations.
	 *
	 * @param   object  $model  The model.
	 *
	 * @return  boolean   True if successful, false otherwise and internal error is set.
	 *
	 * @since   2.5
	 */
	public function batch($model = null)
	{
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Set the model
		$model = $this->getModel('Formfield', 'JCCDevModel');

		// Preset the redirect
		$this->setRedirect(JRoute::_('index.php?option=com_jccdev&view=formfields', false));

		return parent::batch($model);
	}
}