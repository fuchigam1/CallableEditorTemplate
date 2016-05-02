<?php

/**
 * run all models callable_editor_template tests
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */

/**
 * @package CallableEditorTemplate.Test
 */
class CallableEditorTemplateAllModelTest extends CakeTestSuite
{

	/**
	 * Suite define the tests for this suite
	 *
	 * @return CakeTestSuite
	 */
	public static function suite()
	{
		$suite	 = new CakeTestSuite('All CallableEditorTemplate Model tests');
		$path	 = dirname(__FILE__) . DS;

		$suite->addTestDirectory($path . 'Model' . DS);
		//$suite->addTestDirectory($path . 'Model' . DS . 'Behavior' . DS);
		return $suite;
	}

}
