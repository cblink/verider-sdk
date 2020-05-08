<?php

namespace Cblink\Verider\Printer;

use Cblink\Verider\Client;

class Printer extends Client
{
    public function accountVerification()
    {
        return $this->json('/cp/user/valid');
    }

    public function bindMachine($machine_no, $machine_secret)
    {
        return $this->json('/cp/machine/bind', compact('machine_no', 'machine_secret'));
    }

    public function unbindMachine($machine_no)
    {
        return $this->json('cp/machine/unbind', compact('machine_no'));
    }

    public function getPrintersByMachineNo($machine_no)
    {
        return $this->json('/cp/device/list', compact('machine_no'));
    }

    public function createPrinterTask($device_no, $print_content, $print_id)
    {
        return $this->json('/cp/device/print', compact('device_no', 'print_content', 'print_id'));
    }

    public function getMachineStatusByMachineCode($device_no)
    {
        return $this->json('/cp/device/status', compact('device_no'));
    }
}