<?php

// Supply this value through the process environment; never commit API keys.
$stripeSecretKey = getenv('STRIPE_SECRET');

if (!$stripeSecretKey) {
    throw new RuntimeException('STRIPE_SECRET is not configured.');
}
