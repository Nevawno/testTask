<?php
require_once __DIR__ . './phpQuery-onefile.php';

$url = "https://news.ycombinator.com/newest";
$start = 0;
$end = 4;
$arr = [];

function parser( $url, $start, $arr, $end ) {
    $file = file_get_contents( $url );
    $doc = phpQuery::newDocument( $file );
    if ( $start < $end ) {
        foreach ( $doc->find(".itemlist .athing") as $item ) {
            $item = pq( $item );

            !empty($item->find( '.storylink' )->text()) ? '; ' . $title =  $item->find( '.storylink' )->text() . '  ' :
            $title = ";  No title for post  ";
            
            !empty($item->find( '.sitestr' )->text()) ? $domain = ';  ' . $item->find( '.sitestr' )->text() . '  ' :
            $domain = ";  No domain for post  ";
           
            !empty($item->find( '.title .storylink' )->attr( 'href' )) ? $link = ';  '.$item->find( '.title .storylink' )->attr( 'href' ) . '  ; ' :
            $link = ";  No link for post  ;";
           
            !empty($item->next('tr')->find('.subtext .score')->text()) ? $points = $item->next('tr')->find('.subtext .score')->text() . '  ;' :
            $points = "  No points for post  ;";
           
            $source = $title . $domain . $link . $points;

            $arr[] = $source;
            echo "some";
        }

        
        if (count($arr) >= 100) {
            $arr = array_splice($arr, 0, 100);
        }
        writeCVS($arr);
        
        $next = $doc->find( "td.title .morelink")->attr( 'href' );

        if ( !empty( $next ) ) {
            $start++;
            parser( "https://news.ycombinator.com/{$next}", $start, $arr, $end );
        } 
    }
}

function writeCVS($data) {
    $f = fopen( "CSV.csv", "w" );
    foreach ($data as $fields) {
        fputcsv($f, explode(';', $fields), ";");
    }
    fclose($f);
}
?>

<!-- <script>
window.onload = function() {
    window.location.href = "./download.php";
};
</script> -->