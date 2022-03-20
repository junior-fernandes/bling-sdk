<?php

namespace Bling\Repositories;

use Spatie\ArrayToXml\ArrayToXml;

class ProductRepository extends BaseRepository
{
    public function all($page = 1): ?Object
    {
        // $options['page'] = $page;

        return $this->client->get("produtos/page={$page}/json/");

    }

    public function find(string $codigo, bool $estoque = false, string $loja = null, bool $imagem = false): ?Object
    {
        $options = [];

        if($estoque) {
            $options['estoque'] = 'S';
        }

        if($loja) {
            $options['loja'] = $loja;
        }

        if($imagem) {
            $options['imagem'] = 'S';
        }

        return $this->client->get("produto/$codigo/json/", $options);
    }

    public function findByProvider(string $codigo, string $idFornecedor, bool $estoque = false, string $loja = null, bool $imagem = false): ?Object
    {
        $options = [];

        if($estoque) {
            $options['estoque'] = 'S';
        }

        if($loja) {
            $options['loja'] = $loja;
        }

        if($imagem) {
            $options['imagem'] = 'S';
        }

        return $this->client->get("produto/$codigo/json/", $options);
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