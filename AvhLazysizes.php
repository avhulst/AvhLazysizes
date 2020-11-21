<?php

namespace AvhLazysizes;

use Doctrine\Common\Collections\ArrayCollection;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Theme\LessDefinition;

class AvhLazysizes extends Plugin
{

    public function install(InstallContext $context)
    {
        $context->scheduleClearCache(InstallContext::CACHE_LIST_FRONTEND);
    }

    public function activate(InstallContext $context)
    {
        $context->scheduleClearCache(InstallContext::CACHE_LIST_FRONTEND);
    }

    public function uninstall(InstallContext $context)
    {
        $context->scheduleClearCache(InstallContext::CACHE_LIST_FRONTEND);
    }

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatch_Frontend' => 'onPostDispatch',
            'Enlight_Controller_Action_PostDispatch_Widgets' => 'onPostDispatch',
            'Theme_Compiler_Collect_Plugin_Javascript' => 'addJsFiles',
            'Theme_Compiler_Collect_Plugin_Less' => 'addLessFiles'
        ];
    }

    public function onPostDispatch(\Enlight_Event_EventArgs $args)
    {
        $controller = $args->getSubject();
        $controller->View()->addTemplateDir(__DIR__ . '/Resources/views');
    }

    public function addJsFiles(\Enlight_Event_EventArgs $args)
    {
        $jsFiles = array(__DIR__ . '/Resources/views/frontend/_public/src/js/lazysizesConfig.js',
            __DIR__ . '/Resources/views/frontend/_public/vendors/lazysizes/lazysizes.js',
            __DIR__ . '/Resources/views/frontend/_public/src/js/lazysizesbg.js');
        return new ArrayCollection($jsFiles);
    }

    public function addLessFiles()
    {
        $less = new LessDefinition(
            array(),
            array(__DIR__ . '/Resources/views/frontend/_public/src/less/all.less'),
            __DIR__
        );
        return new ArrayCollection([$less]);
    }

}
