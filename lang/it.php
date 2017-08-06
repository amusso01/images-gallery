<?php
$lang['title_home']='Costruire Applicazioni Web con MySQL e PHP - BBK - amusso01 FMA';
$lang['title_upload']='Caricare immagini';
$lang['title_image']='Immagine principale';
$lang['title_404']='Pagina non trovata';
$lang['date']=makeDate($config);
$lang['404']='404. Pagina non trovata nel server';
$lang['imageTitle']='Titolo della foto';
$lang['imageDesc']='Descrizione della foto';
$lang['imageType']='Selezionare un file Jpeg/Jpg';
$lang['upload']='Carica la foto';
$lang['nav']='Carica Foto';
$lang['desc']='Descrizione:';
$lang['uploaded']='Caricata il:';
$lang['size']='Dimensioni del file originale:';
$lang['download']='Scarica il file originale';
$lang['file']='Seleziona un File';
$lang['errorTitle']="Il titolo non e' stato inserito o supera il limite di 50 caratteri!";
$lang['errorDesc']="La Descrizione non e' stata inserita o supera il limite di 250 caratteri!";
$lang['errorNoDb']="<p>Nessun id per questa immagine nel database!</p>";


$uploadSize=ini_get("upload_max_filesize");
$lang['invalidUpload']='Tentativo di caricare un file non autorizzato!!';
$uploadErrors = array(
    0 => 'File caricato con successo',
    1 => 'Il file supera le massime dimensioni consentite in php.ini',
    2 => 'Il file supera le massime dimensioni dichiarate nella HTML form]',
    3 => 'Il file e\' stato caricato solo parzialmente',
    4 => 'Nessun file e\' stato selezionato',
    6 => 'Manca la cartella temporanea nel Server',
    7 => 'Tentativo fallito di scrivere su disco',
    8 => 'Un estensione di PHP ha bloccato il caricamento del file',
);
