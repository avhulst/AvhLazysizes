{extends file="parent:frontend/detail/image.tpl"}
{* add class lazyload *}
{block name='frontend_detail_image_default_picture_element'}
    <img srcset="{$sArticle.image.thumbnails[1].sourceSet}"
         src="{$sArticle.image.thumbnails[1].source}"
         alt="{$alt}"
         itemprop="image" class="lazyload" data-sizes="auto"/>
{/block}
{* add class lazyload *}
{block name='frontend_detail_image_fallback'}
    <img src="{link file='frontend/_public/src/img/no-picture.jpg'}" alt="{$alt}" itemprop="image" class="lazyload"
         data-sizes="auto"/>
{/block}
{* add class lazyload *}
{block name='frontend_detail_images_image_element'}

    {$alt = $sArticle.articleName|escape}

    {if $image.description}
        {$alt = $image.description|escape}
    {/if}

    {$imageMediaClasses = 'image--media lazyload'}

    {$smarty.block.parent}
{/block}