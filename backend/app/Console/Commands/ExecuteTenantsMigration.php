<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class ExecuteTenantsMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'すべてのテナントスキーマのマイグレーションを実行する';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tenantSchemas = ['tenant_0001', 'tenant_0002']; // データベースから取得する

        foreach ($tenantSchemas as $tenantSchema) {
            $this->info("{$tenantSchema}のマイグレーションを実行します");

            Config::set('database.connections.tenant.database', $tenantSchema);

            $exitCode = $this->call('migrate', ['--database' => 'tenant']);
            if ($exitCode !== 0) {
                return 1;
            }
        }

        return 0;
    }
}
