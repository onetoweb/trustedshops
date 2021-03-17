<?php

namespace Onetoweb\Trustedshops;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions;

/**
 * Trustedshops Client.
 * 
 * @author Jonathan van 't Ende <jvantende@onetoweb.nl>
 * @copyright Onetoweb B.V.
 * 
 * @link https://api.trustedshops.com/documentation/restricted/
 */
class TrustedshopsClient extends BaseClient
{
    /**
     * @link https://api.trustedshops.com/documentation/restricted/#!/shops/getShopByTSID
     * 
     * @param string $trustedShopId
     * 
     * @return array|null
     */
    public function getShop(string $trustedShopId): ?array
    {
        return $this->get("shops/$trustedShopId");
    }
    
    /**
     * @link https://api.trustedshops.com/documentation/restricted/#!/reviews/retrieveReviews
     * 
     * @param string $trustedShopId
     * @param array $query = []
     *
     * @return array|null
     */
    public function getShopReviews(string $trustedShopId, array $query = []): ?array
    {
        return $this->get("shops/$trustedShopId/reviews", $query);
    }
    
    /**
     * @link https://api.trustedshops.com/documentation/restricted/#!/reviews_comments/getComment
     * 
     * @param string $trustedShopId
     * @param string $reviewId
     * @param string $commentId
     * @param array $query = []
     *
     * @return array|null
     */
    public function getShopReviewComment(string $trustedShopId, string $reviewId, string $commentId, array $query = []): ?array
    {
        return $this->get("shops/$trustedShopId/reviews/$reviewId/comments/$commentId", $query);
    }
    
    /**
     * @link https://api.trustedshops.com/documentation/restricted/#!/reviews_comments/createComment
     * 
     * @param string $trustedShopId
     * @param string $reviewId
     * @param array $data = []
     *
     * @return array|null
     */
    public function createShopReviewComment(string $trustedShopId, string $reviewId, array $data = []): ?array
    {
        return $this->post("shops/$trustedShopId/reviews/$reviewId/comments", $data);
    }
    
    /**
     * @link https://api.trustedshops.com/documentation/restricted/#!/reviews_comments/updateComment
     *
     * @param string $trustedShopId
     * @param string $reviewId
     * @param string $commentId
     * @param array $data = []
     *
     * @return array|null
     */
    public function updateShopReviewComment(string $trustedShopId, string $reviewId, string $commentId, array $data = []): ?array
    {
        return $this->put("shops/$trustedShopId/reviews/$reviewId/comments/$commentId", $data);
    }
    
    /**
     * @link https://api.trustedshops.com/documentation/restricted/#!/quality_indicators/retrieveQualityIndicator
     *
     * @param string $trustedShopId
     * @param array $query = []
     *
     * @return array|null
     */
    public function getQualityIndicators(string $trustedShopId, array $query = []): ?array
    {
        return $this->get("shops/$trustedShopId/quality", $query);
    }
    
    /**
     * @link https://api.trustedshops.com/documentation/restricted/#!/quality_indicators/retrieveComplaintQualityIndicator
     *
     * @param string $trustedShopId
     * @param array $query = []
     *
     * @return array|null
     */
    public function getQualityComplaints(string $trustedShopId, array $query = []): ?array
    {
        return $this->get("shops/$trustedShopId/quality/complaints", $query);
    }
    
    /**
     * @link https://api.trustedshops.com/documentation/restricted/#!/quality_indicators/retrieveReviewQualityIndicator
     *
     * @param string $trustedShopId
     * @param array $query = []
     *
     * @return array|null
     */
    public function getQualityReviews(string $trustedShopId, array $query = []): ?array
    {
        return $this->get("shops/$trustedShopId/quality/reviews", $query);
    }
    
    /**
     * @link https://api.trustedshops.com/documentation/restricted/#!/benchmarks/getBenchmark
     *
     * @param string $trustedShopId
     *
     * @return array|null
     */
    public function getShopBenchmarks(string $trustedShopId): ?array
    {
        return $this->get("shops/benchmarks", [
            'tsId' => $trustedShopId
        ]);
    }
    
    /**
     * @link https://api.trustedshops.com/documentation/restricted/#!/retailer_shops/getShop
     *
     * @return array|null
     */
    public function getShopRetailers(): ?array
    {
        return $this->get("retailers/shops");
    }
    
    /**
     * @link https://api.trustedshops.com/documentation/restricted/#!/review_request/submitReviewRequest
     *
     * @param string $trustedShopId
     * @param array $data = []
     *
     * @return array|null
     */
    public function createReviewRequest(string $trustedShopId, array $data = []): ?array
    {
        return $this->post("shops/$trustedShopId/reviews/requests", $data, [], true);
    }
    
    /**
     * @link https://api.trustedshops.com/documentation/restricted/#!/trigger/submitReviewCollectorRequest
     *
     * @param string $trustedShopId
     * @param array $data = []
     *
     * @return array|null
     */
    public function createReviewCollector(string $trustedShopId, array $data = []): ?array
    {
        return $this->post("shops/$trustedShopId/reviewcollector", $data, [], true);
    }
    
    /**
     * @link https://api.trustedshops.com/documentation/restricted/#!/product_reviews/retrieveProductReviews
     *
     * @param string $trustedShopId
     * @param array $query = []
     *
     * @return array|null
     */
    public function getProductReviews(string $trustedShopId, array $query = []): ?array
    {
        return $this->get("shops/$trustedShopId/products/reviews", $query);
    }
}