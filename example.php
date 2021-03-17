<?php

require 'vendor/autoload.php';

use Onetoweb\Trustedshops\TrustedshopsClient;

// credentials
$email = 'email';
$password = 'password';

// setup client
$trustedshopsClient = new TrustedshopsClient($email, $password);

// set trusted shop id
$trustedShopId = 'trusted_shop_id';

// get shop
$shop = $trustedshopsClient->getShop($trustedShopId);

// get reviews
$reviews = $trustedshopsClient->getShopReviews($trustedShopId, [
    'page' => 0
]);

// get shop review comment
$reviewId = 'review_id';
$commentId = 'comment_id';
$reviewComment = $trustedshopsClient->getShopReviewComment($trustedShopId, $reviewId, $commentId);

// create shop review comment
$reviewId = 'review_id';
$response = $trustedshopsClient->createShopReviewComment($trustedShopId, $reviewId, [
    'informBuyerForShopComment' => true,
    'comment' => 'comment',
]);

// update shop review comment
$reviewId = 'review_id';
$commentId = 'comment_id';
$response = $trustedshopsClient->updateShopReviewComment($trustedShopId, $reviewId, $commentId, [
    'informBuyerForShopComment' => true,
    'comment' => 'comment',
]);

// get quality indicators
$qualityIndicators = $trustedshopsClient->getQualityIndicators($trustedShopId);

// get quality complaints
$qualityComplaints = $trustedshopsClient->getQualityComplaints($trustedShopId);

// get quality reviews
$qualityReviews = $trustedshopsClient->getQualityReviews($trustedShopId);

// get shop benchmarks
$shopBenchmarks = $trustedshopsClient->getShopBenchmarks($trustedShopId);

// get shop retailers
$shopRetailers = $trustedshopsClient->getShopRetailers();

// create review request
$reviewRequest = $trustedshopsClient->createReviewRequest($trustedShopId, [
    'tsId' => $trustedShopId,
    'order' => [
        'orderDate' => '2021-01-01T12:00:00.000Z',
        'orderReference' => 'test order',
    ],
    'consumer' => [
        'firstname' => 'firstname',
        'lastname' => 'lastname',
        'contact' => [
            'email' => 'info@example.com',
            'language' => 'nl'
        ]
    ],
    'sender' => [
        'type' => 'ThirdParty'
    ],
    'types' => [[
        'key' => 'shop'
    ]],
]);

// create review collector
$reviewCollector = $trustedshopsClient->createReviewCollector($trustedShopId, [
    'reviewCollectorRequest' => [
        'reviewCollectorReviewRequests' => [[
            'reminderDate' => '2021-01-01T12:00:00.000Z',
            'template' => [
                'variant' => 'DEFAULT_TEMPLATE',
            ],
            'order' => [
                'orderReference' => 'test order 1',
            ],
            'consumer' => [
                'firstname' => 'firstname',
                'lastname' => 'lastname',
                'contact' => [
                    'email' => 'info@example.com',
                ]
            ],
        ]],
    ],
]);

// create product reviews
$productReviews = $trustedshopsClient->getProductReviews($trustedShopId);