<?php

/* new */
$app->get( '/', function () use ( $app, $data ) {
  $app->render( 'index.twig', $data );
})->name( 'index' );

