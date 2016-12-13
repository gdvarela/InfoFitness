<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../dompdf/autoload.inc.php");
require_once(__DIR__."/../controller/BaseController.php");
use Dompdf\Dompdf;
class PDFController extends BaseController {

  public function __construct()
  {
    parent::__construct();
  }

  public function downloadPDF(){

    $dompdf = new Dompdf();
    $dompdf->load_html($_POST["table"]);
    $dompdf->render();
    $pdf = $dompdf->output();
    $filename = "ejemplo".time().'.pdf';
    file_put_contents($filename, $pdf);
    $dompdf->stream($filename);
  }

}
?>
