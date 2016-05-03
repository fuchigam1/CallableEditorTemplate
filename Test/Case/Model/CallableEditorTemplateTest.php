<?php

/**
 * CallableEditorTemplateTest file
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
App::uses('CallableEditorTemplate', 'CallableEditorTemplate.Model');

/**
 * CallableEditorTemplateTest class
 * 
 * @package CallableEditorTemplate.Test
 */
class CallableEditorTemplateTest extends BaserTestCase
{

	public $fixtures = array(
		'plugin.callable_editor_template.Default/CallableEditorTemplate',
	);

	public function setUp()
	{
		$this->CallableEditorTemplate = ClassRegistry::init('CallableEditorTemplate.CallableEditorTemplate');
		parent::setUp();
	}

	public function tearDown()
	{
		unset($this->CallableEditorTemplate);
		parent::tearDown();
	}

	public function test正常チェック()
	{
		$this->CallableEditorTemplate->create(array(
			'CallableEditorTemplate' => array(
				'model'				 => 'Page',
				'model_id'			 => 2,
				'editor_template_id' => 2,
				'display_before'	 => false,
				'status'			 => true,
			),
		));

		$this->assertTrue($this->CallableEditorTemplate->validates());
		$this->assertEmpty($this->CallableEditorTemplate->validationErrors);
	}

}
