<?php

namespace App\Domain\Services;
use App\Contexts\Context;
use App\Domain\Models\Tag\Tag;
use App\Domain\Models\Tag\TagRepository;
use Assert\Assertion;
use Illuminate\Support\Str;

/**
 * Created by PhpStorm.
 * Tag: blue
 * Date: 7/21/2015
 * Time: 3:53 PM
 */
class TagServices
{

    /**
     * @var TagRepository $tags
     */
    private $tags;
    /**
     * @var Context
     */
    private $context;

    /**
     * @param TagRepository $tags
     * @param Context $context
     */
    public function __construct(TagRepository $tags, Context $context)
    {
        $this->tags = $tags;
        $this->context = $context;
    }

    public function create($name)
    {
        Assertion::string($name);

        $tag = new Tag([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);

        $tag->author()->associate($this->context->context());

        $this->tags->add($tag);

        return $tag;

    }

    public function update($id, $name)
    {
        Assertion::string($name);

        $tag = $this->tags->tagOfId($id);

        $tag->name = $name;
        $tag->slug = Str::slug($name);

        $this->tags->update($tag);

        return $tag;
    }

}