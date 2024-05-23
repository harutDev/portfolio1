<?php

namespace App\Http\Services;

use App\DTO\CreateLinkDTO;
use App\DTO\DeleteLinkDTO;
use App\DTO\UpdateLinkDTO;
use App\Interface\ColumnsInterface;
use App\Interface\ViewInterface;
use App\Models\Additional_links;

class AdditionalLinksService implements ViewInterface, ColumnsInterface
{
    public function createLinks(CreateLinkDTO $createLinkDTO): void
    {
        $links = new Additional_links();
        $links->name = $createLinkDTO->name;
        $links->id = $createLinkDTO->id;
        $links->post_id = $createLinkDTO->postId;


        $links->save();
    }
    public function updateLinks(UpdateLinkDTO $updateLinkDTO): void
    {
        Additional_links::query()->where('id', $updateLinkDTO->id)->update([
            self::NAME => $updateLinkDTO->name
        ]);

    }
    public function deleteLinks(DeleteLinkDTO $deleteLinkDTO): void
    {
        Additional_links::query()->where('id',$deleteLinkDTO->id)->delete();

    }
}
