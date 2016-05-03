<?php

/**
 * CallableEditorTemplateConfigTest file
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
App::uses('CallableEditorTemplateConfig', 'CallableEditorTemplate.Model');

/**
 * CallableEditorTemplateConfigTest class
 * 
 * @package CallableEditorTemplate.Test
 */
class CallableEditorTemplateConfigTest extends BaserTestCase
{

	public $fixtures = array(
		'plugin.callable_editor_template.Default/CallableEditorTemplateConfig',
	);

	public function setUp()
	{
		$this->CallableEditorTemplateConfig = ClassRegistry::init('CallableEditorTemplate.CallableEditorTemplateConfig');
		parent::setUp();
	}

	public function tearDown()
	{
		unset($this->CallableEditorTemplateConfig);
		parent::tearDown();
	}

	public function test正常チェック()
	{
		$this->CallableEditorTemplateConfig->create(array(
			'CallableEditorTemplateConfig' => array(
				'model'		 => 'Page',
				'content_id' => 2,
				'title'		 => 'エディターテンプレート',
				'status'	 => true,
			),
		));

		$this->assertTrue($this->CallableEditorTemplateConfig->validates());
		$this->assertEmpty($this->CallableEditorTemplateConfig->validationErrors);
	}

}
