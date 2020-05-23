grep "CHAP authentication success" aa.txt | cut -d" " -f2-3 >> Reconnections.txt
grep "Packet - Source:" aa.txt | cut -d":" -f4 | cut -d" " -f1 | cut -d"," -f1 | sort -u >> Attacks.txt

