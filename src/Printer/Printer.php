<?php

namespace Cblink\Verider\Printer;

use Cblink\Verider\Client;

class Printer extends Client
{
    public function bindMachine($machine_no, $machine_secret)
    {
        return $this->json('/api/bind_machine', compact('machine_no', 'machine_secret'));
    }

    public function getPrinters($machine_no)
    {
        return $this->json('/api/list_devices', compact('machine_no'));
    }

    public function createPrinterTask($device_no, $print_content, $print_id)
    {
        return $this->json('/api/print', compact('device_no', 'print_content', 'print_id'));
    }

    public function getMachineStatusByMachineCode($device_no)
    {
        return $this->json('/api/device_status', compact('device_no'));
    }
}