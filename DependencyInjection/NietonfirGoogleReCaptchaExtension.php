<?php

namespace Nietonfir\Google\ReCaptchaBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class NietonfirGoogleReCaptchaExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // set the reCAPTCHA API key
        $container->setParameter('nietonfir_google_recaptcha.sitekey', $config['sitekey']);

        // set required validation parameters
        foreach($config['validation'] as $k => $v) {
            $container->setParameter('nietonfir_google_recaptcha.validation.' . $k, $v);
        }

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }

    public function getAlias()
    {
        return 'nietonfir_google_recaptcha';
    }
}
