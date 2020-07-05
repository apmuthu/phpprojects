# Create a parseable file and folder list of a DOS / Windows File System
## References
* https://ss64.com/nt/dir.html
* https://www.computerhope.com/movehlp.htm

## Introduction
* A Hard Disk / File System DOS / Windows needs to be scanned for duplicates and organised
* Import the File Systems' File and Folder List into a MySQL DB Table
* Generate from MySQL, the DOS commands needed to Move or Delete Files
* Assumes **abc.csv** is the folder info holding file - change as needed

## DOS Command Line Operations

* Open a DOS Window - Start -> Run =-> Type **cmd** -> Enter
* Windows machines Win-R key combination brings up the DOS Window too
* Command to acquire the File and FOlder List starting from a <known path> (change as needed) with:
````
cd <known path>
dir /b /s /a:-D > abc.csv
````
* Command Line switches:

````
/b => bare names only
/s => recurse into sub folders as well
/a: => attributes
-D => Non Directory Attributes filter
````
* Hexadecimal replacements using the likes of [XVI32](http://www.chmaas.handshake.de/delphi/freeware/xvi32/xvi32.htm), [wxHexEditor](https://sourceforge.net/projects/wxhexeditor/files/wxHexEditor/), [HexEdit 4](https://web.archive.org/web/20151229124816if_/http://www.hexedit.com/Downloads/HexEdit4_binary.zip) 10 MB
````
Replace 0D 0A with 0A (ie., CRLF with LF)
````
* Use the likes of [NotePad++](http://www.notepad-plus-plus) to replace "\" with "/" (ie., backward slash with forward slash as the latter is treated as an escape character in MySQL)
* Create a table in MySQL to store the file and folder names with:
````
CREATE TABLE `filelist` (
  `FName` varchar(255) DEFAULT NULL,
  `FolderName` varchar(255)  DEFAULT NULL,
  `FileName` varchar(255) DEFAULT NULL,
  `ToDel` tinyint(1) NOT NULL DEFAULT '0',
  `ToMove` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
````
* Import the file and folder names into the above MySQL table's first column only
* Split the folder and file names with:
````
UPDATE filelist 
    SET FolderName = MID(FName, 1, LENGTH(FName)-LENGTH(SUBSTRING_INDEX(FName,'/',-1)))
      , FileName = SUBSTRING_INDEX(FName,'/',-1);
````
* Mark the file records to Move or Delete with the likes of:
````
UPDATE filelist SET ToDel=1 WHERE FileName LIKE "%Thumbs.db";
UPDATE filelist SET ToDel=1 WHERE FileName LIKE "~%";
UPDATE filelist SET ToMove=1 WHERE FileName LIKE "%.derp";
````
* Query the File List for File Extension statistics with:
````
SELECT SUBSTRING_INDEX(FileName,'.',-1) As Extn, COUNT(*) as Files from filelist GROUP BY Extn;
````
* Generate the DOS Command Line commands to Delete files with:
````
SELECT CONCAT("del ",CONCAT('"',FolderName,FileName,'"')) AS DelFiles FROM filelist WHERE ToDel=1;
````
* Generating the [DOS move](https://www.computerhope.com/movehlp.htm) (**ren**) statements would need a destination folder as well besides choosing to overwrite existing files

