<?php

namespace Database\Seeders;

use App\Models\CatalogSector;
use App\Models\CatalogVariant;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        $catalog = config('catalog', []);
        $order   = 0;

        foreach ($catalog as $sectorKey => $sectorData) {
            $sector = CatalogSector::updateOrCreate(
                ['key' => $sectorKey],
                [
                    'label'        => $sectorData['label'],
                    'icon'         => $sectorData['icon'] ?? '🏢',
                    'template_key' => $sectorData['template'],
                    'sort_order'   => $order++,
                ]
            );

            $vOrder = 0;
            foreach ($sectorData['variants'] ?? [] as $variantKey => $variantData) {
                CatalogVariant::updateOrCreate(
                    ['sector_id' => $sector->id, 'key' => $variantKey],
                    [
                        'label'       => $variantData['label'],
                        'color'       => $variantData['color'] ?? '#2d2d2d',
                        'typography'  => $variantData['typography'] ?? ['heading' => 'Inter', 'body' => 'Inter'],
                        'placeholder' => $variantData['placeholder'] ?? '',
                        'defaults'    => $variantData['defaults'] ?? null,
                        'sort_order'  => $vOrder++,
                        'is_active'   => true,
                    ]
                );
            }
        }
    }
}
