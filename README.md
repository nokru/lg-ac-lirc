# lg-ac-lirc
Decode/Encode IR-Signals from LG Air Condition Remote ( AKB73315611 )

Wanted the automate my LG AC a bit, using a RPI and IR-Emitter/-Receivers and LIRC - unfortunately there was no template for the remote present - so i tried to reverse engineer it a bit :)

raw contains all the readings from the IR receiver bundled per mode-fan operation

encoded_values.txt contains the encoded values (raw->binary) i created using the analyze.php script (quick hack from a few recycled php snippets - yeah i know, it's ugly) - use it with "php ananlyse.php FILENAME" to convert your raw data to encoded binary data - you might have to tune the LOW/HIGH settings a bit

If you want to improve something - let me know - usually i don't bite
