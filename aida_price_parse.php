<?
include 'simple_html_dom.php';

$url = "https://www.aida.de/kreuzfahrt/angebote-buchen/reisesuche.18736.html?screen=SearchBox&SearchButton=1&tx_aidadyncatalog_catalog%5BcruiseListPage%5D=1&tx_aidadyncatalog_catalog%5BpaxConfig%5D=0&tx_aidadyncatalog_catalog%5BsearchState%5D=&tx_aidadyncatalog_catalog%5Bregion_or_ship%5D=region&tx_aidadyncatalog_catalog%5BsearchRegionShipCode%5D=VRDU&tx_aidadyncatalog_catalog%5Bharbour_or_poc%5D=harbour&tx_aidadyncatalog_catalog%5BsearchPortCode%5D=*0&tx_aidadyncatalog_catalog%5BsearchStartDate%5D=&tx_aidadyncatalog_catalog%5BsearchEndDate%5D=&tx_aidadyncatalog_catalog%5BsearchEarlyBird%5D=*0&tx_aidadyncatalog_catalog%5BsearchPriceCode%5D=*0&tx_aidadyncatalog_catalog%5BsearchDurationCode%5D=*0&tx_aidadyncatalog_catalog%5BsearchSpecials%5D=*0&tx_aidadyncatalog_catalog%5BsearchTransportation%5D=Z&SearchButton=";
echo $url;
echo "<br>";
$string = substr($url, 0, 147).str_replace('5', '2',substr($url, 147));
echo $string;



$html = file_get_html ( $url );


echo "<pre>";
foreach ( $html->find ( 'a[class=pager-last]' ) as $element0 ) {
	$pnumall = $element0->{'data-page'};	
	$pgurl = $element0->href;

	$pnum = 1;
	while ($pnum<$pnumall) {
		echo "<pre>";
		$html0 = substr($url, 0, 147).str_replace('1', $pnum,substr($url, 147));

		$pgurl0 = file_get_html($html0);

		foreach ( $pgurl0->find ( 'article[class=result clearfix]' ) as $element ) {
			$item['tour'] = $element->find('.result-header a', 0)->plaintext;
			$item['date'] = $element->find('.traveldate', 0)->plaintext;		    
		    $item['ship']     = $element->find('div.result-ship', 0)->plaintext;
		    $item['cabin']     = $element->find('div.left div', 0)->plaintext;
		    $item['tariff']     = $element->find('div.left div', 1)->plaintext;
		    $item['price'] = $element->find('span.euro', 0)->plaintext;
		    $item['link'] = $element->find('.result-header a', 0)->href;

	    
		    $articles[] = $item;			

			print_r($articles);

		    flush ();

		}
		$pnum++;		 
	}


}
