<?php

namespace Jasonej\EloquentSlugs\Tests;

use Jasonej\EloquentSlugs\Tests\Models\Article;
use Jasonej\EloquentSlugs\Tests\Models\User;
use Jasonej\EloquentSlugs\Tests\Models\Video;

class HasSlugsTest extends TestCase
{
    public function testCreatingSlugIsProcessedOnCreate()
    {
        $article = Article::query()->create(['title' => 'This is a test.']);
        $this->assertEquals('this-is-a-test', $article->slug);
    }

    public function testCreatingSlugIsNotProcessedOnUpdate()
    {
        $article = Article::query()
            ->create(['title' => 'This is a test.']);
        $article->update(['title' => 'This has been updated.']);
        $this->assertEquals('this-is-a-test', $article->slug);
    }

    public function testSavingSlugIsProcessedOnCreate()
    {
        $user = User::query()->create(['first_name' => 'John', 'last_name' => 'Doe']);
        $this->assertEquals('john-doe', $user->slug);
    }

    public function testSavingSlugIsProcessedOnUpdate()
    {
        $user = User::query()->create(['first_name' => 'John', 'last_name' => 'Doe']);
        $user->update(['first_name' => 'Jane']);
        $this->assertEquals('jane-doe', $user->slug);
    }

    public function testUpdatingSlugIsNotProcessedOnCreate()
    {
        $video = Video::query()->create(['slug' => 'test-slug', 'title' => 'This is a test.']);
        $this->assertNotEquals('this-is-a-test', $video->slug);
    }

    public function testUpdatingSlugIsProcessedOnUpdate()
    {
        $video = Video::query()->create(['slug' => 'test-slug', 'title' => 'This is a test.']);
        $video->update(['title' => 'Some test title.']);
        $this->assertEquals('some-test-title', $video->slug);
    }

    public function testUpdatingSlugIsNotProcessedIfSourceIsNotUpdated()
    {
        $video = Video::query()->create(['slug' => 'test-slug', 'title' => 'This is a test.']);
        $video->update(['slug' => 'test-slug-2']);
        $this->assertNotEquals('this-is-a-test', $video->slug);
    }
}