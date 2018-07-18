
<?php

namespace src\Decorator;

use DateTime;
use Exception;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use src\Integration\DataProvider;

class DecoratorManager extends DataProvider
{
    /** @var CacheItemPoolInterface $cache*/
    public $cache;
    /** @var LoggerInterface|null $logger*/
    public $logger;

    /**
     * @param string $host
     * @param string $user
     * @param string $password
     * @param CacheItemPoolInterface $cache
     */
    public function __construct(string $host, string $user, string $password, CacheItemPoolInterface $cache, LoggerInterface $logger)
    {
        parent::__construct($host, $user, $password);
        $this->cache = $cache;
        $this->logger = $logger;
    }

    /**
     * @param array $input
     * @return array
     */
    public function getResponse(array $input)
    {
        try {
            $cacheKey = $this->getCacheKey($input);
            $cacheItem = $this->cache->getItem($cacheKey);
                if ($cacheItem->isHit()) {
                return $cacheItem->get();
            }

            $result = parent::get($input);

            $cacheItem
                ->set($result)
                ->expiresAt(
                    (new DateTime())->modify('+1 day')
                );

            $this->cache->save($cacheItem);

            return $result;
        } catch (Exception $e) {
            $this->logger->critical($e->getMessage(), ['exception' => $e]);
        }

        return [];
    }

    /**
     * @param array $input
     * @return string
     */
    public function getCacheKey(array $input)
    {
        return hash('sha512', $input);
    }
}