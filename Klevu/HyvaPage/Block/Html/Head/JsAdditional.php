<?php

namespace Klevu\HyvaPage\Block\Html\Head;

use Klevu\Registry\Api\CategoryRegistryInterface;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class JsAdditional extends Template
{

    /**
     * @var CategoryRegistryInterface
     */
    private $categoryRegistry;

    /**
     * @var CategoryCollectionFactory
     */
    private $categoryCollectionFactory;

    /**
     * @var string
     */
    private $fullCategoryPath;

    /**
     * @param Context $context
     * @param CategoryRegistryInterface $categoryRegistry
     * @param CategoryCollectionFactory $categoryCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        CategoryRegistryInterface $categoryRegistry,
        CategoryCollectionFactory $categoryCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->categoryRegistry = $categoryRegistry;
        $this->categoryCollectionFactory = $categoryCollectionFactory;
    }

    /**
     * @return string
     */
    public function getFullCategoryPath()
    {
        if (null === $this->fullCategoryPath) {
            $this->fullCategoryPath = '';

            $category = $this->categoryRegistry->getCurrentCategory();
            if ($category) {
                $categoryPathIds = array_map('intval', $category->getPathIds());
                unset($categoryPathIds[0], $categoryPathIds[1]);

                $categoryNames = (count($categoryPathIds) === 1)
                    ? [$category->getName()]
                    : $this->getCategoryNamesById($categoryPathIds);

                $this->fullCategoryPath = implode(';', $categoryNames);
            }
        }

        return $this->fullCategoryPath;
    }

    /**
     * @param int[] $categoryIds
     *
     * @return string[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function getCategoryNamesById(array $categoryIds)
    {
        $categoryCollection = $this->categoryCollectionFactory->create();
        $categoryCollection->addFieldToFilter('entity_id', ['in' => $categoryIds]);
        $categoryCollection->addAttributeToSelect('name');

        $return = [];
        foreach ($categoryIds as $categoryId) {
            $category = $categoryCollection->getItemById($categoryId);
            $return[$categoryId] = $category
                ? (string)$category->getDataUsingMethod('name')
                : '';
        }

        return $return;
    }

    /**
     * {@inheritdoc}
     * @return string
     */
    protected function _toHtml()
    {
        try {
            $store = $this->_storeManager->getStore();
            $storeId = (int)$store->getId();
        } catch (NoSuchEntityException $e) {
            $this->_logger->error($e->getMessage());

            return '';
        }

        if (!$this->getFullCategoryPath()) {
            return '';
        }

        return parent::_toHtml();
    }
}
