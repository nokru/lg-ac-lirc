# lg-ac-lirc
Decode/Encode IR-Signals from LG Air Condition Remote ( AKB73315611 )

##Why?
Wanted the automate my LG AC a bit, using a RPI and IR-Emitter/-Receivers and LIRC - unfortunately there was no template for the remote present - so i tried to reverse engineer it a bit :)

##Contents
encoded_values.txt is a file with the encoded binary signals 
raw folder contains all the readings from the IR receiver bundled per mode-fan operation
scripts folder contains all php files I used to decypher the IR-signals and the write it back

###encoded_values.txt
contains the encoded values (raw->binary) for ON/OFF, SWING ON/OFF, AC LOW,MED,HIGH,CHAOS 18-30, AI L,M,H,C 18-30, HEAT L,M,H,C 16-30, DEHUM L,M,H,C - if you find something missing, tell me - but that's basically all the functions I use - feel free to contribute

###scripts/config.php
a few "static" vars and settings - might need a bit of tuning depending on your IR - easiest way to do it, open mode2 -d /dev/lirc0 -m and write down the values - you should get a list like 400-500, 1450-1550 and two single values like 4000 and 8000 - define what's the average for every value, define a offset and you are fine :)

###scripts/analyze.php
Use: php analyze.php FILENAME
Feed it a Raw-File created by using mode2 -d /dev/lirc0 -m - examples are in the RAW folder - also multiple button presses are treated accordingly - just use a meaningful sequence ;)

###scripts/decode.php
Use: php decode.php INPUTFILE OUTPUTFILE
uses an INPUTFILE with a list similar to encoded_values which has to has the format KEY_NAME;BINARY and creates a config OUTPUTFILE with these keys in it


##Links
http://alexba.in/blog/2013/01/06/setting-up-lirc-on-the-raspberrypi/ - Alex has everything about RPi, Lirc including wiring, config etc - used his basic setup
http://www.instructables.com/id/Reverse-engineering-of-an-Air-Conditioning-control/?ALLSTEPS - Used mats basic suggestions about understanding the IR-code etc

If you want to improve something - let me know - usually i don't bite
