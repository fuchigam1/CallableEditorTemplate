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

	/**
	 * 正常系
	 */
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

	/**
	 * 異常系
	 */
	public function testValidateNotEmpty()
	{
		$this->CallableEditorTemplateConfig->create(array(
			'CallableEditorTemplateConfig' => array(
				'model'		 => '',
				'content_id' => '',
				'title'		 => '',
				'status'	 => '',
			)
		));
		$this->assertFalse($this->CallableEditorTemplateConfig->validates());

		$expected = array(
			'model' => array('モデル名を入力してください。'),
		);
		$this->assertEquals($expected, $this->CallableEditorTemplateConfig->validationErrors);
	}

	/**
	 * 異常系
	 */
	public function testValidateMaxLength()
	{
		$this->CallableEditorTemplateConfig->create(array(
			'CallableEditorTemplateConfig' => array(
				'model'		 => 'ああああああああああいいいいいいいいいいううううううううううええええええええええおおおおおおおおおお'
				. 'ああああああああああいいいいいいいいいいううううううううううええええええええええおおおおおおおおおお'
				. 'ああああああああああいいいいいいいいいいううううううううううええええええええええおおおおおおおおおお'
				. 'ああああああああああいいいいいいいいいいううううううううううええええええええええおおおおおおおおおお'
				. 'ああああああああああいいいいいいいいいいううううううううううええええええええええおおおおおおおおおお'
				. 'ああああああ',
				'content_id' => '',
				'title'		 => '',
				'status'	 => '',
			)
		));
		$this->assertFalse($this->CallableEditorTemplateConfig->validates());

		$expected = array(
			'model' => array('モデル名は255文字以内で入力してください。'),
		);
		$this->assertEquals($expected, $this->CallableEditorTemplateConfig->validationErrors);
	}

	/**
	 * 正常系
	 */
	public function testGetDefaultValue()
	{
		$result		 = $this->CallableEditorTemplateConfig->getDefaultValue();
		$expected	 = array(
			'CallableEditorTemplateConfig' => array(
				'status' => false,
				'title'	 => Configure::read('CallableEditorTemplate.label_name'),
			),
		);
		$this->assertEquals($expected, $result, '初期値が正しくありません。');
	}

}
