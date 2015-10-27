<?php

define("LOWVAL",520);
define("HIGHVAL",1530);
define("INTRO",4130);
define("SEPERATE",8900);
define("WIDTH",125);
define("MULTI",3);

define("LOWCHAR","0");
define("HIGHCHAR","1");
define("INTROCHAR","I-");
define("SEPERATECHAR","S-");

define("TEMPLATE","

# created by nokru
# https://github.com/nokru/lg-ac-lirc

begin remote

  name LG_AC
  flags RAW_CODES|CONST_LENGTH
  eps 30
  aeps 100

  gap 513079

      begin raw_codes

$CODES$

      end raw_codes

end remote");

?>