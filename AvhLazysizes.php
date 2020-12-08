<?php

namespace AvhLazysizes;

use Doctrine\Common\Collections\ArrayCollection;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;
use Shopware\Components\Theme\LessDefinition;

class AvhLazysizes extends Plugin
{

    public function install(InstallContext $context)
    {
        $context->scheduleClearCache(InstallContext::CACHE_LIST_FRONTEND);
    }

    public function activate(ActivateContext $context)
    {
        $context->scheduleClearCache(ActivateContext::CACHE_LIST_FRONTEND);
    }

    public function uninstall(UninstallContext $context)
    {
        $context->scheduleClearCache(UninstallContext::CACHE_LIST_FRONTEND);
    }

    /**
     * @return array|string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onPostDispatch',
            'Enlight_Controller_Action_PostDispatch_Frontend' => 'onPostDispatch',
            'Enlight_Controller_Action_PreDispatchSecure_Widgets' => 'onPostDispatch',
            'Enlight_Controller_Action_PreDispatch_Widgets' => 'onPostDispatch',
            'Theme_Compiler_Collect_Plugin_Javascript' => 'addJsFiles',
            'Theme_Compiler_Collect_Plugin_Less' => 'addLessFiles'
        ];
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     */
    public function onPostDispatch(\Enlight_Event_EventArgs $args): void
    {
        $controller = $args->get('subject');
        $controller->View()->addTemplateDir(__DIR__ . '/Resources/views');
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     * @return ArrayCollection
     */
    public function addJsFiles(\Enlight_Event_EventArgs $args): ArrayCollection
    {
        $jsFiles = array(__DIR__ . '/Resources/views/frontend/_public/src/js/lazysizesConfig.js',
            __DIR__ . '/Resources/views/frontend/_public/vendors/lazysizes/lazysizes.js',
            __DIR__ . '/Resources/views/frontend/_public/src/js/lazysizesbg.js');
        return new ArrayCollection($jsFiles);
    }

    /**
     * @return ArrayCollection
     */
    public function addLessFiles(): ArrayCollection
    {
        $less = new LessDefinition(
            array(),
            array(__DIR__ . '/Resources/views/frontend/_public/src/less/all.less'),
            __DIR__
        );
        return new ArrayCollection([$less]);
    }

}
