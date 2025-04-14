# Where TLS v1 is available or only SSL is available for PHP v5.3.3 and lower use updated wget as below
# Uses URL in a bash variable
CONTENT=$(curl -L https://www.vocport.gov.in/DailyVesselPosition.aspx)
URL=$(echo $CONTENT | grep -o "http[s]\?://[^']\+" | grep EXCEL | head -n 1)
wget --no-check-certificate $URL\
