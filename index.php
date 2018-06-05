<?php
require 'vendor/autoload.php';

use Aws\Credentials;
use Aws\Credentials\CredentialProvider;
use Aws\LexRuntimeService;
use Aws\LexRuntimeService\LexRuntimeServiceClient;
use Aws\S3\S3Client;

$profile = 'lex';
$path = dirname(__FILE__).DIRECTORY_SEPARATOR.'credentials.ini';

$provider = CredentialProvider::ini($profile, $path);
$provider = CredentialProvider::memoize($provider);

$client = new LexRuntimeServiceClient([
    'region'      => 'us-east-1',
    'version'     => 'latest',
    // 'version'     => '2016-11-28',
    'credentials' => $provider
]);


echo "<pre>";
$result = $client->postContent([
    'accept' => 'text/plain; charset=utf-8',
    'botName' => 'OrderFlowers',
    'botAlias' => 'orderflower',
    'contentType' => 'text/plain; charset=utf-8', // REQUIRED
    'inputStream' => "i would like some flowers", // REQUIRED
    'userId' => '12', // REQUIRED
]);

print_r( $result  );
