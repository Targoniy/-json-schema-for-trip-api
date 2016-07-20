<?php
// namespace JsonSchema;
// Get the schema and data as objects
// If you use $ref or if you are unsure, resolve those references here
// This modifies the $schema object
$refResolver = new JsonSchema\RefResolver(new JsonSchema\Uri\UriRetriever(), new JsonSchema\Uri\UriResolver());
$schema = $refResolver->resolve('file://' . realpath('schema.json'));

$data = json_decode(file_get_contents('data.json'));

// Validate
$validator = new JsonSchema\Validator();
$validator->check($data, $schema);

if ($validator->isValid()) {
    echo "The supplied JSON validates against the schema.\n";
} else {
    echo "JSON does not validate. Violations:\n";
    foreach ($validator->getErrors() as $error) {
        echo sprintf("[%s] %s\n", $error['property'], $error['message']);
    }
}


## Running the tests    $ vendor/bin/phpunit
