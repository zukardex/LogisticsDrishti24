# LogisticsDrishti24
Logistics Tracking Web App built for Drishti'24 Logistics Committee to keep track of all the items they are dealing with.

## Installation
Modify config.php to setup the web application and then run databaseConfig.sql to setup the database.


## Usage
Run generate.php to generate QR Codes. Use GET  parameters "min" and "max" to set the starting and ending points of QR codes to be generated. GET parameter "nos" is used to change the number of QR Codes to be included in a row.
##
After Generation of QR Codes, they are printed to a Sticker sheet  and is pasted on to a physical object. 
Scan the QR code using a normal QR Code scanner, upon reaching the website, click "Register" and then add the details of the physical object to register that particular item to the database. 

##
Every registered QR Code can be scanned and searched to retrieve back the data associated with the associated physical object.
