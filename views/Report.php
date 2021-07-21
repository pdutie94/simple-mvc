<?php
if ( ! Login::isLoggedIn() ) {
	header( 'Location: ' . BASEURL );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Google Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">

	<!-- CSS Reset -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">

	<!-- Milligram CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">

	<title>Báo cáo</title>
	<style>
		.button.add-section-btn {
			margin-bottom: 1rem;
		}
	</style>
</head>
<body>
	<?php require 'layout/header.php'; ?>
	<main class="site-content wrapper" style="margin-top: 50px;">
		<div class="container">
			<div class="row">
				<div class="column">
					<h3>BÁO CÁO</h3>
					<?php
					$table     = ReportController::getTable();
					$report    = ReportController::getAllReport();
					$questions = array();
					if ( $table ) {
						$table_data = json_decode( $table['content'], true );
						if ( ! empty( $table_data ) ) {
							foreach ( $table_data['content'] as $sections ) {
								$sections_content = $sections['content'];
								foreach ( $sections_content as $content ) {
									if ( $content['level'] !== '0' ) {
										array_push( $questions, $content['content'] );
									}
								}
							}
						}
					}
					?>
					<a href="javascript:;" class="export-excel-btn button button-outline" onclick="exportExcel('xlsx')">Xuất File Excel</a>
					<?php if ( ! empty( $questions ) ) { ?>
						<div class="table-wrapper" style="overflow-x: auto">
							<table id="export-table" class="table-data">
								<thead>
									<tr>
										<td>Câu hỏi</td>
										<?php foreach ( $questions as $question ) { ?>
											<td><?php echo $question; ?></td>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach ( $report as $r_data ) { ?>
										<tr>
											<td><?php echo $r_data['fullname']; ?></td>
											<?php
											$answers = json_decode( $r_data['content'], true );
											foreach ( $answers as $answer ) {
												echo '<td>' . $answer . '</td>';
											}
											?>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					<?php } else { ?>
						<div class="message success">Chưa có dữ liệu</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</main>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
	<script>
		function exportExcel(type, fn, dl) {
			var elt = document.getElementById('export-table');
			var wb = XLSX.utils.table_to_book(elt);
			return dl ?
				XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
				XLSX.writeFile(wb, fn || ('bao-cao.' + (type || 'xlsx')));
		}
	</script>
</body>
</html>
