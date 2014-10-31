<?php
require 'lib/fpdf/fpdf.php';
class PDF extends FPDF
{
	const DPI = 96;
	const MM_IN_INCH = 25.4;
	const A4_HEIGHT = 297;
	const A4_WIDTH = 210;
	// tweak these values (in pixels)
	const MAX_WIDTH = 800;
	const MAX_HEIGHT = 500;

	function Header() {
		$this->Image('blo.png',70,5,80);
		$this->SetFont('Arial','B',15);
		$this->Ln(23);
		$this->Cell(75);
		$this->Cell(50,10,'Standard Proposal',1,0,'C');
		$this->Ln(20);
	}


	function Footer() {
		$this->SetY(-15);
		$this->SetFont('Arial','I',8);
		$this->Cell(0,3,'3676 Hogshead Road, Apopka FL, 32703',0,1,'C');
		$this->Cell(0,3,'Office 407-410-0160 Fax 407-703-3743',0,1,'C');
		$this->Cell(0,3,'CFCO57555',0,0,'C');
	}




}

	$pdf = new PDF();
	$pdf->AddPage();

	$pdf->SetFont('Times','B',12);
	$pdf->Cell(25,0,'Contractor',0,0);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,0,'Contractor',0,1);
	$pdf->Ln(7);

	$pdf->SetFont('Times','B',12);
	$pdf->Cell(25,0,'Model',0,0);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,0,'model',0,1);
	$pdf->Ln(7);

	$pdf->SetFont('Times','B',12);
	$pdf->Cell(25,0,'Date',0,0);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,0,'date',0,1);
	$pdf->Ln(15);


	$pdf->Cell(30,0,'Room',0,0);
	for($i=1;$i<=5;$i++) {
		$pdf->Cell(5,10,$i,0,0);
		$pdf->Cell(30,10,'Printing line number ');
		$pdf->Ln(7);
		$pdf->Cell(30);
	}
	$pdf->Ln(15);

	
	$pdf->Cell(30,0,'Room',0,0);
	for($i=1;$i<=5;$i++) {
		$pdf->Cell(5,10,$i,0,0);
		$pdf->Cell(30,10,'Printing line number ');
		$pdf->Ln(7);
		$pdf->Cell(30);
	}
	$pdf->Ln(15);

	$pdf->Cell(100,7,'Price for above with BF & PRV');
	$pdf->Cell(20,7,'$199999',0,1);
	$pdf->Ln(2);
	$pdf->Cell(20);
	$pdf->Cell(40,7,'30% Roughin');
	$pdf->Cell(20,7,'$199999',0,1);
	$pdf->Cell(20);
	$pdf->Cell(40,7,'30% Tub Set');
	$pdf->Cell(20,7,'$199999',0,1);
	$pdf->Cell(20);
	$pdf->Cell(40,7,'40% Trim');
	$pdf->Cell(20,7,'$199999',0,1);
	$pdf->Cell(20);





	$pdf->Output();

	$nepdf = new PDF();
	$nepdf->AddPage();

	$nepdf->SetFont('Times','B',12);
	$nepdf->Cell(25,0,'Contractor',0,0);
	$nepdf->SetFont('Times','',12);
	$nepdf->Cell(0,0,'Contractor',0,1);
	$nepdf->Ln(7);

	$nepdf->SetFont('Times','B',12);
	$nepdf->Cell(25,0,'Model',0,0);
	$nepdf->SetFont('Times','',12);
	$nepdf->Cell(0,0,'model',0,1);
	$nepdf->Ln(7);

	$nepdf->SetFont('Times','B',12);
	$nepdf->Cell(25,0,'Date',0,0);
	$nepdf->SetFont('Times','',12);
	$nepdf->Cell(0,0,'date',0,1);
	$nepdf->Ln(15);


	$nepdf->Cell(30,0,'Room',0,0);
	for($i=1;$i<=5;$i++) {
		$nepdf->Cell(5,10,$i,0,0);
		$nepdf->Cell(30,10,'Printing line number ');
		$nepdf->Ln(7);
		$nepdf->Cell(30);
	}
	$nepdf->Ln(15);

	
	$nepdf->Cell(30,0,'Room',0,0);
	for($i=1;$i<=5;$i++) {
		$nepdf->Cell(5,10,$i,0,0);
		$nepdf->Cell(30,10,'Printing line number ');
		$nepdf->Ln(7);
		$nepdf->Cell(30);
	}
	$nepdf->Ln(15);

	$nepdf->Cell(100,7,'Price for above with BF & PRV');
	$nepdf->Cell(20,7,'$199999',0,1);
	$nepdf->Ln(2);
	$nepdf->Cell(20);
	$nepdf->Cell(40,7,'30% Roughin');
	$nepdf->Cell(20,7,'$199999',0,1);
	$nepdf->Cell(20);
	$nepdf->Cell(40,7,'30% Tub Set');
	$nepdf->Cell(20,7,'$199999',0,1);
	$nepdf->Cell(20);
	$nepdf->Cell(40,7,'40% Trim');
	$nepdf->Cell(20,7,'$199999',0,1);
	$nepdf->Cell(20);





	$nepdf->Output();
