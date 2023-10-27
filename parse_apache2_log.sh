#!/usr/bin/env bash
LOG_FILE=$1

## https://stackoverflow.com/questions/64336555/parsing-apache-logs-with-bash

#regex to find mmm/yyyy
dateUniq=`grep -oP '(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\/\d{4}' $LOG_FILE | sort | uniq`


for i in $dateUniq
do  
    #output mmm yyyy
    echo $i | sed 's/\// /g'
    
    #regex to find ip
    ipUniq=`grep $i $LOG_FILE | grep -oP '(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)'  | sort | uniq`
    
    for x in $ipUniq
    do  
        count=`grep $i $LOG_FILE |grep -c $x`
        #output count ip
        echo $count $x
    done
    echo
done
