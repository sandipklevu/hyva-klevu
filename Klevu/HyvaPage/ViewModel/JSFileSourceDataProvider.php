<?php

namespace Klevu\HyvaPage\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\ScopeInterface;

class JSFileSourceDataProvider implements ArgumentInterface
{
    protected ScopeConfigInterface $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function isUseSelfHostedApproach(): bool
    {
        if (!$this->scopeConfig->isSetFlag(
            'klevu_search/developer/use_self_host',
            ScopeInterface::SCOPE_STORE
        )) {
            return false;
        }

        return true;
    }
}
