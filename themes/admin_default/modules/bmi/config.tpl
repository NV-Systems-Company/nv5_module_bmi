<!-- BEGIN: main -->
<div id="users">
	<form action="{FORM_ACTION}" method="post">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<colgroup>
					<col style="width: 260px" />
					<col/>
				</colgroup>
				<tfoot>
					<tr>
						<td colspan="2"><input type="submit" name="submit" value="{LANG.save}" class="btn btn-primary" /></td>
					</tr>
				</tfoot>
				<tbody>
					<tr>
						<td>{LANG.config_titlesite}</td>
						<td><input class="w350 form-control pull-left" type="text" name="titlesite" value="{DATA.titlesite}" style="margin-right: 5px"/></td>
					<tr>
					<tr>
						<td>{LANG.config_description}</td>
						<td>
							<textarea class="w350 form-control" name="description">{DATA.description}</textarea>
						</td>
					<tr>
					<tr>
						<td>{LANG.config_og_image}</td>
						<td><input class="w350 form-control pull-left" type="text" name="og_image" id="image" value="{DATA.og_image}" style="margin-right: 5px"/><input type="button" value="Browse server" name="selectimage" class="btn btn-info"/></td>
					<tr>
					<tr>
						<td>{LANG.config_bodytext}</td>
						<td>
							{DATA.bodytext}
						</td>
					<tr>
				</tbody>
			</table>
		</div>
	</form>
</div>
<script>
	var CFG = [];
	CFG.upload_current = '{UPLOAD_CURRENT}';
	CFG.upload_path = '{UPLOAD_CURRENT}';
</script>
<!-- END: main -->