<?php use yii\helpers\Url;
?>

<div class="d-flex align-items-center flex-wrap mb8">
    <span class="paragraph mr16">{summary}</span>
    <div class="vakancy-page-header-dropdowns">
        <div class="vakancy-page-wrap show mr16">
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#">За день</a>
                <a class="dropdown-item" href="#">За год</a>
                <a class="dropdown-item" href="#">За все время</a>
            </div>
        </div>
        <div class="vakancy-page-wrap show">
            <a class="vakancy-page-btn vakancy-btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                По новизне
                <i class="fas fa-angle-down arrowDown"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="<?= Url::current(['sort' => 'updated_at']) ?>">Новизне</a>
                <a class="dropdown-item" href="<?= Url::current(['sort' => 'zp']) ?>">Зарплате </a>
            </div>
        </div>
    </div>
</div>
{items}
{pager}