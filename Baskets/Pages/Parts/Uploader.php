<?php
namespace Baskets\Pages\Parts;
class Uploader
{

	public static function uploader()
	{
		\Baskets\Pages\Framework::page_header('Parts List | Baskets');
		?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Upload a Parts List</h1>
				</div>
				<p>
					<b>Be sure to follow the file guidelines!</b>
					<ul>
						<li>CSV Format</li>
						<li>Columns Lowercase & <u>match DB column names</u></li>
						<li>No extra fields<li>
					</ul>
				</p>
				<p>
					Select a file to upload or drag'n'drop<br>
					<form>
						<input type='file' id='partslistfile' name='partslist'>
					</form>
					<div id='infobox'>infobox</div>
				</p>
				<script>
					$('#partslistfile').change(function() {
						sendParts(this.files[0]);
					});

					$('.main-viewer').ondrop = function(e) {
						e.preventDefault();
						sendParts(e.dataTransfer.files[0]);
					};

					function sendParts(file) {
						data = new FormData($('form')[0]);
						console.log(data);
						$.ajax({
							type: 'post',
							url: '<?=MY_URL?>/?annyong=hello&purpose=uploadpartslist',
							data: data,
							contentType: false,
							processData: false,
							beforeSend: function() {
								$('#infobox').html('Uploading and adding parts. One moment...');
							},
							success: function(data, textStatus, jqXHR) {
									$('#infobox').html(data);
							},
							error: function(jqXHR, textStatus, errorThrown) {
								$('#infobox').html(textStatus + errorThrown);
							}
						});
					}



				</script>
			</div>
		</div>
		<?
	}


}
