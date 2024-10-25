<?php

namespace App\Models\Traits;


trait ViewsIncrementTrait
{
    public function viewsCount()
    {
        $this->view_per_day++;
        $this->view_per_week++;
        $this->view_per_month++;
        $this->view_per_all++;

        $this->save();
    }

    public function viewsDayReset()
    {
        $this->update(['views_per_day' => 0]);
    }

    public function viewsWeekReset()
    {
        $this->update(['views_per_week' => 0]);
    }

    public function viewsMonthReset()
    {
        $this->update(['views_per_month' => 0]);
    }


}
