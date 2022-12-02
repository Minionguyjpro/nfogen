<html><head><title>NFO Generator</title><meta http-equiv="content-type" content="text/html; charset=windows-1251" /> </head><body>
<pre>
<?php
$error123=0;

$description = strip_tags($description);
$support = strip_tags($support);
$torrentname = strip_tags($torrentname);
$torrentsize = strip_tags($torrentsize);
$team = strip_tags($team);

if ($support=="") {
$error123=1;
echo "You must fill in the release support name!<br>";
}
if ($torrentname=="") {
$error123=1;
echo "You have to fill in the torrent name!<br>";
}
if ($torrentsize=="") {
$error123=1;
echo "You have to fill in release size!<br>";
}

if ($team=="") {
$error123=1;
echo "You have to fill in the team name!<br>";
}
if ($error123==1) {
echo "<input type=\"button\" value=\"Go Back\" onClick=\"self.history.back();\">";
} else {

// Variables go here
$width = 72;
$blank = " ";
$support = "Support: " . $support;
//$team = "Team Software&Books";
// Function Line  writes a filled line

function line($width) {
$value = "#";
for ($i=1; $i<$width; $i++) {
$value = $value . "=";
}
$value = $value . "#\n";
return $value;
}

// Function textline writes a line with text

function textline ($text, $width) {

$space = ($width-strlen($text));
$space2 = ($space/2);
settype($space2, "integer");
$head = $space2;
$foot = ($space-$head) + 1;

$value =  "#";
for ($i=1; $i<$head; $i++) {
$value = $value . " ";
}
$value = $value . $text;
for ($i=1; $i<$foot; $i++) {
$value = $value . " ";
}
$value = $value . "#\n";
return $value;
}

function desctextline ($text, $width, $head) {
$space = ($width-strlen($text));

$foot = ($space-$head) + 1;

$value = "#";
for ($i=1; $i<$head; $i++) {
$value = $value . " ";
}
$value = $value . $text;
for ($i=1; $i<$foot; $i++) {
$value = $value . " ";
}
$value = $value . "#\n";
return $value;
}

//Function newblock prints some stuff between different blocks of information

function newblock () {

// Top base of the column
for ($i=1; $i<15; $i++) {
$value = $value . " "; }

$value = $value . "\\###/";

for ($i=1; $i<15; $i++) {
$value = $value . " "; }

$value = $value . "\\###/";

for ($i=1; $i<15; $i++) {
$value = $value . " "; }

$value = $value . "\\###/";
$value = $value . "\n";
// End of top base

// Repeated writing of columns
for ($m=1; $m<4; $m++) {

for ($i=1; $i<15; $i++) {
$value = $value . " "; }
$value = $value . " ### ";

for ($i=1; $i<15; $i++) {
$value = $value . " "; }
$value = $value . " ### ";

for ($i=1; $i<15; $i++) {
$value = $value . " "; }
$value = $value . " ### ";
$value = $value . "\n";
}

// Base of column
for ($i=1; $i<15; $i++) {
$value = $value . " "; }

$value = $value . "/###\\";

for ($i=1; $i<15; $i++) {
$value = $value . " "; }

$value = $value . "/###\\";
for ($i=1; $i<15; $i++) {
$value = $value . " "; }

$value = $value . "/###\\";
$value = $value . "\n";
return $value;
// End of base
}
// End of column

// Writes the description 
function description ($width, $text) {

//$text = htmlentities($text);
$text =  trim($text, "\n");

$text = wordwrap($text, 50, $break = "\n", $cut = null);

$lines = split ("\n", $text);
$numelements = count($lines);

for ($idx=0; $idx < $numelements; ++$idx) {


//$lastletter = substr ($lines[$idx], -1);

//if ($lastletter="\n") {
//$safeline = substr($lines[$idx], 0, -1);
//} else { $safeline = $lines[$idx]; }
$safeline = $lines[$idx];
$safeline =  ereg_replace ("\n", " ", $safeline );
$safeline =  ereg_replace ("\r", " ", $safeline );
$safeline =  ereg_replace ("\t", " ", $safeline );
$safeline =  ereg_replace ("\x0B", " ", $safeline );

$value = $value . desctextline ("$safeline" ,$width, 10);

}
return $value;

}

function createnfo ($text) {
$current=time();
 $datafile = fopen("files/" . $current . ".nfo", "w+");
 fwrite($datafile, $text);
 fclose($datafile);
 $link = "<a href=\"files/" . $current . ".nfo\">Link to nfo</a>";
 return $link;
}

$nfotext="";
// Start of code

$nfotext = $nfotext . line($width);
$nfotext = $nfotext . textline ($blank ,$width);
$nfotext = $nfotext . textline ($team, $width);
$nfotext = $nfotext . textline (Presents, $width);
$nfotext = $nfotext . textline ($blank ,$width);
$nfotext = $nfotext . textline ((".:: " . $torrentname . " ::.") ,$width);
$nfotext = $nfotext . textline ($blank ,$width);
$nfotext = $nfotext . textline ($support ,$width);
$nfotext = $nfotext . textline ($blank ,$width);
$nfotext = $nfotext . line($width);
$nfotext = $nfotext . newblock();
$nfotext = $nfotext . line($width);
$nfotext = $nfotext . textline ($blank ,$width);
$nfotext = $nfotext . textline ($blank ,$width);
$nfotext = $nfotext . textline ((".:: " . $torrentname . " ::.") ,$width);
$nfotext = $nfotext . textline ($blank ,$width);
$nfotext = $nfotext . textline ($blank ,$width);
if ($torrenttracker) {
$nfotext = $nfotext . textline ("Size: $torrentsize   Leeched from: $torrenttracker",$width);
} else {
$nfotext = $nfotext . textline ("Size: $torrentsize",$width);
}
$nfotext = $nfotext . textline ($blank ,$width);
$nfotext = $nfotext . textline ($blank ,$width);
if ($torrentlink) {
$nfotext = $nfotext . textline ($torrentlink,$width);
$nfotext = $nfotext . textline ($blank ,$width);
$nfotext = $nfotext . textline ($blank ,$width);
}

$nfotext = $nfotext . description ($width, "$description ");
$nfotext = $nfotext . textline ($blank ,$width);
$nfotext = $nfotext . textline ($blank ,$width);
$nfotext = $nfotext . textline ($blank ,$width);
$nfotext = $nfotext . textline ($blank ,$width);

$nfotext = $nfotext . line($width);

echo (createnfo ($nfotext)) . "\n\n";
echo $nfotext;
}
?>

</pre>
</body></html>