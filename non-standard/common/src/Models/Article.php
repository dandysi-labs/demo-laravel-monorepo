<?php

namespace Common\Models;

use Common\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    const STATUS_PUBLISHED = 'Published';
    const STATUS_DRAFT = 'Draft';
    const STATUS_SUBMITTED = 'Submitted';
    const STATUS_REJECTED = 'Rejected';

    const STATUSES = [
        self::STATUS_PUBLISHED,
        self::STATUS_DRAFT,
        self::STATUS_SUBMITTED,
        self::STATUS_REJECTED
    ];

    const PRIORITY_HIGH = 1;
    const PRIORITY_NORMAL = 0;

    const AUTHOR_GEOFF = 'Geoff';
    const AUTHOR_DAVE = 'Dave';
    const AUTHOR_STEVE = 'Steve';

    const AUTHORS = [
        self::AUTHOR_GEOFF,
        self::AUTHOR_STEVE,
        self::AUTHOR_DAVE
    ];
    const CATEGORY_LARAVEL = 'Laravel';
    const CATEGORY_SYMFONY = 'Symfony';
    const CATEGORY_OTHER = 'Other';

    const CATEGORIES = [
        self::CATEGORY_LARAVEL,
        self::CATEGORY_SYMFONY,
        self::CATEGORY_OTHER
    ];

    protected $fillable = ['headline', 'content', 'status', 'category', 'author', 'priority', 'created_by'];

    protected static function newFactory(): Factory
    {
        return ArticleFactory::new();
    }
}
