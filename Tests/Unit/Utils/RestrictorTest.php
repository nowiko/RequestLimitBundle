<?php

namespace NW\RequestLimitBundle\Tests\Unit\Utils;

use NW\RequestLimitBundle\Exception\RequestLimitReachedException;
use NW\RequestLimitBundle\Storage\StorageManager;
use NW\RequestLimitBundle\Utils\Restrictor;

/**
 * Class RestrictorTest
 * @package NW\RequestLimitBundle\Tests\Unit\Utils
 * @author Novikov Viktor
 */
class RestrictorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Successful behavior of 'blockBy' method - setting user identifier as block artifact for the first time
     */
    public function testBlockSuccess()
    {
        $restrictor = new Restrictor($this->getStorageManagerMock());
        $result = $restrictor->blockBy('userId');
        $this->assertEquals('userId', $result);
    }

    /**
     * Successful behavior of 'blockBy' method - user is blocked, when trying to access the same method again
     */
    public function testBlockLimitReachedException()
    {
        $this->setExpectedException(RequestLimitReachedException::class);
        $storageManager = $this->getStorageManagerMock('userId', true);
        $storageManager->expects($this->never())->method('setItem');
        $storageManager->expects($this->never())->method('getItem');
        $restrictor = new Restrictor($storageManager);
        $restrictor->blockBy('userId');
    }

    /**
     * @param mixed $item
     * @param false $hasItem
     *
     * @return StorageManager|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getStorageManagerMock($item = 'userId', $hasItem = false)
    {
        $storageManager = $this->createMock(
            StorageManager::class,
            [],
            [],
            '',
            false
        );
        $storageManager->expects($this->once())
            ->method('hasItem')
            ->willReturn($hasItem);
        if ($hasItem) {
            return $storageManager;
        }
        $storageManager->expects($this->once())
            ->method('setItem');
        $storageManager->expects($this->once())
            ->method('getItem')
            ->willReturn($item);

        return $storageManager;
    }
}
