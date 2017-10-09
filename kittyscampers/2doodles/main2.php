<?php

    /*
     * -----------------------------------
     * php
     * main2.php - doodle selection screen
     * Code revised on June 2015
     * -----------------------------------
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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <title>kitty doodles | kittyscampers.info</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <meta name="author" content="Adrian Bavister" />
        <meta name="generator" content="TextPad, tab spacing 2" />
        <meta name="description" content="Kitty Doodles" />
        <meta name="keywords" content="kittyscampers,kitty,scamper,doodles,art,msn" />
        <link href="styles2.css" rel="stylesheet" type="text/css" />
    </head>

    <body>

        <!-- *flash* ks logo -->
        <div class="logo"><script src="../_logos/ksLogo_swf.js" type="text/javascript"></script></div>

        <div class="boxTitle">
            <img src="title.jpg" alt="" height="114" width="488" />
        </div>

        <form action="">
            <div class='boxButtons'>
            <?php foreach($gallery as $n => $image_name): ?>

                <?php $link = "doodle.php?dn={$image_name}"; ?>
                <button type="button" class="btnMain" onclick="window.location='<?php echo $link; ?>'"><?php echo $image_name; ?></button>&nbsp;

                <?php if ((fmod($n, 5) == 0) && ($n != 0)): ?>
                    <br />
                <?php endif; ?>

            <?php endforeach; ?>
            </div>
        </form>

    </body>

</html>