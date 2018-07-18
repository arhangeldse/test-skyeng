<?php

namespace src\Integration;

class DataProvider
{
    /** @var string $host */
    private $host;
    /** @var string $user */
    private $user;
    /** @var string $password */
    private $password;

    /**
     * @param string $host
     * @param string $user
     * @param string $password
     */
    public function __construct(string $host, string $user, string $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @param array $request
     *
     * @return array
     */
    public function get(array $request)
    {
        // returns a response from external service
    }
}