<h2>Stack Mobile</h2>
<p>
  Stack Mobile is a mobile front-end to the Stack Exchange network of sites designed for mobile phones, tablets, and other devices with limited screen space.
</p>

<h3>Requirements</h3>
<p>
  Stack Mobile requires the following in order to run on your server:
  <ul>
    <li><a href='http://www.php.net/'>PHP 5.2+</a></li>
    <li><a href='http://www.apache.org/'>Apache</a> with <a href='http://httpd.apache.org/docs/current/mod/mod_rewrite.html'><code>mod_rewrite</code></a> or <a href='http://www.iis.net/'>IIS</a> with <a href='http://www.iis.net/download/urlrewrite'>URL Rewrite</a></li>
    <li>A database with a PDO driver (such as <a href='http://www.mysql.com/'>MySQL</a>, <a href='http://www.postgresql.org/'>PostgreSQL</a>, or <a href='http://www.microsoft.com/sqlserver/'>MS SQL</a>)</li>
    <li><a href='http://stackphp.quickmediasolutions.com/'>Stack.PHP library</a> 0.5+ (for accessing the Stack Exchange API)</li></li>
  </ul>
</p>

<h3>Installation</h3>
<p>
  Installing Stack Mobile is very simply once you have verified that your server meets the requirements listed above.
  <ol>
    <li>Download the latest version of Stack Mobile and Stack.PHP.</li>
    <li>Extract the Stack Mobile archive to a folder within your document root.</li>
    <li>Extract the <code>src</code> folder from the Stack.PHP archive to the Stack Mobile folder.</li>
    <li>Rename the <code>src</code> folder to <code>stackphp</code>.</li>
    <li>Open up your browser and point it to the directory containing the Stack Mobile code and follow the instructions.</li>
  </ol>
</p>