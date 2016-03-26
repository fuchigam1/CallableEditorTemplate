<?php
/**
 * [View] CallableEditorTemplate
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
$callableEditorTemplateData = Hash::get($this->request->data, 'CallableEditorTemplateData');
// 表示用サンプルコード
// エディタテンプレート名: Hash::get($callableEditorTemplateData, 'EditorTemplate.name')
// エディタテンプレート説明文: Hash::get($callableEditorTemplateData, 'EditorTemplate.description')
// エディタテンプレート内容: Hash::get($callableEditorTemplateData, 'EditorTemplate.html')
// エディタテンプレート用画像: $this->BcUpload->uploadImage('EditorTemplate.image', Hash::get($callableEditorTemplateData, 'EditorTemplate.image'), array('link' => false))
?>
<div id="CallableEditorTemplateContentBox">
	<?php echo Hash::get($callableEditorTemplateData, 'EditorTemplate.html') ?>
</div>
