<?php

namespace App\Tests;

use GuzzleHttp\Psr7\Uri;
use PhpPact\Standalone\ProviderVerifier\Model\VerifierConfig;
use PhpPact\Standalone\ProviderVerifier\Verifier;
use PHPUnit\Framework\TestCase;

/**
 * @group contract-provider
 */
class UserProviderTest extends TestCase
{
    public function testProviderDoesNotBreakThings()
    {
        $config = new VerifierConfig();
        $config
            ->setProviderName('user') // Providers name to fetch.
            ->setProviderVersion('1.0.0')
            ->setProviderBaseUrl(new Uri('http://user')) // URL of the Provider.
            ->setBrokerUri(new Uri('http://pact-broker')) // URL of the Pact Broker to publish results.
            ->setPublishResults(true) // Flag the verifier service to publish the results to the Pact Broker.
            ->setProcessTimeout(60)
            ->setProcessIdleTimeout(20);

        // Verify that all consumers of 'someProvider' are valid.
        $verifier = new Verifier($config);
        $verifier->verifyAll();

        // This will not be reached if the PACT verifier throws an error, otherwise it was successful.
        $this->assertTrue(true, 'Pact Verification has failed.');
    }
}