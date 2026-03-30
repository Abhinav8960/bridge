<?php

namespace App\Observers\Backend\Configuration;

use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;

class CategoryObserver
{
    private static $deleted_at = null;
    /**
     * Handle the Category "created" event.
     *
     * @param  \App\Models\Backend\Configuration\Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        //
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param  \App\Models\Backend\Configuration\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        if ($category->wasChanged('status')) {
            $streams[] = Stream::where('category_id', '=', $category->id)->select('id')->distinct()->get()->toArray();
            Stream::where('category_id', '=', $category->id)->where('status', !$category->status)->update(['status' => $category->status]);
            Exam::where('stream_id', '=', $streams)->where('status', !$category->status)->update(['status' => $category->status]);
        }
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param  \App\Models\Backend\Configuration\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        $streams[] = Stream::where('category_id', '=', $category->id)->select('id')->distinct()->get()->toArray();
        Stream::where('category_id', '=', $category->id)->delete();
        Exam::where('stream_id', '=', $streams)->delete();
    }

    /**
     * Handle the Category "restored" event.
     *
     * @param  \App\Models\Backend\Configuration\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        $category->streams()
            ->onlyTrashed()->where('deleted_at', '>=', static::$deleted_at)
            ->get()
            ->each->restore();
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
