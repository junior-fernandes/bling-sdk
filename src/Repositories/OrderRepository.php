<?php

namespace Bling\Repositories;

use Spatie\ArrayToXml\ArrayToXml;

class OrderRepository extends BaseRepository
{
    public function all(array $filters = [], bool $historico = false, $page = 1): ?Object
    {
        $options = [];

        if($historico) {
            $options['historico'] = 'true';
        }

        foreach ($filters as $k => $v) {
            $filters[$k] = $k.'['.$v.']';
        }

        if(count($filters)) {
            $options['filters'] = implode('; ', $filters);
        }

        return $this->client->get('pedidos/page='.$page.'/json/', $options);
    }

    public function situacoes(): ?Object
    {
        return $this->client->get('situacao/Vendas/json/', $options);
    }

    public function find(int $numero, bool $historico = false): ?Object
    {
        $options = [];

        if($historico) {
            $options['historico'] = 'true';
        }

        return $this->client->get("pedido/$numero/json/", $options);
    }

    public function create(array $params, bool $gerarnfe = false): ?Object
    {
        $options = [];

        $rootElement = array_key_first($params);

        $xml = ArrayToXml::convert($params[$rootElement], $rootElement);

        $options['xml'] = $xml;

        if($gerarnfe) {
            $options['gerarnfe'] = 'true';
        }

        return $this->client->post('pedido/json/', $options);
    }

    public function update(int $numero, array $params): ?Object
    {
        $options = [];

        $rootElement = array_key_first($params);

        $xml = ArrayToXml::convert($params[$rootElement], $rootElement);

        $options['xml'] = $xml;

        return $this->client->put("pedido/$numero/json/", $options);
    }
}