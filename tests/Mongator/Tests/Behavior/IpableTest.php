<?php

/*
 * This file is part of Mongator.
 *
 * (c) Pablo Díez <pablodip@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Mongator\Tests\Behavior;

use Mongator\Tests\TestCase;

class IpableTest extends TestCase
{
    public function testIpable()
    {
        $_SERVER['REMOTE_ADDR'] = '192.168.0.1';

        $document = $this->mongator->create('Model\Ipable');
        $document->setField('foo');
        $document->save();

        $this->assertSame('192.168.0.1', $document->getCreatedFrom());
        $this->assertNull($document->getUpdatedFrom());

        $_SERVER['REMOTE_ADDR'] = '192.168.0.100';

        $document->setField('bar');
        $document->save();

        $this->assertSame('192.168.0.100', $document->getUpdatedFrom());
        $this->assertSame('192.168.0.1', $document->getCreatedFrom());
    }
}
