<?php

namespace Bling\Repositories;

use Spatie\ArrayToXml\ArrayToXml;

class NFSeRepository extends BaseRepository
{
    public function all(array $filters = []): ?Object
    {
        $options = [];

        foreach ($filters as $k => $v) {
            $filters[$k] = $k.'['.$v.']';
        }

        if(count($filters)) {
            $options['filters'] = implode('; ', $filters);
        }

        return $this->client->get('notaservico/json/', $options);
    }

    public function find(int $numero): ?Object
    {
        return $this->client->get("notaservico/$numero/json/");
    }

    public function create(array $params): ?Object
    {
        $options = [];

        $rootElement = array_key_first($params);

        $xml = ArrayToXml::convert($params[$rootElement], $rootElement);

        $options['xml'] = $xml;

        return $this->client->post('notaservico/json/', $options);
    }

    public function send(int $numero, int $serie): ?Object
    {
        $options = [];

        $options['number'] = $numero;
        $options['serie'] = $serie;

        return $this->client->post("notaservico/$numero/$serie/json/", $options);
    }
}