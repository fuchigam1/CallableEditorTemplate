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


	$(".preview-editor-template-box").colorbox({maxWidth:"90%", maxHeight:"90%", inline:true});

	function changeEditorTemplate() {
		if ($('#PreviewEditorTemplateBox').length) {
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

						<?php if (CallableEditorTemplateUtil::hasAablePermission($user['user_group_id'], Router::url(array('controller' => 'editor_templates', 'action' => 'edit')))): ?>
						// エディタテンプレの編集リンクを追加する
						var linkHtml = '<div style="text-align: right;"><br /><a href="/<?php echo $this->request->params['prefix'] ?>/editor_templates/edit/' + editorTemplateId + '">≫ エディターテンプレート編集</a></div>';
						$editorTemplate.append($(linkHtml));
						<?php endif ?>

						// ポップアップ用としてラッピングする
						$editorTemplate.wrapInner('<div id="preview-editor-template-box-inline">');
						$('#CallableEditorTemplateTable').after($editorTemplate);
						// ポップアップイベントを発生させる
						$(".preview-editor-template-box").trigger("click");
					}
				},
				error: function(xhr, textStatus, errorThrown){
					var errorMessage = '<div id="CloseAlertError"><strong>[✕閉じる]</strong></div>';
					errorMessage = errorMessage + '<span style="color: #C00;">プレビュー動作用のアクセス権限が許可されていません。</span><br>';
					errorMessage = errorMessage + 'このユーザーが所属するユーザーグループのアクセス権限に、以下のURLを「アクセス可」として追加してください。<br>';
					errorMessage = errorMessage + '■ ルール名の例「記事別エディターテンプレート呼出プレビュー権限」<br>';
					errorMessage = errorMessage + '<strong>callable_editor_template/callable_editor_template_configs/ajax_preview_template</strong>';
					
					var $editorTemplate = $("<div />", {id: "PreviewEditorTemplateBox", style: "display: none;"}).html(errorMessage);
					$('#CallableEditorTemplateTable').after($editorTemplate);
					$('#PreviewEditorTemplateBox').slideDown('slow');

					$('#CloseAlertError').on('click', function() {
						$('#PreviewEditorTemplateBox').slideUp();
					});
				}
			});
		}
	}

});
</script>
<style>
	#CallableEditorTemplatePreview,
	#CloseAlertError {
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
			<small style="display: none;"><a class="preview-editor-template-box" href="#preview-editor-template-box-inline">[プレビューボックス表示トリガー用リンク]</a></small>
			<?php if (Hash::get($callableEditorTemplateConfig, 'auto_display')): ?>
			<span style="white-space: nowrap;">
			<?php echo $this->BcForm->input('CallableEditorTemplate.display_before', array('type' => 'radio', 'options' => array(0 => 'コンテンツ下部に表示する', 1 => 'コンテンツ上部に表示する'))) ?>
			<?php echo $this->BcForm->error('CallableEditorTemplate.display_before') ?>
			</span>
			<?php endif ?>
		</td>
	</tr>
