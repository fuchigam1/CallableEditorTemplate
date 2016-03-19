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
?>
<div id="CallableEditorTemplateContentBox">
	<h3><?php echo Hash::get($callableEditorTemplateData, 'EditorTemplate.name') ?></h3>
	<?php echo $this->BcUpload->uploadImage('EditorTemplate.image', Hash::get($callableEditorTemplateData, 'EditorTemplate.image'), array('link' => false)) ?>
	<?php echo Hash::get($callableEditorTemplateData, 'EditorTemplate.html') ?>
</div>
