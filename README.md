# Campus Reconnection
A class project for CSCI413.
Development seizure 12/15/15.

###How to implement this on a local machine:
We used WAMPServer to host this project. (Windows, Apache, MySQL, and PHP)
It's a preconfigured webhosting software with extras components to make web development less awful.

It can be downloaded from http://wampserver.com/en

Once downloaded and installed, a tool called phpMyAdmin can be used to import the database from
an XML file we exported. You can access it through the wamp menu or at http://localhost/phpMyAdmin/

It's suggested that if you update the database that you drop the existing database completely before importing it.

###Explanation of project components:
<ul>
<li>dataEntry directory - These files can be run in the browser for manually entering data into the database.</li>
<li>images directory - Contains all images that are used in the entire site.</li>
<li>includes directory - Contains mechanisms that can be included into multiple pages (weekly schedule for instance.)</li>
<li>javascript directory - Contains javascript libraries and transcript engine.</li>
<li>library directory - Contains sql wrapper functions and et cetera that pull database information back for use.</li>
<li>camprecondb.xml - Should be imported into phpMyAdmin if you want a database.</li>
<li>style.css - Makes all pages look beautiful. To take a trip back to the 1990's, delete me.</li>
<li>(...).php - Campus reconnection pages.</li>
</ul>

###Server Environment:
At the time we developed this, we had WAMPServer running on a virtual machine. This server was accessible at 134.129.125.206
