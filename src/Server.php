<?php

namespace Slexx;

class Server
{
    /**
     * @return array
     * @example:
     * var_dump(\Slexx\Server::CPUUsage());
     * // [
     * //     'cpu' => 13202110,
     * //     'cpu0' => 3299864,
     * //     'cpu1' => 3306752,
     * //     'cpu2' => 3290429,
     * //     'cpu3' => 3305059
     * // ]
     */
    static public function CPUUsage()
    {
        $output = shell_exec('cat /proc/stat');
        $output = explode("\n", $output);

        foreach($output as $i => $line) {
            if (!preg_match('/^cpu/', $line)) {
                unset($output[$i]);
            }
        }

        $result = [];
        foreach($output as $line) {
            $parts = explode(' ', $line);
            $name = $parts[0];
            array_shift($parts);
            $total = 0;
            foreach($parts as $part) {
                $total += (int) $part;
            }
            $result[$name] = $total;
        }

        return $result;
    }

    /**
     * @return array
     * @example:
     * var_dump(\Slexx\Server::MemoryInfo());
     * // [
     * //     'ram' => [
     * //         'all' => 5667616,
     * //         'used' => 4225624,
     * //         'free' => 268476
     * //     ],
     * //     'swap' => [
     * //         'all' => 2097148,
     * //         'used' => 897792,
     * //         'free' => 1199356
     * //     ]
     * // ]
     */
    static public function MemoryInfo()
    {
        $output = shell_exec('free');
        $output = explode("\n", $output);
        $result = [
            'ram' => [],
            'swap' => [],
        ];

        $ram = explode("     ", $output[1]);
        $result['ram']['all'] = (int) $ram[1];
        $result['ram']['used'] = (int) $ram[2];
        $result['ram']['free'] = (int) $ram[3];

        $swap = explode("     ", $output[2]);
        $result['swap']['all'] = (int) $swap[1];
        $result['swap']['used'] = (int) $swap[2];
        $result['swap']['free'] = (int) $swap[3];

        return $result;
    }

    /**
     * @return string
     * @example:
     * var_dump(\Slexx\Server::PHPVersion());
     * // 7.2.14-1+ubuntu18.04.1+deb.sury.org+1
     */
    static public function PHPVersion()
    {
        return phpversion();
    }

    /**
     * @return array
     * @example:
     * var_dump(\Slexx\Server::OSInfo());
     * // [
     * //     'name' => 'Linux Mint',
     * //     'version' => '19.1 (Tessa)',
     * //     'id' => 'linuxmint',
     * //     'id_like' => 'ubuntu',
     * //     'pretty_name' => 'Linux Mint 19.1',
     * //     'version_id' => '19.1',
     * //     'home_url' => 'https://www.linuxmint.com/',
     * //     'support_url' => 'https://forums.ubuntu.com/',
     * //     'bug_report_url' => 'http://linuxmint-troubleshooting-guide.readthedocs.io/en/latest/',
     * //     'privacy_policy_url' => 'https://www.linuxmint.com/',
     * //     'version_codename' => 'tessa',
     * //     'ubuntu_codename' => 'bionic'
     * // ]
     */
    static public function OSInfo()
    {
        $os = shell_exec('cat /etc/os-release');
        $data = [];
        foreach(explode("\n", $os) as $line) {
            if (empty($line)) continue;
            list($key, $value) = explode('=', $line, 2);
            $data[mb_strtolower($key)] = trim($value, '"');
        }
        return $data;
    }

    /**
     * @return string
     * @example:
     * var_dump(\Slexx\Server::ProcessorModel());
     * // 'AMD A10-9620P RADEON R5, 10 COMPUTE CORES 4C+6G'
     */
    static public function ProcessorModel()
    {
        $file = file('/proc/cpuinfo');
        list($header, $model) = explode(': ', $file[4], 2);
        return trim($model);
    }
}

