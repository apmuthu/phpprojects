#Indian Postal Codes List (PinCode Database)
* Process Author : Ap.Muthu
* Release Date   : 2013-11-15
* Pincode Entries: 154706

## Source
* Location URL: http://data.gov.in/dataset/all-india-pincode-directory
* Download URL: http://data.gov.in/access-point-download-count?url=http://data.gov.in/sites/default/files/all_india_pin_code.csv&nid=17625
* File Size MB: 14.11
* Release Date: 2013-06-15
* CSV Entries : 154725

## Processing Summary
* Extensive cleaning up of the CSV file has been done removing the following characters: ;,\".
* Spelling mistakes for Taluk Name corrected
* Standardisation of the Post Office names done
* Duplicates removed
* Multiple Formats made available - TSV, SQL, XLSX

## Sample SQLs:

### List of States
```
SELECT State FROM pincodes GROUP BY State;
```

### List of Districts
```
SELECT District, State FROM pincodes GROUP BY District, State;
```

### List of Taluks
```
SELECT Taluk
     , District
     , State
FROM pincodes 
GROUP BY Taluk
       , District
       , State;
```

### List of Post Offices
```
SELECT POName
     , Taluk
     , District
     , State
     , COUNT(*) AS Records 
FROM pincodes 
GROUP BY POName
       , Taluk
       , District
       , State;
```

## Filter Types
* RIGHT(POName, 3) IN ('S.O', 'B.O', 'H.O') 
* RIGHT(POName, 6) IN ('G.P.O.')
* RIGHT(POName, 5) IN ('T.S.O')
* POName LIKE '%(%'
