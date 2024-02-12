
<?php

require "./../connection.php";
require('./fpdf/fpdf.php');

class PDF extends FPDF
{
  function header()
  {
    $this->SetFont('Arial', 'B', 12);
    $this->Cell(0, 10, 'Report User Score', 0, 1, 'C');

    $this->SetFont('Arial', 'B', 10);
    $this->SetX(55);
    $this->Cell(10, 10, 'No.', 1);
    $this->Cell(60, 10, 'Name', 1);
    $this->Cell(30, 10, 'Score', 1);
    $this->Ln();
  }
}

$pdf = new PDF();
$pdf->AddPage();


function getScore($accountId)
{
  global $connect;

  $courseId = $_GET["id"];
  $answersUser = mysqli_query(
    $connect,
    "SELECT * FROM answers 
    INNER JOIN questions ON questions.id = answers.question_id
    WHERE answers.course_id=$courseId AND account_id=$accountId 
    "
  );

  $score = 0;
  foreach ($answersUser as $answerUser) {
    if ($answerUser["user_answer"] == $answerUser["answer"]) {
      $score++;
    }
  }

  return $score;
}

$users = mysqli_query($connect, "SELECT * FROM accounts");

$pdf->SetFont('Arial', '', 10);
foreach ($users as $index => $user) {
  $pdf->SetX(55);
  $pdf->Cell(10, 10, $index + 1, 1);
  $pdf->Cell(60, 10, $user["name"], 1);
  $pdf->Cell(30, 10, getScore($user["id"]), 1);
  $pdf->Ln();
}

$pdf->Output('userScore.pdf', 'D');
