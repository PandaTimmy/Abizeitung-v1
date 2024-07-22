<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');

$privateKey = $_POST["data1"];
$loadLogs = $_POST["data2"];
$loadActivity = $_POST["data3"];

$activeFilter = $_POST["data4"];
$filter = $_POST["data5"];

$filter = str_replace("div.", "", $filter);
$filter = explode(",", $filter);


$command = "SELECT branch FROM tree";
$sql = sqlCommand($command);





////////// PRIVATE KEY ANZEIGEN

// echo '<p style="font-size: 14px; font-weight: 400; line-break: anywhere; line-height: 16px; font-family: monospace;" class="selectable">'."$privateKey".'</p>';

// echo '<br><br>';

$tageSeit2024aktuellerTag = 0; //Also der Tag wird ja hochgezählt und genau diese Variable beschreibt es

$activityCountPerDay = 0;

$dayOne = 9999999;



if($loadActivity == "true") {
    echo '<h2 class="article-eyebrow">AKTIVITÄT</h2>';
    echo '<div id="activity" style="width: 100%;">';
    

}

if($loadLogs == "true") {
    echo '<h2 id="datum" class="article-eyebrow">GESAMTE ZEIT</h2>';
    echo '<div style="height: 50px;"></div>';

}

$total_rows = $sql->num_rows;
$current_row = 0;

if ($sql->num_rows > 0) {
    while ($row = $sql->fetch_assoc()) {

        ++$current_row;


        openssl_private_decrypt(hex2bin($row['branch']), $roots, $privateKey);
        
        $datum = explode("✩", $roots)[0];
        $kategorie = explode("✩", $roots)[1];
        $benutzer = explode("✩", $roots)[2];
        $inhalt = explode("✩", $roots)[3];


        // Das Datum in Form von "2024-03-14 17:48:18"
        $datumString = $datum;

        // Das Ziel-Datum erstellen
        $zielDatum = new DateTime($datumString);

        // Das Start-Datum (1. Januar 2024)
        $startDatum = new DateTime('2024-01-01');

        // Die Differenz zwischen den beiden Daten berechnen
        $interval = $startDatum->diff($zielDatum);

        // Die Anzahl der Tage seit dem 1. Januar 2024 aus dem Intervall extrahieren
        $tageSeit2024 = $interval->format('%a');

        if($tageSeit2024 < $dayOne) {
            $dayOne = $tageSeit2024;
            $tageSeit2024aktuellerTag = $tageSeit2024;
        }




        if ( $tageSeit2024aktuellerTag < $tageSeit2024 || $current_row === $total_rows) {
            
            $farben = array("#f3e8ee", "#BACDB0", "#729b79", "#475b63", "#2e2c2f");

            $color = farbton_auf_gradient($farben, ($activityCountPerDay*10));


            if($loadActivity == "true" && $current_row < $total_rows) {
                echo "<div class='SelectDay SelectDay".$tageSeit2024aktuellerTag."' style='display: inline-block; height: 20px; width: 20px; background-color: ".$color."; margin: 1px 2px 1px 2px; cursor: pointer;' onmouseover='
                
                console.log(\"".$tageSeit2024aktuellerTag."\")
                        
                var alles = document.querySelectorAll(\".filterObjects\");
                alles.forEach(function(element) {
                    element.style.display = \"none\";
                });

                var alles = document.querySelectorAll(getCookie(\"filter\")+\".Tag".$tageSeit2024aktuellerTag."\");
                alles.forEach(function(element) {
                    element.style.display = \"block\";
                });

                // Anzahl der Tage seit dem Jahr 2024
                var tageSeit2024 = ".$tageSeit2024aktuellerTag."; // Beispiel: Hier die tatsächliche Anzahl der Tage einfügen

                // Heutiges Datum
                var heute = new Date();

                // Datum für 2024
                var datum2024 = new Date(2024, 0, 1); // Januar ist Monat 0

                // Anzahl der Millisekunden pro Tag
                var msProTag = 1000 * 60 * 60 * 24;

                // Berechne das Datum
                var zukuenftigesDatum = new Date(datum2024.getTime() + tageSeit2024 * msProTag);

                document.getElementById(\"datum\").innerHTML = zukuenftigesDatum.toString().substring(0, 15);
                document.getElementById(\"datum\").style.opacity = 1;
                
                ' onclick='

                if (getCookie(\"activeDay\") == ".$tageSeit2024aktuellerTag.") {
                    setCookie(\"filter\", \"div.filterObjects\", 0.01);
                    setCookie(\"activeDay\", \"alles\", 0.01);
                    console.log(\"activeDay\");

                    alles = document.querySelectorAll(\".SelectDay\");
                    alles.forEach(function(element) {
                    element.style.border = \"0px solid black\";
                    });
                }
                else {

                        
                setCookie(\"activeDay\", \"".$tageSeit2024aktuellerTag."\", 0.01);

                alles = document.querySelectorAll(\".SelectDay\");
                alles.forEach(function(element) {
                    element.style.border = \"0px solid black\";
                });

                alles = document.querySelectorAll(\".SelectDay".$tageSeit2024aktuellerTag."\");
                alles.forEach(function(element) {
                    element.style.border = \"3px solid #B496AF\";
                    element.style.boxSizing = \"border-box\";
                });

                }
                ' onmouseleave='

                console.log(\"leave\");

                var alles = document.querySelectorAll(\".filterObjects\");
                alles.forEach(function(element) {
                    element.style.display = \"none\";
                });

                var alles = document.querySelectorAll(getCookie(\"filter\")+\".Tag\"+getCookie(\"activeDay\"));
                alles.forEach(function(element) {
                    element.style.display = \"block\";
                });

                // Anzahl der Tage seit dem Jahr 2024
                var tageSeit2024 = getCookie(\"activeDay\"); // Beispiel: Hier die tatsächliche Anzahl der Tage einfügen

                // Heutiges Datum
                var heute = new Date();

                // Datum für 2024
                var datum2024 = new Date(2024, 0, 1); // Januar ist Monat 0

                // Anzahl der Millisekunden pro Tag
                var msProTag = 1000 * 60 * 60 * 24;

                // Berechne das Datum
                var zukuenftigesDatum = new Date(datum2024.getTime() + tageSeit2024 * msProTag);

                document.getElementById(\"datum\").innerHTML = zukuenftigesDatum.toString().substring(0, 15);
                document.getElementById(\"datum\").style.opacity = 1;

                if (getCookie(\"activeDay\") == \"alles\") {
                    alles = document.querySelectorAll(getCookie(\"filter\"));
                    alles.forEach(function(element) {
                        element.style.display = \"block\";
                    });
                    document.getElementById(\"datum\").innerHTML = \"GESAMTE ZEIT\";
                    document.getElementById(\"datum\").style.opacity = 1;
                }
                
                '></div>";
            }


            while ( $tageSeit2024aktuellerTag < $tageSeit2024 ) {

                ++$tageSeit2024aktuellerTag;
    
                if ( $tageSeit2024 - $tageSeit2024aktuellerTag ) {

                    if($loadActivity == "true") {
                        echo "<div class='SelectDay SelectDay".$tageSeit2024aktuellerTag."' style='display: inline-block; height: 20px; width: 20px; background-color: #f3e8ee; margin: 1px 2px 1px 2px; cursor: pointer;' onmouseover='
                        
                        console.log(\"".$tageSeit2024aktuellerTag."\")
                        
                        var alles = document.querySelectorAll(\".filterObjects\");
                        alles.forEach(function(element) {
                            element.style.display = \"none\";
                        });

                        var alles = document.querySelectorAll(getCookie(\"filter\")+\".Tag".$tageSeit2024aktuellerTag."\");
                        alles.forEach(function(element) {
                            element.style.display = \"block\";
                        });




                        // Anzahl der Tage seit dem Jahr 2024
                        var tageSeit2024 = ".$tageSeit2024aktuellerTag."; // Beispiel: Hier die tatsächliche Anzahl der Tage einfügen

                        // Heutiges Datum
                        var heute = new Date();

                        // Datum für 2024
                        var datum2024 = new Date(2024, 0, 1); // Januar ist Monat 0

                        // Anzahl der Millisekunden pro Tag
                        var msProTag = 1000 * 60 * 60 * 24;

                        // Berechne das Datum
                        var zukuenftigesDatum = new Date(datum2024.getTime() + tageSeit2024 * msProTag);

                        document.getElementById(\"datum\").innerHTML = zukuenftigesDatum.toString().substring(0, 15);
                        document.getElementById(\"datum\").style.opacity = 0.5;
                        
                        ' onclick='

                        if (getCookie(\"activeDay\") == ".$tageSeit2024aktuellerTag.") {
                            setCookie(\"filter\", \"div.filterObjects\", 0.01);
                            setCookie(\"activeDay\", \"alles\", 0.01);
                            console.log(\"activeDay\");
        
                            alles = document.querySelectorAll(\".SelectDay\");
                            alles.forEach(function(element) {
                            element.style.border = \"0px solid black\";
                            });

                            
                        }
                        else {
                        
                        setCookie(\"activeDay\", \"".$tageSeit2024aktuellerTag."\", 0.01);

                        alles = document.querySelectorAll(\".SelectDay\");
                        alles.forEach(function(element) {
                            element.style.border = \"0px solid black\";
                        });

                        alles = document.querySelectorAll(\".SelectDay".$tageSeit2024aktuellerTag."\");
                        alles.forEach(function(element) {
                            element.style.border = \"3px solid grey\";
                            element.style.boxSizing = \"border-box\";
                        });

                        }
                                
                        ' onmouseleave='

                        

                        console.log(\"leave\");

                        var alles = document.querySelectorAll(\".filterObjects\");
                        alles.forEach(function(element) {
                            element.style.display = \"none\";
                        });

                        var alles = document.querySelectorAll(getCookie(\"filter\")+\".Tag\"+getCookie(\"activeDay\"));
                        alles.forEach(function(element) {
                            element.style.display = \"block\";
                        });

                        // Anzahl der Tage seit dem Jahr 2024
                        var tageSeit2024 = getCookie(\"activeDay\"); // Beispiel: Hier die tatsächliche Anzahl der Tage einfügen

                        // Heutiges Datum
                        var heute = new Date();

                        // Datum für 2024
                        var datum2024 = new Date(2024, 0, 1); // Januar ist Monat 0

                        // Anzahl der Millisekunden pro Tag
                        var msProTag = 1000 * 60 * 60 * 24;

                        // Berechne das Datum
                        var zukuenftigesDatum = new Date(datum2024.getTime() + tageSeit2024 * msProTag);

                        document.getElementById(\"datum\").innerHTML = zukuenftigesDatum.toString().substring(0, 15);
                        document.getElementById(\"datum\").style.opacity = 1;

                        if (getCookie(\"activeDay\") == \"alles\") {
                            alles = document.querySelectorAll(getCookie(\"filter\"));
                            alles.forEach(function(element) {
                                element.style.display = \"block\";
                            });
                            document.getElementById(\"datum\").innerHTML = \"GESAMTE ZEIT\";
                            document.getElementById(\"datum\").style.opacity = 1;
                        }
                        
                        '></div>";
                    }
                }    
            }

            if ( $current_row === $total_rows && $loadActivity == "true" ) {

                if ( $activeFilter == "Kategorie" ) {
                    if ( in_array("filterObjects", $filter) ) {
                        ++$activityCountPerDay;
                        
                    } else {
                        if ( in_array($kategorie, $filter) ) {
                            ++$activityCountPerDay;
                        }
                    }
                    
                }
                if ( $activeFilter == "Benutzer") {
                    if ( in_array("filterObjects", $filter) ) {
                        ++$activityCountPerDay;
                        
                    } else {
                        if ( in_array($benutzer, $filter) ) {
                            ++$activityCountPerDay;
                        }
                    }
                }

                //echo $activityCountPerDay;


                $farben = array("#f3e8ee", "#BACDB0", "#729b79", "#475b63", "#2e2c2f");

                $color = farbton_auf_gradient($farben, ($activityCountPerDay*10));

                echo "<div class='SelectDay SelectDay".$tageSeit2024aktuellerTag."' style='display: inline-block; height: 20px; width: 20px; background-color: ".$color."; margin: 1px 2px 1px 2px; cursor: pointer;' onmouseover='
                
                console.log(\"".$tageSeit2024aktuellerTag."\")
                        
                var alles = document.querySelectorAll(\".filterObjects\");
                alles.forEach(function(element) {
                    element.style.display = \"none\";
                });

                var alles = document.querySelectorAll(getCookie(\"filter\")+\".Tag".$tageSeit2024aktuellerTag."\");
                alles.forEach(function(element) {
                    element.style.display = \"block\";
                });

                // Anzahl der Tage seit dem Jahr 2024
                var tageSeit2024 = ".$tageSeit2024aktuellerTag."; // Beispiel: Hier die tatsächliche Anzahl der Tage einfügen

                // Heutiges Datum
                var heute = new Date();

                // Datum für 2024
                var datum2024 = new Date(2024, 0, 1); // Januar ist Monat 0

                // Anzahl der Millisekunden pro Tag
                var msProTag = 1000 * 60 * 60 * 24;

                // Berechne das Datum
                var zukuenftigesDatum = new Date(datum2024.getTime() + tageSeit2024 * msProTag);

                document.getElementById(\"datum\").innerHTML = zukuenftigesDatum.toString().substring(0, 15);
                document.getElementById(\"datum\").style.opacity = 1;
                
                ' onclick='

                if (getCookie(\"activeDay\") == ".$tageSeit2024aktuellerTag.") {
                    setCookie(\"filter\", \"div.filterObjects\", 0.01);
                    setCookie(\"activeDay\", \"alles\", 0.01);
                    console.log(\"activeDay\");

                    alles = document.querySelectorAll(\".SelectDay\");
                    alles.forEach(function(element) {
                    element.style.border = \"0px solid black\";
                    });
                }
                else {

                        
                setCookie(\"activeDay\", \"".$tageSeit2024aktuellerTag."\", 0.01);

                alles = document.querySelectorAll(\".SelectDay\");
                alles.forEach(function(element) {
                    element.style.border = \"0px solid black\";
                });

                alles = document.querySelectorAll(\".SelectDay".$tageSeit2024aktuellerTag."\");
                alles.forEach(function(element) {
                    element.style.border = \"3px solid #B496AF\";
                    element.style.boxSizing = \"border-box\";
                });

                }
                ' onmouseleave='

                console.log(\"leave\");

                var alles = document.querySelectorAll(\".filterObjects\");
                alles.forEach(function(element) {
                    element.style.display = \"none\";
                });

                var alles = document.querySelectorAll(getCookie(\"filter\")+\".Tag\"+getCookie(\"activeDay\"));
                alles.forEach(function(element) {
                    element.style.display = \"block\";
                });

                // Anzahl der Tage seit dem Jahr 2024
                var tageSeit2024 = getCookie(\"activeDay\"); // Beispiel: Hier die tatsächliche Anzahl der Tage einfügen

                // Heutiges Datum
                var heute = new Date();

                // Datum für 2024
                var datum2024 = new Date(2024, 0, 1); // Januar ist Monat 0

                // Anzahl der Millisekunden pro Tag
                var msProTag = 1000 * 60 * 60 * 24;

                // Berechne das Datum
                var zukuenftigesDatum = new Date(datum2024.getTime() + tageSeit2024 * msProTag);

                document.getElementById(\"datum\").innerHTML = zukuenftigesDatum.toString().substring(0, 15);
                document.getElementById(\"datum\").style.opacity = 1;

                if (getCookie(\"activeDay\") == \"alles\") {
                    alles = document.querySelectorAll(getCookie(\"filter\"));
                    alles.forEach(function(element) {
                        element.style.display = \"block\";
                    });
                    document.getElementById(\"datum\").innerHTML = \"GESAMTE ZEIT\";
                    document.getElementById(\"datum\").style.opacity = 1;
                }
                
                '></div>";
            }


            

            $activityCountPerDay = 0;
            
        }

        


        if ( $activeFilter == "Kategorie" ) {
            if ( in_array("filterObjects", $filter) ) {
                ++$activityCountPerDay;
                
            } else {
                if ( in_array($kategorie, $filter) ) {
                    ++$activityCountPerDay;
                }
            }
            
        }
        if ( $activeFilter == "Benutzer") {
            if ( in_array("filterObjects", $filter) ) {
                ++$activityCountPerDay;
                
            } else {
                if ( in_array($benutzer, $filter) ) {
                    ++$activityCountPerDay;
                }
            }
        }


        

        //$activityEchoHTML = $activityEchoHTML."<div style='display: inline-block; height: 20px; width: 20px; background-color: red; margin: 1px 2px 1px 2px; cursor: pointer;' onmouseover='console.log(\"".$tageSeit2024."\")'></div>";

        if($loadLogs == "true") {

            echo '<div class="'."$kategorie".' filterObjects Tag'."$tageSeit2024".' '."$benutzer".'"><div class="selectable"><h2 class="article-eyebrow" style="margin-bottom: 0; line-height: 22px; color: rgb(134, 134, 139); font-size: 10px; user-select: all;">'."$datum".'</h2>';
            echo '<h2 style="font-size: 14px; line-height: 18px; margin-bottom: 10px; font-weight: 500; user-select: all;" class="">'."$inhalt".'</h2></div><hr style="opacity: 0.2;"></div>';
        }
    }
}



if($loadActivity == "true") {
    echo '</div>';
    
}

if($loadLogs == "true") {
    echo '<div style="height: 100px;"></div>';

}














function farbton_auf_gradient($farben, $prozent) {

    $prozent = max(0, min($prozent, 100));

    // Anzahl der Farben im Gradienten
    $anzahl_farben = count($farben);

    // Berechne den Index der Startfarbe im Gradienten
    $index_startfarbe = floor(($anzahl_farben - 1) * $prozent / 100);

    // Berechne den Index der Endfarbe im Gradienten
    $index_endfarbe = ceil(($anzahl_farben - 1) * $prozent / 100);

    // Extrahiere die RGB-Komponenten der Startfarbe
    $r1 = hexdec(substr($farben[$index_startfarbe], 1, 2));
    $g1 = hexdec(substr($farben[$index_startfarbe], 3, 2));
    $b1 = hexdec(substr($farben[$index_startfarbe], 5, 2));

    // Extrahiere die RGB-Komponenten der Endfarbe
    $r2 = hexdec(substr($farben[$index_endfarbe], 1, 2));
    $g2 = hexdec(substr($farben[$index_endfarbe], 3, 2));
    $b2 = hexdec(substr($farben[$index_endfarbe], 5, 2));

    // Berechne den interpolierten RGB-Wert basierend auf der Prozentzahl
    $r = round($r1 + ($r2 - $r1) * ($prozent % (100 / ($anzahl_farben - 1))) / (100 / ($anzahl_farben - 1)));
    $g = round($g1 + ($g2 - $g1) * ($prozent % (100 / ($anzahl_farben - 1))) / (100 / ($anzahl_farben - 1)));
    $b = round($b1 + ($b2 - $b1) * ($prozent % (100 / ($anzahl_farben - 1))) / (100 / ($anzahl_farben - 1)));

    // Formatiere den interpolierten RGB-Wert als hexadezimale Farbe
    $farbe = sprintf("#%02x%02x%02x", $r, $g, $b);

    // Gib die interpolierte Farbe zurück
    return $farbe;
}

