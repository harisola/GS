<?php
	$html = "";


	$url = base_url();
	$url = substr($url, 0, strlen($url)-3);




	$html .= '<style>
		.unit_report_pdf_iframe {
			position: relative;
			padding-bottom: 65.25%;
			padding-top: 30px;
			height: 0;
			overflow: auto; 
			-webkit-overflow-scrolling:touch; //<<--- THIS IS THE KEY 
			border: solid black 1px;
			} 
			.unit_report_pdf_iframe iframe {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 90%;
		}
		</style>';


	$html .= '
	<div class="unit_report_pdf_iframe">
		<iframe src="'.$url.'reports/tpa_Confirmation_where.php?data='.$this->GradeSection.'" frameborder="0">
		</iframe>
	</div>';




	echo $html;
?>

