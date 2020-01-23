<?php

namespace App;

use App\Category;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use League\CommonMark\CommonMarkConverter;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'content','title', 'slug','published','image', 'status', 'category_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Append fields on the json response.
     *
     * @var array
     */
    protected $appends = ['parsed'];

    /**
     * Post author.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'author');
    }

    /**
     * Post category.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Query the database for all the published posts.
     *
     * @param $query
     */
    public function scopePublished($query)
    {
        return $query->where('status', true);
    }

    /**
     * Query the database for all the ubpublished posts.
     *
     * @param $query
     */
    public function scopeDrafts($query)
    {
        return $query->where('status', false);
    }

    /**
     * Search the title and slug of the posts based on a given term.
     *
     * @param string $term
     */
    public static function searchTitleAndSlug(string $term)
    {
        return self::where('title', 'LIKE', "%{$term}%")
                    ->orWhere('slug', 'LIKE', "%{$term}%");
    }

    /**
     * Update the post status to published.
     *
     * @return void
     */
    public function publish()
    {
        $this->update([
            'status' => true,
            'published' => Carbon::now()
        ]);
    }

    /**
     * Update the post status to unpublished.
     *
     * @return void
     */
    public function unpublish()
    {
        return $this->update([
            'status' => false,
            'published' => null
        ]);
    }

    /**
     * Get the posts content and parses it to html.
     *
     */
    public function getParsedAttribute()
    {
        $markdown = new CommonMarkConverter([
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
        ]);

        return $markdown->convertToHtml($this->content);
    }
}
