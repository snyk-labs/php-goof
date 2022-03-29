<?php 

    require('func.php');
	use Dompdf\Dompdf;
	use Dompdf\Options;

    $filename = "export.pdf";

    $options = new Options();
    $options->setIsRemoteEnabled(true);

    $dompdf = new Dompdf($options);   

    $title = $_GET['title'];

	$html = "<!DOCTYPE html>
	<html>
	<head>
	<style>
	body {
	    display: block;
	    text-align: center;
	}
	</style>
	</head>
	<body>";

	$html .= "<h1>PHP-Goof demo app</h1>";

	$html .= "<p>".urldecode($_GET['title'])."</p>"; 

    if($font = $dompdf->getFontMetrics()->getFont("gotcha", "normal") or $font = $dompdf->getFontMetrics()->getFont("rshell", "normal")){  
        $html .= "<a href='http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/vendor/dompdf/dompdf/lib/fonts/".basename($font).".php'>Gotcha hack</a>"; 
    }

	$html .= "</body>";
	$html .= "</html>";

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A5', 'portrait');

    // lets us know if something goes wrong
    global $_dompdf_show_warnings;
    $_dompdf_show_warnings = true;

    // render the HTML as PDF
    $dompdf->render();

    // output the generated PDF to browser
    $dompdf->stream($filename, array('Attachment' => 0));

?>
