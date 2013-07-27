<?php

/* new */
$app->get( '/', function () use ( $app, $data ) {
  $app->render( 'posts_new.twig', $data );
})->name( 'index' );

