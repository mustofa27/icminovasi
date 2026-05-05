<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE projects MODIFY area_of_expertise TEXT NOT NULL');
        } elseif ($driver === 'pgsql') {
            DB::statement('ALTER TABLE projects ALTER COLUMN area_of_expertise TYPE TEXT');
        }

        DB::table('projects')
            ->select(['id', 'area_of_expertise'])
            ->orderBy('id')
            ->chunkById(100, function ($projects): void {
                foreach ($projects as $project) {
                    $value = $project->area_of_expertise;
                    $decoded = is_string($value) ? json_decode($value, true) : null;

                    if (is_array($decoded)) {
                        continue;
                    }

                    $areas = is_string($value) && $value !== '' ? [$value] : [];

                    DB::table('projects')
                        ->where('id', $project->id)
                        ->update(['area_of_expertise' => json_encode($areas)]);
                }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $allowed = ['informatics', 'creative', 'mechatronics'];

        DB::table('projects')
            ->select(['id', 'area_of_expertise'])
            ->orderBy('id')
            ->chunkById(100, function ($projects) use ($allowed): void {
                foreach ($projects as $project) {
                    $value = $project->area_of_expertise;
                    $areas = is_string($value) ? json_decode($value, true) : null;

                    $single = 'informatics';

                    if (is_array($areas) && !empty($areas) && in_array($areas[0], $allowed, true)) {
                        $single = $areas[0];
                    }

                    DB::table('projects')
                        ->where('id', $project->id)
                        ->update(['area_of_expertise' => $single]);
                }
            });

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE projects MODIFY area_of_expertise ENUM('informatics','creative','mechatronics') NOT NULL");
        }
    }
};
