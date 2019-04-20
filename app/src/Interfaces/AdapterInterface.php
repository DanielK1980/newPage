<?php
namespace src\Interfaces;

interface AdapterInterface
{
    /**
     * @param string $url
     *
     * @throws \RuntimeException|ExceptionInterface
     *
     * @return string
     */
    public function get($url);
    /**
     * @param string $url
     * @param array $content (optional)
     *
     * @throws \RuntimeException|ExceptionInterface
     */
    public function delete($url, $content = '');
    /**
     * @param string $url
     * @param array  $headers (optional)
     * @param string $content (optional)
     *
     * @throws \RuntimeException|ExceptionInterface
     *
     * @return string
     */
    public function put($url, $content = '');
    /**
     * @param string $url
     * @param array  $headers (optional)
     * @param string $content (optional)
     *
     * @throws \RuntimeException|ExceptionInterface
     *
     * @return string
     */
    public function post($url, $content = '');
}

