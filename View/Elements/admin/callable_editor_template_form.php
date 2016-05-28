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

<script>
$(function(){
	$("#CallableEditorTemplatePreview").on('click', function() {
		changeEditorTemplate();
		getEditorTemplate();
		return false;
	});

	$("#CallableEditorTemplateEditorTemplateId").on('change', function() {
		changeEditorTemplate();
		return false;
	});

	function changeEditorTemplate() {
		if ($('#PreviewEditorTemplateBox').length) {
			$('#PreviewEditorTemplateBox').slideUp('fast');
			$('#PreviewEditorTemplateBox').remove();
		}
	}

	function getEditorTemplate() {
		var editorTemplateId = $('#CallableEditorTemplateEditorTemplateId').val();
		if (editorTemplateId) {
			$.ajax({
				url: $.baseUrl + '/<?php echo $this->request->params['prefix'] ?>/callable_editor_template/callable_editor_template_configs/ajax_preview_template',
				data: {'id':editorTemplateId},
				dataType: 'json',
				type: "POST",
				complete: function(){
				},
				success: function(result) {
					if ('EditorTemplate' in result) {
						var $editorTemplate = $("<div />", {id: "PreviewEditorTemplateBox", style: "display: none;"}).html(result.EditorTemplate.html);

						var linkHtml = '<div style="text-align: right;"><a href="/<?php echo $this->request->params['prefix'] ?>/editor_templates/edit/' + editorTemplateId + '">≫ エディテテンプレート編集</a></div>';
						$editorTemplate.append($(linkHtml));

						$('#CallableEditorTemplateTable').after($editorTemplate);
						$('#PreviewEditorTemplateBox').slideDown();
					}
				}
			});
		}
	}

});
</script>
<style>
	#CallableEditorTemplatePreview {
		cursor: pointer;
	}
</style>

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
			<small id="CallableEditorTemplatePreview">[プレビュー]</small>
			<?php if (Hash::get($callableEditorTemplateConfig, 'auto_display')): ?>
			<span style="white-space: nowrap;">
			<?php echo $this->BcForm->input('CallableEditorTemplate.display_before', array('type' => 'radio', 'options' => array(0 => 'コンテンツ下部に表示する', 1 => 'コンテンツ上部に表示する'))) ?>
			<?php echo $this->BcForm->error('CallableEditorTemplate.display_before') ?>
			</span>
			<?php endif ?>
		</td>
	</tr>
