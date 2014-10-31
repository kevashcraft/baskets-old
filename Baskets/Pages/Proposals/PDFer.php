<?php
namespace Baskets\Pages\Proposals;
class PDFer
{
	private static $mypdf;
	private static $prop;

	public static function pdfer() {

		$propid = \Baskets\Tools\Tracker::$uri[3];
		if($propid == 0) exit ('what proposal did you want?');

		$stm = \Baskets::$db->prepare("SELECT proposals.*,contractors.contractor FROM proposals,contractors WHERE proposals.id=? AND contractors.id=proposals.contratorid LIMIT 1");
		$stm->execute(array($propid));
		self::$prop = $stm->fetch();

		$stm = \Baskets::$db->prepare("SELECT * FROM propoptions WHERE propid=?");
		$stm->execute(array($propid));
		$opts = [];
		while($opt = $stm->fetch()) {
			array_push($opts,$opt);
		}
		self::$opts = $opts;

		self::$mypdf = new \Baskets\Tools\PDF();
		$first = true;
		foreach($opts as $to) {
			if($first) {
				self::print_option($to,'Standard Proposal');
				$first = false;
			} else {
				self::print_option($to);
			}
		}
		
		
	}	

	public static function print_option($opt, $ot = false) {
		self::$mypdf->AddPage();
		$tit = $ot ? $opt['optionName'] : $ot;
		self::$mypdf->Cell(50,10,$tit,1,0,'C');
		self::$mypdf->Ln(20);
		self::info_box();
		$mtote = self::print_rooms($opt['id']);
		self::print_totes($mtote);
	}

	private static function info_box($font = 'Times') {
		self::$mypdf->SetFont($font,'B',12);
		self::$mypdf->Cell(25,0,'Contractor',0,0);
		self::$mypdf->SetFont($font,'',12);
		self::$mypdf->Cell(0,0,self::$prop['contractor'],0,1);
		self::$mypdf->Ln(7);
		self::$mypdf->SetFont($font,'B',12);
		self::$mypdf->Cell(25,0,'Model',0,0);
		self::$mypdf->SetFont($font,'',12);
		self::$mypdf->Cell(0,0,self::$prop['model'],0,1);
		self::$mypdf->Ln(7);
		self::$mypdf->SetFont($font,'B',12);
		self::$mypdf->Cell(25,0,'Date',0,0);
		self::$mypdf->SetFont($font,'',12);
		self::$mypdf->Cell(0,0,date('Y-m-d'),0,1);
		self::$mypdf->Ln(15);
	}	

	private static function print_rooms($optID) {
		$ptote = 0;
		$mystm = \Baskets::$db->prepare("SELECT propparts.*,parts.partdesc FROM propparts,parts WHERE propparts.optid=? AND parts.id=propparts.partid");
		$mystm->execute(array($optID));
		$part = $mystm->fetch();
		while($part['room'] != '') {
			$myroom = $part['room'];
			self::$mypdf->Cell(30,0,$myroom,0,0);
			while($part['room'] == $myroom) {
				self::$mypdf->Cell(5,10,$part['qty'],0,0);
				self::$mypdf->Cell(30,10,$part['partdesc']);
				self::$mypdf->Ln(7);
				self::$mypdf->Cell(30);
				$part = $mystm->fetch();
				$ptote += intval($part['qty']) * intval($part['listprice']);
			}
			self::$mypdf->Ln(15);
		}
		return $ptote;
	}

	private static function print_totes($tote) {
		$total = '$'.$tote;
		$thirtyP = '$' . $tote * .3;
		$fourtyP = '$' . $tote * .4;

		self::$mypdf->Cell(100,7,'Price for above with BF & PRV');
		self::$mypdf->Cell(20,7,$total,0,1);
		self::$mypdf->Ln(2);
		self::$mypdf->Cell(20);
		self::$mypdf->Cell(40,7,'30% Roughin');
		self::$mypdf->Cell(20,7,$thirtyP,0,1);
		self::$mypdf->Cell(20);
		self::$mypdf->Cell(40,7,'30% Tub Set');
		self::$mypdf->Cell(20,7,$thirtyP,0,1);
		self::$mypdf->Cell(20);
		self::$mypdf->Cell(40,7,'40% Trim');
		self::$mypdf->Cell(20,7,$fourtyP,0,1);
		self::$mypdf->Cell(20);
	}

}
