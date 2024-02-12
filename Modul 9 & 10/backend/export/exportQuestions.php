
<?php

require "./../connection.php";
require('./fpdf/fpdf.php');

class PDF extends FPDF
{
  function chapterTitle($title)
  {
    $this->Ln();
    $this->SetFont('Arial', 'B', 12);
    $this->Cell(0, 10, $title, 0, 1, 'L');
  }

  function chapterBody($body)
  {
    $this->SetFont('Times', '', 12);
    $this->MultiCell(0, 10, $body);
  }
}

$id = $_GET["id"];
$questions = mysqli_query($connect, "SELECT * FROM questions WHERE course_id=$id ");

$pdf = new PDF();
$pdf->AddPage();


foreach ($questions as $index => $question) {
  $pdf->chapterTitle('Soal No.' . $index + 1 . ': ' . $question["question"]);
  $pdf->chapterBody('A. ' . $question["a"]);
  $pdf->chapterBody('B. ' . $question["b"]);
  $pdf->chapterBody('C. ' . $question["c"]);
  $pdf->chapterBody('D. ' . $question["d"]);
}

$pdf->Output('Questions.pdf', 'D');
?>
