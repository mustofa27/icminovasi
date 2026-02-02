<?php

namespace App\View\Composers;

use Illuminate\View\View;

class PublicLayoutComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with([
            'testimonials' => $view->getData()['testimonials'] ?? collect(),
            'featured_projects' => $view->getData()['featured_projects'] ?? collect(),
            'all_projects' => $view->getData()['all_projects'] ?? collect(),
            'clients' => $view->getData()['clients'] ?? collect(),
            'settings' => $view->getData()['settings'] ?? new \App\Models\Setting(\App\Models\Setting::defaults()),
            'stats' => $view->getData()['stats'] ?? [
                'total_projects' => 0,
                'total_clients' => 0,
                'expertise_areas' => 3,
            ],
        ]);
    }
}
