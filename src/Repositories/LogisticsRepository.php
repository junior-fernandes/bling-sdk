<?php

namespace Bling\Repositories;

use Spatie\ArrayToXml\ArrayToXml;

class LogisticsRepository extends BaseRepository
{
    public function allServices(): ?Object
    {
        $options = [];

        return $this->client->get('logisticas/servicos/json/', $options);
    }

    public function findService(int $id): ?Object
    {
        $options = [];

        return $this->client->get("logistica/$id/servicos/json/", $options);
    }

    public function createService(array $params): ?Object
    {
        $options = [];

        $rootElement = array_key_first($params);

        $xml = ArrayToXml::convert($params[$rootElement], $rootElement);

        $options['xml'] = $xml;

        return $this->client->post("logistica/servicos/json/", $options);
    }

    public function updateService(int $id, array $params): ?Object
    {
        $options = [];

        $rootElement = array_key_first($params);

        $xml = ArrayToXml::convert($params[$rootElement], $rootElement);

        $options['xml'] = $xml;

        return $this->client->put("logistica/$id/servicos/json/", $options);
    }

    public function createTrackingEvent(string $codigo, array $params): ?Object
    {
        $options = [];

        $rootElement = array_key_first($params);

        $xml = ArrayToXml::convert($params[$rootElement], $rootElement);

        $options['xml'] = $xml;

        return $this->client->post("logistica/evento/$codigo/json/", $options);
    }

    public function updateOrderTracking(int $numero, array $params): ?Object
    {
        $options = [];

        $rootElement = array_key_first($params);

        $xml = ArrayToXml::convert($params[$rootElement], $rootElement);

        $options['xml'] = $xml;

        return $this->client->post("logistica/rastreamento/pedido/$numero/json/", $options);
    }

    public function updateNFeTracking(int $numero, int $serie, array $params): ?Object
    {
        $options = [];

        $rootElement = array_key_first($params);

        $xml = ArrayToXml::convert($params[$rootElement], $rootElement);

        $options['xml'] = $xml;

        return $this->client->post("logistica/rastreamento/notafiscal/$numero/$serie/json/", $options);
    }
}