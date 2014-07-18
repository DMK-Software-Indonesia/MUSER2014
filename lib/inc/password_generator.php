<?php
function GeneratePwd()
{
   $length=12;
   $retval='';
   $valids= "abcdefghijklmnopqrstuxyvwz0123456789ABCDEFGHIJKLMNOPQRSTUXYVWZ";
   $jumlahIndex=strlen($valids);
   for($i=1;$i<=$length;$i++)
   {
      $indexnya=  mt_rand(0, $jumlahIndex-1);
      $retval .=  $valids[$indexnya];
   }
   return $retval;
}
?>
