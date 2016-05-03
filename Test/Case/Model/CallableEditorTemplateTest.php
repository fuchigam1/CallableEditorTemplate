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

	/**
	 * 正常系
	 */
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

	/**
	 * 異常系
	 */
	public function testValidateNotEmpty()
	{
		$this->CallableEditorTemplate->create(array(
			'CallableEditorTemplate' => array(
				'model'		 => '',
				'model_id'	 => '',
			)
		));
		$this->assertFalse($this->CallableEditorTemplate->validates());

		$expected = array(
			'model' => array('モデル名を入力してください。'),
		);
		$this->assertEquals($expected, $this->CallableEditorTemplate->validationErrors);
	}

	/**
	 * 異常系
	 */
	public function testValidateMaxLength()
	{
		$this->CallableEditorTemplate->create(array(
			'CallableEditorTemplate' => array(
				'model'		 => 'ああああああああああいいいいいいいいいいううううううううううええええええええええおおおおおおおおおお'
				. 'ああああああああああいいいいいいいいいいううううううううううええええええええええおおおおおおおおおお'
				. 'ああああああああああいいいいいいいいいいううううううううううええええええええええおおおおおおおおおお'
				. 'ああああああああああいいいいいいいいいいううううううううううええええええええええおおおおおおおおおお'
				. 'ああああああああああいいいいいいいいいいううううううううううええええええええええおおおおおおおおおお'
				. 'ああああああ',
				'model_id'	 => '',
			)
		));
		$this->assertFalse($this->CallableEditorTemplate->validates());

		$expected = array(
			'model' => array('モデル名は255文字以内で入力してください。'),
		);
		$this->assertEquals($expected, $this->CallableEditorTemplate->validationErrors);
	}

	/**
	 * 正常系
	 */
	public function testGetDefaultValue()
	{
		$result		 = $this->CallableEditorTemplate->getDefaultValue();
		$expected	 = array(
			'CallableEditorTemplate' => array(
				'display_before' => false,
			),
		);
		$this->assertEquals($expected, $result, '初期値が正しくありません。');
	}

}
