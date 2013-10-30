<?php

namespace Ushios\Bundle\ElasticSearchBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Definition;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class UshiosElasticSearchExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        
        if (!empty($config['client'])){
            $this->clientSettings($config['client'], $container);
        }
        
        $loader->load('services.yml');
    }
    
    /**
     * Reading the config.yml for aws-sdk client.
     * @param array $configs
     * @param ContainerBuilder $container
     */
    protected function clientSettings(array $configs, ContainerBuilder $container)
    {
        foreach($configs as $key => $infos){
            $clientDefinition = new Definition();
            $clientDefinition->setClass($infos['class']);
            
            $hostsSettings = $this->hostSettings($infos);
            $logPathSettings = $this->logPathSettings($infos);
            $logLevelSettings = $this->logLevelSettings($infos);
            
            $options = array(
                            'hosts' => $hostsSettings,
                            'logPath' => $logPathSettings,
                            'logLevel' => $logLevelSettings
                            );
            
            $clientDefinition->setArguments(array($options));
            
            $clientServiceId = 'ushios_elastic_search_client';
            if ($key == 'default'){
                $container->setDefinition($clientServiceId, $clientDefinition);
                $clientServiceId = $clientServiceId.'.default';
            }else{
                $clientServiceId = $clientServiceId.'.'.$key;
            }
    
            $container->setDefinition($clientServiceId, $clientDefinition);
        }
    }
    
    /**
     * Make host settings
     * @param array $infos
     */
    protected function hostSettings(array $infos)
    {
        return $infos['hosts'];
    }
    
    /**
     * Make logPath settings
     * @param array $infos
     */
    protected function logPathSettings(array $infos)
    {
        return $infos['log_path'];
    }
    
    /**
     * Make logLevel settings
     * @param array $infos
     */
    protected function logLevelSettings(array $infos)
    {
        return $infos['log_level'];
    }
}
