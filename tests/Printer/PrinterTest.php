<?php

namespace Cblink\Verider\Test\Printer;

use Cblink\Verider\Test\TestCase;
use Cblink\Verider\Printer\Printer;

class PrinterTest extends TestCase
{
    /** @test */
    public function bindMachine()
    {
        $client = $this->make(Printer::class);

        $client->bindMachine('test-machine_no', 'test-machine_secret')
            ->assertPostUri('/api/bind_machine')
            ->assertPostJson([
                'machine_no' => 'test-machine_no',
                'machine_secret' => 'test-machine_secret',
            ]);
    }

    /** @test */
    public function getPrintersByMachineNo()
    {
        $client = $this->make(Printer::class);

        $client->getPrintersByMachineNo('test-machine_no')
            ->assertPostUri('/api/list_devices')
            ->assertPostJson([
                'machine_no' => 'test-machine_no',
            ]);
    }

    /** @test */
    public function createPrinterTask()
    {
        $client = $this->make(Printer::class);

        $client->createPrinterTask('test-device_no', 'test-print_content', 'test-print_id')
            ->assertPostUri('/api/print')
            ->assertPostJson([
                'device_no' => 'test-device_no',
                'print_content' => 'test-print_content',
                'print_id' => 'test-print_id',
            ]);
    }

    /** @test */
    public function getMachineStatusByMachineCode()
    {
        $client = $this->make(Printer::class);

        $client->getMachineStatusByMachineCode('test-device_no')
            ->assertPostUri('/api/device_status')
            ->assertPostJson([
                'device_no' => 'test-device_no',
            ]);
    }
}