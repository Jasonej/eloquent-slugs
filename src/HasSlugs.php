<?php

namespace Jasonej\EloquentSlugs;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait HasSlugs
{
    /**
     * Boot this trait.
     *
     * @return void
     */
    public static function bootHasSlugs(): void
    {
        static::creating(function (self $self) {
            $self->processSlugs(function (array $definition) {
                return in_array($definition['event'], ['creating', 'saving']);
            });
        });
        static::updating(function (self $self) {
            $self->processSlugs(function (array $definition) use ($self) {
                $isDirty = $self->isDirty($definition['source']);

                return $isDirty && in_array($definition['event'], ['saving', 'updating']);
            });
        });
    }

    /**
     * Process the slugs.
     *
     * @param callable $filter
     */
    protected function processSlugs(callable $filter)
    {
        collect($this->slugDefinitions ?? [])
            ->filter($filter)
            ->each(function (array $definition, string $attribute) {
                $source = Arr::only($this->getAttributes(), $definition['source']);
                $slug = Str::slug(implode(' ', $source));

                $this->setAttribute($attribute, $slug);
            });
    }
}