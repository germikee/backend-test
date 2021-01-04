<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Filtering query parameters can be done in the following examples:
     * Filter news published between dates e.g. api/news?filter[published_between]=2021-01-01,2021-01-10
     * Filter title e.g. api/news?filter[title]=test
     * Filter published news e.g. api/news?filter[is_published]=0
     * Filter author ids e.g. api/news?filter[author_id]=1
     * The negative sign (-) sorts in descending order e.g. api/news?sort=title,-is_published
     *
     * @return \App\Http\Resources\NewsResource
     */
    public function index()
    {
        $news = QueryBuilder::for(News::class)
            ->allowedFilters([
                AllowedFilter::scope('published_between'),
                'title',
                'is_published',
                'author_id',
            ])
            ->allowedSorts(['title', 'is_published'])
            ->defaultSort('-created_at')    // sorted from latest to old order
            ->paginate()
            ->appends(request()->query());

        return NewsResource::collection($news);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\NewsRequest  $request
     *
     * @return \App\Http\Resources\NewsResource
     */
    public function store(NewsRequest $request)
    {
        $data = News::create($request->all());

        return new NewsResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     *
     * @return \App\Http\Resources\NewsResource
     */
    public function show(News $news)
    {
        return new NewsResource($news);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\NewsRequest  $request
     * @param  \App\Models\News  $news
     *
     * @return \App\Http\Resources\NewsResource
     */
    public function update(NewsRequest $request, News $news)
    {
        $news->fill($request->all())->save();

        return new NewsResource($news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();

        return response()->noContent();
    }
}
