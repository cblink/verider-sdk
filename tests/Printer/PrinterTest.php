<?php

namespace Cblink\Verider\Test\Printer;

use Cblink\Verider\Test\TestCase;
use Cblink\Verider\Printer\Printer;

class PrinterTest extends TestCase
{
    /** @test */
    public function accountVerification()
    {
        $this->make(Printer::class)
            ->accountVerification()
            ->assertPostUri('/cp/user/valid')
            ->assertPostJson([]);
    }

    /** @test */
    public function bindMachine()
    {
        $this->make(Printer::class)
            ->bindMachine('test-machine_no', 'test-machine_secret')
            ->assertPostUri('/cp/machine/bind')
            ->assertPostJson([
                'machine_no' => 'test-machine_no',
                'machine_secret' => 'test-machine_secret',
            ]);
    }

    /** @test */
    public function getPrintersByMachineNo()
    {
        $this->make(Printer::class)
            ->getPrintersByMachineNo('test-machine_no')
            ->assertPostUri('/cp/device/list')
            ->assertPostJson([
                'machine_no' => 'test-machine_no',
            ]);
    }

    /** @test */
    public function createPrinterTask()
    {
        $this->make(Printer::class)
            ->createPrinterTask('test-device_no', 'test-print_content', 'test-print_id')
            ->assertPostUri('/cp/device/print')
            ->assertPostJson([
                'device_no' => 'test-device_no',
                'print_content' => 'test-print_content',
                'print_id' => 'test-print_id',
            ]);
    }

    /** @test */
    public function getMachineStatusByMachineCode()
    {
        $this->make(Printer::class)
            ->getMachineStatusByMachineCode('test-device_no')
            ->assertPostUri('/cp/device/status')
            ->assertPostJson([
                'device_no' => 'test-device_no',
            ]);
    }
}