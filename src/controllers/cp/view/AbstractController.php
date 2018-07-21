<?php
/**
 * Created by PhpStorm.
 * User: dsmrt
 * Date: 3/9/18
 * Time: 2:48 PM
 */

namespace flipbox\saml\core\controllers\cp\view;


use flipbox\saml\core\records\ProviderInterface;
use flipbox\saml\core\Saml;
use flipbox\saml\core\traits\EnsureSamlPlugin;
use flipbox\saml\core\controllers\AbstractController as BaseController;

/**
 * Class AbstractController
 * @package flipbox\saml\core\controllers\cp\view
 */
abstract class AbstractController extends BaseController
{
    use EnsureSamlPlugin;

    const TEMPLATE_INDEX = DIRECTORY_SEPARATOR . '_cp';

    /**
     * @return string
     */
    abstract protected function getProviderRecord();

    /**
     * @return string
     */
    protected function getTemplateIndex()
    {
        return Saml::getTemplateRootKey(
            $this->getSamlPlugin()
        );
    }

    /**
     * @return array
     */
    protected function getBaseVariables()
    {
        $variables = [
            'title'              => $this->getSamlPlugin()->name,
            'pluginHandle'       => $this->getSamlPlugin()->getHandle(),
            'pluginVariable'     => $this->getSamlPlugin()->getPluginVariableHandle(),
            'ownEntityId'        => $this->getSamlPlugin()->getSettings()->getEntityId(),
            'settings'           => $this->getSamlPlugin()->getSettings(),

            // Set the "Continue Editing" URL
            'continueEditingUrl' => $this->getBaseCpPath(),
            'baseActionPath'     => $this->getBaseCpPath(),
            'baseCpPath'         => $this->getBaseCpPath(),
            'templateIndex'      => $this->getTemplateIndex(),
            'ownProvider'        => $ownProvider = $this->getSamlPlugin()->getProvider()->findOwn(),

            'actions' => [],
        ];

        $variables['selectedSubnavItem'] = $this->getSubNavKey();

        /** @var ProviderInterface $ownProvider */
        if ($ownProvider) {
            $variables = array_merge(
                $this->addUrls($ownProvider),
                $variables
            );
        }

        return $variables;
    }

    protected function getSubNavKey()
    {
        $request = \Craft::$app->request;

        $key = null;
        $path = implode('/',
            [
                $request->getSegment(2),
                $request->getSegment(3),
                $request->getSegment(4),
            ]);

        if (preg_match('#^/+$#', $path)) {
            $key = 'saml.setup';
        } elseif (preg_match('#metadata/my-provider/#', $path)) {
            $key = 'saml.myProvider';
        } elseif (preg_match('#metadata/+$#', $path)) {
            $key = 'saml.providers';

        } elseif (preg_match('#keychain/+$#', $path)) {
            $key = 'saml.keychain';
        } elseif (preg_match('#settings/+$#', $path)) {
            $key = 'saml.settings';
        }
        return $key;
    }

    /**
     * @return string
     */
    protected function getBaseCpPath(): string
    {
        return $this->getSamlPlugin()->getHandle();
    }

    /**
     * @param ProviderInterface $provider
     * @param array $variables
     * @return array
     */
    protected function addUrls(ProviderInterface $provider)
    {

        $variables = [];
        $variables['assertionConsumerServices'] = null;
        $variables['singleLogoutServices'] = null;
        $variables['singleSignOnServices'] = null;

        if (! $provider->getMetadataModel()) {
            return $variables;
        }

        $plugin = $this->getSamlPlugin();

        /**
         * Add SP URLs
         */
        if ($provider->getType() === $plugin::SP) {
            foreach (
                $provider->getMetadataModel()->getFirstSpSsoDescriptor()->getAllSingleLogoutServices()
                as $singleLogoutService
            ) {
                $variables['singleLogoutServices'][$singleLogoutService->getBinding()] =
                    $singleLogoutService->getResponseLocation();
            }

            foreach (
                $provider->getMetadataModel()->getFirstSpSsoDescriptor()->getAllAssertionConsumerServices()
                as $assertionConsumerService
            ) {
                $variables['assertionConsumerServices'][$assertionConsumerService->getBinding()] =
                    $assertionConsumerService->getLocation();
            }
        }

        /**
         * Add IDP URLs
         */
        if ($provider->getType() === $plugin::IDP) {
            foreach (
                $provider->getMetadataModel()->getFirstIdpSsoDescriptor()->getAllSingleLogoutServices()
                as $singleLogoutService
            ) {
                $variables['singleLogoutServices'][$singleLogoutService->getBinding()] =
                    $singleLogoutService->getLocation();
            }

            foreach (
                $provider->getMetadataModel()->getFirstIdpSsoDescriptor()->getAllSingleSignOnServices()
                as $signOnService
            ) {
                $variables['singleSignOnServices'][$signOnService->getBinding()] = $signOnService->getLocation();
            }
        }

        return $variables;
    }

}