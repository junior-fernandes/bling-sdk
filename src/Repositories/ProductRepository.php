<?php

namespace Bling\Repositories;

use Spatie\ArrayToXml\ArrayToXml;

class ProductRepository extends BaseRepository
{
    public function all(array $filters = [], $page = 1): ?Object
    {

        $options = [];

        foreach ($filters as $k => $v) {
            $filters[$k] = $k.'['.$v.']';
        }

        if(count($filters)) {
            $options['filters'] = implode('; ', $filters);
        }

        return $this->client->get('produtos/page='.$page.'/json/', $options);

    }

    public function find(string $codigo): ?Object
    {
        return $this->client->get("produto/$codigo/json/");
    }

    public function create(array $params): ?Object
    {
        $options = [];

        $rootElement = array_key_first($params);

        $xml = ArrayToXml::convert($params[$rootElement], $rootElement);

        $options['xml'] = $xml;

        return $this->client->post('produto/json/', $options);
    }

    public function update(string $codigo, array $params): ?Object
    {
        $options = [];

        $rootElement = array_key_first($params);

        $xml = ArrayToXml::convert($params[$rootElement], $rootElement);

        $options['xml'] = $xml;

        return $this->client->post("produto/$codigo/json/", $options);
    }

    public function delete(string $codigo): ?Object
    {
        return $this->client->delete("produto/$codigo/json/");
    }
    
}