<?php
session_start();
include_once('include.php');
function wallTitle($str, $separator = '-', $lowercase = FALSE)
{
    if ($separator == 'dash') {
        $separator = '-';
    } else if ($separator == 'underscore') {
        $separator = '_';
    }
    $wallSeparator = preg_quote($separator);
    $trans = array(
        '&.+?;' => '',
        '[^a-z0-9 _-]' => '',
        '\s+' => $separator,
        '(' . $wallSeparator . ')+' => $separator
    );
    $str = strip_tags($str);

    foreach ($trans as $key => $val) {
        $str = preg_replace("#" . $key . "#i", $val, $str);
    }
    if ($lowercase === TRUE) {
        $str = strtolower($str);
    }
    return trim($str, $separator);
}

$path = ".";
$wallName = wallTitle($wallTitle);
$wallFileName = $wallName . '.php';
// Open the folder
$wallArray = array();
$dir_handle = @opendir($path) or die("Unable to open $path");
$start_point = 1;
if ($dir_handle) {
    while (($file = readdir($dir_handle)) !== false) {
        if (!is_dir($file) && strpos($file, '.php') > 0) {
            $wallArray[] = $file;
            if ($wallFileName == $file) {
                $wallFileName = $wallName . $start_point . '.php';
                $start_point++;
            }
        }
    }
    closedir($dir_handle);
}
$file_string = '<?php
/**
 * 			SUITE.SOCIAL © 2019 || WhatsApp Promo
 * ------------------------------------------------------------------------
 * 						** Configuration **
 * ------------------------------------------------------------------------
 */
session_start();
$logo = \''.$logo.'\';
$background = \''.$background.'\';
$headline = \''.$headline.'\';
$caption = \''.$caption.'\';
$cta = \''.$cta.'\';
$share = \'whatsapp://send?text='.$share.'\';
$promo = \''.$promo.'\';

$_SESSION[\'logo\'] = $logo;
$_SESSION[\'background\'] = $background;
$_SESSION[\'headline\'] = $headline;
$_SESSION[\'caption\'] = $caption;
$_SESSION[\'cta\'] = $cta;
$_SESSION[\'share\'] = $share;
$_SESSION[\'promo\'] = $promo;

header("Location: ../index.php?r='.$wallTitle.'");

';
$handle = fopen($wallFileName, "w+");
fwrite($handle, $file_string);
echo $wallFileName;
?>