<?php
/**
 * @package     JCCDev
 * @subpackage  Create.Table
 *
 * @copyright  	Copyright (C) 2014, Tilo-Lars Flasche. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;
JCCDevLoader::import("table", JCCDevCREATE);;

/**
 * Table Create Class
 *
 * @package     JCCDev
 * @subpackage  Create.Table
 */
class JCCDevCreateTableAdminFormSingular extends JCCDevCreateTable
{		
	/*
	 * Look for language keys in the template and add them
	 *
	 * @var	boolean
	 */
	protected $getLangKeys = true;

	/**
	 * The template file
	 *
	 * @var	string
	 */
	protected $templateFile = "admin.models.forms.singular.xml";

	protected function initialize()
	{
		$this->template->addPlaceHolders(
			array( 
				'fields' => $this->fields(),
				'relations' => $this->relations(),
			)
		);

		return parent::initialize();
	}
	
	private function fields()
	{
		$buffer = '';
		
		foreach ($this->fields as $field)
		{
			$lng = "COM_". strtoupper($this->component->name) ."_". strtoupper($this->table->name) ."_FIELD_" . strtoupper($field->name);
			
			$buffer .= "\n\t\t<field name=\"". $field->name ."\" label=\"". $lng ."_LABEL\" description=\"". $lng ."_DESC\"";
			$buffer .= "\n\t\t\ttype=\"". $field->type ."\"";
			
			if (!empty($field->maxlength))	$buffer .= "\n\t\t\tmaxlength=\"". $field->maxlength ."\"";
			if (!empty($field->default)) 	$buffer .= "\n\t\t\tdefault=\"". $field->default ."\"";
			if ($field->name == $this->fields[0]->name) $field->class = "input-xxlarge input-large-text";
			if (!empty($field->class)) 		$buffer .= "\n\t\t\tclass=\"". $field->class ."\"";
			if (!empty($field->rule)) 		$buffer .= "\n\t\t\tvalidate=\"". strtolower($field->rule) ."\"";
			if (!empty($field->params["filter"])) 	$buffer .= "\n\t\t\tfilter=\"". $field->params["filter"] ."\"";
			if (!empty($field->deactivated)) $buffer .= "\n\t\t\tdeactivated=\"true\"";
			if (!empty($field->readonly)) 	$buffer .= "\n\t\t\treadonly=\"true\"";
			if (!empty($field->required)) 	$buffer .= "\n\t\t\trequired=\"true\"";
			
			if (!empty($field->options))
			{
				$buffer .= "\n\t\t>";
				
				for ($i = 0; $i < count($field->options['keys']); $i++)
				{
					if (empty($field->options['keys'][$i])) continue;

					// Table translations
					$this->getLanguage()->addKeys(array(
						'FIELD_' . strtoupper($field->name) . '_OPTION_' . str_replace(" ", "_", strtoupper($field->options['keys'][$i])) 
							=> $field->options['values'][$i]
					), $this->table->name);

					$buffer .= "\n\t\t\t<option value=\"" . $field->options['keys'][$i] . "\">" . $lng . "_OPTION_" . str_replace(" ", "_", strtoupper($field->options['values'][$i])) . "</option>";
				}
				
				$buffer .= "\n\t\t</field>";
			}
			else
			{
				$buffer .= "\n\t\t/>";
			}
		}

		return $buffer;
	}
	
	private function relations()
	{
		$template = $this->loadSubtemplate("relation.xml");
		$buffer = '';
		
		if (isset($this->table->params["relations"]))
		{
			foreach ($this->table->params["relations"] as $relation)
			{
				$table = $this->getModel("Table")->getItem($relation);

				$template->addPlaceholders($this->getDefaultPlaceholders(), true);
				
				$template->addPlaceholders(array(
					"rel_name" => strtolower($table->singular)
				), true);
				
				$buffer .= $template->getBuffer();
			}
		}

		return $buffer;
	}
}