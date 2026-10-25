<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Illuminate\Console\Command;

/**
 * Turn "under construction" on/off and manage the allowed IPs.
 *   php artisan site:construction status
 *   php artisan site:construction on|off
 *   php artisan site:construction allow 1.2.3.4 --label="office"
 *   php artisan site:construction deny 1.2.3.4
 */
class SiteConstruction extends Command
{
    protected $signature = 'site:construction
        {action=status : status, on, off, allow or deny}
        {ip? : IP or range (1.2.3.0/24) for allow/deny}
        {--label= : Note saved next to an allowed IP}';

    protected $description = 'Show or change the "under construction" mode';

    public function handle(): int
    {
        $ips = array_filter(preg_split('/\R/', (string) Setting::get('maintenance_ips', '')) ?: []);

        switch ($this->argument('action')) {
            case 'on':
            case 'off':
                $this->save('maintenance_enabled', $this->argument('action') === 'on' ? '1' : '0');
                break;
            case 'allow':
                $ip = (string) $this->argument('ip');
                if (! $this->validIp($ip)) {
                    $this->error('Give a valid IP or range.');

                    return self::FAILURE;
                }
                $ips[] = trim($ip.($this->option('label') ? ' # '.$this->option('label') : ''));
                $this->save('maintenance_ips', implode("\n", array_unique($ips)));
                break;
            case 'deny':
                $ip = (string) $this->argument('ip');
                $ips = array_filter($ips, fn ($line) => trim(explode('#', $line, 2)[0]) !== $ip);
                $this->save('maintenance_ips', implode("\n", $ips));
                break;
            case 'status':
                break;
            default:
                $this->error('Unknown action.');

                return self::FAILURE;
        }

        $on = Setting::get('maintenance_enabled', '1') === '1';
        $this->line('Under construction: '.($on ? 'ON (visitors see the waiting page)' : 'OFF (site is public)'));
        $this->line('Allowed IPs: '.(Setting::get('maintenance_ips') ? "\n  ".str_replace("\n", "\n  ", Setting::get('maintenance_ips')) : 'none'));
        $this->line(config('shop.preview_token')
            ? 'Preview link: '.url('/preview/'.config('shop.preview_token'))
            : 'Preview link: none (set UNDER_CONSTRUCTION_TOKEN in .env)');

        return self::SUCCESS;
    }

    private function save(string $key, string $value): void
    {
        Setting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
    }

    private function validIp(string $value): bool
    {
        [$ip, $bits] = array_pad(explode('/', $value, 2), 2, null);
        if (! filter_var($ip, FILTER_VALIDATE_IP)) {
            return false;
        }

        return $bits === null || (ctype_digit($bits) && (int) $bits <= (str_contains($ip, ':') ? 128 : 32));
    }
}
