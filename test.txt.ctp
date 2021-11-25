$ORIGIN alireza.com.
$TTL 3600
@ NS ns1.nameserver.com.
@ NS ns2.nameserver.com.
info TXT "This is some additional \"information\""
sub.domain A 192.168.1.42
ipv6.domain AAAA ::1
@ MX 10 mail-gw1.example.net.
@ MX 20 mail-gw2.example.net.
@ MX 30 mail-gw3.example.net.
mail IN TXT "THIS IS SOME TEXT; WITH A SEMICOLON"