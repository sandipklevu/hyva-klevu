<?php

namespace Klevu\HyvaPage\Service;

use Klevu\FrontendJs\Api\InteractiveOptionsProviderInterface;
use Klevu\FrontendJs\Api\IsEnabledConditionInterface;
use Klevu\Search\Helper\Config as ConfigHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class InteractiveOptionsProvider implements InteractiveOptionsProviderInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var IsEnabledConditionInterface
     */
    private $isEnabledCondition;

    /**
     * @param IsEnabledConditionInterface $isEnabledCondition
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        IsEnabledConditionInterface $isEnabledCondition
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->isEnabledCondition = $isEnabledCondition;
    }

    /**
     * @param int|null $storeId
     *
     * @return array[]
     */
    public function execute($storeId = null)
    {
        // Ensure the configuration overrides should be sent, based on the IsEnabledCondition
        //  defined in di.xml
        if (!$this->isEnabledCondition->execute($storeId)) {
            return [];
        }
        $apiKey = $this->scopeConfig->getValue(
            ConfigHelper::XML_PATH_JS_API_KEY,
            ScopeInterface::SCOPE_STORES,
            $storeId
        );

        return [
            'theme' => [
                'modules' => [
                    'resultInfiniteScroll' => [
                            'quickSearch' => ['enable' => false], //Make it true only if you want scroll on quick search
                            'searchResultsPage' => ['enable' => false], //Make it true only if you want scroll on Search page
                            'categoryPage' => ['enable' => false],
                        ]
                ]
            ]
        ];
    }
}

