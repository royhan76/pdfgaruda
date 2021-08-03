<?php 

$xmlString ='<aaaa Version="1.0">
<bbb>
  <cccc>
    <dddd Id="id:pass" />
    <eeee name="hearaman" age="24" />
  </cccc>
</bbb>
</aaaa>'; 
$xml = new SimpleXMLElement($xmlString);
echo $xml->bbb->cccc->dddd['Id'];
echo $xml->bbb->cccc->eeee['name'];
// or...........
foreach ($xml->bbb->cccc as $element) {
  foreach($element as $key => $val) {
//    echo "\n{$key}: {$val}\n";
  }
}

?>