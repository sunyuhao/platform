<?php

namespace Oro\Bundle\ApiBundle\Tests\Unit\Processor\Shared;

use Oro\Bundle\ApiBundle\Processor\Shared\RestoreDefaultFormExtension;
use Oro\Bundle\ApiBundle\Tests\Unit\Processor\FormProcessorTestCase;

class RestoreDefaultFormExtensionTest extends FormProcessorTestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $formExtensionSwitcher;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $metadataTypeGuesser;

    /** @var RestoreDefaultFormExtension */
    protected $processor;

    public function setUp()
    {
        parent::setUp();

        $this->formExtensionSwitcher = $this->getMock('Oro\Bundle\ApiBundle\Form\FormExtensionSwitcherInterface');
        $this->metadataTypeGuesser = $this
            ->getMockBuilder('Oro\Bundle\ApiBundle\Form\Guesser\MetadataTypeGuesser')
            ->disableOriginalConstructor()
            ->getMock();

        $this->processor = new RestoreDefaultFormExtension(
            $this->formExtensionSwitcher,
            $this->metadataTypeGuesser
        );
    }

    public function testProcess()
    {
        $this->formExtensionSwitcher->expects($this->once())
            ->method('switchToDefaultFormExtension');
        $this->metadataTypeGuesser->expects($this->once())
            ->method('setMetadataAccessor')
            ->with(null);

        $this->processor->process($this->context);
    }
}
