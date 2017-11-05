#!/bin/bash

: '
   Program       : Bash file to split a GetText PO file into its constituents
   Author        : Ap.Muthu <apmuthu@usa.net>
   Version       : 1.0
   Release Date  : 2017-11-05

   Example Usage : sh sep_gettext.sh my_po_file.po
'

# Ref: https://tecadmin.net/how-to-extract-filename-extension-in-shell-script/
# Ref: https://stackoverflow.com/questions/25072891/sed-print-all-lines-before-the-nth-occurrence-of-a-string

# POFILE=ta_IN-2.4.2-1.po
# Modified to pass from CLI argument as needed
POFILE=$1

# Strip path and extract base name only
FILE=$(basename "$POFILE")

# Get the file name without extension
FILEONLY="${FILE%.*}"

# Get the extension only
EXTONLY="${FILE##*.}"

# echo original extension is ${EXTONLY}

# Delete everything after first src hash #: - must change if absent
# sed -n '/#:/q;p' ${POFILE} > ${FILEONLY}_header.txt
# Delete everything on and after the second line starting with msgid and any l;ine starting with #: or #,
# awk -vf=0 '/^msgid/{f=1;++d}d!=2{print}f&&d==2{print;exit}' ${POFILE} | sed '$ d' | grep -v '#:' | grep -v '#,' > ${FILEONLY}_header.txt
awk -v N=2 '{print}/^msgid "/&&--N<=0{exit}' ${POFILE} | sed '$ d' | grep -v '#:' | grep -v '#,' > ${FILEONLY}_header.txt
echo ${FILEONLY}_header.txt is the PO header alone

# Remove first msgid, msgstr, make all msgid  and msgstr into single lines and remove all lines starting with # and "
sed '0,/^msgstr ""/{/^msgstr ""/d;}' ${POFILE} | sed '0,/msgid ""/{/^msgid ""/d;}' | sed -n 'H; ${x; s/"\n"//g; p}' | sed -e '1 s/^msgstr ""//; t' | grep -v '^"' | grep -v '^#' | sed '/^$/d' | awk '{ if ((NR % 2) == 1) printf("\n"); print; }' > ${FILEONLY}_id_str.txt
echo ${FILEONLY}_id_str.txt is without PO header

# Complete extraction of the source msgid strings:
grep -v '^msgstr' ${FILEONLY}_id_str.txt | sed '/^$/d' | sed -e 's/msgid "//g' | sed -e 's/"//g' > ${FILEONLY}_id.txt
echo ${FILEONLY}_id.txt has only the source strings

# Complete extraction  of the translated msgstr strings:
grep -v '^msgid' ${FILEONLY}_id_str.txt | sed '/^$/d' | sed -e 's/msgstr "//g' | sed -e 's/"//g' > ${FILEONLY}_str.txt
echo ${FILEONLY}_str.txt has only the translated strings

