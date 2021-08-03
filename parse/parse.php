<?php 


include 'koneksi.php';
include 'config.php';

$getCLassData = new Config($konek_db);
$getData = $getCLassData->select_header();

// UNTUK PARSE HTML

$namafile1 = glob("/opt/lampp/htdocs/grobid/grobid-master/xml/xml1/*.xml");
$xmlfile =$namafile1[0];
$filexml ='xml/xml1/garuda1395700.tei.xml';

// echo $xmlfile;
// print_r($namafile1);

$xml = new SimpleXMLElement("$xmlfile", null, true) or die("can't load file");
$json = json_encode($xml);
$array = json_decode($json, true);

$namaauthor = $xml->teiHeader->fileDesc->sourceDesc->biblStruct->analytic->author;
$json1 = json_encode($namaauthor);

$title = $xml->teiHeader->fileDesc->sourceDesc->biblStruct->analytic->title;
$keyword = $xml->teiHeader->profileDesc->textClass->keywords->term;
$abstract = $xml->teiHeader->profileDesc->abstract->div->p;

$headSection1 = $xml->text->body->div;
$section1 = $xml->text->body->div;
$bibli = $xml->text->back->div->listBibl->biblStruct;
// $bibli = $xml->text->back->div->listBibl->biblStruct[0]->analytic;





// print_r($bibliTitle);
// echo $section1;
echo "$title\n";
// file_put_contents('outputjson1.json', $json);


foreach($namaauthor as $namedep){
    $nadep = $namedep->persName->forename;
    $nabel = $namedep->persName->surname;
    $email = $namedep->email;
    $afiliasi = $namedep->affiliation->orgName;
    $address = $namedep->affiliation->address->settlement;
    $country = $namedep->affiliation->address->country;

    echo "\n$nadep $nabel \n";
    
    echo "$email \n";
    // echo "$afiliasi \n";
    // echo "$address \n";
    // $insertData = $getCLassData->insertAuthorHeader(1, 113, "$nadep", "$nabel");
    $query = "INSERT INTO `author_header` (`author_header_id`, `author_id`, `author_firstname`, `author_lastname`, `email`) VALUES (13, 113, '{$nadep}', '{$nabel}', '{$email}')"; 
    $sql = mysqli_query($konek_db, $query);

    
    foreach ($afiliasi as $value) {
        // echo $value;
        // $value = $dataaf;
        # code...
        echo "$value\n";
    }
    // echo "==========================\n";
    // echo "===========END HEADER=============\n";

    // print_r($dataaf);
}

echo "Keyword : ";
$bd = '';
foreach($keyword as $bd) {
    echo "$bd";    
    $query1 = "INSERT INTO `header` (`header_id`, `author_id`, `abstract`, `keyword`) VALUES (13, 113, '{$abstract}', '{$bd}')";
    $sql = mysqli_query($konek_db, $query1);
}
echo "\n\nabstrack : $abstract\n";
echo "\n";

foreach($headSection1  as $hds){
    $head1 = $hds->head;
    $sc1 = $hds->p;
    echo  "\nHeader : $head1\nSection : $sc1 \n";
    // echo "Header : $head1";

    $query2 = "INSERT INTO `section` (`section_id`, `author_id`, `header`, `section`, `article_id`) VALUES (4, 113, '{$head1}', '{$sc1}', 3) ";
    $sql = mysqli_query($konek_db, $query2);

}
echo "\nBibliography : ";
foreach($bibli as $bl){
    $titless = $bl->analytic->title;
    $authorblnadep = $bl->analytic->author->persName->forename;
    $authorblnabel = $bl->analytic->author->persName->surname;
    $monogr = $bl->monogr->title;

    $imprint = $bl->monogr->imprint->date['@attributes']['when'];

    print_r($imprint);
    echo "\n$titless\n";
    echo "$authorblnadep $authorblnabel\n";
    echo "$monogr\n";


}



?>