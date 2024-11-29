<?php


//==============================================================================
// Archivo: /modalImg.php
// Autor: Federico Ramos <federico.g.ramos@gmail.com>
// Modificado: 20241126 1539
//
// Los siguientes archivos forman parte de una librería para desplegar imágenes
// del tipo popup:
// # modalImg.php
// # ./js/modalImg.js
// # ./css/modalImg.css
//==============================================================================


//==============================================================================
// Recibe:
// # $vimg = {
//     {cod, "descripción"}.
//     {cod, "descripción"},
//     ...
// }

function modalImg($vimg)
    {
    static $modalIndex = 0;// Cuando hay varios grupos, los diferencio.

    $html = array();

    $vThumb = array();
    $vSlide = array();
    $vControl = array();
    $vSlideCount = count($vimg);
    foreach($vimg as $key => $img)
        {
        $suf = "thumb32";
        $pathDir = PATH_FILESWEB.$suf."/";
        $urlDir = URL_FILESWEB.$suf."/";

	    $suffix = "_".$suf;// $suffix="_thumb" es la otra alternativa;
	    $nameId = NULL;// Para la 1er imagen siempre, porque no hay N0000.
	    $ext = ".png";

        $cod = $img[0];

	    $picFromCode = picFromCode($pathDir, $urlDir, $cod, $nameId, $suffix,
            $ext);
        // Nombre directamente de la imagen, es caso particular de nombre con co
        // digo completo.

	    if($picFromCode["urlName"] != NULL)
            {
            //$name = $picFromCode["name"];
        	$urlNamex = $picFromCode["urlName"];
            }
        else
        	{
        	$name = "logo_abebashop_wrapped_wm";
        	$urlNamex = $urlDir.$name.$nameId.$suffix.$ext;
            }

        $vThumb[] = "<img src=\"".$urlNamex."\" ".
            "onclick=\"openModal(".$modalIndex."); currentSlide(".$key.")\" ".
            "class=\"hoverSelect\">";

        // Thumb image controls.
        //$vControl[] = "<img class=\"modalImgCtrl\" "."src=\"".$urlNamex."\" ".
          //  "onclick=\"currentSlide(".$key.")\" alt=\"".$img[1]."\">";

//        $vControl[] = "<img class=\"modalImgCtrl\" "."src=\"".$urlNamex."\" ".
  //          "onclick=\"currentSlide(".$key.");\" alt=\"".$img[1]."\">";

        $vControl[] = "<img class=\"modalImgCtrl modalImgCtrl_".$modalIndex."\" "."src=\"".$urlNamex."\" ".
            "onclick=\"currentSlide(".$key.");\" alt=\"".$img[1]."\">";



        // Para vSlide (big images).
        $suf = "std";
        $pathDir = PATH_FILESWEB.$suf."/";
        $urlDir = URL_FILESWEB.$suf."/";

	    $suffix = "_".$suf;// $suffix="_thumb" es la otra alternativa;
	    //$nameId = NULL;// Para la 1er imagen siempre, porque no hay N0000.
	    //$ext = ".png";

        //$cod = $img[0];

	    $picFromCode = picFromCode($pathDir, $urlDir, $cod, $nameId, $suffix,
            $ext);
        // Nombre directamente de la imagen, es caso particular de nombre con co
        // digo completo.

	    if($picFromCode["urlName"] != NULL)
            {
            //$name = $picFromCode["name"];
        	$urlNamex = $picFromCode["urlName"];
            }
        else
        	{
        	$name = "logo_abebashop_wrapped_wm";
        	$urlNamex = $urlDir.$name.$nameId.$suffix.$ext;
            }

        // Estrategia para que cargue rapido: no pongo el src. Lo pone javascrip
        // t cuando seleccionan imagen. data-src contiene verdadero src de img.
        $vSlide[] = "<div class=\"mySlides slides_".$modalIndex."\">";
//        $vSlide[] = "<div class=\"mySlides\" name=\""."slides_".$modalIndex."\">";
        $vSlide[] = "<div class=\"numbertext\">".($key+1)." / ".$vSlideCount."</div>";
        $vSlide[] = "<img class=\"slideImg slideImg_".$modalIndex."\" src=\"\" data-src=\"".$urlNamex."\"></div>";

        }


    $html[] = "<div class=\"row\">";
    $html[] = implode("&nbsp;", $vThumb);
    $html[] = "</div>";

    $html[] = "<div id=\"modal_".$modalIndex."\" class=\"modal\">";// The Modal
    $html[] = "<span class=\"close cursor\" onclick=\"closeModal(".$modalIndex.")\">&times;</span>";

    //$html[] = '<div class="modal-content">';
    $html[] = "<div class=\"modal-content\" id=\"modalContent_".$modalIndex."\">";

    $html[] = implode("", $vSlide);

    // Next & previous controls.
    $html[] = "<a class=\"prev\" onclick=\"plusSlides(-1)\">&#10094;</a>";
    $html[] = "<a class=\"next\" onclick=\"plusSlides(1)\">&#10095;</a>";

    // Caption text
    $html[] = "<div class=\"caption-container\"><p id=\"caption_".$modalIndex."\"></p></div>";

    $html[] = '<div class="caption-container">';
    $html[] = implode("&nbsp;", $vControl);
    $html[] = "</div>";

    $html[] = "</div></div>";

//print_r($html);
//echo "<br/>";
    $modalIndex++;// Cada invocación, es un grupo de imagenes. Deja listo para prox.

    return implode("", $html);
    }

