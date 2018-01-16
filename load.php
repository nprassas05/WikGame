<?php
use MediaWiki\Logger\LoggerFactory;
use MediaWiki\MediaWikiServices;
   // details of the session. Enforce this constraint with respect to session use.
    define( 'MW_NO_SESSION', 1 );
   
    require __DIR__ . '/includes/WebStart.php';
    
    // URL safety checks
    if ( !$wgRequest->checkUrlExtension() ) {
       return;
    }
   
    // Don't initialise ChronologyProtector from object cache, and
    // don't wait for unrelated MediaWiki writes when querying ResourceLoader.
    MediaWikiServices::getInstance()->getDBLoadBalancerFactory()->setRequestInfo( [
       'ChronologyProtection' => 'false',
	 ] );
 
    // Set up ResourceLoader
   $resourceLoader = new ResourceLoader(
      ConfigFactory::getDefaultInstance()->makeConfig( 'main' ),
       LoggerFactory::getInstance( 'resourceloader' )
    );
    $context = new ResourceLoaderContext( $resourceLoader, $wgRequest );
    
    // Respond to ResourceLoader request
    $resourceLoader->respond( $context );
   
    Profiler::instance()->setTemplated( true );
  
    $mediawiki = new MediaWiki();
    $mediawiki->doPostOutputShutdown( 'fast' );
?>