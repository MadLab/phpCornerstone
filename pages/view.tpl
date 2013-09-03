{extends file="site.master.tpl"}
{block name="pageTitle"}phpCornerstone{/block}
{block name="head"}

{/block}
{block name="page"}
    <h1>Forum Homepage</h1>
    <div class="row">
        <div class="span8">
            <h2>Topics</h2>
            Filtering/Sorting:
            <ul>
                <li>communityId = 1, postType = 'topic', isDeleted=0</li>
            </ul>
        </div>
        <div class="span4">

        </div>
    </div>

{/block}
