<?php

/**
 * run all callable_editor_template tests
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */

/**
 * @package CallableEditorTemplate.Test.Case
 */
class CallableEditorTemplateAllTest extends CakeTestSuite
{

	/**
	 * Suite define the tests for this suite
	 *
	 * @return CakeTestSuite
	 */
	public static function suite()
	{
		$suite	 = new CakeTestSuite('CallableEditorTemplate Plugin All Tests');
		$path	 = dirname(__FILE__) . DS;

		$suite->addTestFile($path . 'CallableEditorTemplateAllModelTest.php');
		return $suite;
	}

}
