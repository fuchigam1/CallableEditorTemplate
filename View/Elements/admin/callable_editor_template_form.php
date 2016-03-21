<?php
/**
 * [ADMIN] CallableEditorTemplate
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
$labelName = Hash::get($callableEditorTemplateConfig, 'title');
if (!$labelName) {
	$labelName = Configure::read('CallableEditorTemplate.label_name');
}
?>
</table>
<?php echo $this->BcForm->hidden('CallableEditorTemplate.id') ?>
<?php echo $this->BcForm->hidden('CallableEditorTemplate.model') ?>
<?php echo $this->BcForm->hidden('CallableEditorTemplate.model_id') ?>
<table cellpadding="0" cellspacing="0" class="form-table section" id="CallableEditorTemplateTable">
	<tr>
		<th>
			<?php echo $this->BcForm->label('CallableEditorTemplate.editor_template_id', $labelName) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('CallableEditorTemplate.editor_template_id', array(
				'type' => 'select', 'options' => $editorTemplateList, 'empty' => '表示しない',
			)) ?>
			<?php echo $this->BcForm->error('CallableEditorTemplate.editor_template_id') ?>
			<?php echo $this->BcForm->input('CallableEditorTemplate.display_before', array('type' => 'checkbox', 'label' => 'コンテンツ上部に表示する')) ?>
			<?php echo $this->BcForm->error('CallableEditorTemplate.display_before') ?>
		</td>
	</tr>

