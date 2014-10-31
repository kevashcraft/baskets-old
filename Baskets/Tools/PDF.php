<?php
namespace Baskets\Tools;
require MY_ROOT . '/lib/fpdf/fpdf.php';
class PDF extends \FPDF
{

	private $type;

	function Header() {
		$this->Image(MY_ROOT.'/blo.png',70,5,80);
		$this->SetFont('Arial','B',15);
		$this->Ln(23);
		$this->Cell(75);
	}


	function Footer() {
		$this->SetY(-15);
		$this->SetFont('Arial','I',8);
		$this->Cell(0,3,'3676 Hogshead Road, Apopka FL, 32703',0,1,'C');
		$this->Cell(0,3,'Office 407-410-0160 Fax 407-703-3743',0,1,'C');
		$this->Cell(0,3,'CFCO57555',0,0,'C');
	}




}

