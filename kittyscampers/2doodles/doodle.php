<?php

    /*
     * ------------------------------------------
     * php
     * doodle.php - dynamically displays a doodle
     * Code revised on June 2015
     * ------------------------------------------
     */


    $gallery = array();
    $not_allowed = array('.', '..');


    // Remove the extension from the filename
    function removeExtension($strName)
    {
        $ext = strrchr($strName, '.');

        if ($ext !== false)
        {
            $strName = substr($strName, 0, -strlen($ext));
        }

        return $strName;
    }


    // Scan directory for doodles and add to array
    $handle = opendir("images/");

    if ($handle != false)
    {
        while (false !== ($filename = readdir($handle)))
        {
            if ( ! in_array($filename, $not_allowed) )
            {
                $gallery[] = removeExtension($filename);
            }
        }

        // Release handle on directory
        closedir($handle);

        // Randomize the array
        shuffle($gallery);
    }


    // Get random buttons
    $randomDoodle1 = $gallery[0];
    $randomDoodle2 = $gallery[1];
    $randomDoodle3 = $gallery[2];

    // Get random button links
    $randomDoodleLink1 = "doodle.php?dn={$randomDoodle1}";
    $randomDoodleLink2 = "doodle.php?dn={$randomDoodle2}";
    $randomDoodleLink3 = "doodle.php?dn={$randomDoodle3}";


    // Get the filename
    $doodleName = $_GET['dn'];
    $fileName = "images/{$doodleName}.jpg";

    // Get the image dimentions
    $dims = getimagesize($fileName);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <title>kittyscampers.info</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <meta name="author" content="Adrian Bavister" />
        <meta name="generator" content="TextPad, tab spacing 2" />
        <meta name="description" content="Kitty Doodles" />
        <meta name="keywords" content="kittyscampers,kitty,scamper,doodles,art,msn" />
        <link href="styles2.css" rel="stylesheet" type="text/css" />
    </head>

    <body>

        <!-- buttons -->
        <form action="">
            <div class="boxButtons">
                <button type="button" class="btnNav" onclick="window.location='main2.php'">more kitty doodles</button>&nbsp;&nbsp;|&nbsp;
                <button type="button" class="btnMain" onclick="window.location='<?php echo $randomDoodleLink1; ?>'"><?php echo $randomDoodle1; ?></button>&nbsp;
                <button type="button" class="btnMain" onclick="window.location='<?php echo $randomDoodleLink2; ?>'"><?php echo $randomDoodle2; ?></button>&nbsp;
                <?php if (rand(0,1)): ?>
                <button type="button" class="btnMain" onclick="window.location='<?php echo $randomDoodleLink3; ?>'"><?php echo $randomDoodle3; ?></button>
                <?php endif; ?>
            </div>
        </form>

        <!-- the doodle -->
        <div class='boxDoodle'>
            <img class="pic" src="<?php echo $fileName; ?>" alt="<?php echo $doodleName; ?>" <?php echo $dims[3] ?> />
        </div>

        <!-- doodle title -->
        <div class='picTitle'>
            <?php echo "\"{$doodleName}\""; ?>
        </div>

    </body>

</html>