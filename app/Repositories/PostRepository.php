<?php

namespace App\Repositories;

use App\Models\Post;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PostRepository
 * @package App\Repositories
 * @version May 19, 2019, 12:52 pm CST
 *
 * @method Post findWithoutFail($id, $columns = ['*'])
 * @method Post find($id, $columns = ['*'])
 * @method Post first($columns = ['*'])
*/
class PostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'des',
        'image',
        'content',
        'video_url',
        'cat_slug'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Post::class;
    }

    /**
     * 获取指定的分类的文章
     * @param  [type] $cat_slug [description]
     * @return [type]           [description]
     */
    public function getCatSlugPosts($cat_slug)
    {
        $posts = Post::where('cat_slug',$cat_slug)->get();
        if(count($posts))
        {
            foreach ($posts as $key => $post) {
                $post['post_url'] = \Request::root().'/post/'.$post->id;
            }
        }
        return $posts;
    }

    /**
     * 获取新闻详情
     * @param  [type] $post_id [description]
     * @return [type]          [description]
     */
    public function getPostDetail($post_id)
    {
        return Post::find($post_id);
    }
}
