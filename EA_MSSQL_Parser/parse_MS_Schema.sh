# Parsing Enterprise Architect

sed -e ':a;N;$!ba;s/\n  / /g' ms_table.txt  | \
  grep "Public " | \
  awk -F " " '{ print "`" $3 "` " $2 "," }' | \
#  awk 'NR!=1' | \
  sed -e 's/datetime2(0)/datetime/g' > abc.txt
