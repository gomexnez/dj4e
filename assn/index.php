<?php

if ( ! defined('COOKIE_SESSION') ) define('COOKIE_SESSION', true);

require_once "../tsugi/config.php";
require_once "Parsedown.php";


if ( ! function_exists('endsWith') ) {
function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}
}

$url = $_SERVER['REQUEST_URI'];

$parts = parse_url($url);
if ( isset($parts['path']) ) $url = $parts['path'];
$pieces = explode('/',$url);

$file = false;
$svg = false;
$contents = false;
if ( $pieces >= 2 ) {
   $file = $pieces[count($pieces)-1];
   if ( ! file_exists($file) ) {
      $file_with_folder = $pieces[count($pieces)-2] . '/' . $file;
      if ( strpos($file_with_folder, '..' ) === false ) $file = $file_with_folder;
   }
   if ( ! file_exists($file) ) $file = false;
   if ( endsWith($file, '.svg') ) {
        $contents = file_get_contents('svg/'.$file);
        header('Content-Type: image/svg+xml');
        echo($contents);
        return;
   }
   if ( endsWith($file, '.txt') ) {
        $contents = file_get_contents($file);
        header('Content-Type: text/plain');
        echo($contents);
        return;
   }
   if ( ! endsWith($file, '.md') ) $file = false;
   if ( ! $file || ! file_exists($file) ) $file = false;
}

if ( $file !== false ) {
    $contents = file_get_contents($file);
    $HTML_FILE = $file;
}

function x_sel($file) {
    global $HTML_FILE;
    $retval = 'value="'.$file.'"';
    if ( strpos($HTML_FILE, $file) === 0 ) {
        $retval .= " selected";
    }
    return $retval;
}

require_once "../top.php";
require_once "../nav.php";

$OUTPUT->header();
?>
<style>
center {
    padding-bottom: 10px;
}
@media print {
    #chapters {
        display: none;
    }
}
a[target="_blank"]:after {
  content: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAQElEQVR42qXKwQkAIAxDUUdxtO6/RBQkQZvSi8I/pL4BoGw/XPkh4XigPmsUgh0626AjRsgxHTkUThsG2T/sIlzdTsp52kSS1wAAAABJRU5ErkJggg==);
  margin: 0 3px 0 5px;
}
</style>
<?php
$OUTPUT->bodyStart();
// $OUTPUT->topNav();

if ( $contents != false ) {
?>
<script>
function onSelect() {
    console.log($('#chapters').val());
    window.location = $('#chapters').val();
}
</script>
<div style="float:right">
<select id="chapters" onchange="onSelect();">
  <option <?= x_sel("dj4e_install.md") ?>>Django and PythonAnywhere</option>
  <option <?= x_sel("dj4e_html.md") ?>>Adding HTML</option>
  <option <?= x_sel("dj4e_tut01.md") ?>>Serving Dynamic Content</option>
  <option <?= x_sel("dj4e_tut02.md") ?>>Django Models</option>
  <option <?= x_sel("dj4e_tut03.md") ?>>Django Views</option>
  <option <?= x_sel("dj4e_tut04.md") ?>>Django Forms</option>
<!--
  <option <?= x_sel("paw_install.md") ?>>Django and PythonAnywhere</option>
  <option <?= x_sel("paw_skeleton.md") ?>>Skeleton web site</option>
  <option <?= x_sel("paw_models.md") ?>>Django Models</option>
  <option <?= x_sel("paw_admin.md") ?>>Django Admin</option>
-->
  <option <?= x_sel("dj4e_load.md") ?>>Batch Loading Data</option>
<!--
  <option <?= x_sel("paw_home.md") ?>>Django Home Page</option>
  <option <?= x_sel("paw_details.md") ?>>Django Detail Pages</option>
  <option <?= x_sel("paw_sessions.md") ?>>Django Sessions</option>
  <option <?= x_sel("paw_users.md") ?>>Django Users</option>
  <option <?= x_sel("paw_forms.md") ?>>Django Forms</option>
  <option <?= x_sel("paw_github.md") ?>>Using GitHub</option>
-->
  <option <?= x_sel("dj_install.md") ?>>Installing Django Locally</option>
  <option <?= x_sel("dj4e_hello.md") ?>>Hello World</option>
  <option <?= x_sel("dj4e_autos.md") ?>>Autos CRUD</option>
  <option <?= x_sel("dj4e_ads1.md") ?>>AdList Milestone #1</option>
  <option <?= x_sel("dj4e_ads2.md") ?>>AdList Milestone #2</option>
  <option <?= x_sel("dj4e_ads3.md") ?>>AdList Milestone #3</option>
  <option <?= x_sel("dj4e_ads4.md") ?>>AdList Milestone #4</option>
</select>
</div>
<?php
    $Parsedown = new Parsedown();
    echo $Parsedown->text($contents);
} else {
?>
<p>
These are the assignments for Django for Everybody (DJ4E).
</p>
<ul>
<li><a href="dj4e_install.md">Django and PythonAnywhere</a></li>
<li><a href="dj4e_html.md">Adding HTML</a></li>
<li><a href="dj4e_tut01.md"></a>Serving Dynamic Content</li>
<li><a href="dj4e_tut02.md"></a>Django Models</li>
<li><a href="dj4e_tut03.md"></a>Django Views</li>
<li><a href="dj4e_tut04.md"></a>Django Forms</li>
<!--
<li><a href="paw_install.md">Django and PythonAnywhere</a></li>
<li><a href="paw_skeleton.md">Skeleton web site</a></li>
<li><a href="paw_models.md">Django Models</a></li>
<li><a href="paw_admin.md">Django Admin</a></li>
-->
<li><a href="dj4e_load.md">Batch Loading Data</a></li>
<!--
<li><a href="paw_home.md">Django Home Page</a></li>
<li><a href="paw_details.md">Django Detail Pages</a></li>
<li><a href="paw_sessions.md">Django Sessions</a></li>
<li><a href="paw_users.md">Django Users</a></li>
<li><a href="paw_forms.md">Django Forms</a></li>
<li><a href="paw_github.md">Using GitHub</a></li>
-->
<li><a href="dj_install.md">Installing Django Locally</a></li>
<li><a href="dj4e_hello.md">Hello World</a></li>
<li><a href="dj4e_autos.md">Auto CRUD</a></li>
<li><a href="dj4e_ads1.md">AdList Milestone #1</a></li>
<li><a href="dj4e_ads2.md">AdList Milestone #2</a></li>
<li><a href="dj4e_ads3.md">AdList Milestone #3</a></li>
<li><a href="dj4e_ads4.md">AdList Milestone #4</a></li>
</ul>
<p>
If you find a mistake in these pages, feel free to send me a fix using
<a href="https://github.com/csev/dj4e/tree/master/assn" target="_blank">Github</a>.
</p>
<?php
}
$OUTPUT->footerStart();
?>
<script>
// https://stackoverflow.com/questions/7901679/jquery-add-target-blank-for-outgoing-link
$(window).load(function() {
    $('a[href^="http"]').attr('target', function() {
      if(this.host == location.host) return '_self'
      else return '_blank'
    });
});
</script>
<?php
$OUTPUT->footerEnd();

