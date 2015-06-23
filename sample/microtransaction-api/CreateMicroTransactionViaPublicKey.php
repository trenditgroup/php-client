<?php

// # Create MicroTX Sample from PublicKey and client-side signing
//
// This sample code demonstrate how you can create a new micro transaction, as documented here at:
// <a href="http://dev.blockcypher.com/#microtransaction-endpoint">http://dev.blockcypher.com/#microtransaction-endpoint</a>
// API used: POST /v1/btc/main/txs/micro

/** @var \BlockCypher\Api\MicroTX $microTX */
$microTX = require 'CreateMicroTransaction.php';

// source addresses private keys
// private key in the same format as returned by Generate Address Endpoint:
// <a href="http://dev.blockcypher.com/#generate-address-endpoint">http://dev.blockcypher.com/#generate-address-endpoint</a>
// Address: C5vqMGme4FThKnCY44gx1PLgWr86uxRbDm
$privateKey = "2c2cc015519b79782bd9c5af66f442e808f573714e3c4dc6df7d79c183963cff";

// ### Sign the MicroTX
$microTX->sign($privateKey);

// Source and Destination addresses used in this sample
// https://live.blockcypher.com/bcy/address/C5vqMGme4FThKnCY44gx1PLgWr86uxRbDm/
// https://live.blockcypher.com/bcy/address/C4MYFr4EAdqEeUKxTnPUF3d3whWcPMz1Fi/

// For Sample Purposes Only.
$request = clone $microTX;

try {
    // ### Send MicroTX to the network
    $output = $microTX->send($apiContexts['BCY.test']);
} catch (Exception $ex) {
    ResultPrinter::printError("Created MicroTX Via PublicKey", "MicroTX", null, $request, $ex);
    exit(1);
}

ResultPrinter::printResult("Created MicroTX Via PublicKey", "MicroTX", $output->getHash(), $request, $output);

return $output;