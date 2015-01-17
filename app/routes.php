<?php

/* new */
$app->get( '/', function () use ( $app ) {
  $app->render( 'index.twig' );
})->name( 'index' );

