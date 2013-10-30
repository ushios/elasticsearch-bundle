elasticsearch-bundle
==========

Create [ElasticSearch](http://www.elasticsearch.org/) client using 'config.yml'

---

# Installation

### composer.json

    # composer.json
    
    "require": {
    	"ushios/elasticsearch-bundle": "0.0.*"
    	...
    }

and run `composer update` command.

### AppKernel.php

    # app/AppKernel.php
    
    public function registerBundles()
    {
        bundles = array(
            // ...
            new Ushios\Bundle\ElasticSearchBundle\UshiosElasticSearchBundle(),
        );
        
        retrun bundles();
    }


# Configuration

config.yml

    # app/config/config.php
    
    ushios_elastic_search:
        client:
            default:
                hosts: [ "localhost" ] # Require
            named:
                class: Your\ElasticSearch\Client
                hosts: [ "localhost", "127.0.0.1","localhost:9200", "127.0.0.1:9201" ]
                log_path: elasticsearch.log # Optional
                log_level: Logger::WARNING # Optional

## Defaults

@see [ElasticSearch PHP API -full list of configrations-](http://www.elasticsearch.org/guide/en/elasticsearch/client/php-api/current/_configuration.html#_full_list_of_configurations)

# Usage

## Get client from service.

Using default settings ElasticSearch client.

    # Bundle/Controller/Controller.php

	public function fooAction()
    {
        $es = $this->container->get('ushios_elastic_search_client');
        // or
        $es = $this->container->get('ushios_elastic_search_client.default');
    }

Using named settings. 

    # Bundle/Controller/Controller.php

	public function fooAction()
    {
        $es = $this->container->get('ushios_elastic_search_client.named');
        get_class($es); // Your\ElasticSearch\Client
    }

## Client

@see [elasticsearch/elasticsearch web site](https://github.com/elasticsearch/elasticsearch-php) or [Documentation](http://www.elasticsearch.org/guide/en/elasticsearch/client/php-api/current/index.html)